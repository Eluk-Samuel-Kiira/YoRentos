<div :class="{'block': openRes, 'hidden': ! openRes}" class="hidden sm:hidden pt-20">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
    </div>
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link href="{{ route('my.unit') }}" :active="request()->routeIs('income.index')">
            {{ __('My Units') }}
        </x-responsive-nav-link>
    </div>
    {{--@can('view user')
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link href="{{ route('user') }}" :active="request()->routeIs('user')">
            {{ __('Users') }}
        </x-responsive-nav-link>
    </div>
    @endcan
    @can('view rentals')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('rental.index') }}" :active="request()->routeIs('rental.index')">
                {{ __('Rentals') }}
            </x-responsive-nav-link>
        </div>
    @endcan
    @can('view estate')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('estate.index') }}" :active="request()->routeIs('estate.index')">
                {{ __('Estates') }}
            </x-responsive-nav-link>
        </div>
    @endcan
    @can('view unit')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('unit.index') }}" :active="request()->routeIs('unit.index')">
                {{ __('Units') }}
            </x-responsive-nav-link>
        </div>
    @endcan 
    @role('Admin')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('duration.index') }}" :active="request()->routeIs('duration.index')">
                {{ __('Durations') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('country.index') }}" :active="request()->routeIs('country.index')">
                {{ __('Districts') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('county.index') }}" :active="request()->routeIs('county.index')">
                {{ __('Counties') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('parish.index') }}" :active="request()->routeIs('parish.index')">
                {{ __('Parishes') }}
            </x-responsive-nav-link>
        </div>
    @endrole --}}
    @can('view amount')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('feedback.index') }}" :active="request()->routeIs('feedback.index')">
                {{ __('Feedback') }}
            </x-responsive-nav-link>
        </div>
        {{--<div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('income.index') }}" :active="request()->routeIs('income.index')">
                {{ __('Income') }}
            </x-responsive-nav-link>
        </div>--}}
    @endcan

    @can('view user')
        <div class="ms-3 relative">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="pt-2 pb-3 space-y-3 pl-1 text-gray-600 hover:text-gray-700">
                        {{__('Users')}}
                    </button>
                </x-slot>

                <x-slot name="content">
                    @can('view user')
                        <x-dropdown-link href="{{ route('user') }}">
                            {{ __('Users List') }}
                        </x-dropdown-link>
                    @endcan
                    <div class="border-t border-gray-200"></div>
                    @can('view user')
                        <x-dropdown-link href="{{ route('role-permissions') }}">
                            {{ __('Roles & Permissions') }}
                        </x-dropdown-link>
                    @endcan
                </x-slot>
            </x-dropdown>
        </div>
    @endcan

    <!-- Rentals Dropdown -->
    <div class="ms-3 relative">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="pt-2 pb-3 space-y-3 pl-1 text-gray-600 hover:text-gray-700">
                    {{__('Rentals')}}
                </button>
            </x-slot>

            <x-slot name="content">
                @can('view rentals')
                    <x-dropdown-link href="{{ route('rental.index') }}">
                        {{ __('Rental Block') }}
                    </x-dropdown-link>
                @endcan
                <div class="border-t border-gray-200"></div>
                @can('view estate')
                    <x-dropdown-link href="{{ route('rental.estate') }}">
                        {{ __('Rental Estate') }}
                    </x-dropdown-link>
                    <div class="border-t border-gray-200"></div>
                    <x-dropdown-link href="{{ route('estate.index') }}">
                        {{ __('Estate Details') }}
                    </x-dropdown-link>
                @endcan
                <div class="border-t border-gray-200"></div>
                @can('view unit')
                    <x-dropdown-link href="{{ route('unit.index') }}">
                        {{ __('Estate Unit') }}
                    </x-dropdown-link>
                @endcan
                <div class="border-t border-gray-200"></div>
            </x-slot>
        </x-dropdown>
    </div>

    <!-- Locations Dropdown -->
    @role('Admin')
        <div class="ms-3 relative">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="pt-2 pb-3 space-y-3 pl-1 text-gray-600 hover:text-gray-700">
                        {{__('Locations')}}
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link href="{{ route('duration.index') }}">
                        {{ __('Durations') }}
                    </x-dropdown-link>
                    <div class="border-t border-gray-200"></div>
                    <x-dropdown-link href="{{ route('country.index') }}">
                        {{ __('Districts') }}
                    </x-dropdown-link>
                    <div class="border-t border-gray-200"></div>
                    <x-dropdown-link href="{{ route('county.index') }}">
                        {{ __('Counties') }}
                    </x-dropdown-link>
                    <div class="border-t border-gray-200"></div>
                    <x-dropdown-link href="{{ route('subcounty.index') }}">
                        {{ __('Sub-Counties') }}
                    </x-dropdown-link>
                    <div class="border-t border-gray-200"></div>
                    <x-dropdown-link href="{{ route('parish.index') }}">
                        {{ __('Parishes') }}
                    </x-dropdown-link>
                    <div class="border-t border-gray-200"></div>
                    <x-dropdown-link href="{{ route('village.index') }}">
                        {{ __('Villages') }}
                    </x-dropdown-link>
                    <div class="border-t border-gray-200"></div>
                </x-slot>
            </x-dropdown>
        </div>
    @endrole

    @can('view user')
        <div class="ms-3 relative">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="pt-2 pb-3 space-y-3 pl-1 text-gray-600 hover:text-gray-700">
                        {{__('Income')}}
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link href="{{ route('income.index') }}">
                        {{ __('Estate Ad') }}
                    </x-dropdown-link>
                    <div class="border-t border-gray-200"></div>
                    <x-dropdown-link href="{{ route('payment.index') }}">
                        {{ __('Unit Subscription') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
    @endcan
</div>