<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthorizationRequest;

class AuthorizationsController extends BaseController
{
    public function store(AuthorizationRequest $request)
    {
        if (! $token = auth('api')->attempt(request(['email', 'password']))) {
            return $this->response->array(['email' => '账号或密码错误'])->setStatusCode(422);
        }

        return $this->responseSuccessLogin($token);
    }


    protected function responseSuccessLogin($token)
    {
        return $this->response->created(null, [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
