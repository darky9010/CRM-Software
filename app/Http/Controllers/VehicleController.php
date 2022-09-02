<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  $locale
     * @param  int $client_id
     * @return \Illuminate\Http\Response
     *
     */
    public function create($locale, $client_id)
    {
        $client = Client::find($client_id);
        return view('vehicles.create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVehicleRequest  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(StoreVehicleRequest $request)
    {
        $vehicle = new Vehicle;
        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;
        $vehicle->plate = $request->plate;
        $vehicle->hours = $request->hours;
        $vehicle->client_id = $request->client_id;
        $vehicle->save();
        return redirect()->route('clients.edit',['locale'=>app()->getLocale(),'client'=>$request->client_id] );
    }

    /**
     * Return a json of all client vehicles.
     *
     * @param  int $id
     * @return json_encode
     *
     */
    public function getClientVehicles($id){
        echo json_encode(DB::table('vehicles')->where('client_id', $id)->get());
    }

    /**
     * Return a json with the vehicles hours.
     *
     * @param  int $id
     * @return json_encode
     *
     */
    public function getVehicleHours($id){
        echo json_encode(DB::table('vehicles')->where('id',$id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    public function edit($locale,$id)
    {
        $vehicle = Vehicle::find($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehicleRequest  $request
     * @param  int  $id
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function update(UpdateVehicleRequest $request,$locale, $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle
            ->update([
                'brand' => $request->brand,
                'model' => $request->model,
                'plate' => $request->plate,
                'hours' => $request->hours,
            ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     *
     */
    public function destroy($locale, Vehicle $vehicle)
    {
        $vehicle->delete();
        return back();
    }
}
