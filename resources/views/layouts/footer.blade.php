  <!-- footer section -->
  <section class="container-fluid footer_section ">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved<br>
        <a href="/" class="btn">
          <img src="{{asset('frontend/images/dev.png')}}" alt="dev" style="height: 40px; width: 100px;"/>
        </a>
      </p>
    </div>
  </section>
  <!-- end  footer section -->

  <script type="text/javascript" src="{{asset('frontend/js/jquery-3.4.1.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/js/bootstrap.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/js/custom.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  

  @livewireScripts
  <!-- leaflet.js    -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
      integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
      crossorigin=""></script>
  <!-- leaflet draw Plugin -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
  <!-- Snake animation plugin -->
  <script src="{{asset('frontend/js/L.Polyline.SnakeAnim.js')}}"></script>
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


</body>

</html>