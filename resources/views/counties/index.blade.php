@include('dashboard.tenant-dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Counties/Constituency and Subcounties/Divisions') }} 
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <button id="openCountyModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add County
                    </button>
                    <button id="openSubCountyModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Sub-County
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
                        <div class="container mx-auto mt-8" id="countyTable">
                            <input type="text" class="rounded text-gray-500" id="countySearch" placeholder="Search County or District">
                            <button class="bg-green-500 text-white font-bold py-2 px-4 rounded">
                                {{$counties->count()}} {{__('Counties')}}
                            </button>
                            <button onclick="hideTable()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                &times;Hide
                            </button>
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                @include('counties.create-county')
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">County</th>
                                        <th class="py-2 px-4 border border-blue-500">District</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
                                        <th class="py-2 px-4 border border-blue-500">Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="countyTableBody">
                                    @forelse($counties as $county)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-r">{{ $county->uid }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $county->county }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $county->districtName->district}}</td>
                                            <td class="py-2 px-3 border-b border-r">
                                                <a href="{{ route('county.status',$county) }}" class="py-1 px-2 
                                                    {{ $county->status == 1 ? 'bg-green-300' : 'bg-red-300' }} 
                                                    text-white rounded hover:{{ $county->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ $county->status == 1 ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td class="py-2 px-4 border-b border-r">
                                                <a href="#" onclick="openCountyModal({{ json_encode($county) }})" class="py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500">
                                                    {{__('Edit') }}
                                                </a>
                                            </td>
                                            @include('counties.edit-county')
                                        </tr>
                                    @empty
                                        <td class="py-2 px-4 border-b border-r">{{__('No District Available')}}</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- sub-counties table -->
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8" id="subcountyTable">
                            <input type="text" class="rounded text-gray-500" id="subcountySearch" placeholder="Search Subcounty">
                            <button class="bg-green-500 text-white font-bold py-2 px-4 rounded">
                                {{$subcounties->count()}} {{__('Sub-Counties')}}
                            </button>
                            <button onclick="hideTable2()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                &times;Hide
                            </button>
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                @include('counties.create-subcounty')
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Sub-County</th>
                                        <th class="py-2 px-4 border border-blue-500">County</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
                                        <th class="py-2 px-4 border border-blue-500">Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="subcountyTableBody">
                                    @forelse($subcounties as $subcounty)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-r">{{ $subcounty->uid }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $subcounty->subcounty }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $subcounty->countyName->county}}</td>
                                            <td class="py-2 px-3 border-b border-r">
                                                <a href="{{ route('subcounty.status',$subcounty) }}" class="py-1 px-2 
                                                    {{ $subcounty->status == 1 ? 'bg-green-300' : 'bg-red-300' }} 
                                                    text-white rounded hover:{{ $subcounty->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ $subcounty->status == 1 ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td class="py-2 px-4 border-b border-r">
                                                <a href="#" onclick="openSubcountyModal({{ json_encode($subcounty) }})" class="py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500">
                                                    {{__('Edit') }}
                                                </a>
                                            </td>
                                            @include('counties.edit-subcounty')
                                        </tr>
                                    @empty
                                        <td class="py-2 px-4 border-b border-r">{{__('No Subcounty Available')}}</td>
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
    const searchInput = document.getElementById('countySearch');
    const tableBody = document.getElementById('countyTableBody');

    // Add event listener to the search input
    searchInput.addEventListener('input', function () {
        const searchValue = this.value.toLowerCase().trim();
        const rows = tableBody.getElementsByTagName('tr');

        // Loop through all table rows to check for matches and display/hide accordingly
        for (let row of rows) {
            const countyName = row.getElementsByTagName('td')[1]; // District name column index
            const districtName = row.getElementsByTagName('td')[2]; // Country name column index

            if (districtName && countyName) {
                const textDistrict = countyName.textContent || countyName.innerText;
                const textCountry = districtName.textContent || districtName.innerText;

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
    const searchInputSubcounty = document.getElementById('subcountySearch');
    const subtableBody = document.getElementById('subcountyTableBody');

    // Add event listener to the search input
    searchInputSubcounty.addEventListener('input', function () {
        const searchValueSub = this.value.toLowerCase().trim();
        const rowsSub = subtableBody.getElementsByTagName('tr');

        // Loop through all table rows to check for matches and display/hide accordingly
        for (let row of rowsSub) {
            const subcountyName = row.getElementsByTagName('td')[1]; // District name column index
            const countyName = row.getElementsByTagName('td')[2]; // Country name column index

            if (countyName && subcountyName) {
                const textCounty = subcountyName.textContent || subcountyName.innerText;
                const textSubcounty = countyName.textContent || countyName.innerText;

                if (
                    textCounty.toLowerCase().includes(searchValueSub) ||
                    textSubcounty.toLowerCase().includes(searchValueSub)
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
    });

    function hideTable() {
        const table = document.getElementById('countyTable');
        if (table) {
            table.style.display = 'none';
        }
    }

    function hideTable2() {
        const table = document.getElementById('subcountyTable');
        if (table) {
            table.style.display = 'none';
        }
    }
</script>