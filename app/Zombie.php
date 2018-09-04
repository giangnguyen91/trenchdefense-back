<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Zombie extends Model
{
    const GRID_ID = 1833784483;

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
            $json['hp'] = $json['2'];
            unset($json[2]);
        }

        if (isset($json['3'])) {
            $json['speed'] = $json['3'];
            unset($json[3]);
        }

        if (isset($json['4'])) {
            $json['attack'] = $json['4'];
            unset($json[4]);
        }
        if (isset($json['5'])) {
            $json['resource_id'] = $json['5'];
            unset($json[5]);
        }

        if (isset($json['6'])) {
            $json['id'] = $json['6'];
            unset($json[6]);
        }

        if (isset($json['7'])) {
            $json['drop_gold'] = $json['7'];
            unset($json[7]);
        }

        return collect([(new static())->forceFill($json)]);
    }
}
