@extends('frontend.layouts.app')

@section('content')

    <!-- Steps -->
    <section class="pt-5 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="row gutters-5 sm-gutters-10">
                        <div class="col done">
                            <div class="text-center border-bottom-6px p-1 text-success single__widget widget__bg">
                                <i class="la-3x mb-2 las la-shopping-cart payment-icon"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block payment-title">{{ translate('1. My Cart') }}</h3>
                            </div>
                        </div>
                        <div class="col done">
                            <div class="text-center border-bottom-6px p-1 text-success single__widget widget__bg">
                                <i class="la-3x mb-2 las la-map payment-icon"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block payment-title">{{ translate('2. Shipping info') }}
                                </h3>
                            </div>
                        </div>
                        {{--<div class="col done">
                            <div class="text-center border-bottom-6px p-1 text-success single__widget widget__bg">
                                <i class="la-3x mb-2 las la-truck payment-icon"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block payment-title">{{ translate('3. Delivery info') }}
                                </h3>
                            </div>
                        </div>--}}
                        <div class="col active">
                            <div class="text-center border-bottom-6px p-1 text-primary single__widget widget__bg">
                                <i class="la-3x mb-2 las la-credit-card cart-animate payment-icon" style="margin-right: -100px; transition: 2s;"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block payment-title">{{ translate('4. Payment') }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center border-bottom-6px p-1 single__widget widget__bg">
                                <i class="la-3x mb-2 opacity-50 las la-check-circle payment-icon"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 payment-title">{{ translate('5. Confirmation') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Info -->
    <section class="mb-4">
        <div class="container text-left">
            <div class="row">
                <!-- Cart Summary -->
                <div class="col-lg-4 mt-lg-0 mt-4" id="cart_summary">
                    @include('frontend.partials.cart_summary')
                </div>
                <div class="col-lg-8">
                    <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST"
                        id="checkout-form">
                        @csrf
                        <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                        
                        <div class="card rounded-5 border single__widget widget__bg">
                            <!-- Additional Info -->
                            <div class="card-header p-4 border-bottom-0">
                                <h3 class="fs-16 fw-700 text-dark mb-0">
                                    {{ translate('Any additional info?') }}
                                </h3>
                            </div>
                            <div class="form-group px-4">
                                <textarea name="additional_info" rows="5" class="account__login--input rounded-3" placeholder="{{ translate('Type your text...') }}"></textarea>
                            </div>

                            <input type="hidden" name="payment_option" value="payumoney">

                            <!-- Agree Box -->
                            <div class="pt-3 px-4 fs-14">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" required id="agree_checkbox">
                                    <span class="aiz-square-check"></span>
                                    <span>{{ translate('I agree to the') }}</span>
                                </label>
                                <a href="{{ route('terms') }}" class="fw-700">{{ translate('terms and conditions') }}</a>,
                                <a href="{{ route('returnpolicy') }}" class="fw-700">{{ translate('return policy') }}</a> &
                                <a href="{{ route('privacypolicy') }}" class="fw-700">{{ translate('privacy policy') }}</a>
                            </div>

                            <div class="pt-5 d-flex justify-content-between align-items-center">
                                <!-- Return to shop -->
                                <!--<div class="col-6">-->
                                    <a href="{{ route('home') }}" class="continue__shopping--link">
                                        <i class="las la-arrow-left fs-16"></i>
                                        {{ translate('Return to shop') }}
                                    </a>
                                <!--</div>-->
                                <!-- Complete Ordert -->
                                <!--<div class="col-6 text-right">-->
                                    <button type="button" onclick="submitOrder(this)"
                                        class="primary__btn">{{ translate('Complete Order') }}</button>
                                <!--</div>-->
                            </div>
                        </div>
                    </form>
                </div>

                
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        var minimum_order_amount_check = {{ get_setting('minimum_order_amount_check') == 1 ? 1 : 0 }};
        var minimum_order_amount =
            {{ get_setting('minimum_order_amount_check') == 1 ? get_setting('minimum_order_amount') : 0 }};

        function submitOrder(el) {
            $(el).prop('disabled', true);
            if ($('#agree_checkbox').is(":checked")) {
                if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {
                    AIZ.plugins.notify('danger',
                        '{{ translate('You order amount is less then the minimum order amount') }}');
                } else {
                    $('#checkout-form').submit();
                }
            } else {
                AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');
                $(el).prop('disabled', false);
            }
        }

        $(document).on("click", "#coupon-apply", function() {
            var data = new FormData($('#apply-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ route('checkout.apply_coupon_code') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    AIZ.plugins.notify(data.response_message.response, data.response_message.message);
                    $("#cart_summary").html(data.html);
                }
            })
        });

        $(document).on("click", "#coupon-remove", function() {
            var data = new FormData($('#remove-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ route('checkout.remove_coupon_code') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    $("#cart_summary").html(data);
                }
            })
        })
    </script>
@endsection
