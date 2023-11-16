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
                    <button id="editRoleModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit Role
                    </button>
                    <span id="user-count" class="bg-green-500 text-white font-bold py-2 px-4 rounded"></span>
                    <h4>    
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
                    </h4>
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8">
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                @include('users.create-role')
                                @include('users.edit-role')
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Role</th>
                                        <th class="py-2 px-4 border border-blue-500">Permissions</th>
                                        <th class="py-2 px-4 border border-blue-500">Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="role-list">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive" style="overflow-x: auto;">
                        <div class="container mx-auto mt-8">
                            <input class="rounded" type="text" id="searchInput" placeholder="Search by name..." onkeyup="searchUsers()">
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Name</th>
                                        <th class="py-2 px-4 border border-blue-500">Phone Number</th>
                                        <th class="py-2 px-4 border border-blue-500">Email</th>
                                        <th class="py-2 px-4 border border-blue-500">Role</th>
                                        <th class="py-2 px-4 border border-blue-500">Status</th>
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
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            var userRow =  '<tr>' +
                                '<td class="py-2 px-4 border-b border-r">' + user.id + '</td>' +
                                '<td class="py-2 px-4 border-b border-r">' + user.name + '</td>' +
                                '<td class="py-2 px-4 border-b border-r">' + user.phone_number + '</td>' +
                                '<td class="py-2 px-4 border-b border-r">' + user.email + '</td>' +
                                '<td class="py-2 px-3 border-b border-r">' +
                                    '<form id="changeRoleForm" method="POST" action="{{ route('change.role') }}">' +
                                        '<input type="hidden" name="_token" value="' + csrfToken + '">' +
                                        '<span class="py-1 px-2 bg-green-500 text-white rounded mr-6">' + user.role +'</span> ' + 
                                        '<input type="hidden" name="user" value="'+user.id+'">'+
                                        '<select id="newRole" name="newRole" class="rounded" required>' +
                                            '<option class="block mt-1 w-full" value="">Change</option>'+
                                            @foreach ($roles as $role)
                                                '<option class="block mt-1 w-full" value="{{ $role->name }}">{{ $role->name }}</option>'+
                                            @endforeach
                                        '</select>' +
                                        '<input type="submit" value="Change" class="px-1 bg-blue-300 text-white rounded hover:bg-blue-500">' +
                                    '</form>' +
                                '</td>' +
                                '<td class="py-2 px-3 border-b">' +
                                    '<a href="/change-status/' + user.id + '" class="py-1 px-2 ' + (user.status == 1 ? 'bg-green-300' : 'bg-red-300') + ' text-white rounded hover:' + (user.status == 1 ? 'bg-green-500' : 'bg-red-500') + '">' +
                                        (user.status == 1 ? 'Active' : 'Inactive') +
                                    '</a>' +
                                '</td>'+
                            '</tr>';
                userList.append(userRow);
            });
            
            // Get the table element where users are displayed
            var userList = document.getElementById('user-list').getElementsByTagName('tr').length;
            var userCountElement = document.getElementById('user-count');
            userCountElement.textContent = 'Total Users: ' + userList;  
            
        }

        // Function to display user roles
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
                                    '<td class="py-2 px-3 border-b">' +
                                        '<a href="/delete-role/' + role.id + '" class="py-1 px-2 bg-red-300 text-white rounded hover:bg-red-500">' +
                                            'Delete' +
                                        '</a>' +
                                    '</td>'
                                '</tr>';
                roleList.append(roleRow);
            });
        }
    });

    // Function to filter users based on search term
    function searchUsers() {
        var input = document.getElementById('searchInput');
        var filter = input.value.toUpperCase();
        var users = document.getElementById('user-list').getElementsByTagName('tr');

        // Loop through all table rows and hide those that don't match the search query
        for (var i = 0; i < users.length; i++) {
            var nameColumn = users[i].getElementsByTagName('td')[1]; // Assuming name is in the second column
            if (nameColumn) {
                var nameValue = nameColumn.textContent || nameColumn.innerText;
                if (nameValue.toUpperCase().indexOf(filter) > -1) {
                    users[i].style.display = '';
                } else {
                    users[i].style.display = 'none';
                }
            }
        }
    } 

</script>