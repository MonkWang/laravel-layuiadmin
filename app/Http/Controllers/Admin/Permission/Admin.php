<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function list(Request $request)
    {
        if($request->method() == 'POST'){
            $base = new \App\Models\Admin();
            $count = $base->count();
            $data = $base->get();
            return response()->json(['code'=>0, 'count'=>$count, 'data'=>$data]);
        }
        return view('admin.permission.admin.list');
    }

    public function adminform(Request $request)
    {
        if($request->method() == 'POST'){
            $this->selfValidator($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'role' => 'required',
//                'status'=> 'required'
            ], []);
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'email' => $request ->email,
                'role' => $request->role,
                'status' => $request->status ?:0,
            ];
            \App\Models\Admin::insert($data);
            return response()->json(['code'=>200, 'msg'=>'添加成功']);
        }
        return view('admin.permission.admin.adminform');
    }
}
