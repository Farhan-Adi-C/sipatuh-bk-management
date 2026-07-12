<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AppInfoWidget extends Widget
{
    protected string $view = 'filament.widgets.app-info-widget';

    protected int | string | array $columnSpan = 2;

    protected static ?int $sort = -3;
}
