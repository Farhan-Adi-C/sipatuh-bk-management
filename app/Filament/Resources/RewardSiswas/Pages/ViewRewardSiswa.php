<?php

namespace App\Filament\Resources\RewardSiswas\Pages;

use App\Filament\Resources\RewardSiswas\RewardSiswaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRewardSiswa extends ViewRecord
{
    protected static string $resource = RewardSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
