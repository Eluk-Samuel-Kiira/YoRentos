@include('dashboard.tenant-dashboard')
@include('dashboard.not-admin')
<x-app-layout>
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
                    <livewire:user-table/>
                    <livewire:edit-role/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
