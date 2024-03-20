@include('dashboard.tenant-dashboard')
@include('dashboard.not-admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Income') }} 
        </h2>
        <h4>  
            <x-validation-errors class="mb-4" />  
            <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 transition-opacity duration-500 hidden">
                <!-- <x-validation-errors class="mb-4" />   -->
                <span id="notificationMessage"></span>
            </div>
        </h4>
        <h6>
            <div id="error-container"></div>
        </h6>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <!-- unit table -->
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8">
                            <input type="text" class="rounded text-gray-500" id="unitSearch" placeholder="Search Unit Subs">
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
                                        <th class="py-2 px-4 border border-blue-500">Start Date</th>
                                        <th class="py-2 px-4 border border-blue-500">End Date</th>
                                        <th class="py-2 px-4 border border-blue-500">Remaining Days</th>
                                        @can('create amount')
                                            <th class="py-2 px-4 border border-blue-500">Status</th>
                                            <th class="py-2 px-4 border border-blue-500">Delete</th>
                                        @endcan
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
                                                @can('create amount')
                                                    <td class="py-2 px-3 border-b border-r">
                                                        <a href="{{ route('unitpay.status',$unit->id) }}" class="py-1 px-2 
                                                            {{ $unit->status == 1 ? 'bg-green-300' : 'bg-red-300' }} 
                                                            text-white rounded hover:{{ $unit->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                            {{ $unit->status == 1 ? 'Running' : 'Inactive' }}
                                                        </a>
                                                    </td>
                                                    <td class="py-2 px-3 border-b border-r">
                                                        <a href="{{ route('unitpay.destroy',$unit->id) }}" class="py-1 px-2 bg-red-300
                                                            text-white rounded hover:bg-red-500">
                                                            Delete
                                                        </a>
                                                    </td>
                                                @endcan
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