<?php

namespace App\Filament\Resources\PelanggaranSiswas;

use App\Filament\Resources\PelanggaranSiswas\Pages\CreatePelanggaranSiswa;
use App\Filament\Resources\PelanggaranSiswas\Pages\EditPelanggaranSiswa;
use App\Filament\Resources\PelanggaranSiswas\Pages\ListPelanggaranSiswas;
use App\Filament\Resources\PelanggaranSiswas\Pages\ViewPelanggaranSiswa;
use App\Filament\Resources\PelanggaranSiswas\Schemas\PelanggaranSiswaForm;
use App\Filament\Resources\PelanggaranSiswas\Schemas\PelanggaranSiswaInfolist;
use App\Filament\Resources\PelanggaranSiswas\Tables\PelanggaranSiswasTable;
use App\Models\PelanggaranSiswa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PelanggaranSiswaResource extends Resource
{
    protected static ?string $model = PelanggaranSiswa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldExclamation;

     protected static string | UnitEnum | null $navigationGroup = 'Penilaian';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return PelanggaranSiswaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PelanggaranSiswaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PelanggaranSiswasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPelanggaranSiswas::route('/'),
            'create' => CreatePelanggaranSiswa::route('/create'),
            'view' => ViewPelanggaranSiswa::route('/{record}'),
            'edit' => EditPelanggaranSiswa::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
{
    // Contoh: Mengubah warna badge siswa menjadi info (biru)
    return 'danger'; 
}
}
