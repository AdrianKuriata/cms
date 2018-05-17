<?php

namespace Akuriatadev\Wordit\Models;

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

    public function users() {
        return $this->hasMany('Akuriatadev\Wordit\Models\User');
    }

    public function permission() {
        return $this->hasOne('Akuriatadev\Wordit\Models\Permission');
    }
}
