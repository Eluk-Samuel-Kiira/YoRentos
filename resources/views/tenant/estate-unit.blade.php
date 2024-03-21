@include('layouts.header')
<title>Estate | YoRentos</title>
@include('layouts.menu')
<h4>  
    <x-validation-errors class="mb-4" />  
    <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 transition-opacity duration-500 hidden">
        <!-- <x-validation-errors class="mb-4" />   -->
        <span id="notificationMessage"></span>
    </div>
</h4>
@if($estate)
    <section class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="btn uppercase font-size">
                        <b>
                            {{ $estate->estate}}
                        </b>
                    </h3>
                    <div class="img-box">
                        <img src="{{asset('frontend/images/about-img.jpg')}}" alt="" id="displayedImage">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="slider-container">
                            <div class="slider">
                                @php 
                                    $imageName = null;
                                @endphp
                                @if($estate->images)
                                    @foreach(explode(',', $estate->images) as $imageName)
                                        <div class="small">  
                                            <img src="{{ asset('storage/estate_images/' . $estate->landlord_id . '/' . $imageName) }}" alt="" onclick="displayImage(this)">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="small">  
                                        <img src="{{asset('frontend/images/s-2.jpg')}}" alt="" onclick="displayImage(this)">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <p>
                            <div class="container-header">
                                <h2 class="rental_heading">
                                    About Our {{ $estate->rentalName->name }}
                                </h2>
                            </div>
                            <h6 style="font-family: Arial, sans-serif;">
                                {{ $estate->description }}
                            </h6>
                            <div class="btn-box">
                                <a href="{{ route('rental.map', $estate) }}">
                                    Navigate To Us
                                </a>
                                @include('layouts.header', ['ogTitle' => $estate->estate, 'ogUrl' => request()->fullUrl(), 'ogDescription' => $estate->description, 
                                    'ogImage' => asset('storage/estate_images/' . $estate->landlord_id . '/' . $imageName)])
                                
                                <h6>
                                    <a href="//" id="copyLinkBtn" onclick="copyURL('{{ request()->fullUrl() }}')">
                                        <span class="btn btn-small">
                                            Copy Link And Share
                                        </span>
                                    </a>
                                </h6>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    @if($estate->video)
                        <div class="container-header">
                            <h2 class="rental_heading">
                                About Our {{ $estate->rentalName->name }}
                            </h2>
                        </div>
                        <video controls style="width: 100%; height: 240px;">
                            <source src="{{ asset('storage/estate_videos')}}/{{$estate->video }}" type="video/mp4" id="displayedImage">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>
                <div class="col-md-8"><br>
                    <div class="container-header">
                        <h2 class="rental_heading">
                            Other Important Details
                        </h2>
                    </div>
                    <div class="about-details custom-styling">
                        <h6><br>
                            <span class="btn btn-small price-range">
                                @php
                                    $minPrice = $estate->unitEstate->min('price');
                                    $maxPrice = $estate->unitEstate->max('price');
                                @endphp
                                {{__('Price Range: ')}}
                                @if ($minPrice !== null && $maxPrice !== null)
                                    {{ $minPrice }} - {{ $maxPrice }}
                                @else
                                    N/A
                                @endif
                            </span>
                            <span class="btn btn-small available-units">
                                @php
                                    $availableUnits = $estate->unitEstate->where('status', 0)->count();
                                    $allUnits = $estate->unitEstate->count();
                                @endphp
                                {{__('Units Available: ')}}
                                @if ($availableUnits !== 0) 
                                    {{ $availableUnits }}/{{ $allUnits }}
                                @else
                                    {{__('NONE')}}
                                @endif
                            </span>
                            <span class="btn btn-small village">
                                {{__('Village:  ')}}
                                <img src="{{asset('frontend/images/location.png')}}" width="10px" style="display: inline-block; vertical-align: middle; margin-right: 5px;" alt="">
                                {{ $estate->villageEstate->village }}
                            </span>
                            <span class="btn btn-small reviews">
                                {{ $estate->unit_no }}{{__(' Reviews')}}
                            </span>
                            <span class="btn btn-small">
                                @foreach($users as $user)
                                    @if ($estate->landlord_id == $user->id)
                                        {{__('Officials: ')}}{{ $user->name }} <br>
                                        {{__('Telephone: ')}}{{ $user->phone_number }}
                                    @endif
                                @endforeach
                            </span>
                            @foreach($users as $user)
                                @if ($estate->broker_id == $user->id) 
                                    <div style="height: 160px; width: 160px;">
                                        <img src="{{ $user->profile_photo_url }}" alt="">
                                    </div>
                                @endif
                            @endforeach

                            <span class="btn btn-small">
                                @foreach($users as $user)
                                    @if ($estate->broker_id == $user->id)
                                        {{__('Trusted Broker: ')}}{{ $user->name }} <br>
                                        {{__('Telephone: ')}}{{ $user->phone_number }}
                                    @endif
                                @endforeach
                            </span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="price_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Our Units
                </h2>
                <p>
                    There are many variations of our rooms, below are the ones <b>AVAILABLE or UNOCCUPIED.</b>
                </p>
            </div>
            <div class="price_container">
                @php
                    $totalRooms = count($estate->unitEstate);
                    $occupiedRooms = $estate->unitEstate->where('status', 1)->count();
                    $availableRooms = $totalRooms - $occupiedRooms;
                @endphp

                @if ($availableRooms == 0)
                    <div class="btn-box">
                        {{ __('No Room/Unit Available') }}
                    </div>
                @elseif ($totalRooms == 0)
                    <div class="btn-box">
                        {{ __('No Unit Registered As Yet') }}
                    </div>
                @else
                    @foreach ($estate->unitEstate as $unit)
                        @if($unit->status == 0)
                            <div class="box">
                                <div class="detail-box">
                                    <div class="heading-box">
                                        <h6>
                                            {{ $unit->unit }}
                                        </h6>
                                    </div>
                                    <div class="text-box">
                                        <h2>
                                            {{ $unit->price }}
                                        </h2>
                                        <ul>
                                            <li>
                                                {{ $unit->rentalName->name }}
                                            </li>
                                            <li>
                                                {{ $unit->durationName->duration }}
                                            </li>
                                            <li>
                                                {{ $unit->square_footage }}
                                            </li>
                                            <span>
                                                <li>
                                                    {{ $unit->description }}
                                                </li>
                                                <li>
                                                    @php
                                                        $resourcesArray = json_decode($unit->resources);
                                                    @endphp
                                                    {{ is_array($resourcesArray) ? implode(', ', $resourcesArray) : $unit->resources }}
                                                </li>
                                                <li>
                                                    {{__('Unoccupied')}}
                                                </li>
                                            </span>
                                        </ul>
                                    </div>
                                </div>
                                <!-- <div class="btn-box">
                                    <a href="">
                                        Book Now
                                    </a>
                                </div> -->
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endif

@include('layouts.footer')
@include('dashboard.status')

<script>
    function displayImage(element) {
        var clickedImageSrc = element.src;
        var displayedImage = document.getElementById('displayedImage');
        displayedImage.src = clickedImageSrc;
    }

    function copyURL(url) {
        // Create a temporary input element to hold the URL
        var tempInput = document.createElement('input');
        tempInput.value = url;
        document.body.appendChild(tempInput);

        // Select the URL in the input element
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile devices

        // Copy the selected URL to clipboard
        document.execCommand('copy');

        // Remove the temporary input element
        document.body.removeChild(tempInput);

        // Change the link text to "Link Copied"
        var linkBtn = document.getElementById('copyLinkBtn');
        linkBtn.innerHTML = '<span class="btn btn-small">Link Copied</span>';

        // Optionally, provide feedback to the user (e.g., alert or tooltip)
        // alert('URL copied to clipboard: ' + url);
    }
</script>
