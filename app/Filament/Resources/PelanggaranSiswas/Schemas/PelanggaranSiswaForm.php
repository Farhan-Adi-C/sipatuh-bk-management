<?php

namespace App\Filament\Resources\PelanggaranSiswas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class PelanggaranSiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('siswa_id')
                    ->searchable()
                    ->relationship('siswa', 'name')
                    ->required(),
                Select::make('jenis_pelanggaran_id')
                    ->relationship( name:'jenis_pelanggaran', titleAttribute:'nama_pelanggaran')
                    ->required(),
                DatePicker::make('tanggal_pelanggaran')
                    ->required()
                    ->native(false)
                    ->prefixIcon(Heroicon::CalendarDays)
                    ->placeholder("Tanggal kejadian pelanggaran"),
            ]);
    }
}
