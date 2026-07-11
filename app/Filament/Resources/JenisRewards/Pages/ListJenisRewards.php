<?php

namespace App\Filament\Resources\JenisRewards\Pages;

use App\Filament\Resources\JenisRewards\JenisRewardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJenisRewards extends ListRecords
{
    protected static string $resource = JenisRewardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
