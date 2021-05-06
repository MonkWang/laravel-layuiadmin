<?php

namespace App\Http\Controllers\Admin\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Role extends Controller
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

    public function role()
    {
        return view('admin.permission.role.role');
    }

    public function roleform(Request $request)
    {
        if($request->method() == 'POST'){
            $this->selfValidator($request->all(), [
                'descr' => 'required|string',
                'rolename' => 'required|int|min:0',
            ]);

        }
        return view('admin.permission.role.roleform');
    }
}
