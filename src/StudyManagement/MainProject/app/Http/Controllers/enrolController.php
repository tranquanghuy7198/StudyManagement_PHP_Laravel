<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Enrol;
use App\Student;
use App\Class_;
use App\Course;
use App\Admin;
use Auth;

class enrolController extends Controller
{
    //Bo sung bang dang ky
    public function addEnrolList(Request $request)
    {
        if(Auth::check() and Auth::user()->who != 2)
        {
            $class = Class_::where('classId', $request->classId)->first();

            if(Auth::user()->who == 1)
                $student = Student::find(Auth::user()->username);
            else
                $student = Student::find($request->id);

            //Dang ky lop hoc
            if(isset($student) and isset($class))
            {
                $course = Course::where('courseId', $class->courseId)->first();

                //Kiem tra xem hoc phan nay sinh vien da hoc chua
                $enrolList = Enrol::where('studentId', $student->id)->get();
                foreach($enrolList as $object)
                {
                    $classExist = Class_::where('classId', $object->classId)->first();
                    if($classExist->courseId == $class->courseId)   //neu hoc roi
                    {
                        $object->delete();
                        break;
                    }
                }

                //Them mot ban enrol moi
                $enrol = new Enrol;
                $enrol->studentId = $request->id;
                $enrol->classId = $request->classId;
                $enrol->save();

                //Tinh hoc phi
                if($course->credit == 0)
                    $course->credit = 1.5;
                $student->fee += 250000 * $course->credit;
                $student->save();
            }

            $data = array();
            $class = array();
            $course = array();

            //Tim kiem thong tin
            if(Auth::user()->who == 1)
                $enrolList = Enrol::where('studentId', Auth::user()->username)->get()->toArray();
            else
                $enrolList = Enrol::where('studentId', $request->id)->get()->toArray();     //$data bao gom nhieu $row
            foreach($enrolList as $row)      //moi $row bao gom studentId va classId
            {
                $getCorrespondingClass = Class_::where('classId', $row['classId'])->first()->toArray();    //bao gom classId, courseId
                $getCorrespondingCourse = Course::where('courseId', $getCorrespondingClass['courseId'])->first()->toArray();    //courseId, courseName
                $class[] = $getCorrespondingClass;
                $course[] = $getCorrespondingCourse;
            }

            //Luu thong tin vao $data
            for($i=0; $i < count($enrolList); $i++)
            {
                $data[] = [
                    'id' => $student['id'],
                    'fullName' => $student['fullName'],
                    'classId' => $class[$i]['classId'],
                    'courseId' => $course[$i]['courseId'],
                    'courseName' => $course[$i]['courseName']
                ];
            }

            //Thong tin nguoi dung dang nhap
            if(Auth::user()->who == 1)
                $person = $student;
            else
                $person = Admin::find(Auth::user()->username);

            if(isset($student))
                $student = $student->toArray();
            else
                $student = array(
                    'id' => null,
                    'fullName' => null
                );

            $info = array(
                'person' => $person,
                'data' => $data,
                'student' => $student
            );

            return view('getEnrol', $info);
        }
        else
            return redirect('home');
    }

    //Xoa ban dang ky
    public function deleteEnrolList(Request $request)
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            //Xoa ban dang ky
            $enrol = Enrol::where('studentId', $request->studentId)->where('classId', $request->classId)->first();
            $enrol->delete();

            //Tru hoc phi
            $student = Student::find($request->studentId);
            $class = Class_::where('classId', $request->classId)->first();
            $course = Course::where('courseId', $class->courseId)->first();
            if($course->credit == 0)
                    $course->credit = 1.5;
            $student->fee -= 250000 * $course->credit;
            $student->save();
            
            return redirect('enrol');
        }
        else
            return redirect('home');
    }
}
