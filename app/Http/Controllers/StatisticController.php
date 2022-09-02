<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function statistics($locale){
        $chart_options = [
            'chart_title' => 'Bills in years',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Report',
            'group_by_field' => 'created_at',
            'group_by_period' => 'year',
            'chart_type' => 'line',
        ];
        $reportYear = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Bills in month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Report',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        $reportMonth = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Bills for client',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Report',
            'relationship_name' => 'client',
            'group_by_field' => 'name, surname',
            'chart_type' => 'pie',
        ];
        $reportClient = new LaravelChart($chart_options);

        return view('statistics.index', compact('reportYear','reportMonth','reportClient'));
    }
}
