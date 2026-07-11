<?php

namespace App\Filament\Resources\PelanggaranSiswas\Pages;

use App\Filament\Resources\PelanggaranSiswas\PelanggaranSiswaResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePelanggaranSiswa extends CreateRecord
{
    protected static string $resource = PelanggaranSiswaResource::class;
    
     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl("index");

    }
}
