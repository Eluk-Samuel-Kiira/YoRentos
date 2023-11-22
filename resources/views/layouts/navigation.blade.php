</head>
<body class="font-sans antialiased">
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="/">
                        <img src="{{asset('frontend/images/logo.png')}}" alt="" style="height: 60px; width: 160px;"/>
                    </a>
                    <div class="navbar-collapse" id="">
                        <div class="custom_menu-btn">
                            <button onclick="toggleNav()">
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
                                <a href="index.html">Home</a>
                                <a href="about.html">About</a>
                                <a href="house.html">House</a>
                                <a href="price.html">Price</a>
                                <a href="contact.html">Contact Us</a>
                                <a href="{{route('login')}}">Login</a>
                                <a href="{{route('register')}}">Register</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    