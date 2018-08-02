<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthorizationRequest;
use Dingo\Api\Exception\ValidationHttpException;

class AuthorizationsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('store');
    }

    /**
     * 用户登录
     *
     * @param AuthorizationRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(AuthorizationRequest $request)
    {
        if (! $token = auth('api')->attempt(request(['email', 'password']))) {
            throw new ValidationHttpException(['email' => trans('auth.failed')]);
        }

        return $this->responseSuccessLogin($token);
    }

    /**
     * 退出登录
     *
     * @return \Dingo\Api\Http\Response
     */
    public function destroy()
    {
        auth('api')->logout();

        return $this->response->noContent();
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
