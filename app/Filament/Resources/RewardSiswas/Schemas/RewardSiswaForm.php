<?php

namespace App\Filament\Resources\RewardSiswas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class RewardSiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('siswa_id')
                    ->searchable()
                    ->required()
                    ->relationship(name: "siswa", titleAttribute: "name"),
                Select::make('jenis_reward_id')
                    ->required()
                    ->relationship(name: "jenis_reward", titleAttribute: "nama_reward"),
                DatePicker::make('tanggal_reward')
                 ->required()
                    ->native(false)
                    ->prefixIcon(Heroicon::CalendarDays)
                    ->placeholder("Tanggal diberikan reward"),
            ]);
    }
}
