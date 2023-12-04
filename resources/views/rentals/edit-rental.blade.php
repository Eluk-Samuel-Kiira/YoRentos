<div id="rentalEditModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span onclick="closeRentalModal()" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Rental Types') }} 
        </h6>
        <form method="POST" action="" id="editRentalForm">
            @csrf
            @method('PUT')
            
            <div class="mt-6">
                <x-label for="duration" value="{{ __('Rental Name') }}" class="font-semibold text-xl"/>
                <x-input id="rentalName" class="block mt-1 w-full rounded text-gray-700" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <x-button class="mt-8">
                {{ __('Save') }}
            </x-button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRentalModal(rental) {
        document.getElementById('rentalEditModal').classList.remove('hidden');

        document.getElementById('rentalName').value = rental.name;
        document.getElementById('editRentalForm').action = "{{ route('rental.update', '') }}" + "/" + rental.slug;
    }

    function closeRentalModal() {
        document.getElementById('rentalEditModal').classList.add('hidden');
    }
    
</script>

