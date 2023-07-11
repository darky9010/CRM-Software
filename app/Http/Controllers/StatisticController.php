<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{

    public function index(){
        $reports = Report::select(DB::raw("MONTHNAME(date) as month, SUM(reports.total) as total"))
            ->groupBy(DB::raw("month"))
            ->orderBy('month','ASC')
            ->pluck('total','month');

        $labels = $reports->keys();
        $data = $reports->values();

        return view('statistics.index', compact('labels', 'data'));
    }
}
