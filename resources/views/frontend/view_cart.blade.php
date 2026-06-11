@extends('frontend.layouts.app')

@section('content')
    <!-- Steps -->
    <section class="pt-5 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="row gutters-5 sm-gutters-10">
                        <div class="col active">
                            <div class="text-center border-bottom-6px p-1 text-primary single__widget widget__bg">
                                <i class="la-3x mb-2 las la-shopping-cart cart-animate payment-icon" style="margin-left: -100px; transition: 2s;"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block payment-title">{{ translate('1. My Cart') }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center border-bottom-6px p-1 single__widget widget__bg">
                                <i class="la-3x mb-2 opacity-50 las la-map payment-icon"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 payment-title">{{ translate('2. Shipping info') }}
                                </h3>
                            </div>
                        </div>
                        {{--<div class="col">
                            <div class="text-center border-bottom-6px p-1 single__widget widget__bg">
                                <i class="la-3x mb-2 opacity-50 las la-truck payment-icon"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 payment-title">{{ translate('3. Delivery info') }}
                                </h3>
                            </div>
                        </div>--}}
                        <div class="col">
                            <div class="text-center border-bottom-6px p-1 single__widget widget__bg">
                                <i class="la-3x mb-2 opacity-50 las la-credit-card payment-icon"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 payment-title">{{ translate('3. Payment') }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center border-bottom-6px p-1 single__widget widget__bg">
                                <i class="la-3x mb-2 opacity-50 las la-check-circle payment-icon"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 payment-title">{{ translate('4. Confirmation') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart Details -->
    <section class="cart__section section--padding" id="cart-summary">
        @include('frontend.partials.cart_details', ['carts' => $carts])
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
        }

        function updateQuantity(key, element) {
            $.post('{{ route('cart.updateQuantity') }}', {
                _token: AIZ.data.csrf,
                id: key,
                quantity: element.value
            }, function(data) {
                updateNavCart(data.nav_cart_view, data.cart_count);
                $('#cart-summary').html(data.cart_view);
            });
        }

        function showLoginModal() {
            $('#login_modal').modal("show");
        }
    </script>

    <script>
        $(document).ready(function(){

            // Send OTP
            $('#sendOtpBtn').click(function(){

                let phone = $('#phone').val();

                $.ajax({
                    url: "{{ route('send.otp') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        phone: phone
                    },
                    success: function(response){
                        if(response.status){
                            $('#otpSection').show();
                            $('#sendOtpSection').hide();
                            alert("OTP Sent Successfully");
                        }else{
                            $('#phone_error').text(response.message);
                        }
                    }
                });
            });


            // Verify OTP
            $('#verifyOtpBtn').click(function(){

                let phone = $('#phone').val();
                let otp   = $('#otp').val();

                $.ajax({
                    url: "{{ route('verify.otp') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        phone: phone,
                        otp: otp
                    },
                    success: function(response){
                        if(response.status){
                            window.location.href = "{{ route('checkout.shipping_info') }}";
                        }else{
                            $('#otp_error').text(response.message);
                        }
                    }
                });
            });

        });
    </script>
@endsection
