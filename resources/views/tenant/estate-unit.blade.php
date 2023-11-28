@include('layouts.header')
<title>Estate | YoRentos</title>
@include('layouts.menu')

<section class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h6 class="btn uppercase">
                    <b>
                        {{__('Nalika Heights')}}
                    </b>
                </h6>
                <div class="img-box">
                    <img src="{{asset('frontend/images/about-img.jpg')}}" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="slider-container">
                        <div class="slider">
                            <div class="small">
                                <img src="{{asset('frontend/images/d-1.jpg')}}" alt="">
                            </div>
                            <div class="small">
                                <img src="{{asset('frontend/images/d-1.jpg')}}" alt="">
                            </div>
                            <div class="small">
                                <img src="{{asset('frontend/images/d-1.jpg')}}" alt="">
                            </div>
                            <div class="small">
                                <img src="{{asset('frontend/images/d-1.jpg')}}" alt="">
                            </div>
                            <div class="small">
                                <img src="{{asset('frontend/images/d-1.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="heading_container">
                        <h2>
                            About Our Apartment
                        </h2>
                    </div>
                    <p>
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
                        in
                        some form, by injected humour, or randomised words
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

