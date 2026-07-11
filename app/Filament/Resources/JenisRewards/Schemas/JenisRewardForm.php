<?php

namespace App\Filament\Resources\JenisRewards\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JenisRewardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_reward')
                    ->required(),
                TextInput::make('poin')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
