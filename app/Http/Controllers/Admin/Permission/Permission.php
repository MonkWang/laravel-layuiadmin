<?php

namespace App\Http\Controllers\Admin\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Permission extends Controller
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

    public function adminform()
    {
        return view('admin.permission.permission.adminform');
    }

    public function list()
    {
        return view('admin.permission.permission.list');
    }
}
