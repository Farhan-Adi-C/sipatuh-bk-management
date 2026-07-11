<?php

namespace App\Filament\Resources\JenisRewards\Pages;

use App\Filament\Resources\JenisRewards\JenisRewardResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJenisReward extends ViewRecord
{
    protected static string $resource = JenisRewardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
