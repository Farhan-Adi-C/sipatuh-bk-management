<?php

namespace App\Filament\Resources\JenisRewards\Pages;

use App\Filament\Resources\JenisRewards\JenisRewardResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewJenisReward extends ViewRecord
{
    protected static string $resource = JenisRewardResource::class;
public function getTitle(): string | Htmlable
    {
        return 'Detail Jenis Reward';
    }
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
