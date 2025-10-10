<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-s text-white uppercase bg-primary dark:text-white">
    <tr>
        <th class="px-6 py-3">
            {{ __('site.individual_company') }}
        </th>
        <th class="px-6 py-3">
            {{ __('site.address') }}
        </th>
        <th class="px-6 py-3">
            {{ __('site.contacts') }}
        </th>
        <th class="px-6 py-3">
            {{ __('site.category') }}
        </th>
        <th class="px-6 py-3 text-center">
            {{ __('site.new_document') }}
        </th>
        <th class="px-6 py-3 text-center">
            {{ __('site.edit') }}
        </th>
        <th class="px-6 py-3 text-center">
            {{ __('site.delete') }}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr class="bg-white hover:bg-gray-200 border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-6 py-4">{{ $client->title}} {{ $client->rank }} {{ $client->name }} {{ $client->surname }}</td>
            <td class="px-6 py-4">{{$client->address}}
                <br>{{$client->postal_code}} {{$client->city}} {{$client->region}}</td>
            <td class="px-6 py-4"><a href="tel:{{$client->phone}}">{{$client->phone}}</a><br><a
                    href="mailto:{{$client->mail}}">{{$client->mail}}</a></td>
            <td class="px-6 py-4">
                @foreach($client->categories as $category)
                   {{ $category->parent?->name }} {{ $category->name}} - {{ $category->pivot->note }}<br>
                @endforeach
            </td>
            <td class="px-6 py-4 text-center">
                <form method="get"
                      action="{{ route('reports.usercreate',['locale'=>app()->getLocale(),'client_id'=>$client->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('GET') }}
                    <button type="submit"
                            class="font-medium text-primary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </button>
                </form>
            </td>
            <td class="px-6 py-4 text-center">
                <form method="POST"
                      action="{{ route('clients.edit',['locale'=>app()->getLocale(),'client'=>$client->id]) }}">
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
                      action="{{ route('clients.destroy',['locale'=>app()->getLocale(),'client'=>$client->id]) }}">
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
    {{ $clients->links() }}
</div>
