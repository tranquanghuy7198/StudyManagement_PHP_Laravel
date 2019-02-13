<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Student;
use App\Teacher;
use App\Admin;
use App\User;
use Hash;

class personalInfoController extends Controller
{
    //Doi mat khau
    public function changePassword(Request $request)
    {
        if(Auth::check())
        {
            $data = User::where('username', Auth::user()->username)->get()->first();
            if(Hash::check($request->oldPassword, $data->password) and $request->password == $request->passwordConfirm)
            {
                $data->password = Hash::make($request->password);
                $data->save();
            }
            return redirect('home');
        }
        else
            return redirect('home');
    }

    public function viewPersonalInfo()
    {
        if(Auth::check())
        {
            if(Auth::user()->who == 1)
                $person = Student::where('id', Auth::user()->username)->first()->toArray();
            else if(Auth::user()->who == 2)
                $person = Teacher::where('id', Auth::user()->username)->first()->toArray();
            else
                $person = Admin::where('id', Auth::user()->username)->first()->toArray();
            $info = [
                'person' => $person
            ];
            return view('viewPersonalInfo', $info);
        }
        else
            return redirect('home');
    }

    public function updatePersonalInfo(Request $request)
    {
        if(Auth::check())
        {
            if(Auth::user()->who == 1)
                $data = Student::find(Auth::user()->username);
            else if(Auth::user()->who == 2)
                $data = Teacher::find(Auth::user()->username);
            else
                $data = Admin::find(Auth::user()->username);

            if($request->birthdate != null)
                $data->birthdate = $request->birthdate;
            if($request->phone != null)
                $data->phone = $request->phone;
            if($request->mail != null)
                $data->mail = $request->mail;
            if($request->address != null)
                $data->address = $request->address;
            $data->save();
        }
        return redirect('viewPersonalInfo');
    }
}
