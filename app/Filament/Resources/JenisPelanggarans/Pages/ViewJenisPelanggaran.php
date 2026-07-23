<?php

namespace App\Filament\Resources\JenisPelanggarans\Pages;

use App\Filament\Resources\JenisPelanggarans\JenisPelanggaranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewJenisPelanggaran extends ViewRecord
{
    protected static string $resource = JenisPelanggaranResource::class;

    public function getTitle(): string | Htmlable
    {
        return 'Detail Jenis Pelanggaran ';
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
