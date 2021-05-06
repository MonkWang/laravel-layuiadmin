<?php

namespace App\Http\Controllers\Admin\Set;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class System extends Controller
{
    public function website()
    {
        return view('admin.set.system.website');
    }
}
