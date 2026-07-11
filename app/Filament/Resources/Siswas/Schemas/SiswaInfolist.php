<?php

namespace App\Filament\Resources\Siswas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiswaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->columns(1)
            ->components([
                Section::make('Data Pribadi')
                ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nama'),

                                 TextEntry::make('kelas.name')
                                    ->label('Kelas')
                                    ->badge()
                                    ->placeholder('Belum ada kelas'),

                                TextEntry::make('nisn')
                                    ->label('NISN'),

                                TextEntry::make('gender')
                                    ->label('Jenis Kelamin')
                                    ->badge()
                                    ->color(fn (string $state): string => $state === 'L' ? 'info' : 'danger')
                                    ->formatStateUsing(fn (string $state): string => $state === 'L' ? 'Laki-laki' : 'Perempuan'),

                                TextEntry::make('agama')
                                    ->label('Agama'),

                              
                            ]),
                    ]),

               
            ]);
    }
}