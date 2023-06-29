
<head>
    <link href="{{asset('css\ui\navbar.css')}}" rel="stylesheet">
</head>
<body>
    @section('navbar')
        <div class="navbar">
            <a href="/" class="logo-container"><img src="{{asset('image\logo.png')}}" alt="" class="logo"></a>
            <input type="checkbox" id="menubtn" class="btn">
            <div class="menu">
                <ul class="navbar-links" class="menubtn">
                    <li class="navbar-link {{ request()->is('/')? 'active' : ''}}"><a href="{{route('frontend.index')}}">HOME</a></li>
                    <li class="navbar-link {{ request()->is('about')? 'active' : ''}}"><a href="{{route('frontend.about')}}">ABOUT US</a></li>
                    <li class="navbar-link {{ request()->is('type')? 'active' : ''}}"><a href="{{route('frontend.type')}}">PRODUCT</a></li>
                    <li class="navbar-link {{ request()->is('contact')? 'active' : ''}}"><a href="{{route('frontend.contact')}}">CONTACT</a></li>
                    {{-- @if() --}}
                    <li class="navbar-link {{ request()->is('register')? 'active' : ''}}"><a href="{{route('frontend.register')}}">REGISTER</a></li>
                    <li class="navbar-link {{ request()->is('login')? 'active' : ''}}"><a href="{{route('frontend.login')}}">LOGIN</a></li>
                </ul>
            </div>
            <label for="menubtn" class="menubtn"><img src="{{asset('image\menu.png')}}" alt="" class="icon"></label>
        </div>
    @show
</body>