@include('dashboard.tenant-dashboard')
@include('dashboard.not-admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Villages/Cells') }} 
        </h2>
    </x-slot>
    @role('Admin')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="max-w-7xl mx-auto p-6">
                        @can('manage all')
                            <button onclick="createVillageModal()" class="bg-gray-300 rounded py-1 px-3">
                                Add Village
                            </button>
                        @endcan
                        <h4>  
                            <x-validation-errors class="mb-4" />  
                            {{-- @if(session('error'))
                                <span class="bg-red-500 text-white rounded">
                                    {{ session('error') }}
                                </span>
                            @endif
                            @if(session('success'))
                                <span class="bg-green-500 text-white rounded">
                                    {{ session('success') }}
                                </span>
                            @endif --}}
                        </h4>
                        @can('manage all')
                            <!-- villages table -->
                            <livewire:village-table/>
                            @include('parishes.create-village')
                            @include('parishes.edit-village')
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    @endrole
</x-app-layout>
@include('dashboard.status')