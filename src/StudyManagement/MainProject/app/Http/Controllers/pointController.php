<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Student;
use App\Teacher;
use App\Admin;
use App\Class_;
use App\Course;
use App\Enrol;

class pointController extends Controller
{
    //Giang vien cho diem lop co ma lop $classId
    public function givePoint($classId)
    {
        if(Auth::check() and Auth::user()->who == 2)
        {
            //Thong tin nguoi dung dang dang nhap
            if(Auth::user()->who == 2)
                $person = Teacher::where('id', Auth::user()->username)->first()->toArray();
            else if(Auth::user()->who == 3)
                $person = Admin::where('id', Auth::user()->username)->first()->toArray();
            
            //Thong tin giang day cua giang vien
            $student = array();
            $course = array();

            $thisClass = Class_::where('classId', $classId)->first()->toArray();
            $class = Class_::where('teacherId', Auth::user()->username)->get()->toArray();
            foreach($class as $row)
                $course[] = Course::where('courseId', $row['courseId'])->first()->toArray();
            $enrol = Enrol::where('classId', $classId)->get()->toArray();
            foreach($enrol as $row)
                $student[] = Student::find($row['studentId'])->toArray();

            //Dong goi thong tin vao $info
            $info = array(
                'person' => $person,
                'course' => $course,
                'class' => $class,
                'thisClass' => $thisClass,
                'enrol' => $enrol,
                'student' => $student
            );
            return view('givePoint', $info);
        }
        else
            return redirect('home');
    }

    //Tinh diem va ghi diem vao co so du lieu
    public function calculatePoint(Request $request)
    {
        if(Auth::check() and Auth::user()->who != 1)
        {
            //Cap nhat trong bang enrols
            $enrol = Enrol::where('classId', $request->classId)->where('studentId', $request->id)->first();

            if($request->midterm != null)
                if(Auth::user()->who == 2 or (Auth::user()->who == 3 and isset($enrol->midterm)))
                    $enrol->midterm = $request->midterm;
            if($request->endterm != null)
                if(Auth::user()->who == 2 or (Auth::user()->who == 3 and isset($enrol->midterm)))
                    $enrol->endterm = $request->endterm;

            if(isset($enrol->midterm) and isset($enrol->endterm))
            {
                $total = 0.3 * $enrol->midterm + 0.7 * $enrol->endterm;
                if($total >= 9.5)
                {
                    $enrol->evaluate = "A+";
                    $enrol->exchange = 4;
                }
                else if($total >= 8.5)
                {
                    $enrol->evaluate = "A";
                    $enrol->exchange = 4;
                }
                else if($total >= 8)
                {
                    $enrol->evaluate = "B+";
                    $enrol->exchange = 3.5;
                }
                else if($total >= 7)
                {
                    $enrol->evaluate = "B";
                    $enrol->exchange = 3;
                }
                else if($total >= 6.5)
                {
                    $enrol->evaluate = "C+";
                    $enrol->exchange = 2.5;
                }
                else if($total >= 5.5)
                {
                    $enrol->evaluate = "C";
                    $enrol->exchange = 2;
                }
                else if($total >= 5)
                {
                    $enrol->evaluate = "D+";
                    $enrol->exchange = 1.5;
                }
                else if($total >= 4)
                {
                    $enrol->evaluate = "D";
                    $enrol->exchange = 1;
                }
                else
                {
                    $enrol->evaluate = "F";
                    $enrol->exchange = 0;
                }
            }
            $enrol->save();

            if(Auth::check() and Auth::user()->who == 2)
                return redirect()->back();
            else if(Auth::check() and Auth::user()->who == 3)
                return redirect('findTeachingClass');
        }
        else
            return redirect('home');
    }

    public function findTeachingClass(Request $request)
    {
        if(Auth::check() and Auth::user()->who != 1)
        {
            //Thong tin nguoi dung dang dang nhap
            if(Auth::user()->who == 2)
                $person = Teacher::where('id', Auth::user()->username)->first()->toArray();
            else if(Auth::user()->who == 3)
                $person = Admin::where('id', Auth::user()->username)->first()->toArray();
            
            //Neu nguoi dang nhap la giang vien
            if(Auth::user()->who == 2)
            {
                $teacher = Teacher::find(Auth::user()->username);
                $class = Class_::where('teacherId', Auth::user()->username)->get()->toArray();
                $course = array();
                foreach($class as $row)
                    $course[] = Course::where('courseId', $row['courseId'])->first()->toArray();
                
                //Dong goi thong tin vao $info
                $info = array(
                    'teacher' => $teacher,
                    'person' => $person,
                    'class' => $class,
                    'course' => $course
                );
                
                return view('findTeachingClass', $info);
            }
            //Neu nguoi dang dang nhap la admin
            else if(Auth::user()->who == 3)
            {
                $course = array();
                $student = Student::find($request->id);
                if(isset($student))
                    $student = $student->toArray();
                $enrol = Enrol::where('studentId', $request->id)->get()->toArray();
                for($i=0; $i < count($enrol); $i++)
                {
                    $class = Class_::where('classId', $enrol[$i]['classId'])->first()->toArray();
                    $course[] = Course::where('courseId', $class['courseId'])->first()->toArray();
                }

                //Dong goi thong tin vao $info
                $info = array(
                    'person' => $person,
                    'student' => $student,
                    'enrol' => $enrol,
                    'course' => $course
                );
                return view('editStudentPoint', $info);
            }
        }
        else
            return redirect('home');
    }

    //Sinh vien kiem tra bang diem ca nhan
    public function studentPoint()
    {
        if(Auth::check() and Auth::user()->who != 2)
        {
            if(Auth::user()->who == 1)
            {
                //Thong tin nguoi dung dang dang nhap
                if(Auth::user()->who == 1)
                    $person = Student::where('id', Auth::user()->username)->first()->toArray();
                else if(Auth::user()->who == 3)
                    $person = Admin::where('id', Auth::user()->username)->first()->toArray();
                
                //Tim thong tin dang ky hoc tap cua sinh vien
                $course = array();
                $student = Student::find(Auth::user()->username);

                $enrol = Enrol::where('studentId', Auth::user()->username)->get()->toArray();
                for($i=0; $i < count($enrol); $i++)
                {
                    $class = Class_::where('classId', $enrol[$i]['classId'])->first()->toArray();
                    $course[$i] = Course::where('courseId', $class['courseId'])->first()->toArray();
                }

                //Dong goi thong tin vao $info
                $info = array(
                    'person' => $person,
                    'student' => $student,
                    'enrol' => $enrol,
                    'course' => $course
                );
                return view('studentPoint', $info);
            }
        }
        else
            return redirect('home');
    }

    //Admin xu ly diem toan truong
    public function pointProcess()
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $studentList = Student::all();
            foreach($studentList as $student)
            {
                $totalPoint = $enrolCredit = $completeCredit = 0;
                $enrolList = Enrol::where('studentId', $student->id)->get();
                foreach($enrolList as $enrol)
                {
                    $class = Class_::where('classId', $enrol->classId)->first();
                    $course = Course::where('courseId', $class->courseId)->first();
                    $enrolCredit += $course->credit;
                    $totalPoint += $enrol->exchange * $course->credit;
                    if(isset($enrol->evaluate) and $enrol->evaluate != "F")
                        $completeCredit += $course->credit;
                }
                $student->enrolCredit = $enrolCredit;
                $student->completeCredit = $completeCredit;
                if($enrolCredit != 0)
                    $student->CPA = $totalPoint / $enrolCredit;
                $student->save();
            }
            return redirect('home');
        }
        else
            return redirect('home');
    }
}
