<?php

namespace App\Filament\Resources\RewardSiswas;

use App\Filament\Resources\RewardSiswas\Pages\CreateRewardSiswa;
use App\Filament\Resources\RewardSiswas\Pages\EditRewardSiswa;
use App\Filament\Resources\RewardSiswas\Pages\ListRewardSiswas;
use App\Filament\Resources\RewardSiswas\Pages\ViewRewardSiswa;
use App\Filament\Resources\RewardSiswas\Schemas\RewardSiswaForm;
use App\Filament\Resources\RewardSiswas\Schemas\RewardSiswaInfolist;
use App\Filament\Resources\RewardSiswas\Tables\RewardSiswasTable;
use App\Models\RewardSiswa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RewardSiswaResource extends Resource
{
    protected static ?string $model = RewardSiswa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTrophy;

    protected static ?string $recordTitleAttribute = 'siswa_id';

    protected static string | UnitEnum | null $navigationGroup = 'Penilaian';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return RewardSiswaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RewardSiswaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RewardSiswasTable::configure($table);
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
            'index' => ListRewardSiswas::route('/'),
            'create' => CreateRewardSiswa::route('/create'),
            'view' => ViewRewardSiswa::route('/{record}'),
            'edit' => EditRewardSiswa::route('/{record}/edit'),
        ];
    }

      public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
{
    // Contoh: Mengubah warna badge siswa menjadi info (biru)
    return 'success'; 
}
}
