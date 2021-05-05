<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdministratorsController extends Controller
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
        return view('user.administrators.adminform');
    }

    public function list()
    {
        return view('user.administrators.list');
    }

    public function role()
    {
        return view('user.administrators.role');
    }

    public function roleform(Request $request)
    {
        if($request->method() == 'POST'){
            $this->selfValidator($request->all(), [
                'descr' => 'required|string',
                'rolename' => 'required|int|min:0',
            ]);

        }
        return view('user.administrators.roleform');
    }
}
