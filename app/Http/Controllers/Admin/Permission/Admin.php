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
                'status'=> 'required'
            ]);
        }
        return view('admin.permission.admin.adminform');
    }
}
