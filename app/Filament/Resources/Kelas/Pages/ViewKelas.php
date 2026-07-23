<?php

namespace App\Filament\Resources\Kelas\Pages;

use App\Filament\Resources\Kelas\KelasResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKelas extends ViewRecord
{
    protected static string $resource = KelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
           Action::make('exportPdf')
                ->label('Unduh Raport Kelas')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                     $record = $this->getRecord();
                     $record->load(['siswas.kelas', 'siswas.pelanggarans.jenis_pelanggaran', 'siswas.rewards.jenis_reward']);
                      $siswas = $record->siswas;

                      if ($siswas->isEmpty()) {
                            return;
                        }

                        $pdf = Pdf::loadView('pdf.raport-kedisiplinan', [
                            'siswas' => $siswas,
                        ])->setPaper('a4');

                        return response()->streamDownload(
                            fn() => print($pdf->output()),
                            'Raport-Kelas-' . str($record->name)->slug() . '-' . now()->format('Ymd') . '.pdf'
                        );
                })
                
        ];
    }
}
