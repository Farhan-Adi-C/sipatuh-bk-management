<?php

namespace App\Filament\Resources\Kelas\Tables;

use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KelasTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->heading("Data Kelas")
        ->description('Total: '.  Kelas::count() . ' Kelas')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make("siswas_count")
                    ->counts("siswas")
                    ->badge()
                    ->label("Total Siswa")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([

                    ViewAction::make(),
                    EditAction::make(),
                    Action::make('exportPdfKelas')
                    ->label('Unduh Raport Kelas')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function (Kelas $record) {
                        // Load data semua siswa yang berada di kelas ini beserta relasi raportnya
                        $record->load(['siswas.kelas', 'siswas.pelanggarans.jenis_pelanggaran', 'siswas.rewards.jenis_reward']);

                        // Ambil collection siswa dari kelas tersebut
                        $siswas = $record->siswas;

                        // Pastikan ada siswa di kelas tersebut agar tidak error saat print PDF kosong
                        if ($siswas->isEmpty()) {
                            // Anda bisa opsional menambahkan notification jika kosong
                            return;
                        }

                        $pdf = Pdf::loadView('pdf.raport-kedisiplinan', [
                            'siswas' => $siswas,
                        ])->setPaper('a4');

                        return response()->streamDownload(
                            fn() => print($pdf->output()),
                            'Raport-Kelas-' . str($record->name)->slug() . '-' . now()->format('Ymd') . '.pdf'
                        );
                    }),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
