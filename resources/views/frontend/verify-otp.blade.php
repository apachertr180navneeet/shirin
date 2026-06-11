@extends('frontend.layouts.app')

@section('content')
<div class="login__section section--padding">
    <div class="container">
        <form role="form" action="{{ route('otp.verify') }}" method="POST">
            @csrf
            <div class="login__section--inner">
                <div class="row row-cols-md-2 row-cols-1">
                    <div class="col mx-auto">
                        <div class="account__login">
                            <div class="account__login--header mb-25">
                                <h2 class="account__login--header__title mb-15">
                                    {{ translate('OTP Verification') }}
                                </h2>
                                <p class="account__login--header__desc">
                                    {{ translate('Enter your OTP') }}
                                </p>
                            </div>

                            <div class="account__login--inner">

                                <label>
                                    <input type="text" class="account__login--input" name="otp" placeholder="Enter OTP" required>
                                </label>

                                <button class="account__login--btn primary__btn mb-3" type="submit">
                                    {{ translate('Verify OTP') }}
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
