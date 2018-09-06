<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Wave extends Model
{
    const GRID_ID = 1133912548;

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
            $json['id'] = $json['1'];
            unset($json[1]);
        }

        if (isset($json['2'])) {
            $json['resource_id'] = $json['2'];
            unset($json[2]);
        }

        return collect([(new static())->forceFill($json)]);
    }

    /**
     * Get the comments for the blog post.
     */
    public function waveZombies()
    {
        return $this->hasMany('App\WaveZombie', 'wave_id');
    }
}
