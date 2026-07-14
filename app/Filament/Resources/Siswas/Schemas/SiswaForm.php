<?php

namespace App\Filament\Resources\Siswas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label("Nama")
                    ->required(),
                TextInput::make('nisn')
                    ->required()
                    ->label("NISN")
                    ->numeric()
                    ->unique(table:"siswas", column:"nisn")
                    ->validationMessages([
        'unique' => 'NISN sudah digunakan siswa lain.',
    ]),
                Select::make('kelas_id')
                ->relationship(
                    name: 'kelas',       // Nama fungsi relasi di model Siswa (public function kelas())
                    titleAttribute: 'name' // Kolom dari tabel kelas yang ingin ditampilkan di dropdown
                )
                ->label('Kelas')
                ->searchable() // Opsional: Agar pilihan kelas bisa dicari dengan mengetik teks
                ->preload()    // Opsional: Memuat data kelas di awal agar dropdown terasa instan/cepat
                ->required(),
                Select::make('gender')
                    ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])
                    ->required(),
                TextInput::make('agama'),
                Textarea::make('alamat')
                    ->columnSpanFull(),
            ]);
    }
}
