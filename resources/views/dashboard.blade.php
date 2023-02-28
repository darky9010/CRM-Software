<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('site.home') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm">
                <div class="p-6">
                    <div class="flex flex-wrap -mx-3">
                        <div class="px-3">
                            <div class="group cursor-pointer relative inline-block text-center"><a href="{{ route('reports.create', app()->getLocale()) }}"
                               class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4">
                                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg><div class="opacity-0 w-28 bg-black text-white text-center text-xs py-1 absolute z-10 group-hover:opacity-100 bottom-full -left-1/2 px-2 pointer-events-none">
                                        {{ __('site.new_document') }}
                                        <svg class="absolute text-black h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0"/></svg>
                                    </div></a></div>
                        </div>
                        <div class="px-3">
                            <div class="group cursor-pointer relative inline-block text-center"><a href="{{ route('products.create', app()->getLocale()) }}"
                               class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4">
                                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg><div class="opacity-0 w-28 bg-black text-white text-center text-xs py-1 absolute z-10 group-hover:opacity-100 bottom-full -left-1/2 px-2 pointer-events-none">
                                        {{ __('site.add_product') }}
                                        <svg class="absolute text-black h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0"/></svg>
                                    </div></a></div>
                        </div>
                        <div class="px-3">
                            <div class="group cursor-pointer relative inline-block text-center"><a href="{{ route('clients.create', app()->getLocale()) }}"
                               class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4">
                                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg><div class="opacity-0 w-28 bg-black text-white text-center text-xs py-1 absolute z-10 group-hover:opacity-100 bottom-full -left-1/2 px-2 pointer-events-none">
                                        {{ __('site.add_client') }}
                                        <svg class="absolute text-black h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0"/></svg>
                                    </div></a></div>
                        </div>
                        <div class="px-3">
                            <div class="group cursor-pointer relative inline-block text-center"><a href="{{ route('companies.create', app()->getLocale()) }}"
                               class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4">
                                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                </svg> <div class="opacity-0 w-28 bg-black text-white text-center text-xs py-1 absolute z-10 group-hover:opacity-100 bottom-full -left-1/2 px-2 pointer-events-none">
                                    {{ __('site.add_supplier') }}
                                    <svg class="absolute text-black h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0"/></svg>
                                </div></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm">
                <div class="p-6">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-2/12 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.type') }}</label>
                            <select
                                class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="type" id="type">
                                <option value="Fattura" selected>Fatture</option>
                                <option value="Bollettino">Bollettini</option>
                                <option value="Ricevuta">Ricevute</option>
                                <option value="Offerta">Offerte</option>
                            </select>
                        </div>
                        <div class="w-full md:w-2/12 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.status') }}</label>
                            <select
                                class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="status" id="status">
                                <option value="0" selected>{{__('site.all')}}</option>
                                <option value="open" selected>{{__('site.open')}}</option>
                                <option value="close">{{__('site.close')}}</option>
                            </select>
                        </div>
                        <div class="w-full md:w-3/12 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.client') }}</label>
                            <select
                                class="select2 block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="client" id="client">
                                <option value="0" selected>{{ __('site.select') }}</option>
                                @foreach($clients as $client)
                                    <option
                                        value="{{ $client->client_id}}">{{$client->client->name}} {{$client->client->surname}}
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800">
                <div class="bg-white overflow-hidden shadow-sm ">
                    <div class="data overflow-x-auto shadow-md">
                        @include('reports.child')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>

    //filtro stato del documento
    $('#status').on('change', function () {
        let status = $(this).val();
        let type = $('#type').val();
        let client = $('#client').val();
        let page = 1;
        history.pushState(null, null, '?page=' + page + '&status=' + status + '&type=' + type + '&client=' + client);
        $.ajax({
            url: "dashboard/?page=" + page + '&status=' + status + '&type=' + type + '&client=' + client,
            method: "GET",
            data: {status: status, type: type, client: client},
            success: function (data) {
                $('.data').html(data);
            }
        });
    });

    //filtro tipo di documento
    $('#type').on('change', function () {
        let type = $(this).val();
        let status = $('#status').val();
        let client = $('#client').val();
        let page = 1;
        history.pushState(null, null, '?page=' + page + '&status=' + status + '&type=' + type + '&client=' + client);
        $.ajax({
            url: "dashboard/?page=" + page + '&status=' + status + '&type=' + type + '&client=' + client,
            method: "GET",
            data: {status: status, type: type, client: client},
            success: function (data) {
                $('.data').html(data);
            }
        });
    });

    //filtro per nome del cliente
    $('#client').on('change', function () {
        let client = $(this).val();
        let type = $('#type').val();
        let status = $('#status').val();
        let page = 1;
        history.pushState(null, null, '?page=' + page + '&status=' + status + '&type=' + type + '&client=' + client);
        $.ajax({
            url: "dashboard/?page=" + page + '&status=' + status + '&type=' + type + '&client=' + client,
            method: "GET",
            data: {status: status, type: type, client: client},
            success: function (data) {
                $('.data').html(data);
            }
        });
    });

    $(document).ready(function () {
        $('#relative').click(function (event){
            let status = $('#status').children("option:selected").val();
            let type = $('#type').children("option:selected").val();
            let client = $('#client').children("option:selected").val();
            event.preventDefault();
            let page = $(this).attr('href')?.split('page=')[1];
            history.pushState(null, null, '?page=' + page + '&status=' + status + '&type=' + type + '&client=' + client);
            fetch_data(page);
        })

        function fetch_data(page) {
            let _token = $("input[name=_token]").val();
            let status = $('#status').children("option:selected").val();
            let type = $('#type').children("option:selected").val();
            let client = $('#client').children("option:selected").val();
            $.ajax({
                url: "dashboard/?page=" + page + '&status=' + status + '&type=' + type + '&client=' + client,
                method: "GET",
                data: {_token: _token, page: page},
                success: function (data) {
                    $('.data').html(data);
                }
            });
        }
    });

</script>
