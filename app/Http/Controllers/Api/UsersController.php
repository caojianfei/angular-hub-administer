<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\User;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\UserRequest;
use Dingo\Api\Exception\ValidationHttpException;

class UsersController extends BaseController
{

    public function __construct()
    {
        $this->middleware('api.auth')->except('store');
    }

    /**
     * 用户注册
     *
     * @param UserRequest $request
     * @return \Dingo\Api\Http\Response
     * @throws \Exception
     */
    public function store(UserRequest $request)
    {
        $verify_data = cache($request->captch_key);

        if (!$verify_data) {
            throw new ValidationHttpException(['captch' => trans('business.verification_code.expired')]);
        }

        if (!hash_equals(strtolower($request->captch), strtolower($verify_data['code']))) {
            throw new ValidationHttpException(['captch' => trans('business.verification_code.error')]);
        }

        // 清除验证码
        cache()->forget($request->captch_key);

        // 创建用户
        $user = User::create(request(['name', 'email', 'password']));

        return $this->responseUserRegistered($user);
    }

    /**
     * 请求当前登录用户资源
     *
     * @return \Dingo\Api\Http\Response
     */
    public function me()
    {
        return $this->response->item(auth('api')->user(), new UserTransformer());
    }


    /**
     * 响应用户注册成功
     *
     * @param $user
     * @return \Dingo\Api\Http\Response
     */
    protected function responseUserRegistered($user)
    {
        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            ]);
    }
}
