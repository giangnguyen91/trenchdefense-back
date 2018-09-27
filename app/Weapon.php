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

        return collect([(new static())->forceFill($json)]);
    }

    public function weaponGroup()
    {
        return $this->belongsTo('App\WeaponGroup', 'weapon_group_id', 'id');
    }
}
