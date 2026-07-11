<?php

namespace App\Filament\Resources\JenisRewards\Pages;

use App\Filament\Resources\JenisRewards\JenisRewardResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditJenisReward extends EditRecord
{
    protected static string $resource = JenisRewardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
