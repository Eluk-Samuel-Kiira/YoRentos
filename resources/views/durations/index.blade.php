@include('dashboard.tenant-dashboard')
@include('dashboard.not-admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Durations') }} 
        </h2>
    </x-slot>
    @role('Admin')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="max-w-7xl mx-auto p-6">
                        @can('manage all')
                            <button onclick="openCreateDuration()" class="bg-gray-300 rounded py-1 px-3">
                                Add Duration
                            </button>
                            <button onclick="openCreateResource()" class="bg-gray-300 rounded py-1 px-3">
                                Add Resource
                            </button>
                        @endcan
                        <h4>  
                            <x-validation-errors class="mb-4" /> 
                            <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 transition-opacity duration-500 hidden">
                                <!-- <x-validation-errors class="mb-4" />   -->
                                <span id="notificationMessage"></span>
                            </div>
                        </h4>

                        <!-- Resource table -->
                        <div class="table-responsive" style="overflow-x: auto;">
                            <div class="container mx-auto mt-8" id="resourceTable">
                                <div class="bg-blue-300 rounded py-1 px-3">Resource Table</div>
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
                                                        text-white rounded hover:{{ $resource->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
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
                        
                        <!-- Duration table -->
                        <div class="table-responsive" style="overflow-x: auto;" id="rentalTable">
                            <div class="container mx-auto mt-8">
                                @can('create estate')
                                    @include('durations.create-duration')
                                @endcan
                                <div class="bg-blue-300 rounded py-1 px-3">Duration Table</div>
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

                    </div>
                </div>
            </div>
        </div>
    @endrole
</x-app-layout>
@include('dashboard.status')