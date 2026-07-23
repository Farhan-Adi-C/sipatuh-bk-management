<?php

namespace App\Filament\Resources\JenisPelanggarans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class JenisPelanggaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pelanggaran')
                    ->searchable(),
                TextColumn::make('poin')
                    ->numeric()
                    ->badge()
                    ->color("danger")
                    ->sortable(),
                TextColumn::make("kategori")
                    ->badge()
                    ->searchable()
                    ->placeholder('Tidak Berkategori') 
                    ->color(fn (string $state): string => match ($state) {
                        "Pelanggaran Ringan" => "info",
                        "Pelanggaran Sedang" => "warning",
                        "Pelanggaran Berat" => "danger",
                        default => "gray"
                    })
            ])
            ->filters([
                
            ])
            ->groups([
                Group::make("kategori")
                ->collapsible(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
