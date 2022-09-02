<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  $company_id
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function create($locale, $company_id)
    {
        $company = Company::find($company_id);
        return view('contacts.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreContactRequest $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(StoreContactRequest $request)
    {
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->surname = $request->surname;
        $contact->mail = $request->mail;
        $contact->phone = $request->phone;
        $contact->company_id = $request->company_id;
        $contact->save();
        return redirect()->route('companies.edit', ['locale' => app()->getLocale(), 'company' => $request->company_id]);
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
        $contact = Contact::find($id);
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateContactRequest $request
     * @param int $id
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function update(UpdateContactRequest $request, $locale, $id)
    {
        $contact = Contact::find($id);
        $contact
            ->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'mail' => $request->mail,
                'phone' => $request->phone,
            ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     *
     */
    public function destroy($locale, Contact $contact)
    {
        $contact->delete();
        return back();
    }
}
