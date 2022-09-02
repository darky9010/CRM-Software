<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('site.edit_contact') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="w-full" name="vehicles/create" id="vehicles/create" method="post"
                          action="{{ route('contacts.update',['locale'=>app()->getLocale(), 'contact'=>$contact->id]) }}">
                        @csrf
                        @method('patch')
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/4 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.name') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="name" name="name" value="{{$contact->name}}" class="form-control" required="">
                            </div>
                            <div class="w-full md:w-1/4 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.surname') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="surname" name="surname" value="{{$contact->surname}}"  class="form-control" required="">
                            </div>
                            <div class="w-full md:w-1/4 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.mail') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="mail" name="mail" value="{{$contact->mail}}"  class="form-control" required="">
                            </div>
                            <div class="w-full md:w-1/4 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.phone') }}</label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    type="text" id="phone" name="phone" value="{{$contact->phone}}"  class="form-control" required="">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <div class="relative">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">{{ __('site.supplier') }}</label>
                                    <p>{{$contact->company->name}} {{$contact->company->address}} {{$contact->company->city}}</p>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                                class="shadow bg-primary hover:bg-secondary text-white focus:shadow-outline focus:outline-none font-bold py-2 px-4 rounded">
                            {{ __('site.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
