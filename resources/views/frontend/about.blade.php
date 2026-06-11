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
                                <li class="breadcrumb__content--menu__items"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>About Us</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

       <!-- Start about section -->
       <section class="about__Section section--padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="about__thumbnail padding__left position-relative">
                            <img src="{{static_asset('public/assets/webtheme/user/assets/img/banner/aboutus.jpg')}}" alt="img">
                            <div class="about__experience--text text-center">
                                <span class="about__experience--years"><span class="about__experience--years__inner" style="font-size:25px">12

                                </span>+</span>
                                <span class="about__experience--title">YEARS
                                    EXPERIENCE</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="about__content padding__left">
                            <h3 class="about__content--subtitle">About Us</h3>
                            <h2 class="about__content--title">AL-NOMAN FRAGRANCE</h2>
                            <p class="about__content--desc">Al Noman Since 2012 , your premier destination for quality goods that combine tradition and modernity. Our journey began with a passion for bringing the finest products to our customers, while preserving the essence of heritage and craftsmanship. Al Noman was founded with a vision to curate a collection of products that reflect the beauty of tradition and the innovation of the present. Our story started in [Year of Establishment], when we embarked on a mission to bridge the gap between the past and the future by offering a carefully selected range of items.
Al Noman is more than a retail destination; it's a place where you can discover products that reflect your style, taste, and values. Visit our store and experience the joy of shopping in a welcoming and friendly environment. At Al Noman , we are dedicated to enhancing your shopping experience and helping you find the perfect products for your lifestyle</p>
                           <!-- <a class="about__conten--btn primary__btn" href="about.html">VIEW MORE</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End about section -->
        
        <!-- Start counterup banner section -->
        <div class="counterup__banner--section counterup__banner__bg2" id="funfactId">
            <div class="container">
                <div class="row row-cols-1 align-items-center">
                    <div class="col">
                        <div class="counterup__banner--inner position__relative d-flex align-items-center justify-content-between">
                            <div class="counterup__items text-center">
                                <h2 class="counterup__title">YEARS OF <br>
                                    FOUNDATION</h2>
                                <span class="counterup__number js-counter" data-count="60">0</span>
                            </div>
                            <div class="counterup__items text-center">
                                <h2 class="counterup__title">SKILLED TEAM <br>
                                    MEMBERS </h2>
                                <span class="counterup__number js-counter" data-count="100">0</span>
                            </div>
                            <div class="counterup__items text-center">
                                <h2 class="counterup__title">HAPPY <br>
                                    CUSTOMERS</h2>
                                <span class="counterup__number js-counter" data-count="80">0</span>
                            </div>
                            <div class="counterup__items text-center">
                                <h2 class="counterup__title">MONTHLY <br>
                                    ORDERS</h2>
                                <span class="counterup__number js-counter" data-count="100">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End counterup banner section -->

       <!-- Start team members section -->
       
        <!-- End team members section -->

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

         <style>
            .counterup__banner__bg2:before {
                background: none;
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


         <style>
            .counterup__banner__bg2:before {
                background: none;
            }
            @media only screen and (min-width: 1200px) {
                .breadcrumb__bg {
                    height: 100px;
                }
            }
            .testimonial__bg::before {
                background: transparent;
            }
         </style>
        

    </main>

    @endsection

    
<script>
document.addEventListener("DOMContentLoaded", function () {
// brand logo swiper activation
var swiper = new Swiper(".brand__logo--activation", {
  slidesPerView: 6,
  loop: true,
  clickable: true,
  spaceBetween: 30,
  breakpoints: {
    1200: {
      slidesPerView: 6,
    },
    992: {
      slidesPerView: 5,
    },
    768: {
      slidesPerView: 5,
      spaceBetween: 30,
    },
    576: {
      slidesPerView: 4,
      spaceBetween: 30,
    },
    480: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
    350: {
      slidesPerView: 3,
      spaceBetween: 25,
    },
    280: {
      slidesPerView: 2,
      spaceBetween: 25,
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

// CounterUp Activation
const wrapper = document.getElementById("funfactId");
if (wrapper) {
  const counters = wrapper.querySelectorAll(".js-counter");
  const duration = 1000;

  let isCounted = false;
  document.addEventListener("scroll", function () {
    const wrapperPos = wrapper.offsetTop - window.innerHeight;
    if (!isCounted && window.scrollY > wrapperPos) {
      counters.forEach((counter) => {
        const countTo = counter.dataset.count;

        const countPerMs = countTo / duration;

        let currentCount = 0;
        const countInterval = setInterval(function () {
          if (currentCount >= countTo) {
            clearInterval(countInterval);
          }
          counter.textContent = Math.round(currentCount);
          currentCount = currentCount + countPerMs;
        }, 1);
      });
      isCounted = true;
    }
  });
}
});


</script>
