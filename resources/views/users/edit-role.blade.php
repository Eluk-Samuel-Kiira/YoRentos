<div id="editRole" class="modal auto hidden inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
    <div class="modal-content bg-white w-2/3 mx-auto my-10 p-4 relative sm:rounded-lg">        
        <!-- Close button -->
        <span id="closeEdit" class="cursor-pointer absolute top-0 right-0 p-2 bg-red-500 hover:bg-red-700 text-white rounded">
            &times;Close
        </span>        
        <!-- Form content -->
        <h6 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit a Role and give it Permissions') }} 
        </h6>
        <form method="POST" action="{{ route('edit.role') }}">
            @csrf
            <div class="mt-4">
                <x-label for="role" value="{{ __('Role Name') }}" class="font-semibold text-xl"/>
                <select id="role" class="w-full font-medium py-2 rounded text-gray-700" name="role" required>
                    <option class="block mt-1 w-full" value="">Select Role</option>
                    @foreach ($roles as $role)
                        <option class="block mt-1 w-full" value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
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

            
                    <!-- <div class="mt-4">
                        <x-label for="permissions" value="{{ __('Permissions') }}" class="font-semibold text-xl"/>
                        <div>
                            @foreach($all_permissions as $permission)
                                <input type="checkbox" id="permission{{ $permission->name }}" wire:model="permissions[]" value="{{ $permission->name }}" class="mr-2">
                                <label for="permission{{ $permission->name }}" class="text-sm">{{ $permission->name }}</label>
                                <br>
                            @endforeach
                        </div>
                    </div> -->
            <x-button class="mt-8">
                {{ __('Save') }}
            </x-button>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript to handle opening and closing the modal
    document.getElementById('editRoleModal').onclick = function () {
        document.getElementById('editRole').classList.remove('hidden');
    };

    document.getElementById('closeEdit').onclick = function () {
        document.getElementById('editRole').classList.add('hidden');
    };
</script>

