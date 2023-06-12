    @extends('frontend.layouts.app')

    @push('after-style')
        <link href="{{asset('css\frontend\index.css')}}" rel="stylesheet">
    @endpush

    @section('title',__('Home'))
    
    @section('content')
    
        {{-- <div class="header carousel slide">
            <img src="{{asset('image/promotion-1.png')}}" alt="" class="carousel-inner">
        </div> --}}

        @include('ui.carousel')
        


        
        <div class="content">
            <div class="container">
                <div class="text">
                    <p class="title">Alat Ganti Ah Seng Overview</p>
                    <div class="description">
                        <p class="overview">Alat Ganti Ah Seng founded by Ah Seng in 2021.</p>
                        <p class="overview">Ah Seng has more that 20 years of experience in this field.</p>
                        <p class="overview">We specialized in supplying car air-conditioning spare parts.</p>
                        <p class="overview">We are committed to improve the customer’s service experience.</p>
                    </div>

                </div>
                <div class="image">
                    <img src="{{asset('image\frozen air cond.png')}}" alt="">
                </div>
            </div>
        </div>
    
    @endsection

    @push('after-script')
        <script src="{{asset('js/frontend/index.js')}}"></script>
    @endpush