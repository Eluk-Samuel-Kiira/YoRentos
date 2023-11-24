<div id="parishModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span id="closeParishModal" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Parish/Ward') }} 
        </h6>
        <form method="POST" action="{{ route('parish.store') }}">
            @csrf

            <div class="mt-4">
                <x-label for="subcounty_id" value="{{ __('Select Sub-County') }}" class="font-semibold text-xl"/>
                <select id="subcounty_id" class="w-full font-medium py-2 rounded text-gray-700" name="subcounty_id" required>
                    <option class="block mt-1 w-full" value=""></option>
                    @foreach ($subcounties as $subcounty)
                        <option class="block mt-1 w-full" value="{{ $subcounty->id }}">{{ $subcounty->subcounty }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-6">
                <x-label for="parish" value="{{ __('Parish Name') }}" class="font-semibold text-xl"/>
                <x-input id="parish" class="block mt-1 w-full rounded text-gray-700" type="text" name="parish" :value="old('parish')" required autofocus autocomplete="parish" />
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
    document.getElementById('openParishModal').onclick = function () {
        document.getElementById('parishModal').classList.remove('hidden');
    };

    document.getElementById('closeParishModal').onclick = function () {
        document.getElementById('parishModal').classList.add('hidden');
    };

</script>

