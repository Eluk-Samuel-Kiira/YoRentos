<div id="subcountyModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span id="closeSubcountyModal" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Sub-County/Division') }} 
        </h6>
        <form method="POST" action="{{ route('subcounty.store') }}">
            @csrf

            <div class="mt-6">
                <x-label for="subcounty" value="{{ __('Sub-County Name') }}" class="font-semibold text-xl"/>
                <x-input id="subcounty" class="block mt-1 w-full rounded text-gray-700" type="text" name="subcounty" :value="old('subcounty')" required autofocus autocomplete="subcounty" />
            </div>

            <div class="mt-4">
                <x-label for="county_id" value="{{ __('Select County') }}" class="font-semibold text-xl"/>
                <select id="county_id" class="w-full font-medium py-2 rounded text-gray-700" name="county_id" required>
                    <option class="block mt-1 w-full" value=""></option>
                    @foreach ($counties as $county)
                        <option class="block mt-1 w-full" value="{{ $county->id }}">{{ $county->county }}</option>
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
    document.getElementById('openSubCountyModal').onclick = function () {
        document.getElementById('subcountyModal').classList.remove('hidden');
    };

    document.getElementById('closeSubcountyModal').onclick = function () {
        document.getElementById('subcountyModal').classList.add('hidden');
    };

</script>

