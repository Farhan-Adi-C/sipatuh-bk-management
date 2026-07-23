<?php

namespace App\Filament\Resources\RewardSiswas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RewardSiswaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Detail Reward Siswa")
                ->columnSpanFull()
                ->schema([
                    Grid::make(2)
                    ->schema([

                        TextEntry::make('siswa.name')
                            ->label("Nama Siswa")
                            ->weight("bold")
                        ,
                        TextEntry::make('jenis_reward.nama_reward')
                            ->label("Jenis Reward"),
                        TextEntry::make('tanggal_reward')
                            ->date()
                            ->placeholder('-'),
                        
                    ])
                ]),
            ]);
    }
}
