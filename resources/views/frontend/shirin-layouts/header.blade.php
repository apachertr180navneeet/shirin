<style>
    :root {
    --primary-color: #3C3836;
    --secondary-color: #C97F5F;
    --hover-color: #ED1D24;
    --yellow-color: #FF9800;
    --foreground-color: #000000;
    --foreground-sub-color: #98928E;
    --body-text-color: #000000;
    --text-white-color: #fff;
    --body-background-color: #fff;
    --bg-offwhite-color: #F5F7FF;
    --bg-gray-color: #F5F8FF;
    --bg-black-color: #000000;
    --bg-light-dark-color: #1a1818;
    --border-color: #EDEDED;
    --frank-ruhl-fonts: 'Jost', sans-serif;
    --karma-fonts: 'Jost', sans-serif;
    --body-font-size: 1.5rem;
    --body-font-weight: 400;
    --body-line-height: 2.6rem;
    --headings-weight: 700;
    --transition: all 0.3s ease 0s;
    --container-fluid-offset: 12rem
}
.active .border-bottom-6px {
    border-bottom-color: var(--secondary-color) !important;
}
.active .payment-title {
    color: var(--secondary-color);
}
.payment-icon:before {
    font-size: 30px;
}
.active .payment-icon:before {
    color: var(--secondary-color);
}

.product__badge {
    width: auto;
    padding: 1px 10px 0;
    height: auto;
    font-size: 1.2rem;
    line-height: 2.2rem;
    background: #379867;
    color: var(--text-white-color);
    font-family: var(--inter-fonts);
    position: relative;
    top: 0rem;
    left: 0;
    text-align: center;
    border-radius: 0rem;
    clip-path: polygon(0 1%, 100% 0, 90% 100%, 0% 100%);
}

.header__sub--menu {
    width: max-content !important;
}

.predictive__search--button:hover {
    background: none;
}
</style>

