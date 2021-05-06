<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }


    public function list()
    {
        return view('admin.user.user.list');
    }

    public function userform()
    {
        return view('admin.user.user.userform');
    }

}
