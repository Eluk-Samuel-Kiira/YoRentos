<div>
    <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 transition-opacity duration-500 hidden">
        <span id="notificationMessage"></span>
    </div>
    <div
        x-data = "{show : false }"
        x-show = "show"
        x-on:open-modal-edit.window = "show = true"
        x-on:close-modal.window = "show = false"
        style="display:none"
        class="fixed">

        <div class="fixed inset-0 bg-gray-300 opacity-80 backdrop-blur-lg"></div>
            <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl overflow-y-auto" style="max-height:650px">
                <div class="px-4 py-3 flex items-center justify-between border-b border-gray-300">
                    <div class="text-xl text-gray-800">{{__('Edit Role') }}</div>
                    <button x-on:click="$dispatch('close-modal')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-4">        
                    <form x-on:submit.prevent="submitFormEdit">
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
                                <!-- Master Checkbox -->
                                <input type="checkbox" id="masterPermissionCheckbox" class="mr-2">
                                <label for="masterPermissionCheckbox" class="text-sm font-medium">Select All</label>
                                <br>
                                
                                @foreach($permissions as $permission)
                                    <input type="checkbox" id="permission{{ $permission->name }}" name="permissions[]" value="{{ $permission->name }}" class="mr-2 permission-checkbox">
                                    <label for="permission{{ $permission->name }}" class="text-sm">{{ $permission->name }}</label>
                                    <br>
                                @endforeach
                            </div>
                        </div>
                        <x-button type="submit" class="mt-8">
                            Save
                        </x-button>
                    </form>
                </div>        
            </div>
        </div>
    </div>
</div>
<script>
    function editRole() {
        const event = new CustomEvent('open-modal-edit');
        window.dispatchEvent(event);
    }

    function submitFormEdit() {
        const permissions = [];
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                permissions.push(checkbox.value);
            }
        });
        const role = event.target.querySelector('#role').value;
        // console.log(permissions);
        
        if (role !== null) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('edit.role') }}",
                type: "POST",
                data: {
                    permissions: permissions,
                    role: role,
                },
                success: function(response) {
                    if (response.success) {
                        showNotification(response.success, response.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 4000);
                    } else {
                        showNotification(response.success, response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Role Is Required');
                }
            });
        } else {
            alert('Role Is Required');
        }
        this.show = false;

        function showNotification(success, message) {
            var notification = $("#notification");
            var notificationMessage = $("#notificationMessage");

            if (success) {
                notificationMessage.text(message);
                notification.removeClass("bg-red-500").addClass("bg-green-500");
            } else {
                notificationMessage.text(message);
                notification.removeClass("bg-green-500").addClass("bg-red-500");
            }

           notification.removeClass("hidden");
            notification.addClass("opacity-100");

            // Automatically hide the notification after 3 seconds
            setTimeout(function() {
                notification.removeClass("opacity-100");
                notification.addClass("hidden");
            }, 3000); 

        }
    }

    //Check all boxes
    document.addEventListener('DOMContentLoaded', function() {
        // Get master checkbox and individual permission checkboxes
        var masterCheckbox = document.getElementById('masterPermissionCheckbox');
        var permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        // Add event listener to master checkbox
        masterCheckbox.addEventListener('change', function() {
            // Loop through individual permission checkboxes and set their checked status
            permissionCheckboxes.forEach(function(checkbox) {
                checkbox.checked = masterCheckbox.checked;
            });
        });
        // Add event listeners to individual permission checkboxes
        permissionCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // If all individual checkboxes are checked, set master checkbox to checked; otherwise, set it to unchecked
                var allChecked = true;
                permissionCheckboxes.forEach(function(checkbox) {
                    if (!checkbox.checked) {
                        allChecked = false;
                    }
                });
                masterCheckbox.checked = allChecked;
            });
        });
    });
</script>
