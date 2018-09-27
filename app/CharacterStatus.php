<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterStatus extends Model
{
    protected $casts = [
        'weapon' => 'array'
    ];
}
