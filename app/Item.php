<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Item extends Model
{
    const GRID_ID = 1373960669;

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
            $json['type'] = $json['2'];
            unset($json[2]);
        }

        if (isset($json['3'])) {
            $json['count'] = $json['3'];
            unset($json[3]);
        }

        if (isset($json['4'])) {
            $json['resource_id'] = $json['4'];
            unset($json[4]);
        }
        return collect([(new static())->forceFill($json)]);
    }
}
