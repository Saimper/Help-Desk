<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Ticket;
use Carbon\Carbon;

class MonthlyTicketsChart extends ChartWidget
{
    protected static ?string $heading = 'Tickets por Día (Últimos 30 días)';

    protected function getData(): array
{
    // Ajuste importante: incluir el día completo actual
    $endDate = Carbon::now()->endOfDay(); // Hasta el final del día actual
    $startDate = Carbon::now()->subDays(29)->startOfDay(); // 30 días incluyendo hoy
    
    // Consulta para contar tickets por día
    $data = Ticket::selectRaw('COUNT(*) as count, DATE(created_at) as date')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->keyBy('date');
    
    // Rellenar todos los días del período
    $labels = [];
    $counts = [];
    
    for ($i = 0; $i < 30; $i++) {
        $currentDate = Carbon::now()->subDays(29 - $i);
        $dateString = $currentDate->format('Y-m-d');
        $labels[] = $currentDate->format('M d');
        $counts[] = $data->has($dateString) ? $data[$dateString]->count : 0;
    }

    return [
        'labels' => $labels,
        'datasets' => [[
            'label' => 'Tickets creados',
            'data' => $counts,
            'borderColor' => '#3B82F6',
            'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
            'fill' => true,
            'tension' => 0.3,
            'pointBackgroundColor' => '#3B82F6',
            'pointBorderColor' => '#fff',
            'pointHoverRadius' => 5,
        ]]
    ];
}

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Número de Tickets'
                    ]
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Fecha'
                    ]
                ]
            ],
            'plugins' => [
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false
                ]
            ]
        ];
    }
}