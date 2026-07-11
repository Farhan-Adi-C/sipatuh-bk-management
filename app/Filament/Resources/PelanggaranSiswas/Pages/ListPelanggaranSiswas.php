<?php

namespace App\Filament\Resources\PelanggaranSiswas\Pages;

use App\Filament\Resources\PelanggaranSiswas\PelanggaranSiswaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPelanggaranSiswas extends ListRecords
{
    protected static string $resource = PelanggaranSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
