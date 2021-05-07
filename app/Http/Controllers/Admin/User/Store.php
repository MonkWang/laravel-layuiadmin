<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Store extends Controller
{
    public function list(Request $request)
    {
        if($request->method() == 'POST'){
            $base = new \App\Models\Store();
            $count = $base->count();
            $data = $base->get();

            return response()->json(['code'=>0, 'data'=>$data, 'count'=>$count]);
        }

        return view('admin.user.store.list');
    }

    public function storeform(Request $request)
    {
        if($request->method() == 'POST'){

        }
        return view('admin.user.store.storeform');
    }
}
