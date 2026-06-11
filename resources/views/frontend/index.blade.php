@extends('frontend.layouts.app')
@section('content')
<style>
        /* DESKTOP GRID */
        @media (min-width: 768px) {
            .product-slider {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }

            .product-slide {
                width: calc(25% - 20px);
            }
        }

        /* MOBILE SLIDER */
        @media (max-width: 767px) {
            .product-slider {
                display: flex;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                gap: 12px;
                padding: 10px;
            }

            .product-slider::-webkit-scrollbar {
                display: none;
            }

            .product-slide {
                min-width: 75%;
                flex: 0 0 auto;
                scroll-snap-align: start;
            }

            .product__card {
                margin-bottom: 0;
            }
        }

    </style>
    <style>
        .product-banner img {
            border-radius: 12px;
            transition: 0.3s ease;
        }

        .product-banner img:hover {
            transform: scale(1.02);
        }

        .product-banner {
            text-align: center;
        }

        .img-fluidcategory {
            max-width: 65%;
            margin: 0 auto;   /* ✅ center */
            display: block;   /* ✅ important */
        }
    </style>
<style>
    @media (max-width: 767px) {
        .slider-bg-desktop {
            display: none !important;
        }
        .slider-bg-mobile {
            display: block !important;
        }
    }
</style>
<main class="main__content_wrapper">

    <!-- Start slider section -->
    <section class="hero__slider--section">
        <div class="hero__slider--activation swiper">
            <div class="swiper-wrapper">
                @foreach(App\Models\Slider::orderBy('id','desc')->get() as $r)
                <div class="swiper-slide">
                    <div class="home__two--slider__items" style="position:relative">
                        <div class="slider-bg-desktop" style="position:absolute;top:0;left:0;width:100%;height:100%;background-size:cover;background-repeat:no-repeat;background-position:center center;background-image:url('{{uploaded_asset($r->photo)}}')"></div>
                        <div class="slider-bg-mobile" style="display:none;position:absolute;top:0;left:0;width:100%;height:100%;background-size:cover;background-repeat:no-repeat;background-position:center center;background-image:url('{{$r->mobile_slider ? uploaded_asset($r->mobile_slider) : uploaded_asset($r->photo)}}')"></div>
                        <div class="container">
                            <div class="slider__items--inner">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="slider__content d-none">
                                            <h2 class="slider__maintitle text__primary h1">Beauty is Whatever <br>
                                                Brings Perfect</h2>
                                            <p class="slider__desc">50% OFF on the most popular perfumes brands. Order all classy products today!
                                            </p>
                                            <a class="primary__btn slider__btn" href="{{route('search')}}">
                                                SHOP NOW
                                                <svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.9732 5.19375L11.1893 0.460018C11.1225 0.392216 11.0412 0.338185 10.9507 0.301395C10.8601 0.264605 10.7623 0.245867 10.6636 0.246372C10.5648 0.246877 10.4672 0.266615 10.377 0.304329C10.2869 0.342044 10.2061 0.396903 10.14 0.465385C10.001 0.610077 9.9245 0.79778 9.92549 0.992021C9.92649 1.18626 10.0049 1.37316 10.1454 1.51643L13.6531 4.9864L0.935903 5.05145C0.734471 5.06613 0.546408 5.15137 0.409525 5.29006C0.272641 5.42874 0.197086 5.61057 0.19805 5.799C0.199014 5.98743 0.276425 6.16848 0.41472 6.30575C0.553015 6.44303 0.74194 6.52635 0.943512 6.53896L13.6586 6.47392L10.1866 9.98155C10.0475 10.1262 9.97108 10.3139 9.97207 10.5082C9.97306 10.7024 10.0514 10.8893 10.192 11.0326C10.2588 11.1004 10.3401 11.1544 10.4306 11.1912C10.5212 11.228 10.6189 11.2467 10.7177 11.2462C10.8165 11.2457 10.9141 11.226 11.0042 11.1883C11.0944 11.1506 11.1751 11.0957 11.2413 11.0272L15.9786 6.25458C16.1206 6.1093 16.1989 5.91956 16.1979 5.72303C16.1969 5.5265 16.1167 5.33757 15.9732 5.19375Z" fill="currentColor" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="hero__slider--thumbnail text-right d-none">
                                            <img class="slider__layer--img style2" src="{{uploaded_asset($r->photo)}}" alt="slider-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="slider__pagination swiper-pagination"></div>
        </div>
    </section>
    <!-- End slider section -->

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
                        <p class="feature__content--desc">Free shipping on all orders</p>
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

    <!-- Start collection section -->
    <section class="shop__collection--section section--padding">
        <div class="container">
            <div class="section__heading text-center py-5">
                <h2 class="section__heading--maintitle">Shop by Category</h2>
            </div>
            <div class="shop__collection--column5 swiper">
                <div class="swiper-wrapper">
                    @foreach(App\Models\Category::orderBy('id','desc')->with('products')->where('level',0)->get() as $category)
                    <div class="swiper-slide">
                        <div class="shop__collection--card text-center">
                            <a class="shop__collection--link" href="{{ route('products.category', $category->slug) }}">
                                <img class="shop__collection--img" style="border-radius: 15px;" src="{{ uploaded_asset($category->banner) }}" alt="{{  $category->getTranslation('name') }}">
                                <h3 class="shop__collection--title">{{ $category->getTranslation('name') }}</h3>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper__nav--btn swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                <div class="swiper__nav--btn swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    <!-- End collection section -->

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
            }

            @media only screen and (max-width: 767px) {
                .hero__slider--section {
                    overflow: hidden;
                }

                .home__two--slider__items {
                    height: 42vh;
                    min-height: 280px;
                    max-height: 420px;
                }
                .slider-bg-mobile {
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

    <!-- Start shop section -->
    <div class="shop__section section--padding">
        <div class="container">
            <div class="section__heading text-center">
                <h2 class="section__heading--maintitle">All Category</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="shop__product--wrapper position__sticky">
                        <div class="shop__header d-flex align-items-center justify-content-center mb-30">
                            <div class="product__view--mode d-flex align-items-center">
                                <div class="product__view--mode__list">
                                    <div
                                        class="product__tab--one product__grid--column__buttons d-flex justify-content-center">
                                        @foreach (\App\Models\Category::where('level', 0)->orderBy('order_level', 'desc')->limit(3)->get() as $key => $category)
                                        <button class="product__grid--column__buttons--icons {{ $key == 0 ? 'active' : '' }} text-uppercase"
                                            aria-label="list btn" data-toggle="tab" data-target="#product_list{{ $key+1 }}">
                                            {{ $category->getTranslation('name') }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab_content">
                            @foreach (\App\Models\Category::where('level', 0)->orderBy('order_level', 'desc')->limit(3)->get() as $key => $category)
                            <div id="product_list{{ $key+1 }}" class="tab_pane {{ $key == 0 ? 'active show' : '' }}">
                                <div class="product__section--inner product__swiper--column4 padding swiper">
                                    @php
                                        $products = \App\Models\Product::where(function($q) use ($category){
                                            $q->where('category_id', $category->id)
                                              ->orWhereHas('categories', function($q2) use ($category){
                                                  $q2->where('category_id', $category->id);
                                              });
                                        })->orderBy('created_at','desc')->where('published',1)->with('category')->get();
                                    @endphp
                                    @if($products->count() > 0)
                                    <div class="swiper-wrapper">
                                        @foreach ($products as $product)
                                        @php
                                        $product_url = route('product', $product->slug);
                                        if ($product->auction_product == 1) {
                                        $product_url = route('auction-product', $product->slug);
                                        }
                                        @endphp
                                        <div class="swiper-slide">
                                            <article class="product__card">
                                                <div class="product__card--thumbnail">
                                                    <a class="product__card--thumbnail__link display-block"
                                                        href="{{$product_url}}">
                                                        <img class="product__card--thumbnail__img product__primary--img"
                                                            data-src="{{ uploaded_asset($product->thumbnail_img) }}" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                                        <img class="product__card--thumbnail__img product__secondary--img"
                                                            data-src="{{ uploaded_asset($product->thumbnail_img) }}" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                                    </a>
                                                    
                                                    <!-- Wholesale tag -->
                                                    @if ($product->wholesale_product)
                                                    <span class="product__badge">{{ translate('Wholesale') }}</span>
                                                    @endif
                                                    <ul class="product__card--action">

                                                        <li class="product__card--action__list">
                                                            <a class="product__card--action__btn" title="Wishlist"
                                                                href="javascript:void(0)" onclick="addToWishList('{{ $product->id }}')">
                                                                <svg class="product__card--action__btn--svg mt-2 mt-md-3 mt-lg-3"
                                                                    width="18" height="18" viewBox="0 0 16 13"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                                <span class="visually-hidden">Wishlist</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product__card--content text-center">
                                                    <ul class="rating product__card--rating d-flex justify-content-center">
                                                        @for ($i=0; $i < $product->review_rating; $i++)
                                                            <li class="rating__list">
                                                                <span class="rating__icon">
                                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"></path>
                                                                    </svg>
                                                                </span>
                                                            </li>
                                                        @endfor
                                                        @for ($i=0; $i < 5-$product->review_rating; $i++)
                                                            <li class="rating__list">
                                                                <span class="rating__icon">
                                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"></path>
                                                                    </svg>
                                                                </span>
                                                            </li>
                                                        @endfor
                                                        <li>
                                                            <span class="rating__review--text">({{$product->rating_counting}}) Review</span>
                                                        </li>
                                                    </ul>
                                                    <h3 class="product__card--title">
                                                        <a href="{{$product_url}}">{{ $product->getTranslation('name')  }}</a>
                                                    </h3>
                                                    <!-- Product Price -->
                                                    <div class="product-price">
                                                        @if($product->auction_product == 0)
                                                            <span class="current__price">{{ home_discounted_base_price($product) }}</span>
                                                        
                                                            @if(home_discounted_base_price($product) != home_base_price($product))
                                                                <span class="old__price">{{ home_base_price($product) }}</span>
                                                            @endif
                                                        @endif
                                                        <!-- Discount percentage tag  -->
                                                        @if(discount_in_percentage($product) > 0)
                                                        <span class="product__badge">-{{discount_in_percentage($product)}}% off</span>
                                                        @endif
                                                    </div>
                                                    <!-- End Product Price -->
                                                </div>
                                                <div class="product__add--to__card">
                                                    <button class="add-to-cart-btn"
                                                        onclick="showAddToCartModal('{{ $product->id }}')">
                                                        Add to Cart
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </button>
                                                </div>
                                            </article>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper__nav--btn swiper-button-next">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
                                            <polyline points="9 18 15 12 9 6"></polyline>
                                        </svg>
                                    </div>
                                    <div class="swiper__nav--btn swiper-button-prev">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
                                            <polyline points="15 18 9 12 15 6"></polyline>
                                        </svg>
                                    </div>
                                    @else 
                                    <div class="text-center py-3">
                                        <h4 class="mb-2">No products found</h4>
                                        <p class="text-muted">
                                            Products are not available in this category yet.
                                        </p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End shop section -->

    <!-- Start banner section -->
    <section class="banner__section section--padding">
        <div class="container">
            <div class="row mb--n30">
                @foreach($featured_categories as $key => $ct)
                @if($key == 0)
                <div class="col-lg-6 col-md-6 mb-30">
                    <div class="banner__box border-radius-5 position-relative">
                        <a class="display-block" href="#"><img class="banner__box--thumbnail border-radius-5" data-src="{{uploaded_asset($ct->cover_image)}}" src="{{uploaded_asset($ct->cover_image)}}" alt="banner-img">
                            <div class="banner__box--content__style right__side middle d-none">
                                <h2 class="banner__box--content__title ">Perfumes Collection</h2>

                                <p class="banner__box--content__desc">Freshwater pearl freshners and perfumes</p>
                                <span class="banner__box--content__btn primary__btn">EXPLORE </span>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @if($key == 1)
                <div class="col-lg-6 col-md-6 mb-30">
                    <div class="banner__box border-radius-5 position-relative">
                        <a class="display-block" href="#"><img class="banner__box--thumbnail border-radius-5" data-src="{{uploaded_asset($ct->cover_image)}}" src="{{uploaded_asset($ct->cover_image)}}" alt="banner-img">
                            <div class="banner__box--content d-none">
                                <h2 class="banner__box--content__title ">Gift Combos</h2>
                                <p class="banner__box--content__desc">Freshwater pearl room freshners and perfumes</p>
                                <span class="banner__box--content__btn primary__btn style2">EXPLORE </span>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- End banner section -->
    
    <!-- Start Deal banner -->
     @php
    use App\Models\Product;
    use Carbon\Carbon;

    // Current time (IST)
    $now = Carbon::now('Asia/Kolkata');

    // Product having discount
    $product = Product::where('published', 1)
        ->whereNotNull('discount_start_date')
        ->whereNotNull('discount_end_date')
        ->first();

    $dealActive = false;
    $dealEndJs = null;

    if ($product) {
        $start = Carbon::createFromTimestamp($product->discount_start_date, 'UTC')
            ->setTimezone('Asia/Kolkata');

        $end = Carbon::createFromTimestamp($product->discount_end_date, 'UTC')
            ->setTimezone('Asia/Kolkata');

        $dealActive = $now->between($start, $end);

        if ($dealActive) {
            $dealEndJs = $end->format('M d, Y H:i:s');
        }
    }
@endphp





@if($dealActive)
<!-- Start countdown banner section -->
<section class="countdown__banner countdown__banner--bg section--padding mb-5">
    <div class="container">
        <div class="row row_sm_reverse align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="countdown__content text-center">
                    <h2 class="countdown__content--title">Deals of the day</h2>
                    <h3 class="countdown__content--subtitle">
                        {{  $product->getTranslation('name')  }}
                    </h3>
                    <div class="banner__price">
                        @if($product->auction_product == 0)
                            <span class="current__price">{{ home_discounted_base_price($product) }}</span>
                        @endif
                        @if($product->auction_product == 0)
                            <span class="old__price">{{ single_price($product->unit_price) }}</span>
                        @endif
                    </div>
                    <!-- COUNTDOWN -->
                    <div class="countdown__banner--style d-flex justify-content-center"
                         data-countdown="{{ $dealEndJs }}">
                    </div>
                    <a class="countdown__content--btn primary__btn"
                       href="{{ route('product', $product->slug) }}">
                        SHOP NOW
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="countdown__thumbnail">
                    <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End countdown banner section -->
@endif




<script>
document.addEventListener("DOMContentLoaded", function () {
    const countdownEl = document.querySelector('[data-countdown]');
    if (!countdownEl) return;

    const endTime = new Date(countdownEl.getAttribute('data-countdown')).getTime();

    const interval = setInterval(() => {
        const now = new Date().getTime();
        const distance = endTime - now;

        if (distance <= 0) {
            clearInterval(interval);

            // Hide banner instantly
            const banner = document.querySelector('.countdown__banner');
            if (banner) {
                banner.style.display = 'none';
            }
        }
    }, 1000);
});
</script>

    <!-- End Deal banner -->

    <!-- Start product section -->
    @if (count($newest_products) > 0)
    <section class="product__section section--padding pt-0">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">NEW ARRIVALS</h2>
            </div>
            <div class="product__section--inner product__swiper--column4 padding swiper">
                <div class="swiper-wrapper">
                    @foreach($newest_products as $product)
                    @php
                    $product_url = route('product', $product->slug);
                    if($product->auction_product == 1) {
                    $product_url = route('auction-product', $product->slug);
                    }
                    @endphp
                    <div class="swiper-slide">
                        <article class="product__card">
                            <div class="product__card--thumbnail">
                                <a class="product__card--thumbnail__link display-block" href="{{$product_url}}">
                                    <img class="product__card--thumbnail__img product__primary--img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                    <img class="product__card--thumbnail__img product__secondary--img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                </a>
                               
                                <!-- Wholesale tag -->
                                @if ($product->wholesale_product)
                                <span class="product__badge" style="background-color: #455a64; @if(discount_in_percentage($product) > 0) top:25px;@endif">
                                    {{ translate('Wholesale') }}
                                </span>
                                @endif
                                <ul class="product__card--action">
                                    <li class="product__card--action__list d-none">
                                        <a class="product__card--action__btn" title="Quick View" data-bs-toggle="modal" data-bs-target="#examplemodal" href="javascript:void(0)">
                                            <svg class="product__card--action__btn--svg mt-2 mt-md-3 mt-lg-3" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.6952 14.4991L11.7663 10.5588C12.7765 9.4008 13.33 7.94381 13.33 6.42703C13.33 2.88322 10.34 0 6.66499 0C2.98997 0 0 2.88322 0 6.42703C0 9.97085 2.98997 12.8541 6.66499 12.8541C8.04464 12.8541 9.35938 12.4528 10.4834 11.6911L14.4422 15.6613C14.6076 15.827 14.8302 15.9184 15.0687 15.9184C15.2944 15.9184 15.5086 15.8354 15.6711 15.6845C16.0166 15.364 16.0276 14.8325 15.6952 14.4991ZM6.66499 1.67662C9.38141 1.67662 11.5913 3.8076 11.5913 6.42703C11.5913 9.04647 9.38141 11.1775 6.66499 11.1775C3.94857 11.1775 1.73869 9.04647 1.73869 6.42703C1.73869 3.8076 3.94857 1.67662 6.66499 1.67662Z" fill="currentColor"></path>
                                            </svg>
                                            <span class="visually-hidden">Quick View</span>
                                        </a>
                                    </li>
                                    <li class="product__card--action__list">
                                        <a class="product__card--action__btn" title="Wishlist" href="javascript:void(0)" onclick="addToWishList('{{ $product->id }}')">
                                            <svg class="product__card--action__btn--svg mt-2 mt-md-3 mt-lg-3" width="18" height="18" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z" fill="currentColor" />
                                            </svg>
                                            <span class="visually-hidden">Wishlist</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__card--content text-center">
                                <ul class="rating product__card--rating d-flex justify-content-center">
                                    @for ($i=0; $i < $product->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    @for ($i=0; $i < 5-$product->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    <li>
                                        <span class="rating__review--text">({{$product->rating_counting}}) Review</span>
                                    </li>
                                </ul>
                                <h3 class="product__card--title"><a href="{{$product_url}}">{{ $product->getTranslation('name')  }} </a></h3>
                                <div class="product__card--price">
                                    @if($product->auction_product == 0)
                                        <span class="current__price">{{ home_discounted_base_price($product) }}</span>
                                    
                                        @if(home_discounted_base_price($product) != home_base_price($product))
                                            <span class="old__price">{{ home_base_price($product) }}</span>
                                        @endif
                                    @endif
                                    <!-- Discount percentage tag  -->
                                    @if(discount_in_percentage($product) > 0)
                                    <span class="product__badge">-{{discount_in_percentage($product)}}% off</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product__add--to__card">
                                <button class="add-to-cart-btn"
                                    onclick="showAddToCartModal('{{ $product->id }}')">
                                    Add to Cart
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div class="swiper__nav--btn swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                <div class="swiper__nav--btn swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- End product section -->

    <!-- Start product section -->
    @if($top_sale_products->count() != 0)
    <section class="product__section section--padding ">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">TOP SALE PRODUCTS</h2>
            </div>

            <div class="product__section--inner">
                <div class="row mb--n30">
                    @foreach($top_sale_products as $sp)
                    @php
                    $producturl = route('product', $sp->slug);
                    if($sp->auction_product == 1) {
                    $producturl = route('auction-product', $sp->slug);
                    }
                    @endphp
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 custom-col mb-30">
                        <article class="product__card">

                            <div class="product__card--thumbnail">
                                <a class="product__card--thumbnail__link display-block" href="{{$producturl}}">

                                    <img class="product__card--thumbnail__img product__primary--img" src="{{ uploaded_asset($sp->thumbnail_img) }}" alt="product-img">
                                    <img class="product__card--thumbnail__img product__secondary--img" src="{{ uploaded_asset($sp->thumbnail_img) }}" alt="product-img">
                                </a>
                                <ul class="product__card--action">
                                    <li class="product__card--action__list">
                                        <a class="product__card--action__btn" title="Wishlist" href="javascript:void(0)" onclick="addToWishList('{{ $sp->id }}')">
                                            <svg class="product__card--action__btn--svg mt-2 mt-md-3 mt-lg-3" width="18" height="18" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z" fill="currentColor" />
                                            </svg>
                                            <span class="visually-hidden">Wishlist</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__card--content text-center">
                                <ul class="rating product__card--rating d-flex justify-content-center">
                                    @for ($i=0; $i < $sp->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    @for ($i=0; $i < 5-$sp->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    <li>
                                        <span class="rating__review--text">({{$sp->rating_counting}}) Review</span>
                                    </li>
                                </ul>
                                <h3 class="product__card--title"><a href="{{$producturl}}">{{ $sp->getTranslation('name')  }}</a></h3>
                                <div class="product__card--price">
                                    @if($sp->auction_product == 0)
                                    <span class="current__price">{{ home_discounted_base_price($sp) }}</span>@endif
                                    @if($sp->auction_product == 0)
                                    <span class="old__price"> {{ home_base_price($sp) }}</span>@endif
                                    <!-- Discount percentage tag  -->
                                    @if(discount_in_percentage($sp) > 0)
                                    <span class="product__badge">-{{discount_in_percentage($sp)}}% off</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product__add--to__card">
                                <button class="add-to-cart-btn"
                                    onclick="showAddToCartModal('{{ $product->id }}')">
                                    Add to Cart
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </div>
                        </article>
                    </div>@endforeach

                </div>
                <div class="product__load--more text-center">
                    <a class="load__more--btn primary__btn" href="{{route('search')}}">All Products</a>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- End product section -->

    @if (count($perfumebyparvazproduct) > 0)
    <section class="product__section section--padding pt-0">
        <div class="container-fluid" style="padding: 0 3%;">
            <div class="row align-items-stretch">
                <!-- Left Title Banner -->
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0 d-flex flex-column align-items-center justify-content-center" style="background-color: #f8f9fb; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'#e6e6e6\' fill-opacity=\'0.6\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); border-radius: 12px; min-height: 300px;">
                    <h2 class="section__heading--maintitle text-center" style="font-size: 26px; margin-bottom: 15px; color: #222;">PERFUMES BY PARVEZ</h2>

                </div>
                <!-- Right Slider -->
                <div class="col-lg-9 col-md-8">
                    <div class="product__section--inner product__swiper--column4 swiper" style="padding-left: 15px;">
                <div class="swiper-wrapper">
                    @foreach($perfumebyparvazproduct as $product)
                    @php
                    $product_url = route('product', $product->slug);
                    if($product->auction_product == 1) {
                    $product_url = route('auction-product', $product->slug);
                    }
                    @endphp
                    <div class="swiper-slide">
                        <article class="product__card">
                            <div class="product__card--thumbnail">
                                <a class="product__card--thumbnail__link display-block" href="{{$product_url}}">
                                    <img class="product__card--thumbnail__img product__primary--img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                    <img class="product__card--thumbnail__img product__secondary--img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                </a>
                                
                                @if ($product->wholesale_product)
                                <span class="product__badge" style="background-color: #455a64; @if(discount_in_percentage($product) > 0) top:25px;@endif">
                                    {{ translate('Wholesale') }}
                                </span>
                                @endif
                                <ul class="product__card--action">
                                    <li class="product__card--action__list">
                                        <a class="product__card--action__btn" title="Wishlist" href="javascript:void(0)" onclick="addToWishList('{{ $product->id }}')">
                                            <svg class="product__card--action__btn--svg mt-2 mt-md-3 mt-lg-3" width="18" height="18" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z" fill="currentColor" />
                                            </svg>
                                            <span class="visually-hidden">Wishlist</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__card--content text-center">
                                <ul class="rating product__card--rating d-flex justify-content-center">
                                    @for ($i=0; $i < $product->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    @for ($i=0; $i < 5-$product->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    <li>
                                        <span class="rating__review--text">({{$product->rating_counting}}) Review</span>
                                    </li>
                                </ul>
                                <h3 class="product__card--title"><a href="{{$product_url}}">{{ $product->getTranslation('name')  }} </a></h3>
                                <div class="product__card--price">
                                    @if($product->auction_product == 0)
                                        <span class="current__price">{{ home_discounted_base_price($product) }}</span>
                                    
                                        @if(home_discounted_base_price($product) != home_base_price($product))
                                            <span class="old__price">{{ home_base_price($product) }}</span>
                                        @endif
                                    @endif
                                    @if(discount_in_percentage($product) > 0)
                                    <span class="product__badge">-{{discount_in_percentage($product)}}% off</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product__add--to__card">
                                <button class="add-to-cart-btn"
                                    onclick="showAddToCartModal('{{ $product->id }}')">
                                    Add to Cart
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div class="swiper__nav--btn swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                <div class="swiper__nav--btn swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if (count($perfumeproduct) > 0)
    <section class="product__section section--padding pt-0">
        <div class="container-fluid" style="padding: 0 3%;">
            <div class="row align-items-stretch">
                <!-- Left Title Banner -->
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0 d-flex flex-column align-items-center justify-content-center" style="background-color: #f8f9fb; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'#e6e6e6\' fill-opacity=\'0.6\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); border-radius: 12px; min-height: 300px;">
                    <h2 class="section__heading--maintitle text-center" style="font-size: 26px; margin-bottom: 15px; color: #222;">PERFUME</h2>

                </div>
                <!-- Right Slider -->
                <div class="col-lg-9 col-md-8">
                    <div class="product__section--inner product__swiper--column4 swiper" style="padding-left: 15px;">
                <div class="swiper-wrapper">
                    @foreach($perfumeproduct as $product)
                    @php
                    $product_url = route('product', $product->slug);
                    if($product->auction_product == 1) {
                    $product_url = route('auction-product', $product->slug);
                    }
                    @endphp
                    <div class="swiper-slide">
                        <article class="product__card">
                            <div class="product__card--thumbnail">
                                <a class="product__card--thumbnail__link display-block" href="{{$product_url}}">
                                    <img class="product__card--thumbnail__img product__primary--img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                    <img class="product__card--thumbnail__img product__secondary--img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                </a>
                                
                                @if ($product->wholesale_product)
                                <span class="product__badge" style="background-color: #455a64; @if(discount_in_percentage($product) > 0) top:25px;@endif">
                                    {{ translate('Wholesale') }}
                                </span>
                                @endif
                                <ul class="product__card--action">
                                    <li class="product__card--action__list">
                                        <a class="product__card--action__btn" title="Wishlist" href="javascript:void(0)" onclick="addToWishList('{{ $product->id }}')">
                                            <svg class="product__card--action__btn--svg mt-2 mt-md-3 mt-lg-3" width="18" height="18" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z" fill="currentColor" />
                                            </svg>
                                            <span class="visually-hidden">Wishlist</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__card--content text-center">
                                <ul class="rating product__card--rating d-flex justify-content-center">
                                    @for ($i=0; $i < $product->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    @for ($i=0; $i < 5-$product->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    <li>
                                        <span class="rating__review--text">({{$product->rating_counting}}) Review</span>
                                    </li>
                                </ul>
                                <h3 class="product__card--title"><a href="{{$product_url}}">{{ $product->getTranslation('name')  }} </a></h3>
                                <div class="product__card--price">
                                    @if($product->auction_product == 0)
                                        <span class="current__price">{{ home_discounted_base_price($product) }}</span>
                                    
                                        @if(home_discounted_base_price($product) != home_base_price($product))
                                            <span class="old__price">{{ home_base_price($product) }}</span>
                                        @endif
                                    @endif
                                    @if(discount_in_percentage($product) > 0)
                                    <span class="product__badge">-{{discount_in_percentage($product)}}% off</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product__add--to__card">
                                <button class="add-to-cart-btn"
                                    onclick="showAddToCartModal('{{ $product->id }}')">
                                    Add to Cart
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div class="swiper__nav--btn swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                <div class="swiper__nav--btn swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif


    @if (count($atherproduct) > 0)
    <section class="product__section section--padding pt-0">
        <div class="container-fluid" style="padding: 0 3%;">
            <div class="row align-items-stretch">
                <!-- Left Title Banner -->
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0 d-flex flex-column align-items-center justify-content-center" style="background-color: #f8f9fb; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'#e6e6e6\' fill-opacity=\'0.6\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); border-radius: 12px; min-height: 300px;">
                    <h2 class="section__heading--maintitle text-center" style="font-size: 26px; margin-bottom: 15px; color: #222;">ATTAR</h2>

                </div>
                <!-- Right Slider -->
                <div class="col-lg-9 col-md-8">
                    <div class="product__section--inner product__swiper--column4 swiper" style="padding-left: 15px;">
                <div class="swiper-wrapper">
                    @foreach($atherproduct as $product)
                    @php
                    $product_url = route('product', $product->slug);
                    if($product->auction_product == 1) {
                    $product_url = route('auction-product', $product->slug);
                    }
                    @endphp
                    <div class="swiper-slide">
                        <article class="product__card">
                            <div class="product__card--thumbnail">
                                <a class="product__card--thumbnail__link display-block" href="{{$product_url}}">
                                    <img class="product__card--thumbnail__img product__primary--img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                    <img class="product__card--thumbnail__img product__secondary--img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                </a>
                                
                                @if ($product->wholesale_product)
                                <span class="product__badge" style="background-color: #455a64; @if(discount_in_percentage($product) > 0) top:25px;@endif">
                                    {{ translate('Wholesale') }}
                                </span>
                                @endif
                                <ul class="product__card--action">
                                    <li class="product__card--action__list">
                                        <a class="product__card--action__btn" title="Wishlist" href="javascript:void(0)" onclick="addToWishList('{{ $product->id }}')">
                                            <svg class="product__card--action__btn--svg mt-2 mt-md-3 mt-lg-3" width="18" height="18" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z" fill="currentColor" />
                                            </svg>
                                            <span class="visually-hidden">Wishlist</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__card--content text-center">
                                <ul class="rating product__card--rating d-flex justify-content-center">
                                    @for ($i=0; $i < $product->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    @for ($i=0; $i < 5-$product->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    <li>
                                        <span class="rating__review--text">({{$product->rating_counting}}) Review</span>
                                    </li>
                                </ul>
                                <h3 class="product__card--title"><a href="{{$product_url}}">{{ $product->getTranslation('name')  }} </a></h3>
                                <div class="product__card--price">
                                    @if($product->auction_product == 0)
                                        <span class="current__price">{{ home_discounted_base_price($product) }}</span>
                                    
                                        @if(home_discounted_base_price($product) != home_base_price($product))
                                            <span class="old__price">{{ home_base_price($product) }}</span>
                                        @endif
                                    @endif
                                    @if(discount_in_percentage($product) > 0)
                                    <span class="product__badge">-{{discount_in_percentage($product)}}% off</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product__add--to__card">
                                <button class="add-to-cart-btn"
                                    onclick="showAddToCartModal('{{ $product->id }}')">
                                    Add to Cart
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div class="swiper__nav--btn swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                <div class="swiper__nav--btn swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif






    @if (count($goldattarbottelproduct) > 0)
    <section class="product__section section--padding pt-0">
        <div class="container-fluid" style="padding: 0 3%;">
            <div class="row align-items-stretch">
                <!-- Left Title Banner -->
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0 d-flex flex-column align-items-center justify-content-center" style="background-color: #f8f9fb; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'#e6e6e6\' fill-opacity=\'0.6\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); border-radius: 12px; min-height: 300px;">
                    <h2 class="section__heading--maintitle text-center" style="font-size: 26px; margin-bottom: 15px; color: #222;">Gold Attar Bottle</h2>

                </div>
                <!-- Right Slider -->
                <div class="col-lg-9 col-md-8">
                    <div class="product__section--inner product__swiper--column4 swiper" style="padding-left: 15px;">
                <div class="swiper-wrapper">
                    @foreach($goldattarbottelproduct as $product)
                    @php
                    $product_url = route('product', $product->slug);
                    if($product->auction_product == 1) {
                    $product_url = route('auction-product', $product->slug);
                    }
                    @endphp
                    <div class="swiper-slide">
                        <article class="product__card">
                            <div class="product__card--thumbnail">
                                <a class="product__card--thumbnail__link display-block" href="{{$product_url}}">
                                    <img class="product__card--thumbnail__img product__primary--img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                    <img class="product__card--thumbnail__img product__secondary--img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}" title="{{  $product->getTranslation('name')  }}">
                                </a>
                                
                                @if ($product->wholesale_product)
                                <span class="product__badge" style="background-color: #455a64; @if(discount_in_percentage($product) > 0) top:25px;@endif">
                                    {{ translate('Wholesale') }}
                                </span>
                                @endif
                                <ul class="product__card--action">
                                    <li class="product__card--action__list">
                                        <a class="product__card--action__btn" title="Wishlist" href="javascript:void(0)" onclick="addToWishList('{{ $product->id }}')">
                                            <svg class="product__card--action__btn--svg mt-2 mt-md-3 mt-lg-3" width="18" height="18" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z" fill="currentColor" />
                                            </svg>
                                            <span class="visually-hidden">Wishlist</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__card--content text-center">
                                <ul class="rating product__card--rating d-flex justify-content-center">
                                    @for ($i=0; $i < $product->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    @for ($i=0; $i < 5-$product->review_rating; $i++)
                                        <li class="rating__list">
                                            <span class="rating__icon">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                    <li>
                                        <span class="rating__review--text">({{$product->rating_counting}}) Review</span>
                                    </li>
                                </ul>
                                <h3 class="product__card--title"><a href="{{$product_url}}">{{ $product->getTranslation('name')  }} </a></h3>
                                <div class="product__card--price">
                                    @if($product->auction_product == 0)
                                        <span class="current__price">{{ home_discounted_base_price($product) }}</span>
                                    
                                        @if(home_discounted_base_price($product) != home_base_price($product))
                                            <span class="old__price">{{ home_base_price($product) }}</span>
                                        @endif
                                    @endif
                                    @if(discount_in_percentage($product) > 0)
                                    <span class="product__badge">-{{discount_in_percentage($product)}}% off</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product__add--to__card">
                                <button class="add-to-cart-btn"
                                    onclick="showAddToCartModal('{{ $product->id }}')">
                                    Add to Cart
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div class="swiper__nav--btn swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                <div class="swiper__nav--btn swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Start instagram section -->
    @if($customer_showcase->count() != null)
    <section class="instagram__section section--padding">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">Customer <span class="text__secondary" style="font-size: 30px;">Showcase</span></h2>
            </div>
            <div class="instagram__inner instagram__swiper--activation swiper">
                <div class="swiper-wrapper">
                    @foreach($customer_showcase as $showcase)
                    <div class="swiper-slide">
                        <div class="instagram__thumbnail position-relative">
                            <a class="instagram__thumbnail--link" target="_blank" href="#">
                                <img class="instagram__thumbnail--img" src="{{uploaded_asset($showcase->showcase_image)}}" alt="">
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper__nav--btn swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                <div class="swiper__nav--btn swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- End instagram section -->

    <!-- Start banner advice section -->
    <section class="advice__banner--section section--padding pt-0">
        <div class="advice__banner--box position-relative">
            <img class="advice__banner--thumbnail height_260 border-radius-5" src="{{static_asset('public/assets/webtheme/user/assets/img/banner/banner-fullwidth5.webp')}}" alt="banner">
            <div class="advice__banner--content style2">
                <h2 class="advice__banner--title">Flat 50% Off On Fresh Perfumes</h2>
                <p class="advice__banner--desc mb-30">50% OFF on the most popular al-noman brands. Order all classy products today!
                </p>
                <a class="advice__banner--btn primary__btn" href="{{route('search')}}">SHOP NOW</a>
            </div>
        </div>
    </section>
    <!-- End banner advice section -->

    <!-- Start Reels Section  -->
    @if (count($products_with_video) > 0)
    <section class="section product-slider section--padding">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">Influencer Approved</h2>
            </div>
            <div class="swiper influencerSwiper">
                <div class="swiper-wrapper">
                    @foreach($products_with_video as $product)    
                    @php
                    $product_url = route('product', $product->slug);
                    if($product->auction_product == 1) {
                        $product_url = route('auction-product', $product->slug);
                    }
                    @endphp
                    <div class="swiper-slide video_box">
                        <div class="product-box">
                            <div class="product-image">
                                <a href="{{$product_url}}" class="product-img">
                                    <video loop muted autoplay playsinline>
                                        <source src="{{ uploaded_asset($product->video_item) }}" type="video/mp4">
                                    </video>
                                    <div class="influencer-thumb">
                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{  $product->getTranslation('name')  }}">
                                    </div>
                                </a>
                            </div>
                            <div class="product-details">
                                <h3 class="product__card--title">
                                    <a href="{{$product_url}}">{{  $product->getTranslation('name')  }}</a>
                                </h3>
                                @if($product->auction_product == 0)
                                <span class="current__price">{{ home_discounted_base_price($product) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper__nav--btn swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                <div class="swiper__nav--btn swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- End Reels Section  -->

    <!-- Start blog section -->
    @if(count($blogs) != 0)
    <section class="blog__section section--padding pt-0 mb-40">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">From The Blogs</h2>
            </div>

            <div class="blog__section--inner">

                <div class="row">
                    @foreach($blogs as $bl)

                    <div class="col-lg-4">
                        <article class="blog__card">
                            <div class="blog__card--thumbnail">
                                <a class="blog__card--thumbnail__link" href="{{ url("blog").'/'. $bl->slug }}">
                                    <img class="blog__card--thumbnail__img" src="{{uploaded_asset($bl->banner)}}" alt="blog-img" style="    height: 300px;">
                                </a>
                            </div>
                            <div class="blog__card--content blog__sticky--content">
                                <div class="blog__meta">
                                    <!--<span class="blog__meta--text">ROBERT SMITH</span> -->
                                </div>
                                <h3 class="blog__card--title"><a href="{{ url("blog").'/'. $bl->slug }}">{{ $bl->title }}</a></h3>
                                <a class="blog__card--link" href="{{ url("blog").'/'. $bl->slug }}">Read More</a>
                            </div>
                        </article>
                    </div>

                    @endforeach
                </div>

            </div>
        </div>
    </section>
    @endif
    <!-- End blog section -->

    @php
    $testimonials = App\Models\Testimonial::where('status',1)->get();
    @endphp
    <!-- Start testimonial section -->
    @if($testimonials->count() > 0)
    <section class="testimonial__section  section--padding">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">What Clients Are Saying</h2>
            </div>
            <div class="testimonial__section--inner testimonial__swiper--activation swiper">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $test)
                    <div class="swiper-slide">
                        <div class="testimonial__items">
                            <div class="testimonial__author d-flex align-items-center">
                                <div class="testimonial__author__thumbnail">
                                    <img src="{{uploaded_asset($test->photos)}}" width="80px" alt="testimonial-img">
                                </div>
                                <div class="testimonial__author--text">
                                    <h3 class="testimonial__author--title">{{$test->name}}</h3>
                                    <span class="testimonial__author--subtitle">{{$test->designation}}</span>
                                    <ul class="rating testimonial__rating d-flex">
                                        @for ($i=0; $i < $test->rating; $i++)
                                            <li class="rating__list">
                                                <span class="rating__icon">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </li>
                                            @endfor
                                            @for ($i=0; $i < 5-$test->rating; $i++)
                                                <li class="rating__list">
                                                    <span class="rating__icon">
                                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </li>
                                                @endfor
                                    </ul>
                                </div>
                            </div>
                            <div class="testimonial__content">
                                <p class="testimonial__desc"> {{$test->comment}} </p>
                                <img class="testimonial__vector--icon" src="{{static_asset('public/assets/webtheme/user/assets/img/icon/vector-icon.webp')}}" alt="icon">
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="testimonial__pagination swiper-pagination"></div>
            </div>
        </div>
    </section>
    @endif
    <!-- End testimonial section -->

    <!-- Start brand story section -->
    <section class="feature__section section--padding" style="background: #faf8f5;">
        <div class="container" style="max-width: 960px;">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle" style="font-size: 3.2rem; font-weight: 700; color: #061738; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 0.5rem;">Brand Story</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 mb-4 mb-lg-0 text-center">
                    <h3 style="font-size: 2rem; font-weight: 600; color: #b8892e; line-height: 1.4; margin-bottom: 2.5rem; letter-spacing: 0.5px;">SHIRIN: A Legacy of Craftsmanship, A Future of Elegance</h3>
                    <p style="font-size: 1.6rem; font-weight: 400; color: #555; line-height: 1.8; letter-spacing: 0.3px; max-width: 820px; margin: 0 auto 1.8rem;">
                        SHIRIN was born from a rich family heritage, where the art of making exquisite costume jewellery has been passed down through generations. Our story is one of timeless craftsmanship, rooted in the skills and traditions of our fore grandparents, who spent decades perfecting their craft.
                    </p>
                    <p style="font-size: 1.6rem; font-weight: 400; color: #555; line-height: 1.8; letter-spacing: 0.3px; max-width: 820px; margin: 0 auto 1.8rem;">
                        Each piece is crafted with the utmost attention to detail, using the highest quality materials to replicate the look and feel of fine jewellery. We are committed to delivering unmatched quality—designs that are not only beautiful but also affordable, giving our customers a taste of luxury without compromise.
                    </p>
                    <p style="font-size: 1.6rem; font-weight: 400; color: #555; line-height: 1.8; letter-spacing: 0.3px; max-width: 820px; margin: 0 auto 0;">
                        At SHIRIN, we carry forward a tradition of artistry, but we're also forging new paths—creating jewellery that feels timeless yet fresh, bringing the past into the present, and continuing our family's dedication to beauty, quality, and craftsmanship.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End brand story section -->

    <!-- Start why trust us section -->
    <section class="feature__section section--padding" style="padding:60px 0; background: #fff;">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">Why Trust Us?</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-4 col-6 text-center mb-30">
                    <div style="background:#faf8f5; border-radius:20px; padding:30px 15px; height:100%;">
                        <i class="fa-solid fa-certificate" style="font-size:40px; color:#b8892e; margin-bottom:15px;"></i>
                        <h4 style="font-size:15px; font-weight:600; color:#333; margin:0;">Certified<br>Authenticity</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 text-center mb-30">
                    <div style="background:#faf8f5; border-radius:20px; padding:30px 15px; height:100%;">
                        <i class="fa-solid fa-lock" style="font-size:40px; color:#b8892e; margin-bottom:15px;"></i>
                        <h4 style="font-size:15px; font-weight:600; color:#333; margin:0;">Secure<br>Payment Gateways</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 text-center mb-30">
                    <div style="background:#faf8f5; border-radius:20px; padding:30px 15px; height:100%;">
                        <i class="fa-solid fa-undo" style="font-size:40px; color:#b8892e; margin-bottom:15px;"></i>
                        <h4 style="font-size:15px; font-weight:600; color:#333; margin:0;">Transparent<br>Returns & Warranties</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 text-center mb-30">
                    <div style="background:#faf8f5; border-radius:20px; padding:30px 15px; height:100%;">
                        <i class="fa-solid fa-star" style="font-size:40px; color:#b8892e; margin-bottom:15px;"></i>
                        <h4 style="font-size:15px; font-weight:600; color:#333; margin:0;">Verified<br>Customer Reviews</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 text-center mb-30">
                    <div style="background:#faf8f5; border-radius:20px; padding:30px 15px; height:100%;">
                        <i class="fa-solid fa-truck" style="font-size:40px; color:#b8892e; margin-bottom:15px;"></i>
                        <h4 style="font-size:15px; font-weight:600; color:#333; margin:0;">Insured &<br>Trackable Shipping</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 text-center mb-30">
                    <div style="background:#faf8f5; border-radius:20px; padding:30px 15px; height:100%;">
                        <i class="fa-solid fa-headset" style="font-size:40px; color:#b8892e; margin-bottom:15px;"></i>
                        <h4 style="font-size:15px; font-weight:600; color:#333; margin:0;">Responsive<br>Customer Support</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End why trust us section -->

    <style>
        .counterup__banner__bg2:before {
            background: none;
        }
    </style>



</main>
@endsection

<style>
    .instagram-media p {
        display: none !important;
    }

    .instagram-media {
        margin: 0 !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }

    .instagram-media iframe {
        width: 100% !important;
        min-height: 480px !important;
    }

    /* for video section  */
    .video_box {
        padding: 0px;
    }

    .video_box .product-box {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .video_box .product-image {
        position: relative;
        height: 420px;
        overflow: hidden;
    }

    .video_box video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* influencer small image */
    .influencer-thumb {
        position: absolute;
        bottom: 10px;
        left: 10px;
        width: 48px;
        height: 48px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid #fff;
        background: #fff;
    }

    .influencer-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* product text */
    .product-details {
        padding: 10px 12px 14px;
        text-align: center;
    }

    .current__price {
        font-weight: 600;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper(".shop__collection--column5", {
            slidesPerView: 5,
            spaceBetween: 30,
            loop: true,
            speed: 800,

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            breakpoints: {
                0: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                576: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 4,
                },
                1200: {
                    slidesPerView: 6,
                }
            }
        });

        // product swiper clumn4 activation
        var swiper = new Swiper(".product__swiper--column4", {
            slidesPerView: 4,
            loop: true,
            clickable: true,
            spaceBetween: 30,
            breakpoints: {
                1200: {
                    slidesPerView: 4,
                },
                992: {
                    slidesPerView: 4,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                480: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                0: {
                    slidesPerView: 1,
                },
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        // instagram swiper activation
        var swiper = new Swiper(".instagram__swiper--activation", {
            slidesPerView: 5,
            loop: true,
            clickable: true,
            spaceBetween: 32,
            breakpoints: {
                992: {
                    slidesPerView: 5,
                    spaceBetween: 32,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                576: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                0: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        // instagram reel swiper activation
        var swiper = new Swiper(".instagramReelsSwiper", {
            slidesPerView: 5,
            loop: true,
            clickable: true,
            spaceBetween: 32,
            breakpoints: {
                992: {
                    slidesPerView: 4,
                    spaceBetween: 32,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                576: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                0: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        // influencer swiper activation
        var swiper = new Swiper(".influencerSwiper", {
            slidesPerView: 5,
            loop: true,
            clickable: true,
            spaceBetween: 20,
            breakpoints: {
                992: {
                    slidesPerView: 5,
                },
                768: {
                    slidesPerView: 4,
                },
                576: {
                    slidesPerView: 3,
                },
                0: {
                    slidesPerView: 2,
                },
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

    });
</script>

<script async src="https://www.instagram.com/embed.js"></script>
