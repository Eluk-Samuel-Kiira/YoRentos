<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Parishes/Wards and Villages') }} 
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <button id="openParishModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Parish
                    </button>
                    <button id="openVillageModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Village
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
                    <!-- Parishes table -->
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8" id="subcountyTable">
                            <input type="text" class="rounded" id="parishSearch" placeholder="Search SubCounty or parish">
                            <button onclick="hideTable()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                &times;Hide
                            </button>
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                @include('parishes.create-parish')
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Parish</th>
                                        <th class="py-2 px-4 border border-blue-500">Subcounty/Division</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
                                        <th class="py-2 px-4 border border-blue-500">Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="parishTableBody">
                                    @forelse($parishes as $parish)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-r">{{ $parish->uid }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $parish->parish }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $parish->subcountyName->subcounty}}</td>
                                            <td class="py-2 px-3 border-b border-r">
                                                <a href="{{ route('parish.status',$parish) }}" class="py-1 px-2 
                                                    {{ $parish->status == 1 ? 'bg-green-300' : 'bg-red-300' }} 
                                                    text-white rounded hover:{{ $parish->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ $parish->status == 1 ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td class="py-2 px-4 border-b border-r">
                                                <a href="#" onclick="openParishModal({{ json_encode($parish) }})" class="py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500">
                                                    {{__('Edit') }}
                                                </a>
                                            </td>
                                            @include('parishes.edit-parish')
                                        </tr>
                                    @empty
                                        <td class="py-2 px-4 border-b border-r">{{__('No Parish Available')}}</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- villages table -->
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8">
                            <input type="text" class="rounded" id="subcountySearch" placeholder="Search parish or village">
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                @include('parishes.create-village')
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Village</th>
                                        <th class="py-2 px-4 border border-blue-500">Parish</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
                                        <th class="py-2 px-4 border border-blue-500">Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="subcountyTableBody">
                                    @forelse($villages as $village)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-r">{{ $village->uid }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $village->village }}</td>
                                            <td class="py-2 px-4 border-b border-r">{{ $village->parishName->parish}}</td>
                                            <td class="py-2 px-3 border-b border-r">
                                                <a href="{{ route('village.status',$village) }}" class="py-1 px-2 
                                                    {{ $village->status == 1 ? 'bg-green-300' : 'bg-red-300' }} 
                                                    text-white rounded hover:{{ $village->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                    {{ $village->status == 1 ? 'Active' : 'Inactive' }}
                                                </a>
                                            </td>
                                            <td class="py-2 px-4 border-b border-r">
                                                <a href="#" onclick="openVillageModal({{ json_encode($village) }})" class="py-1 px-2 bg-blue-300 text-white rounded hover:bg-blue-500">
                                                    {{__('Edit') }}
                                                </a>
                                            </td>
                                            @include('parishes.edit-village')
                                        </tr>
                                    @empty
                                        <td class="py-2 px-4 border-b border-r">{{__('No Village Available')}}</td>
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

    // // Get the input element and table body
    const searchInputParish = document.getElementById('parishSearch');
    const tableBodyParish = document.getElementById('parishTableBody');

    // Add event listener to the search input
    searchInputParish.addEventListener('input', function () {
        const searchValueParish = this.value.toLowerCase().trim();
        const rowsParish = tableBodyParish.getElementsByTagName('tr');

        // Loop through all table rows to check for matches and display/hide accordingly
        for (let row of rowsParish) {
            const parishName = row.getElementsByTagName('td')[1]; // District name column index
            const subcountytName = row.getElementsByTagName('td')[2]; // Country name column index

            if (subcountytName && parishName) {
                const textParish = parishName.textContent || parishName.innerText;
                const textSubcounty = subcountytName.textContent || subcountytName.innerText;

                if (
                    textParish.toLowerCase().includes(searchValueParish) ||
                    textSubcounty.toLowerCase().includes(searchValueParish)
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
    });

    // // Get the input element and table body
    // const searchInputSubcounty = document.getElementById('subcountySearch');
    // const subtableBody = document.getElementById('subcountyTableBody');

    // // Add event listener to the search input
    // searchInputSubcounty.addEventListener('input', function () {
    //     const searchValueSub = this.value.toLowerCase().trim();
    //     const rowsSub = subtableBody.getElementsByTagName('tr');

    //     // Loop through all table rows to check for matches and display/hide accordingly
    //     for (let row of rowsSub) {
    //         const subcountyName = row.getElementsByTagName('td')[1]; // District name column index
    //         const countyName = row.getElementsByTagName('td')[2]; // Country name column index

    //         if (countyName && subcountyName) {
    //             const textCounty = subcountyName.textContent || subcountyName.innerText;
    //             const textSubcounty = countyName.textContent || countyName.innerText;

    //             if (
    //                 textCounty.toLowerCase().includes(searchValueSub) ||
    //                 textSubcounty.toLowerCase().includes(searchValueSub)
    //             ) {
    //                 row.style.display = '';
    //             } else {
    //                 row.style.display = 'none';
    //             }
    //         }
    //     }
    // });

    function hideTable() {
        const table = document.getElementById('subcountyTable');
        if (table) {
            table.style.display = 'none';
        }
    }
</script>