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
                'label' => trans('sidebar.home')
            ],
            // #TODO admin dashboard
            [
                'url' => route('backend.admin.dashboard'), 
                'icon' => 'fa-solid fa-chart-line',
                'label' => trans('sidebar.dashboard')
            ],
            [
                'section' => trans('sidebar.product'),
                'icon' => 'fa-solid fa-box',
                'link' => [
                    [
                        'url' => route('backend.admin.newProduct'),
                        'label' => trans('sidebar.newProduct')
                    ],
                    [
                        'url' => route('backend.admin.editProduct'),
                        'label' => trans('sidebar.editProduct')
                    ],
                ]
            ],
            [                
                'section' => trans('sidebar.order'),
                'icon' => 'fa-regular fa-file-lines',
                'link' => [
                    [
                        'url' => route('backend.admin.viewOrder'),
                        'label' => trans('sidebar.viewOrder'),
                        'notification' => 'notification',
                    ],
                    [
                        'url' => route('backend.admin.pendingOrder'),
                        'label' => trans('sidebar.pendingOrder')
                    ],
                ]
            ],
            [
                'url' => route('backend.admin.managerAccount'),
                'icon' => 'fa-solid fa-user',
                'label' => trans('sidebar.account')
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
                    @if(isset($link['section']))
                        <div class="section">
                            <div class="section-title">
                                <i class="link-icon {{$link['icon']}}"></i>
                                <p class="section-label">{{$link['section']}}</p>
                            </div>
                            <div class="section-links">
                                @foreach($link['link'] as $secondary_link)
                                    <a href="{{$secondary_link['url']}}" class="sidebar-link">
                                        <p class="link-label">
                                            {{$secondary_link['label']}}
                                        </p>
                                        @if(isset($secondary_link['notification']) && $orderNew !== 0)
                                            <div class="notification-order">
                                                <p id="order-new">
                                                    {{ $orderNew }}
                                                </p>
                                            </div>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{$link['url']}}" class="sidebar-link">
                            <i class="link-icon {{$link['icon']}}"></i>
                            <p class="link-label">
                                {{$link['label']}}
                            </p>
                        </a>
                    @endif
                @endforeach
                <div class="sidebar-link">
                    <i class="link-icon fa-solid fa-language"></i>
                    <a href="{{ route('locale.change', ['lang' => 'en']) }}">
                        <p class="link-label">ENG</p>
                    </a>
                    &nbsp;/&nbsp;
                    <a href="{{ route('locale.change', ['lang' => 'zh']) }}">
                        <p class="link-label">中文</p>
                    </a>
                </div>
            </ul>       
        </div>
        <div class="sidebar-footer">
            <p class="clock"></p>
        </div>
    </div>
</body>
<script src="{{asset('js\ui\sidebar.js')}}"></script>
</html>