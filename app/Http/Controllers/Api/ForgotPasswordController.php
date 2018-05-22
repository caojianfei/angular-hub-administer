<?php

namespace App\Http\Controllers\Api;

use Dingo\Api\Exception\ResourceException;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Api\ForgotPasswordRequest;

class ForgotPasswordController extends BaseController
{
    /**
     * @param ForgotPasswordRequest $request
     * @return \Dingo\Api\Http\Response
     * @throws \ErrorException
     */
    public function sendEmailToken(ForgotPasswordRequest $request)
    {
        $response = Password::broker()->sendResetLink(request(['email']));

        return $response === Password::RESET_LINK_SENT
            ? $this->response->created()
            : $this->sendFailResponse($response);
    }

    protected function sendFailResponse($response)
    {
        throw new ResourceException("email 发送失败", ['email' => trans($response)]);
    }

}
