<?php

namespace App\Filament\Resources\PelanggaranSiswas\Pages;

use App\Filament\Resources\PelanggaranSiswas\PelanggaranSiswaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPelanggaranSiswa extends EditRecord
{
    protected static string $resource = PelanggaranSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
