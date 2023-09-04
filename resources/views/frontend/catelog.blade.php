@extends('frontend.layouts.app')

@section('title', __('Catelog'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\catelog.css')}}">
@endpush



@section('content')
    @foreach($categories as $index => $category)

    <a href="catelog/{{$category->categoryName}}">
        <div class="card">
            <img src='{{ asset("image/Sample/" . str_replace(' ', '-', strtolower($category->categoryName)) . ".png") }}' class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$category->categoryName}}</h5>
            </div>
        </div>
    </a>
    @endforeach


@endsection

@push('after-script')
    
@endpush