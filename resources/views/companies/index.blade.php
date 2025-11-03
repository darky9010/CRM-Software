<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.suppliers') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm">
                <div class="p-6">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/5 px-3">
                            <a href="{{ route('companies.create', app()->getLocale()) }}"
                               class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4">
                                <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                </svg> {{ __('site.add_supplier') }}</a>
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
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-s text-white uppercase bg-primary dark:text-white">
                        <tr>
                            <th class="px-6 py-3">
                                {{ __('site.name') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.address') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.contacts') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.details') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.products') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.edit') }}
                            </th>
                            <th class="px-6 py-3">
                                {{ __('site.delete') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr class="bg-white hover:bg-gray-200 border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $company->name }}</td>
                                <td class="px-6 py-4">{{$company->address}}
                                    <br>{{$company->postal_code}} {{$company->city}} {{$company->region}}</td>
                                <td class="px-6 py-4"><a href="tel:{{$company->phone}}">{{$company->phone}}</a><br><a
                                        href="{{$company->site}}" target="_blank">{{$company->site}}</a><br><a
                                        href="mailto:{{$company->mail}}">{{$company->mail}}</a></td>
                                <td class="px-6 py-4">
                                    @foreach($company->contacts as $contact)
                                        - {{ $contact->name}} {{ $contact->surname }} {{ $contact->phone}} <br>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form method="POST"
                                          action="{{ route('companies.show',['locale'=>app()->getLocale(),'company'=>$company->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('GET') }}
                                        <button type="submit"
                                                class="font-medium text-primary">
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
                                          action="{{ route('companies.edit',['locale'=>app()->getLocale(),'company'=>$company->id]) }}">
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
                                          action="{{ route('companies.destroy',['locale'=>app()->getLocale(),'company'=>$company->id]) }}">
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
                        {{$companies->links() }}
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
