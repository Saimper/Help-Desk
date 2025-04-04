<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Ticket;

class MonthlyTicketsChart extends ChartWidget
{
    protected static ?string $heading = 'Tickets X Mes';

    protected function getData(): array
{
    $data = Ticket::selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    return [
        'labels' => $data->pluck('month'),
        'datasets' => [[
            'label' => 'Tickets',
            'data' => $data->pluck('count'),
            'borderColor' => '#3B82F6',
            'fill' => true,
            'tension' => 0.3
        ]]
    ];
}
    protected function getType(): string
    {
        return 'line';
    }
}
