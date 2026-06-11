@extends('frontend.layouts.app')

@section('content')
<div class="login__section section--padding">
    <div class="container">
        <form role="form" action="{{ route('otp.send') }}" method="POST">
            @csrf
            <div class="login__section--inner">
                <div class="row row-cols-md-2 row-cols-1">
                    <div class="col mx-auto">
                        <div class="account__login">
                            <div class="account__login--header mb-25">
                                <h2 class="account__login--header__title mb-15">
                                    {{ translate('Login with OTP') }}
                                </h2>
                                <p class="account__login--header__desc">
                                    {{ translate('Enter your mobile number') }}
                                </p>
                            </div>

                            <div class="account__login--inner">

                                <label>
                                    <input 
                                        class="account__login--input @error('mobile') is-invalid @enderror"
                                        placeholder="Enter Mobile Number"
                                        name="mobile"
                                        type="text"
                                        required>
                                </label>

                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <button class="account__login--btn primary__btn mb-3" type="submit">
                                    {{ translate('Send OTP') }}
                                </button>

                                <p class="account__login--signup__text">
                                    {{ translate('Dont have an Account?') }}
                                    <a href="{{ route('user.registration') }}">
                                        {{ translate('Register Now') }}
                                    </a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
