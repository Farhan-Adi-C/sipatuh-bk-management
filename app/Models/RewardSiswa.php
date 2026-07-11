<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardSiswa extends Model
{
    protected $guarded = [];


    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function jenis_reward() {
        return $this->belongsTo(JenisReward::class);
    }
}
