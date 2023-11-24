<div id="villageEditModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span onclick="closeVillageModal()" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Village') }} 
        </h6>
        <form method="POST" action="" id="editVillageForm">
            @csrf
            @method('PUT')
            
            <div class="mt-6">
                <x-label for="village" value="{{ __('Village Name') }}" class="font-semibold text-xl"/>
                <x-input id="villageName" class="block mt-1 w-full rounded text-gray-700" type="text" name="village" :value="old('village')" required autofocus autocomplete="village" />
            </div>

            <div class="mt-4">
                <x-label for="parish_id" value="{{ __('Select Parish') }}" class="font-semibold text-xl"/>
                <select id="parish_id" class="w-full font-medium py-2 rounded text-gray-700" name="parish_id" required>
                    <option class="block mt-1 w-full" value=""></option>
                    @foreach ($parishes as $parish)
                        <option class="block mt-1 w-full" value="{{ $parish->id }}">{{ $parish->parish }}</option>
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
    function openVillageModal(village) {
        document.getElementById('villageEditModal').classList.remove('hidden');

        document.getElementById('villageName').value = village.village;
        document.getElementById('editVillageForm').action = "{{ route('village.update', '') }}" + "/" + village.slug;
    }

    function closeVillageModal() {
        document.getElementById('villageEditModal').classList.add('hidden');
    }
    
</script>

