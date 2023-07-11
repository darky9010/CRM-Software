<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.edit_settings') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('dashboard', app()->getLocale()) }}"
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
            <div class="bg-white bg-slate-800 overflow-hidden shadow-sm">
                <div class="p-6">
                    <form class="w-full" name="products/update" id="products/update" method="post"
                          action="{{ route('settings.update', ['locale'=>app()->getLocale(),'setting'=>$setting->id])}}">
                        @csrf
                        @method('patch')
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/3 px-3">
                                <label
                                    class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2">{{ __('site.name') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="name" name="name" value="{{$setting->name}}" class="form-control"
                                    required="">
                            </div>
                            <div class="w-full md:w-1/3 px-3">
                                <label
                                    class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2">{{ __('site.address') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="address" name="address" value="{{$setting->address}}" class="form-control"
                                    required="">
                            </div>
                            <div class="w-full md:w-1/3 px-3">
                                <label
                                    class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2">{{ __('site.postal_code') }} {{ __('site.city') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="postal_code" name="postal_code" value="{{$setting->postal_code}}" class="form-control"
                                    required="">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/3 px-3">
                                <label
                                    class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2">{{ __('site.language') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="lang" name="lang" value="{{$setting->lang}}" class="form-control"
                                    required="">
                            </div>
                            <div class="w-full md:w-1/3 px-3">
                                <label
                                    class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2">{{ __('site.bank_name') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="bank_name" name="bank_name" value="{{$setting->bank_name}}" class="form-control"
                                    required="">
                            </div>
                            <div class="w-full md:w-1/3 px-3">
                                <label
                                    class="block uppercase tracking-wide dark:text-white text-gray-700 text-xs font-bold mb-2">{{ __('site.bank_account') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="bank_account" name="bank_account" value="{{$setting->bank_account}}" class="form-control"
                                    required="">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <button type="submit"
                                        class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4">
                                    {{ __('site.edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
