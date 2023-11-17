@include('layouts.header')
<title>Dashboard | YoRentos</title>
@include('layouts.menu')

    <!-- sale section -->
    <section class="sale_section layout_padding">
        <div class="container-fluid">
            <div class="heading_container">
                <h2>
                    {{__('Houses Available For Renting Near You!')}}
                </h2>
                <p>
                    {{__('There are many units available under the various categories Eg Appartments, Offices, Ware Houses etc...')}}
                </p>
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
                            Nalika Heights                            
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
                                {{__('/4 months')}}
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
    <!-- end sale section -->

@include('layouts.footer')