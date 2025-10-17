<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.clients') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm">
                <div class="p-6">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/5 px-3">
                            <a href="{{ route('clients.create', app()->getLocale()) }}"
                               class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4">
                                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg> {{ __('site.add_client') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm">
                <div class="p-6">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-3/12 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2">{{ __('site.client') }}</label>
                            <select
                                class="select2 block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="client" id="client">
                                <option value="0" selected>{{ __('site.select') }}</option>
                                @foreach($names as $name)
                                    <option
                                        value="{{ $name->id}}">{{$name->name}} {{$name->surname}}
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-2/12 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2">{{ __('site.language') }}</label>
                            <select
                                class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="language" id="language">
                                <option value="0" selected>{{__('site.all')}}</option>
                                <option value="d">Deutsch</option>
                                <option value="f">Französisch</option>
                                <option value="i">Italienisch</option>
                            </select>
                        </div>
                        <div class="w-full md:w-3/12 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2">{{ __('site.category') }}</label>
                            <select
                                class="select2 block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="category" id="category">
                                <option value="0" selected>{{ __('site.select') }}</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id}}">{{$category->name}}
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">

                            <div class="relative">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-white text-xs font-bold mb-2">{{ __('site.subcategory') }}</label>
                                <select
                                    class="select2 block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    name="child" id="child">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-10">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm">
                <div class="data overflow-x-auto shadow-md">
                    @include('clients.child')
                </div>
            </div>
        </div>
</x-app-layout>

<script>

    //filtro clienti
    $('#client').on('change', function () {
        let client = $(this).val();
        let language = "";
        let page = 1;
        let category = 0;
        history.pushState(null, null, '?page=' + page + '&client=' + client + '&language=' + language + '&category=' + category);
        $.ajax({
            url: "clients/?page=" + page + '&client=' + client + '&language=' + language + '&category=' + category,
            method: "GET",
            data: {client: client,language: language, category: category},
            success: function (data) {
                $('.data').html(data);
            }
        });
    });

    //filtro per tipo
    $('#language').on('change', function () {
        let language = $(this).val();
        let client = 0;
        let page = 1;
        let category = 0;
        history.pushState(null, null, '?page=' + page + '&client=' + client + '&language=' + language + '&category=' + category);
        $.ajax({
            url: "clients/?page=" + page + '&client=' + client + '&language=' + language + '&category=' + category,
            method: "GET",
            data: {client: client,language: language, category: category},
            success: function (data) {
                $('.data').html(data);
            }
        });
    });

    //filtro per categoria
    $('#category').on('change', function () {
        let category = $(this).val();
        let language = "";
        let client = 0;
        let page = 1;
        let id = $(this).val();

        $('#child').empty();
        $('#child').append(`<option value="${category}" selected>All</option>`);
        $.ajax({
            type: 'GET',
            url: '/categories/getChildCategory/' + id,
            success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                response.forEach(element => {
                    $('#child').append(`<option value="${element['id']}" label="${element['name']} ">${element['name']}</option>`);
                });
            }
        });

        history.pushState(null, null, '?page=' + page + '&client=' + client + '&language=' + language + '&category=' + category);
        $.ajax({
            url: "clients/?page=" + page + '&client=' + client + '&language=' + language + '&category=' + category,
            method: "GET",
            data: {client: client,language: language, category: category},
            success: function (data) {
                $('.data').html(data);
            }
        });
    });

    //filtro per categoria
    $('#child').on('change', function () {
        let category = $(this).val();
        let language = "";
        let client = 0;
        let page = 1;
        let id = $('#child').val();

        history.pushState(null, null, '?page=' + page + '&client=' + client + '&language=' + language + '&category=' + category);
        $.ajax({
            url: "clients/?page=" + page + '&client=' + client + '&language=' + language + '&category=' + category,
            method: "GET",
            data: {client: client,language: language, category: category},
            success: function (data) {
                $('.data').html(data);
            }
        });
    });


    $(document).ready(function () {
        $(document).on('click', '.relative', function (event) {
            let language = $('#language').children("option:selected").val();
            let client = $('#client').children("option:selected").val();
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            history.pushState(null, null, '?page=' + page + '&client=' + client + '&language=' + language);
            fetch_data(page);
        });

        function fetch_data(page) {
            let _token = $("input[name=_token]").val();
            let language = $('#language').children("option:selected").val();
            let client = $('#client').children("option:selected").val();
            $.ajax({
                url: "clients/?page=" + page + '&client=' + client + '&language=' + language,
                method: "GET",
                data: {_token: _token, page: page},
                success: function (data) {
                    $('.data').html(data);
                }
            });
        }
    });
</script>
