<?php

namespace App\Filament\Resources\PelanggaranSiswas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PelanggaranSiswaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Detail Pelanggaran Siswa")
                ->columnSpanFull()
                ->schema([
            Grid::make(2)
            ->schema([

                TextEntry::make('siswa.name')
                    ->label('Nama Siswa')
                    ->weight("bold"),
                TextEntry::make('jenis_pelanggaran.nama_pelanggaran')
                    ->label('Jenis Pelanggaran'),
                TextEntry::make('tanggal_pelanggaran')
                    ->date()
                    ->placeholder('-'),
                    TextEntry::make("jenis_pelanggaran.poin")
                    ->label("Poin Pelanggaran")
                    ->badge()
                    ->color("danger"),
            ]),
                ]),
            ]);
    }
}
