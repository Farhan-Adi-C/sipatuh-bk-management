<?php

namespace App\Filament\Resources\Siswas\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RewardsRelationManager extends RelationManager
{
    protected static string $relationship = 'rewards';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('jenis_reward_id')
                    ->required()
                    ->relationship(name: "jenis_reward", titleAttribute:"nama_reward")
                    ->searchable()
                ->preload(),
                DatePicker::make('tanggal_reward'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_reward')
            ->modifyQueryUsing(function ($query) {
            return $query->with('jenis_reward');
        })
            ->columns([
                TextColumn::make('jenis_reward.nama_reward')
                ->label("Nama Reward")
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal_reward')
                    ->date()
                    ->sortable(),
                TextColumn::make("jenis_reward.poin")
                ->label("Poin")
                ->badge()
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
            ->headerActions([
                CreateAction::make()
        ->label('Tambah Reward Baru')  
        ->icon('heroicon-o-plus-circle')
        ->modalHeading('Tambah Reward Baru')
         ->authorize(true),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make()->authorize(true),
                DissociateAction::make(),
               DeleteAction::make()
                ->authorize(true),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
