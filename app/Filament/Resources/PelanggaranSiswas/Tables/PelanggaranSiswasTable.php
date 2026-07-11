<?php

namespace App\Filament\Resources\PelanggaranSiswas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PelanggaranSiswasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('siswa.name')
                    ->searchable()
                    ->size(TextSize::Medium)
                    ->weight("medium"),
                TextColumn::make('jenis_pelanggaran.nama_pelanggaran')
                    ->label("Pelanggaran")
                    ->searchable(),
                TextColumn::make("jenis_pelanggaran.kategori")
                    ->label("Kategori")
                    ->placeholder("Belum Dikategorikan")
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        "Pelanggaran Ringan" => "info",
                        "Pelanggaran Sedang" => "warning",
                        "Pelanggaran Berat" => "danger",
                        default => "gray"
                    }),
                TextColumn::make('tanggal_pelanggaran')
                    ->date()
                    ->sortable(),
                TextColumn::make("jenis_pelanggaran.poin")
                    ->label("Poin Pelanggaran")
                    ->badge()
                    ->color("danger")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
