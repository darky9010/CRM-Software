<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.edit_client') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('clients.index', app()->getLocale()) }}"
               class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4">
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
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="w-full" name="clients/update" id="clients/update" method="post"
                          action="{{ route('clients.update',['locale'=>app()->getLocale(),'client'=>$client->id])}}">
                        @csrf
                        @method('patch')
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/5 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.type') }}</label>
                                <select
                                    class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    name="title" id="title">
                                    <option value="Signore"
                                            @if($client->title == 'Signore')
                                            selected
                                        @endif
                                    >Signore
                                    </option>
                                    <option value="Signora"
                                            @if($client->title == 'Signora')
                                            selected
                                        @endif
                                    >Signora
                                    </option>
                                    <option value="Ditta"
                                            @if($client->title == 'Ditta')
                                            selected
                                        @endif
                                    >Ditta
                                    </option>
                                </select>
                            </div>
                            <div class="w-full md:w-1/5 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.individual_company') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="name" name="name" value="{{$client->name}}" class="form-control"
                                    required="">
                            </div>
                            <div class="w-full md:w-1/5 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.surname') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="surname" name="surname" value="{{$client->surname}}"
                                    class="form-control">
                            </div>
                            <div class="w-full md:w-1/5 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.phone') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="phone" name="phone" value="{{$client->phone}}"
                                    class="form-control" required="">
                            </div>
                            <div class="w-full md:w-1/5 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.mail') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="mail" name="mail" value="{{$client->mail}}"
                                    class="form-control" required="">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-2/5 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.addess') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="address" name="address" value="{{$client->address}}"
                                    class="form-control" required="">
                            </div>
                            <div class="w-full md:w-1/5 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.postal_code') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="postal_code" name="postal_code" value="{{$client->postal_code}}"
                                    class="form-control" required="">
                            </div>
                            <div class="w-full md:w-1/5 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.city') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="city" name="city" value="{{$client->city}}" class="form-control"
                                    required="">
                            </div>
                            <div class="w-full md:w-1/5 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.region') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="region" name="region" value="{{$client->region}}"
                                    class="form-control" required="">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-3/3 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.note') }}</label>
                                <textarea
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    name="note" class="form-control" >{{$client->note}}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-3/3 px-3">
                                <a class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4"
                                   href="{{ route('vehicle.create',['locale'=>app()->getLocale(),'client_id'=>$client->id]) }}">
                                    {{ __('site.add_vehicle') }}
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-3/3 px-3">
                                <button type="submit"
                                        class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4">
                                    {{ __('site.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <table class="border-collapse table-auto w-full text-sm mt-7">
                            <thead class="bg-primary text-white">
                            <tr class="border-b dark:border-slate-600 font-medium">
                                <th class="p-2 pl-8 text-left">
                                    {{ __('site.brand') }}
                                </th>
                                <th class="p-2 pl-8 text-left">
                                    {{ __('site.model') }}
                                </th>
                                <th class="p-2 pl-8 text-left">
                                    {{ __('site.plate') }}
                                </th>
                                <th class="p-2 pl-8 text-right">
                                    {{ __('site.hours') }}
                                </th>
                                <th class="p-2 pl-8 text-center">
                                    {{ __('site.edit') }}
                                </th>
                                <th class="p-2 pl-8 text-center">
                                    {{ __('site.delete') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-800">
                            @foreach($client->vehicles as $vehicle)
                                <tr class="hover:bg-gray-200">
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        type="hidden" id="vehicle_id" name="vehicle_id" value="{{ $vehicle->id }}"
                                        class="form-control" required="">
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $vehicle->brand }}
                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $vehicle->model }}
                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $vehicle->plate }}
                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-right">
                                        {{ $vehicle->hours }}
                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">
                                        <form method="POST"
                                              action="{{ route('vehicles.edit',['locale'=>app()->getLocale(),'vehicle'=>$vehicle->id]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('GET') }}
                                            <button type="submit"
                                                    class="font-medium text-primary dark:text-secondary">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">
                                        <form method="POST"
                                              action="{{ route('vehicles.destroy',['locale'=>app()->getLocale(),'vehicle'=>$vehicle->id]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="cursor-not-allowed font-medium text-primary dark:text-secondary" type="submit" disabled>
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
    </div>
</x-app-layout>
