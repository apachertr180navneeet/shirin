@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:price:currency"
        content="{{ \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('content')
    <section class="product__details--section section--padding">
        <div class="container">
            <div class="row">
                <!-- Product Image Gallery -->
                <div class="col-xl-6 col-lg-6 col-md-6">
                    @include('frontend.product_details.image_gallery-1')
                </div>
                <!-- Product Details -->
                <div class="col-xl-6 col-lg-6 col-md-6">
                    @include('frontend.product_details.details-2')
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container">
            @if ($detailedProduct->auction_product)
                <!-- Reviews & Ratings -->
                @include('frontend.product_details.review_section')
                
                <!-- Description, Video, Downloads -->
                @include('frontend.product_details.description')
                
                <!-- Product Query -->
                @include('frontend.product_details.product_queries')
            @else
                <div class="row gutters-16">
                    <!-- Left side -->
                    <div class="col-lg-3">
                        <!-- Seller Info -->
                        @include('frontend.product_details.seller_info')

                        <!-- Top Selling Products -->
                       <div class="d-none d-lg-block">
                            @include('frontend.product_details.top_selling_products-1')
                       </div>
                    </div>

                    <!-- Right side -->
                    <div class="col-lg-9">
                        
                        <!-- Reviews & Ratings -->
                        @include('frontend.product_details.review_section')

                        <!-- Description, Video, Downloads -->
                        @include('frontend.product_details.description')
                        
                        <!-- Related products -->
                        @include('frontend.product_details.related_products-1')

                        <!-- Product Query -->
                        @include('frontend.product_details.product_queries')
                        
                        <!-- Top Selling Products -->
                        <div class="d-lg-none">
                             @include('frontend.product_details.top_selling_products-1')
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Start features section -->
    <section class="features__section" style="background-color: #f7f8fa; padding: 40px 0;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                
                <!-- Free Shipping -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                        <div class="features__icon" style="margin-right: 15px;">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                <line x1="2" y1="12" x2="7" y2="12"></line>
                                <line x1="2" y1="16" x2="5" y2="16"></line>
                                <line x1="2" y1="8" x2="5" y2="8"></line>
                            </svg>
                        </div>
                        <div class="features__content">
                            <h4 class="features__title" style="font-size: 15px; font-weight: 700; margin-bottom: 2px; color: #000;">Free Shipping</h4>
                            <p class="features__desc" style="font-size: 13px; color: #666; margin-bottom: 0;">Free shipping on all orders</p>
                        </div>
                    </div>
                </div>
                
                <!-- Support 24/7 -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                        <div class="features__icon" style="margin-right: 15px;">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </div>
                        <div class="features__content">
                            <h4 class="features__title" style="font-size: 15px; font-weight: 700; margin-bottom: 2px; color: #000;">Support 24/7</h4>
                            <p class="features__desc" style="font-size: 13px; color: #666; margin-bottom: 0;">Contact us 24 hours a day</p>
                        </div>
                    </div>
                </div>
                
                <!-- 100% Money Back -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4 mb-sm-0">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                        <div class="features__icon" style="margin-right: 15px;">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                <path d="M16 16v3a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-3"></path>
                                <polyline points="10 14 8 16 10 18"></polyline>
                            </svg>
                        </div>
                        <div class="features__content">
                            <h4 class="features__title" style="font-size: 15px; font-weight: 700; margin-bottom: 2px; color: #000;">100% Money Back</h4>
                            <p class="features__desc" style="font-size: 13px; color: #666; margin-bottom: 0;">You have 30 days to Return</p>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Secure -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                        <div class="features__icon" style="margin-right: 15px;">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                <circle cx="12" cy="16" r="1"></circle>
                            </svg>
                        </div>
                        <div class="features__content">
                            <h4 class="features__title" style="font-size: 15px; font-weight: 700; margin-bottom: 2px; color: #000;">Payment Secure</h4>
                            <p class="features__desc" style="font-size: 13px; color: #666; margin-bottom: 0;">We ensure secure payment</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- End features section -->

