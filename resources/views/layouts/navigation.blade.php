<nav x-data="{ open: false }" class="bg-white dark:bg-slate-800 border-b border-gray-100 dark:border-gray-500">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard',app()->getLocale()) }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="route('dashboard',app()->getLocale())" :active="request()->routeIs('dashboard',app()->getLocale())">
                        {{ __('site.home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index',app()->getLocale())" :active="request()->routeIs('products.index',app()->getLocale())">
                        {{ __('site.products') }}
                    </x-nav-link>
                    <x-nav-link :href="route('clients.index',app()->getLocale())" :active="request()->routeIs('clients.index',app()->getLocale())">
                        {{ __('site.clients') }}
                    </x-nav-link>
                    <x-nav-link :href="route('companies.index',app()->getLocale())" :active="request()->routeIs('companies.index',app()->getLocale())">
                        {{ __('site.suppliers') }}
                    </x-nav-link>
                    <x-nav-link :href="route('archive',app()->getLocale())" :active="request()->routeIs('archive',app()->getLocale())">
                        {{ __('site.storage') }}
                    </x-nav-link>
                    <x-nav-link :href="route('statistics',app()->getLocale())" :active="request()->routeIs('statistics',app()->getLocale())">
                        {{ __('site.statistics') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <a href="{{ route('settings.edit',['locale'=>app()->getLocale(),'setting'=>1])}}" class="mx-2 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 dark:text-white text-primary hover:text-primary hover:border-primary focus:outline-none focus:text-primary focus:border-primary transition duration-150 ease-in-out">{{ __('site.options') }}</a>
                <a href="{{ route('instruction', ['locale'=>app()->getLocale(),'filename'=>'Istruzioni.pdf']) }}" class="mx-2 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 dark:text-white text-primary hover:text-primary hover:border-primary focus:outline-none focus:text-primary focus:border-primary transition duration-150 ease-in-out">{{ __('site.instructions') }}</a>
                <a href="mailto:melissa.laghi@mm-servizi.ch?subject=Feedback app MM Agricole" class="mx-2 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 dark:text-white text-primary hover:text-primary hover:border-primary focus:outline-none focus:text-primary focus:border-primary transition duration-150 ease-in-out">{{ __('site.suggestion') }}</a>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard',app()->getLocale())" :active="request()->routeIs('dashboard',app()->getLocale())">
                {{ __('site.home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index',app()->getLocale())" :active="request()->routeIs('products.index',app()->getLocale())">
                {{ __('site.products') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('clients.index',app()->getLocale())" :active="request()->routeIs('clients.index',app()->getLocale())">
                {{ __('site.clients') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('companies.index',app()->getLocale())" :active="request()->routeIs('companies.index',app()->getLocale())">
                {{ __('site.suppliers') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('archive',app()->getLocale())" :active="request()->routeIs('archive',app()->getLocale())">
                {{ __('site.storage') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('statistics',app()->getLocale())" :active="request()->routeIs('statistics',app()->getLocale())">
                {{ __('site.statistics') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <a href="{{ route('settings.index',app()->getLocale())}}" class="mx-2 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 dark:text-white text-primary hover:text-primary hover:border-primary focus:outline-none focus:text-primary focus:border-primary transition duration-150 ease-in-out">{{ __('site.options') }}</a>
                <a href="{{ route('instruction', ['locale'=>app()->getLocale(),'filename'=>'Istruzioni.pdf']) }}" class="mx-2 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 dark:text-white text-primary hover:text-primary hover:border-primary focus:outline-none focus:text-primary focus:border-primary transition duration-150 ease-in-out">{{ __('site.instructions') }}</a>
                <a href="mailto:melissa.laghi@mm-servizi.ch?subject=Feedback app MM Agricole" class="mx-2 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-bold leading-5 dark:text-white text-primary hover:text-primary hover:border-primary focus:outline-none focus:text-primary focus:border-primary transition duration-150 ease-in-out">{{ __('site.suggestion') }}</a>
            </div>

            <div class="mt-3 space-y-1">


            </div>
        </div>
    </div>
</nav>
