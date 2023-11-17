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
<script>
  $(document).ready(function() {
    const carousel = $('.carousel');
    const slides = $('.slide');
    let slideIndex = 0;

    function showSlide() {
      carousel.css('transform', `translateX(-${slideIndex * 100}%)`);
    }

    $('.next').click(function() {
      slideIndex = (slideIndex + 1) % slides.length;
      showSlide();
    });

    $('.prev').click(function() {
      slideIndex = (slideIndex - 1 + slides.length) % slides.length;
      showSlide();
    });
  });
</script>

  @livewireScripts
</body>

</html>