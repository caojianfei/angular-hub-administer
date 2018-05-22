<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Api\ResetPasswordRequest;
use Dingo\Api\Exception\UpdateResourceFailedException;

class ResetPasswordController extends BaseController
{
    /**
     * 重置密码
     *
     * @param ResetPasswordRequest $request
     * @return mixed
     */
    public function reset(ResetPasswordRequest $request)
    {

        $response = Password::broker('api-users')->reset(
            request(['email', 'password', 'password_confirmation', 'token']), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetPasswordResponse()
                    : $this->sendFailedResetPasswordResponse($response);

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

    /**
     * 密码成功重置
     *
     * @return array
     */
    protected function sendResetPasswordResponse()
    {
        return [];
    }

    /**
     * 密码重置失败
     *
     * @param $response
     */
    protected function sendFailedResetPasswordResponse($response)
    {
        throw new UpdateResourceFailedException("密码重置失败", ['email' => trans($response)]);
    }
}
