<?php

namespace App\Filament\Pages\Widgets;

use App\Models\RewardSiswa;
use Filament\Widgets\ChartWidget;
 

class TopRewardSiswa extends ChartWidget
{
    protected ?string $heading = 'Siswa Dengan Reward Terbanyak';
    // protected ?string $maxHeight = "500";


   protected function getData(): array
    {
        $data = RewardSiswa::query()
            ->selectRaw('siswa_id, COUNT(*) as total')
            ->with('siswa:id,name')
            ->groupBy('siswa_id')
            ->orderBy('total')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Reward',
                    'data' => $data->pluck('total'),
                    'borderColor' => '#22bb33',
                    'backgroundColor' => 'rgba(10, 245, 57, 0.1)',
                ],
            ],
            'labels' => $data->map(fn ($item) => $item->siswa->name ?? 'Unknown'),
        ];
    }



    

    protected function getType(): string
    {
        return 'bar';
    }
}
