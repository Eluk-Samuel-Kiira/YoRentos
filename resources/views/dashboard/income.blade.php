@include('dashboard.tenant-dashboard')
@include('dashboard.not-admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Income') }} 
        </h2>
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
        <h6>
            <div id="error-container"></div>
        </h6>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <!-- advert table -->
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8">
                        <input type="text" class="rounded text-gray-500" id="advertSearch" placeholder="Search Adverts">
                            <button onclick="hideTable()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                &times;Hide
                            </button>
                            <button class="bg-green-500 text-white font-bold py-2 px-4 rounded">
                                Total Amount: {{ $total_estate }}
                            </button>
                            <table class="min-w-full border border-blue-500 text-gray-500" id="advertTable">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Estate Name</th>
                                        <th class="py-2 px-4 border border-blue-500">Landlord</th>
                                        <th class="py-2 px-4 border border-blue-500">Amount</th>
                                        <th class="py-2 px-4 border border-blue-500">Transaction Id</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
                                        <th class="py-2 px-4 border border-blue-500">Start Date</th>
                                        <th class="py-2 px-4 border border-blue-500">End Date</th>
                                        <th class="py-2 px-4 border border-blue-500">Remaining Days</th>
                                        <th class="py-2 px-4 border border-blue-500">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="advert-list">
                                    @forelse($estates as $estate)
                                            <tr>
                                                <td class="py-2 px-4 border-b border-r">{{ $estate->id }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $estate->estateAdvert->estate }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $estate->landlord_id }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $estate->price }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $estate->txn_ref }}</td>
                                                <td class="py-2 px-3 border-b border-r">
                                                    <a href="{{ route('advert.status',$estate->id) }}" class="py-1 px-2 
                                                        {{ $estate->status == 0 ? 'bg-green-300' : 'bg-red-300' }} 
                                                        text-white rounded hover:{{ $estate->status == 0 ? 'bg-green-500' : 'bg-red-500' }}">
                                                        {{ $estate->status == 0 ? 'Running' : 'Inactive' }}
                                                    </a>
                                                </td>
                                                <td class="py-2 px-4 border-b border-r">{{ $estate->created_at }}</td>
                                                @php
                                                    // Calculate the difference in days
                                                    $startDate = \Carbon\Carbon::parse($estate->created_at);
                                                    $nowDate = \Carbon\Carbon::now();
                                                    $oneMonthLater = $startDate->copy()->addMonths(1);                    
                                                    $daysLeft = $oneMonthLater->diffInDays($nowDate);
                                                @endphp
                                                <td class="py-2 px-4 border-b border-r">{{ $oneMonthLater }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $daysLeft }}</td>
                                                <td class="py-2 px-3 border-b border-r">
                                                    <a href="{{ route('advert.destroy',$estate->id) }}" class="py-1 px-2 bg-red-300
                                                        text-white rounded hover:bg-red-500">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <td class="py-2 px-4 border-b border-r">{{__('No Advert Available')}}</td>
                                        @endforelse
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>

                    <!-- unit table -->
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8">
                            <input type="text" class="rounded text-gray-500" id="unitSearch" placeholder="Search Unit Subs">
                            <button onclick="hideTable2()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                &times;Hide
                            </button>
                            <button class="bg-green-500 text-white font-bold py-2 px-4 rounded">
                                Total Amount: {{ $total_units }}
                            </button>
                            <table class="min-w-full border border-blue-500 text-gray-500" id="unitpayTable">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Estate Name</th>
                                        <th class="py-2 px-4 border border-blue-500">Landlord</th>
                                        <th class="py-2 px-4 border border-blue-500">Amount</th>
                                        <th class="py-2 px-4 border border-blue-500">Transaction Id</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
                                        <th class="py-2 px-4 border border-blue-500">Start Date</th>
                                        <th class="py-2 px-4 border border-blue-500">End Date</th>
                                        <th class="py-2 px-4 border border-blue-500">Remaining Days</th>
                                        <th class="py-2 px-4 border border-blue-500">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="unit-list">
                                    @forelse($units as $unit)
                                            <tr>
                                                <td class="py-2 px-4 border-b border-r">{{ $unit->id }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $unit->estateUnitpay->estate }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $unit->landlord_id }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $unit->amount }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $unit->txn_ref }}</td>
                                                <td class="py-2 px-3 border-b border-r">
                                                    <a href="{{ route('unitpay.status',$unit->id) }}" class="py-1 px-2 
                                                        {{ $unit->status == 1 ? 'bg-green-300' : 'bg-red-300' }} 
                                                        text-white rounded hover:{{ $unit->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                        {{ $unit->status == 1 ? 'Running' : 'Inactive' }}
                                                    </a>
                                                </td>
                                                <td class="py-2 px-4 border-b border-r">{{ $unit->created_at }}</td>
                                                @php
                                                    // Calculate the difference in days
                                                    $startDate = \Carbon\Carbon::parse($unit->created_at);
                                                    $nowDate = \Carbon\Carbon::now();
                                                    $oneMonthLater = $startDate->copy()->addMonths(1);                    
                                                    $daysLeft = $oneMonthLater->diffInDays($nowDate);
                                                @endphp
                                                <td class="py-2 px-4 border-b border-r">{{ $oneMonthLater }}</td>
                                                <td class="py-2 px-4 border-b border-r">{{ $daysLeft }}</td>
                                                <td class="py-2 px-3 border-b border-r">
                                                    <a href="{{ route('unitpay.destroy',$unit->id) }}" class="py-1 px-2 bg-red-300
                                                        text-white rounded hover:bg-red-500">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <td class="py-2 px-4 border-b border-r">{{__('No Unit Available')}}</td>
                                        @endforelse
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function hideTable() {
        const table = document.getElementById('advertTable');
        if (table) {
            if (table.style.display === 'none') {
                table.style.display = ''; 
            } else {
                table.style.display = 'none';
            }
        }
    }

    // Get the input element and table body
    const searchInput = document.getElementById('advertSearch');
    const advertTableBody = document.getElementById('advert-list');
    // Add event listener to the search input
    searchInput.addEventListener('input', function () {
        const searchValue = this.value.toLowerCase().trim();
        const rows = advertTableBody.getElementsByTagName('tr');

        // Loop through all table rows to check for matches and display/hide accordingly
        for (let row of rows) {
            const estateName = row.getElementsByTagName('td')[1]; // District name column index
            const tran_ref = row.getElementsByTagName('td')[4]; // Country name column index

            if (tran_ref && estateName) {
                const textEstate = estateName.textContent || estateName.innerText;
                const textTrans = tran_ref.textContent || tran_ref.innerText;

                if (
                    textEstate.toLowerCase().includes(searchValue) ||
                    textTrans.toLowerCase().includes(searchValue)
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
    });


    function hideTable2() {
        const table = document.getElementById('unitpayTable');
        if (table) {
            if (table.style.display === 'none') {
                table.style.display = ''; 
            } else {
                table.style.display = 'none';
            }
        }
    }

    // Get the input element and table body
    const searchInputUnit = document.getElementById('unitSearch');
    const unitTableBody = document.getElementById('unit-list');
    // Add event listener to the search input
    searchInputUnit.addEventListener('input', function () {
        const searchUnit = this.value.toLowerCase().trim();
        const rowsUnit = unitTableBody.getElementsByTagName('tr');

        // Loop through all table rows to check for matches and display/hide accordingly
        for (let row of rowsUnit) {
            const estateName = row.getElementsByTagName('td')[1]; // District name column index
            const tran_ref = row.getElementsByTagName('td')[4]; // Country name column index

            if (tran_ref && estateName) {
                const textEstate = estateName.textContent || estateName.innerText;
                const textTrans = tran_ref.textContent || tran_ref.innerText;

                if (
                    textEstate.toLowerCase().includes(searchUnit) ||
                    textTrans.toLowerCase().includes(searchUnit)
                ) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
    });
</script>