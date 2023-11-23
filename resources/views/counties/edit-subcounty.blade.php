<div id="subcountyEditModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span onclick="closeSubcountyModal()" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit County/Constituency') }} 
        </h6>
        <form method="POST" action="" id="editSubcountyForm">
            @csrf
            @method('PUT')
            
            <div class="mt-6">
                <x-label for="subcounty" value="{{ __('Sub-County Name') }}" class="font-semibold text-xl"/>
                <x-input id="subcountyName" class="block mt-1 w-full rounded text-gray-700" type="text" name="subcounty" :value="old('subcounty')" required autofocus autocomplete="subcounty" />
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
    function openSubcountyModal(subcounty) {
        document.getElementById('subcountyEditModal').classList.remove('hidden');

        document.getElementById('subcountyName').value = subcounty.subcounty;
        document.getElementById('editSubcountyForm').action = "{{ route('subcounty.update', '') }}" + "/" + subcounty.slug;
    }

    function closeSubcountyModal() {
        document.getElementById('subcountyEditModal').classList.add('hidden');
    }
    
</script>

