@include('layouts.header')
<title>Estate | YoRentos</title>
@include('layouts.menu')

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
                            <div class="heading_container">
                                <h2>
                                    About Our {{ $estate->rentalName->name }}
                                </h2>
                            </div>
                            <h6>
                                {{ $estate->description }}
                            </h6>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="find_section ">
        <div class="container">
            <div class="description">
                <div class="form-row">
                    <div class="img-box">
                        @if($estate->video)
                            <div class="heading_container">
                                <h2>
                                    Take A Tour Around Our Apartment
                                </h2>
                            </div>
                            <video controls style="width: 100%; height: 240px;">
                                <source src="{{ asset('storage/estate_videos')}}/{{$estate->video }}" type="video/mp4" id="displayedImage">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                    <p>                        
                        <span class="btn btn-small" style="background-color: yellow; color: &#9654;">
                            @php
                                $minPrice = $estate->unitEstate->min('price');
                                $maxPrice = $estate->unitEstate->max('price');
                            @endphp
                            @if ($minPrice !== null && $maxPrice !== null)
                                {{ $minPrice }} - {{ $maxPrice }}
                            @else
                                N/A
                            @endif
                        </span>
                        <span class="btn btn-primary btn-small"> 
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
                        <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                            <img src="{{asset('frontend/images/location.png')}}" width="10px" style="display: inline-block; vertical-align: middle; margin-right: 5px;" alt="">
                            <span style="display: inline-block; vertical-align: middle;">
                                {{ $estate->villageEstate->village }}
                            </span>
                        </span>
                        <span class="btn btn-small" style="background-color: yellow; color: &#9654;">
                            {{ $estate->unit_no }}{{__(' Reviews')}}
                        </span>
                    </p>
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
                                                {{ $unit->durationName->duration }}
                                            </li>
                                            <li>
                                                {{ $unit->rentalName->name }}
                                            </li>
                                            <li>
                                                {{ $unit->square_footage }}
                                            </li>
                                            <span>
                                                <li>
                                                    {{ $unit->description }}
                                                </li>
                                                <li>
                                                    {{ $unit->resources }}
                                                </li>
                                                <li>
                                                    {{__('Unoccupied')}}
                                                </li>
                                            </span>
                                        </ul>
                                    </div>
                                </div>
                                <div class="btn-box">
                                    <a href="">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endif

@include('layouts.footer')

<script>
    function displayImage(element) {
        var clickedImageSrc = element.src;
        var displayedImage = document.getElementById('displayedImage');
        displayedImage.src = clickedImageSrc;
    }
</script>