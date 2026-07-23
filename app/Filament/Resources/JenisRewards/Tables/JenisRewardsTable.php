<?php

namespace App\Filament\Resources\JenisRewards\Tables;

use App\Models\JenisReward;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JenisRewardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->description('Total: '.  JenisReward::count() . ' Jenis Reward')
        ->modifyQueryUsing(fn (Builder $query) => $query->withCount('reward_siswas'))
            ->columns([
                TextColumn::make('nama_reward')
                    ->searchable(),
                TextColumn::make('poin')
                    ->numeric()
                    ->badge()
                    ->color("success")
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("reward_siswas_count")
                    ->label("Jumlah Penerima")
                    ->numeric()
                    ->color("gray")
                    ->sortable()
                    ->badge()
            ])
            ->filters([
                //
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
