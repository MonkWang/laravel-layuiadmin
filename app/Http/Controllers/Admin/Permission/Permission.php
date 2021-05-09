<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Models\Permissions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

    public function adminform(Request $request)
    {
        if($request->method() == 'POST'){
            $this->selfValidator($request->all(), [
                'name' => 'required',
                'route' => 'required',
                'guard_name' => 'required|in:web,merchant,store'
            ], ['name'=>'权限名称', 'route'=>'路由地址', 'guard_name'=>'平台']);

            $model = $request->id ? Permissions::where('id', $request->id) : new Permissions();
            $model->name = $request->input('name');
            $model->route = $request->route;
            $model->guard_name = $request->guard_name;

            if($model->save()){
                return $this->returnMsg(200, '编辑成功');
            } else {
                return $this->returnMsg(400, '编辑失败');
            }
        }

        $permission = $request->id ? Permissions::where('id', $request->id)->first() : [];
        return view('admin.permission.permission.adminform', compact('permission'));
    }

    public function list(Request $request)
    {
        if($request->method() == 'POST'){
            $base = new Permissions();
            if($request->name){
                $base = $base->where('name', $request->name);
            }
            $count = $base->count();
            $data = $base->get();

            return $this->returnTable($count, $data);
        }

        return view('admin.permission.permission.list');
    }

    public function delete(Request $request)
    {

    }
}
