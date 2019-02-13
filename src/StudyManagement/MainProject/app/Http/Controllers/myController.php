<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Student;
use App\Teacher;
use App\Admin;
use App\StudyPath;
use App\Course;
use App\Class_;
use App\Enrol;

class myController extends Controller
{
    //Dang xuat
    public function postLogout(Request $request)
    {
        Auth::logout();
        return redirect('home');
    }

    //Quay ve trang chu
    public function returnHome()
    {
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
        $info['person'] = $person;
        return view('index', $info);
    }

    //Cap bang
    public function certificate()
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $CPA = array();
            $type = array();
            $eligibleIndividual = array();
            $student = Student::all()->toArray();
            //Duyet tung sinh vien
            for($j=0; $j < count($student); $j++)
            {
                $point = $credit = 0;
                $eligible = true;
                //Tim tat ca hoc phan sinh vien do can hoc
                $studyPath = StudyPath::where('program', $student[$j]['program'])->get()->toArray();
                //Tim bang diem cua sinh vien do
                $enrol = Enrol::where('studentId', $student[$j]['id'])->get()->toArray();
                //Duyet diem so tung hoc phan
                foreach($studyPath as $compulsoryCourse)
                {
                    $i = 0;
                    for($i=0; $i < count($enrol); $i++)
                    {
                        $class = Class_::where('classId', $enrol[$i]['classId'])->first()->toArray();
                        if($class['courseId'] == $compulsoryCourse['courseId'])
                            if(empty($enrol[$i]['evaluate']) or $enrol[$i]['evaluate'] == "F")
                            {
                                $eligible = false;
                                break;
                            }
                            else
                            {
                                $course = Course::where('courseId', $class['courseId'])->first()->toArray();
                                $credit += $course['credit'];
                                $point += $enrol[$i]['exchange'] * $course['credit'];
                                break;
                            }
                    }
                    if($i == count($enrol))
                        $eligible = false;
                }
                if($eligible and $credit != 0)
                    if($point / $credit >= 2.4)
                    {
                        $eligibleIndividual[] = $student[$j];
                        $CPA[] = $point / $credit;
                        if($point / $credit >= 3.6)
                            $type[] = "Xuất sắc";
                        else if($point / $credit >= 3.2)
                            $type[] = "Giỏi";
                        else if($point / $credit >= 2.8)
                            $type[] = "Khá";
                        else if($point / $credit >= 2.4)
                            $type[] = "Trung bình";
                    }
            }

            //Thong tin nguoi dung dang nhap
            $person = Admin::find(Auth::user()->username)->toArray();
            $info = [
                'eligibleIndividual' => $eligibleIndividual,
                'CPA' => $CPA,
                'type' => $type,
                'person' => $person
            ];

            return view('graduatedIndividual', $info);
        }
        else
            return redirect('home');
    }
}