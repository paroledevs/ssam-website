<?php

namespace App\Models;

use App\Asteroide\Traits\FileUrls;
use App\Models\Accessors\UserAccessors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory,
        Notifiable,
        FileUrls,
        UserAccessors;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_path',
        'role',
        'receive_notifications',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role',
        'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function hasAdminRoleLevel()
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }

    public function scopeWithoutSuperAdmins($query)
    {
        return $query->where('role', '<>', 'super_admin');
    }

    public function scopeNotifyEmails($query)
    {
        return $query->where('receive_notifications', true)
            ->get()
            ->map(function ($user) {
                return $user->email;
            })
            ->all();
    }
}
