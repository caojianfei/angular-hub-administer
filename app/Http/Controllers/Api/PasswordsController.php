<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\User;
use Dingo\Api\Exception\ResourceException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Api\PasswordRequest;
use Illuminate\Support\Str;

class PasswordsController extends BaseController
{
    /**
     * 发送验证 token
     *
     * @param PasswordRequest $request
     * @return mixed
     */
    public function store(PasswordRequest $request)
    {
        $response = $this->broker()->sendResetLink(request(['email']));

        return $response === Password::RESET_LINK_SENT
            ? $this->response->created()
            : $this->sendFailSendEmailResponse($response);
    }

    /**
     * 更新密码
     *
     * @param PasswordRequest $request
     * @return mixed
     */
    public function update(PasswordRequest $request)
    {
        $response = $this->broker()->reset(
            request(['email', 'password', 'password_confirmation', 'token']),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->response->noContent()
            : $this->sendFailedResetPasswordResponse($response);
    }

    protected function sendFailSendEmailResponse($response)
    {
        throw new ResourceException(null, ['email' => trans($response)]);
    }

    /**
     * 密码重置
     *
     * @param User $user
     * @param $password
     */
    protected function resetPassword(User $user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
    }

    protected function sendFailedResetPasswordResponse($response)
    {
        throw new UpdateResourceFailedException(null, ['email' => trans($response)]);
    }


    protected function broker()
    {
        return Password::broker('api-users');
    }
}
