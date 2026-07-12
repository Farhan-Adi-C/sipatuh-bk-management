<?php

namespace App\Filament\Pages\Widgets;

use App\Models\PelanggaranSiswa;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PelanggaranEveryMonth extends ChartWidget
{
    protected ?string $heading = 'Tren Pelanggaran Siswa (6 Bulan Terakhir)';
protected bool $isCollapsible = true;
    protected ?string $maxHeight = "500";

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i)->startOfMonth());

        $counts = PelanggaranSiswa::selectRaw("DATE_FORMAT(tanggal_pelanggaran, '%Y-%m') as month, COUNT(*) as total")
            ->whereNotNull('tanggal_pelanggaran')
            ->where('tanggal_pelanggaran', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month')
            ->pluck('total', 'month');

        $data = $months->map(fn (Carbon $month) => $counts->get($month->format('Y-m'), 0));
        $labels = $months->map(fn (Carbon $month) => $month->translatedFormat('M Y'));

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pelanggaran',
                    'data' => $data,
                    'borderColor' => 'rgba(255, 104, 56, 1)',
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
