<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead
        class="text-s text-white uppercase bg-primary">
    <tr class="border-l-8 border-l-primary">
        <th scope="col" class="px-6 py-3">
            {{ __('site.number') }}
        </th>
        <th scope="col" class="px-6 py-3">
            {{ __('site.client') }}
        </th>
        <th scope="col" class="px-6 py-3">
            {{ __('site.vehicles') }}
        </th>
        <th scope="col" class="px-6 py-3 text-right">
            {{ __('site.total') }}
        </th>
        <th scope="col" class="px-6 py-3 text-right">
            {{ __('site.iva') }}
        </th>
        <th scope="col" class="px-6 py-3 text-center">
            {{ __('site.edit') }}
        </th>
        <th scope="col" class="px-6 py-3 text-center">
            {{ __('site.download') }}
        </th>
        <th scope="col" class="px-6 py-3 text-center">
            {{ __('site.delete') }}
        </th>
    </tr>
    </thead>
    <tbody class="data bg-white dark:bg-slate-800">
    @foreach($reports as $report)
        @php
            $status = '';
            if(date_add(date_create_from_format('Y-m-d H:i:s',$report->date),date_interval_create_from_date_string("30 days")) <= now() && $report->status != 'close'){
                $status = 'late';
            }
            else{
                $status = $report->status;
            }
        @endphp
        <tr class="{{$status}} border-b border-b-slate-500 dark:border-b-gray-700 hover:bg-gray-200 dark:hover:bg-gray-500">
            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ $report->name }}</td>
            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$report->client->name}} {{$report->client->surname}}</td>
            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                @foreach($report->vehicles as $vehicle)
                    @if (!is_null($vehicle->id))
                        {{$vehicle->brand}} {{$vehicle->model}} {{$vehicle->plate}} <br>
                    @endif
                @endforeach
            </td>
            <td class="px-6 py-4 font-medium sm:text-right text-gray-900 dark:text-white whitespace-nowrap">{{number_format($report->total,2,".","'")}} escl. IVA</td>
            <td class="px-6 py-4 font-medium sm:text-right text-gray-900 dark:text-white whitespace-nowrap">{{$report->tax}}%</td>
            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap text-center">
                <form method="POST"
                      action="{{ route('reports.edit', ['locale'=>app()->getLocale(),'report'=>$report->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('GET') }}
                    <button type="submit"
                            class="text-primary hover:text-secondary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>
                </form>
            </td>
            <td class="px-6 py-4 text-center">
                <form method="POST" class="inline"
                      action="{{ route('document.update', ['locale'=>app()->getLocale(),'id'=>$report->id]) }}">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <button type="submit"
                            class="text-primary hover:text-secondary">
                        <svg class="w-6 h-6 inline" fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                    </button>
                </form>
                @if($report->type == 'Fattura')
                    <form method="GET" class="inline"
                          action="{{ route('document.qr', ['locale'=>app()->getLocale(),'id'=>$report->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('GET') }}
                        <button type="submit"
                                class="text-primary hover:text-secondary">
                            <svg class="w-6 h-6 inline" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                            </svg>
                        </button>
                    </form>
                @endif
            </td>
            <td class="p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">
                <!-- Modal toggle -->
                <button id="smallButton"
                        data-attr="{{ route('report.delete', ['locale'=>app()->getLocale(),'report'=>$report->id,'type'=>$report->type]) }}"
                        class="text-primary hover:text-secondary"
                        type="button"
                        data-modal-toggle="popup-modal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="px-5 py-5 pagination">
    {{ $reports->links() }}
</div>
