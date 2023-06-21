@extends('frontend.layouts.app')

@push('after-style')
    <link href="{{asset('css\frontend\contact.css')}}" rel="stylesheet">
@endpush

@section('title',__('Contact'))



@section('content')

<div class="contact-row">
    <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@alatganti_aircond_ahseng" data-unique-id="alatganti_aircond_ahseng" data-embed-type="creator" style="max-width: 780px; min-width: 288px;" > <section> <a target="_blank" href="https://www.tiktok.com/@alatganti_aircond_ahseng?refer=creator_embed">@alatganti_aircond_ahseng</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
    <div class="text-section">
        <div class="title">TikTok</div>
        <div class="description">測試</div>
    </div>
</div>

<div class="contact-row">
    <div class="text-section">
        <div class="title"></div>
        <div class="description"></div>
    </div>
    <iframe width="768" height="432" src="https://www.youtube.com/embed/eYuR9KtS9lo" title="Masalah Air Cond Kenderaan dan Cara Penyelesaian." frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
@endsection

@push('after-script')
    <script src="{{asset('js/frontend/index.js')}}"></script>
@endpush