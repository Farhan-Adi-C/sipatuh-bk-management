<?php

namespace App\Filament\Widgets;

use App\Models\PelanggaranSiswa;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PelanggaranEveryMonth extends ChartWidget
{
    protected ?string $heading = 'Pelanggaran Every Month';

    public static function canView(): bool
{
   
    return false; 
}

    protected function getData(): array
    {
        $months = collect(range(11, 0))->map(fn ($i) => now()->subMonths($i)->startOfMonth());

        $counts = PelanggaranSiswa::selectRaw("DATE_FORMAT(tanggal_pelanggaran, '%Y-%m') as month, COUNT(*) as total")
            ->whereNotNull('tanggal_pelanggaran')
            ->where('tanggal_pelanggaran', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->pluck('total', 'month');

        $data = $months->map(fn (Carbon $month) => $counts->get($month->format('Y-m'), 0));
        $labels = $months->map(fn (Carbon $month) => $month->translatedFormat('M Y'));

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pelanggaran',
                    'data' => $data,
                    'borderColor' => 'red',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
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
