@extends('frontend.layouts.app')

@section('title', __('Catelog'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\catelog.css')}}">
@endpush



@section('content')
    @php
        $images = [
            'image/Sample/1.png',
            'image/Sample/2.png',
            'image/Sample/3.png',
            'image/Sample/4.png',
            'image/Sample/5.png',
            'image/Sample/6.png',
            'image/Sample/7.png',
            'image/Sample/8.png',
            'image/Sample/9.png',
            'image/Sample/10.png',
            'image/Sample/11.png',
            'image/Sample/12.png',
            'image/Sample/13.png',
            'image/Sample/14.png',
        ];
    @endphp

    @foreach($catelogs as $index => $catelog)
    @php
        $imageIndex = $index % count($images);
        $imagePath = $images[$imageIndex];
    @endphp

    <a href="catelog/{{$catelog->catelogName}}">
        <div class="card">
            <img src="{{ asset($imagePath) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$catelog->catelogName}}</h5>
            </div>
        </div>
    </a>
    @endforeach


@endsection

@push('after-script')
    
@endpush