<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class Merchant extends Controller
{
    public function list(Request $request)
    {
        if($request->method() == 'POST'){
            $base = new \App\Models\Merchant();
            $count = $base->count();
            $data = $base->get()??[];

            return $this->returnTable($count, $data);
        }
        return view('admin.user.merchant.list');
    }

    public function merchantform(Request $request)
    {
        if($request->method() == 'POST'){
            $base = new \App\Models\Merchant();
            if($request->id){
                $base = $base->where('id', (int)$request->id)->first();
            }
            $base->name = $request->name;
//            $base->

            return $this->returnMsg(200, '保存成功');
        }

        return view('admin.user.merchant.userform');
    }
}
