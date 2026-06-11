<div class="modal-body quickview-modal-body">

    @php
        $photos = explode(',', $product->photos);
    @endphp

    <div class="row g-4 align-items-start">

        <!-- =======================
             LEFT SIDE IMAGE SECTION
        ======================== -->
        <div class="col-12 col-lg-6">

            <div class="quickview__gallery js-quickview-gallery">

                <!-- MAIN IMAGE -->
                <div class="product__media--preview swiper">

                    <div class="swiper-wrapper">

                        @foreach ($photos as $photo)
                            <div class="swiper-slide">

                                <div class="product__media--preview__items">

                                    <a class="product__media--preview__items--link glightbox"
                                        href="{{ uploaded_asset($photo) }}" data-gallery="product-media-preview">

                                        <img class="product__media--preview__items--img"
                                            src="{{ uploaded_asset($photo) }}" alt="product"
                                            onerror="this.src='{{ static_asset('public/assets/img/placeholder.jpg') }}'">

                                    </a>

                                </div>

                            </div>
                        @endforeach

                        @foreach ($product->stocks as $stock)
                            @if ($stock->image != null)
                                <div class="swiper-slide">

                                    <div class="product__media--preview__items">

                                        <a class="product__media--preview__items--link glightbox"
                                            href="{{ uploaded_asset($stock->image) }}"
                                            data-gallery="product-media-preview">

                                            <img class="product__media--preview__items--img"
                                                src="{{ uploaded_asset($stock->image) }}" alt="product"
                                                onerror="this.src='{{ static_asset('public/assets/img/placeholder.jpg') }}'">

                                        </a>

                                    </div>

                                </div>
                            @endif
                        @endforeach

                    </div>

                </div>

                <!-- THUMBNAILS -->
                <div class="product__media--nav swiper mt-3">

                    <div class="swiper-wrapper">

                        @foreach ($photos as $photo)
                            <div class="swiper-slide">

                                <div class="product__media--nav__items">

                                    <img class="product__media--nav__items--img" src="{{ uploaded_asset($photo) }}"
                                        alt="thumb"
                                        onerror="this.src='{{ static_asset('public/assets/img/placeholder.jpg') }}'">

                                </div>

                            </div>
                        @endforeach

                        @foreach ($product->stocks as $stock)
                            @if ($stock->image != null)
                                <div class="swiper-slide">

                                    <div class="product__media--nav__items">

                                        <img class="product__media--nav__items--img"
                                            src="{{ uploaded_asset($stock->image) }}" alt="thumb"
                                            onerror="this.src='{{ static_asset('public/assets/img/placeholder.jpg') }}'">

                                    </div>

                                </div>
                            @endif
                        @endforeach

                    </div>

                    <!-- NAVIGATION -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>

                </div>

            </div>

        </div>

        <!-- =======================
             RIGHT SIDE PRODUCT INFO
        ======================== -->
        <div class="col-12 col-lg-6">

            <div class="quickview__info">

                <form id="option-choice-form">

                    @csrf

                    <input type="hidden" name="id" value="{{ $product->id }}">

                    <!-- PRODUCT TITLE -->
                    <h2 class="product__details--info__title">

                        {{ $product->getTranslation('name') }}

                    </h2>

                    <!-- PRICE -->
                    <div class="product__card--price mb-3">

                        <span class="current__price">

                            {{ home_discounted_price($product) }}

                        </span>

                        @if (home_price($product) != home_discounted_price($product))
                            <span class="old__price">

                                {{ home_price($product) }}

                            </span>
                        @endif

                    </div>

                    <!-- DESCRIPTION -->
                    <p class="product__details--info__desc mb-4">

                        {{ strip_tags($product->short_description) }}

                    </p>

                    <!-- COLORS -->
                    @if (json_decode($product->colors) != null)

                        <div class="product__variant--list mb-4">

                            <fieldset class="variant__input--fieldset">

                                <legend class="product__variant--title mb-2">

                                    {{ translate('Colors') }}

                                </legend>

                                <div class="variant__color">

                                    @foreach (json_decode($product->colors) as $key => $color)
                                        <div class="variant__color--list">

                                            <input type="radio" id="color-{{ $key }}" name="color"
                                                value="{{ $color }}"
                                                @if ($key == 0) checked @endif>

                                            <label class="variant__color--value" for="color-{{ $key }}"
                                                style="background: {{ $color }};">
                                            </label>

                                        </div>
                                    @endforeach

                                </div>

                            </fieldset>

                        </div>

                    @endif

                    <!-- ATTRIBUTES -->
                    @if (json_decode($product->choice_options) != null)

                        @foreach (json_decode($product->choice_options) as $choice)
                            <div class="product__variant--list mb-4">

                                <fieldset class="variant__input--fieldset">

                                    <legend class="product__variant--title mb-2">

                                        {{ \App\Models\Attribute::find($choice->attribute_id)->getTranslation('name') }}

                                    </legend>

                                    <ul class="variant__size">

                                        @foreach ($choice->values as $key => $value)
                                            <li class="variant__size--list">

                                                <input type="radio" name="attribute_id_{{ $choice->attribute_id }}"
                                                    id="attr-{{ $choice->attribute_id }}-{{ $key }}"
                                                    value="{{ $value }}"
                                                    @if ($key == 0) checked @endif>

                                                <label class="variant__attribute--value"
                                                    for="attr-{{ $choice->attribute_id }}-{{ $key }}">

                                                    {{ $value }}

                                                </label>

                                            </li>
                                        @endforeach

                                    </ul>

                                </fieldset>

                            </div>
                        @endforeach

                    @endif

                    <!-- QUANTITY + CART -->
                    <div class="product__variant--list quantity d-flex flex-wrap align-items-center mb-4">

                        <!-- QUANTITY -->
                        <div class="quantity__box">

                            <button type="button" class="quantity__value decrease">

                                -

                            </button>

                            <input type="number" name="quantity" class="quantity__number"
                                value="{{ $product->min_qty }}" min="{{ $product->min_qty }}">

                            <button type="button" class="quantity__value increase">

                                +

                            </button>

                        </div>

                        @php
                            $qty = 0;

                            foreach ($product->stocks as $stock) {
                                $qty += $stock->qty;
                            }
                        @endphp

                        @if ($qty > 0)
                            <button type="button" class="primary__btn quickview__cart--btn" onclick="addToCart()">

                                {{ translate('Add to Cart') }}

                            </button>
                        @else
                            <button type="button" class="btn btn-secondary quickview__cart--btn" disabled>

                                {{ translate('Out of Stock') }}

                            </button>
                        @endif

                    </div>

                    <!-- WISHLIST -->
                    <div class="quickview__variant--list mb-4">

                        <a class="variant__wishlist--icon" href="javascript:void(0)"
                            onclick="addToWishList({{ $product->id }})">

                            {{ translate('Add to Wishlist') }}

                        </a>

                    </div>

                    <!-- SOCIAL -->
                    <!-- =========================
     SOCIAL SHARE SECTION
