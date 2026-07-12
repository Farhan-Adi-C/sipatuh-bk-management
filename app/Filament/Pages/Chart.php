<?php

namespace App\Filament\Pages;

// use App\Filament\Pages\Widgets\PelanggaranEveryMonth;
use App\Filament\Pages\Widgets\PelanggaranEveryMonth;
use App\Filament\Pages\Widgets\RewardEveryMonth;
use App\Filament\Pages\Widgets\TopPelanggaranSiswa;
use App\Filament\Pages\Widgets\TopRewardSiswa;
use BackedEnum;
use Filament\Pages\Page;
use Override;

class Chart extends Page
{
    protected string $view = 'filament.pages.chart';

    protected static string|BackedEnum|null $navigationIcon = "heroicon-o-chart-bar";
    
    #[Override]
    protected function getHeaderWidgets(): array
    {
        return [
            PelanggaranEveryMonth::class,
            RewardEveryMonth::class,
            TopPelanggaranSiswa::class,
            TopRewardSiswa::class
        ];
    }
}
