    @extends('frontend.layouts.app')

    @push('after-style')
        <link href="{{asset('css\frontend\index.css')}}" rel="stylesheet">
    @endpush

    @section('title',__('Home'))

   
    
    @section('content')

        @include('ui.carousel')

        <div class="section">
            <div class="section-title">
                <p>Our Company</p>
            </div>
            <div class="organize-container">
                <div class="organize-hexagon">
                    <img src="{{asset('image/1.jpg')}}" alt="">
                </div>
                <div class="organize-hexagon">
                    <img src="{{asset('image/2.jpg')}}" alt="">
                </div>
                <div class="organize-hexagon">
                    <img src="{{asset('image/3.jpg')}}" alt="">
                </div>
                <div class="organize-hexagon">
                    <img src="{{asset('image/4.png')}}" alt="">
                </div>
                <div class="organize-hexagon">
                    <img src="{{asset('image/5.jpg')}}" alt="">
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">
                <p>Our Mission</p>
            </div>
            <div class="card-container">

                <div class="card mission-card">
                    <div class="card-header">
                        <embed src="{{asset('images/idea.svg')}}" type="image/svg+xml" />
                    </div>
                    <div class="card-body">
                        Innovative Pondering<br>
                        Tradition-Sundering
                    </div>
                </div>

                <div class="card mission-card center">
                    <div class="card-header">
                        <embed src="{{asset('images/gear.svg')}}" type="image/svg+xml" />
                    </div>
                    <div class="card-body">
                        High Quanlity<br>
                        Best Durability
                    </div>
                </div>

                <div class="card mission-card">
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