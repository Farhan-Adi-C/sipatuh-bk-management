<?php

namespace App\Filament\Resources\PelanggaranSiswas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PelanggaranSiswaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('siswa.name')
                    ->label('Siswa'),
                TextEntry::make('jenis_pelanggaran.nama_pelanggaran')
                    ->label('pelanggaran'),
                TextEntry::make('tanggal_pelanggaran')
                    ->date()
                    ->placeholder('-'),
                    TextEntry::make("jenis_pelanggaran.poin")
                    ->label("Poin Pelanggaran")
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
