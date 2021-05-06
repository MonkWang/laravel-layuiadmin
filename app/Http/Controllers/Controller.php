<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function selfValidator(array $data, array $rule, arr $attr)
    {
        $validator = $this->validate($data, $rule, [], $attr);
        if($validator->fails()){
            $response = new JsonResponse(['code'=>400, 'msg'=>$validator->messageTag()->first()], 401);
            throw new HttpResponseException($response);
        }
    }
}
