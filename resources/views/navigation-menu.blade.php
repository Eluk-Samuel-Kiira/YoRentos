<nav x-show="open" class="hidden md:block bg-white shadow-lg w-full md:w-1/6 min-h-screen fixed inset-y-0 flex flex-col justify-left items-left md:items-start">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">    
        <div class="flex bg-white shadow">    
            <div class="flex-shrink-0 flex items-left justify-center w-full py-4">
                <x-application-mark class="block h-9 w-auto" />
            </div>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex" style="margin-left: -10px;">
            <div class="flex flex-wrap justify-left">
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                @can('view unit')
                    <x-responsive-nav-link href="{{ route('my.unit') }}" :active="request()->routeIs('my.unit')">
                        {{ __('My Units') }}
                    </x-responsive-nav-link>
                @endcan 
                @can('view amount')
                    <x-responsive-nav-link href="{{ route('feedback.index') }}" :active="request()->routeIs('feedback.index')">
                        {{ __('Feedback') }}
                    </x-responsive-nav-link>
                @endcan 
                <!-- Users Dropdown -->
                @can('view user')
                    <div x-data="{ isOpenUser: false, init() { this.isOpenUser = window.location.href.includes('/user') || window.location.href.includes('/role-permissions'); } }" 
                        class="inline-flex relative">
                        <x-responsive-nav-link>
                            <button @click="isOpenUser = !isOpenUser" class="inline-flex px-4 py-2 font-medium focus:outline-none transition duration-150 ease-in-out">
                                {{__('Users & Roles')}}
                                <span class="select-none absolute inset-y-0 right-0 flex items-center cursor-pointer pr-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </button>
                        </x-responsive-nav-link>

                        <div x-show="isOpenUser" class="absolute z-50 top-full left-0 w-full mt-1 bg-white shadow-lg">
                            <x-responsive-nav-link href="{{ route('user') }}" :active="request()->routeIs('user')">
                                {{ __('Users List') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('role-permissions') }}" :active="request()->routeIs('role-permissions')">
                                {{ __('Roles & Permissions') }}
                            </x-responsive-nav-link>
                        </div>
                    </div>
                @endcan
                <div x-data="{ isOpenRental: false }" 
                    class="inline-flex relative">
                    <x-responsive-nav-link>
                        <button @click="isOpenRental = !isOpenRental" class="inline-flex px-4 py-2 font-medium focus:outline-none transition duration-150 ease-in-out">
                            {{__('Rental Estates')}}
                            <span class="select-none absolute inset-y-0 right-0 flex items-center cursor-pointer pr-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </button>
                    </x-responsive-nav-link>

                    <div x-show="isOpenRental" class="absolute z-50 top-full left-0 w-full mt-1 bg-white shadow-lg">
                        @can('view rentals')
                            <x-responsive-nav-link href="{{ route('rental.index') }}" :active="request()->routeIs('rental.index')">
                                {{ __('Rental Type') }}
                            </x-responsive-nav-link>
                        @endcan
                        @can('view estate')
                            <x-responsive-nav-link href="{{ route('rental.estate') }}" :active="request()->routeIs('rental.estate')">
                                {{ __('Rental Estate') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('estate.index') }}" :active="request()->routeIs('estate.index')">
                              {{ __('Estate Details') }}
                            </x-responsive-nav-link>
                        @endcan
                        @can('view unit')
                            <x-responsive-nav-link href="{{ route('unit.index') }}" :active="request()->routeIs('unit.index')">
                                {{ __('Estate Unit') }}
                            </x-responsive-nav-link>
                        @endcan
                    </div>
                </div>
                <!-- Locations Dropdown -->
                @role('Admin')
                    <div x-data="{ isOpenLocation: false }" 
                        class="inline-flex relative">
                        <x-responsive-nav-link> 
                            <button @click="isOpenLocation = !isOpenLocation" class="inline-flex px-4 py-2 font-medium focus:outline-none transition duration-150 ease-in-out">   
                                    {{__('Locations')}}
                                    <span class="select-none absolute inset-y-0 right-0 flex items-center cursor-pointer pr-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                            </button>
                        </x-responsive-nav-link>

                        <div x-show="isOpenLocation" class="absolute z-50 top-full left-0 w-full mt-1 bg-white shadow-lg">
                            <x-responsive-nav-link href="{{ route('duration.index') }}" :active="request()->routeIs('duration.index')">
                                {{ __('Durations') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('country.index') }}" :active="request()->routeIs('country.index')">
                                {{ __('Districts') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('county.index') }}" :active="request()->routeIs('county.index')">
                                {{ __('Counties') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('subcounty.index') }}" :active="request()->routeIs('subcounty.index')">
                                {{ __('Sub-Counties') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('parish.index') }}" :active="request()->routeIs('parish.index')">
                                {{ __('Parishes') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('village.index') }}" :active="request()->routeIs('village.index')">
                                {{ __('Villages') }}
                            </x-responsive-nav-link>
                        </div>
                    </div>
                @endrole
            </div>
        </div>  
    </div>       
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownContainer = document.querySelector('.inline-flex.relative');
        const url = window.location.href;

        if (url.includes('/user') || url.includes('/role-permissions')) {
            dropdownContainer.querySelector('button').click(); 
        }
    });

</script>
