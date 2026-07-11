<?php

namespace App\Filament\Resources\RewardSiswas\Pages;

use App\Filament\Resources\RewardSiswas\RewardSiswaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRewardSiswa extends EditRecord
{
    protected static string $resource = RewardSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
