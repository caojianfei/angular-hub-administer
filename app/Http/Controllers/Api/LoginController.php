<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Lang;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends BaseController
{
    use ThrottlesLogins;

    /**
     * 用户登录
     *
     * @param LoginRequest $request
     * @return mixed|void
     * @throws \ErrorException
     */
    public function login(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $this->incrementLoginAttempts($request);

        if (! $token = auth('api')->attempt(request(['email', 'password']))) {
            return $this->response->errorUnauthorized('账号或密码错误');
        }

        return $this->sendLoginResponse($request, $token);
    }

    /**
     * @param LoginRequest $request
     * @return mixed
     * @throws \ErrorException
     */
    protected function sendLockoutResponse(LoginRequest $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        return $this->response->array([
            $this->username() => [Lang::get('auth.throttle', ['seconds' => $seconds])]
        ])->setStatusCode(429);
    }

    /**
     * 登录成功响应
     *
     * @param $token
     * @return mixed
     * @throws \ErrorException
     */
    protected function sendLoginResponse(LoginRequest $request, $token)
    {
        $this->clearLoginAttempts($request);

        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expore_at' => now()->addMinute(auth('api')->factory()->getTTL())->toDateTimeString()
        ]);
    }

    public function username()
    {
        return 'email';
    }

}