========================= -->

                    <div class="quickview__social">

                        <label class="quickview__social--title">

                            Social Share:

                        </label>

                        <ul class="quickview__social--wrapper">

                            <!-- FACEBOOK -->
                            <li>

                                <a class="quickview__social--icon" href="https://facebook.com" target="_blank">

                                    Facebook

                                </a>

                            </li>

                            <!-- TWITTER -->
                            <li>

                                <a class="quickview__social--icon" href="https://twitter.com" target="_blank">

                                    Twitter

                                </a>

                            </li>

                            <!-- INSTAGRAM -->
                            <li>

                                <a class="quickview__social--icon" href="https://instagram.com" target="_blank">

                                    Instagram

                                </a>

                            </li>

                            <!-- YOUTUBE -->
                            <li>

                                <a class="quickview__social--icon" href="https://youtube.com" target="_blank">

                                    YouTube

                                </a>

                            </li>

                        </ul>

                    </div>

                    <!-- =========================
     CSS
========================= -->

                    <style>
                        /* =========================================
   SOCIAL
========================================= */

                        .quickview__social {
                            margin-top: 20px;
                        }

                        .quickview__social--title {
                            display: block;
                            font-size: 16px;
                            font-weight: 600;
                            margin-bottom: 12px;
                            color: #222;
                        }

                        /* WRAPPER */

                        .quickview__social--wrapper {
                            display: flex;
                            flex-wrap: wrap;
                            gap: 10px;
                            align-items: center;
                            padding: 0;
                            margin: 0;
                        }

                        /* REMOVE LIST STYLE */

                        .quickview__social--wrapper li {
                            list-style: none;
                        }

                        /* BUTTON */

                        .quickview__social--icon {
                            padding: 10px 16px;
                            border: 1px solid #ddd;
                            border-radius: 6px;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            white-space: nowrap;
                            min-width: 110px;
                            min-height: 42px;
                            font-size: 14px;
                            font-weight: 500;
                            color: #222;
                            text-decoration: none;
                            background: #fff;
                            transition: all 0.3s ease;
                        }

                        /* HOVER */

                        .quickview__social--icon:hover {
                            background: #f5f5f5;
                            border-color: #ccc;
                            color: #000;
                        }

                        /* =========================================
   TABLET
========================================= */

                        @media (max-width: 991px) {

                            .quickview__social--wrapper {
                                gap: 8px;
                            }

                            .quickview__social--icon {
                                min-width: 95px;
                                padding: 9px 14px;
                            }

                        }

                        /* =========================================
   MOBILE
========================================= */

                        @media (max-width: 767px) {

                            .quickview__social {
                                margin-top: 15px;
                            }

                            .quickview__social--title {
                                font-size: 15px;
                                margin-bottom: 10px;
                            }

                            .quickview__social--wrapper {
                                gap: 8px;
                            }

                            .quickview__social--icon {
                                min-width: auto;
                                width: auto;
                                font-size: 13px;
                                padding: 8px 12px;
                                min-height: 38px;
                            }

                        }
                    </style>
                </form>

            </div>

        </div>

    </div>

