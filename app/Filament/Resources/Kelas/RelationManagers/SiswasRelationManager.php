<?php

namespace App\Filament\Resources\Kelas\RelationManagers;

use App\Filament\Resources\Siswas\SiswaResource;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiswasRelationManager extends RelationManager
{
    protected static string $relationship = 'siswas';

   protected static ?string $title = 'Daftar Siswa';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('nisn')
                    ->required()
                    ->numeric(),
                Select::make('gender')
                    ->options(['L' => 'L', 'P' => 'P'])
                    ->required(),
                TextInput::make('agama'),
                DatePicker::make('tanggal_lahir'),
                Textarea::make('alamat')
                    ->columnSpanFull(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('nisn')
                    ->numeric(),
                TextEntry::make('gender')
                    ->badge(),
                TextEntry::make('agama')
                    ->placeholder('-'),
               
                TextEntry::make('alamat')
                    ->placeholder('-')
                    ->columnSpanFull(),
                // TextEntry::make('created_at')
                //     ->dateTime()
                //     ->placeholder('-'),
                // TextEntry::make('updated_at')
                //     ->dateTime()
                //     ->placeholder('-'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('nisn')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('gender')
                    ->badge(),
                TextColumn::make('agama')
                    ->searchable(),
              
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
                    ->authorize(true),
                AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
              EditAction::make()
                    ->url(fn ($record): string => SiswaResource::getUrl('edit', ['record' => $record]))
                    ->authorize(true),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
