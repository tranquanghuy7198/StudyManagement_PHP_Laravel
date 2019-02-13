<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Course;
use App\Class_;
use App\Enrol;
use App\Admin;
use App\Student;
use App\Teacher;
use Auth;

class courseController extends Controller
{
    //Bo sung danh sach hoc phan
    public function addCourseList(Request $request)
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $oldCourse = Course::where('courseId', $request->courseId)->first();
            if(empty($oldCourse))
            {
                //Eloquent
                $course = new Course;
                $course->courseId = $request->courseId;
                $course->courseName = $request->courseName;
                $course->credit = $request->credit;
                $course->save();
            }

            return redirect()->back();
        }
        else
            return redirect('home');
    }

    //Tim thong tin hoc phan
    public function editCourseList()
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $course = Course::all()->toArray();
            $person = Admin::find(Auth::user()->username)->toArray();
            $info = array(
                'course' => $course,
                'person' => $person
            );
            return view('editCourseList', $info);
        }
        else
            return redirect('home');
    }

    //Cap nhat thong tin hoc phan
    public function updateCourseInfo(Request $request)
    {
        $course = Course::where('courseId', $request->courseId)->first();
        if($request->courseName != null)
            $course->courseName = $request->courseName;
        if($request->credit != null)
            $course->credit = $request->credit;
        $course->save();

        return redirect('editCourseList');
    }

    //Xoa hoc phan khoi danh sach
    public function deleteCourseList(Request $request)
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $course = Course::where('courseId', $request->courseId)->first();     //Tim hoc phan can xoa
            $course->delete();      //Xoa hoc phan

            //Tim lop co lien quan toi hoc phan do
            $class = Class_::where('courseId', $request->courseId)->get();
            foreach($class as $object)      //Xoa ban enrol roi xoa class
            {
                $enrol = Enrol::where('classId', $object->classId)->get();
                foreach($enrol as $enrolRecord)
                    $enrolRecord->delete();
                $object->delete();
            }
               
            return redirect('editCourseList');
        }
        else
            return redirect('home');
    }

    //Toan bo hoc phan
    public function findAllCourse()
    {
        $data = Course::all()->toArray();
        if(Auth::check())
        {
            if(Auth::user()->who == 1)
                $person = Student::where('id', Auth::user()->username)->first()->toArray();
            else if(Auth::user()->who == 2)
                $person = Teacher::where('id', Auth::user()->username)->first()->toArray();
            else
                $person = Admin::where('id', Auth::user()->username)->first()->toArray();
        }
        else
            $person = array('fullName' => '', 'who' => 0);
        $info = array(
            'data' => $data,
            'person' => $person
        );
        return view('findAllCourse', $info);
    }
}
