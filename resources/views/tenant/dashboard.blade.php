@include('layouts.header')
<title>Dashboard | YoRentos</title>
@include('layouts.menu')
    <section class="deal_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                {{__('Let\'s Search Your Dream Rental Now!')}}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- find section -->
    <livewire:search-component />
    <!-- end find section -->

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

    <!-- old sponsored section -->
    <section class="sale_section layout_padding">
        <div class="container-fluid">
            <div class="heading_container">
                <h2>
                    {{__('Best Homes In Your District')}}
                </h2>
            </div>
            <div class="sale_container">
                <div class="box">
                    <div class="img-box">
                        <div class="carousel">
                            <div class="slide"><img src="{{asset('frontend/images/s-1.jpg')}}" alt=""></div>
                            <div class="slide"><img src="{{asset('frontend/images/s-2.jpg')}}" alt=""></div>
                            <div class="slide"><img src="{{asset('frontend/images/s-3.jpg')}}" alt=""></div>
                        </div>
                        <button class="prev"><span class="arrow">&#9664;</span> </button>
                        <button class="next"> <span class="arrow">&#9654;</span></button>
                    </div>
                    <div class="detail-box">
                        <h6>
                            <a href="{{ route('unit.detail') }}">Nalika Heights </a>                           
                            <span class="btn btn-small" style="background-color: yellow; color: &#9654;">
                                {{__('Ugx:')}} 150k - 305k
                            </span>
                        </h6>
                        <p>
                            <span class="btn btn-primary btn-small">{{__('Units Available:')}} 12/25</span>
                            <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                                <img src="{{asset('frontend/images/location.png')}}" width="10px" style="display: inline-block; vertical-align: middle; margin-right: 5px;" alt="">
                                <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                            </span>
                            <span class="btn btn-small" style="background-color: yellow; color: &#9654;">
                                {{__('per month')}}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="{{asset('frontend/images/s-2.jpg')}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h6>
                        apertments house
                        </h6>
                        <p>
                        There are many variations of passages of Lorem Ipsum available, but
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="{{asset('frontend/images/s-3.jpg')}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h6>
                        apertments house
                        </h6>
                        <p>
                        There are many variations of passages of Lorem Ipsum available, but
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="{{asset('frontend/images/s-4.jpg')}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h6>
                        apertments house
                        </h6>
                        <p>
                        There are many variations of passages of Lorem Ipsum available, but
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="{{asset('frontend/images/s-5.jpg')}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h6>
                        apertments house
                        </h6>
                        <p>
                        There are many variations of passages of Lorem Ipsum available, but
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="{{asset('frontend/images/s-6.jpg')}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h6>
                        apertments house
                        </h6>
                        <p>
                        There are many variations of passages of Lorem Ipsum available, but
                        </p>
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <a href="">
                Find More
                </a>
            </div>
        </div>
    </section>
    <!-- end old sponsored section -->

@include('layouts.footer')

<script>
    let slideIndex = 0;
    const slides = document.querySelectorAll('.slided');

    function moveSlide(n) {
    slideIndex += n;
    if (slideIndex < 0) {
        slideIndex = slides.length - 1;
    } else if (slideIndex >= slides.length) {
        slideIndex = 0;
    }
    updateSliderPosition();
    }

    function updateSliderPosition() {
    const slideWidth = slides[0].offsetWidth;
    const offset = -slideIndex * slideWidth;
    document.querySelector('.slider').style.transform = `translateX(${offset}px)`;
    }

    // Update slider position initially
    updateSliderPosition();
</script>