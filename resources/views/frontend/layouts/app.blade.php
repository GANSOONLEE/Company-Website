<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Bootstrap 5 -->
    <link href={{asset('image/logo.png')}} type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css\app.css')}}">
    @stack('after-style')

    <!-- Scroll reveal -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Font-aweson -->
    <script src="https://kit.fontawesome.com/4fffedbe3d.js" crossorigin="anonymous"></script>

    <!-- 引入 jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- 引入其他 AJAX 库的 CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

    

</head>
<body>
    @include('ui.navbar')

    @stack('before-body')

    <div class="main">
        @yield('content')
    </div>

    @include('ui.footer')
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @stack('after-script')

    <link rel="stylesheet" href="{{asset('css/festival/festival.css')}}">
</body>
</html>