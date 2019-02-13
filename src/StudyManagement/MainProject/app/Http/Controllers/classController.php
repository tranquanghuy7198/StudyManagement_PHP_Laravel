<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Class_;
use App\Course;
use App\Teacher;
use App\Admin;
use App\Enrol;
use App\Student;
use Auth;
use App\Http\Requests\classRequest;

class classController extends Controller
{
    public function addClassList(classRequest $request)
    {
        $class = new Class_;
        $class->classId = $request->classId;
        $class->courseId = $request->courseId;
        $class->teacherId = $request->teacherId;
        $class->save();

        return redirect()->back();
    }

    public function editClassList()
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $class = Class_::all()->toArray();
            $correspondentCourse = array();
            $correspondentTeacher = array();
            foreach($class as $row)
            {
                $correspondentCourse[] = Course::where('courseId', $row['courseId'])->first()->toArray();
                $correspondentTeacher[] = Teacher::find($row['teacherId'])->toArray();
            }
            $course = Course::all()->toArray();
            $teacher = Teacher::all()->toArray();
            $person = Admin::find(Auth::user()->username)->toArray();
            $info = [
                'class' => $class,
                'correspondentCourse' => $correspondentCourse,
                'correspondentTeacher' => $correspondentTeacher,
                'course' => $course,
                'teacher' => $teacher,
                'person' => $person
            ];
            return view('editClassList', $info);
        }
        else
            return redirect('home');
    }

    public function updateClassInfo(Request $request)
    {
        $class = Class_::where('classId', $request->classId)->first();
        if($request->teacherId != null)
            $class->teacherId = $request->teacherId;
        $class->save();

        return redirect('editClassList');
    }

    public function deleteClassList(Request $request)
    {
        $class = Class_::where('classId', $request->classId)->first();
        $enrol = Enrol::where('classId', $request->classId)->get();
        $class->delete();
        foreach($enrol as $object)
            $object->delete();
        
        return redirect('editClassList');
    }

    //Danh sach lop
    public function classList(Request $request)
    {
        $class = Class_::where('classId', $request->classId)->first();
        if(isset($class))
        {
            $class = $class->toArray();
            $course = Course::where('courseId', $class['courseId'])->first()->toArray();
        }
        else
        {
            $class = array('classId' => null);
            $course = array('courseName' => null);
        }
        $enrol = Enrol::where('classId', $request->classId)->get();
        $student = array();
        foreach($enrol as $object)
            $student[] = Student::find($object->studentId);

        //Thong tin ve nguoi dung dang nhap
        if(Auth::check())
            if(Auth::user()->who == 1)
                $person = Student::find(Auth::user()->username);
            else if(Auth::user()->who == 2)
                $person = Teacher::find(Auth::user()->username);
            else
                $person = Admin::find(Auth::user()->username);
        else
            $person = array();
        
        //Dong goi thong tin vao $info
        $info = [
            'class' => $class,
            'course' => $course,
            'student' => $student,
            'person' => $person
        ];
        return view('classList', $info);
    }
}
