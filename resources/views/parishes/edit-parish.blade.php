<div id="parishEditModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span onclick="closeParishModal()" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Parish/Ward') }} 
        </h6>
        <form method="POST" action="" id="editParishForm">
            @csrf
            @method('PUT')
            
            <div class="mt-6">
                <x-label for="parish" value="{{ __('Parish Name') }}" class="font-semibold text-xl"/>
                <x-input id="parishName" class="block mt-1 w-full rounded text-gray-700" type="text" name="parish" :value="old('parish')" required autofocus autocomplete="parish" />
            </div>

            <div class="mt-4">
                <x-label for="subcounty_id" value="{{ __('Select Sub-County') }}" class="font-semibold text-xl"/>
                <select id="subcounty_id" class="w-full font-medium py-2 rounded text-gray-700" name="subcounty_id" required>
                    <option class="block mt-1 w-full" value=""></option>
                    @foreach ($subcounties as $subcounty)
                        <option class="block mt-1 w-full" value="{{ $subcounty->id }}">{{ $subcounty->subcounty }}</option>
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
    function openParishModal(parish) {
        document.getElementById('parishEditModal').classList.remove('hidden');

        document.getElementById('parishName').value = parish.parish;
        document.getElementById('editParishForm').action = "{{ route('parish.update', '') }}" + "/" + parish.slug;
    }

    function closeParishModal() {
        document.getElementById('parishEditModal').classList.add('hidden');
    }
    
</script>