<!-- Start header area -->
    <header class="header__section">
        <div class="header__topbar bg__primary">
            <div class="container">
                <div class="header__topbar--inner style6 d-flex align-items-center justify-content-center">
                    <div class="header__top--right d-flex align-items-center">
                        <ul class="language__currency d-flex align-items-center">
                            <div class="header__topbar--inner">
                                <p class="header__info--text text-white text-uppercase">Pack Your Bag with shopping</p>
                            </div>
                        </ul>
                        <ul class="header__top--link d-flex align-items-center d-lg-none d-lg-block">
                            <li class="header__link--menu"><a class="header__link--menu__text" href="{{url('wishlists')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg> Wishlist</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main__header position__relative header__sticky">
            <div class="container">
                <div class="main__header--inner d-flex justify-content-between align-items-center">
                    <div class="offcanvas__header--menu__open ">
                        <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg" viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352"/></svg>
                            <span class="visually-hidden">Offcanvas Menu Open</span>
                        </a>
                    </div>
                    @if(get_setting('system_logo_white') != null)
                    <div class="main__logo">
                        <h1 class="main__logo--title"><a class="main__logo--link" href="{{route('home')}}">
                            <img style="width: 150px;" class="main__logo--img" src="{{ uploaded_asset(get_setting('system_logo_white')) }}" alt="{{ get_setting('site_name') }}">
                        </a></h1>
                    </div>
                    @endif
                    <div class="header__menu d-none d-lg-block">
                        <nav class="header__menu--navigation">
                            <ul class="header__menu--wrapper d-flex">
                                <li class="header__menu--items">
                                    <a class="header__menu--link active" href="{{route('home')}}">Home</a>
                                </li>
                                <li class="header__menu--items mega__menu--items">
                                    <a class="header__menu--link" href="{{route('search')}}">Shop</a>
                                </li>

                                <li class="header__menu--items">
                                    <a class="header__menu--link" href="#">Collections </a>
                                    <ul class="header__sub--menu">
                                    @foreach (\App\Models\Category::where('level', 0)->get() as $category)
                                        <li class="header__sub--menu__items"><a href="{{ route('products.category', $category->slug) }}" class="header__sub--menu__link">{{ $category->getTranslation('name') }}</a></li>
                                    @endforeach  
                                    </ul>
                                </li>
                                <li class="header__menu--items">
                                    <a class="header__menu--link" href="{{route('about')}}">About
                                </li>
                                <li class="header__menu--items">
                                    <a class="header__menu--link" href="{{route('contactus')}}">Contact </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header__account">
                        <ul class="header__account--wrapper d-flex align-items-center">
                            <li class="header__account--items header__minicart--items header__account--search__items">
                                <a class="header__account--btn minicart__open--btn header__account--btn search__open--btn" href="javascript:void(0)" data-offcanvas>
                                    <span class="header__account--btn__icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 16L11 11M12.6667 6.83333C12.6667 7.59938 12.5158 8.35792 12.2226 9.06565C11.9295 9.77339 11.4998 10.4164 10.9581 10.9581C10.4164 11.4998 9.77339 11.9295 9.06565 12.2226C8.35792 12.5158 7.59938 12.6667 6.83333 12.6667C6.06729 12.6667 5.30875 12.5158 4.60101 12.2226C3.89328 11.9295 3.25022 11.4998 2.70854 10.9581C2.16687 10.4164 1.73719 9.77339 1.44404 9.06565C1.15088 8.35792 1 7.59938 1 6.83333C1 5.28624 1.61458 3.80251 2.70854 2.70854C3.80251 1.61458 5.28624 1 6.83333 1C8.38043 1 9.86416 1.61458 10.9581 2.70854C12.0521 3.80251 12.6667 5.28624 12.6667 6.83333Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span class="visually-hidden">Search</span>  
                                </a>
                            </li>
                            <li class="header__account--items d-none d-lg-block">
                                <a class="header__account--btn" href="{{url('wishlists')}}">
                                    <span class="header__account--btn__icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.09836 2.28681C1.75014 2.69477 1.47391 3.1791 1.28545 3.71213C1.097 4.24516 1 4.81646 1 5.39341C1 5.97036 1.097 6.54167 1.28545 7.0747C1.47391 7.60773 1.75014 8.09206 2.09836 8.50002L8.50001 16L14.9016 8.50002C15.6049 7.6761 16 6.55862 16 5.39341C16 4.22821 15.6049 3.11073 14.9016 2.28681C14.1984 1.46289 13.2446 1.00001 12.25 1.00001C11.2554 1.00001 10.3016 1.46289 9.59833 2.28681L8.50001 3.57358L7.40168 2.28681C7.05346 1.87884 6.64006 1.55522 6.18509 1.33443C5.73011 1.11364 5.24248 1 4.75002 1C4.25756 1 3.76992 1.11364 3.31495 1.33443C2.85998 1.55522 2.44658 1.87884 2.09836 2.28681V2.28681Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <!-- wishlist file include  -->
                                    @include('frontend.partials.wishlist')
                                    <span class="visually-hidden">Wishlist</span> 
                                </a>
                            </li>
                            <li class="header__menu--items header__account--items d-none d-lg-block">
                                <a class="header__account--btn" href="{{route('dashboard')}}">
                                    <span class="header__account--btn__icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 16V14.3333C16 13.4493 15.6049 12.6014 14.9016 11.9763C14.1984 11.3512 13.2446 11 12.25 11H4.75C3.75544 11 2.80161 11.3512 2.09835 11.9763C1.39509 12.6014 1 13.4493 1 14.3333V16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8.5 7.66667C10.5711 7.66667 12.25 6.17428 12.25 4.33333C12.25 2.49238 10.5711 1 8.5 1C6.42893 1 4.75 2.49238 4.75 4.33333C4.75 6.17428 6.42893 7.66667 8.5 7.66667Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <ul class="header__sub--menu">
                                        <li class="header__sub--menu__items"><a href="{{route('new.login')}}" class="header__sub--menu__link">Sign In</a></li>
                                        <li class="header__sub--menu__items"><a href="{{route('register')}}" class="header__sub--menu__link">Register</a></li>
                                    </ul>
                                    <span class="visually-hidden">My Account</span> 
                                </a>
                            </li>
                            <li class="header__account--items header__minicart--items">
                                <a class="header__account--btn minicart__open--btn" href="{{url('cart')}}">
                                    <span class="header__account--btn__icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.25 7.66667V4.33333C12.25 3.44928 11.8549 2.60143 11.1517 1.97631C10.4484 1.35119 9.49456 1 8.5 1C7.50544 1 6.55161 1.35119 5.84835 1.97631C5.14509 2.60143 4.75 3.44928 4.75 4.33333V7.66667M1.9375 6H15.0625L16 16H1L1.9375 6Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>  
                                    </span>
                                    <!-- cart file include  -->
                                    @include('frontend.partials.cart')  
                                    <span class="visually-hidden">Cart</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Offcanvas header menu -->
        <div class="offcanvas__header">
            <div class="offcanvas__inner">
            @if(get_setting('system_logo_white') != null)
                <div class="offcanvas__logo">
                    <a class="offcanvas__logo_link" href="{{route('home')}}">
                        <img src="{{ uploaded_asset(get_setting('system_logo_white')) }}" alt="{{ get_setting('site_name') }}" width="158" height="36">
                    </a>
                    <button class="offcanvas__close--btn" data-offcanvas>close</button>
                </div>
            @endif
                <nav class="offcanvas__menu">
                    <ul class="offcanvas__menu_ul">
                        <li class="offcanvas__menu_li">
                            <a class="offcanvas__menu_item" href="{{route('home')}}">Home</a>
                        </li>
                        <li class="offcanvas__menu_li">
                            <a class="offcanvas__menu_item" href="{{route('search')}}">Shop</a>
                        </li>

                        <li class="offcanvas__menu_li">
                            <a class="offcanvas__menu_item" href="#">Collection</a>
                            <ul class="offcanvas__sub_menu">
                                @foreach (\App\Models\Category::where('level', 0)->get() as $category)
                                <li class="offcanvas__sub_menu_li"><a href="{{ route('products.category', $category->slug) }}" class="offcanvas__sub_menu_item">{{ $category->getTranslation('name') }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="{{route('about')}}">About</a></li>
                        <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="{{route('blog')}}">Blog</a></li>
                        <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="{{route('gallery')}}">Gallery</a></li>
                        <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="{{route('contactus')}}">Contact</a></li>
                    </ul>
                    <div class="offcanvas__account--items">
                        <a class="offcanvas__account--items__btn d-flex align-items-center" href="{{route('new.login')}}">
                            <span class="offcanvas__account--items__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-2"  width="20.51" height="19.443" viewBox="0 0 512 512"><path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg>
                            </span>
                            <span class="offcanvas__account--items__label">Login / Register</span>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
        <!-- End Offcanvas header menu -->

        <!-- Start Offcanvas sticky toolbar -->
        <div class="offcanvas__sticky--toolbar d-none">
            <ul class="d-flex justify-content-between">
                <li class="offcanvas__sticky--toolbar__list">
                    <a class="offcanvas__sticky--toolbar__btn" href="index.html">
                    <span class="offcanvas__sticky--toolbar__icon"> 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="21.51" height="21.443" viewBox="0 0 22 17"><path fill="currentColor" d="M20.9141 7.93359c.1406.11719.2109.26953.2109.45703 0 .14063-.0469.25782-.1406.35157l-.3516.42187c-.1172.14063-.2578.21094-.4219.21094-.1406 0-.2578-.04688-.3515-.14062l-.9844-.77344V15c0 .3047-.1172.5625-.3516.7734-.2109.2344-.4687.3516-.7734.3516h-4.5c-.3047 0-.5742-.1172-.8086-.3516-.2109-.2109-.3164-.4687-.3164-.7734v-3.6562h-2.25V15c0 .3047-.11719.5625-.35156.7734-.21094.2344-.46875.3516-.77344.3516h-4.5c-.30469 0-.57422-.1172-.80859-.3516-.21094-.2109-.31641-.4687-.31641-.7734V8.46094l-.94922.77344c-.11719.09374-.24609.14062-.38672.14062-.16406 0-.30468-.07031-.42187-.21094l-.35157-.42187C.921875 8.625.875 8.50781.875 8.39062c0-.1875.070312-.33984.21094-.45703L9.73438.832031C10.1094.527344 10.5312.375 11 .375s.8906.152344 1.2656.457031l8.6485 7.101559zm-3.7266 6.50391V7.05469L11 1.99219l-6.1875 5.0625v7.38281h3.375v-3.6563c0-.3046.10547-.5624.31641-.7734.23437-.23436.5039-.35155.80859-.35155h3.375c.3047 0 .5625.11719.7734.35155.2344.211.3516.4688.3516.7734v3.6563h3.375z"></path></svg>
                        </span>
                        <span class="offcanvas__sticky--toolbar__label">Home</span>
                    </a>
                </li>
                <li class="offcanvas__sticky--toolbar__list">
                    <a class="offcanvas__sticky--toolbar__btn" href="shop.html">
                    <span class="offcanvas__sticky--toolbar__icon"> 
                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="18.51" height="17.443" viewBox="0 0 448 512"><path d="M416 32H32A32 32 0 0 0 0 64v384a32 32 0 0 0 32 32h384a32 32 0 0 0 32-32V64a32 32 0 0 0-32-32zm-16 48v152H248V80zm-200 0v152H48V80zM48 432V280h152v152zm200 0V280h152v152z"></path></svg>
                        </span>
                    <span class="offcanvas__sticky--toolbar__label">Shop</span>
                    </a>
                </li>
                <li class="offcanvas__sticky--toolbar__list ">
                    <a class="offcanvas__sticky--toolbar__btn search__open--btn" href="javascript:void(0)" data-offcanvas>
                        <span class="offcanvas__sticky--toolbar__icon"> 
                            <svg xmlns="http://www.w3.org/2000/svg"  width="22.51" height="20.443" viewBox="0 0 512 512"><path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"/></svg>   
                        </span>
                    <span class="offcanvas__sticky--toolbar__label">Search</span>
                    </a>
                </li>
                <li class="offcanvas__sticky--toolbar__list">
                    <a class="offcanvas__sticky--toolbar__btn minicart__open--btn" href="javascript:void(0)" data-offcanvas>
                        <span class="offcanvas__sticky--toolbar__icon"> 
                            <svg width="17" height="15" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z" fill="currentColor"/>
                             </svg> 
                        </span>
                        <span class="offcanvas__sticky--toolbar__label">Cart</span>
                        <span class="items__count">3</span> 
                    </a>
                </li>
                <li class="offcanvas__sticky--toolbar__list">
                    <a class="offcanvas__sticky--toolbar__btn" href="wishlist.html">
                        <span class="offcanvas__sticky--toolbar__icon"> 
                            <svg width="18" height="18" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z" fill="currentColor"/>
                            </svg>
                        </span>
                        <span class="offcanvas__sticky--toolbar__label">Wishlist</span>
                        <span class="items__count">3</span> 
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Offcanvas sticky toolbar -->

        <!-- Start offCanvas minicart -->
        <div class="offCanvas__minicart">
            <div class="predictive__search--box__inner">
                <div class="minicart__header ">
                    <div class="minicart__header--top d-flex justify-content-between align-items-center">
                        <h3 class="minicart__title"> Search Products</h3>
                        <button class="minicart__close--btn" aria-label="minicart close btn" data-offcanvas>
                            <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32" d="M368 368L144 144M368 144L144 368" />
                            </svg>
                        </button>
                    </div>
                    <form class="predictive__search--form" id="header-search" action="{{ route('search') }}" method="get">
                        <label>
                            <input class="predictive__search--input" id="search" name="keyword" placeholder="Search Here" type="text" @isset($query)
                                value="{{ $query }}"
                            @endisset />
                        </label>
                        <button class="predictive__search--button text-dark" aria-label="search button"><svg
                                class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="30.51"
                                height="25.443" viewBox="0 0 512 512">
                                <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none"
                                    stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                    stroke-width="32" d="M338.29 338.29L448 448" />
                            </svg> </button>
                    </form>
                </div>
        
                <div class="minicart__product">
                    @foreach (\App\Models\Category::where('level', 0)->get() as $category)
                    <a class="minicart__product--items d-flex" href="{{ route('products.category', $category->slug) }}">
                        <div class="d-flex">
                            <div class="minicart__thumb">
                                <img src="{{uploaded_asset($category->banner)}}" style="border-radius:10px" alt="prduct-img">
                            </div>
                            <div class="minicart__text">
                                <h4 class="minicart__subtitle">{{ $category->getTranslation('name') }}</h4>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
        
            </div>
        </div>
        <!-- End offCanvas minicart -->
        
    </header>
    <!-- End header area -->
    
<style>
@media only screen and (min-width: 992px) {
    .header__account--wrapper {
        gap: 0rem;
    }
}
@media only screen and (min-width: 1200px) {
    .header__menu--link {
        font-size: 1.7rem;
        padding: 0px 0;
    }
}
@media only screen and (min-width: 1200px) {
    .header__menu--wrapper {
        gap: 0rem;
    }
}
@media only screen and (min-width: 1200px) {
    .section--padding {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
}

@media only screen and (min-width: 1200px) {
    .product__card--action__btn {
        width: 3.8rem;
        height: 3.8rem;
        line-height: 4rem;
        -webkit-transform: scale(1);
    }
}
.product__card--action {
    position: absolute;
    opacity: 1;
    visibility: visible;
}

.product__card--btn {
    background: #ffffff;
    color: #3c3836;
}

.instagram__thumbnail a img {
    display: block;
    width: 100%;
}

.predictive__search--button {
    background: transparent;
}
.minicart__product--items {
  margin-top: 10px;
  padding-top: 10px;
  border-top: 1px solid var(--border-color);
}
.predictive__search--box__inner {
  padding: 0px 0px;
  text-align: left;
}

.modal-content.quickview__main__content {
    padding: 0px;
    border-radius: 10px;
    border: 0;
    max-height: 80vh;
    overflow: auto;
}
</style>

