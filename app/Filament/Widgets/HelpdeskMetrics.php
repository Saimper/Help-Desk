<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class HelpdeskMetrics extends BaseWidget
{
    protected function getStats(): array
{
    $lastMonth = Carbon::now()->subMonth();
    
    return [
        Stat::make('Tiempo Medio Respuesta', '2h 15m')
            ->description('Últimos 30 días')
            ->chart([7, 10, 5, 12, 8, 15, 7]) // Datos de ejemplo
            ->color('success'),
            
        Stat::make('SLA Cumplido', '92%')
            ->description('Meta: 95%')
            ->chart([85, 88, 90, 92, 91, 93, 92])
            ->color($this->slaColor(92)),
            
        Stat::make('Satisfacción', '4.6/5')
            ->description('120 evaluaciones')
            ->icon('heroicon-o-star')
            ->color('warning'),
    ];
}

private function slaColor($percent): string
{
    return match(true) {
        $percent > 90 => 'success',
        $percent > 80 => 'warning',
        default => 'danger'
    };
}
}
