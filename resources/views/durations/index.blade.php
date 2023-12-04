@include('dashboard.tenant-dashboard')
@include('dashboard.not-admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Durations') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    @can('manage all')
                        <button id="openCreateDuration" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Duration
                        </button>
                        <button id="openCreateResource" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Resource
                        </button>
                    @endcan
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

                    <!-- Duration table -->
                    <div class="table-responsive" style="overflow-x: auto;" id="rentalTable">
                        <div class="container mx-auto mt-8">
                            @can('create estate')
                                @include('durations.create-duration')
                            @endcan
                            <button onclick="hideTable()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                &times;Hide
                            </button>
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Duration Name</th>
                                        @can('manage all')
                                            <th class="py-2 px-4 border border-blue-500">Status</th>
                                            <th class="py-2 px-4 border border-blue-500">Edit</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse($durations as $duration)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-r">{{ $duration->id }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $duration->duration }}</td>
                                            <td class="py-2 px-3 border-b border-r">
                                                <a href="{{ route('duration.status',$duration) }}" class="py-1 px-2 
                                                    {{ $duration->status == 1 ? 'bg-green-300' : 'bg-red-300' }} 
                                                    text-white rounded hover:{{ $duration->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ $duration->status == 1 ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td class="py-2 px-4 border-b border-r">
                                                <a href="#" onclick="openDurationModal({{ json_encode($duration) }})" class="py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500">
                                                    {{__('Edit') }}
                                                </a>
                                            </td>
                                            @include('durations.edit-duration')
                                        </tr>
                                    @empty
                                        <td class="py-2 px-4 border-b border-r">{{__('No Duration Available')}}</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Resource table -->
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8" id="resourceTable">
                            <button onclick="hideTable2()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                &times;Hide
                            </button>
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                @can('create estate')
                                    @include('durations.create-resource')
                                @endcan
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Resource Name</th>
                                        @can('manage all')
                                            <th class="py-2 px-4 border border-blue-500">Status</th>
                                            <th class="py-2 px-4 border border-blue-500">Edit</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse($resources as $resource)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-r">{{ $resource->id }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $resource->resource }}</td>
                                            <td class="py-2 px-3 border-b border-r">
                                                <a href="{{ route('resource.status',$resource) }}" class="py-1 px-2 
                                                    {{ $resource->status == 1 ? 'bg-green-300' : 'bg-red-300' }} 
                                                    text-white rounded hover:{{ $duration->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ $resource->status == 1 ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td class="py-2 px-4 border-b border-r">
                                                <a href="#" onclick="openResourceModal({{ json_encode($resource) }})" class="py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500">
                                                    {{__('Edit') }}
                                                </a>
                                            </td>
                                            @include('durations.edit-resource')
                                        </tr>
                                    @empty
                                        <td class="py-2 px-4 border-b border-r">{{__('No Resources Available')}}</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function hideTable() {
        const table = document.getElementById('rentalTable');
        if (table) {
            table.style.display = 'none';
        }
    }

    function hideTable2() {
        const table = document.getElementById('resourceTable');
        if (table) {
            table.style.display = 'none';
        }
    }
</script>