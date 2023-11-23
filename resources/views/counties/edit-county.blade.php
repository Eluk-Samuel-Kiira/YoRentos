<div id="countyEditModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span onclick="closeCountyModal()" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit County/Constituency') }} 
        </h6>
        <form method="POST" action="" id="editCountyForm">
            @csrf
            @method('PUT')
            
            <div class="mt-6">
                <x-label for="county" value="{{ __('County Name') }}" class="font-semibold text-xl"/>
                <x-input id="CountyName" class="block mt-1 w-full rounded text-gray-700" type="text" name="county" required />
            </div>

            <div class="mt-4">
                <x-label for="district_id" value="{{ __('District') }}" class="font-semibold text-xl"/>
                <select id="district_id" class="w-full font-medium py-2 rounded text-gray-700" name="district_id" required>
                    <option class="block mt-1 w-full" value=""></option>
                    @foreach ($districts as $district)
                        <option class="block mt-1 w-full" value="{{ $district->id }}">{{ $district->district }}</option>
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
    function openCountyModal(county) {
        document.getElementById('countyEditModal').classList.remove('hidden');

        document.getElementById('CountyName').value = county.county;
        document.getElementById('editCountyForm').action = "{{ route('county.update', '') }}" + "/" + county.slug;
    }

    function closeCountyModal() {
        document.getElementById('countyEditModal').classList.add('hidden');
    }
    
</script>

