<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="{{asset('css\app.css')}}" rel="stylesheet">
    <link href="{{asset('css\ui\sidebar.css')}}" rel="stylesheet">
</head>
<body>

    @php
        $links = [
            [
                'url' => route('frontend.index'),
                'icon' => 'fa-solid fa-house',
                'label' => 'Home'
            ],
            [
                'url' => route('backend.user.dashboard'), 
                'icon' => 'fa-solid fa-chart-line',
                'label' => 'Dashboard'
            ],
            [
                'url' => route('backend.user.favorite'), 
                'icon' => 'fa-solid fa-bookmark',
                'label' => 'Favorite'
            ],
            [
                'url' => route('backend.user.cart'), 
                'icon' => 'fa-solid fa-cart-shopping',
                'label' => 'Cart'
            ],
            [                
                'url' => route('backend.user.order'),
                'icon' => 'fa-solid fa-box',
                'label' => 'Order'
            ],
            [
                'url' => route('backend.user.account'),
                'icon' => 'fa-solid fa-user',
                'label' => 'Account'
            ],
        ];
    @endphp

    <div class="sidebar">
        <div class="sidebar-header">
            <a href={{ route('frontend.index') }}><img src={{asset('image\logo.png')}} alt="" class="logo"></a>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-links">
                @foreach ($links as $link)
                        <a href="{{$link['url']}}" class="sidebar-link">
                            <i class="link-icon {{$link['icon']}}"></i>
                            <p class="link-label">
                                {{$link['label']}}
                            </p>
                        </a>
                @endforeach
            </ul>            
        </div>
    </div>
</body>
<script src="{{asset('js\ui\sidebar.js')}}"></script>
</html>