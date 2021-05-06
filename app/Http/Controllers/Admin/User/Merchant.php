<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Merchant extends Controller
{
    public function list()
    {
        return view('admin.user.merchant.list');
    }
}
