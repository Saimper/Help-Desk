<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Ticket;


class TicketsStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Distribución de Tickets';
    protected static ?string $maxHeight = '250px';

    // Método cambiado a public
    public function getColumnSpan(): int | string | array
    {
        return 1; // Ocupa 1 columna
    }

    protected function getData(): array
    {
        $tickets = Ticket::selectRaw('count(*) as count, status')
            ->groupBy('status')
            ->get();
        
        return [
            'labels' => $tickets->pluck('status')->map(fn($status) => ucfirst($status)),
            'datasets' => [[
                'data' => $tickets->pluck('count'),
                'backgroundColor' => [
                    '#EF4444', // Rojo
                    '#10B981', // Verde
                    '#3B82F6', // Azul
                ],
                'borderWidth' => 1,
                'borderColor' => '#fff',
                'cutout' => '65%',
            ]],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'boxWidth' => 10,
                        'padding' => 10,
                        'font' => [
                            'size' => 11,
                        ],
                    ],
                ],
            ],
        ];
    }
}