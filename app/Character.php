<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Character extends Model
{
    const GRID_ID = 993827753;

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
            $json['hp'] = $json['1'];
            unset($json[1]);
        }

        if (isset($json['2'])) {
            $json['speed'] = $json['2'];
            unset($json[2]);
        }

        if (isset($json['3'])) {
            $json['attack'] = $json['3'];
            unset($json[3]);
        }

        if (isset($json['4'])) {
            $json['id'] = $json['4'];
            unset($json[4]);
        }
        if (isset($json['5'])) {
            $json['resource_id'] = $json['5'];
            unset($json[5]);
        }
        return collect([(new static())->forceFill($json)]);
    }
}
