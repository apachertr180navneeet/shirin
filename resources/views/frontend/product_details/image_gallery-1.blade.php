@if($detailedProduct->photos != null)
@php
    $photos = explode(',', $detailedProduct->photos);
@endphp

<div class="product__details--media">

    {{-- ===== Preview Slider ===== --}}
    <div class="single__product--preview bg__gray swiper product__media--preview mb-18">
        <div class="swiper-wrapper">

            {{-- Main product photos --}}
            @foreach ($photos as $photo)
            <div class="swiper-slide">
                <div class="product__media--preview__items">
                    <a class="product__media--preview__items--link glightbox"
                       data-gallery="product-media-preview-{{ $detailedProduct->id }}"
                       href="{{ uploaded_asset($photo) }}">
                        <img class="product__media--preview__items--img"
                             src="{{ uploaded_asset($photo) }}"
                             onerror="this.src='{{ static_asset('public/assets/img/placeholder.jpg') }}'">
                    </a>

                    <div class="product__media--view__icon">
                        <a class="product__media--view__icon--link glightbox"
                           href="{{ uploaded_asset($photo) }}"
                           data-gallery="product-media-preview-{{ $detailedProduct->id }}">
                            <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="22.51" height="22.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path></svg>
                            <span class="visually-hidden">product view</span> 
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Variant images --}}
            @if ($detailedProduct->digital == 0)
                @foreach ($detailedProduct->stocks as $stock)
                    @if ($stock->image)
                    <div class="swiper-slide">
                        <div class="product__media--preview__items">
                            <a class="glightbox"
                               data-gallery="product-media-preview-{{ $detailedProduct->id }}"
                               href="{{ uploaded_asset($stock->image) }}">
                                <img class="product__media--preview__items--img"
                                     src="{{ uploaded_asset($stock->image) }}">
                            </a>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif

        </div>
    </div>

    {{-- ===== Thumbnail Slider ===== --}}
    <div class="single__product--nav swiper product__media--nav">
        <div class="swiper-wrapper">

            @foreach ($photos as $photo)
            <div class="swiper-slide">
                <div class="product__media--nav__items">
                    <img class="product__media--nav__items--img"
                         src="{{ uploaded_asset($photo) }}">
                </div>
            </div>
            @endforeach

            @if ($detailedProduct->digital == 0)
                @foreach ($detailedProduct->stocks as $stock)
                    @if ($stock->image)
                    <div class="swiper-slide">
                        <div class="product__media--nav__items">
                            <img class="product__media--nav__items--img"
                                 src="{{ uploaded_asset($stock->image) }}">
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif

        </div>

        {{-- Navigation --}}
        <div class="swiper__nav--btn swiper-button-next">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
        <div class="swiper__nav--btn swiper-button-prev">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </div>
    </div>

</div>
@endif
