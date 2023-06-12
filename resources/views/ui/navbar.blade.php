
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
                    <li class="navbar-link"><a href="{{route('index')}}">HOME</a></li>
                    <li class="navbar-link"><a href="{{route('about')}}">ABOUT US</a></li>
                    <li class="navbar-link"><a href="{{route('catelog')}}">PRODUCT</a></li>
                    <li class="navbar-link"><a href="{{route('contact')}}">CONTACT</a></li>
                </ul>
            </div>
            <label for="menubtn" class="menubtn"><img src="{{asset('image\menu.png')}}" alt="" class="icon"></label>
        </div>
    @show
</body>