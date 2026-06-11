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
                        <div class="col active">
                            <div class="text-center border-bottom-6px p-1 text-primary single__widget widget__bg">
                                <i class="la-3x mb-2 las la-map cart-animate payment-icon" style="margin-right: -100px; transition: 2s;"></i>
                                <h3 class="fs-14 fw-600 d-none d-lg-block payment-title">{{ translate('2. Shipping info') }}
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

    <!-- Shipping Info -->
    <section class="mb-4 gry-bg">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-xxl-8 col-xl-10 mx-auto">
                    <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_delivery_info') }}" role="form" method="POST">
                        @csrf
                        @if(Auth::check())
                            <div class="border single__widget widget__bg p-4 mb-4">
                                @foreach (Auth::user()->addresses as $key => $address)
                                <div class="border mb-4">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label class="aiz-megabox d-block bg-white mb-0">
                                                <input type="radio" name="address_id" value="{{ $address->id }}" @if ($address->set_default)
                                                    checked
                                                @endif required>
                                                <span class="d-flex p-3 aiz-megabox-elem border-0">
                                                    <!-- Checkbox -->
                                                    <span class="aiz-rounded-check add-radio flex-shrink-0 mt-1"></span>
                                                    <!-- Address -->
                                                    <span class="flex-grow-1 pl-3 text-left">
                                                        <div class="row">
                                                            <span class="fs-14 text-secondary col-4">{{ translate('Address') }}</span>
                                                            <span class="fs-14 text-dark fw-500 ml-2 col">{{ $address->address }}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="fs-14 text-secondary col-4">{{ translate('Postal Code') }}</span>
                                                            <span class="fs-14 text-dark fw-500 ml-2 col">{{ $address->postal_code }}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="fs-14 text-secondary col-4">{{ translate('City') }}</span>
                                                            <span class="fs-14 text-dark fw-500 ml-2 col">{{ optional($address->city)->name }}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="fs-14 text-secondary col-4">{{ translate('State') }}</span>
                                                            <span class="fs-14 text-dark fw-500 ml-2 col">{{ optional($address->state)->name }}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="fs-14 text-secondary col-4">{{ translate('Country') }}</span>
                                                            <span class="fs-14 text-dark fw-500 ml-2 col">{{ optional($address->country)->name }}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="fs-14 text-secondary col-4">{{ translate('Phone') }}</span>
                                                            <span class="fs-14 text-dark fw-500 ml-2 col">{{ $address->phone }}</span>
                                                        </div>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>

                                        <style>
                                            .elip-option .dropdown-item:hover {
                                                background-color: var(--secondary-color);
                                            }
                                            .add-radio:after {
                                                background: var(--secondary-color);
                                            }
                                        </style>
                                        <!-- Edit Address Button -->
                                        <div class="col-md-4 p-3 text-right">
                                            <button class="btn text-white px-1 py-1" type="button" data-toggle="dropdown" style="background-color: var(--secondary-color);">
                                                <i class="la la-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right elip-option" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" onclick="edit_address('{{$address->id}}')">
                                                   <i class="la la-edit"></i> {{ translate('Edit') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('addresses.destroy', $address->id) }}"><i class="la la-trash"></i> {{ translate('Delete') }}</a>
                                            </div>
                                            <!-- <a class="primary__btn checkout text-white mr-4 rounded-5 px-4" onclick="edit_address('{{$address->id}}')">{{ translate('Change') }}</a> -->
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                                <input type="hidden" name="checkout_type" value="logged">
                                <!-- Add New Address -->
                                <div class="mb-5" >
                                    <div class="border p-3 c-pointer text-center bg-light has-transition hov-bg-soft-light h-100 d-flex flex-column justify-content-center" onclick="add_new_address()">
                                        <i class="las la-plus la-2x mb-3"></i>
                                        <div class="alpha-7 fw-700">{{ translate('Add New Address') }}</div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <!-- Return to shop -->
                                    <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                                        <a href="{{ route('home') }}" class="continue__shopping--link">
                                            <i class="las la-arrow-left fs-16"></i>
                                            {{ translate('Return to shop')}}
                                        </a>
                                    </div>
                                    <!-- Continue to Delivery Info -->
                                    <div class="col-md-6 text-center text-md-right mb-3">
                                        <button type="submit" class="primary__btn checkout">{{ translate('Continue to Payment')}}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modal')
    <!-- Address Modal -->
    @include('frontend.partials.address_modal')
@endsection
