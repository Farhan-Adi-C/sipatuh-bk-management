<?php

namespace App\Filament\Resources\RewardSiswas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RewardSiswasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('siswa.name')
                    ->label("Siswa")
                    ->size(TextSize::Medium)
                    ->weight("medium")
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jenis_reward.nama_reward')
                    ->label("Reward")
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal_reward')
                    ->date()
                    ->sortable(),

                TextColumn::make("jenis_reward.poin")
                    ->badge()
                    ->label("Poin")
                    ->color("success"),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
