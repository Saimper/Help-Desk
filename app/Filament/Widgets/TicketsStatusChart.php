<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Ticket;

class TicketsStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Tickets  X Mes';

    protected function getData(): array
{
    $tickets = Ticket::selectRaw('count(*) as count, status')
        ->groupBy('status')
        ->get();
    
    return [
        'labels' => $tickets->pluck('status'),
        'datasets' => [[
            'data' => $tickets->pluck('count'),
            'backgroundColor' => [
                '#EF4444', // Rojo para abiertos
                '#F59E0B', // Amarillo para en progreso
                '#10B981'  // Verde para resueltos
            ],
        ]],
    ];
}

    protected function getType(): string
    {
        return 'doughnut';
    }
}
