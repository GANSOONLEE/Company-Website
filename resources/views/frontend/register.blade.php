
@extends('frontend.layouts.app')

@section('title', __('Products'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\register.css')}}">
    
@endpush

@push('before-body')
    
@endpush

@section('content')

    <form action="{{route('frontend.register.post')}}" method="POST" class="form">
        @csrf
        <div class="part" data-index='1' data-visible='true'>
            <div class="section-form">
                <label for="name"><span class="requird">Name:</label>
                <input type="text" id="name" name="name" placeholder="Name" class="requird" required>
            </div>

            <div class="section-form">
                <label for="phone"><span class="requird">Phone:</label>
                <input type="text" id="phone" name="phone" placeholder="Phone (012-34567890)" class="requird" maxlength="13" required>
            </div>
            <div class="section-form">
                <label for="email"><span class="requird">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email" class="requird" required>
            </div>
            <div class="button-area">
                <button type="button" data-button-identify="next">Next</button>
            </div>
        </div>

        <div class="part" data-index='2' data-visible='false'>
            <div class="section-form">
                <label for="birthday"><span class="requird">Birthday:</span></label>
                <input type="date" id="birthday"name="birthday" placeholder="Birthday" required>
            </div>
            <div class="section-form">
                <label for="address"><span class="requird">Address:</label>
                {{-- <input type="text" id="address" name="address" placeholder="Address" required> --}}
                <textarea id="address" name="address" required cols="50" rows="5" placeholder="Your full address"></textarea>
            </div>
            <div class="section-form">
                <label for="occupation"><span class="requird">Profession:</label>
                <input type="text" id="occupation"name="occupation" placeholder="Profession" required>
            </div>
            <div class="section-form">
                <label for="store_name"><span class="requird">Store Name:</label>
                <input type="text" id="store_name"name="store_name" placeholder="Store Name" required>
            </div>
            <div class="section-form">
                <label for="password"><span class="requird">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="button-area">
                <button type="button" data-button-identify="previous">Previous</button>
                <button type="submit" data-button-identify="submit">Register</button>
            </div>
        </div>

    </form>

@endsection

@push('after-script')
    <script src="js\frontend\register.js"></script>
@endpush