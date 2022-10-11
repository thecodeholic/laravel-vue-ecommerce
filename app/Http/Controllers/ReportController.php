<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Traits\ReportTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    use ReportTrait;

    public function orders()
    {
        $query = Order::query();

        return $this->prepareDataForBarChart($query, 'Orders By Day');
    }

    public function customers()
    {
        $query = Customer::query();

        return $this->prepareDataForBarChart($query, 'Customers By Day');
    }

    private function prepareDataForBarChart($query, $label)
    {
        $fromDate = $this->getFromDate() ?: Carbon::now()->subDay(30);
        $query
            ->select([DB::raw('CAST(created_at as DATE) AS day'), DB::raw('COUNT(created_at) AS count')])
            ->groupBy(DB::raw('CAST(created_at as DATE)'));
        if ($fromDate) {
            $query->where('created_at', '>', $fromDate);
        }
        $records = $query->get()->keyBy('day');

        // Process for chartjs
        $days = [];
        $labels = [];
        $now = Carbon::now();
        while ($fromDate < $now) {
            $key = $fromDate->format('Y-m-d');
            $labels[] = $key;
            $fromDate = $fromDate->addDay(1);
            $days[] = isset($records[$key]) ? $records[$key]['count'] : 0;
        }

        return [
            'labels' => $labels,
            'datasets' => [[
                'label' => $label,
                'backgroundColor' => '#f87979',
                'data' => $days
            ]]
        ];
    }
}
