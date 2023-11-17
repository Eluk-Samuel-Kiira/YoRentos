</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="/">
                <img src="{{asset('frontend/images/logo.png')}}" alt="logo" style="height: 60px; width: 160px;"/>
            </a>
          <div class="navbar-collapse" id="">

            <div class="custom_menu-btn">
              <button onclick="openNav()">
                <span class="s-1">

                </span>
                <span class="s-2">

                </span>
                <span class="s-3">

                </span>
              </button>
            </div>
            <div id="myNav" class="overlay">
              <div class="overlay-content">
                @foreach($rental as $item)
                  <a href="{{$item->id}}">{{ $item->name }}</a>
                @endforeach
                <a href="contact.html">{{__('Contact Us')}}</a>
                <!-- Authentication -->
                  <form method="POST" action="{{ route('logout') }}" x-data>
                      @csrf
                      <a href="{{ route('logout') }}"
                                @click.prevent="$root.submit();">
                          {{ __('Log Out') }}
                      </a>
                  </form>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>