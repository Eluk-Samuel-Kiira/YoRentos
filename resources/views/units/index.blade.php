@include('dashboard.tenant-dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Units') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <div class="flex space-x-4">
                        @forelse($estates as $estate)
                            @if(auth()->user()->role == 'Admin' || auth()->user()->id == $estate->landlord_id || auth()->user()->id == $estate->broker_id)
                                <button class="bg-blue-500 active:bg-red-700 text-white px-4 py-2 rounded hover:bg-0" onclick="showContent('{{ $estate->uid }}')">{{ $estate->estate }}</button>
                            @endif
                        @empty
                            <h2 class="text-xl font-bold mb-2">No Estate Registered</h2>
                        @endforelse
                    </div>
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
                    @php $counter = 0; @endphp
                    @forelse($estates as $estate)
                        <div class="hidden mt-4 border-b border-gray-200 py-3" id="content_{{ $estate->uid }}">
                            <div class="grid grid-cols-1 border-b border-gray-200 py-3 gap-4">
                                <h2 class="text-2xl font-bold mb-4">{{ $estate->estate }}</h2>
                                <div class="p-4 rounded-lg shadow-md" id="unitForm{{$counter}}">
                                    <button onclick="hideTable({{$counter}})" class="bg-red-500 text-white px-3 py-1 rounded-sm text-sm">
                                        &times; Hide
                                    </button>
                                    @php $counter++; @endphp
                                    <h2 class="text-xl font-bold mb-2 flex justify-center items-center">Add New Unit</h2>
                                    <form method="POST" action="{{ route('unit.store') }}">
                                        @csrf
                                        <div class="flex flex-col md:flex-row gap-4">
                                            <div class="bg-gray-100 p-4 rounded-lg shadow-md flex-1">
                                                <x-input id="estate_id" class="block mt-1 w-full" type="hidden" name="estate_id" value="{{ $estate->id}}" required/>
                                                <x-input id="estate_uid" class="block mt-1 w-full" type="hidden" name="estate_uid" value="{{ $estate->uid}}" required/>
                                                
                                                <div class="mt-6">
                                                    <label for="unit" class="font-semibold text-xl">Unit Name:</label>
                                                    <x-input id="unit" class="block mt-1 w-full" type="text" name="unit" :value="old('unit')" required autofocus autocomplete="unit" />
                                                </div>

                                                <div class="mt-6">
                                                    <label for="duration" class="font-semibold text-xl">Charge Per Duration:</label>
                                                    <select id="duration" class="w-full font-medium py-2 rounded text-gray-700" name="duration_id" required>
                                                        <option class="block mt-1 w-full" value=""></option>
                                                        @foreach ($durations as $duration)
                                                            <option class="block mt-1 w-full" value="{{ $duration->id }}">{{ $duration->duration }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mt-6">
                                                    <label for="tenant" class="font-semibold text-xl">Rental Type:</label>
                                                    <select id="rental_id" class="w-full font-medium py-2 rounded text-gray-700" name="rental_id" required>
                                                        <option class="block mt-1 w-full" value=""></option>
                                                        @foreach ($rentals as $rental)
                                                            <option class="block mt-1 w-full" value="{{ $rental->id }}">{{ $rental->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mt-4">
                                                    <x-label for="resource" value="{{ __('Essential Resources') }}" class="font-semibold text-xl"/>
                                                    <div>
                                                        @foreach($resources as $resource)
                                                            <input type="checkbox" id="resource{{ $resource->id }}" name="resources[]" value="{{ $resource->resource }}" class="mr-2">
                                                            <label for="resource{{ $resource->resource }}" class="text-sm">{{ $resource->resource }}</label>
                                                            <br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <!-- other half -->
                                            <div class="bg-gray-100 p-4 rounded-lg shadow-md flex-1">
                                                <div class="mt-6">
                                                    <label for="price" class="font-semibold text-xl">Unit Price:</label>
                                                    <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required autofocus autocomplete="price" placeholder="eg UGX: 200,000 or USD: 2000"/>
                                                </div>

                                                <div class="mt-6">
                                                    <label for="square_footage" class="font-semibold text-xl">Room Measurement:</label>
                                                    <x-input id="square_footage" class="block mt-1 w-full" type="text" name="square_footage" placeholder="eg 10 feet or 4 by 5m for offices especially" />
                                                </div>

                                                <div class="mt-6">
                                                    <label for="room_no" class="font-semibold text-xl">Number of Rooms:</label>
                                                    <x-input id="room_no" class="block mt-1 w-full" type="number" name="room_no"  placeholder="4" required/>
                                                </div>

                                                <div class="mt-6">
                                                    <label for="description" class="font-semibold text-xl">Room Description:</label>
                                                    <textarea name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>2 bedrooms, 1 sitting room, 1 bathroom etc</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <x-button class="mt-8">
                                            {{ __('Save') }}
                                        </x-button>
                                    </form>
                                </div>
                            </div>
                            @forelse($units as $unit)
                                @if($estate->uid == $unit->estate_uid)
                                    <h2 class="text-xl font-bold mb-4 flex justify-center">Estate Unit: {{ $unit->unit }}</h2>
                                    <div class="flex space-x-4 mb-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                            
                                            <h2 class="text-xl font-bold mb-2">Unit Information (Part 1)</h2>
                                            
                                            <!-- Unit Name and Estate Name -->
                                            <div class="mb-4">
                                                <p class="text-lg font-semibold">Unit Name: <span class="text-gray-700">{{ $unit->unit }}</span></p>
                                                <p class="text-lg font-semibold">Estate Name: <span class="text-gray-700">{{ $estate->estate }}</span></p>
                                            </div>

                                            <!-- Client Name -->
                                            <div class="mb-4">
                                                <p class="text-lg font-semibold">Client Name: <span class="text-gray-700">{{ $unit->tenant_id }}</span></p>
                                            </div>

                                            <!-- Lease Duration -->
                                            <div class="mb-4">
                                                <p class="text-lg font-semibold">Lease Start: <span class="text-gray-700">{{ $unit->lease_start }}</span></p>
                                                <p class="text-lg font-semibold">Lease End: <span class="text-gray-700">{{ $unit->lease_stop }}</span></p>
                                                <p class="text-lg font-semibold">Lease Status: <span class="text-gray-700">
                                                <span class="py-1 px-2 
                                                    {{ $unit->status == 1 ? 'bg-green-300 text-white hover:bg-green-500' : 'bg-red-300 text-white hover:bg-red-500' }} 
                                                    rounded">
                                                    {{ $unit->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </span></p>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                            <h2 class="text-xl font-bold mb-2">Unit Information (Part 2)</h2>

                                            <!-- Details: Bedrooms, Bathrooms, Square Foot -->
                                            <div class="mb-4">
                                                <p class="text-lg font-semibold">Rooms: <span class="text-gray-700">{{ $unit->room_no }}</span></p>
                                                <p class="text-lg font-semibold">Square Foot: <span class="text-gray-700">{{ $unit->square_footage }}</span></p>
                                            </div>

                                            <!-- Price and Rooms -->
                                            <div class="mb-4">
                                                <p class="text-lg font-semibold">Price: <span class="text-gray-700">{{ $unit->price }}/{{ $unit->duration_id }}</span></p>
                                                <p class="text-lg font-semibold">Room Description: <span class="text-gray-700">{{ $unit->description }}</span></p>
                                            </div>

                                            <!-- Essential Resources -->
                                            <div>
                                                <p class="text-lg font-semibold">Essential Resources: <span class="text-gray-700">{{ $unit->resources }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <h2 class="text-xl font-bold mb-2">No Estate Unit Registered</h2>
                            @endforelse
                        </div>
                    @empty
                        <h2 class="text-xl font-bold mb-2">No Estate Registered</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function showContent(sectionId) {
        const sections = document.querySelectorAll('[id^="content_"]');
        sections.forEach(section => {
            if (section.id === `content_${sectionId}`) {
                section.classList.remove('hidden');
            } else {
                section.classList.add('hidden');
            }
        });
    }

    
    function hideTable(index) {
        var unitForm = document.getElementById("unitForm" + index);
        if (unitForm.style.display !== "none") {
            unitForm.style.display = "none";
        } else {
            unitForm.style.display = "block";
        }
    }


</script>