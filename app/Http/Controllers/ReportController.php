<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Report;
use App\Models\Product;
use App\Models\Settings;
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
        $setting = Settings::select('logo')->first();
        $clients = Report::select('client_id')
            ->groupBy('client_id')
            ->get();
        if (!$request->ajax()) {
            $reports = Report::where('status', 'open')->paginate(10);
            return view('dashboard', compact('reports', 'clients', 'setting'));
        } else {
            if
            ($request->status != null && $request->type != null && $request->client != 0) {
                ($request->status == 0) ? $reports = Report::where('client_id', $request->client)
                    ->where('type', $request->type)
                    ->paginate(10) : $reports = Report::where('status', $request->status)
                    ->where('client_id', $request->client)
                    ->where('type', $request->type)
                    ->paginate(10);
            } elseif
            ($request->status != null && $request->type != null && $request->client == 0) {
                ($request->status == 0) ? $reports = Report::where('type', $request->type)
                    ->paginate(10) : $reports = Report::where('status', $request->status)
                    ->where('type', $request->type)
                    ->paginate(10);
            } else {
                $reports = Report::paginate(10);
            }
            return view('reports.child', compact('reports', 'clients', 'setting'));
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
        $report->date = now();
        $report->status = $request->status;
        $report->client_id = $request->client_id;
        $report->save();
        //Salvo per avere l'id del report
        $report->name = $d . $year . $month . "-" . str_pad($report->id, 4, "0", STR_PAD_LEFT);
        $report->save();
        $report->vehicles()->attach($request->vehicle_id);
        $product = Product::find($request->product_id);

        //check per le quantità in magazzino e aggiornamento delle quantità all'inseriemnto nel report
        if ($product->check == 1 && $request->qta <= $product->stock && $product->stock > $product->re_order || $product->check == 0) {
            $report->products()->attach($product, ['qta' => $request->qta, 'sum' => $request->sum, 'description' => $request->description]);
            $report->total = $request->sum;
            $report->save();
            $product->update(['stock' => $product->stock - $request->qta]);
            return redirect()->route('reports.edit', ['locale' => app()->getLocale(), 'report' => $report->id]);
        } else {
            return redirect()->route('reports.edit', ['locale' => app()->getLocale(), 'report' => $report->id])->with('alert', 'non ci sono abbastanza pezzi!');
        }
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
            $qta = $report->products()->where('product_id', '=', $product_id)->value('qta');
            $product = Product::find($product_id);
            $product->update([
                'stock' => $product->stock + $qta,
            ]);
            $sum = $report->products()->where('product_id', '=', $product_id)->value('sum');
            $total = $total - $sum;
            $report->products()->detach($product_id);
        }

        $report->vehicles()->detach();
        //($request->vehicle_id == 0) ? $vehicle == NULL : $vehicle = $request->vehicle_id;
        $sum = $request->sum;
        $total = $total + $sum;
        $report->vehicles()->attach($request->vehicle_id);
        if(!empty($product_id)) {
            $product = Product::find($product_id);
            if ($product->check == 1 && $request->qta <= $product->stock && $product->stock > $product->re_order || $product->check == 0) {
                $report->products()->attach($product, ['qta' => $request->qta, 'sum' => $request->sum, 'description' => $request->description]);
                $product->update(['stock' => $product->stock - $request->qta]);
            } else {
                return redirect()->route('reports.edit', ['locale' => app()->getLocale(), 'report' => $report->id])->with('alert', 'non ci sono abbastanza pezzi!');
            }
        }
        $report
            ->update([
                'type' => $request->type,
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
        $qta = Report::find($report)->products()->where('product_id', '=', $product)->value('qta');
        $total = Report::where('id', $report)->value('total');
        $total = $total - $sum;
        $dproduct = Product::find($product);
        $dproduct->update([
            'stock' => $dproduct->stock + $qta,
        ]);
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
        $pros = Product::all('id');
        foreach ($pros as $pro) {
            $products = Report::find($id)->products()->wherePivot('product_id', $pro->id)->get();
            foreach ($products as $product) {
                $new_stock = $product->stock + $product->pivot->qta;
                Product::find($product->id)->update(['stock' => $new_stock]);
            }
        }
        Report::find($id)->products()->wherePivot('report_id', $id)->detach();
        Report::where('id', $id)->where('type', $type)->delete();
        return redirect()->route('dashboard', app()->getLocale());
    }
}
