<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.suppliers') }} {{ $product->name }} - {{$product->description}}
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->companies as $company)
                            <tr class="bg-white hover:bg-gray-200 border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $company->pivot->serial_n }}</td>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>
