<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Contracts\DataTable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Display a listing of the archive resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function indexarchive()
    {
        $products = Product::paginate(10);
        return view('products.archive', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        $companies = Company::all(['id', 'name']);
        return view('products.create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreProductRequest $request
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function store($locale, StoreProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->b_price = $request->b_price;
        $product->s_price = $request->s_price;
        $product->stock = $request->stock;
        $product->in_order = $request->in_order;
        $product->re_order = $request->re_order;
        $product->location_A = $request->location_A;
        $product->location_B = $request->location_B;
        $product->location_C = $request->location_C;
        $product->unit = $request->unit;
        $serial_n = $request->serial_n;
        $company_id = $request->company_id;
        $product->save();
        $company = Company::find($company_id);
        $product->companies()->attach($company, ['serial_n' => $serial_n]);
        return redirect()->route('products.index', app()->getLocale());
    }

    /**
     * return json with the Product price.
     *
     * @param int $id
     * @return json_encode
     *
     */
    public function getProductPrice($id)
    {
        echo json_encode(DB::table('products')->where('id', $id)->get());
    }

    /**
     * return json with the Product description.
     *
     * @param int $id
     * @return json_encode
     *
     */
    public function getProductDescription($id)
    {
        echo json_encode(DB::table('products')->where('id', $id)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function show($locale, $id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function edit($locale, $id)
    {
        $product = Product::find($id);
        $companies1 = Company::all();
        return view('products.edit', compact('product', 'companies1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductRequest $request
     * @param int $id
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function update(UpdateProductRequest $request, $locale, $id)
    {
        $product = Product::find($id);
        $company = Company::find($request->company_id);
        $product->companies()->attach($company, ['serial_n' => $request->serial_n]);
        $product
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'b_price' => $request->b_price,
                's_price' => $request->s_price,
                'stock' => $request->stock,
                'in_order' => $request->in_order,
                're_order' => $request->re_order,
                'location_A' => $request->location_A,
                'location_B' => $request->location_B,
                'location_C' => $request->location_C,
                'unit' => $request->unit
            ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function destroy($locale, Product $product)
    {
        $product->companies()->detach();
        $product->delete();
        return redirect()->route('products.index', app()->getLocale());
    }
}
