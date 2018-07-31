<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
    const GID_ID = 1833784483;

    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zombies';

    /**
     * @param array $json
     * @return Collection|Model
     */
    public static function fromCsvArray(array $json): Collection
    {
        $cols = [
            'name', 'damage', 'hp', 'speed', 'armor'
        ];

        $colLength = count($cols);
        for ($i = 0; $i < $colLength; $i++) {
            if (isset($json[$i])) {
                $json[$cols[$i]] = $json[$i];
                unset($json[$i]);
            }
        }

        return collect([(new static())->forceFill($json)]);
    }
}
