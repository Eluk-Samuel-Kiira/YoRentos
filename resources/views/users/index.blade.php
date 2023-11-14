<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    <button id="openRoleModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Role
                    </button>
                    <h5>    
                        @if(session('error'))
                            <span class="bg-red-500 text-white rounded">
                                {{ session('error') }}
                            </span>
                        @endif
                        @if(session('success'))
                            <span class="bg-green-500 text-white rounded">
                                {{ session('success') }}
                            </span>
                        @endif
                    </h5>
                    @include('users.create-role')
                    
                    <div class="container mx-auto mt-8">
                        <table class="min-w-full border border-blue-500 text-gray-500">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border border-blue-500">ID</th>
                                    <th class="py-2 px-4 border border-blue-500">Role</th>
                                    <th class="py-2 px-4 border border-blue-500">Permissions</th>
                                    <th class="py-2 px-4 border border-blue-500">Edit</th>
                                    <th class="py-2 px-4 border border-blue-500">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="role-list">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="container mx-auto mt-8">
                        <table class="min-w-full border border-blue-500 text-gray-500">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border border-blue-500">ID</th>
                                    <th class="py-2 px-4 border border-blue-500">Name</th>
                                    <th class="py-2 px-4 border border-blue-500">Email</th>
                                    <th class="py-2 px-4 border border-blue-500">Role</th>
                                </tr>
                            </thead>
                            <tbody id="user-list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        // Make an AJAX request to fetch users
        $.ajax({
            url: '{{ route('users.details') }}',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Display the users in the #user-list div
                displayUsers(response.users);
                displayRoles(response.roles);
            },
            error: function(error) {
                console.error('Error fetching users:', error);
            }
        });

        // Function to display users
        function displayUsers(users) {
            var userList = $('#user-list');
            userList.empty(); // Clear existing content
            // Loop through the users and append them to the table
            users.forEach(function(user) {
                var userRow =  '<tr>' +
                                    '<td class="py-2 px-4 border-b border-r">' + user.id + '</td>' +
                                    '<td class="py-2 px-4 border-b border-r">' + user.name + '</td>' +
                                    '<td class="py-2 px-4 border-b border-r">' + user.email + '</td>' +
                                    '<td class="py-2 px-4 border-b">' + user.role + '</td>' +
                                '</tr>';
                userList.append(userRow);
            });
        }

        // Function to display users
        function displayRoles(roles) {
            var roleList = $('#role-list');
            roleList.empty(); // Clear existing content
            // Loop through the users and append them to the table
            roles.forEach(function(role) {
                let permissionNames = role.permissions.map(permission => permission.name).join(', ');

                var roleRow = '<tr>' +
                                    '<td class="py-2 px-4 border-b border-r">' + role.id + '</td>' +
                                    '<td class="py-2 px-4 border-b border-r">' + role.name + '</td>' +
                                    '<td class="py-2 px-4 border-b border-r">' + permissionNames + '</td>' +
                                    '<td class="py-2 px-3 border-b border-r">' +
                                        '<button class = "py-1 px-2 bg-blue-300  text-white rounded hover:bg-blue-500">' + 'Edit' +'</button>' + 
                                    '</td>' +
                                    '<td class="py-2 px-3 border-b">' +
                                        '<button class = "py-1 px-2 bg-red-300  text-white rounded hover:bg-red-500">' + 'Delete' +'</button>' + 
                                    '</td>' +
                                '</tr>';
                roleList.append(roleRow);
            });
        }
    });
</script>