@endsection

@section('modal')
    <!-- Image Modal -->
    <div class="modal fade" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="p-4">
                    <div class="size-300px size-lg-450px">
                        <img class="img-fit h-100 lazyload"
                            src="{{ static_asset('public/assets/img/placeholder.jpg') }}"
                            data-src=""
                            onerror="this.onerror=null;this.src='{{ static_asset('public/assets/img/placeholder.jpg') }}';">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Modal -->
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3 rounded-0" name="title"
                                value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control rounded-0" rows="8" name="message" required
                                placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary fw-600 rounded-0"
                            data-dismiss="modal">{{ translate('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary fw-600 rounded-0 w-100px">{{ translate('Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bid Modal -->
    @if($detailedProduct->auction_product == 1)
        @php 
            $highest_bid = $detailedProduct->bids->max('amount');
            $min_bid_amount = $highest_bid != null ? $highest_bid+1 : $detailedProduct->starting_bid; 
        @endphp
        <div class="modal fade" id="bid_for_detail_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ translate('Bid For Product') }} <small>({{ translate('Min Bid Amount: ').$min_bid_amount }})</small> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="{{ route('auction_product_bids.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                            <div class="form-group">
                                <label class="form-label">
                                    {{translate('Place Bid Price')}}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="form-group">
                                    <input type="number" step="0.01" class="form-control form-control-sm" name="amount" min="{{ $min_bid_amount }}" placeholder="{{ translate('Enter Amount') }}" required>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{ translate('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Product Review Modal -->
    <div class="modal fade" id="product-review-modal">
        <div class="modal-dialog">
            <div class="modal-content" id="product-review-modal-content">

            </div>
        </div>
    </div>
   <style>
        .new-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Modal content */
        .new-modal-content {
            background-color: #f4f4f4;
            padding: 0;
            /* Remove padding to make header stick directly to the content */
            border-radius: 10px;
            max-width: 1200px;
            width: 100%;
            text-align: center;
            overflow-y: auto;
            height: 90%;
            position: relative;
            scrollbar-width: none;
            /* To ensure modal header sticks within modal content */
        }

        /* Modal Header */
        .new-modal-header {
            font-size: 28px;
            /* Increased font size for bigger header */
            font-weight: bold;
            text-align: center;
            background-color: var(--secondary-color);
            /* Example background color */
            color: white;
            /* Text color for contrast */
            padding: 15px 0;
            /* Increased padding for a larger header */
            position: sticky;
            top: 0;
            left: 0;
            /* Ensure it sticks to the left side */
            right: 0;
            /* Ensure it sticks to the right side */
            z-index: 10;
            /* Ensure it stays above other content when scrolling */
            margin: 0;
            /* Remove any margin */
            border-radius: 10px 10px 0 0;
            /* Optional: Add rounded top corners */
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .new-modal-header .new-close-btn {
            position: absolute;
            left: 20px;
            /* Adjust as needed for left alignment */
            bottom: 8px;
            background-color: #ffffff12;
            border: none;
            color: white;
            font-size: 23px;
            /* Cross button size */
            cursor: pointer;
            z-index: 11;
            /* Ensure close button stays above other content */
            /* opacity: 0; */
            transition: opacity 0.2s ease-in-out;
        }

        .new-modal-header .new-close-btn:hover {
            background-color: #ffffff29;
            /* Red color on hover for the close button */
            opacity: 1;
        }

        /* Modal Header */
        .new-header-content {
            font-size: 28px;
            /* Increased font size for bigger header */
            font-weight: bold;
            text-align: center;
            background-color: #bf1347;
            /* Example background color */
            color: white;
            /* Text color for contrast */
            padding: 15px 0;
            /* Increased padding for a larger header */
            position: sticky;
            top: 0;
            left: 0;
            /* Ensure it sticks to the left side */
            right: 0;
            /* Ensure it sticks to the right side */
            z-index: 10;
            /* Ensure it stays above other content when scrolling */
            margin: 0;
            /* Remove any margin */
            border-radius: 10px 10px 0 0;
            /* Optional: Add rounded top corners */
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .new-header-content .new-close-btn {
            position: absolute;
            left: 20px;
            /* Adjust as needed for left alignment */
            bottom: 8px;
            background-color: #ffffff12;
            border: none;
            color: white;
            font-size: 23px;
            /* Cross button size */
            cursor: pointer;
            z-index: 11;
            /* Ensure close button stays above other content */
            /* opacity: 0; */
            transition: opacity 0.2s ease-in-out;
        }

        .new-header-content .new-close-btn:hover {
            background-color: #ffffff29;
            /* Red color on hover for the close button */
            opacity: 1;
        }

        /* Show More Button */
        .show-more-btn {
            background: transparent;
            color: black;
            border: 1px solid #E8E8E8;
            padding: 10px 15px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 8px;
            margin-top: 10px;
            display: inline-block;
            /* Changed from block to inline-block for centering */
            text-align: center;
            /* Ensures text inside the button is centered */
            width: auto;
            /* Adjust width to fit the content */
            margin-left: auto;
            /* Centers the button horizontally */
            margin-right: auto;
            /* Centers the button horizontally */
            margin-bottom: 20px;
        }

        .show-more-btn:hover {
            background-color: #E8E8E8;
        }



        .review-rating-section {
            margin-bottom: 30px;
        }

        .new-rating-title {
            font-size: 20px;
            font-weight: bold;
        }

        .new-total-reviews {
            font-size: 18px;
            margin-top: 5px;
            color: #777;
        }


        .new-reviews-container {
            padding: 15px;
            column-count: 5;
            column-gap: 15px;
            width: 100%;
        }

        .new-review-item {
            cursor: pointer;
            border-radius: 10px;
            overflow: hidden;
            text-align: left;
            width: 100%;
            margin-bottom: 15px;
            break-inside: avoid;
            display: inline-block;
            transition: transform 0.3s;
            background-color: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }

        .new-review-item:hover {
            opacity: 1;
            transform: translateY(-5px);
        }

        /* Initially, hide reviews that are beyond the 12th review */
        .new-reviews-container.revealed {
            max-height: none;
        }

        /* To hide extra reviews initially */
        .new-reviews-container .new-review-item:nth-child(n+13) {
            display: none;
        }

        .new-reviews-container.revealed .new-review-item:nth-child(n+13) {
            display: inline-block;
        }



        .new-review-item img {
            width: 100%;
            height: auto;

        }

        .new-review-item .new-user-details {
            margin-top: 10px;
            font-weight: bold;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            display: flex;
            gap: 0 8px;
            flex-wrap: wrap;
        }

        .new-review-item .new-review-text {
            margin-top: 0px;
            font-style: italic;
            padding: 10px;
            width: auto;
            line-height: 19px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .new-review-item .rating {
            margin-top: 0px;
            font-size: 16px;
            color: #f39c12;
            padding: 0px;
            width: 100%;
        }

        .new-product-info {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            padding: 10px;
        }

        .new-product-info img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }

        .new-product-info div {
            font-weight: 400;
            font-size: 12px;
        }

        .highlighted {
            background-color: #f0f8ff;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
        }

        .new-open-modal-btn {
            position: fixed;
            top: 60%;
            /* Vertical center ke liye */
            right: 0;
            /* Screen ke right side ke liye */
            transform: translateY(-50%);
            /* Exactly center me lane ke liye */
            padding: 8px 12px;
            background-color: var(--secondary-color);
            color: #fff;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
            /*border-radius: 5px;*/
            cursor: pointer;
            text-align: center;
            z-index: 9999;
            /* Ensure button is above other elements */

            writing-mode: vertical-rl;
            /* Text ko vertically dikhane ke liye */
            text-orientation: mixed;
            /* Text orientation fix karne ke liye */
        }


        .new-open-modal-btn:hover {
            background-color: #565951;
        }

        /* Make layout responsive */
        @media (max-width: 1200px) {
            .new-reviews-container {
                column-count: 4;
            }
        }

        @media (max-width: 992px) {
            .new-reviews-container {
                column-count: 3;
            }
        }

    <style>
        .new-review-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .new-review-modal-content {
            background: #fff;
            display: flex;
            width: 50%;
            padding: 20px;
            border-radius: 10px;
            position: relative;
        }

        .review-new-close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .new-product-image img {
            width: 150px;
            border-radius: 10px;
        }

        .new-review-details {
            margin-left: 20px;
        }

        .new-verified {
            font-size: 12px;
            color: green;
            display: flex;
            align-items: center;
        }

        .new-verified::before {
            content: '\2713';
            /* Checkmark icon */
            margin-right: 5px;
        }

        .view-product {
            display: inline-block;
            background: #ff4081;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>


        /* ✅ For tablets and small laptops (max-width: 1024px) */
        @media (max-width: 1024px) {
            .new-modal-content {
                width: 90%;
                height: 80%;
            }

            .new-review-modal-content {
                width: 70%;
                flex-direction: column;
            }

            .new-product-image img {
                width: 120px;
            }

            .new-review-details {
                margin-left: 0;
                margin-top: 10px;
            }

            .new-reviews-container {
                column-count: 3;
            }
        }

        /* ✅ For mobile phones (max-width: 768px) */
        @media (max-width: 768px) {
            .new-modal-content {
                width: 95%;
                height: 85%;
                padding: 0px;
            }

            .new-modal-header {
                font-size: 22px;
                padding: 16px 0;
            }

            .new-reviews-container {
                column-count: 2;
            }

            .new-review-modal-content {
                width: 90%;
                flex-direction: column;
            }

            .new-product-image img {
                width: 100px;
            }

            .new-review-details {
                margin-left: 0;
                margin-top: 10px;
            }
        }

        /* ✅ For small mobile screens (max-width: 480px) */
        @media (max-width: 480px) {
            .new-modal-content {
                width: 95%;
                height: 85%;
                padding: 0px;
            }

            .new-modal-header {
                font-size: 18px;
                padding: 12px 0;
                margin-bottom: 15px;
            }

            .new-reviews-container {
                column-count: 1;
            }

            .new-review-item {
                width: 100%;
            }

            .new-review-modal-content {
                width: 100%;
                flex-direction: column;
                padding: 15px;
            }

            .new-product-image img {
                width: 80px;
            }

            .show-more-btn {
                padding: 8px;
                font-size: 12px;
            }
        }
    </style>

    <button class="new-open-modal-btn" style="border: none;" onclick="openFullPageModal()">⭐ Reviews on Products</button>
    @php
        $add_review = App\Models\AddReview::orderBy('id', 'desc')->where('published',1)->get();
    @endphp
    <div id="reviewModal" class="new-modal">
        <div class="new-modal-content">
            <div class="new-modal-header">
                <button class="new-close-btn" onclick="closeModal()">×</button>
                Reviews Section
            </div>
    
            <div class="new-review-rating-section">
                <div class="new-rating-title">Overall Rating
                    <ul class="rating product__card--rating d-flex justify-content-center" style="margin-left:-10px">
                            @for ($i=0; $i < 4; $i++)
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </li>
                            @endfor
                        </ul>
                </div>
                <div class="new-total-reviews">Total Reviews: {{ $add_review->count() }}</div>
            </div>
            <div id="reviewsSection" class="new-reviews-container">
                
            
                @foreach($add_review as  $rev)
                <div class="new-review-item">
                    @if($rev->customer_image != null)
                        <img src="{{ uploaded_asset($rev->customer_image) }}" alt="Product Image">
                    @else
                        <img class="d-none" src="{{ uploaded_asset($rev->customer_image) }}" alt="Product Image">
					@endif
                    <div class="new-user-details">{{  $rev->getTranslation('customer_name')  }}<span style="display: flex; align-items: center; gap: 4px" class="verified-badge-and-text"><svg style="width: 1.2em; height: 1.2em; vertical-align: middle; flex-shrink: 0; undefined;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M21.007 8.27C22.194 9.125 23 10.45 23 12c0 1.55-.806 2.876-1.993 3.73.24 1.442-.134 2.958-1.227 4.05-1.095 1.095-2.61 1.459-4.046 1.225C14.883 22.196 13.546 23 12 23c-1.55 0-2.878-.807-3.731-1.996-1.438.235-2.954-.128-4.05-1.224-1.095-1.095-1.459-2.611-1.217-4.05C1.816 14.877 1 13.551 1 12s.816-2.878 2.002-3.73c-.242-1.439.122-2.955 1.218-4.05 1.093-1.094 2.61-1.467 4.057-1.227C9.125 1.804 10.453 1 12 1c1.545 0 2.88.803 3.732 1.993 1.442-.24 2.956.135 4.048 1.227 1.093 1.092 1.468 2.608 1.227 4.05Zm-4.426-.084a1 1 0 0 1 .233 1.395l-5 7a1 1 0 0 1-1.521.126l-3-3a1 1 0 0 1 1.414-1.414l2.165 2.165 4.314-6.04a1 1 0 0 1 1.395-.232Z" fill="#000000" />
                            </svg><span style="font-style: normal; font-weight: 400; font-size: 12px; line-height: 18px; white-space: nowrap;">Verified</span></span></div>
                    <div class="rating">
                        <ul class="rating product__card--rating d-flex justify-content-center" style="margin-left:-10px">
                            @for ($i=0; $i < $rev->product->review_rating; $i++)
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </li>
                            @endfor
                            @for ($i=0; $i < 5-$rev->product->review_rating; $i++)
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
                    <div class="new-review-text">{{  $rev->getTranslation('comment')  }}</div>
                    <div class="new-product-info">
                    @if($rev->product->thumbnail_img != null)
                        <img src="{{ uploaded_asset($rev->product->thumbnail_img) }}" alt="Product Image">
                    @else
                        <img class="d-none" src="{{ uploaded_asset($rev->thumbnail_img) }}" alt="Product Image">
					@endif
                        <div>{{  $rev->product->getTranslation('name')  }}</div>
                    </div>
                </div>
                @endforeach

            </div>
            <button id="showMoreBtn" class="show-more-btn" onclick="toggleReviews()">Show More Reviews</button>

        </div>

        
    </div>
@endsection

@section('script')
    <script>
        // Toggle reviews functionality (as we did earlier)
        function toggleReviews() {
            const reviewsSection = document.getElementById('reviewsSection');
            const showMoreBtn = document.getElementById('showMoreBtn');

            reviewsSection.classList.toggle('revealed');

            if (reviewsSection.classList.contains('revealed')) {
                showMoreBtn.textContent = 'Show Less Reviews';
            } else {
                showMoreBtn.textContent = 'Show More Reviews';
            }
        }

        function openFullPageModal() {
            document.getElementById('reviewModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('reviewModal').style.display = 'none';
        }

        const reviewsSection = document.getElementById('reviewsSection');

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            getVariantPrice();
        });

        function CopyToClipboard(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
            } catch (err) {
                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
            }
            $temp.remove();
            // if (document.selection) {
            //     var range = document.body.createTextRange();
            //     range.moveToElementText(document.getElementById(containerid));
            //     range.select().createTextRange();
            //     document.execCommand("Copy");

            // } else if (window.getSelection) {
            //     var range = document.createRange();
            //     document.getElementById(containerid).style.display = "block";
            //     range.selectNode(document.getElementById(containerid));
            //     window.getSelection().addRange(range);
            //     document.execCommand("Copy");
            //     document.getElementById(containerid).style.display = "none";

            // }
            // AIZ.plugins.notify('success', 'Copied');
        }

        function show_chat_modal() {
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }

        // Pagination using ajax
        $(window).on('hashchange', function() {
            if(window.history.pushState) {
                window.history.pushState('', '/', window.location.pathname);
            } else {
                window.location.hash = '';
            }
        });

        $(document).ready(function() {
            $(document).on('click', '.product-queries-pagination .pagination a', function(e) {
                getPaginateData($(this).attr('href').split('page=')[1], 'query', 'queries-area');
                e.preventDefault();
            });
        });

        $(document).ready(function() {
            $(document).on('click', '.product-reviews-pagination .pagination a', function(e) {
                getPaginateData($(this).attr('href').split('page=')[1], 'review', 'reviews-area');
                e.preventDefault();
            });
        });

        function getPaginateData(page, type, section) {
            $.ajax({
                url: '?page=' + page,
                dataType: 'json',
                data: {type: type},
            }).done(function(data) {
                $('.'+section).html(data);
                location.hash = page;
            }).fail(function() {
                alert('Something went worng! Data could not be loaded.');
            });
        }
        // Pagination end

        function showImage(photo) {
            $('#image_modal img').attr('src', photo);
            $('#image_modal img').attr('data-src', photo);
            $('#image_modal').modal('show');
        }

        function bid_modal(){
            @if (Auth::check() && (isCustomer() || isSeller()))
                $('#bid_for_detail_product').modal('show');
          	@elseif (Auth::check() && isAdmin())
                AIZ.plugins.notify('warning', '{{ translate("Sorry, Only customers & Sellers can Bid.") }}');
            @else
                $('#login_modal').modal('show');
            @endif
        }

        function product_review(product_id) {
            @if (Auth::check() && isCustomer())
                @if ($review_status == 1)
                    $.post('{{ route('product_review_modal') }}', {
                        _token: '{{ @csrf_token() }}',
                        product_id: product_id
                    }, function(data) {
                        $('#product-review-modal-content').html(data);
                        $('#product-review-modal').modal('show', {
                            backdrop: 'static'
                        });
                        AIZ.extra.inputRating();
                    });
                @else
                    AIZ.plugins.notify('warning', '{{ translate("Sorry, You need to buy this product to give review.") }}');
                @endif
            @elseif (Auth::check() && !isCustomer())
                AIZ.plugins.notify('warning', '{{ translate("Sorry, Only customers can give review.") }}');
            @else
                $('#login_modal').modal('show');
            @endif
        }
    </script>

     <script>
document.addEventListener("DOMContentLoaded", function () {
    // product swiper clumn4 activation
var swiper = new Swiper(".product__swiper--column4", {
  slidesPerView: 4,
  loop: true,
  clickable: true,
  spaceBetween: 30,
  breakpoints: {
    1200: {
      slidesPerView: 3,
    },
    992: {
      slidesPerView: 3,
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

// single product nav activation
var swiper = new Swiper(".single__product--nav", {
  loop: true,
  spaceBetween: 20,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {
    992: {
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 15,
    },
    480: {
      slidesPerView: 3,
    },
    200: {
      slidesPerView: 2,
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
var swiper2 = new Swiper(".single__product--preview", {
  loop: true,
  spaceBetween: 10,
  thumbs: {
    swiper: swiper,
  },
});

// lightbox Activation
const customLightboxHTML = `<div id="glightbox-body" class="glightbox-container">
    <div class="gloader visible"></div>
    <div class="goverlay"></div>
    <div class="gcontainer">
    <div id="glightbox-slider" class="gslider"></div>
    <button class="gnext gbtn" tabindex="0" aria-label="Next" data-customattribute="example">{nextSVG}</button>
    <button class="gprev gbtn" tabindex="1" aria-label="Previous">{prevSVG}</button>
    <button class="gclose gbtn" tabindex="2" aria-label="Close">{closeSVG}</button>
    </div>
    </div>`;
const lightbox = GLightbox({
  touchNavigation: true,
  lightboxHTML: customLightboxHTML,
  loop: true,
});



});
</script>
@endsection
