<script>
    function showError(message) {
        var errorContainer = document.getElementById('error-container');
        errorContainer.innerHTML = '<div class="text-center">' +
                                        '<span class="bg-yellow-400 text-white p-2 rounded-md">' + message + '</span>' +
                                        '</div>';
    }

    function getGeoPosition(estate) {
        var lat = null;
        var lng = null;
        navigator.geolocation.getCurrentPosition(function(position) {
            // Get latitude and longitude values from position object
            lat = position.coords.latitude;
            lng = position.coords.longitude;
            // console.log(lat)
            // console.log(lng)
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Update the user location
            $.ajax({
                url: "{{ route('estate.location') }}",
                type: "POST",
                data: {
                    estate_uid: estate.uid,
                    estate_landlord: estate.landlord_id,
                    estate_latitude: lat,
                    estate_longitude: lng,
                },
                success: function(response) {
                    console.log(response);
                    var errorMessage = "Estate location Captured Successfully";
                    showError(errorMessage);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });

        }, function(error) {
            // Handle any errors that occur while getting the position
            var errorMessage = "We are UNABLE to get your location: Kindly turn on location for us to capture the Estate location";
            showError(errorMessage);
        });
        console.log("Getting estate's current position...");
    }
</script>