<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Report;
use App\Models\Product;
use App\Models\Vehicle;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     *
     */
    public function index(Request $request)
    {
        $clients = Report::select('client_id')
            ->groupBy('client_id')
            ->get();
        if (!$request->ajax()) {
            $reports = Report::where('status', 'open')->paginate(10);
            return view('dashboard', compact('reports', 'clients'));
        } elseif ($request->status != null && $request->type != null && $request->client != 0) {
            ($request->status == 0) ? $reports = Report::where('client_id', $request->client)
                ->where('type', $request->type)
                ->paginate(10) : $reports = Report::where('status', $request->status)
                ->where('client_id', $request->client)
                ->where('type', $request->type)
                ->paginate(10);
            return view('reports.child', compact('reports', 'clients'));
        } elseif ($request->status != null && $request->type != null && $request->client == 0) {
            ($request->status == 0) ? $reports = Report::where('type', $request->type)
                ->paginate(10) : $reports = Report::where('status', $request->status)
                ->where('type', $request->type)
                ->paginate(10);
            return view('reports.child', compact('reports', 'clients'));
        } else {
            $reports = Report::paginate(10);
            return view('reports.child', compact('reports', 'clients'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        $products = Product::all();
        $clients = Client::all();
        $vehicles = Vehicle::all();
        return view('reports.create', compact('products', 'clients', 'vehicles'));
    }

    public function usercreate($locale, $id)
    {
        $products = Product::all();
        $clients = Client::where('id', '<>', $id)->get();
        $client = Client::find($id);
        $vehicles = Vehicle::all();
        return view('reports.create', compact('products', 'clients', 'client', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreReportRequest $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(StoreReportRequest $request)
    {
        $report = new Report;
        $d = $request->type[0];
        $year = date('y',);
        $month = date('m');
        $report->type = $request->type;
        $report->r_terms = $request->r_terms;
        $report->p_terms = $request->p_terms;
        $report->tax = $request->tax;
        $report->total = $request->sum;
        $report->date = now();
        $report->status = $request->status;
       // ($request->vehicle_id == 0) ? $report->vehicle_id == NULL : $report->vehicle_id = $request->vehicle_id;
        $report->client_id = $request->client_id;
        $report->save();
        //Salvo per avere l'id del report
        $report->name = $d . $year . $month . "-" . str_pad($report->id, 4, "0", STR_PAD_LEFT);
        $report->save();
        $product = Product::find($request->product_id);
        $report->products()->attach($product, ['qta' => $request->qta, 'sum' => $request->sum, 'description' => $request->description]);
        $report->vehicles()->attach($request->vehicle_id);
        return redirect()->route('reports.edit', ['locale' => app()->getLocale(), 'report' => $report->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function edit($locale, $id)
    {
        $report = Report::find($id);
        $products = Product::all();
        $clients = Client::all();
        $vehicles = Vehicle::all();
        return view('reports.edit', compact('report', 'products', 'clients', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateReportRequest $request
     * @param int $id
     * @param $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function update(UpdateReportRequest $request, $locale, $id)
    {
        $report = Report::find($id);
        $product_id = $request->product_id;
        $sum = 0;
        $date = now();
        $vehicle = NULL;
        $total = Report::where('id', $id)->value('total');
        $d = $request->type[0];
        $year = date('y',);
        $month = date('m');
        //se il prodotto è già presente lo elimino e aggiorno il totale e la descrizione
        if ($report->products()->where('product_id', '=', $product_id)->exists()) {
            $sum = $report->products()->where('product_id', '=', $product_id)->value('sum');
            $total = $total - $sum;
            $report->products()->detach($product_id);
        }
        $report->vehicles()->detach();
        //($request->vehicle_id == 0) ? $vehicle == NULL : $vehicle = $request->vehicle_id;
        $sum = $request->sum;
        $total = $total + $sum;
        $product = Product::find($product_id);
        $report->vehicles()->attach($request->vehicle_id);
        $report->products()->attach($product, ['qta' => $request->qta, 'sum' => $sum, 'description' => $request->description]);

        $report
            ->update([
                'type' => $request->type,
                'name' => $d . $year . $month . "-" . str_pad($report->id, 4, "0", STR_PAD_LEFT),
                'status' => $request->status,
                'r_terms' => $request->r_terms,
                'p_terms' => $request->p_terms,
                'tax' => $request->tax,
                'total' => $total,
                'date' => $date,
                'client_id' => $request->client_id,
                'vehicle_id' => $vehicle,
            ]);
        return back();
    }

    /**
     * Elimianzione del prodotto specifico
     *
     * @param $report
     * @param $produtct
     * @param $locale
     *
     */
    public function removeProduct($locale, $report, $product)
    {
        $sum = Report::find($report)->products()->where('product_id', '=', $product)->value('sum');
        $total = Report::where('id', $report)->value('total');
        $total = $total - $sum;
        Report::find($report)->update(['total' => $total]);
        Report::find($report)->products()->detach($product);
        return back();
    }

    /**
     * Alert per l'eliminazione del report
     *
     * @param $id
     * @param $type
     *
     */
    public function delete($locale, $id, $type)
    {
        $report = Report::where('id', $id)->where('type', $type)->get()->first();
        return view('reports.delete', compact('report'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param $locale
     * @param string $type
     * @return \Illuminate\Http\Response
     *
     */
    public function destroy($locale, $id, $type)
    {
        Report::find($id)->products()->wherePivot('report_id', $id)->detach();
        Report::where('id', $id)->where('type', $type)->delete();
        return redirect()->route('dashboard', app()->getLocale());
    }
}
