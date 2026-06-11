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
                    <form id="otpLoginForm">
                        @csrf

                        <!-- Mobile Number -->
                        <div class="form-group mb-3">
                            <label>Mobile Number</label>
                            <input type="text" name="phone" id="phone" class="account__login--input" placeholder="Enter Mobile Number">
                            <span class="text-danger" id="phone_error"></span>
                        </div>

                        <!-- Send OTP Button -->
                        <div class="mb-3" id="sendOtpSection">
                            <button type="button" id="sendOtpBtn"
                                class="btn primary__btn btn-block">Send OTP</button>
                        </div>

                        <!-- OTP Section (Hidden Initially) -->
                        <div id="otpSection" style="display:none;">
                            <div class="form-group mb-3">
                                <label>Enter OTP</label>
                                <input type="text" name="otp" id="otp" class="account__login--input" placeholder="Enter OTP">
                                <span class="text-danger" id="otp_error"></span>
                            </div>

                            <button type="button" id="verifyOtpBtn"
                                class="btn primary__btn btn-block">Verify & Login</button>
                        </div>
                    </form>

                    <!-- Register Now -->
                    <div class="text-center mb-3">
                        <p class="account__login--signup__text text-muted mb-0">{{ translate('Dont have an account?') }}</p>
                        <a href="{{ route('user.registration') }}">{{ translate('Register Now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


