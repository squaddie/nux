<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models\User
 * @property int $id
 * @property string user_name
 * @property int phone_number
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /** @var string[] $fillable */
    protected $fillable = [
        'user_name',
        'phone_number',
    ];
    /** @var string[] $hidden */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /** @var string[] $casts */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
