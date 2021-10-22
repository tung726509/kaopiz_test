<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Response;

use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index(Request $req)
    {
        $header = 'Tất cả tài khoản users';
        $user_id = $req->query('user_id');
        $phone = $req->query('phone');
        $role_name = $req->query('role_name');
        $roles = Role::get();
        $users = new User();

        if($user_id){
            $users = $users->where('id',$user_id)->orderBy('id','desc')->get();
            return view('user.index',compact('header','users','roles'));
        }

        if($phone){
            $users = $users->whereHas('phone',function ($query) use ($phone) {
                $query->where('number','like','%'.$phone.'%');
            });
        }

        if($role_name){
            $users = $users->whereHas('roles',function ($query) use ($role_name) {
                $query->where('name',$role_name);
            });
        }
        
        $users = $users->orderBy('id','desc')->get();

        return view('user.index',compact('header','users','roles'));
    }
}
