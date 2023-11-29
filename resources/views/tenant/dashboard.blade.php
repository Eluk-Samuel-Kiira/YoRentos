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
                                {{__('Houses Available For Renting Near You!')}}
                            </h2>
                        </div>
                        <p>
                            {{__('There are many units available under the various categories Eg Appartments, Offices, Ware Houses etc...')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- newest sponsored -->
    <div class="slider-container">
        <div class="slider">
            <div class="slided">
                <img src="{{asset('frontend/images/d-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/d-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/d-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <div class="slided">
                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="">
                <div class="detail-box">
                    <h6>
                        {{__('Name')}}
                    </h6>
                </div>
                <span class="btn btn-primary btn-small" style="display: inline-block; white-space: nowrap;">
                    <span style="display: inline-block; vertical-align: middle;">Kiwanga</span>
                </span>
            </div>
            <!-- Add more images as needed -->
        </div>
            <button class="previous" onclick="moveSlide(-1)"><</button>
            <button class="nexts" onclick="moveSlide(1)">></button>
        </div>
    </div>
    <!-- end newest sponsored -->

    <!-- old sponsored section -->
    <section class="sale_section layout_padding">
        <div class="container-fluid">
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