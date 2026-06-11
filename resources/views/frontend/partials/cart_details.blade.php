<div class="container">
    <div class="cart__section--inner">
        @if( $carts && count($carts) > 0 )
        <div class="row">
            <div class="col-lg-8 mx-auto single__widget widget__bg">
                <div class="cart__table">
                    <table class="cart__table--inner">
                        <thead class="cart__table--header">
                            <tr class="cart__table--header__items">
                                <th class="cart__table--header__list">{{ translate('Product')}}</th>
                                <th class="cart__table--header__list text-center">{{ translate('Price')}}</th>
                                <th class="cart__table--header__list text-center">{{ translate('Discount')}}</th>
                                <th class="cart__table--header__list text-center">{{ translate('Tax')}}</th>
                                <th class="cart__table--header__list text-center">{{ translate('Qty')}}</th>
                                <th class="cart__table--header__list text-center">{{ translate('Total')}}</th>
                            </tr>
                        </thead>
                        <tbody class="cart__table--body">
                            @php
                                $total = 0;
                            @endphp
                            
                            @foreach ($carts as $key => $cartItem)
                                @php
                                    $product = \App\Models\Product::find($cartItem['product_id']);
                                    $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                            
                                    // discounted price
                                    $discounted_price = cart_product_price($cartItem, $product, false);
                            
                                    // original price
                                    $original_price = home_base_price($product, false);
                            
                                    // discount amount
                                    $discount_amount = $original_price - $discounted_price;
                            
                                    $total = $total + $discounted_price * $cartItem['quantity'];
                            
                                    $product_name_with_choice = $product->getTranslation('name');
                            
                                    if ($cartItem['variation'] != null) {
                                        $product_choice = $cartItem['variation'];
                                    }
                                @endphp
                            <tr class="cart__table--body__items">
                                <td class="cart__table--body__list">
                                    <div class="cart__product d-flex align-items-center">
                                        <!-- Remove from cart  -->
                                        <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem['id'] }})" class="cart__remove--btn" aria-label="search button">
                                            <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16px" height="16px">
                                                <path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
                                            </svg>
                                        </a>
                                        <!-- Product Image  -->
                                        <div class="cart__thumbnail">
                                            <img class="border-radius-5" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{ $product->getTranslation('name')  }}" onerror="this.onerror=null;this.src='{{ static_asset('public/assets/img/placeholder.jpg') }}';">
                                        </div>
                                        <!-- Product Name  -->
                                        <div class="cart__content">
                                            <h3 class="cart__content--title h4">{{ $product_name_with_choice }}</h3>
                                            @if ($cartItem['variation'] != null)
                                            <span class="cart__content--variant">{{ $product_choice }}</span>
                                            @endif
                                            <!-- <span class="cart__content--variant">WEIGHT: 2 Kg</span> -->
                                        </div>
                                    </div>
                                </td>
                                <!-- Product Price  -->
                                <td class="cart__table--body__list">
                                    <span class="cart__price">{{ cart_product_price($cartItem, $product, true, false) }}</span>
                                </td>
                                <!-- Discount Price  -->
                                <td class="cart__table--body__list">
                                    <span class="cart__price">₹{{ $discount_amount * $cartItem['quantity'] }}</span>
                                </td>
                                <!-- Product Tax  -->
                                <td class="cart__table--body__list">
                                    <span class="cart__price">{{ cart_product_tax($cartItem, $product) }}</span>
                                </td>
                                <!-- Product Quantity  -->
                                <td class="cart__table--body__list">
                                    @if ($cartItem['digital'] != 1 && $product->auction_product == 0)
                                    <div class="quantity__box aiz-plus-minus">
                                        <button type="button" class="quantity__value quickview__value--quantity decrease" data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">-</button>
                                        <label>
                                            <input type="number" name="quantity[{{ $cartItem['id'] }}]" class="quantity__number quickview__value--number input-number" value="{{ $cartItem['quantity'] }}" min="{{ $product->min_qty }}" max="{{ $product_stock->qty }}" onchange="updateQuantity({{ $cartItem['id'] }}, this)" />
                                        </label>
                                        <button type="button" class="quantity__value quickview__value--quantity increase" data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]">+</button>
                                    </div>
                                    @elseif($product->auction_product == 1) 
                                        <span class="cart__price">1</span>
                                    @endif
                                </td>
                                <!-- Product Total  -->
                                <td class="cart__table--body__list">
                                    <span class="cart__price end">{{ single_price(cart_product_price($cartItem, $product, false) * $cartItem['quantity']) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Subtotal  -->
                    <div class="continue__shopping d-flex justify-content-between">
                        <span class="continue__shopping--link">{{translate('Subtotal')}}</span>
                        <span class="cart__price end">{{ single_price($total) }}</span>
                    </div>
                    <!-- Return to shop & Continue Shopping  -->
                    <div class="continue__shopping d-flex justify-content-between">
                        <a class="continue__shopping--link" href="{{ route('home') }}"><i class="las la-arrow-left fs-16"></i> {{ translate('Return to shop')}}</a>
                        @if(Auth::check())
                            <a href="{{ route('checkout.shipping_info') }}" class="primary__btn checkout">{{ translate('Continue to Shipping')}}</a>
                        @else 
                            <button onclick="showLoginModal()" class="primary__btn checkout">{{ translate('Continue to Shipping')}}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else 
        <div class="row">
            <div class="col-lg-8 single__widget widget__bg mx-auto">
                <!-- Empty cart -->
                <div class="text-center p-3">
                    <i class="las la-frown la-3x opacity-60 mb-3 cnf"></i>
                    <h3 class="cart__title">{{translate('Your Cart is empty')}}</h3>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script type="text/javascript">
    if (window.AIZ && AIZ.extra && AIZ.extra.plusMinus) {
        AIZ.extra.plusMinus();
    }

    function removeFromCartView(e, key) {
        if (e && e.preventDefault) e.preventDefault();
        if (window.removeFromCart) {
            removeFromCart(key);
        }
        return false;
    }
</script>

<style>
    .cnf:before {
        font-size: 50px;
    }
</style>
