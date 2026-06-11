@extends('frontend.layouts.app')

@section('content')
        <!-- Start login section  -->
        <div class="login__section section--padding">
            <div class="container">
                <form role="form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="login__section--inner">
                        <div class="row row-cols-md-2 row-cols-1">
                            <div class="col mx-auto">
                                <div class="account__login">
                                    <div class="account__login--header mb-25">
                                        <h2 class="account__login--header__title mb-15">{{ translate('Welcome Back !')}}</h2>
                                        <p class="account__login--header__desc">{{ translate('Login to your account')}}</p>
                                    </div>
                                    <div class="account__login--inner">
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
                                                <input class="account__login--input{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email address') }}" name="email" id="email" autocomplete="off">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </label>
                                        @endif
                                        <label>
                                            <input class="account__login--input {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password" type="password">
                                        </label>
                                        <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                            <!-- Remember me  -->
                                            <div class="account__login--remember position__relative">
                                                <input class="checkout__checkbox--input" id="check1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <span class="checkout__checkbox--checkmark aiz-square-check mt-lg-3 mt-md-2"></span>
                                                <label class="checkout__checkbox--label login__remember--label" for="check1">
                                                    {{  translate('Remember Me') }}</label>
                                            </div>
                                            <a href="{{ route('password.request') }}" class="account__login--forgot">{{ translate('Forgot password?')}}</a>
                                        </div>
                                        <button class="account__login--btn primary__btn mb-3" type="submit">{{  translate('Login') }}</button>

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

                                        <p class="account__login--signup__text">{{ translate('Dont have an Account?')}} <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- DEMO MODE -->
                @if (env("DEMO_MODE") == "On")
                    <div class="mb-4">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                {{-- <tr>
                                    <td>{{ translate('Seller Account')}}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button>
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td>{{ translate('Customer Account')}}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td>{{ translate('Delivery Boy Account')}}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" onclick="autoFillDeliveryBoy()">{{ translate('Copy credentials') }}</button>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>     
        </div>
        <!-- End login section  -->
@endsection

@section('script')
    <script type="text/javascript">
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
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('<i>*{{ translate('Use Phone Number Instead') }}</i>');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('<i>*{{ translate('Use Email Instead') }}</i>');
            }
        }

        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }

        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }
        
        function autoFillDeliveryBoy(){
            $('#email').val('deliveryboy@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection
