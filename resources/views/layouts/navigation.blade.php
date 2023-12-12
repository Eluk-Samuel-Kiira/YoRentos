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
                    <h4>  
                        <x-validation-errors class="mb-4" />  
                        @if(session('error'))
                            <span class="bg-red-500 text-white rounded">
                                {{ session('error') }}
                            </span>
                        @endif
                        @if(session('success'))
                            <span class="bg-green-500 text-white rounded">
                                {{ session('success') }}
                            </span>
                        @endif
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
                                <a href="index.html">Home</a>
                                <a href="about.html">About</a>
                                <a href="{{route('login')}}">Login</a>
                                <a href="{{route('register')}}">Register</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    