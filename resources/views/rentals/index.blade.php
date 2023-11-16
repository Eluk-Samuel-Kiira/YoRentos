<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rental List') }} 
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    @can('manage all')
                        <button id="openCreateRental" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Rental
                        </button>
                    @endcan
                    <h4>  
                        <x-validation-errors class="mb-4" />  
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
                            @can('manage all')
                                @include('rentals.create')
                            @endcan
                            <table class="min-w-full border border-blue-500 text-gray-500">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border border-blue-500">ID</th>
                                        <th class="py-2 px-4 border border-blue-500">Rental Name</th>
                                        @can('manage all')
                                            <th class="py-2 px-4 border border-blue-500">Status</th>
                                            <th class="py-2 px-4 border border-blue-500">Delete</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody id="rental-list">
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
            url: '{{ route('rental.create') }}',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                displayRentals(response.rental);
            },
            error: function(error) {
                console.error('Error fetching users:', error);
            }
        }); 

        // Function to display user roles
        function displayRentals(rentals) {
            var rentalList = $('#rental-list');
            rentalList.empty(); // Clear existing content
            // Loop through the users and append them to the table
            rentals.forEach(function(rental) {
                var rentalRow = '<tr>' +
                                    '<td class="py-2 px-4 border-b border-r">' + rental.id + '</td>' +
                                    '<td class="py-2 px-4 border-b border-r">' + rental.name + '</td>' +
                                    @can('manage all')
                                        '<td class="py-2 px-3 border-b">' +
                                            '<a href="/rental-status/' + rental.id + '" class="py-1 px-2 ' + (rental.status == 1 ? 'bg-green-300' : 'bg-red-300') + ' text-white rounded hover:' + (rental.status == 1 ? 'bg-green-500' : 'bg-red-500') + '">' +
                                                (rental.status == 1 ? 'Active' : 'Inactive') +
                                            '</a>' +
                                        '</td>'+
                                        '<td class="py-2 px-3 border-b">' +
                                            '<a href="/delete-rental/' + rental.id + '" class="py-1 px-2 bg-red-300 text-white rounded hover:bg-red-500">' +
                                                'Delete' +
                                            '</a>' +
                                        '</td>'
                                    @endcan
                                '</tr>';
                rentalList.append(rentalRow);
            });
        }
    });

</script>