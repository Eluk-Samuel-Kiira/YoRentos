@include('layouts.header')
<title>Welcome | YoRentos</title>
@include('layouts.navigation')
        <!-- Introduction section -->
        <section class="slider_section ">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-4 offset-md-1">
                    <div class="detail-box">
                    <h1>
                        <span> Uganda's</span> <br>
                        Apartments &<br>
                        Rental Houses
                    </h1>
                    <p>
                        <b>"Our mission is to facilitate connections between tenants and landlords in Uganda, fostering a seamless and 
                            secure rental experience. We aim to bridge the gap between those seeking rental accommodations and property owners,
                            ensuring satisfaction and trust among all parties."
                        <b>
                    </p>
                    <div class="btn-box">
                        <a href="{{route('register')}}" class="">
                            Start Searching
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
        <!-- end Introduction section -->
    </div>

    <!-- newly sponsored houses section -->
    <section class="sale_section layout_padding">
        <div class="container-fluid">
            <div class="heading_container">
                <h2>
                    {{__('Top Houses Available')}}
                </h2>
                <p>
                    {{__('There are many houses that are just classified and ranked first')}}
                </p>
            </div>
            <div class="sale_container">
                @php $imageCount = 0; @endphp
                @forelse($estates as $estate)
                    <div class="box">
                        <div class="img-box">
                            <div class="carousel">
                                @if($estate->images)
                                    @foreach(explode(',', $estate->images) as $imageName)
                                        <div class="slide">
                                            <img src="{{ asset('storage/estate_images/' . $estate->landlord_id . '/' . $imageName) }}" alt="" >
                                        </div>
                                    @endforeach
                                @else
                                    <div><img src="{{asset('frontend/images/s-2.jpg')}}" alt=""></div>
                                @endif
                            </div>
                            <button class="prev" onclick="prevSlide({{ $imageCount }})"><span class="arrow">&#9664;</span> </button>
                            <button class="next" onclick="nextSlide({{ $imageCount }})"> <span class="arrow">&#9654;</span></button>
                            @php $imageCount++ @endphp
                        </div>
                        <div class="detail-box">
                            <h6>
                                <a href="{{ route('unit.detail') }}">{{ $estate->estate }} </a>                           
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
                            </h6>
                            <p>
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
                @empty
                @endforelse
            </div>
            <div class="btn-box">
                <a href="{{ route('register') }}">
                Find More
                </a>
            </div>
        </div>
    </section>
    <!-- end newly sponsored houses section -->

    <!-- within area -->
    <div class="center-container">
        <div class="rentals-container">
            <h6>
                {{__('Rentals Available In Your Area (Sub-County/Division)')}}
            </h6>
        </div>
    </div>
    <div class="slider-container">
        <div class="slider">
            @forelse($estates as $estate)
                <div class="slided">
                    @php
                        $firstImage = 0;
                    @endphp
                    @if($estate->images)
                        @foreach(explode(',', $estate->images) as $imageName)
                            <div class="slide">
                                <img src="{{ asset('storage/estate_images/' . $estate->landlord_id . '/' . $imageName) }}" alt="">
                            </div>
                            @php
                                $firstImage++;
                                if ($firstImage >= 1) {
                                    break; // Stops the loop 
                                }
                            @endphp
                        @endforeach
                    @else
                        <div><img src="{{asset('frontend/images/s-2.jpg')}}" alt=""></div>
                    @endif
                    <div class="detail-box">
                        <h6>
                            <a href="{{ route('unit.detail') }}">{{ $estate->estate }} </a>     
                        </h6>
                    </div>
                    <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                        <span style="display: inline-block; vertical-align: middle;">
                            {{ $estate->villageEstate->village }}
                        </span>
                    </span>
                </div>
            @empty
                <div class="detail-box">
                    <h6>
                        {{__('No Estates Available')}}
                    </h6>
                </div>
            @endforelse
            <div>
                <p class="btn btn-primary">
                    <a href="{{ route('register') }}" style="text-align: center;">
                        Find More
                    </a>
                </p>
            </div>
        </div>
    </div>
    <!-- within area -->
@include('layouts.footer')
