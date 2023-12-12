@include('layouts.header')
<title>Dashboard | YoRentos</title>
@include('layouts.menu')
    
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
                                <a href="{{ route('unit.detail', $estate) }}">{{ $estate->estate }} </a>                           
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
                            <a href="{{ route('unit.detail', $estate) }}">{{ $estate->estate }} </a>     
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
@include('dashboard.user_location')

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