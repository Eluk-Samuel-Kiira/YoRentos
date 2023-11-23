<div id="countyModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span id="closeCountyModal" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New County/Constituency') }} 
        </h6>
        <form method="POST" action="{{ route('county.store') }}">
            @csrf

            <div class="mt-4">
                <x-label for="district_id" value="{{ __('District') }}" class="font-semibold text-xl"/>
                <select id="district_id" class="w-full font-medium py-2 rounded text-gray-700" name="district_id" required>
                    <option class="block mt-1 w-full" value=""></option>
                    @foreach ($districts as $district)
                        <option class="block mt-1 w-full" value="{{ $district->id }}">{{ $district->district }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-6">
                <x-label for="county" value="{{ __('County Name') }}" class="font-semibold text-xl"/>
                <x-input id="county" class="block mt-1 w-full rounded text-gray-700" type="text" name="county" :value="old('county')" required autofocus autocomplete="county" />
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
    document.getElementById('openCountyModal').onclick = function () {
        document.getElementById('countyModal').classList.remove('hidden');
    };

    document.getElementById('closeCountyModal').onclick = function () {
        document.getElementById('countyModal').classList.add('hidden');
    };

</script>

