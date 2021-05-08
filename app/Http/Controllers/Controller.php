<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->menus();
    }

    public function selfValidator(array $data, array $rule, array $attr)
    {

        $validator = Validator::make($data, $rule, [], $attr);
        if($validator->fails()){
            $response = new JsonResponse(['code'=>400, 'msg'=>$validator->messageTag()->first()], 401);
            throw new HttpResponseException($response);
        }
    }

    public function returnJson(array $data)
    {
        return response()->json($data);
    }

    public function menus()
    {
        $admin = Auth::guard('admin')->user();
        if(!$admin){
            $merchant = Auth::guard('merchant')->user();
            if(!$merchant){
                $store = Auth::guard('store')->user();
                if(!$store){
                    $guard = false;
                } else {
                    $guard = 'store';
                }
            } else {
                $guard = 'merchant';
            }
        } else {
            $guard = 'web';
        }

        if($guard){
            $menus = Permissions::with('child_hasMany')
                ->where('is_menus', 1)
                ->where('pid', 0)
                ->where('guard_name', $guard)
                ->where('show', 1)
                ->get();;
        } else {
            $menus = [];
        }
        view()->share('menus', $menus);
    }
}
