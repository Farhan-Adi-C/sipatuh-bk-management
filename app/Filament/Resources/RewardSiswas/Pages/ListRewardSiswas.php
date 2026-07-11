<?php

namespace App\Filament\Resources\RewardSiswas\Pages;

use App\Filament\Resources\RewardSiswas\RewardSiswaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRewardSiswas extends ListRecords
{
    protected static string $resource = RewardSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
