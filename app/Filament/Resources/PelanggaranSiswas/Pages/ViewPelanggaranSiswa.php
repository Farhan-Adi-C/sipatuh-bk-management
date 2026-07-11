<?php

namespace App\Filament\Resources\PelanggaranSiswas\Pages;

use App\Filament\Resources\PelanggaranSiswas\PelanggaranSiswaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPelanggaranSiswa extends ViewRecord
{
    protected static string $resource = PelanggaranSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
