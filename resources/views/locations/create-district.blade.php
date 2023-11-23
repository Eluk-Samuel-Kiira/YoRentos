<div id="districtModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span id="closeDistrictModal" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New District') }} 
        </h6>
        <form method="POST" action="{{ route('district.store') }}">
            @csrf
            <div class="mt-6">
                <x-label for="district" value="{{ __('District Name') }}" class="font-semibold text-xl"/>
                <x-input id="district" class="block mt-1 w-full" type="text" name="district" :value="old('district')" required autofocus autocomplete="district" />
            </div>

            <div class="mt-4">
                <x-label for="country_id" value="{{ __('Country') }}" class="font-semibold text-xl"/>
                <select id="country_id" class="w-full font-medium py-2 rounded text-gray-700" name="country_id" required>
                    <option class="block mt-1 w-full" value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option class="block mt-1 w-full" value="{{ $country->id }}">{{ $country->country }}</option>
                    @endforeach
                </select>
            </div>

            <x-button class="mt-8">
                {{ __('Save') }}
            </x-button>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript to handle opening and closing the modal
    document.getElementById('openDistrictModal').onclick = function () {
        document.getElementById('districtModal').classList.remove('hidden');
    };

    document.getElementById('closeDistrictModal').onclick = function () {
        document.getElementById('districtModal').classList.add('hidden');
    };
</script>

