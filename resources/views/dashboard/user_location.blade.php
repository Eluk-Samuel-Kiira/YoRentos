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
    let attempts = 0;

    function getGeoLocation() {
        if (attempts < 3) {
            navigator.geolocation.getCurrentPosition(function(position) {
                // Get latitude and longitude values from position object
                lat = position.coords.latitude;
                lng = position.coords.longitude;

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
                    console.log("You Not is not authenticated...");

                    // Making a GET request to Nominatim API to get the district name
                    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                        .then(response => response.json())
                        .then(data => {
                            // Extracting district name from the API response
                            var district = data.address.state; 
                            document.getElementById('districtName').value = district;
                            if (district !== null)
                            {
                                $.ajaxSetup({
                                    headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    url: "{{ route('user.district') }}",
                                    type: "POST",
                                    data: {
                                        district: district,
                                    },
                                    success: function(response) {
                                        var estatesInDistrict = response.data;
                                        // console.log(estatesInDistrict);
                                        if (estatesInDistrict.length > 0) {
                                            var htmlContent = '';

                                            estatesInDistrict.forEach(function(estate) {
                                                var imagesHTML = ''; // To store images HTML

                                                if (estate.images) {
                                                    var estateImages = estate.images.split(','); // Split image names
                                                    imagesHTML += `<div class="slide">
                                                                        <img src="/storage/estate_images/${estate.landlord_id}/${estateImages[0]}" alt="">
                                                                    </div>`;
                                                } else {
                                                    imagesHTML += `<div><img src="/frontend/images/s-2.jpg" alt=""></div>`;
                                                }

                                                htmlContent += `
                                                    <div class="slided">
                                                        ${imagesHTML}
                                                        <h6>
                                                            <a href="${estate.slug}">${estate.estate}</a>
                                                        </h6>
                                                        <span class="btn btn-small" style="display: inline-block; white-space: nowrap;">
                                                            <span style="display: inline-block; vertical-align: middle;">
                                                                ${estate.village_estate.village}
                                                            </span>
                                                        </span>
                                                    </div>
                                                `;
                                            });

                                            $('.slider').html(htmlContent); // Update the HTML content of the slider with the generated HTML
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.log(error);
                                    }
                                });

                            } else {
                                var errorMessage = "You Location May Not Be Supported Now...";
                                showError(errorMessage);
                            }
                        })
                        .catch(error => {
                            console.error("Error fetching district:", error);
                        });

                }

            }, function(error) {
                // Handle any errors that occur while getting the position
                var errorMessage = "Please refresh and enable location for an optimal experience.";
                showError(errorMessage);
            });
            attempts++;
            setTimeout(getGeoLocation, 4000);
        }
    }
    getGeoLocation();
</script>