<div id="roleModal" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span id="closeRoleModal" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times; close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Role and give it Permissions') }} 
        </h6>
        <form method="POST" action="{{ route('create.role') }}">
            @csrf
            <div class="mt-6">
                <x-label for="role" value="{{ __('Role Name') }}" class="font-semibold text-xl"/>
                <x-input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required autofocus autocomplete="role" />
            </div>
            
            <div class="mt-4">
                <x-label for="permissions" value="{{ __('Permissions') }}" class="font-semibold text-xl"/>
                <div>
                    @foreach($permissions as $permission)
                        <input type="checkbox" id="permission{{ $permission->name }}" name="permissions[]" value="{{ $permission->name }}" class="mr-2">
                        <label for="permission{{ $permission->name }}" class="text-sm">{{ $permission->name }}</label>
                        <br>
                    @endforeach
                </div>
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
    document.getElementById('openRoleModal').onclick = function () {
        document.getElementById('roleModal').classList.remove('hidden');
    };

    document.getElementById('closeRoleModal').onclick = function () {
        document.getElementById('roleModal').classList.add('hidden');
    };
</script>

