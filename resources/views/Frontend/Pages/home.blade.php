@extends('layouts.frontend')
@section('title')
    Home | Bamboo Street
@endsection
@section('content')

    <!-- Slider -->
    <div class="tf-slideshow slider-effect-fade position-relative">
        <div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false"
            data-space="0" data-loop="true" data-auto-play="false" data-delay="0" data-speed="1000">

            <div class="swiper-wrapper">

                @foreach ($sliders as $slider)
                    <div class="swiper-slide">
                        <div class="wrap-slider">

                            <img src="{{ Storage::url($slider->image) }}" alt="slider-image">

                            <div class="box-content">
                                <div class="container">

                                    <h1 class="fade-item fade-item-1">
                                        {{ $slider->title }}
                                    </h1>

                                    <p>
                                        Subtitle: {{ $slider->subtitle }}
                                    </p>

                                    @if ($slider->url || $slider->category_id)
                                        <a href="{{ $slider->url ?? route('frontend.products', ['category_slug' => optional($slider->category)->slug]) }}"
                                            class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3">

                                            <span>Shop Collection</span>
                                            <i class="icon icon-arrow-right"></i>

                                        </a>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="wrap-pagination">
            <div class="container">
                <div class="sw-dots sw-pagination-slider justify-content-center"></div>
            </div>
        </div>
    </div>



    <!-- /Slider -->

    <!-- Shop Collection -->
    <section class="flat-spacing-4 pt_3">
        <div class="container">
            <div class="tf-grid-layout md-col-2 tf-img-with-text">
                <div class="tf-image-wrap radius-10 wow fadeInUp" data-wow-delay="0s">
                    <img class="lazyload" data-src="/frontend/images/home/summercare-tip.png"
                        src="/frontend/images/home/summercare-tip.png" alt="collection-img">
                </div>
                <div class="tf-content-wrap wow fadeInUp" data-wow-delay="0s">
                    <span class="sub-heading text-uppercase fw-7 text_green-1">Bamboo Plates for Little Mates</span>

                    <div class="heading text_green-1">"Happy Tummies, Happy Planet—Bamboo for the Little Ones!"</div>
                    <p class="description text_green-2 {{ is_mobile() ? 'justify-text' : '' }}">
                        Made from natural bamboo, these adorable plates are safe, sturdy,
                        and perfect for your kid's mealtime moments.
                    </p>
                    <a href="/articles" class="tf-btn style-2 btn-fill radius-60 border-0 animate-hover-btn bg_green-9">Tap
                        to Discover
                        More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /Shop Collection -->

    <!-- Categories -->
    <section class="flat-spacing-4 section-cls-personalized-pod section-full-1 bg_f5f5ec"
        style="border-radius: 25px; overflow: hidden;">
        {{-- <img class="" data-src="/frontend/images/home/category-bg.png" src="/frontend/images/home/category-bg.png"
            alt=""> --}}
        <div class="container">
            <div class="flat-title gap-14">
                <div class="box-sw-navigation">
                    <div class="nav-sw nav-next-slider nav-next-collection"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-collection"><span class="icon icon-arrow-right"></span>
                    </div>
                </div>
                <span class="title wow fadeInUp fw-6" data-wow-delay="0s" style="color: #36614B;">SHOP BY CATEGORIES</span>
            </div>
            <div class="swiper tf-sw-collection" data-preview="4" data-tablet="3" data-mobile="1" data-space-lg="30"
                data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <div class="swiper-slide lazy">
                            <div class="collection-item style-2 hover-img">
                                <div class="collection-inner">
                                    <a href="{{ route('frontend.products', ['category_slug' => $category->slug]) }}"
                                        class="collection-image img-style radius-20">
                                        <img class="lazyload" data-src="{{ Storage::url($category->image) }}"
                                            src="{{ Storage::url($category->image) }}" alt="collection-img">
                                    </a>
                                    <div class="collection-content">
                                        <a href="{{ route('frontend.products', ['category_slug' => $category->slug]) }}"
                                            class="tf-btn collection-title hover-icon fs-15 radius-3">
                                            <span>{{ $category->name }}</span>
                                            <i class="icon icon-arrow1-top-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- /Categories -->


    {{-- products --}}
    <section class="flat-spacing-4 section-cls-personalized-pod section-full-1 bg_f5f5ec"
        style="border-radius: 25px; overflow: hidden;">
        <div class="container">
            <div class="flat-title gap-14">
                <div class="box-sw-navigation">
                    <div class="nav-sw nav-next-slider nav-next-collection"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-collection"><span class="icon icon-arrow-right"></span>
                    </div>
                </div>
                <span class="title wow fadeInUp fw-6" data-wow-delay="0s" style="color: #36614B;">FEATURED PRODUCTS</span>
            </div>
            <div class="swiper tf-sw-collection" data-preview="4" data-tablet="3" data-mobile="1" data-space-lg="30"
                data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                <div class="swiper-wrapper">
                    @foreach ($products as $product)
                        @php
                            $product_image = $product->getImage();
                            $product_price = $product->getPrice();
                            $color_property_values = getProductPropertyValues($product->id, 'Color');
                        @endphp
                        <div class="swiper-slide">
                            <div class="card-product">
                                <div class="card-product-wrapper">
                                    <a href="{{ route('frontend.products.product-details', ['slug' => $product->slug]) }}"
                                        class="product-img">
                                        <img class="lazyload img-product" data-src="{{ $product_image }}"
                                            src="{{ $product_image }}" alt="image-product">
                                        <img class="lazyload img-hover" data-src="{{ $product_image }}"
                                            src="{{ $product_image }}" alt="image-product">
                                    </a>
                                    @if ($product->isOutOfStock())
                                        <div class="badge-out-of-stock bg_f5f5ec"
                                            style="position: absolute; top: 10px; left: 10px; color: #36614B; padding: 5px 12px; border-radius: 8px; font-size: 13px; font-weight: 600; z-index: 9; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                            Out of Stock
                                        </div>
                                    @endif
                                    <div class="list-product-btn absolute-2">
                                        @if (!$product->isOutOfStock())
                                            <a href="#"
                                                class="box-icon bg_white quick-add tf-btn-loading add-to-cart-btn"
                                                data-id="{{ $product->id }}"
                                                data-primary-property-values='@json($product->primary_property_values)'>
                                                <i class="fas fa-cart-plus"></i>
                                                <span class="tooltip">Quick Add</span>
                                            </a>
                                        @endif
                                        <a href="javascript:void(0);"
                                            class="box-icon bg_white tf-btn-loading btn-icon-action product-wishlist {{ $product->is_wishlisted ? 'active' : '' }}"
                                            data-id="{{ $product->id }}">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip" id="wishlist-tooltip-{{ $product->id }}">
                                                {{ $product->is_wishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                            </span>
                                            <span class="icon icon-delete"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-product-info">
                                    <a href="{{ route('frontend.products.product-details', ['slug' => $product->slug]) }}"
                                        class="title link text_green-2">{{ $product->name }}</a>
                                    <div class="tf-product-info-price">
                                        <span class="price text_green-2" style="font-size:14px; font-weight: 600;">
                                            @if ($product_price)
                                                {{ toIndianCurrency($product_price->selling_price) }}
                                            @endif
                                        </span>
                                        <span class="compare-at-price"
                                            style="font-size:14px; font-weight: 600; text-decoration: line-through; color: #666;">
                                            @if ($product_price && $product_price->actual_price > $product_price->selling_price)
                                                {{ toIndianCurrency($product_price->actual_price) }}
                                            @endif
                                        </span>
                                        <div class="discount-percentage">
                                            @if ($product_price && $product_price->discount_percentage)
                                                <span>{{ round($product_price->discount_percentage) }}</span>% OFF
                                            @endif
                                        </div>
                                    </div>
                                    <ul class="list-color-product">
                                        @if ($color_property_values->isNotEmpty())
                                            @foreach ($color_property_values as $color_property_value)
                                                <li class="list-color-item color-swatch">
                                                    <span class="swatch-value"
                                                        style="background: {{ $color_property_value->color_code }}"></span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- end products --}}

    {{-- greenhouse --}}
    <section class="flat-spacing-12">
        <div class="container">
            <div class="tf-grid-layout md-col-2 tf-img-with-text style-5">
                <div class="tf-image-wrap widget-video wow fadeInUp clear" data-wow-delay="0s">
                    <video class="lazyload" autoplay muted loop playsinline>
                        <source src="/frontend/images/home/greenhouse.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="tf-content-wrap w-100 wow fadeInUp" data-wow-delay="0s">
                    {{-- <span class="sub-heading text-uppercase fw-7 text_green-1">Let Bamboo Light The Way</span> --}}
                    <div class="heading text_green-1">Let Bamboo Light <br>The Way</div>
                    <p class="description text_green-2  {{ is_mobile() ? 'justify-text' : '' }}">
                        Made with pure bamboo, this lamp combines natural elegance with eco-friendly design to brighten your
                        space with a warm, organic glow.
                    </p>
                    <a href="/greenhouse-articles"
                        class="tf-btn style-2 btn-fill border-0 radius-60 animate-hover-btn bg_green-9">
                        Tap to Discover More
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- greenhouse --}}

    {{-- our commitments --}}
    <section class="flat-spacing-9 pb_0">
        <div class="container">
            <div class="flat-title">
                <span class="title wow fadeInUp text-center text_green-2" data-wow-delay="0s">Our Commitments</span>
            </div>
            <div class="wrap-carousel">
                <div dir="ltr" class="swiper tf-sw-recent text-center" data-preview="4" data-tablet="3"
                    data-mobile="1" data-space-lg="30" data-space-md="15" data-space="15" data-pagination="2"
                    data-pagination-md="3" data-pagination-lg="3">

                    <div class="swiper-wrapper">
                        <div class="swiper-slide" lazy="true">
                            <div class="card-product-wrapper d-flex justify-content-center">
                                <img class="lazyload img-product" data-src="/frontend/images/home/icon1.png"
                                    src="/frontend/images/home/icon1.png" alt="image-product" width="196px">
                            </div>
                        </div>
                        <div class="swiper-slide" lazy="true">
                            <div class="card-product-wrapper d-flex justify-content-center">
                                <img class="lazyload img-product" data-src="/frontend/images/home/icon2.png"
                                    src="/frontend/images/home/icon2.png" alt="image-product" width="196px">
                            </div>
                        </div>
                        <div class="swiper-slide" lazy="true">
                            <div class="card-product-wrapper d-flex justify-content-center">
                                <img class="lazyload img-product" data-src="/frontend/images/home/icon3.png"
                                    src="/frontend/images/home/icon3.png" alt="image-product" width="196px">
                            </div>
                        </div>
                        <div class="swiper-slide" lazy="true">
                            <div class="card-product-wrapper d-flex justify-content-center">
                                <img class="lazyload img-product" data-src="/frontend/images/home/icon4.png"
                                    src="/frontend/images/home/icon4.png" alt="image-product" width="196px">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sw-dots style-2 sw-pagination-recent justify-content-center"></div>
            </div>
        </div>
    </section>




    <!-- Testimonial -->
    @if ($testimonials->isNotEmpty())
        <section class="flat-spacing-27">
            <div class="container">
                <div class="wrapper-thumbs-testimonial-v2 flat-thumbs-testimonial flat-thumbs-testimonial-v2 bg_green-9">
                    <div class="box-left">
                        <div dir="ltr" class="swiper tf-sw-tes-2" data-preview="1" data-space-lg="40"
                            data-space-md="30">
                            <div class="swiper-wrapper">
                                @foreach ($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="46" height="31"
                                                    viewBox="0 0 46 31" fill="none">
                                                    <path
                                                        d="M32.4413 30.5L37.8204 19.9545L38.1913 19.2273H37.375H26.375V0.5H45.5V19.6071L39.9438 30.5H32.4413ZM6.56633 30.5L11.9454 19.9545L12.3163 19.2273H11.5H0.5V0.5H19.625V19.6071L14.0688 30.5H6.56633Z"
                                                        stroke="#B5B5B5"></path>
                                                </svg>
                                            </div>
                                            <div class="heading fs-14 mb_18 text-white">
                                                {{ $testimonial->title }}
                                            </div>
                                            <div class="rating">
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                            </div>
                                            <p class="text text-white">
                                                {{ $testimonial->description }}
                                            </p>
                                            <div class="author box-author">
                                                <div class="box-img d-md-none">
                                                    <img class="lazyload img-product"
                                                        data-src="{{ asset('storage/' . $testimonial->image) }}"
                                                        src="{{ asset('storage/' . $testimonial->image) }}"
                                                        alt="{{ $testimonial->name }}">
                                                </div>
                                                <div class="content">
                                                    <div class="name text-white fw-6">{{ $testimonial->name }}</div>
                                                    <a href="product-detail.html" class="metas text-white">
                                                        Purchase item : <span
                                                            class="fw-6">{{ $testimonial->purchase_item }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-md-flex d-none box-sw-navigation">
                            <div class="nav-sw nav-next-slider line-white nav-next-tes-2">
                                <span class="icon icon-arrow-left"></span>
                            </div>
                            <div class="nav-sw nav-prev-slider line-white nav-prev-tes-2">
                                <span class="icon icon-arrow-right"></span>
                            </div>
                        </div>
                        <div class="d-md-none sw-dots style-2 dots-white sw-pagination-tes-2"></div>
                    </div>
                    <div class="box-right">
                        <div dir="ltr" class="swiper tf-thumb-tes" data-preview="1" data-space="30">
                            <div class="swiper-wrapper">
                                @foreach ($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="box-img item-2 hover-img radius-10 o-hidden">
                                            <div class="img-style">
                                                <img class="lazyload"
                                                    data-src="{{ asset('storage/' . $testimonial->image) }}"
                                                    src="{{ asset('storage/' . $testimonial->image) }}" alt="-">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- /Testimonial -->

    <!-- Iconbox -->
    <div class="container">
        <section class="flat-spacing-12 bg_white radius-10">
            <div class="flat-title">
                <span class="title wow fadeInUp text-center text_green-2" data-wow-delay="0s">This is how we help you save
                    tomorrow, today!</span>
            </div>
            <div class="wrap-carousel wrap-mobile flat-iconbox-v2 style-2 wow fadeInUp" data-wow-delay="0s">
                <div dir="ltr" class="swiper tf-sw-mobile-1" data-preview="1" data-space="15">
                    <div class="swiper-wrapper wrap-iconbox">
                        <div class="swiper-slide">
                            <div class="tf-icon-box text-center">
                                <div class="icon lg">
                                    <i class="icon-shipping-1 text_green-2"></i>
                                </div>
                                <div class="content">
                                    <div class="title text_green-2">Sustainable</div>
                                    <p class="text_green-2 {{ is_mobile() ? 'justify-text' : '' }}">Purely
                                        sustainable, inside and out—no plastic in our products
                                        or packaging, only eco-friendly choices for you and the planet.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box text-center">
                                <div class="icon lg">
                                    <i class="icon-customer text_green-2"></i>
                                </div>
                                <div class="content">
                                    <div class="title text_green-2">Limited / traditional usage of bamboo</div>
                                    <p class="text_green-2 {{ is_mobile() ? 'justify-text' : '' }}">Our products
                                        go beyond the traditional uses—they are designed
                                        to meet modern needs while staying sustainable and eco-friendly.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box text-center">
                                <div class="icon lg">
                                    <i class="icon-stores text_green-2"></i>
                                </div>
                                <div class="content">
                                    <div class="title text_green-2">Durable and Premium </div>
                                    <p class="text_green-2 {{ is_mobile() ? 'justify-text' : '' }}">Built to
                                        endure, made to sustain—our products offer lasting
                                        quality with an eco-friendly touch.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sw-dots style-2 sw-pagination-mb-1 justify-content-center"></div>
            </div>
        </section>
    </div>
    <!-- /Iconbox -->

    {{-- blog inetgrate --}}
    @if ($blogs->isNotEmpty())
        <div class="blog-grid-main">
            <div class="flat-title">
                <span class="title wow fadeInUp text-center text_green-2" data-wow-delay="0s">Blogs</span>
            </div>
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="blog-article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('frontend.blogs.details', $blog->slug) }}">
                                        <img class="lazyload" data-src="{{ asset('storage/' . $blog->thumbnail_image) }}"
                                            src="{{ asset('storage/' . $blog->thumbnail_image) }}"
                                            alt="{{ $blog->title }}">
                                    </a>
                                </div>
                                <div class="article-content">
                                    <div class="article-title">
                                        <a href="{{ route('frontend.blogs.details', $blog->slug) }}">
                                            {{ $blog->title }}
                                        </a>
                                    </div>
                                    <div class="article-btn">
                                        <a href="{{ route('frontend.blogs.details', $blog->slug) }}"
                                            class="tf-btn btn-line fw-6">
                                            Read more <i class="icon icon-arrow1-top-left"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    {{-- end blog --}}

    @if ($collections->isNotEmpty())
        @foreach ($collections as $collection)
            @php
                $products = getCollectionProducts($collection);
            @endphp
            <section class="flat-spacing-11">
                <div class="container">
                    <div class="flat-title">
                        <span class="title wow fadeInUp" data-wow-delay="0s">{{ $collection->name }}</span>
                    </div>
                    <div class="hover-sw-nav hover-sw-2">
                        <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4"
                            data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2"
                            data-pagination-md="3" data-pagination-lg="3">
                            <div class="swiper-wrapper">
                                @if ($products->isNotEmpty())
                                    @foreach ($products as $product)
                                        @php
                                            $product_image = $product->getImage();
                                            $product_price = $product->getPrice();
                                        @endphp
                                        <div class="swiper-slide" lazy="true">
                                            <div class="card-product style-3">
                                                <div class="card-product-wrapper">
                                                    <a href="{{ route('frontend.products.product-details', ['slug' => $product->slug]) }}"
                                                        class="product-img">
                                                        <img class="lazyload img-product" data-src="{{ $product_image }}"
                                                            src="{{ $product_image }}" alt="image-product">
                                                        <img class="lazyload img-hover" data-src="{{ $product_image }}"
                                                            src="{{ $product_image }}" alt="image-product">
                                                    </a>
                                                    <div class="list-product-btn column-right">
                                                        <a href="javascript:void(0);"
                                                            class="box-icon bg_white wishlist tf-btn-loading btn-icon-action product-wishlist {{ $product->is_wishlisted ? 'active' : '' }}"
                                                            data-id="{{ $product->id }}">
                                                            <span class="icon icon-heart"></span>
                                                            <span class="tooltip"
                                                                id="wishlist-tooltip-{{ $product->id }}">
                                                                {{ $product->is_wishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                                            </span>
                                                            <span class="icon icon-delete"></span>
                                                        </a>
                                                        {{-- <a href="#quick_view" data-bs-toggle="modal"
                                                            class="box-icon bg_white quickview tf-btn-loading">
                                                            <span class="icon icon-view"></span>
                                                            <span class="tooltip">Quick View</span>
                                                        </a> --}}
                                                    </div>
                                                    <div class="list-product-btn absolute-3">
                                                        <a href="#"
                                                            class="box-icon bg_white quick-add tf-btn-loading style-2 add-to-cart-btn"
                                                            data-id="{{ $product->id }}"
                                                            data-primary-property-values='@json($product->primary_property_values)'>
                                                            <i class="fas fa-cart-plus"></i>
                                                            <span class="text">QUICK ADD</span>
                                                        </a>
                                                    </div>
                                                    @php $size_property_values = getProductPropertyValues($product->id, 'Size') @endphp
                                                    @if ($size_property_values->isNotEmpty())
                                                        <div class="size-list style-2">
                                                            @foreach ($size_property_values as $size_property_value)
                                                                <span>{{ $size_property_value->propertyValue->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="card-product-info">
                                                    <a href="{{ route('frontend.products.product-details', ['slug' => $product->slug]) }}"
                                                        class="title link">{{ $product->name }}
                                                    </a>
                                                    <div class="tf-product-info-price">
                                                        <div class="price-on-sale text_black"
                                                            style="font-size:14px; font-weight: 600;">
                                                            @if ($product_price)
                                                                {{ toIndianCurrency($product_price->selling_price) }}
                                                            @endif
                                                        </div>

                                                        <div class="compare-at-price"
                                                            style="font-size:14px; font-weight: 600;">
                                                            @if ($product_price)
                                                                {{ toIndianCurrency($product_price->actual_price) }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <ul class="list-color-product">
                                                        @php $color_property_values = getProductPropertyValues($product->id, 'Color') @endphp
                                                        @if ($color_property_values->isNotEmpty())
                                                            @foreach ($color_property_values as $color_property_value)
                                                                <li class="list-color-item color-swatch">
                                                                    <span
                                                                        class="tooltip">{{ $color_property_value->propertyValue->name }}
                                                                    </span>
                                                                    <span class="swatch-value"
                                                                        style="background: {{ $color_property_value->propertyValue->color }}">
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round"><span
                                class="icon icon-arrow-left"></span></div>
                        <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round"><span
                                class="icon icon-arrow-right"></span></div>
                        <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
@endsection
