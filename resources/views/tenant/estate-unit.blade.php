@include('layouts.header')
<title>Estate | YoRentos</title>
@include('layouts.menu')

<section class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="btn uppercase font-size">
                    <b>
                        {{__('Nalika Heights')}}
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
                            <div class="small">  
                                <img src="{{asset('frontend/images/d-1.jpg')}}" alt="" onclick="displayImage(this)">
                            </div>
                            <div class="small">
                                <img src="{{asset('frontend/images/s-1.jpg')}}" alt="" onclick="displayImage(this)">
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


<section class="find_section ">
    <div class="container">
        <div class="description">
            <div class="form-row">
                <p>                        
                    <span class="btn btn-small" style="background-color: yellow; color: &#9654;">
                        {{__('Ugx:')}} 150k - 305k
                    </span>
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
    </div>
</section>

<section class="price_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container">
            <h2>
                Our Units
            </h2>
            <p>
                There are many variations of our rooms
            </p>
        </div>
        <div class="price_container">
            <div class="box">
                <div class="detail-box">
                <div class="heading-box">
                <h4>
                    01
                </h4>
                <h6>
                    Basic
                </h6>
                </div>
                <div class="text-box">
                <h2>
                    $1000.00
                </h2>
                <ul>
                    <li>
                    variations of
                    </li>
                    <li>
                    passages of Lorem
                    </li>
                    <li>
                    Ipsum available,
                    </li>
                    <li>
                    but the majority
                    </li>
                    <li>
                    have suffered
                    </li>
                    <li>
                    alteration in
                    </li>
                </ul>
                </div>
                </div>
                <div class="btn-box">
                <a href="">
                Buy Now
                </a>
                </div>
            </div>
            <div class="box">
                <div class="detail-box">
                    <div class="heading-box">
                    <h4>
                        02
                    </h4>
                    <h6>
                        Standard
                    </h6>
                    </div>
                    <div class="text-box">
                    <h2>
                        $2000.00
                    </h2>
                    <ul>
                        <li>
                        variations of
                        </li>
                        <li>
                        passages of Lorem
                        </li>
                        <li>
                        Ipsum available,
                        </li>
                        <li>
                        but the majority
                        </li>
                        <li>
                        have suffered
                        </li>
                        <li>
                        alteration in
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="btn-box">
                    <a href="">
                    Buy Now
                    </a>
                </div>
            </div>
            <div class="box">
                <div class="detail-box">
                    <div class="heading-box">
                    <h4>
                        03
                    </h4>
                    <h6>
                        Premium
                    </h6>
                    </div>
                    <div class="text-box">
                    <h2>
                        $3000.00
                    </h2>
                    <ul>
                        <li>
                        variations of
                        </li>
                        <li>
                        passages of Lorem
                        </li>
                        <li>
                        Ipsum available,
                        </li>
                        <li>
                        but the majority
                        </li>
                        <li>
                        have suffered
                        </li>
                        <li>
                        alteration in
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="btn-box">
                    <a href="">
                        Make Payments
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

<script>
    function displayImage(element) {
        var clickedImageSrc = element.src;
        var displayedImage = document.getElementById('displayedImage');
        displayedImage.src = clickedImageSrc;
    }
</script>