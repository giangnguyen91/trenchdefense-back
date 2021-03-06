<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DropItem extends Model
{
    const GRID_ID = 905398007;

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
            $json['zombie_id'] = $json['1'];
            unset($json[1]);
        }

        if (isset($json['2'])) {
            $json['item_id'] = $json['2'];
            unset($json[2]);
        }

        if (isset($json['3'])) {
            $json['drop_rate'] = $json['3'];
            unset($json[3]);
        }
        return collect([(new static())->forceFill($json)]);
    }
}
