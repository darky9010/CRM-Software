<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.product_from ') }} {{$company->name}}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-s text-white uppercase bg-primary">
                        <tr>
                            <th class="px-6 py-3">
                                {{ __('site.serial') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.description') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.purchase_price') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.selling_price') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.storage') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.position') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800">
                        @foreach($company->products as $product)
                            <tr class="bg-white hover:bg-gray-200 border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{$product->pivot->serial_n}}</td>
                                <td class="px-6 py-4">{{ $product->description }}</td>
                                <td class="px-6 py-4 text-right">{{$product->b_price}}</td>
                                <td class="px-6 py-4 text-right">{{$product->s_price}}</td>
                                <td class="px-6 py-4 text-right">{{$product->stock}}</td>
                                <td class="px-6 py-4 text-center">{{$product->location_A}} || {{$product->location_B}}
                                    || {{$product->location_C}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>
