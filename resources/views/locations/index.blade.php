@include('dashboard.tenant-dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Countries and Districts') }} 
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
                        <div class="container mx-auto mt-8" id="countryTable">
                            <input type="text" class="rounded text-gray-500" id="countrySearch" placeholder="Search Country">
                            <button class="bg-green-500 text-white font-bold py-2 px-4 rounded">
                                {{$countries->count()}} {{__('Countries')}}
                            </button>
                            <button onclick="hideTable()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                &times;Hide
                            </button>
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                @include('locations.create-country')
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Country</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
                                        <th class="py-2 px-4 border border-blue-500">Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="countryTableBody">
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
                        <div class="container mx-auto mt-8" id="districtTable">
                            <input type="text" class="rounded text-gray-500" id="districtSearch" placeholder="Search District or Country">
                            <button class="bg-green-500 text-white font-bold py-2 px-4 rounded">
                                {{$districts->count()}} {{__('Districts')}}
                            </button>
                            <button onclick="hideTable2()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                &times;Hide
                            </button>
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                @include('locations.create-district')
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">District</th>
                                        <th class="py-2 px-4 border border-blue-500">Country</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
                                        <th class="py-2 px-4 border border-blue-500">Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="districtTableBody">
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
                                                <a href="#" onclick="openDistrictModal({{ json_encode($district) }})" class="py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500">
                                                    {{__('Edit') }}
                                                </a>
                                            </td>
                                            @include('locations.edit-district')
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
<script>
    // Get the input element and table body
    const searchInput = document.getElementById('districtSearch');
    const tableBody = document.getElementById('districtTableBody');

    // Add event listener to the search input
    searchInput.addEventListener('input', function () {
        const searchValue = this.value.toLowerCase().trim();
        const rows = tableBody.getElementsByTagName('tr');

        // Loop through all table rows to check for matches and display/hide accordingly
        for (let row of rows) {
            const districtName = row.getElementsByTagName('td')[1]; // District name column index
            const countryName = row.getElementsByTagName('td')[2]; // Country name column index

            if (districtName && countryName) {
                const textDistrict = districtName.textContent || districtName.innerText;
                const textCountry = countryName.textContent || countryName.innerText;

                if (
                    textDistrict.toLowerCase().includes(searchValue) ||
                    textCountry.toLowerCase().includes(searchValue)
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
    });

    // Get the input element and table body
    const searchInputCountry = document.getElementById('countrySearch');
    const countryTableBody = document.getElementById('countryTableBody');

    // Add event listener to the search input
    searchInputCountry.addEventListener('input', function () {
        const searchValueCountry = this.value.toLowerCase().trim();
        const rowsCountry = countryTableBody.getElementsByTagName('tr');

        // Loop through all table rows to check for matches and display/hide accordingly
        for (let row of rowsCountry) {
            const countryName = row.getElementsByTagName('td')[1]; // Country name column index

            if (countryName) {
                const textCountry = countryName.textContent || countryName.innerText;

                if (
                    textCountry.toLowerCase().includes(searchValueCountry)
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
    });

    function hideTable() {
        const table = document.getElementById('countryTable');
        if (table) {
            table.style.display = 'none';
        }
    }

    function hideTable2() {
        const table = document.getElementById('districtTable');
        if (table) {
            table.style.display = 'none';
        }
    }

</script>