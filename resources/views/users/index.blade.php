@include('dashboard.tenant-dashboard')
@include('dashboard.not-admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }} 
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <h4>
                        <x-validation-errors class="mb-4" />    
                        @if(session('error'))
                            <span class="bg-red-500 text-white rounded">
                                {{ session('error') }}
                            </span>
                        @endif
                        @if(session('success'))
                            <span class="bg-green-500 text-white rounded">
                                {{ session('success') }}
                            </span>
                        @endif
                    </h4>
                    <!-- <button x-data x-on:click="$dispatch('open-modal',{ rowId: '1' })" class="px-3 py-1 bg-blue-500 text-white round">Open</button> -->
                    <livewire:user-table/>
                    <livewire:edit-role/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
