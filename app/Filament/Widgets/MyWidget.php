<?php

namespace App\Filament\Widgets;

use App\Models\Kelas;
use App\Models\PelanggaranSiswa;
use App\Models\RewardSiswa;
use App\Models\Siswa;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MyWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Siswa', Siswa::count())
                ->icon('heroicon-o-user-group')
                ->color('primary')
                ->extraAttributes([
                    'class' => 'shadow-lg rounded-xl transition duration-300 hover:scale-105',
                ])
                ->chart([1, 1, 1, 1])
                ->color("primary"),

            Stat::make('Total Kelas', Kelas::count())
                ->icon('heroicon-o-building-office-2')
                ->chart([1, 1, 1, 1])
                ->color("warning")
                ->extraAttributes([
                    'class' => 'shadow-lg rounded-xl transition duration-300 hover:scale-105',
                ]),

            Stat::make('Total Pelanggaran', PelanggaranSiswa::count())
                ->icon('heroicon-o-exclamation-triangle')
                ->chart([1, 1, 1, 1])
                ->extraAttributes([
                    'class' => 'shadow-lg rounded-xl transition duration-300 hover:scale-105',
                ])
                ->color('danger'),

            Stat::make('Total Reward', RewardSiswa::count())
                ->icon('heroicon-o-trophy')
                ->chart([1, 1, 1, 1])
                ->extraAttributes([
                    'class' => 'shadow-lg rounded-xl transition duration-300 hover:scale-105',
                ])
                ->color('success'),
        ];
    }
}
