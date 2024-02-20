@include('dashboard.tenant-dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Units') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg table-responsive"  style="overflow-x: auto;">
                <div class="max-w-7xl mx-auto p-6">
                    <input type="text" id="estateSearch" class="rounded text-gray-500 mb-4" placeholder="Search Estate">
                    <div class="flex space-x-4" id="estateContainer">
                        @forelse($estates as $estate)
                            @if(auth()->user()->role == 'Admin' || auth()->user()->id == $estate->landlord_id || auth()->user()->id == $estate->broker_id)
                                    <button class="bg-gray-300 rounded py-1 px-3" onclick="showContent('{{ $estate->uid }}')">{{ $estate->estate }}</button>
                            @endif
                        @empty
                            <h2 class="text-xl font-bold mb-2">No Estate Registered</h2>
                        @endforelse
                    </div>
                    <h4>  
                    <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 transition-opacity duration-500 hidden">
                            <x-validation-errors class="mb-4" />  
                            <span id="notificationMessage"></span>
                        </div>
                    </h4>
                    @php $counter = 0; @endphp
                    @php $formCounter = 0; @endphp
                    @php $editCounter= 0; @endphp
                    @php $searchCounter= 0; @endphp
                    @forelse($estates as $estate)
                        <div class="hidden mt-4 border-b border-gray-200 py-3" id="content_{{ $estate->uid }}">
                                <div class="grid grid-cols-1 border-b border-gray-200 py-3 gap-4">
                                    <h2 class="text-2xl font-bold mb-4">{{ $estate->estate }}</h2>
                                    @can('create unit')
                                        <div class="p-4 rounded-lg shadow-md">
                                            <button onclick="createUnit({{$counter}})" class="bg-green-500 text-white px-3 py-1 rounded-sm text-sm">
                                                Add Unit
                                            </button>
                                            @include('units.create-unit')
                                            @php $counter++; @endphp
                                        </div>
                                    @endcan
                                </div>
                                <div class="grid grid-cols-1  w-1/3 rounded">
                                    <input type="text" class="unit-search rounded text-gray-500 mb-4" data-estate="{{ $estate->uid }}" placeholder="Search Unit Name">
                                </div>
                                @forelse($units as $unit)
                                    @if($estate->uid == $unit->estate_uid)
                                    <div class="unit-container" style="display: block;" data-estate-id="{{ $estate->uid }}">
                                        <h2 class="text-xl font-bold mb-4 flex justify-center">{{ $unit->unit }}</h2>
                                        @include('units.edit-unit')
                                        <div class="space-x-2 mb-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="flex flex-col md:flex-row">
                                                <div class="bg-gray-100 p-4 rounded-lg shadow-md mr-4 table-responsive" style="overflow-x: auto;">
                                                    <h2 class="text-xl font-bold mb-2">Unit Information (Part 1)</h2>
                                            
                                                    <!-- Unit Name and Estate Name -->
                                                    <div class="mb-4">
                                                        <p class="text-lg font-semibold">Unit Name: <span class="text-gray-700">{{ $unit->unit }}</span></p>
                                                        <p class="text-lg font-semibold">Estate Name: <span class="text-gray-700">{{ $estate->estate }}</span></p>
                                                    </div>

                                                    <!-- Client Name -->
                                                    <div class="mb-4">
                                                        <p class="text-lg font-semibold">Client Name: 
                                                            <span class="text-gray-700">
                                                                @foreach($users as $user)
                                                                    @if ($unit->tenant_id == $user->id)
                                                                        {{ $user->name }}
                                                                    @endif
                                                                @endforeach
                                                            </span>
                                                        </p>
                                                    </div>

                                                    <!-- Lease Duration -->
                                                    <div class="mb-4">
                                                        <p class="text-lg font-semibold">Lease Start: <span class="text-gray-700">{{ $unit->lease_start }}</span></p>
                                                        <p class="text-lg font-semibold">Lease End: <span class="text-gray-700">{{ $unit->lease_stop }}</span></p>
                                                        <p class="text-lg font-semibold">Lease Status: <span class="text-gray-700">
                                                        @can('create unit')
                                                            <a href="{{ route('unit.status', $unit) }}" class="py-1 px-2 
                                                                {{ $unit->status == 1 ? 'bg-green-300 text-white hover:bg-green-500' : 'bg-red-300 text-white hover:bg-red-500' }} 
                                                                rounded">
                                                                {{ $unit->status == 1 ? 'Occupied' : 'Unoccupied' }}
                                                            </a>
                                                            </span></p>
                                                        @endcan
                                                    </div>
                                                    @can('create unit')
                                                        <button onclick="toggleFormVisibility({{$formCounter}})" class="bg-green-500 text-white px-3 py-1 rounded-sm text-sm">
                                                            Update Tenant
                                                        </button>
                                                    @endcan
                                                </div>

                                                <!-- Form on the right-hand side -->
                                                <div class="bg-gray-100 p-4 rounded-lg shadow-md hidden" id="form{{$formCounter}}">
                                                    <h4 class="text-xl font-bold mb-2">Update Tenant</h4>
                                                    <form method="POST" action="{{ route('update.tenant') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <x-input id="estate_id" class="w-4/5 px-2 py-1 rounded text-gray-700" type="hidden" name="unit_id" value="{{ $unit->id}}" required/>
                                                        <x-input id="estate_uid" class="w-4/5 px-2 py-1 rounded text-gray-700" type="hidden" name="unit_uid" value="{{ $unit->uid}}" required/>
                                                        
                                                        <div class="mt-6">
                                                            <label for="lease_start" class="font-semibold">Lease Start:</label>
                                                            <x-input id="lease_start" class="w-4/5 px-2 py-1 rounded text-gray-700" type="date" name="lease_start" required />
                                                        </div>

                                                        <div class="mt-6">
                                                            <label for="lease_stop" class="font-semibold">Lease Stop:</label>
                                                            <x-input id="lease_stop" class="w-4/5 px-2 py-1 rounded text-gray-700" type="date" name="lease_stop" required />
                                                        </div>

                                                        <div class="mt-6">
                                                            <label for="tenant_id" class="font-semibold">Type Tenant Email:</label>
                                                            <select id="tenant_id" class="w-4/5 px-2 py-1 rounded text-gray-700" name="tenant_id" required>
                                                                <option class="block mt-1 w-full" value=""></option>
                                                                @foreach ($users as $user)
                                                                    <option class="block mt-1 w-full" value="{{ $user->id }}">{{ $user->email }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="mt-6">
                                                            <button type="submit" class="bg-red-700 text-white px-3 py-1 rounded-sm text-sm">
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                @php $formCounter++; @endphp
                                            </div>
                                            
                                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                                <h2 class="text-xl font-bold mb-2">Unit Information (Part 2)</h2>

                                                @php
                                                    // Calculate the difference in days
                                                    $nowDate = \Carbon\Carbon::now();
                                                    $endDate = \Carbon\Carbon::parse($unit->lease_stop);
                                                    $daysLeft = $nowDate->diffInDays($endDate);
                                                @endphp
                                                <div class="mb-4">
                                                    <p class="text-lg font-semibold">Terms & Conditions: 
                                                        <span class="text-gray-700">
                                                        @if ($unit->sponsored == 0)
                                                            <span class="text-red-500">{{ __('Unaccepted Yet') }}</span>
                                                        @else
                                                            <span class="text-green-500">{{ __('Accepted') }}</span>
                                                        @endif
                                                        </span>
                                                    </p>
                                                    <p class="text-lg font-semibold">Number of Days Left: <span class="text-gray-700">{{ $daysLeft }}</span></p>
                                                </div>

                                                <!-- Details: Bedrooms, Bathrooms, Square Foot -->
                                                <div class="mb-4">
                                                    <p class="text-lg font-semibold">Rooms: <span class="text-gray-700">{{ $unit->room_no }}</span></p>
                                                    <p class="text-lg font-semibold">Square Foot: <span class="text-gray-700">{{ $unit->square_footage }}</span></p>
                                                </div>

                                                <!-- Price and Rooms -->
                                                <div class="mb-4">
                                                    <p class="text-lg font-semibold">Price: <span class="text-gray-700">{{ $unit->price }}/{{ $unit->durationName->duration }}</span></p>
                                                    <p class="text-lg font-semibold">Room Description: <span class="text-gray-700">{{ $unit->description }}</span></p>
                                                </div>

                                                <!-- Essential Resources -->
                                                <div>
                                                    <p class="text-lg font-semibold">Essential Resources: <span class="text-gray-700">
                                                        @php
                                                            $resourcesArray = json_decode($unit->resources);
                                                        @endphp
                                                        {{ is_array($resourcesArray) ? implode(', ', $resourcesArray) : $unit->resources }}
                                                    </span></p>
                                                </div>
                                                
                                                <button onclick="editUnit({{$editCounter}}, {{ json_encode($unit) }})" class="bg-green-500 text-white px-3 py-1 rounded-sm text-sm">
                                                    Edit Unit
                                                </button>
                                                @php $editCounter++; @endphp
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @empty
                                    <h2 class="text-xl font-bold mb-2">No Estate Unit Registered</h2>
                                @endforelse
                        </div>
                        @php $searchCounter++; @endphp
                    @empty
                        <h2 class="text-xl font-bold mb-2">No Estate Registered</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('dashboard.status')

<script>
    function showContent(sectionId) {
        const sections = document.querySelectorAll('[id^="content_"]');
        sections.forEach(section => {
            if (section.id === `content_${sectionId}`) {
                section.classList.toggle('hidden');
            } else {
                section.classList.add('hidden');
            }
        });
    }

    function toggleFormVisibility(counter) {
        var form = document.getElementById("form" + counter);
        form.classList.toggle("hidden");
    }

    document.addEventListener("DOMContentLoaded", function() {
        const searchInputs = document.querySelectorAll('.unit-search');

        searchInputs.forEach(input => {
            input.addEventListener('input', function() {
                const estateId = this.getAttribute('data-estate');
                const searchText = this.value.toLowerCase();
                filterUnits(estateId, searchText);
            });
        });

        function filterUnits(estateId, searchText) {
            const units = document.querySelectorAll(`.unit-container[data-estate-id='${estateId}']`);

            units.forEach(unit => {
                const unitName = unit.querySelector('h2').textContent.toLowerCase();
                const displayStyle = unitName.includes(searchText) ? 'block' : 'none';
                unit.style.display = displayStyle;
            });
        }
    });

    
    // Function to handle estate filtering based on search query
    function filterEstates() {
        const searchText = document.getElementById('estateSearch').value.toLowerCase();
        const estateButtons = document.querySelectorAll('#estateContainer button');
        
        estateButtons.forEach(button => {
            const estateName = button.textContent.toLowerCase();
            
            if (estateName.includes(searchText)) {
                button.style.display = 'block'; 
            } else {
                button.style.display = 'none'; 
            }
        });
    }
    document.getElementById('estateSearch').addEventListener('input', filterEstates);
</script>
