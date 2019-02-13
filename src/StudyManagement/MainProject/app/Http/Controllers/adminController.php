<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin;
use App\User;
use Hash;
use Auth;
use App\Http\Requests\adminRequest;

class adminController extends Controller
{
    public function addAdminList(Request $request)
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $oldAdmin = Admin::find($request->id);
            $oldUser = User::where('username', $request->id)->first();
            if(empty($oldAdmin) and empty($oldUser))
            {
                //Them admin vao danh sach admin
                $admin = new Admin;
                $admin->id = $request->id;
                $admin->fullName = $request->fullName;
                $admin->who = 3;
                $admin->save();

                //Them mot ban dang nhap
                $user = new User;
                $user->username = $request->id;
                $user->password = Hash::make($request->id);
                $user->who = 3;
                $user->remember_token = $request->token;
                $user->save();
            }

            return redirect('editAdminList');
        }
        else
            return redirect('home');
    }

    //Tim thong tin tat ca admin
    public function editAdminList()
    {
        if(Auth::check() and Auth::user()->who == 3)
        {
            $data = Admin::all()->toArray();
            $person = Admin::find(Auth::user()->username)->toArray();
            $info = array(
                'data' => $data,
                'person' => $person
            );
            return view('editAdminList', $info);
        }
        else
            return redirect('home');
    }

    //Cap nhat thong tin quan tri vien
    public function updateAdminInfo(Request $request)
    {
        $admin = Admin::find($request->id);
        if($request->fullName != null)
            $admin->fullName = $request->fullName;
        $admin->save();

        return redirect('editAdminList');
    }

    //Xoa quan tri vien khoi danh sach
    public function deleteAdminList(Request $request)
    {
        //Xoa trong danh sach quan tri vien
        $admin = Admin::find($request->id);
        $admin->delete();

        //Xoa trong danh sach user
        $user = User::where('username', $request->id)->first();
        $user->delete();

        return redirect('editAdminList');
    }
}
