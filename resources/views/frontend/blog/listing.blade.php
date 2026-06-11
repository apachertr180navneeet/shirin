@extends('frontend.layouts.app')

@section('content')

 <main class="main__content_wrapper">
        
        <!-- Start breadcrumb section -->
        <div class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="{{route('home')}}">{{ translate('Home')}}</a></li>
                                <li class="breadcrumb__content--menu__items"><span>{{ translate('Blogs')}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

        <!-- Start blog section -->
        <section class="blog__section section--padding">
            <div class="container">
                <div class="row row-md-reverse">
                    <div class="col-lg-4">
                        <div class="blog__sidebar--widget left widget__area">
                             <form class="mb-4" id="search-form" action="" method="GET">
                            <div class="single__widget widget__search widget__bg">
                                <h2 class="widget__title h3">{{ translate('Filters') }}</h2>
                                <div class="widget__search--form">
                                    <label>
                                        <input class="widget__search--form__input" name="search" value="{{ $search }}" placeholder="{{translate('Search...')}}" autocomplete="off">
                                    </label>
                                    <button class="widget__search--form__btn" aria-label="search button" type="submit">
                                        <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="single__widget widget__bg">
                                <h2 class="widget__title h3">{{ translate('Categories')}}</h2>
                                <ul class="widget__form--check">
                                    @foreach (\App\Models\BlogCategory::all() as $key => $category)
                                    <li class="widget__form--check__list">
                                        <label class="widget__form--check__label" for="cat{{ $key }}">
                                            {{ $category->category_name }}
                                        </label>
                                        <input 
                                            class="widget__form--check__input" 
                                            id="cat{{ $key }}" 
                                            type="checkbox"
                                            name="selected_categories[]"
                                            value="{{ $category->slug }}"
                                            @if(in_array($category->slug, $selected_categories)) checked @endif
                                            onchange="filter()"
                                        >
                                        <span class="widget__form--checkmark"></span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            </form>
                            <div class="single__widget widget__bg">
                                <h2 class="widget__title h3">{{ translate('Recent Posts') }}</h2>
                                <div class="widget__post--article">
                                    @foreach($recent_blogs as $recent_blog)
                                    <div class="post__article--items d-flex align-items-center">
                                        <div class="post__article--thumbnail">
                                            <a class="display-block" href="{{ url("blog").'/'. $recent_blog->slug }}">
                                                <img
                                                src="{{ uploaded_asset($recent_blog->banner) }}"
                                                alt="{{ $recent_blog->title }}"
                                                class="post__article--thumbnail__img">
                                            </a>
                                        </div>
                                        <div class="post__article--content">
                                            <h3 class="post__article--content__title">
                                                <a href="{{ url("blog").'/'. $recent_blog->slug }}" title="{{ $recent_blog->title }}">
                                                    {{ $recent_blog->title }}
                                                </a>
                                            </h3>
                                            @if($recent_blog->category != null)
                                            <div>
                                                <span class="meta__deta">{{ $recent_blog->category->category_name }}</span>
                                            </div>
                                            @endif
                                            <span class="meta__deta">{{ date('M d, Y',strtotime($recent_blog->created_at)) }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="blog__wrapper">
                            <div class="row mb--n40">
                                @if($blogs->count() != null )
                                @foreach($blogs as $blog)
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-40">
                                    <article class="blog__card">
                                        <div class="blog__card--thumbnail">
                                            <a class="blog__card--thumbnail__link" href="{{ url("blog").'/'. $blog->slug }}">
                                                <img class="blog__card--thumbnail__img" src="{{ uploaded_asset($blog->banner) }}" alt="{{ $blog->title }}">
                                            </a>
                                        </div>
                                        <div class="blog__card--content">
                                            <div class="blog__meta d-flex">
                                                <span class="blog__meta--text meta__date">{{ date('M d, Y',strtotime($blog->created_at)) }} </span>
                                                @if($blog->category != null)
                                                <span class="blog__meta--text"> / </span>
                                                <span class="blog__meta--text meta__comment">{{ $blog->category->category_name }}</span>
                                                @endif
                                            </div>
                                            <h3 class="blog__card--title"><a href="{{ url("blog").'/'. $blog->slug }}">{{ $blog->title }}</a></h3>
                                            <a class="blog__card--link" href="{{ url("blog").'/'. $blog->slug }}">{{ translate('Read Full Blog') }}</a>
                                        </div>
                                    </article>
                                </div>
                                @endforeach
                                @else
                                <!-- Start error section -->
                                <section class="error__section section--padding">
                                    <div class="container">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <div class="error__content text-center">
                                                    <img class="error__content--img display-block mb-50" src="{{static_asset('public/assets/webtheme/user/assets/img/other/blog-not-found.jpg')}}" alt="error-img">
                                                    <h2 class="error__content--title">Blog ! Not Found </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- End error section -->
                                @endif
                            </div>
                            <div class="">
                                {{ $blogs->links('vendor.pagination.theme-pagination') }}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- End blog section -->

        <style>
            .counterup__banner__bg2:before {
                background: none;
            }
            @media only screen and (min-width: 1200px) {
                .breadcrumb__bg {
                    height: 100px;
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
    </main>

@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
    </script>
@endsection
