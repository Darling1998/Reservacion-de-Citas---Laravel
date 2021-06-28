<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){

        return view('admin.users.index');
    }

    public function edit( User $user){
        return view('admin.users.edit',compact('user'));
    }
}
