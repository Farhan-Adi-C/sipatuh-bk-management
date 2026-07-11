<?php

namespace App\Filament\Resources\RewardSiswas\Pages;

use App\Filament\Resources\RewardSiswas\RewardSiswaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRewardSiswa extends CreateRecord
{
    protected static string $resource = RewardSiswaResource::class;

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl("index");

    }
}
