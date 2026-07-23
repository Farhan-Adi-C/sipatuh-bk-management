<?php

namespace App\Filament\Resources\Kelas\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KelasInfolist
{



    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->schema([
            Hidden::make("name")->extraAttributes(["style" => "display: none !important;"])
        ]);
        
    }
}
