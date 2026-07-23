<?php

namespace App\Filament\Resources\JenisRewards\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JenisRewardInfolist
{



    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->columns(1)
            ->components([
                Section::make('Jenis Reward')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('nama_reward')
                                    ->label('Nama Reward')
                                    ->weight("bold"),

                                TextEntry::make('poin')
                                    ->label('Poin')
                                    ->badge()
                                    ->color("success"),
                            ]),
                    ]),


            ]);
    }
}
