@extends('frontend.layouts.app')

@if (isset($category_id))
@php
$meta_title = \App\Models\Category::find($category_id)->meta_title;
$meta_description = \App\Models\Category::find($category_id)->meta_description;
@endphp
@elseif (isset($brand_id))
@php
$meta_title = \App\Models\Brand::find($brand_id)->meta_title;
$meta_description = \App\Models\Brand::find($brand_id)->meta_description;
@endphp
@else
@php
$meta_title = get_setting('meta_title');
$meta_description = get_setting('meta_description');
@endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $meta_title }}">
<meta itemprop="description" content="{{ $meta_description }}">

<!-- Twitter Card data -->
<meta name="twitter:title" content="{{ $meta_title }}">
<meta name="twitter:description" content="{{ $meta_description }}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')
<style>
    .product__grid--column__buttons--icons {
        width: auto !important;
        padding: 10px;
    }

    .shop__header {
        background: none;
    }

    .home__two--slider__items {
        height: 75vh;
        min-height: 520px;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    @media only screen and (max-width: 767px) {
        .hero__slider--section {
            overflow: hidden;
        }

        .home__two--slider__items {
            height: 42vh;
            min-height: 280px;
            max-height: 420px;
            background-position: center top;
        }

        .hero__slider--activation .swiper-slide {
            overflow: hidden;
        }

        .shop__section .container {
            padding-left: 12px;
            padding-right: 12px;
        }

        .product__tab--one.product__grid--column__buttons {
            display: grid !important;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 8px;
            width: 100%;
        }

        .product__grid--column__buttons--icons {
            width: 100% !important;
            min-height: 48px;
            padding: 8px 6px;
            font-size: 11px;
            line-height: 1.1;
            white-space: normal;
            word-break: break-word;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .product__card {
            border-radius: 12px;
            overflow: hidden;
        }

        .product__card--action {
            top: 10px;
            right: 10px;
        }

        .product__card--action__btn {
            width: 36px;
            height: 36px;
        }

        .product__card--btn {
            font-size: 14px;
            line-height: 1.2;
            padding: 10px 14px;
            border-radius: 12px;
        }

        .rating__review--text {
            font-size: 12px;
        }

        .product__card--title {
            font-size: 14px;
            line-height: 1.35;
        }

        .product-price {
            font-size: 14px;
        }
    }
</style>

<style>
    /* PRODUCT CARD FIX */
    .product__card {
        position: relative;
        overflow: hidden;
        padding-bottom: 60px;
    }

    /* BUTTON CONTAINER (ALWAYS VISIBLE) */
    .product__add--to__card {
        position: absolute;
        bottom: 12px;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: center;

        opacity: 1 !important;
        visibility: visible !important;
    }

    /* GOLD GRADIENT BUTTON */
    .add-to-cart-btn,
    .product__card--btn {
        width: 90%;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;

        background: linear-gradient(90deg, #b8892e, #e6c36a);
        color: #000;

        font-weight: 600;
        font-size: 14px;
        letter-spacing: 1px;

        padding: 12px 0;
        border-radius: 8px;
        border: none;

        transition: all 0.3s ease;
        cursor: pointer;
    }

    /* ICON */
    .add-to-cart-btn .cart-icon {
        font-size: 16px;
    }

    /* HOVER EFFECT */
    .add-to-cart-btn:hover,
    .product__card--btn:hover {
        background: linear-gradient(90deg, #a17620, #d4b35c);
        transform: translateY(-2px);
        color: #000;
    }
</style>

<!-- Start breadcrumb section -->
<div class="breadcrumb__section breadcrumb__bg">
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <div class="breadcrumb__content text-center">
                    <h1 class="breadcrumb__content--title">
                        @if(isset($category_id))
                            {{ \App\Models\Category::find($category_id)->getTranslation('name') }}
                        @elseif(isset($query))
                            {{ translate('Search result for ') }}"{{ $query }}"
                        @else
                            {{ translate('All Products') }}
                        @endif
                    </h1>
                    <input type="hidden" name="keyword" value="{{ $query }}">
                    <ul class="breadcrumb__content--menu d-flex justify-content-center">
                        <li class="breadcrumb__content--menu__items"><a href="{{route('home')}}">{{ translate('Home')}}</a></li>
                        <li class="breadcrumb__content--menu__items"><span>
                             @if(isset($category_id))
                                {{ \App\Models\Category::find($category_id)->getTranslation('name') }}
                            @elseif(isset($query))
                                {{ translate('Search result for ') }}"{{ $query }}"
                            @else
                                {{ translate('All Products') }}
                            @endif
                        </span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End breadcrumb section -->
<style>
    @media (min-width: 992px) {
    .offcanvas__filter--sidebar {
        position: static !important;
        transform: none !important;
        visibility: visible !important;
        opacity: 1 !important;
        height: auto !important;
        width: 100%;
    }
}

</style>

<!-- Start shop section -->
<form class="" id="search-form" action="" method="GET">

    <div class="shop__section section--padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 shop-col-width-lg-4">
                    <div class="offcanvas__filter--sidebar shop__sidebar--widget widget__area">
                        <button type="button" class="offcanvas__filter--close d-lg-none" data-offcanvas>
                            <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"></path></svg> <span class="offcanvas__filter--close__text">Close</span>
                        </button>
                        <div class="offcanvas__filter--sidebar__inner">
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">{{ translate('Categories')}}</h2>
                            <ul class="widget__categories--menu">
                                @foreach(\App\Models\Category::where('level',0)->get() as $category)
                                <li class="widget__categories--menu__list active">
                                    <a class="widget__categories--menu__label d-flex align-items-center" href="{{ route('products.category', $category->slug) }}">
                                        <img class="widget__categories--menu__img" src="{{ uploaded_asset($category->icon) }}" onerror="this.src='{{ static_asset('public/assets/img/product/small-product/product1.webp') }}'">
                                        <span class="widget__categories--menu__text">
                                            {{ $category->getTranslation('name') }}
                                        </span>
                                        @if($category->childrenCategories->count() > 0)
                                        <svg class="widget__categories--menu__arrowdown--icon"
                                            xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                                            <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                                transform="translate(-6 -8.59)" fill="currentColor" />
                                        </svg>
                                        @endif
                                    </a>

                                    @if($category->childrenCategories->count() > 0)
                                    <ul class="widget__categories--sub__menu" style="display: block; box-sizing: border-box;">
                                        @foreach($category->childrenCategories as $sub)
                                        <li class="widget__categories--sub__menu--list">
                                            <a class="widget__categories--sub__menu--link d-flex align-items-center"
                                                href="{{ route('products.category', $sub->slug) }}">
                                                <img class="widget__categories--sub__menu--img" src="{{ uploaded_asset($sub->icon) }}" onerror="this.src='{{ static_asset('public/assets/img/product/small-product/product2.webp') }}'">
                                                <span class="widget__categories--sub__menu--text">
                                                    {{ $sub->getTranslation('name') }}
                                                </span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="single__widget price__filter widget__bg">
                            <h2 class="widget__title h3">Filter By Price</h2>
                            <div class="p-3 mr-3">
                                <div class="aiz-range-slider">
                                    <div
                                        id="input-slider-range"
                                        data-range-value-min="@if(\App\Models\Product::where('published', 1)->count() < 1) 0 @else {{ \App\Models\Product::where('published', 1)->min('unit_price') }} @endif"
                                        data-range-value-max="@if(\App\Models\Product::where('published', 1)->count() < 1) 0 @else {{ \App\Models\Product::where('published', 1)->max('unit_price') }} @endif"></div>

                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                                @if (isset($min_price))
                                                data-range-value-low="{{ $min_price }}"
                                                @elseif($products->min('unit_price') > 0)
                                                data-range-value-low="{{ $products->min('unit_price') }}"
                                                @else
                                                data-range-value-low="0"
                                                @endif
                                                id="input-slider-range-value-low"
                                                ></span>
                                        </div>
                                        <div class="col-6 text-right">
                                            <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                                @if (isset($max_price))
                                                data-range-value-high="{{ $max_price }}"
                                                @elseif($products->max('unit_price') > 0)
                                                data-range-value-high="{{ $products->max('unit_price') }}"
                                                @else
                                                data-range-value-high="0"
                                                @endif
                                                id="input-slider-range-value-high"
                                                ></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hidden Items -->
                            <input type="hidden" name="min_price" value="">
                            <input type="hidden" name="max_price" value="">
                        </div>

                        <!-- Attributes -->
                        @foreach ($attributes as $attribute)
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">
                                {{ $attribute->getTranslation('name') }}
                            </h2>
                            <ul class="widget__form--check">
                                @foreach ($attribute->attribute_values as $key => $attribute_value)
                                <li class="widget__form--check__list">
                                    <label class="widget__form--check__label" for="attr{{ $attribute->id }}{{ $key }}">
                                        {{ $attribute_value->value }}
                                    </label>
                                    <input 
                                        class="widget__form--check__input"
                                        id="attr{{ $attribute->id }}{{ $key }}"
                                        type="checkbox"
                                        name="selected_attribute_values[]"
                                        value="{{ $attribute_value->value }}"
                                        @if(in_array($attribute_value->value, $selected_attribute_values)) checked @endif
                                        onchange="filter()"
                                    >
                                    <span class="widget__form--checkmark"></span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach

                        <!-- Color -->
                        @if (get_setting('color_filter_activation'))
                        <div class="single__widget widget__bg">
                            <div class="accordion__items">
                                <a href="#colorFilter"
                                   class="accordion__items--button d-flex align-items-center justify-content-between w-100"
                                   data-toggle="collapse">
                                    <span class="widget__title h3 mb-0">
                                        {{ translate('Filter by color') }}
                                    </span>
                                    <span class="accordion__items--button__icon">
                                        <svg class="accordion__items--button__icon--svg"
                                             xmlns="http://www.w3.org/2000/svg"
                                             width="25.355" height="20.394" viewBox="0 0 512 512">
                                            <path d="M98 190.06l139.78 163.12a24 24 0 0036.44 0L414 190.06c13.34-15.57 2.28-39.62-18.22-39.62h-279.6c-20.5 0-31.56 24.05-18.18 39.62z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </a>

                                @php
                                    $show = '';
                                    if(isset($selected_color)){
                                        $show = 'show';
                                    }
                                @endphp

                                <div id="colorFilter" class="collapse {{ $show }}">
                                    <ul class="widget__color--list d-flex flex-wrap mt-3">
                                        @foreach ($colors as $color)
                                        <li class="widget__color--list__item me-2 mb-2">
                                            <label class="widget__color--label">
                                                <input
                                                    type="radio"
                                                    name="color"
                                                    value="{{ $color->code }}"
                                                    onchange="filter()"
                                                    @if(isset($selected_color) && $selected_color == $color->code) checked @endif
                                                >
                                                <span class="widget__color--circle"
                                                      style="background: {{ $color->code }};"
                                                      title="{{ $color->name }}">
                                                </span>
                                            </label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 shop-col-width-lg-8">
                    <div class="shop__product--wrapper position__sticky">
                        <div class="shop__header d-flex align-items-center justify-content-between mb-30">
                            <div class="product__view--mode d-flex align-items-center">
                                <a class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas>
                                    <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80" />
                                        <circle cx="336" cy="128" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                                        <circle cx="176" cy="256" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                                        <circle cx="336" cy="384" r="28" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                                    </svg>
                                    <span class="widget__filter--btn__text">Filter</span>
                                </a>

                                <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                    <label class="product__view--label">Sort By :</label>
                                    <div class="select shop__header--select">
                                        <select class="product__view--select" name="sort_by" onchange="filter()">
                                            <option selected value="1">Sort by Price</option>
                                            <option value="price-asc" @isset($sort_by) @if ($sort_by=='price-asc' ) selected @endif @endisset>{{ translate('Price low to high')}}</option>
                                            <option value="price-desc" @isset($sort_by) @if ($sort_by=='price-desc' ) selected @endif @endisset>{{ translate('Price high to low')}}</option>
                                            <!--<option value="4">Sort by  rating </option>-->
                                        </select>
                                    </div>
                                </div>
                                <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                    <label class="product__view--label">{{ translate('Brands')}} :</label>
                                    <div class="select shop__header--select">
                                        @if (Route::currentRouteName() != 'products.brand')
                                        <select class="product__view--select" data-live-search="true" name="brand" onchange="filter()">
                                            <option value="">{{ translate('Brands')}}</option>
                                            @foreach (\App\Models\Brand::all() as $brand)
                                            <option value="{{ $brand->slug }}" @isset($brand_id) @if ($brand_id==$brand->id) selected @endif @endisset>{{ $brand->getTranslation('name') }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="product__view--mode__list d-none">
                                    <div class="product__tab--one product__grid--column__buttons d-flex justify-content-center">
                                        <button class="product__grid--column__buttons--icons active" aria-label="grid btn" data-toggle="tab" data-target="#product_grid">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 9 9">
                                                <g transform="translate(-1360 -479)">
                                                    <rect id="Rectangle_5725" data-name="Rectangle 5725" width="4" height="4" transform="translate(1360 479)" fill="currentColor" />
                                                    <rect id="Rectangle_5727" data-name="Rectangle 5727" width="4" height="4" transform="translate(1360 484)" fill="currentColor" />
                                                    <rect id="Rectangle_5726" data-name="Rectangle 5726" width="4" height="4" transform="translate(1365 479)" fill="currentColor" />
                                                    <rect id="Rectangle_5728" data-name="Rectangle 5728" width="4" height="4" transform="translate(1365 484)" fill="currentColor" />
                                                </g>
                                            </svg>
                                        </button>
                                        <button class="product__grid--column__buttons--icons" aria-label="list btn" data-toggle="tab" data-target="#product_list">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 13 8">
                                                <g id="Group_14700" data-name="Group 14700" transform="translate(-1376 -478)">
                                                    <g transform="translate(12 -2)">
                                                        <g id="Group_1326" data-name="Group 1326">
                                                            <rect id="Rectangle_5729" data-name="Rectangle 5729" width="3" height="2" transform="translate(1364 483)" fill="currentColor" />
                                                            <rect id="Rectangle_5730" data-name="Rectangle 5730" width="9" height="2" transform="translate(1368 483)" fill="currentColor" />
                                                        </g>
                                                        <g id="Group_1328" data-name="Group 1328" transform="translate(0 -3)">
                                                            <rect id="Rectangle_5729-2" data-name="Rectangle 5729" width="3" height="2" transform="translate(1364 483)" fill="currentColor" />
                                                            <rect id="Rectangle_5730-2" data-name="Rectangle 5730" width="9" height="2" transform="translate(1368 483)" fill="currentColor" />
                                                        </g>
                                                        <g id="Group_1327" data-name="Group 1327" transform="translate(0 -1)">
                                                            <rect id="Rectangle_5731" data-name="Rectangle 5731" width="3" height="2" transform="translate(1364 487)" fill="currentColor" />
                                                            <rect id="Rectangle_5732" data-name="Rectangle 5732" width="9" height="2" transform="translate(1368 487)" fill="currentColor" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- <p class="product__showing--count">Showing 1–9 of 21 results</p> -->
                            <p class="product__showing--count d-none">Showing {{ $products->count() }} of {{\App\Models\Product::where('published', 1)->count()}} results</p>

                        </div>
                        <div class="tab_content">
                            <div id="product_grid" class="tab_pane active show">
                                <div class="product__section--inner">
                                    <div class="row mb--n30">
                                        @foreach ($products as $key => $product)
                                        @include('frontend.partials.product_box_2',['product' => $product])
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aiz-pagination mt-4">
                            {{ $products->appends(request()->input())->links('vendor.pagination.theme-pagination') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End shop section -->

<style>
    .counterup__banner__bg2:before {
        background: none;
    }

    @media only screen and (min-width: 1200px) {
        .breadcrumb__bg {
            height: 100px;
        }
    }
    .noUi-handle {
        background: var(--dark);
        border: 5px solid #D9D9D9;
    }
    .aiz-range-slider .noUi-connect {
        background: var(--dark);
    }

    /* colors  */
    .widget__color--label input {
        display: none;
    }

    .widget__color--circle {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: inline-block;
        cursor: pointer;
        border: 2px solid #ddd;
        transition: 0.3s;
    }

    .widget__color--label input:checked + .widget__color--circle {
        border: 2px solid #000;
        transform: scale(1.1);
    }
    .accordion__items--button.collapsed .accordion__items--button__icon--svg{
        transform: rotate(0deg);
        transition: 0.3s;
    }
    .accordion__items--button:not(.collapsed) .accordion__items--button__icon--svg{
        transform: rotate(180deg);
    }
    @media only screen and (min-width: 1200px) {
        .accordion__items--button {
            padding: 0px 0px 0px 0px;
        }
    }



</style>

<!-- Start feature section -->
<section class="feature__section section--padding counterup__banner__bg2" style="padding:60px">
    <div class="container">
        <div class="feature__inner d-flex justify-content-between">
            <div class="feature__items d-flex align-items-center">
                <div class="feature__icon">
                    <img src="{{static_asset('public/assets/webtheme/user/assets/img/other/feature1.webp')}}" alt="img">
                </div>
                <div class="feature__content">
                    <h2 class="feature__content--title h3">Free Shipping</h2>
                    <p class="feature__content--desc">Free shipping over $100</p>
                </div>
            </div>
            <div class="feature__items d-flex align-items-center">
                <div class="feature__icon ">
                    <img src="{{static_asset('public/assets/webtheme/user/assets/img/other/feature2.webp')}}" alt="img">
                </div>
                <div class="feature__content">
                    <h2 class="feature__content--title h3">Support 24/7</h2>
                    <p class="feature__content--desc">Contact us 24 hours a day</p>
                </div>
            </div>
            <div class="feature__items d-flex align-items-center">
                <div class="feature__icon">
                    <img src="{{static_asset('public/assets/webtheme/user/assets/img/other/feature3.webp')}}" alt="img">
                </div>
                <div class="feature__content">
                    <h2 class="feature__content--title h3">100% Money Back</h2>
                    <p class="feature__content--desc">You have 30 days to Return</p>
                </div>
            </div>
            <div class="feature__items d-flex align-items-center">
                <div class="feature__icon">
                    <img src="{{static_asset('public/assets/webtheme/user/assets/img/other/feature4.webp')}}" alt="img">
                </div>
                <div class="feature__content">
                    <h2 class="feature__content--title h3">Payment Secure</h2>
                    <p class="feature__content--desc">We ensure secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End feature section -->


@endsection

@section('script')
<script type="text/javascript">
    function filter() {
        $('#search-form').submit();
    }

    function rangefilter(arg) {
        $('input[name=min_price]').val(arg[0]);
        $('input[name=max_price]').val(arg[1]);
        filter();
    }
</script>
@endsection
