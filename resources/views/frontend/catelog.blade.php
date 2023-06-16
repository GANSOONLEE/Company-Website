@extends('frontend.layouts.app')

@section('title', __('Catelog'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\catelog.css')}}">
@endpush



@section('content')
    {{-- @include('ui.searchbar') --}}
    @foreach( $catelogs as $catelog)
        <a href="catelog/{{ $catelog->catelogName}}">
            <div class="card">
                <img src="{{asset('image\Sample\3.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$catelog->catelogName}}</h5>
                </div>
            </div>
        </a>
    @endforeach


@endsection

@push('after-script')
    
@endpush