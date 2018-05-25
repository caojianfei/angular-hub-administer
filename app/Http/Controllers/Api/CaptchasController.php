<?php

namespace App\Http\Controllers\Api;


use Gregwar\Captcha\CaptchaBuilder;

class CaptchasController extends BaseController
{
    /**
     * 获取验证码
     *
     * @param CaptchaBuilder $captchaBuilder
     * @return \Dingo\Api\Http\Response
     * @throws \Exception
     */
    public function store(CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-' . str_random();

        $captcha = $captchaBuilder->build();
        $expire_at = now()->addMinutes(2);

        cache()->put($key, [
            'code' => $captcha->getPhrase()
        ], $expire_at);

        return $this->response->created(null, [
            'captcha_key' => $key,
            'expired_at' => $expire_at->toDateTimeString(),
            'captcha_image_content' => $captcha->inline()
        ]);
    }

}
