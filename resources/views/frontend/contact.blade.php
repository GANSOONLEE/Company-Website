@extends('frontend.layouts.app')

@push('after-style')
    <link href="{{asset('css\frontend\contact.css')}}" rel="stylesheet">
@endpush

@section('title',__('Contact'))



@section('content')

    <div class="contact-list">

        <div class="contact">
            <div class="avatar">
                <img src="{{asset('image/2.jpg')}}" alt="" class="avatar-image">
            </div>
            <div class="information">
                <p class="name">Ah Ting</p>
                <p class="description">Project Testing Assistant</p>
                <p class="phone-number">
                    <i class="fa-solid fa-phone"></i>
                    012-345 6789
                </p>
            </div>
        </div>

        <div class="contact">
            <div class="avatar">
                <img src="{{asset('image/2.jpg')}}" alt="" class="avatar-image">
            </div>
            <div class="information">
                <p class="name">Jing Wen</p>
                <p class="description">Hai-Di-Lao Steamboat CEO</p>
                <p class="phone-number">
                    <i class="fa-solid fa-phone"></i>
                    018-178 1488
                </p>
            </div>
        </div>

        <div class="contact">
            <div class="avatar">
                <img src="{{asset('image/2.jpg')}}" alt="" class="avatar-image">
            </div>
            <div class="information">
                <p class="name">Unknow Person</p>
                <p class="description">Just An Air</p>
                <p class="phone-number">
                    <i class="fa-solid fa-phone"></i>
                    He hasn't phone number
                </p>
            </div>
        </div>

    </div>

@endsection

@push('after-script')
    <script src="{{asset('js/frontend/index.js')}}"></script>
@endpush