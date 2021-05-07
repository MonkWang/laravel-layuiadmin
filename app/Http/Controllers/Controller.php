<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
}
