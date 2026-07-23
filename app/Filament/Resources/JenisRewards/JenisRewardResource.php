<?php

namespace App\Filament\Resources\JenisRewards;

use App\Filament\Resources\JenisRewards\Pages\CreateJenisReward;
use App\Filament\Resources\JenisRewards\Pages\EditJenisReward;
use App\Filament\Resources\JenisRewards\Pages\ListJenisRewards;
use App\Filament\Resources\JenisRewards\Pages\ViewJenisReward;
use App\Filament\Resources\JenisRewards\RelationManagers\RewardSiswasRelationManager;
use App\Filament\Resources\JenisRewards\Schemas\JenisRewardForm;
use App\Filament\Resources\JenisRewards\Schemas\JenisRewardInfolist;
use App\Filament\Resources\JenisRewards\Tables\JenisRewardsTable;
use App\Models\JenisReward;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JenisRewardResource extends Resource
{
    protected static ?string $model = JenisReward::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string | UnitEnum | null $navigationGroup = 'Data Master';

    protected static ?int $navigationSort = 4;


    protected static ?string $recordTitleAttribute = 'nama_reward';

    public static function form(Schema $schema): Schema
    {
        return JenisRewardForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JenisRewardInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JenisRewardsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RewardSiswasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJenisRewards::route('/'),
            'create' => CreateJenisReward::route('/create'),
            'view' => ViewJenisReward::route('/{record}'),
            'edit' => EditJenisReward::route('/{record}/edit'),
        ];
    }
}
