<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\Api\RegisterRequest;
use Dingo\Api\Exception\StoreResourceFailedException;

class RegisterController extends BaseController
{
    /**
     * 用户注册
     *
     * @param RegisterRequest $request
     * @return \Dingo\Api\Http\Response
     * @throws \Exception
     */
    public function store(RegisterRequest $request)
    {
        $verify_data = cache($request->captch_key);

        if (!$verify_data) {
            throw new StoreResourceFailedException('验证码已过期');
        }

        if (! hash_equals($request->captch, $verify_data['code'])) {
            throw new StoreResourceFailedException('验证码错误');
        }

        // 清除验证码
        cache()->forget($request->captch_key);

        // 创建用户
        User::create(\request(['name', 'email', 'password']));

        return $this->response->created();
    }
}
