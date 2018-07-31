<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Weapon extends Model
{
    const GID_ID = 1055890663;

    /**
     * @param array $json
     * @return Collection|Model
     */
    public static function fromCsvArray(array $json): Collection
    {
        if (isset($json['0'])) {
            $json['name'] = $json['0'];
            unset($json[0]);
        }


        if (isset($json['1'])) {
            $json['damage'] = $json['1'];
            unset($json[1]);
        }

        if (isset($json['2'])) {
            $json['reload_speed'] = $json['2'];
            unset($json[2]);
        }

        if (isset($json['3'])) {
            $json['shot_speed'] = $json['3'];
            unset($json[3]);
        }

        if (isset($json['4'])) {
            $json['delay_time'] = $json['4'];
            unset($json[4]);
        }

        if (isset($json['5'])) {
            $json['id'] = $json['5'];
            unset($json[5]);
        }
        if (isset($json['6'])) {
            $json['resource_id'] = $json['6'];
            unset($json[6]);
        }

        return collect([(new static())->forceFill($json)]);
    }
}
