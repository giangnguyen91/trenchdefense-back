<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Weapon extends Model
{
    const GRID_ID = 1055890663;

    /**
     * @param array $json
     * @return Collection|Model
     */
    public static function fromCsvArray(array $json): Collection
    {
        if (isset($json['0'])) {
            $json['id'] = $json['0'];
            unset($json[0]);
        }

        if (isset($json['1'])) {
            $json['name'] = $json['1'];
            unset($json[1]);
        }

        if (isset($json['2'])) {
            $json['damage'] = $json['2'];
            unset($json[2]);
        }

        if (isset($json['3'])) {
            $json['weapon_group_id'] = $json['3'];
            unset($json[3]);
        }
        if (isset($json['4'])) {
            $json['resource_id'] = $json['4'];
            unset($json[4]);
        }
        if (isset($json['5'])) {
            $json['mag_capacity'] = $json['5'];
            unset($json[5]);
        }
        if (isset($json['6'])) {
            $json['fire_speed'] = $json['6'];
            unset($json[6]);
        }
        if (isset($json['7'])) {
            $json['range'] = $json['7'];
            unset($json[7]);
        }
        if (isset($json['8'])) {
            $json['throwable'] = $json['8'];
            unset($json[8]);
        }

        return collect([(new static())->forceFill($json)]);
    }

    public function weaponGroup()
    {
        return $this->belongsTo('App\WeaponGroup', 'weapon_group_id', 'id');
    }
}
