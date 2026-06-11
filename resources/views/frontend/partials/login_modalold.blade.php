<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="account__login--header__title modal-title fw-600">{{ translate('Login') }}</h6>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                        @csrf

                        @if (addon_is_activated('otp_system') && env('DEMO_MODE') != 'On')
                            <!-- Phone -->
                            <div class="form-group phone-form-group mb-1">
                                <input type="tel" id="phone-code"
                                    class="account__login--input{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                    value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                            </div>
                            <!-- Country Code -->
                            <input type="hidden" name="country_code" value="">
                            <!-- Email -->
                            <div class="form-group email-form-group mb-1 d-none">
                                <input type="email"
                                    class="account__login--input {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email"
                                    id="email" autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- Use Email Instead -->
                            <div class="form-group text-right">
                                <button class="btn btn-link p-0 text-primary" type="button"
                                    onclick="toggleEmailPhone(this)"><i>*{{ translate('Use Email Instead') }}</i></button>
                            </div>
                        @else
                            <!-- Use Email Instead -->
                            <div class="form-group">
                                <input type="email"
                                    class="account__login--input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email"
                                    id="email" autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif

                        <!-- Password -->
                        <div class="form-group">
                            <input type="password" name="password" class="account__login--input"
                                placeholder="{{ translate('Password') }}">
                        </div>

                        <!-- Remember Me & Forgot password -->
                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="aiz-checkbox">
                                    <input class="checkout__checkbox--input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="opacity-60">{{ translate('Remember Me') }}</span>
                                    <span class="checkout__checkbox--checkmark aiz-square-check mt-3"></span>
                                </label>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('password.request') }}"
                                    class="account__login--forgot text-reset opacity-60 hov-opacity-100 fs-14">{{ translate('Forgot password?') }}</a>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="mb-5">
                            <button type="submit"
                                class="btn primary__btn btn-block fw-600 rounded-0">{{ translate('Login') }}</button>
                        </div>
                    </form>

                    <!-- Register Now -->
                    <div class="text-center mb-3">
                        <p class="account__login--signup__text text-muted mb-0">{{ translate('Dont have an account?') }}</p>
                        <a href="{{ route('user.registration') }}">{{ translate('Register Now') }}</a>
                    </div>
                    
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
                </div>
            </div>
        </div>
    </div>
</div>
