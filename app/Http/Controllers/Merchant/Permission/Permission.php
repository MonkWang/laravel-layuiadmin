<?php

namespace App\Http\Controllers\Merchant\Permission;

use App\Models\Permissions;
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

    public function list(Request $request)
    {
        if($request->method() == 'POST'){
            $base = new Permissions();
            $count = $base->count();
            $data = $base->get();

            return $this->returnTable($count, $data);
        }

        return view('admin.permission.permission.list');
    }
}
