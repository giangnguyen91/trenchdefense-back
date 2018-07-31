<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Zombie
 * @property int $id
 * @property string $name
 * @property integer $damage
 * @property integer $hp
 * @property integer $speed
 * @property integer $armor
 * @package App\Eloquents
 */
class Zombie extends Model
{
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zombies';
}
