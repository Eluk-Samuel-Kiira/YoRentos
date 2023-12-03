<div id="durationEditModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span onclick="closeDurationModal()" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Duration Types') }} 
        </h6>
        <form method="POST" action="" id="editDurationForm">
            @csrf
            @method('PUT')
            
            <div class="mt-6">
                <x-label for="duration" value="{{ __('Duration Name') }}" class="font-semibold text-xl"/>
                <x-input id="durationName" class="block mt-1 w-full rounded text-gray-700" type="text" name="duration" :value="old('duration')" required autofocus autocomplete="duration" />
            </div>

            <x-button class="mt-8">
                {{ __('Save') }}
            </x-button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDurationModal(duration) {
        document.getElementById('durationEditModal').classList.remove('hidden');

        document.getElementById('durationName').value = duration.duration;
        document.getElementById('editDurationForm').action = "{{ route('duration.update', '') }}" + "/" + duration.slug;
    }

    function closeDurationModal() {
        document.getElementById('durationEditModal').classList.add('hidden');
    }
    
</script>

