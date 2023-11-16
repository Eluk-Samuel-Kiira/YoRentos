<div id="rentalModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span id="closeCreateRental" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Rental Types') }} 
        </h6>
        <form method="POST" action="{{ route('rental.store') }}">
            @csrf
            <div class="mt-6">
                <x-label for="rental_name" value="{{ __('Rental Name') }}" class="font-semibold text-xl"/>
                <x-input id="rental_name" class="block mt-1 w-full" type="text" name="name" :value="old('rental_name')" required autofocus autocomplete="rental_name" />
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
    document.getElementById('openCreateRental').onclick = function () {
        document.getElementById('rentalModal').classList.remove('hidden');
    };

    document.getElementById('closeCreateRental').onclick = function () {
        document.getElementById('rentalModal').classList.add('hidden');
    };
</script>
