<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.storage') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm">
                <div class="relative overflow-x-auto shadow-md">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-s text-white uppercase bg-primary">
                        <tr>
                            <th class="px-6 py-3">
                                {{ __('site.name') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.serial') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.description') }}
                            </th>
                            <th class="px-6 py-3 text-right">
                                {{ __('site.storage') }}
                            </th>
                            <th class="px-6 py-3 text-right">
                                {{ __('site.ordered') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.position') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.edit') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.delete') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800">
                        @foreach($products as $product)
                            <tr class="bg-white hover:bg-gray-200 border-b dark:bg-slate-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $product->name }}
                                </td>
                                <td class="px-6 py-4">
                                    @foreach($product->companies as $company)
                                        {{$company->pivot->serial_n}}
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">{{ $product->description }}</td>
                                <td class="px-6 py-4 text-right">{{$product->stock}}</td>
                                <td class="px-6 py-4 text-right">{{$product->in_order}}</td>
                                <td class="px-6 py-4 text-right">{{$product->location_A}} - {{$product->location_B}} - {{$product->location_C}}</td>
                                <td class="px-6 py-4 text-center">
                                    <form method="POST"
                                          action="{{ route('products.edit',['locale'=>app()->getLocale(), 'product'=>$product->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('GET') }}
                                        <button type="submit"
                                                class="font-medium text-primary">
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
                                        <button class="font-medium text-primary" type="submit">
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
