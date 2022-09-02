<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreCompanyRequest $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = new Company();
        $company->name = $request->name;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->mail = $request->mail;
        $company->postal_code = $request->postal_code;
        $company->city = $request->city;
        $company->region = $request->region;
        $company->site = $request->site;
        $company->save();
        return redirect()->route('companies.edit', ['locale' => app()->getLocale(), 'company' => $company->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     *
     */
    public function show($locale, $id)
    {
        $company = Company::find($id);
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     *
     */
    public function edit($locale, $id)
    {
        $company = Company::find($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCompanyRequest $request
     * @param int $id
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function update(UpdateCompanyRequest $request,$locale, $id)
    {
        $company = Company::find($id);
        $company
            ->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'mail' => $request->mail,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'region' => $request->region,
                'site' => $request->site,
            ]);
        return back();
    }

    /**
     * Elimino il fornitore e tutti i suoi contatti.
     *
     * @param int $id
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function destroy($locale, $id)
    {
        $company = Company::find($id);
        foreach ($company->contacts as $contact) {
            $contact->delete();
        }
        $company->delete();
        return redirect()->route('companies.index', app()->getLocale());
    }
}
