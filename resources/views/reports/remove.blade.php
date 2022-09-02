<form action="{{ route('deletefromreport',['locale'=>app()->getLocale(),'report'=>$report->id,'product'=>$product->id]) }}" method="post">
    @csrf
    @method('DELETE')
    <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ __('site.delete_message') }}</h3>
    <button data-modal-toggle="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
        {{ __('site.delete') }}
    </button>
</form>
