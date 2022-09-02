<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('site.products') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm">
                <div class="p-6">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/5 px-3">
                            <a href="{{ route('products.create', app()->getLocale()) }}"
                               class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4">
                                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg> {{ __('site.add_product') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-s text-white uppercase bg-primary">
                        <tr>
                            <th class="px-6 py-3">
                                {{ __('site.name') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.serials') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.description') }}
                            </th>
                            <th class="px-6 py-3 text-right">
                                {{ __('site.purchase_price') }}
                            </th>
                            <th class="px-6 py-3 text-right">
                                {{ __('site.selling_price') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.suppliers') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.edit') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.delete') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-700">
                        @foreach($products as $product)
                            <tr class="border-slate-500 dark:border-gray-500 hover:bg-gray-200 dark:hover:bg-gray-500 border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white ">{{ $product->name }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white ">
                                    @foreach($product->companies as $company)
                                        {{$company->pivot->serial_n}}<br>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white ">{{ $product->description }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white text-right">{{number_format($product->b_price,2,".","'")}}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white text-right">{{number_format($product->s_price,2,".","'")}}</td>
                                <td class="px-6 py-4 text-center">
                                    <form method="POST"
                                          action="{{ route('products.show',['locale'=>app()->getLocale(),'product'=>$product->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('GET') }}
                                        <button type="submit"
                                                class="text-primary hover:text-secondary">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form method="POST"
                                          action="{{ route('products.edit',['locale'=>app()->getLocale(), 'product'=>$product->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('GET') }}
                                        <button type="submit"
                                                class="text-primary hover:text-secondary">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form method="POST"
                                          action="{{ route('products.destroy',['locale'=>app()->getLocale(),'product'=>$product->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="text-primary hover:text-secondary" type="submit">
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
                    <div class="px-5 py-5">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
