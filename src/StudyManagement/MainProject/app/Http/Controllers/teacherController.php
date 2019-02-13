<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Student;
use App\User;
use Hash;
use Auth;
use App\Http\Requests\teacherRequest;

class teacherController extends Controller
{
    //Bo sung danh sach giang vien
    public function addTeacherList(Request $request)
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $oldTeacher = Teacher::find($request->id);
            $oldUser = User::where('username', $request->id)->first();
            if(empty($oldTeacher) and empty($oldUser))
            {
                //Them giang vien moi trong danh sach giang vien
                $teacher = new Teacher;
                $teacher->id = $request->id;
                $teacher->fullName = $request->fullName;
                $teacher->department = $request->department;
                $teacher->who = 2;
                $teacher->save();
                
                //Them giang vien trong danh sach user
                $user = new User;
                $user->username = $request->id;
                $user->password = Hash::make($request->id);
                $user->remember_token = $request->token;
                $user->who = 2;
                $user->save();
            }

            return redirect('listTeacher');
        }
        else
            return redirect('home');
    }
    
    public function getListTeacher(){
        $teachers = Teacher::all();
        $info = array(
                'teachers' => $teachers,
            );
        return view('listTeacher', $info);
    }
    public function deleteTeacher(Request $request){
        $teacher = Teacher::find($request->id);
        $teacher->delete();
        $user = User::where('username', $request->id)->first();
        $user->delete();
        return redirect()->back();
    }

    //Sua thong tin giang vien
    public function updateTeacherInfo(Request $request)
    {
        $teacher = Teacher::find($request->id);
        if($request->fullName != null)
            $teacher->fullName = $request->fullName;
        if($request->birthdate != null)
            $teacher->birthdate = $request->birthdate;
        if($request->department != null)
            $teacher->department = $request->department;
        $teacher->save();

        return redirect('listTeacher');
    }
}
