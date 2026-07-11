<?php

namespace App\Filament\Resources\Siswas\RelationManagers;

use App\Filament\Resources\JenisPelanggarans\JenisPelanggaranResource;
use App\Filament\Resources\Siswas\SiswaResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PelanggaransRelationManager extends RelationManager
{
    protected static string $relationship = 'pelanggarans';

    // protected static ?string $relatedResource = JenisPelanggaranResource::class;


     protected static ?string $title = 'Pelanggaran';
    protected static ?string $modelLabel = 'Pelanggaran';
    protected static ?string $pluralModelLabel = 'Pelanggaran';

     public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('jenis_pelanggaran_id')
                ->relationship('jenis_pelanggaran', 'nama_pelanggaran')
                ->required()
                ->searchable()
                ->preload(),

            DatePicker::make('tanggal_pelanggaran')
                ->label('Tanggal Pelanggaran'),
        ]);
    }

    public function table(Table $table): Table
    {

    
        return $table
           ->recordTitleAttribute('jenis_pelanggaran.nama_pelanggaran')
            ->columns([
                TextColumn::make('jenis_pelanggaran.nama_pelanggaran')
                    ->label('Jenis Pelanggaran'),

                TextColumn::make("jenis_pelanggaran.kategori")
                    ->badge()
                    ->label("Kategori")
                     ->placeholder('Tidak Berkategori') 
                    ->color(fn (string $state): string => match ($state) {
                        "Pelanggaran Ringan" => "info",
                        "Pelanggaran Sedang" => "warning",
                        "Pelanggaran Berat" => "danger",
                        default => "gray"
                    }),
                TextColumn::make('tanggal_pelanggaran')
                    ->date('d M Y')
                    ->label('Tanggal'),
                TextColumn::make("jenis_pelanggaran.poin")
                    ->label("Poin")
                    ->color("danger")
                    ->badge(),
            ])
            ->headerActions([
                CreateAction::make()
        ->label('Tambah Pelanggaran Baru') // Label kustom
        ->icon('heroicon-o-plus-circle') // Tambahkan ikon
        ->modalHeading('Tambah Data Pelanggaran')
         ->authorize(true),
            ])
            ->recordActions([
               EditAction::make(),
               DeleteAction::make()
               
                ->authorize(true),
            ]);
    }

    
}
