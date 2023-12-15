@include('layouts.header')
<title>Estate | YoRentos</title>
@include('layouts.menu')

<section class="find_section ">
        <div class="container">
            <h6>
                <div id="message-container"></div>
            </h6>
            <div class="description">
                @if ($rental_location)
                    <h1 class="btn uppercase font-size">
                        <b>
                            {{ $rental_location->estate}}
                        </b>
                    </h1>
                    <span class="btn btn-small">
                        @foreach($users as $user)
                            @if ($rental_location->landlord_id == $user->id)
                                {{__('Incharge: ')}}{{ $user->name }} <br>
                                {{__('Telephone: ')}}{{ $user->phone_number }}
                            @endif
                        @endforeach
                    </span>
                    <div class="form-row">
                        <div id="map" class="leaflet-map"></div>
                    </div>
                @endif
            </div>
        </div>
    </section>


@include('layouts.footer')


<script>
    var rentalLocations = {!! $rental_location !!};
    // console.log(rentalLocations.longitude)

    //Map view continues
    var map = L.map('map').setView([rentalLocations.latitude, rentalLocations.longitude], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    //Google street markers
    var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });
    googleStreets.addTo(map);

    var marker_rental = L.marker([rentalLocations.latitude, rentalLocations.longitude]).addTo(map);

    //global coordinates for the user's current position
    var lat = null;
    var lng = null;
    var marker_user = null;
    var roadLine = null;

    function updateUserLocation() {
        navigator.geolocation.getCurrentPosition(function(position) {
            // Get latitude and longitude values from position object
            lat = position.coords.latitude;
            lng = position.coords.longitude;
            // console.log(lat)
            // console.log(rentalLocations.latitude)

            if (marker_user === null) {
                // add marker for the user
                marker_user = L.marker([lat, lng]).addTo(map);
            } else {
                // Update the marker position
                marker_user.setLatLng([lat, lng]);
            }

            if (lat !== null && roadLine === null) {
                // create a red polyline from an array of LatLng points
                var latlngs = [
                    [lat, lng],
                    [rentalLocations.latitude, rentalLocations.longitude]
                ];
                roadLine = L.polyline(latlngs, { color: 'red', snakingSpeed: 200 }).addTo(map);
            }
            if (lat === rentalLocations.latitude && lng === rentalLocations.longitude) {
                var message = "You have already reached " + rentalLocations.estate + ".";
                showMessage(message);
            }
        }, function(error) {
            // Handle any errors that occur while getting the position
            console.error("Error getting position:", error);
        });
    }

    setInterval(updateUserLocation, 6000);


    marker_rental.on('click', mapClick);
    var pop = L.popup();

    function mapClick(e) {
        // Use a reverse geocoding service to get the name of the place
        var latlng = e.latlng;
        var geocoder = L.Control.Geocoder.nominatim();
        geocoder.reverse(latlng, map.options.crs.scale(map.getZoom()), function(results) {
            if (results.length > 0) {
                // Get the name of the place
                var name = results[0].name;
            }
        pop
            .setLatLng(e.latlng)
            .setContent("The current location of " +rentalLocations.estate+ " is " + e.latlng.toString()+ " the place is called "+name)
            .openOn(map);
        });
    }

    function showMessage(message) {
        var errorContainer = document.getElementById('message-container');
        errorContainer.innerHTML = '<div class="text-center">' +
                                        '<span class="bg-yellow-400 text-white p-2 rounded-md">' + message + '</span>' +
                                        '</div>';
    }
</script>