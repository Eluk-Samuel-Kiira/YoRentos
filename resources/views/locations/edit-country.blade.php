<div id="counrtyEditModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span onclick="closeModal()" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Country') }} 
        </h6>
        <form method="POST" action="" id="editCountryForm">
            @csrf
            @method('PUT')
            
            <div class="mt-6">
                <x-label for="country" value="{{ __('Country Name') }}" class="font-semibold text-xl"/>
                <x-input id="countryName" class="block mt-1 w-full" type="text" name="country" required autofocus autocomplete="country" />
            </div>

            <x-button class="mt-8">
                {{ __('Save') }}
            </x-button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(country) {
        document.getElementById('counrtyEditModal').classList.remove('hidden');

        document.getElementById('countryName').value = country.country;
        document.getElementById('editCountryForm').action = "{{ route('country.update', '') }}" + "/" + country.slug;
    }

    function closeModal() {
        document.getElementById('counrtyEditModal').classList.add('hidden');
    }
</script>

