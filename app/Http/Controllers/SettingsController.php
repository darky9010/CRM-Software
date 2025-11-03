<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Http\Requests\StoreSettingsRequest;
use App\Http\Requests\UpdateSettingsRequest;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingsRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'lang' => 'required|string|max:5',
            'bank_name' => 'required|string|max:255',
            'bank_account' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!self::isValidIBAN($value)) {
                    $fail('Il campo IBAN non è valido.');
                }
            }],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Settings::create($request->all());

        return redirect()->route('dashboard', ['locale' => app()->getLocale()])
            ->with('success', 'Configurazione completata!');

    }

    public static function isValidIBAN($iban)
    {
        $iban = strtolower(str_replace(' ', '', $iban));
        $countries = [
            'al'=>28,'ad'=>24,'at'=>20,'az'=>28,'bh'=>22,'be'=>16,'ba'=>20,'br'=>29,'bg'=>22,'cr'=>21,'hr'=>21,'cy'=>28,
            'cz'=>24,'dk'=>18,'do'=>28,'ee'=>20,'fo'=>18,'fi'=>18,'fr'=>27,'ge'=>22,'de'=>22,'gi'=>23,'gr'=>27,'gl'=>18,
            'gt'=>28,'hu'=>28,'is'=>26,'ie'=>22,'il'=>23,'it'=>27,'jo'=>30,'kz'=>20,'kw'=>30,'lv'=>21,'lb'=>28,'li'=>21,
            'lt'=>20,'lu'=>20,'mk'=>19,'mt'=>31,'mr'=>27,'mu'=>30,'mc'=>27,'md'=>24,'me'=>22,'nl'=>18,'no'=>15,'pk'=>24,
            'ps'=>29,'pl'=>28,'pt'=>25,'qa'=>29,'ro'=>24,'sm'=>27,'sa'=>24,'rs'=>22,'sk'=>24,'si'=>19,'es'=>24,'se'=>24,
            'ch'=>21,'tn'=>24,'tr'=>26,'ae'=>23,'gb'=>22,'vg'=>24
        ];

        $chars = strtolower(substr($iban,0,2));
        if (!isset($countries[$chars]) || strlen($iban) != $countries[$chars]) {
            return false;
        }

        $iban = substr($iban, 4) . substr($iban,0,4);
        $iban = str_replace(range('a','z'), range(10,35), $iban);

        $checksum = intval(substr($iban,0,1));
        for ($i=1; $i<strlen($iban); $i++) {
            $checksum = ($checksum*10 + intval(substr($iban,$i,1))) % 97;
        }

        return $checksum === 1;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $setting = Settings::find($id);
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingsRequest $request
     * @param  int  $id
     * @param  $locale
     * @return \Illuminate\Http\Response
     *
     */
    public function update(UpdateSettingsRequest $request,$locale, $id)
    {
        $setting = Settings::find($id);
        $setting
            ->update([
                'name' => $request->name,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'lang' => $request->lang,
                'bank_name' => $request->bank_name,
                'bank_account' => $request->bank_account,
            ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
