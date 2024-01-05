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
<!-- footer section -->
  <section class="container-fluid footer_section ">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved<br>
        <a href="https://stardena.com/" class="btn">
          <img src="{{asset('frontend/images/dev.png')}}" alt="developer" style="height: 40px; width: 100px;"/>
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