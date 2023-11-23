<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Location List') }} 
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <button id="openCountryModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Country
                    </button>
                    <button id="openDistrictModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add District
                    </button>
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
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8">
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                @include('locations.create-country')
                                @include('locations.create-district')
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Country</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
                                        <th class="py-2 px-4 border border-blue-500">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($countries as $country)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-r">{{ $country->uid }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $country->country }}</td>
                                            <td class="py-2 px-3 border-b border-r">
                                                <a href="{{ route('country.status',$country) }}" class="py-1 px-2 
                                                    {{ $country->status == 1 ? 'bg-green-300' : 'bg-red-300' }} 
                                                    text-white rounded hover:{{ $country->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ $country->status == 1 ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td class="py-2 px-4 border-b border-r">
                                                <a href="#" onclick="openModal({{ json_encode($country) }})" class="py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500">
                                                    {{__('Edit') }}
                                                </a>
                                            </td>
                                            @include('locations.edit-country')
                                        </tr>
                                    @empty
                                        <td class="py-2 px-4 border-b border-r">{{__('No Country Available')}}</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- district table -->
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8">
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">District</th>
                                        <th class="py-2 px-4 border border-blue-500">Country</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
                                        <th class="py-2 px-4 border border-blue-500">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($districts as $district)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-r">{{ $district->uid }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $district->district }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $district->countryName->country}}</td>
                                            <td class="py-2 px-3 border-b border-r">
                                                <a href="{{ route('district.status',$district) }}" class="py-1 px-2 
                                                    {{ $district->status == 1 ? 'bg-green-300' : 'bg-red-300' }} 
                                                    text-white rounded hover:{{ $district->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ $district->status == 1 ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td class="py-2 px-4 border-b border-r">
                                                <a href="#" onclick="openModal({{ json_encode($district) }})" class="py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500">
                                                    {{__('Edit') }}
                                                </a>
                                            </td>
                                            @include('locations.edit-country')
                                        </tr>
                                    @empty
                                        <td class="py-2 px-4 border-b border-r">{{__('No District Available')}}</td>
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