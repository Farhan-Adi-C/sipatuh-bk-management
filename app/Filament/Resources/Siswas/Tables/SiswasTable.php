<?php

namespace App\Filament\Resources\Siswas\Tables;

use App\Filament\Imports\SiswaImporter;
use App\Models\Siswa;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ImportAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\ActionGroup;
use Filament\Tables\Enums\RecordActionsPosition;

class SiswasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Data Siswa')
            ->description(fn() => 'Total: ' . Siswa::count() . ' siswa')
            ->columns([

                TextColumn::make('name')
                    ->searchable()
                    ->size(TextSize::Medium)
                    ->weight("medium"),
                TextColumn::make("kelas.name")
                    ->badge()
                    ->color("success"),
                TextColumn::make('nisn')
                    // ->numeric()
                    ->color("dark")
                    ->size(TextSize::Small)
                    ->sortable(),
                TextColumn::make('gender')
                    ->badge()
                    ->color(fn(string $state): string => $state === 'L' ? 'info' : 'danger')
                    ->formatStateUsing(fn(?string $state): ?string => match ($state) {
                        "L" => "Laki-laki",
                        "P" => "Perempuan",
                        default => $state
                    }),

                TextColumn::make('agama')
                    ->toggleable(true),
            ])

            ->groups([
                Group::make("kelas.name")
                    ->label("Kelas")
                    ->collapsible(),
                Group::make("agama")
                    ->collapsible(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(SiswaImporter::class)
                    ->label('Import Excel')
                    ->icon('heroicon-o-arrow-up-on-square')
                    ->color('success')
                    ->size('lg')
                    ->outlined()
                    ->extraAttributes(['class' => 'font-bold'])
                    ->tooltip('Unggah data siswa dari file Excel')
                    ->options([
        'connection' => 'sync', // Memaksa menggunakan driver sync
    ]),
            ])
            ->recordActions([
                ActionGroup::make([

                    ViewAction::make(),
                    EditAction::make(),
                    Action::make('exportPdf')
                        ->label('Export Raport')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('danger')
                        ->action(function (Siswa $record) {
                            $record->load(['kelas', 'pelanggarans.jenis_pelanggaran', 'rewards.jenis_reward']);
    
                            $pdf = Pdf::loadView('pdf.raport-kedisiplinan', [
                                'siswas' => collect([$record]),
                            ])->setPaper('a4');
    
                            return response()->streamDownload(
                                fn() => print($pdf->output()),
                                'Raport-' . str($record->name)->slug() . '.pdf'
                            );
                        }),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('exportPdfBulk')
                        ->label('Export Raport (PDF)')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (Collection $records) {
                            $records->load(['kelas', 'pelanggarans.jenis_pelanggaran', 'rewards.jenis_reward']);

                            $pdf = Pdf::loadView('pdf.raport-kedisiplinan', [
                                'siswas' => $records,
                            ])->setPaper('a4');

                            return response()->streamDownload(
                                fn() => print($pdf->output()),
                                'Raport-Kedisiplinan-' . now()->format('Ymd-His') . '.pdf'
                            );
                        })
                       
                        ->deselectRecordsAfterCompletion(),
                ])->color("black"),
            ]);
    }
}
