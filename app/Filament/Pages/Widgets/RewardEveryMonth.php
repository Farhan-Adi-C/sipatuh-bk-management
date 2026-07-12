<?php

namespace App\Filament\Pages\Widgets;

use App\Models\PelanggaranSiswa;
use App\Models\RewardSiswa;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RewardEveryMonth extends ChartWidget
{
    protected ?string $heading = 'Tren Reward Siswa (6 Bulan Terakhir)';
    protected ?string $maxHeight = "500";
protected bool $isCollapsible = true;

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i)->startOfMonth());

        $counts = RewardSiswa::selectRaw("DATE_FORMAT(tanggal_reward, '%Y-%m') as month, COUNT(*) as total")
            ->whereNotNull('tanggal_reward')
            ->where('tanggal_reward', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month')
            ->pluck('total', 'month');

        $data = $months->map(fn (Carbon $month) => $counts->get($month->format('Y-m'), 0));
        $labels = $months->map(fn (Carbon $month) => $month->translatedFormat('M Y'));

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Reward',
                    'data' => $data,
                    'borderColor' => '#22bb33',
                    'backgroundColor' => 'rgba(10, 245, 57, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }


    

    protected function getType(): string
    {
        return 'line';
    }
}
