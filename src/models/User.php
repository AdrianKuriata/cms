<?php

namespace Akuriatadev\Wordit\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'root'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group() {
        return $this->belongsTo('Akuriatadev\Wordit\Models\Group');
    }

    public function hasPermission($perm) {
        return $this->group->permission->{$perm};
    }

    public function scopeWithoutRoots($query)
    {
        return $query->whereNotIn('id', config('wordit.not_users_array'));
    }
}
