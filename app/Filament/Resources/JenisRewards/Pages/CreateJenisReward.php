<?php

namespace App\Filament\Resources\JenisRewards\Pages;

use App\Filament\Resources\JenisRewards\JenisRewardResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisReward extends CreateRecord
{
    protected static string $resource = JenisRewardResource::class;

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl("index");

    }
}
