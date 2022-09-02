<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.document_change') }}
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
                    <form class="w-full" name="reports/edit" id="reports/edit" method="post"
                          action="{{ route('reports.update',['locale'=>app()->getLocale(),'report'=>$report->id]) }}">
                        @csrf
                        @method('patch')
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/4 px-3">
                                <div class="relative">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.type') }}</label>
                                    <select
                                        class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        name="type" id="type">
                                        <option value="Fattura"
                                                @if($report->type == 'Fattura')
                                                selected
                                            @endif
                                        >Fattura
                                        </option>
                                        <option value="Bollettino"
                                                @if($report->type == 'Bollettino')
                                                selected
                                            @endif
                                        >Bollettino
                                        </option>
                                        <option value="Ricevuta"
                                                @if($report->type == 'Ricevuta')
                                                selected
                                            @endif
                                        >Ricevuta
                                        </option>
                                        <option value="Offerta"
                                                @if($report->type == 'Offerta')
                                                selected
                                            @endif
                                        >Offerta
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full md:w-2/12 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.deadline_complaints') }}</label>
                                <input type="number" id="r_terms" name="r_terms"
                                       class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                       value="{{$report->r_terms}}" min="5" step="1">
                            </div>
                            <div class="w-full md:w-2/12 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.payment_terms') }}</label>
                                <input type="number" id="p_terms" name="p_terms"
                                       class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                       value="{{$report->p_terms}}" min="5" step="1">
                            </div>
                            <div class="w-full md:w-2/12 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.tax') }}</label>
                                <input type="number" id="tax" name="tax"
                                       class="form-control appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                       value="{{$report->tax}}"
                                       min="7.7" step="0.1">
                            </div>
                            <div class="w-full md:w-2/12 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.status') }}</label>
                                <select
                                    class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    name="status" id="status">
                                    <option value="open"
                                            @if($report->status == 'open')
                                            selected
                                        @endif
                                    >Aperto
                                    </option>
                                    <option value="close"
                                            @if($report->status == 'close')
                                            selected
                                        @endif
                                    >Chiuso
                                    </option>
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
                                        <option value="{{ $report->client_id }}"
                                                selected>{{$report->client->name}} {{$report->client->surname}} {{$report->client->city}}</option>
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
                                        @if (!is_null($report->vehicle_id))
                                            <option value="{{ $report->vehicle_id }}"
                                                    selected>{{$report->vehicle->brand}} {{$report->vehicle->model}} {{$report->vehicle->plate}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.hours') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="hours" name="hours" class="form-control"
                                    value="@if (!is_null($report->vehicle_id)){{ $report->vehicle->hours }}@endif">
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
                            <div class="w-full md:w-4/12 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.description') }}</label>
                                <textarea
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    style="white-space: pre-wrap;" id="description" name="description"
                                    class="form-control"></textarea>
                            </div>
                            <div class="w-full md:w-2/12 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.quantity') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="qta" name="qta" class="form-control" value="1" min="0.05"
                                    step="0.05">
                            </div>
                            <div class="w-full md:w-2/12 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.price') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="sum" name="sum" class="form-control" min="00.00"
                                    step="0.05">
                            </div>
                        </div>
                        <button type="submit"
                                class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4 rounded">
                            {{ __('site.add_save') }}
                        </button>
                    </form>
                    <table class="border-collapse table-auto w-full text-sm mt-7">
                        <thead class="bg-primary text-white">
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-2 pl-8 text-left">
                                {{ __('site.product') }}
                            </th>
                            <th class="border-b dark:border-slate-600 font-medium p-2 pl-8 text-left">
                                {{ __('site.description') }}
                            </th>
                            <th class="border-b dark:border-slate-600 font-medium p-2 pl-8 text-right">
                                {{ __('site.quantity') }}
                            </th>
                            <th class="border-b dark:border-slate-600 font-medium p-2 pl-8 text-right">
                                {{ __('site.price') }}
                            </th>
                            <th class="border-b dark:border-slate-600 font-medium p-2 pl-8 text-center">
                                {{ __('site.delete') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800">
                        @foreach($report->products as $product)
                            <tr class="hover:bg-gray-200">
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $product->name }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    <p style="white-space: pre-line">{{ $product->pivot->description }}</p></td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-right">{{ $product->pivot->qta }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-right">{{number_format($product->pivot->sum,2,".","'")}}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">
                                    <form method="POST"
                                          action="{{ route('remove.product',['locale'=>app()->getLocale(),'report'=>$report->id,'product'=>$product->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="font-medium text-primary dark:text-secondary" type="submit">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function () {
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
                        $('#vehicle_id').append(`<option value="${element['id']}">${element['brand']} ${element['model']} ${element['plate']} </option>`);
                    });
                }
            });
        });

        $('#vehicle_id').on('change', function () {
            let id = $(this).val();
            $('#hours').val(`Elaborazione...`);
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

        $('#product_id').on('change', function () {
            let id = $(this).val();
            $('#description').val(`Elaborazione...`);
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
            $('#sum').val(`Elaborazione...`);
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
        });

        $('#qta').on('change', function () {
            t_price = $(this).val() * s_price;
            $('#sum').val(t_price.toFixed(2));
        });
    });
</script>