</div>

<!-- =========================
     CSS
========================= -->

<style>
    /* =========================================
   MODAL
========================================= */

    .modal-dialog {
        max-width: 1100px;
        margin: 1rem auto;
    }

    .modal-content {
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
    }

    .quickview-modal-body {
        padding: 20px;
        overflow-x: hidden;
    }

    /* =========================================
   IMAGE SECTION
========================================= */

    .product__media--preview {
        width: 100%;
        overflow: hidden;
        border-radius: 10px;
    }

    .product__media--preview__items {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f8f8;
        border-radius: 10px;
        height: 450px;
        padding: 15px;
    }

    .product__media--preview__items--img {
        width: 100%;
        max-height: 420px;
        object-fit: contain;
    }

    /* =========================================
   THUMBNAILS
========================================= */

    .product__media--nav {
        margin-top: 15px;
    }

    .product__media--nav__items {
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #eee;
        cursor: pointer;
        background: #fff;
    }

    .product__media--nav__items--img {
        width: 100%;
        height: 90px;
        object-fit: cover;
    }

    /* =========================================
   PRODUCT INFO
========================================= */

    .quickview__info {
        height: 100%;
        overflow: visible !important;
    }

    .product__details--info__title {
        font-size: 28px;
        line-height: 1.4;
        margin-bottom: 15px;
        word-break: break-word;
    }

    .product__details--info__desc {
        line-height: 1.7;
        color: #666;
    }

    /* =========================================
   VARIANTS
========================================= */

    .variant__size,
    .variant__color,
    .quickview__social--wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 0;
        margin: 0;
    }

    .variant__size--list,
    .quickview__social--wrapper li {
        list-style: none;
    }

    .variant__attribute--value {
        min-width: 60px;
        min-height: 45px;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .variant__color--value {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: block;
        border: 2px solid #ddd;
    }

    /* =========================================
   QUANTITY
========================================= */

    .quantity {
        gap: 15px;
    }

    .quantity__box {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    .quantity__value {
        width: 45px;
        height: 45px;
        border: none;
        background: #f5f5f5;
        font-size: 20px;
        font-weight: 600;
    }

    .quantity__number {
        width: 60px;
        height: 45px;
        border: none;
        text-align: center;
        font-size: 18px;
    }

    .quickview__cart--btn {
        min-height: 50px;
        padding: 12px 25px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* =========================================
   SOCIAL
========================================= */

    .quickview__social--icon {
        padding: 8px 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
        display: inline-block;
    }

    /* =========================================
   SWIPER FIX
========================================= */

    .swiper-slide {
        height: auto !important;
    }

    /* =========================================
   MOBILE
========================================= */

    @media (max-width: 767px) {

        .modal-dialog {
            max-width: 100%;
            margin: 0;
            height: 100%;
        }

        .modal-content {
            border-radius: 0;
            max-height: 100vh;
            overflow-y: auto;
        }

        .quickview-modal-body {
            padding: 15px;
        }

        .product__media--preview__items {
            height: 300px;
        }

        .product__media--preview__items--img {
            max-height: 280px;
        }

        .product__media--nav__items--img {
            height: 70px;
        }

        .product__details--info__title {
            font-size: 22px;
        }

        .quantity {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
        }

        .quantity__box {
            width: 100%;
            max-width: 100%;
            justify-content: center;
        }

        .quickview__cart--btn {
            width: 100%;
            display: flex !important;
            min-height: 50px;
            font-size: 16px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            display: none !important;
        }
    }
</style>

<!-- =========================
     SCRIPT
========================= -->

<script>
    $('#option-choice-form input').on('change', function() {
        getVariantPrice();
    });

    /* =========================================
       QUANTITY BUTTON
    ========================================= */

    document.addEventListener("click", function(e) {

        // INCREASE
        if (e.target.classList.contains("increase")) {

            e.preventDefault();

            let box = e.target.closest(".quantity__box");

            let input = box.querySelector("input[type='number']");

            let value = parseInt(input.value) || 1;

            input.value = value + 1;
        }

        // DECREASE
        if (e.target.classList.contains("decrease")) {

            e.preventDefault();

            let box = e.target.closest(".quantity__box");

            let input = box.querySelector("input[type='number']");

            let min = parseInt(input.min) || 1;

            let value = parseInt(input.value) || 1;

            if (value > min) {
                input.value = value - 1;
            }
        }

    });

    /* =========================================
       SWIPER
    ========================================= */

    window.swiperThumbs = null;
    window.swiperPreview = null;

    function initProductModalSwiper(modalElement = document) {

        const gallery = modalElement.querySelector(".js-quickview-gallery");

        if (!gallery) return;

        const navEl = gallery.querySelector(".product__media--nav");

        const previewEl = gallery.querySelector(".product__media--preview");

        if (!navEl || !previewEl) return;

        // DESTROY OLD
        if (window.swiperThumbs) {
            window.swiperThumbs.destroy(true, true);
        }

        if (window.swiperPreview) {
            window.swiperPreview.destroy(true, true);
        }

        // THUMBNAIL SWIPER
        window.swiperThumbs = new Swiper(navEl, {

            loop: false,

            spaceBetween: 10,

            slidesPerView: 4,

            freeMode: true,

            watchSlidesProgress: true,

            slideToClickedSlide: true,

            navigation: {
                nextEl: gallery.querySelector(".swiper-button-next"),
                prevEl: gallery.querySelector(".swiper-button-prev"),
            },

            breakpoints: {

                0: {
                    slidesPerView: 3
                },

                576: {
                    slidesPerView: 4
                },

                768: {
                    slidesPerView: 4
                }

            }

        });

        // MAIN SWIPER
        window.swiperPreview = new Swiper(previewEl, {

            loop: false,

            spaceBetween: 10,

            thumbs: {
                swiper: window.swiperThumbs
            }

        });

    }

    /* =========================================
       MODAL OPEN
    ========================================= */

    $('#addToCart').on('shown.bs.modal', function() {

        initProductModalSwiper();

        if (window.swiperThumbs) {
            window.swiperThumbs.update();
        }

        if (window.swiperPreview) {
            window.swiperPreview.update();
        }

    });
</script>
