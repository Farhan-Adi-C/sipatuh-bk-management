<?php

namespace App\Filament\Resources\JenisPelanggarans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JenisPelanggaranInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Jenis Pelanggaran')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('nama_pelanggaran')
                                    ->label('Nama Pelanggaran')
                                    ->weight("bold"),

                                TextEntry::make('poin')
                                    ->label('Poin')
                                    ->badge()
                                    ->color("danger"),

                                TextEntry::make('kategori')
                                    ->label("Kategori")
                                    ->badge()
                                    ->placeholder('Tidak Berkategori')
                                    ->color(fn(string $state): string => match ($state) {
                                        "Pelanggaran Ringan" => "info",
                                        "Pelanggaran Sedang" => "warning",
                                        "Pelanggaran Berat" => "danger",
                                        default => "gray"
                                    }),
                                TextEntry::make("tindakan")



                            ]),
                    ]),


            ]);
    }
}
