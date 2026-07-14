<?php

namespace App\Filament\Resources\Siswas\Pages;

use App\Filament\Resources\Siswas\SiswaResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSiswa extends ViewRecord
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('exportPdf')
                ->label('Unduh Raport')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->action(function () {
                    // $this->record otomatis mengambil data model siswa yang sedang di-view
                    $record = $this->getRecord();
                    
                    $record->load(['kelas', 'pelanggarans.jenis_pelanggaran', 'rewards.jenis_reward']);
    
                    $pdf = Pdf::loadView('pdf.raport-kedisiplinan', [
                        'siswas' => collect([$record]),
                    ])->setPaper('a4');
    
                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        'Raport-' . str($record->name)->slug() . '.pdf'
                    );
                }),
        ];
    }
}
