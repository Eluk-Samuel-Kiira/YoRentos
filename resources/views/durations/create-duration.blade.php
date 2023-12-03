<div id="durationModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span id="closeCreateDuration" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Duration Types') }} 
        </h6>
        <form method="POST" action="{{ route('duration.store') }}">
            @csrf
            <div class="mt-6">
                <x-label for="duration" value="{{ __('Duration Name') }}" class="font-semibold text-xl"/>
                <x-input id="duration" class="block mt-1 w-full" type="text" name="duration" :value="old('duration')" required autofocus autocomplete="duration" />
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
    document.getElementById('openCreateDuration').onclick = function () {
        document.getElementById('durationModal').classList.remove('hidden');
    };

    document.getElementById('closeCreateDuration').onclick = function () {
        document.getElementById('durationModal').classList.add('hidden');
    };
</script>
