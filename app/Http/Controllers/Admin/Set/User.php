<?php

namespace App\Http\Controllers\Admin\Set;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class User extends Controller
{
    public function info()
    {
        return view('admin.set.user.info');
    }

    public function password()
    {
        return view('admin.set.user.password');
    }
}
