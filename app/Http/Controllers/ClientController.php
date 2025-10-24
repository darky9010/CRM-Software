<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Category;
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
        $names = Client::select('id', 'name', 'surname')->orderBy('name')->get();
        $languages = Client::select('language')->distinct()->get();
        $categories = Category::whereNull('parent_id')->orderBy('name')->get();

        // Se non è una richiesta AJAX, mostra la vista principale
        if (!$request->ajax()) {
            $clients = Client::orderBy('surname')->paginate(50);
            return view('clients.index', compact('clients', 'names', 'languages','categories'));
        }

        // Query base
        $query = Client::query();

        // Filtra per client specifico
        if ($request->client && $request->client != 0) {
            $query->where('id', $request->client);
        }

        // Filtra per lingua
        if (!empty($request->language) && $request->language != '0') {
            $query->where('language', $request->language);
        }

        if (!empty($request->category) && $request->category != '0') {
            // Recupera i child della categoria selezionata
            $childIds = Category::where('parent_id', $request->category)->pluck('id');

            // Se la categoria selezionata è un child stesso, includila
            $childIds->push($request->category);

            $query->whereHas('categories', function($q) use ($childIds) {
                $q->whereIn('categories.id', $childIds);
            });
        }

        $clients = $query->orderBy('surname')->paginate(50);
        $languages = Client::select('language')->distinct()->get();

        return view('clients.child', compact('clients', 'names', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        $categories = Category::all();
        return view('clients.create',compact('categories'));
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
        $client->rank = $request->rank;
        $client->language = $request->language;
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
