
<div id="unitForm{{$counter}}">
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
                    <label for="square_footage" class="font-semibold text-xl">Room Measurement (Square Foot):</label>
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