</head>
<body class="font-sans antialiased">
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="/">
                        <img src="{{asset('frontend/images/logo.png')}}" alt=""/>
                    </a>
                    <h4>  
                        <x-validation-errors class="mb-4" /> 
                        <div id="notification" class="fixed top-0 right-0 mb-4 mr-4 p-4 bg-gray-800 text-white rounded shadow-md opacity-0 transition-opacity duration-500 hidden">
                            <!-- <x-validation-errors class="mb-4" />   -->
                            <span id="notificationMessage"></span>
                        </div>
                    </h4>
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
                                <a href="/">Home</a>
                                <a href="about.html">About</a>
                                <a href="{{route('login')}}">Login</a>
                                <a href="{{route('register')}}">Register</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    