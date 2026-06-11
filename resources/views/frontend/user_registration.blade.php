@extends('frontend.layouts.app')

@section('content')
    <!-- Start register section  -->
        <div class="login__section section--padding">
            <div class="container">
                <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="login__section--inner">
                        <div class="row row-cols-md-2 row-cols-1">
                            <div class="col mx-auto">
                                <div class="account__login">
                                    <div class="account__login--header mb-25">
                                        <h2 class="account__login--header__title mb-15">{{ translate('Create an account')}}</h2>
                                        <p class="account__login--header__desc">{{ translate('Register here if you are a new customer')}}</p>
                                    </div>
                                    <div class="account__login--inner">
                                        <!-- Name -->
                                        <label>
                                            <input type="text" class="account__login--input {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Full Name') }}" name="name">
                                        </label>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                        <!-- Email or Phone -->
                                        @if (addon_is_activated('otp_system') && env("DEMO_MODE") != "On")
                                            <label>
                                                <input type="tel" id="phone-code" class="account__login--input {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="{{  translate('Phone No.') }}" name="phone" autocomplete="off">
                                            </label>
                                            <input type="hidden" name="country_code" value="">
                                            <label>
                                                <input class="account__login--input{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email address') }}" name="email" id="email" autocomplete="off">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </label>
                                            <div class="account__login--input text-right">
                                                <button class="btn btn-link p-0 text-primary" type="button" onclick="toggleEmailPhone(this)"><i>*{{ translate('Use Email Instead') }}</i></button>
                                            </div>
                                        @else 
                                            <label>
                                                <div class="form-group phone-form-group mb-1">
                                                    <label for="phone" class="fs-12 fw-700 text-soft-dark">{{  translate('Phone') }}</label>
                                                    <input type="tel" id="phone-code" class="account__login--input{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                                                </div>

                                                <input type="hidden" name="country_code" value="">
                                            </label>
                                            <label>
                                                <input class="account__login--input{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email address') }}" name="email" id="email" autocomplete="off">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </label>
                                        @endif
                                        <label>
                                            <input class="account__login--input " placeholder="{{ translate('Password')}}" name="password" id="password" type="password">
                                            <div class="text-right mt-0">
                                                <span class="fs-12 fw-400 text-gray-dark">{{ translate('Password must contain at least 6 digits') }}</span>
                                            </div>
                                        </label>
                                        <label>
                                            <input class="account__login--input " placeholder="{{  translate('Confirm Password') }}" name="password_confirmation" type="password">
                                        </label>
                                        <!-- Recaptcha -->
                                        @if(get_setting('google_recaptcha') == 1)
                                            <div class="account__login--input">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                            </div>
                                        @endif
                                        <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                            <!-- Remember me  -->
                                            <div class="account__login--remember position__relative">
                                                <input class="checkout__checkbox--input" id="check1" type="checkbox" name="checkbox_example_1">
                                                <span class="checkout__checkbox--checkmark aiz-square-check mt-lg-3 mt-md-2"></span>
                                                <label class="checkout__checkbox--label login__remember--label" for="check1">
                                                    {{ translate('By signing up you agree to our ')}} <a href="{{ route('terms') }}" class="account__login--forgot">{{ translate('terms and conditions.') }}</a></label>
                                            </div>
                                            
                                        </div>
                                        <button class="account__login--btn primary__btn mb-3" type="submit">{{  translate('Create Account') }}</button>

                                        <!-- Social Login -->
                                        @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                                            <div class="account__login--divide">
                                                <span class="account__login--divide__text">{{ translate('Or Login With')}}</span>
                                            </div>
                                            <div class="account__social d-flex justify-content-center mb-15">
                                                @if (get_setting('facebook_login') == 1)
                                                    <a class="account__social--link facebook" target="_blank" href="{{ route('social.login', ['provider' => 'facebook']) }}">Facebook</a>
                                                @endif
                                                @if(get_setting('google_login') == 1)
                                                    <a class="account__social--link google" target="_blank" href="{{ route('social.login', ['provider' => 'google']) }}">Google</a>
                                                @endif
                                                @if(get_setting('google_login') == 1)
                                                    <a class="account__social--link twitter" target="_blank" href="{{ route('social.login', ['provider' => 'twitter']) }}">Twitter</a>
                                                @endif
                                                @if(get_setting('google_login') == 1)
                                                    <a class="account__social--link apple" target="_blank" href="{{ route('social.login', ['provider' => 'apple']) }}">Apple</a>
                                                @endif
                                            </div>
                                        @endif

                                        <p class="account__login--signup__text">{{ translate('Already have an account?')}} <a href="{{ route('user.login') }}">{{ translate('Log In')}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>     
        </div>
        <!-- End register section  -->
@endsection


@section('script')
    @if(get_setting('google_recaptcha') == 1)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">

        @if(get_setting('google_recaptcha') == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are humann!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });
        @endif

        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if(country.iso2 == 'bd'){
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('public/assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if(selectedCountryData.iso2 == 'bd'){
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                isPhoneShown = false;
                $(el).html('<i>*{{ translate('Use Phone Number Instead') }}</i>');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                isPhoneShown = true;
                $(el).html('*{{ translate('Use Email Instead') }}');
            }
        }
    </script>
@endsection
