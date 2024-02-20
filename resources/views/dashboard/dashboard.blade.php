@include('dashboard.tenant-dashboard')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
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
        <h6>
            <div id="error-container"></div>
        </h6>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto p-6">
                    Reports
                    <div class="flex flex-col md:flex-row justify-center items-center">
                        <div class="w-full md:w-1/3 p-4">
                            <h3 class="text-center mb-4">Rental Houses Vs Active Occupants</h3>
                            <canvas id="rentalPieChart"></canvas>
                        </div>
                        <div class="w-full md:w-1/2 p-4">
                            <h3 class="text-center mb-4">Number Of Estates Per District</h3>
                            <canvas id="districtBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('dashboard.user_location')

<script>
    $(document).ready(function() {
        // Make an AJAX request to fetch rentals
        $.ajax({
            url: '{{ route('pie.rentals') }}',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                const rentals = response.rentals;

                const labels = [];
                const counts = [];

                rentals.forEach(rental => {
                    labels.push(rental.name); 
                    const unitsWithStatusOne = rental.rental_units.filter(unit => unit.status === 1);
                    counts.push(unitsWithStatusOne.length); 
                });

                const ctx = document.getElementById('rentalPieChart').getContext('2d');
                rentalPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: counts,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)', 
                                'rgba(255, 159, 64, 0.7)', 
                                'rgba(0, 255, 255, 0.7)', 
                                'rgba(255, 0, 255, 0.7)',
                            ],
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: 'Rental Type Occupied Most by Units Occupied',
                        },
                    },
                });
            },
            error: function(error) {
                console.error('Error fetching rentals:', error);
            }
        }); 
    });

    // Districts and their categorical rental estates
    $(document).ready(function() {
        // Make an AJAX request to fetch rentals
        $.ajax({
            url: '{{ route('bar.estates') }}',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                const districtEstates = response.districtEstates;

                const districts = Object.keys(districtEstates);
                const estatesInfo = Object.values(districtEstates);
                const estate_rental = estatesInfo.map(array => array.map(estate => estate.rental_name.name));
                
                function countOccurrences(arr) {
                    const counts = {};
                    arr.forEach(item => {
                        counts[item] = (counts[item] || 0) + 1;
                    });
                    return counts;
                }

                const estateCount = estatesInfo.map(array => array.length);
                const formattedResults = estate_rental.map(array => {
                    const counts = countOccurrences(array);
                    return Object.entries(counts)
                        .map(([key, value]) => `${key} ${value}`)
                        .join(', ');
                });

                // Combine estate count and formatted results for each district
                const mergedData = formattedResults.map((formattedResult, index) => {
                    return `${formattedResult}, Number of Estates: ${estateCount[index]}`;
                });

                // Create a bar chart using Chart.js with tooltips displaying custom text
                var ctx = document.getElementById('districtBarChart').getContext('2d');
                const myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: districts,
                        datasets: [{
                            label: 'Number of Estates',
                            data: estateCount,
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: (context) => {
                                        // Display mergedData for each district in tooltips
                                        return mergedData[context.dataIndex];
                                    }
                                }
                            }
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(error) {
                console.error('Error fetching rentals:', error);
            }
        }); 
    });

</script>