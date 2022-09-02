<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.create_document') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('dashboard', app()->getLocale()) }}"
               class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4 rounded">
                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg> {{ __('site.previous_page') }}
            </a>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="w-full" name="reports/create" id="reports/create" method="post"
                          action="{{ route('reports.store',app()->getLocale())}}">
                        @csrf
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/4 px-3">
                                <div class="relative">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.type') }}</label>
                                    <select
                                        class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        name="type" id="type">
                                        <option value="Fattura">Fattura</option>
                                        <option value="Bollettino">Bollettino</option>
                                        <option value="Ricevuta">Ricevuta</option>
                                        <option value="Offerta">Offerta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full md:w-2/12 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.deadline_complaints') }}</label>
                                <input type="number" id="r_terms" name="r_terms"
                                       class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                       value="10" min="5"
                                       step="1">
                            </div>
                            <div class="w-full md:w-2/12 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.payment_terms') }}</label>
                                <input type="number" id="p_terms" name="p_terms"
                                       class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                       value="30" min="5"
                                       step="1">
                            </div>
                            <div class="w-full md:w-2/12 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.tax') }}</label>
                                <input type="number" id="tax" name="tax"
                                       class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                       value="7.7" min="7.7"
                                       step="0.1">
                            </div>
                            <div class="w-full md:w-2/12 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.status') }}</label>
                                <select
                                    class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    name="status" id="status">
                                    <option value="open">Aperto</option>
                                    <option value="close">Chiuso</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <div class="relative">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.client') }}</label>
                                    <select
                                        class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        name="client_id" id="client_id">
                                        @if(isset($client))
                                            <option
                                                value="{{ $client->id }}">{{ $client->name}} {{$client->surname}} {{$client->city}}</option>
                                        @else
                                            <option
                                                value="">Seleziona un cliente
                                            </option>
                                        @endif
                                        @foreach($clients as $client)
                                            <option
                                                value="{{ $client->id }}">{{ $client->name}} {{$client->surname}} {{$client->city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">

                                <div class="relative">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.vehicle') }}</label>
                                    <select
                                        class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        name="vehicle_id" id="vehicle_id">

                                    </select>
                                </div>
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.hours') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="hours" name="hours" class="form-control">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-4/12 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.product') }}</label>
                                <select
                                    class="select2 block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    name="product_id" id="product_id">
                                    <option value="0" disabled selected>{{ __('site.product') }}</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name}}
                                            | @foreach($product->companies as $company){{$company->pivot->serial_n}}@endforeach</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full md:w-5/12 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.description') }}</label>
                                <textarea
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="description" name="description" class="form-control"
                                    required=""></textarea>
                            </div>
                            <div class="w-full md:w-1/12 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.quantity') }}</label>
                                <input
                                    class="text-right appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="qta" name="qta" class="form-control" value="1" min="0" step="0.05"
                                    required="">
                            </div>
                            <div class="w-full md:w-2/12 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.price') }}</label>
                                <input
                                    class="text-right appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="sum" name="sum" class="form-control" min="00.00" required=""
                                    step="0.05">
                            </div>
                        </div>
                        <button type="submit"
                                class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4 rounded">
                            {{ __('site.create') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    $(document).ready(function () {

        //Prendo i veicoli per il cliente selezionato e li carico nel select
        let id = $('#client_id').val();
        $('#vehicle_id').empty();
        $('#vehicle_id').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
            type: 'GET',
            url: '/reports/getClientVehicles/' + id,
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $('#vehicle_id').empty();
                $('#vehicle_id').append(`<option value="0" selected>Seleziona un veicolo</option>`);
                response.forEach(element => {
                    $('#vehicle_id').append(`<option value="${element['id']}" label="${element['brand']} ${element['model']} ${element['plate']} ">${element['brand']} ${element['model']} ${element['plate']} </option>`);
                });
            }
        });

        //Prendo i veicoli per il cliente che viene selezionato e li carico nel select
        $('#client_id').on('change', function () {
            let id = $(this).val();
            $('#vehicle_id').empty();
            $('#vehicle_id').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'GET',
                url: '/reports/getClientVehicles/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    $('#vehicle_id').empty();
                    $('#vehicle_id').append(`<option value="0" selected>Seleziona un veicolo</option>`);
                    response.forEach(element => {
                        $('#vehicle_id').append(`<option value="${element['id']}" label="${element['brand']} ${element['model']} ${element['plate']} ">${element['brand']} ${element['model']} ${element['plate']} </option>`);
                    });
                }
            });
        });

        //Prendo le ore del veicolo selezionato
        $('#vehicle_id').on('change', function () {
            let id = $(this).val();
            $('#hours').empty();
            $('#hours').val(`Processing...`);
            $.ajax({
                type: 'GET',
                url: '/reports/getVehicleHours/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    response.forEach(element => {
                        $('#hours').val(`${element['hours']}`);
                    });
                }
            });
        });

        //Seleziono il prezzo e la descrizione del prodotto selezionato
        $('#product_id').on('change', function () {
            let id = $(this).val();
            $('#sum').val(`Processing...`);
            $.ajax({
                type: 'GET',
                url: '/reports/getProductPrice/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    response.forEach(element => {
                        $('#sum').val(`${element['s_price']}`);
                        s_price = `${element['s_price']}`;
                    });
                }
            });
            $.ajax({
                type: 'GET',
                url: '/reports/getProductDescription/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    response.forEach(element => {
                        $('#description').val(`${element['description']}`);
                        description = `${element['description']}`;
                    });
                }
            });
        });

        //Aggiorno la somma in base alla quantità imposta
        $('#qta').on('change', function () {
            t_price = $(this).val() * s_price;
            $('#sum').val(t_price.toFixed(2));
        });

    });
</script>
