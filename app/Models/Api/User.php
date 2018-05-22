<?php

namespace App\Models\Api;

use App\Notifications\ResetPasswordForApi;
use Illuminate\Database\Eloquent\Model;

class User extends \App\Models\User
{
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordForApi($token));
    }
}
