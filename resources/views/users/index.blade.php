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
                            <tbody>
                                <tr>
                                    <div id="user-list">
                                        <!-- Users will be displayed here -->
                                    </div>
                                    <td class="py-2 px-4 border-b border-r">1</td>
                                    <td class="py-2 px-4 border-b border-r">John Doe</td>
                                    <td class="py-2 px-4 border-b border-r">john@example.com</td>
                                    <td class="py-2 px-4 border-b">Admin</td>
                                </tr>
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
            url: '{{ route('user') }}',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Display the users in the #user-list div
                displayUsers(response.users);
            },
            error: function(error) {
                console.error('Error fetching users:', error);
            }
        });

        // Function to display users
        function displayUsers(users) {
            var userList = $('#user-list');
            userList.empty(); // Clear existing content

            // Loop through the users and append them to the #user-list div
            users.forEach(function(user) {
                var userHtml = '<div>ID: ' + user.id + ', Name: ' + user.name + ', Email: ' + user.email + '</div>';
                userList.append(userHtml);
            });
        }
    });
</script>