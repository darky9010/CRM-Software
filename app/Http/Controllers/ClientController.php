<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource filtered with ajax.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     *
     */
    public function index(Request $request)
    {
        $names = Client::select('id', 'name', 'surname')->orderBy('name', 'asc')->get();
        $title = Client::where('title', 'Ditta')->get();
        if (!$request->ajax()) {
            $clients = Client::orderBy('name', 'asc')->paginate(10);
            return view('clients.index', compact('clients', 'names', 'title'));
        } elseif ($request->client != 0 && $request->title == 0) {
            $clients = Client::where('id', $request->client)->orderBy('name', 'asc')->paginate(10);
            return view('clients.child', compact('clients', 'names', 'title'));
        } elseif ($request->client == 0 && $request->title != 0) {
            ($request->title == 1) ? $clients = Client::where('title', '!=', 'Ditta')->orderBy('name', 'asc')->paginate(10) : $clients = Client::where('title', 'Ditta')->orderBy('name', 'asc')->paginate(10);
            return view('clients.child', compact('clients', 'names', 'title'));
        } else {
            $clients = Client::orderBy('name', 'asc')->paginate(10);
            return view('clients.child', compact('clients', 'names', 'title'));
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
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreClientRequest $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(StoreClientRequest $request)
    {
        $client = new Client();
        $client->title = $request->title;
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->mail = $request->mail;
        $client->postal_code = $request->postal_code;
        $client->city = $request->city;
        $client->region = $request->region;
        $client->note = $request->note;
        $client->save();
        return redirect()->route('clients.edit', ['locale' => app()->getLocale(), 'client' => $client->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client $client
     * @param $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function edit($locale, $id)
    {
        $client = Client::find($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateClientRequest $request
     * @param \App\Models\Client $id
     * @param $locale
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function update(UpdateClientRequest $request, $locale, $id)
    {
        $client = Client::find($id);
        $client
            ->update([
                'title' => $request->title,
                'name' => $request->name,
                'surname' => $request->surname,
                'address' => $request->address,
                'phone' => $request->phone,
                'mail' => $request->mail,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'region' => $request->region,
                'note' => $request->note,
            ]);
        return back();
    }

    /**
     * Elimino il cliente e tutti i suoi veicoli.
     *
     * @param \App\Models\Client $id
     * @param $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function destroy($locale, $id)
    {
        $client = Client::find($id);
        foreach ($client->vehicles as $vehicle) {
            $vehicle->delete();
        }
        $client->delete();
        return redirect()->route('clients.index', app()->getLocale());
    }
}
