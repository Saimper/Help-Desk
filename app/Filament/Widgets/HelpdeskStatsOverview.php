<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HelpdeskStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Tickets Abiertos', Ticket::where('status', 'open')->count())
                ->description('Por atender')
                ->descriptionIcon('heroicon-o-inbox')
                ->color('danger'),
                
            Stat::make('Tickets en Proceso', Ticket::where('status', 'in_progress')->count())
                ->description('En atención')
                ->descriptionIcon('heroicon-o-cog')
                ->color('warning'),
                
            Stat::make('Tickets Resueltos', Ticket::where('status', 'resolved')->count())
                ->description('Este mes')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}