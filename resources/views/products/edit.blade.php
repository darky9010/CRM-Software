<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.edit_product') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('products.index', app()->getLocale()) }}"
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
                    <form class="w-full" name="products/update" id="products/update" method="post"
                          action="{{ route('products.update', ['locale'=>app()->getLocale(),'product'=>$product->id])}}">
                        @csrf
                        @method('patch')
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/3 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.name') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="name" name="name" value="{{$product->name}}" class="form-control"
                                    required="">
                            </div>
                            <div class="w-full md:w-1/3 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.unit') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="unit" name="unit" value="{{$product->unit}}" class="form-control"
                                    required="">
                            </div>
                            <div class="w-full md:w-1/3 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.description') }}</label>
                                <textarea
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    name="description" class="form-control"
                                    required="">{{$product->description}}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.purchase_price') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="b_price" name="b_price" class="form-control" min="00.00"
                                    value="{{$product->b_price}}" step=".01" required="">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.selling_price') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="s_price" name="s_price" class="form-control" min="00.00"
                                    value="{{$product->s_price}}" step=".05" required="">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/6 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.storage') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="stock" name="stock" class="form-control" min="0"
                                    value="{{$product->stock}}"
                                    step="1" required="">
                            </div>
                            <div class="w-full md:w-1/6 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.ordered') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="in_order" name="in_order" class="form-control" min="0"
                                    value="{{$product->in_order}}" step="1" required="">
                            </div>
                            <div class="w-full md:w-1/6 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.minimum_amount') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="re_order" name="re_order" class="form-control" min="1"
                                    value="{{$product->re_order}}" step="1" required="">
                            </div>
                            <div class="w-full md:w-1/6 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.position_a') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="location_A" name="location_A" class="form-control" min="1"
                                    value="{{$product->location_A}}" step="1" required="">
                            </div>
                            <div class="w-full md:w-1/6 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.position_b') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="location_B" name="location_B" class="form-control" min="1"
                                    value="{{$product->location_B}}" step="1" required="">
                            </div>
                            <div class="w-full md:w-1/6 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.position_c') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="number" id="location_C" name="location_C" class="form-control" min="1"
                                    value="{{$product->location_C}}" step="1" required="">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <div class="relative">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.suppliers') }}</label>
                                    <select
                                        class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        name="company_id" id="company_id">
                                        @foreach($companies1 as $company1)
                                            <option value="{{ $company1->id }}">{{ $company1->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.serial') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="serial_n" name="serial_n" class="form-control" required="">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <button type="submit"
                                        class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4 rounded">
                                    {{ __('site.edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <label
                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.suppliers_serial') }}</label>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <table class="border-collapse table-auto w-full text-sm mt-7">
                            <thead class="bg-primary text-white">
                            <tr class="border-b dark:border-slate-600 font-medium">
                                <th class="p-2 pl-8 text-left">
                                    {{ __('site.name') }}
                                </th>
                                <th class="p-2 pl-8 text-left">
                                    {{ __('site.serial') }}
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
                            @foreach($product->companies as $company)
                                <tr class="hover:bg-gray-200">
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        type="hidden" id="vehicle_id" name="vehicle_id" value="{{ $company->id }}"
                                        class="form-control" required="">
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $company->name }}
                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $company->pivot->serial_n }}
                                    </td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">
                                        <form method="POST"
                                              action="{{ route('companies.edit',['locale'=>app()->getLocale(),'company'=>$company->id]) }}">
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
                                        <form method="POST" action="{{ route('companies.destroy',['locale'=>app()->getLocale(),'company'=>$company->id]) }}">
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
