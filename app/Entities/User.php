<?php

namespace App\Entities;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Model implements Transformable
{
    use  HasFactory, Notifiable, TransformableTrait, HasApiTokens;
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone',  'address', 'email', 'invite_code', 'status',
        'email_verified_at', 'active_at', 'api_token', 'password'
    ];

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
