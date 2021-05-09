<?php

namespace App\Http\Controllers\Admin\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE App\Models\Role as Roles;

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

    public function list(Request $request)
    {
        if($request->method() == 'POST'){
            $base = new \App\Models\Role();
            $count = $base -> count();
            $data = $base ->get();
            return $this->returnTable($count, $data);
        }
        return view('admin.permission.role.list');
    }

    public function roleform(Request $request)
    {
        if($request->method() == 'POST'){
            $this->selfValidator($request->all(), [
                'descr' => 'required|string',
                'rolename' => 'required|int|min:0',
            ]);
        }
        $role = Roles::where('id', (int)$request->id)->first() ?? [];

        return view('admin.permission.role.roleform', compact('role'));
    }
}
