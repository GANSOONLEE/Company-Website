@extends('frontend.layouts.app')

@section('title', __('Catelog'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\catelog.css')}}">
@endpush



@section('content')
    @php
        $images = [
            'image/Sample/blower-motor.png',
            'image/Sample/cabin-air-filters.png',
            'image/Sample/compressor.png',
            'image/Sample/condenser.png',
            'image/Sample/cooling-coil.png',
            'image/Sample/discharge-hose.png',
            'image/Sample/expansion-valve.png',
            'image/Sample/fan-control.png',
            'image/Sample/fan-motor.png',
            'image/Sample/liquid-tube.png',
            'image/Sample/pressure-switch.png',
            'image/Sample/receiver-drier.png',
            'image/Sample/resistor.png',
            'image/Sample/suction-hose.png',
        ];
    @endphp

    @foreach($categories as $index => $category)
    @php
        $imageIndex = $index % count($images);
        $imagePath = $images[$imageIndex];
    @endphp

    <a href="catelog/{{$category->categoryName}}">
        <div class="card">
            <img src="{{ asset($imagePath) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$category->categoryName}}</h5>
            </div>
        </div>
    </a>
    @endforeach


@endsection

@push('after-script')
    
@endpush