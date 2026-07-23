<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisReward extends Model
{
    protected $guarded = [];

    public function reward_siswas() {
        return $this->hasMany(RewardSiswa::class);
    }
}
