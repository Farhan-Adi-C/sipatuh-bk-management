<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    public $guarded = [];

    public function kelas(): BelongsTo
{
    return $this->belongsTo(Kelas::class);
}

public function getRouteKeyName(): string
    {
        return 'nisn';
    }

public function pelanggarans(): HasMany
{
    return $this->hasMany(PelanggaranSiswa::class);
}

public function rewards(): HasMany 
{ 
    return $this->hasMany(RewardSiswa::class);
}

}
