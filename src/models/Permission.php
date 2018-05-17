<?php

namespace Akuriatadev\Wordit\Models;

use Illuminate\Database\Eloquent\Model;
use Akuriatadev\Wordit\Traits\WorditTrait;

class Permission extends Model
{
    use WorditTrait;

    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo('Akuriatadev\Wordit\Models\Group');
    }
}
