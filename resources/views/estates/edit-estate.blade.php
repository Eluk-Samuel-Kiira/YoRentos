<div id="estateEditModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span onclick="closeEstateModal()" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Estate') }} 
        </h6>
        <form method="POST" action="" id="editEstateForm">
            @csrf
            @method('PUT')
            
            @livewire("location-filter") 
            <div class="mt-6">
                <x-label for="rental" value="{{ __('Rental Type') }}" class="font-semibold text-xl"/>
                <select id="rental_id" class="w-full font-medium py-2 rounded text-gray-700" name="rental_id" required>
                    <option class="block mt-1 w-full" value=""></option>
                    @foreach ($rentals as $rental)
                        <option class="block mt-1 w-full" value="{{ $rental->id }}">{{ $rental->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mt-6">
                <x-label for="estate" value="{{ __('Estae Name') }}" class="font-semibold text-xl"/>
                <x-input id="estateName" class="block mt-1 w-full rounded text-gray-700" type="text" name="estate" :value="old('estate')" required autofocus autocomplete="estate" />
            </div>

            <x-button class="mt-8">
                {{ __('Save') }}
            </x-button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEstateModal(estate) {
        document.getElementById('estateEditModal').classList.remove('hidden');

        document.getElementById('estateName').value = estate.estate;
        document.getElementById('editEstateForm').action = "{{ route('estate.update', '') }}" + "/" + estate.slug;
    }

    function closeEstateModal() {
        document.getElementById('estateEditModal').classList.add('hidden');
    }
    
</script>

