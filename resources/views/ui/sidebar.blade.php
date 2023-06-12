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
            <img src="{{asset('image\logo.png')}}" alt="" class="logo">
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-links">
                <a href="#" class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <li>{{ trans('sidebar.dashboard') }}</li>
                </a>
                <a href="#" class="sidebar-link {{ request()->is('admin/product') ? 'active' : '' }}">
                    <li>{{ trans('sidebar.product') }}</li>
                </a>
            </ul>            
        </div>
        <div class="sidebar-footer">
            <a href="{{ url()->current() }}?language=en">English</a>
            <a href="{{ url()->current() }}?language=zh">中文</a>
        </div>
    </div>
</body>
<script src="{{asset('js\ui\sidebar.js')}}"></script>
</html>