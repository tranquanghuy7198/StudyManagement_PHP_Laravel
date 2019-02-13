<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Enrol;
use App\Class_;
use App\Course;
use App\Student;
use App\Admin;
use App\Teacher;
use App\StudyPath;
use Auth;

class searchController extends Controller
{
    //Hoc phan sinh vien dang ky
    public function studentRegister(Request $request)
    {
        $student = Student::where('id', $request->id)->first();     //Tim sinh vien co ma so yeu cau
        if(isset($student))
            $student = $student->toArray();
        else
            $student = [
                'id' => null,
                'fullName' => null
            ];
        
        $data = array();
        $class = array();
        $course = array();

        //Tim kiem thong tin
        $enrol = Enrol::where('studentId', $request->id)->get()->toArray();     //$data bao gom nhieu $row
        foreach($enrol as $row)      //moi $row bao gom studentId va classId
        {
            $getCorrespondingClass = Class_::where('classId', $row['classId'])->first()->toArray();    //bao gom classId, courseId
            $getCorrespondingCourse = Course::where('courseId', $getCorrespondingClass['courseId'])->first()->toArray();    //courseId, courseName
            $class[] = $getCorrespondingClass;
            $course[] = $getCorrespondingCourse;
        }

        //Luu thong tin vao $data
        for($i=0; $i < count($enrol); $i++)
        {
            $data[] = [
                'id' => $student['id'],
                'fullName' => $student['fullName'],
                'classId' => $class[$i]['classId'],
                'courseId' => $course[$i]['courseId'],
                'courseName' => $course[$i]['courseName']
            ];
        }

        //Kiem tra nguoi dung dang nhap
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

        //Dong goi thong tin vao $info
        $info = array(
            'student' => $student,
            'data' => $data,
            'person' => $person
        );
            
        return view('studentRegisterResult', $info);
    }

    //Hoc phi sinh vien
    public function studentFee(Request $request)
    {
        if(Auth::check() and Auth::user()->who != 2)
        {
            $data = array();
            $class = array();
            $course = array();
            $totalFee = 0;
            $totalCredit = 0;

            //Tim ban dang ky
            if(Auth::user()->who == 1)
                $enrol = Enrol::where('studentId', Auth::user()->username)->get()->toArray();     //$enrol gom nhieu $row
            else
                $enrol = Enrol::where('studentId', $request->id)->get()->toArray();
            for($i=0; $i < count($enrol); $i++)     //Moi $row bao gom studentId va classId
            {
                $class[$i] = Class_::where('classId', $enrol[$i]['classId'])->first()->toArray();      //gom classId va courseId
                $course[$i] = Course::where('courseId', $class[$i]['courseId'])->first()->toArray();
            }

            //Tim sinh vien
            if(Auth::user()->who == 1)
                $student = Student::find(Auth::user()->username)->toArray();
            else
            {
                $student = Student::find($request->id);
                if(isset($student))
                    $student = $student->toArray();
                else
                    $student = array(
                        'id' => null,
                        'fullName' => null
                    );
            }

            //Luu thong tin vao $data
            for($i=0; $i < count($enrol); $i++)
            {
                if($course[$i]['credit'] == 0)
                    $course[$i]['credit'] = 1.5;
                $data[] = [
                    'courseId' => $course[$i]['courseId'],
                    'courseName' => $course[$i]['courseName'],
                    'credit' => $course[$i]['credit'],
                    'classId' => $class[$i]['classId'],
                    'fee' => 250000 * $course[$i]['credit']
                ];
                $totalFee += 250000 * $course[$i]['credit'];
                $totalCredit += $course[$i]['credit'];
            }

            //Thong tin nguoi dung dang dang nhap
            if(Auth::user()->who == 1)
                $person = Student::find(Auth::user()->username)->toArray();
            else
                $person = Admin::find(Auth::user()->username)->toArray();

            //Dong goi thong tin vao $info
            $info = array(
                'data' => $data,
                'student' => $student,
                'person' => $person,
                'totalFee' => $totalFee,
                'totalCredit' => $totalCredit
            );

            //Truyen thong tin sang view
            return view('studentFeeResult', $info);
        }
        else
            return redirect('home');
    }

    //Lo trinh hoc
    public function studyPath(Request $request)
    {
        if(Auth::check() and Auth::user()->who != 2)
        {
            //Tim sinh vien tuong ung
            if(Auth::user()->who == 1)
                $student = Student::find(Auth::user()->username)->toArray();
            else
            {
                $student = Student::find($request->id);
                if(isset($student))
                    $student = $student->toArray();
                else
                    $student = array(
                        'id' => null,
                        'fullName' => null,
                        'program' => null
                    );
            }
            //Tim lo trinh hoc
            $studyPath = StudyPath::where('program', $student['program'])->get()->toArray();
            //Tim diem so
            $enrol = Enrol::where('studentId', $student['id'])->get()->toArray();

            $compulsoryCourse = array();
            $evaluate = array();
            $studyResult = array();
            //Tim hoc phan trong lo trinh hoc
            for($i=0; $i < count($studyPath); $i++)
            {
                $compulsoryCourse[$i] = Course::where('courseId', $studyPath[$i]['courseId'])->first()->toArray();
                foreach($enrol as $record)
                {
                    $correspondingClass = Class_::where('classId', $record['classId'])->first();
                    if($correspondingClass->courseId == $studyPath[$i]['courseId'])
                    {
                        $evaluate[$i] = $record['evaluate'];
                        $studyResult[$i] = $record['exchange'];
                        break;
                    }
                }
            }
            
            //Tim thong tin nguoi dung dang nhap
            if(Auth::user()->who == 1)
                $person = $student;
            else
                $person = Admin::find(Auth::user()->username)->toArray();
            
            //Dong goi thong tin vao $info va truyen sang view
            $info = [
                'student' => $student,
                'compulsoryCourse' => $compulsoryCourse,
                'evaluate' => $evaluate,
                'studyResult' => $studyResult,
                'person' => $person
            ];
            return view('studyPath', $info);
        }
        else
            return redirect('home');
    }
}
