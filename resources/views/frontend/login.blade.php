
@extends('frontend.layouts.app')

@section('title', __('Products'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\register.css')}}">
    
@endpush

@push('before-body')
    
@endpush

@section('content')
@section('content')

    <div class="form">

        <div class="form-body">
            <p class="back-to-home-page"></p>
            <a href="{{route('frontend.index')}}"><img class="logo" src="{{asset('image/logo.png')}}" alt=""></a>
            <form action="{{route('frontend.login.post')}}" method="POST" class="form">
                @csrf
                    <div class="section-form mb-3">
                        <label class="form-label required" for="email"><span class="requird">Email Address:</label>
                        <input class="form-control" type="email" id="email" name="email_address" placeholder="Email" required>
                    </div>
                    <div class="section-form mb-3">
                        <label class="form-label required" for="password"><span class="requird">Password:</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="button-area display-column">
                        <button type="submit" data-button-identify="submit">Login</button>
                        <p>
                            Haven't account?
                            <a href="{{ route('frontend.register') }}">Click here</a>
                        </p>
                </div>
            </form>
        </div>

        <!-- 照片展示區 -->
        <div class="image-display">
            <img class="form-image" src="{{asset('image/frozen air cond.png')}}" alt="">
        </div>
        
    <div>

@endsection

@push('after-script')
    <script src="js\frontend\register.js"></script>
@endpush