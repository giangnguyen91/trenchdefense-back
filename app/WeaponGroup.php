<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/7/18
 * Time: 14:19
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class WeaponGroup extends Model
{
    const GRID_ID = 2137758930;

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
            $json['ammo_type'] = $json['2'];
            unset($json[2]);
        }
        return collect([(new static())->forceFill($json)]);
    }

}