<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Student;
use App\User;
use App\Admin;
use App\Enrol;
use Hash;
use Auth;

class studentController extends Controller
{
    //Bo sung danh sach sinh vien
    public function addStudentList(Request $request)
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $oldStudent = Student::find($request->id);
            $oldUser = User::where('username', $request->id)->first();
            if(empty($oldStudent) and empty($oldUser))
            {
                //Tao sinh vien moi trong danh sach sinh vien
                $student = new Student;
                $student->id = $request->id;
                $student->fullName = $request->fullName;
                $student->program = $request->program;
                $student->who = 1;
                $student->save();

                //Tao user-login trong danh sach users
                $user = new User;
                $user->username = $request->id;
                $user->password = Hash::make($request->id);
                $user->who = 1;
                $user->remember_token = $request->token;
                $user->save();
            }

            return redirect('editStudentList');
        }
        else
            return redirect('home');
    }

    //Cap nhat thong tin sinh vien
    public function updateStudentInfo(Request $request)
    {
        $student = Student::find($request->id);
        if($request->fullName != null)
            $student->fullName = $request->fullName;
        if($request->studentGroup != null)
            $student->studentGroup = $request->studentGroup;
        if($request->program != null)
            $student->program = $request->program;
        if($request->birthdate != null)
            $student->birthdate = $request->birthdate;
        $student->save();
        
        return redirect('editStudentList');
    }

    //Tim thong tin tat ca sinh vien
    public function editStudentList()
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $data = Student::all()->toArray();
            $person = Admin::find(Auth::user()->username)->toArray();
            $info = array(
                'data' => $data,
                'person' => $person
            );
            return view('editStudentList', $info);
        }
        else
            return redirect('home');
    }

    //Xoa sinh vien khoi danh sach
    public function deleteStudentList(Request $request)
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            //Xoa trong danh sach sinh vien
            $student = Student::find($request->id);
            $student->delete();

            //Xoa trong danh sach enrol
            $enrol = Enrol::where('studentId', $request->id)->get();
            foreach($enrol as $object)
                $object->delete();
            
            //Xoa trong danh sach user
            $user = User::where('username', $request->id)->first();
            $user->delete();
            return redirect('editStudentList');
        }
        else
            return redirect('home');
    }
}
