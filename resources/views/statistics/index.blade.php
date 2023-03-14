<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('site.Statistiche') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="flex">
                    <div class="w-1 lg:w-1/2 p-8">
                        <h1>{{ $reportYear->options['chart_title'] }}</h1>
                        {!! $reportYear->renderHtml() !!}
                    </div>
                    <div class="w-1 lg:w-1/2 p-8">
                        <h1>{{ $reportMonth->options['chart_title'] }}</h1>
                        {!! $reportMonth->renderHtml() !!}
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1 lg:w-1/2 p-8">
                        <h1>{{ $reportClient->options['chart_title'] }}</h1>
                        {!! $reportClient->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{!! $reportYear->renderChartJsLibrary() !!}
{!! $reportYear->renderJs() !!}
{!! $reportMonth->renderJs() !!}
{!! $reportClient->renderJs() !!}
