<?php

namespace App\Filament\Resources\Siswas\Tables;

use App\Filament\Imports\SiswaImporter;
use App\Models\Siswa;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ImportAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class SiswasTable
{
    public static function configure(Table $table): Table
    {
        return $table
         ->heading('Data Siswa')
            ->description(fn () => 'Total: ' . Siswa::count() . ' siswa')
            ->columns([
                
                TextColumn::make('name')
                    ->searchable()
                    ->size(TextSize::Medium)
                    ->weight("medium")
                    ,
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
                    ->color(fn (string $state): string => $state === 'L' ? 'info' : 'danger')
                    ->formatStateUsing(fn (?string $state): ?string => match ($state) {
                        "L" => "Laki-laki",
                        "P" => "Perempuan",
                        default => $state
                    }),
                    
                TextColumn::make('agama')
                    ->toggleable(true)
                    ,
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
        ->label('Import Excel')                      // Label lebih jelas
        ->icon('heroicon-o-arrow-up-on-square')    // Ikon unggah
        ->color('success')                          // Warna hijau (seperti Excel)
        ->size('lg')                                // Ukuran lebih besar
        ->outlined()                                // Opsional: tampilan garis tepi
        ->extraAttributes(['class' => 'font-bold']) // Tambahan gaya (opsional)
        ->tooltip('Unggah data siswa dari file Excel'),
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
