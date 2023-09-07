
@extends('frontend.layouts.app')

@section('title', __('Register'))

@push('after-style')
    <link rel="stylesheet" href="{{asset('css\frontend\register.css')}}">
    
@endpush

@push('before-body')
    
@endpush

@section('content')

    <div class="form">

        <!-- 照片展示區 -->
        <div class="image-display">
            <img class="form-image" src="{{asset('image/frozen air cond.png')}}" alt="">
        </div>

        <div class="form-body">
            <p class="back-to-home-page"></p>
            <a href="{{route('frontend.index')}}"><img class="logo" src="{{asset('image/logo.png')}}" alt=""></a>
            <form action="{{route('frontend.register.post')}}" method="POST" id="msform">
                <ul id="progressbar">
                    <li class="active" id="account"><strong>Personal</strong></li>
                    <li id="personal"><strong>Shop</strong></li>
                </ul>
                @csrf
                <fieldset id="first">
                    {{-- <div class="display-row"> --}}
                        <div class="section-form mb-3">
                            <label class="form-label" for="name"><span class="required">Name:</label>
                            <input type="text" id="name" name="username" placeholder="Name" class="requird form-control" required>
                        </div>
                        <div class="section-form mb-3 display-row">
                            <div class="mb-3">
                                <label class="form-label" for="phone"><span class="required">Phone (Handphone):</label>
                                <input type="text" id="phone" name="phone_number" placeholder="012 34567890" class="requird form-control" maxlength="13" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone"><span class="required">Phone (Whatapps):</label>
                                <input type="text" id="phone" name="phone_number_whatapps" placeholder="012 34567890" class="requird form-control" maxlength="13" required>
                            </div>
                        </div>
                    {{-- </div> --}}
                    
                    {{-- <div class="display-row"> --}}
                        <div class="section-form mb-3">
                            <label class="form-label" for="email"><span class="required">Email:</label>
                            <input type="email" id="email" name="email_address" placeholder="Email" class="requird form-control" required>
                        </div>
                        <div class="section-form mb-3">
                            <label class="form-label" for="password"><span class="required">Password:</label>
                            <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" class="form-control" required>
                        </div>
                        <div class="section-form mb-3">
                            <label class="form-label" for="password_confirm"><span class="required">Password Confirm:</label>
                            <input type="password" id="password_confirm" name="password_confirm" placeholder="Password " autocomplete="off" class="form-control" required>
                        </div>
                        <div class="button-area display-column">
                            <button type="button" data-button-identify="next" class="action-button next disabled" disabled>Next</button>
                            <p>
                                Already have account?
                                <a href="{{ route('frontend.login') }}">Click here</a>
                            </p>
                        </div>
                    {{-- </div> --}}
                </fieldset>
                <fieldset id="secondary">
                    <div class="section-form mb-3" id="datepicker">
                        <label class="form-label" for="birthday"><span class="required">Birthday:</span></label>
                        <input type="date" id="birthday" name="birthday" placeholder="Birthday" class="form-control"required>
                    </div>
                    <div class="section-form mb-3">
                        <label class="form-label" for="address"><span class="required">Address:</label>
                        <textarea id="address" name="address" class="form-control" required cols="50" rows="3" placeholder="Your full address"></textarea>
                    </div>
                    {{-- <div class="display-row"> --}}
                        <div class="section-form mb-3">
                            <label class="form-label" for="occupation"><span class="required">Profession:</label>
                            <select name="profession" id="occupation" class="form-select">
                                <option value="Personal">Personal</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Supplier">Supplier</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="section-form mb-3">
                            <label class="form-label" for="store_name"><span class="required">Store Name:</label>
                            <input type="text" id="store_name"name="company_name" placeholder="Store Name" class="form-control" required>
                        </div>
                    {{-- </div> --}}
                    <div class="button-area display-column">
                        <div class="display-row">
                            <button type="button" data-button-identify="previous" class="previous action-button-previous">Previous</button>
                            <button type="submit" data-button-identify="submit" class="register disabled" disabled>Register</button>
                        </div>
                        <p>
                             
                            <a href="{{ route('frontend.login') }}"></a>
                        </p>
                    </div>
                <fieldset>
            </form>
        </div>
    </div>

@endsection

@push('after-script')
    <script src="js\frontend\register.js"></script>
@endpush