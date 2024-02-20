<div x-data="{ show: false, unitForm: '', }"
    x-show = "show"
    x-on:open-edit-unit.window = "show = true"
    x-on:close-modal.window = "show = false"
    style="display:none"
    class="fixed"
    id="unitEditForm{{$editCounter}}" 
    >
    <div class="fixed inset-0 bg-gray-300 opacity-80 backdrop-blur-lg"></div>
    <div class="bg-white rounded m-auto fixed inset-0 max-w-3xl overflow-y-auto" style="max-height:670px">
        <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
            <div class="text-xl text-gray-800">{{__('Edit Unit') }}</div>
            <button x-on:click="$dispatch('close-modal')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-4">
        <form method="POST" action="{{ route('unit.update', $unit) }}">
            @csrf
            @method('PUT')
            <div class="flex flex-col md:flex-row gap-4">
                <div class="bg-gray-100 p-4 rounded-lg shadow-md flex-1">
                    <x-input id="unit_uid" class="block mt-1 w-full" type="hidden" name="unit_uid" value="{{ $unit->uid}}" required/>
                    
                    <div class="mt-6">
                        <label for="unit" class="font-semibold text-xl">Unit Name:</label>
                        <x-input id="unitName" class="block mt-1 w-full" type="text" name="unit" value="{{ $unit->unit}}" required />
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
                        <x-input id="unitPrice" class="block mt-1 w-full" type="text" name="price" value="{{ $unit->price }}" required placeholder="eg UGX: 200,000 or USD: 2000"/>
                    </div>

                    <div class="mt-6">
                        <label for="square_footage" class="font-semibold text-xl">Room Measurement (Square Foot):</label>
                        <x-input id="square_footage" class="block mt-1 w-full" type="text" name="square_footage" value="{{ $unit->square_footage }}" placeholder="eg 10 feet or 4 by 5m for offices especially" />
                    </div>

                    <div class="mt-6">
                        <label for="room_no" class="font-semibold text-xl">Number of Rooms:</label>
                        <x-input id="room_no" class="block mt-1 w-full" type="number" name="room_no"  value="{{ $unit->room_no }}" placeholder="4" required/>
                    </div>

                    <div class="mt-6">
                        <label for="description" class="font-semibold text-xl">Room Description:</label>
                        <textarea name="description" value="{{ $unit->description }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            2 rooms
                        </textarea>
                    </div>
                </div>
            </div>
            <x-button class="mt-8">
                {{ __('Update') }}
            </x-button>
        </form>
        </div>
    </div>
</div>
<script>
    function editUnit(counter, unit) {
        const unitForm = document.getElementById('unitForm' + counter);
        const event = new CustomEvent('open-edit-unit', { detail: { unitForm } });
        window.dispatchEvent(event);
        document.getElementById("unitName").value = unit.unit;
    }
</script>
