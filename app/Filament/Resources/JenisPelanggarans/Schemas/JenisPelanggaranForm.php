<?php

namespace App\Filament\Resources\JenisPelanggarans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JenisPelanggaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_pelanggaran')
                    ->required(),
                TextInput::make('poin')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make("kategori")
                    ->options([
                        "Pelanggaran Ringan" => "Pelanggaran Ringan",
                        "Pelanggaran Sedang" => "Pelanggaran Sedang",
                        "Pelanggaran Berat" => "Pelanggaran Berat",
                    ]),
                Textarea::make("tindakan")
                    ->label("Tindakan")
                    ->nullable()

            ]);
    }
}
