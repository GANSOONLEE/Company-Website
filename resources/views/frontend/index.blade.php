    @extends('frontend.layouts.app')

    @push('after-style')
        <link href="{{asset('css\frontend\index.css')}}" rel="stylesheet">
    @endpush

    @section('title',__('Home'))

   
    
    @section('content')

        @include('ui.carousel')
        
        {{-- <div class="content">
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
        </div> --}}

        <div class="section">
            <div class="section-title">
                <p>Our Mission</p>
            </div>
            <div class="card-container">

                <div class="card">
                    <div class="card-header">
                        <embed src="{{asset('images/idea.svg')}}" type="image/svg+xml" />
                    </div>
                    <div class="card-body">
                        Innovative Pondering<br>
                        Tradition-Sundering
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <embed src="{{asset('images/gear.svg')}}" type="image/svg+xml" />
                    </div>
                    <div class="card-body">
                        High Quanlity<br>
                        Best Durability
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <embed src="{{asset('images/service.svg')}}" type="image/svg+xml" />
                    </div>
                    <div class="card-body">  
                        Expert Guidance<br>
                        Remarkable Assistance
                    </div>
                </div>

            </div>
        </div>
    
    @endsection

    @push('after-script')
        <script src="{{asset('js/frontend/index.js')}}"></script>
    @endpush