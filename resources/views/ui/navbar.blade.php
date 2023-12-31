
<head>
    <link href="{{asset('css\ui\navbar.css')}}" rel="stylesheet">
</head>
<body>
    @section('navbar')
        <div class="navbar">
            <a href="/" class="logo-container"><img src="{{asset('images\logo without text.svg')}}" alt="" class="logo"></a>
            <input type="checkbox" id="menubtn" class="btn">
            <div class="menu">
                <ul class="navbar-links center">
                    <li class="navbar-link {{ request()->is('/')? 'active' : ''}}"><a href="{{route('frontend.index')}}">HOME</a></li>
                    {{-- <li class="navbar-link {{ request()->is('about')? 'active' : ''}}"><a href="{{route('frontend.about')}}">ABOUT US</a></li> --}}
                    <li class="navbar-link {{ request()->is('product')? 'active' : ''}}"><a href="{{route('frontend.product')}}">PRODUCT</a></li>
                    <li class="navbar-link {{ request()->is('contact')? 'active' : ''}}"><a href="{{route('frontend.contact')}}">CONTACT</a></li>
                </ul>
                <ul class="navbar-links bottom">
                    @guest
                        <li class="navbar-link register {{ request()->is('register')? 'active' : ''}}"><a href="{{route('frontend.register')}}">REGISTER</a></li>
                        <li class="navbar-link login {{ request()->is('login')? 'active' : ''}}"><a href="{{route('frontend.login')}}">LOGIN</a></li>
                    @else
                        @if (auth()->user()->isAdmin())
                            <li class="navbar-link dashboard"><a href="{{ route('backend.admin.newProduct') }}" class="user-link">
                           DASHBOARD</a></li>
                        @else
                            @if(auth()->user()->is_approve_user(auth()->user()->email_address))
                            <li class="navbar-link dashboard"><a href="{{ route('backend.user.cart') }}" class="user-link">DASHBOARD</a></li>
                            @endif
                        @endif
                            <li class="navbar-link"><a href="{{ route('frontend.logout') }}" class="user-link">LOGOUT</a></li>
                    @endguest
                </ul>
            </div>
            <label for="menubtn" class="menubtn"><img src="{{asset('image\menu.png')}}" alt="" class="icon"></label>
        </div>
    @show
    <script src={{ asset('js\ui\navbar.js') }}></script>
</body>