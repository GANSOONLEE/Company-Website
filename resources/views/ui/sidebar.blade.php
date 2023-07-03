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

    <div class="sidebar">
        <div class="sidebar-header">
            <p class="company">Frozen Air Cond</p>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-links">
                @php
                    $links = [
                        ['url' => '/admin/dashboard', 'label' => trans('sidebar.dashboard')],
                        ['url' => route('frontend.index'), 'label' => trans('sidebar.index')],
                        [
                            'section' => trans('sidebar.product'),
                            'link' => [
                                ['url' => route('backend.admin.newProduct'), 'label' => trans('sidebar.newProduct')],
                                ['url' => '/admin/EditProduct', 'label' => trans('sidebar.editProduct')],
                            ]
                        ],
                        [
                            'section' => trans('sidebar.order'),
                            'link' => [
                                ['url' => '/admin/NewOrder', 'label' => trans('sidebar.viewOrder'), 'notification' => true],
                                ['url' => '/admin/EditOrder', 'label' => trans('sidebar.editOrder'), 'notification' => true],
                            ]
                        ],
                        [
                            'section' => trans('sidebar.user'),
                            'link' => [
                                ['url' => '/admin/UserManagement', 'label' => trans('sidebar.userManagement')],
                            ]
                        ],
                        
                    ];
                @endphp

                @foreach ($links as $link)
                @if (isset($link['section']))
                    <div class="section">
                        <p class="title">{{ $link['section'] }}</p>
                        <ul class="links">
                            @foreach ($link['link'] as $sublink)
                                <a href="{{ $sublink['url'] }}" class="sidebar-link {{ request()->is(ltrim($sublink['url'], '/')) ? 'active' : '' }}">
                                    <li>{{ $sublink['label'] }}</li>
                                    @if ($sublink['notification'] ?? false)
                                        <div class="notification"></div>
                                    @endif
                                </a>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <a href="{{ $link['url'] }}" class="sidebar-link {{ request()->is(ltrim($link['url'], '/')) ? 'active' : '' }}">
                        <li>{{ $link['label'] }}</li>
                        @if ($link['notification'] ?? false)
                            <div class="notification"></div>
                        @endif
                    </a>
                @endif
                @endforeach



            </ul>            
        </div>
        <div class="sidebar-footer">
            <a href="{{ route('locale.change', ['lang' => 'en']) }}">English</a>
            <a href="{{ route('locale.change', ['lang' => 'zh']) }}">中文</a>
        </div>
        
        <p class="user">{{ $user = session('user')->Name }}</p>
    </div>
</body>
<script src="{{asset('js\ui\sidebar.js')}}"></script>
</html>