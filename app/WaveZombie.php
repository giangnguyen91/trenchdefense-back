<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class WaveZombie extends Model
{
    const GRID_ID = 171789648;

    /**
     * @param array $json
     * @return Collection|Model
     */
    public static function fromCsvArray(array $json): Collection
    {
        if (isset($json['0'])) {
            $json['wave_id'] = $json['0'];
            unset($json[0]);
        }

        if (isset($json['1'])) {
            $json['zombie_id'] = $json['1'];
            unset($json[1]);
        }

        if (isset($json['2'])) {
            $json['quantity'] = $json['2'];
            unset($json[2]);
        }

        return collect([(new static())->forceFill($json)]);
    }

    /**
     * Get the user that owns the phone.
     */
    public function wave()
    {
        return $this->belongsTo('App\Wave', 'wave_id');
    }

    /**
     * Get the user that owns the phone.
     */
    public function zombie()
    {
        return $this->belongsTo('App\Zombie', 'zombie_id');
    }
}
