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
                        ['url' => route('frontend.index'), 'label' => trans('sidebar.index')],
                        ['url' => route('backend.admin.dashboard'), 'label' => trans('sidebar.dashboard')],
                        [
                            'section' => trans('sidebar.product'),
                            'link' => [
                                ['url' => route('backend.admin.newProduct'), 'label' => trans('sidebar.newProduct')],
                                ['url' => route('backend.admin.editProduct'), 'label' => trans('sidebar.editProduct')],
                            ]
                        ],
                        [
                            'section' => trans('sidebar.order'),
                            'link' => [
                                ['url' => route('backend.admin.viewOrder'), 'label' => trans('sidebar.viewOrder'), 'notification' => true],
                                ['url' => route('backend.admin.editOrder'), 'label' => trans('sidebar.editOrder'), 'notification' => true],
                            ]
                        ],
                        [
                            'section' => trans('sidebar.user'),
                            'link' => [
                                ['url' => route('backend.admin.editUser'), 'label' => trans('sidebar.userManagement')],
                            ]
                        ],
                        
                    ];
                @endphp

                @foreach ($links as $link)
                @if (isset($link['section']))
                    <div class="section">
                        <input type="checkbox" name="" id="{{ $link['section'] }}">
                        <label  class="titleLabel" for="{{ $link['section'] }}">
                            <div class="title">
                                <p>{{ $link['section'] }}</p>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </label>
                        <ul class="links">
                            @foreach ($link['link'] as $sublink)
                            <a href="{{ $sublink['url'] }}" class="sidebar-link {{ request()->url() == url($sublink['url']) ? 'active' : '' }}">
                                    <li>{{ $sublink['label'] }}</li>
                                    @if ($sublink['notification'] ?? false)
                                        <div class="notification"></div>
                                    @endif
                                </a>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <a href="{{ $link['url'] }}" class="sidebar-link {{ request()->url() == $link['url'] ? 'active' : '' }}">
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
    </div>
</body>
<script src="{{asset('js\ui\sidebar.js')}}"></script>
</html>