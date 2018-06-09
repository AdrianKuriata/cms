<?php

namespace Akuriatadev\Wordit\App\Models;

use Illuminate\Database\Eloquent\Model;
use Akuriatadev\Wordit\App\Traits\WorditTrait;

class Permission extends Model
{
    use WorditTrait;

    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo('Akuriatadev\Wordit\App\Models\Group');
    }
}
