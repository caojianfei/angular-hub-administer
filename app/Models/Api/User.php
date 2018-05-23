<?php

namespace App\Models\Api;

use App\Notifications\ResetPasswordForApi;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Api\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Api\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Api\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Api\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Api\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Api\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Api\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Api\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends \App\Models\User
{
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordForApi($token));
    }
}
