@extends('frontend.layouts.app')

@push('after-style')
    <link href="{{asset('css\frontend\contact.css')}}" rel="stylesheet">
@endpush

@section('title',__('Contact'))



@section('content')

    {{-- Social Media --}}
    <div class="contact-us">
        <div class="contact-us-header">
            Social Media
        </div>
        <div class="contact-us-body">
            {{-- Tiktok --}}
            <div class="social-media">
                <p class="social-media-name">Tiktok</p>
                <div class="social-media-content">
                    <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@samtan_aircondkereta" data-unique-id="samtan_aircondkereta" data-embed-type="creator" style="max-width: 24vw; min-width: 128px;" > <section> <a target="_blank" href="https://www.tiktok.com/@samtan_aircondkereta?refer=creator_embed">@samtan_aircondkereta</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
                </div>
            </div>

            {{-- Youtube --}}
            <div class="social-media">
                <p class="social-media-name">Youtube</p>
                <div class="social-media-content">
                    <iframe src="https://www.youtube.com/embed/eYuR9KtS9lo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>

            {{-- Facebook --}}
            <div class="social-media">
                <p class="social-media-name">Facebook</p>
                <div class="social-media-content">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FFrozen.AirCond&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-script')
    <script src="{{asset('js/frontend/index.js')}}"></script>
@endpush