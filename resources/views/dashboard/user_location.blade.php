<script>
    function showError(message) {
        var errorContainer = document.getElementById('error-container');
        errorContainer.innerHTML = '<div class="text-center">' +
                                        '<span class="bg-yellow-400 text-white p-2 rounded-md">' + message + '</span>' +
                                        '</div>';
    }
    //global coordinates for the user's current position
    var lat = null;
    var lng = null;
    navigator.geolocation.getCurrentPosition(function(position) {
        // Get latitude and longitude values from position object
        lat = position.coords.latitude;
        lng = position.coords.longitude;
        // console.log(lat)
        // console.log(lng)
        
        var isAuthenticated = @json(auth()->check()); // is user authenticated?
        if (isAuthenticated) {
            var userId = @json(auth()->id());
            // console.log("User is authenticated. User ID:", userId);
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Update the user location
            $.ajax({
                url: "{{ route('update.user_location') }}",
                type: "POST",
                data: {
                    user_id: userId,
                    user_latitude: lat,
                    user_longitude: lng,
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        } else {
            console.log("User is not authenticated.");
        }

    }, function(error) {
        // Handle any errors that occur while getting the position
        var errorMessage = "We are UNABLE to get your location: Please REFRESH and kindly allow location for a PERFECT EXPERIENCE";
        showError(errorMessage);
    });
</script>