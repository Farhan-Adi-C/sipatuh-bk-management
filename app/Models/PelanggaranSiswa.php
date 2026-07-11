<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelanggaranSiswa extends Model
{
    protected $casts = [
        'tanggal' => 'date',
        'poin' => 'integer',
    ];

    public $guarded = [];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function jenis_pelanggaran(): BelongsTo
    {
        return $this->belongsTo(JenisPelanggaran::class);
    }
}
