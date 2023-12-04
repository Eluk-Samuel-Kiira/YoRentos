<div id="resourceEditModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span onclick="closeResourceModal()" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Resource Types') }} 
        </h6>
        <form method="POST" action="" id="editResourceForm">
            @csrf
            @method('PUT')
            
            <div class="mt-6">
                <x-label for="Resource" value="{{ __('Resource Name') }}" class="font-semibold text-xl"/>
                <x-input id="resourceName" class="block mt-1 w-full rounded text-gray-700" type="text" name="resource" :value="old('resource')" required autofocus autocomplete="resource" />
            </div>

            <x-button class="mt-8">
                {{ __('Save') }}
            </x-button>
            </div>
        </form>
    </div>
</div>

<script>
    function openResourceModal(resource) {
        document.getElementById('resourceEditModal').classList.remove('hidden');

        document.getElementById('resourceName').value = resource.resource;
        document.getElementById('editResourceForm').action = "{{ route('resource.update', '') }}" + "/" + resource.slug;
    }

    function closeResourceModal() {
        document.getElementById('resourceEditModal').classList.add('hidden');
    }
    
</script>

