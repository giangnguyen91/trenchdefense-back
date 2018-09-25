<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class GameSetting extends Model
{
    protected $casts = [
        'sfx' => 'boolean',
        'bgm' => 'boolean',
    ];
}
