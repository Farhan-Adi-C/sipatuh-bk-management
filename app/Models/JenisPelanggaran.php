<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPelanggaran extends Model
{
    protected $guarded = [];

    public function pelanggaran_siswas() {
        return $this->hasMany(PelanggaranSiswa::class);
    }
}
