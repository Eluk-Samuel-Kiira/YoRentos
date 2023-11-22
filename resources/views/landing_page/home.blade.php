@include('layouts.header')
<title>Welcome | YoRentos</title>
@include('layouts.navigation')
        <!-- slider section -->
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
        <!-- end slider section -->
    </div>
@include('layouts.footer')