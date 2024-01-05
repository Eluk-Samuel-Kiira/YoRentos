@include('layouts.header')
<title>Welcome | YoRentos</title>
@include('layouts.navigation')
        <!-- Introduction section -->
        <h6>
            <div id="error-container"></div>
        </h6>
        <section class="slider_section ">
            <div class="container-fluid">
                <div class="col-md-4 offset-md-1">
                    <div class="detail-box">
                        <h1>
                            <span> Uganda's</span> <br>
                            <div>
                                Apartments &<br>
                                Rental Houses
                            </div>
                        </h1>
                        <p>
                            <b>"Our mission is to facilitate connections between tenants and landlords in Uganda, fostering a seamless and 
                                secure rental experience. We aim to bridge the gap between those seeking rental accommodations and property owners,
                                ensuring satisfaction and trust among all parties."
                            <b>
                        </p>
                        <div class="btn-box">
                            <a href="{{route('register')}}" class="">
                                Get Stared
                            </a>
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
            <div class="container-header">
                <h2 class="rental_heading">
                    {{__('Top Quality Houses Available In The Country')}}
                </h2>
            </div>
            <div class="sale_container">
                @php 
                    $imageCount = 0;
                @endphp
                @forelse($newly_estates as $estate)
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
                                <a href="{{ route('unit.detail', $estate) }}">{{ $estate->estate }} </a>                           
                                <span class="btn btn-small">
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
                                <span class="btn btn-small">
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
                                <span class="btn btn-small">
                                    <img src="{{asset('frontend/images/location.png')}}" width="10px" style="display: inline-block; vertical-align: middle; margin-right: 5px;" alt="">
                                    {{ $estate->villageEstate->village }}
                                </span>
                                <span class="btn btn-small">
                                    {{ $estate->unit_no }}{{__(' Reviews')}}
                                </span>
                            </p>
                        </div>
                    </div>
                @empty
                    <p>
                        {{__('There are no Sponsored Estates')}}
                    </p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- end newly sponsored houses section -->

    <!-- within area -->
    <section>
        <div class="slider-container">
            <div class="container-header">
                <h2 class="rental_heading">
                    {{__('Rentals Available In The District/State of')}}                
                    <input id="districtName" type="text" disabled>
                </h2>
            </div>
            <div class="slider scroll-container">
                <div class="scroll-content">
                    <div class="slided item">
                        <!-- contents come here -->
                    </div>
                    <div>
                        {{__('Your District is Not Supported Yet or kindly  ')}}
                        <div>
                            <a href="/" class="btn-small">Refresh</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- within area -->

    <!--  sponsored houses section -->
    <section class="sale_section layout_padding">
        <div class="container-fluid">
            <div class="container-header">
                <h2 class="rental_heading">
                    {{__('Other Quality Houses')}}
                </h2>
            </div>
            <div class="sale_container">
                @forelse($early_estates as $estate)
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
                                <a href="{{ route('unit.detail', $estate) }}">{{ $estate->estate }} </a>                           
                                <span class="btn btn-small">
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
                                <span class="btn btn-small">
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
                                <span class="btn btn-small">
                                    <img src="{{asset('frontend/images/location.png')}}" width="10px" style="display: inline-block; vertical-align: middle; margin-right: 5px;" alt="">
                                    {{ $estate->villageEstate->village }}
                                </span>
                                <span class="btn btn-small">
                                    {{ $estate->unit_no }}{{__(' Reviews')}}
                                </span>
                            </p>
                        </div>
                    </div>
                @empty
                    <p>
                        {{__('There are no Sponsored Estates')}}
                    </p>
                @endforelse
            </div>
            <div class="btn-box">
                <a href="{{ route('register') }}">
                Find More
                </a>
            </div>
        </div>
    </section>
    <!-- end  sponsored houses section -->

    <section class="contact_section layout_padding-top">
            <div class="container-header">
                <h2 class="rental_heading">
                    {{__('Get In Touch')}}
                </h2>
            </div>
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 px-0">
                <div class="contact_container">
                <div>
                    {{__('Become Part Of Our Family By Joining Our WhatsApp Group')}}
                    <span class="btn-warning">
                        <a href="https://chat.whatsapp.com/Ck1LLhZeBb1B9SDNid3jWn">Here</a>
                    </span>
                </div>
                    <p>Call: 0776263482</p>
                    <p>WhatsApp: 0754428612</p>
                    <p>Email: yorentos23@gmail.com</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 ">
                <div class="form_container">
                    <div>
                        {{__('Give us a Feedback or A question')}}
                    </div>
                    <form method="POST" action="{{ route('store.feedback') }}">
                        @csrf
                        <div>
                            <input type="text" class="form-control" name="contact" placeholder="Name and Contact" required/>
                        </div>
                        <div>
                            <textarea class="form-control" name="message" placeholder="Message" required></textarea>
                        </div>
                        <input type="submit" class="btn btn-warning" />
                    </form>
                </div>
            </div>

        </div>
        </div>
    </section>
@include('layouts.footer')
@include('dashboard.user_location')