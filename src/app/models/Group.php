<?php

namespace Akuriatadev\Wordit\App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->hasMany('Akuriatadev\Wordit\App\Models\User');
    }

    public function permission()
    {
        return $this->hasOne('Akuriatadev\Wordit\App\Models\Permission');
    }

    public function scopeWithoutRoots($query)
    {
        return $query->whereNotIn('id', config('wordit.not_groups_array'));
    }
}
