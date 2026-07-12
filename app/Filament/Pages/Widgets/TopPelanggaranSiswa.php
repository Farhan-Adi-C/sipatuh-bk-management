<?php

namespace App\Filament\Pages\Widgets;

use App\Models\PelanggaranSiswa;
 
use Filament\Widgets\ChartWidget;
 

class TopPelanggaranSiswa extends ChartWidget
{
    protected ?string $heading = 'Siswa Dengan Pelanggaran Terbanyak';
    // protected ?string $maxHeight = "500";


   protected function getData(): array
    {
        $data = PelanggaranSiswa::query()
            ->selectRaw('siswa_id, COUNT(*) as total')
            ->with('siswa:id,name') // sesuaikan nama kolom (nama/nama_siswa/dll)
            ->groupBy('siswa_id')
            ->orderBy('total')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pelanggaran',
                    'data' => $data->pluck('total'),
                    'borderColor' => '#ef4444',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
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
