<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- font -->
    <link rel="stylesheet" href="/frontend/fonts/fonts.css">
    <link rel="stylesheet" href="/frontend/fonts/font-icons.css">
    <link rel="stylesheet" href="/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/frontend/css/animate.css">
    <link rel="stylesheet" href="/frontend/css/drift-basic.min.css">
    <link rel="stylesheet" href="/frontend/css/photoswipe.css">
    <link rel="stylesheet" href="/frontend/css/technicul.css">
    <link rel="stylesheet"type="text/css" href="/frontend/css/styles.css" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="/frontend/tcul-img/Itsroop.webp">
    <link rel="apple-touch-icon-precomposed" href="/frontend/tcul-img/Itsroop.webp">

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    {{-- Jquery --}}
    <script type="text/javascript" src="/frontend/js/jquery.min.js"></script>
    <script type="text/javascript" src="/frontend/js/bootstrap.min.js"></script>

    <script type="module" src="/frontend/js/model-viewer.min.js"></script>
    <script type="module" src="/frontend/js/zoom.js"></script>


    <!-- TOASTR -->
    <script src="/backend/dist/js/plugins/toastr-init.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Auth check --}}
    <script>
        var isAuthenticated = @json(Auth::check());
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DK3FN2HZZN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-DK3FN2HZZN');
    </script>

</head>

<body class="preload-wrapper popup-loader">
    <!-- preload -->
    {{-- <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div> --}}
    <!-- /preload -->
    <div id="wrapper">

        <!-- Header -->

        <header id="header" class="header-default header-absolute">
            <div class="px_15 lg-px_40">
                <div class="row wrapper-header align-items-center">
                    <div class="col-md-4 col-3 tf-lg-hidden">
                        <a href="#mobileMenu" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 16"
                                fill="none">
                                <path
                                    d="M2.00056 2.28571H16.8577C17.1608 2.28571 17.4515 2.16531 17.6658 1.95098C17.8802 1.73665 18.0006 1.44596 18.0006 1.14286C18.0006 0.839753 17.8802 0.549063 17.6658 0.334735C17.4515 0.120408 17.1608 0 16.8577 0H2.00056C1.69745 0 1.40676 0.120408 1.19244 0.334735C0.978109 0.549063 0.857702 0.839753 0.857702 1.14286C0.857702 1.44596 0.978109 1.73665 1.19244 1.95098C1.40676 2.16531 1.69745 2.28571 2.00056 2.28571ZM0.857702 8C0.857702 7.6969 0.978109 7.40621 1.19244 7.19188C1.40676 6.97755 1.69745 6.85714 2.00056 6.85714H22.572C22.8751 6.85714 23.1658 6.97755 23.3801 7.19188C23.5944 7.40621 23.7148 7.6969 23.7148 8C23.7148 8.30311 23.5944 8.59379 23.3801 8.80812C23.1658 9.02245 22.8751 9.14286 22.572 9.14286H2.00056C1.69745 9.14286 1.40676 9.02245 1.19244 8.80812C0.978109 8.59379 0.857702 8.30311 0.857702 8ZM0.857702 14.8571C0.857702 14.554 0.978109 14.2633 1.19244 14.049C1.40676 13.8347 1.69745 13.7143 2.00056 13.7143H12.2863C12.5894 13.7143 12.8801 13.8347 13.0944 14.049C13.3087 14.2633 13.4291 14.554 13.4291 14.8571C13.4291 15.1602 13.3087 15.4509 13.0944 15.6653C12.8801 15.8796 12.5894 16 12.2863 16H2.00056C1.69745 16 1.40676 15.8796 1.19244 15.6653C0.978109 15.4509 0.857702 15.1602 0.857702 14.8571Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="/" class="logo-header">
                            <img src="/frontend/tcul-img/logo.png" alt="logo" class="logo" style="width: 180px;">
                        </a>
                    </div>
                    <div class="col-xl-6 tf-md-hidden">
                        <nav class="box-navigation text-center">
                            <ul class="box-nav-ul d-flex align-items-center justify-content-center gap-30">
                                <li class="menu-item">
                                    <a href="/" class="item-link">Home</a>

                                </li>
                                <li class="menu-item">
                                    <a href="#" class="item-link">Shop<i class="icon icon-arrow-down"></i></a>
                                    <div class="sub-menu mega-menu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <div class="mega-menu-item">
                                                        <div class="menu-heading">Shop layouts</div>
                                                        <ul class="menu-list">
                                                            <li><a href="#0" class="menu-link-text link">Shoe</a>
                                                            </li>
                                                            <li><a href="#0" class="menu-link-text link">Watch</a>
                                                            </li>
                                                            <li><a href="#0" class="menu-link-text link">Bages</a>
                                                            </li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Perfumes</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mega-menu-item">
                                                        <div class="menu-heading">Features</div>
                                                        <ul class="menu-list">
                                                            <li><a href="#0" class="menu-link-text link">Shoe</a>
                                                            </li>
                                                            <li><a href="#0" class="menu-link-text link">Watch</a>
                                                            </li>
                                                            <li><a href="#0" class="menu-link-text link">Bages</a>
                                                            </li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Perfumes</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mega-menu-item">
                                                        <div class="menu-heading">Product styles</div>
                                                        <ul class="menu-list">
                                                            <li><a href="#0" class="menu-link-text link">Shoe</a>
                                                            </li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Watch</a></li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Bages</a></li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Perfumes</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="collection-item hover-img">
                                                        <div class="collection-inner">
                                                            <a href="#0" class="collection-image img-style">
                                                                <img class="lazyload"
                                                                    data-src="/frontend/images/collections/collection-1.jpg"
                                                                    src="/frontend/images/collections/collection-1.jpg"
                                                                    alt="collection-demo-1">
                                                            </a>
                                                            <div class="collection-content">
                                                                <a href="#0"
                                                                    class="tf-btn hover-icon btn-xl collection-title fs-16"><span>Men</span><i
                                                                        class="icon icon-arrow1-top-left"></i></a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="collection-item hover-img">
                                                        <div class="collection-inner">
                                                            <a href="#0" class="collection-image img-style">
                                                                <img class="lazyload"
                                                                    data-src="/frontend/images/collections/collection-2.jpg"
                                                                    src="/frontend/images/collections/collection-2.jpg"
                                                                    alt="collection-demo-1">
                                                            </a>
                                                            <div class="collection-content">
                                                                <a href="#0"
                                                                    class="tf-btn btn-xl collection-title fs-16 hover-icon"><span>Women</span><i
                                                                        class="icon icon-arrow1-top-left"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="menu-item">
                                    <a href="#" class="item-link">Products<i
                                            class="icon icon-arrow-down"></i></a>
                                    <div class="sub-menu mega-menu">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <div class="mega-menu-item">
                                                        <div class="menu-heading">Product layouts</div>
                                                        <ul class="menu-list">
                                                            <li><a href="#0" class="menu-link-text link">Shoe</a>
                                                            </li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Watch</a></li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Bages</a></li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Perfumes</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mega-menu-item">
                                                        <div class="menu-heading">Product details</div>
                                                        <ul class="menu-list">
                                                            <li><a href="#0" class="menu-link-text link">Shoe</a>
                                                            </li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Watch</a></li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Bages</a></li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Perfumes</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mega-menu-item">
                                                        <div class="menu-heading">Product swatchs</div>
                                                        <ul class="menu-list">
                                                            <li><a href="#0" class="menu-link-text link">Shoe</a>
                                                            </li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Watch</a></li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Bages</a></li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Perfumes</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mega-menu-item">
                                                        <div class="menu-heading">Product features</div>
                                                        <ul class="menu-list">
                                                            <li><a href="#0" class="menu-link-text link">Shoe</a>
                                                            </li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Watch</a></li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Bages</a></li>
                                                            <li><a href="#0"
                                                                    class="menu-link-text link">Perfumes</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="menu-heading">Best seller</div>
                                                    <div class="hover-sw-nav hover-sw-2">
                                                        <div dir="ltr" class="swiper tf-product-header">
                                                            <div class="swiper-wrapper">
                                                                <div class="swiper-slide" lazy="true">
                                                                    <div class="card-product">
                                                                        <div class="card-product-wrapper">
                                                                            <a href="#" class="product-img">
                                                                                <img class="lazyload img-product"
                                                                                    data-src="/frontend/images/products/orange-1.jpg"
                                                                                    src="/frontend/images/products/orange-1.jpg"
                                                                                    alt="image-product">
                                                                                <img class="lazyload img-hover"
                                                                                    data-src="/frontend/images/products/white-1.jpg"
                                                                                    src="/frontend/images/products/white-1.jpg"
                                                                                    alt="image-product">
                                                                            </a>
                                                                            <div class="list-product-btn absolute-2">
                                                                                <a href="#quick_add"
                                                                                    data-bs-toggle="modal"
                                                                                    class="box-icon bg_white quick-add tf-btn-loading">
                                                                                    <span class="icon icon-bag"></span>
                                                                                    <span class="tooltip">Quick
                                                                                        Add</span>
                                                                                </a>
                                                                                <a href="javascript:void(0);"
                                                                                    class="box-icon bg_white wishlist btn-icon-action">
                                                                                    <span
                                                                                        class="icon icon-heart"></span>
                                                                                    <span class="tooltip">Add to
                                                                                        Wishlist</span>
                                                                                    <span
                                                                                        class="icon icon-delete"></span>
                                                                                </a>
                                                                                <a href="#compare"
                                                                                    data-bs-toggle="offcanvas"
                                                                                    aria-controls="offcanvasLeft"
                                                                                    class="box-icon bg_white compare btn-icon-action">
                                                                                    <span
                                                                                        class="icon icon-compare"></span>
                                                                                    <span class="tooltip">Add to
                                                                                        Compare</span>
                                                                                    <span
                                                                                        class="icon icon-check"></span>
                                                                                </a>
                                                                                <a href="#quick_view"
                                                                                    data-bs-toggle="modal"
                                                                                    class="box-icon bg_white quickview tf-btn-loading">
                                                                                    <span
                                                                                        class="icon icon-view"></span>
                                                                                    <span class="tooltip">Quick
                                                                                        View</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-product-info">
                                                                            <a href="#"
                                                                                class="title link">Ribbed Tank Top</a>
                                                                            <span class="price">$16.95</span>
                                                                            <ul class="list-color-product">
                                                                                <li
                                                                                    class="list-color-item color-swatch active">
                                                                                    <span class="tooltip">Orange</span>
                                                                                    <span
                                                                                        class="swatch-value bg_orange-3"></span>
                                                                                    <img class="lazyload"
                                                                                        data-src="/frontend/images/products/orange-1.jpg"
                                                                                        src="/frontend/images/products/orange-1.jpg"
                                                                                        alt="image-product">
                                                                                </li>
                                                                                <li
                                                                                    class="list-color-item color-swatch">
                                                                                    <span class="tooltip">Black</span>
                                                                                    <span
                                                                                        class="swatch-value bg_dark"></span>
                                                                                    <img class="lazyload"
                                                                                        data-src="/frontend/images/products/black-1.jpg"
                                                                                        src="/frontend/images/products/black-1.jpg"
                                                                                        alt="image-product">
                                                                                </li>
                                                                                <li
                                                                                    class="list-color-item color-swatch">
                                                                                    <span class="tooltip">White</span>
                                                                                    <span
                                                                                        class="swatch-value bg_white"></span>
                                                                                    <img class="lazyload"
                                                                                        data-src="/frontend/images/products/white-1.jpg"
                                                                                        src="/frontend/images/products/white-1.jpg"
                                                                                        alt="image-product">
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="swiper-slide" lazy="true">
                                                                    <div class="card-product">
                                                                        <div class="card-product-wrapper">
                                                                            <div class="product-img">
                                                                                <img class="lazyload img-product"
                                                                                    data-src="/frontend/images/products/white-3.jpg"
                                                                                    src="/frontend/images/products/white-3.jpg"
                                                                                    alt="image-product">
                                                                                <img class="lazyload img-hover"
                                                                                    data-src="/frontend/images/products/white-4.jpg"
                                                                                    src="/frontend/images/products/white-4.jpg"
                                                                                    alt="image-product">
                                                                            </div>
                                                                            <div class="list-product-btn absolute-2">
                                                                                <a href="#shoppingCart"
                                                                                    data-bs-toggle="modal"
                                                                                    class="box-icon bg_white quick-add tf-btn-loading">
                                                                                    <span class="icon icon-bag"></span>
                                                                                    <span class="tooltip">Add to
                                                                                        cart</span>
                                                                                </a>
                                                                                <a href="javascript:void(0);"
                                                                                    class="box-icon bg_white wishlist btn-icon-action">
                                                                                    <span
                                                                                        class="icon icon-heart"></span>
                                                                                    <span class="tooltip">Add to
                                                                                        Wishlist</span>
                                                                                    <span
                                                                                        class="icon icon-delete"></span>
                                                                                </a>
                                                                                <a href="#compare"
                                                                                    data-bs-toggle="offcanvas"
                                                                                    aria-controls="offcanvasLeft"
                                                                                    class="box-icon bg_white compare btn-icon-action">
                                                                                    <span
                                                                                        class="icon icon-compare"></span>
                                                                                    <span class="tooltip">Add to
                                                                                        Compare</span>
                                                                                    <span
                                                                                        class="icon icon-check"></span>
                                                                                </a>
                                                                                <a href="#quick_view"
                                                                                    data-bs-toggle="modal"
                                                                                    class="box-icon bg_white quickview tf-btn-loading">
                                                                                    <span
                                                                                        class="icon icon-view"></span>
                                                                                    <span class="tooltip">Quick
                                                                                        View</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-product-info">
                                                                            <a href="#"
                                                                                class="title link">Oversized Printed
                                                                                T-shirt</a>
                                                                            <span class="price">$10.00</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="swiper-slide" lazy="true">
                                                                    <div class="card-product">
                                                                        <div class="card-product-wrapper">
                                                                            <div class="product-img">
                                                                                <img class="lazyload img-product"
                                                                                    data-src="/frontend/images/products/white-2.jpg"
                                                                                    src="/frontend/images/products/white-2.jpg"
                                                                                    alt="image-product">
                                                                                <img class="lazyload img-hover"
                                                                                    data-src="/frontend/images/products/pink-1.jpg"
                                                                                    src="/frontend/images/products/pink-1.jpg"
                                                                                    alt="image-product">
                                                                            </div>
                                                                            <div class="list-product-btn">
                                                                                <a href="#quick_add"
                                                                                    data-bs-toggle="modal"
                                                                                    class="box-icon bg_white quick-add tf-btn-loading">
                                                                                    <span class="icon icon-bag"></span>
                                                                                    <span class="tooltip">Quick
                                                                                        Add</span>
                                                                                </a>
                                                                                <a href="javascript:void(0);"
                                                                                    class="box-icon bg_white wishlist btn-icon-action">
                                                                                    <span
                                                                                        class="icon icon-heart"></span>
                                                                                    <span class="tooltip">Add to
                                                                                        Wishlist</span>
                                                                                    <span
                                                                                        class="icon icon-delete"></span>
                                                                                </a>
                                                                                <a href="#compare"
                                                                                    data-bs-toggle="offcanvas"
                                                                                    aria-controls="offcanvasLeft"
                                                                                    class="box-icon bg_white compare btn-icon-action">
                                                                                    <span
                                                                                        class="icon icon-compare"></span>
                                                                                    <span class="tooltip">Add to
                                                                                        Compare</span>
                                                                                    <span
                                                                                        class="icon icon-check"></span>
                                                                                </a>
                                                                                <a href="#quick_view"
                                                                                    data-bs-toggle="modal"
                                                                                    class="box-icon bg_white quickview tf-btn-loading">
                                                                                    <span
                                                                                        class="icon icon-view"></span>
                                                                                    <span class="tooltip">Quick
                                                                                        View</span>
                                                                                </a>
                                                                            </div>
                                                                            <div class="size-list">
                                                                                <span>S</span>
                                                                                <span>M</span>
                                                                                <span>L</span>
                                                                                <span>XL</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-product-info">
                                                                            <a href="#" class="title">Oversized
                                                                                Printed T-shirt</a>
                                                                            <span class="price">$16.95</span>
                                                                            <ul class="list-color-product">
                                                                                <li
                                                                                    class="list-color-item color-swatch active">
                                                                                    <span class="tooltip">White</span>
                                                                                    <span
                                                                                        class="swatch-value bg_white"></span>
                                                                                    <img class="lazyload"
                                                                                        data-src="/frontend/images/products/white-2.jpg"
                                                                                        src="/frontend/images/products/white-2.jpg"
                                                                                        alt="image-product">
                                                                                </li>
                                                                                <li
                                                                                    class="list-color-item color-swatch">
                                                                                    <span class="tooltip">Pink</span>
                                                                                    <span
                                                                                        class="swatch-value bg_purple"></span>
                                                                                    <img class="lazyload"
                                                                                        data-src="/frontend/images/products/pink-1.jpg"
                                                                                        src="/frontend/images/products/pink-1.jpg"
                                                                                        alt="image-product">
                                                                                </li>
                                                                                <li
                                                                                    class="list-color-item color-swatch">
                                                                                    <span class="tooltip">Black</span>
                                                                                    <span
                                                                                        class="swatch-value bg_dark"></span>
                                                                                    <img class="lazyload"
                                                                                        data-src="/frontend/images/products/black-2.jpg"
                                                                                        src="/frontend/images/products/black-2.jpg"
                                                                                        alt="image-product">
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="swiper-slide" lazy="true">
                                                                    <div class="card-product">
                                                                        <div class="card-product-wrapper">
                                                                            <div class="product-img">
                                                                                <img class="lazyload img-product"
                                                                                    data-src="/frontend/images/products/brown-2.jpg"
                                                                                    src="/frontend/images/products/brown-2.jpg"
                                                                                    alt="image-product">
                                                                                <img class="lazyload img-hover"
                                                                                    data-src="/frontend/images/products/brown-3.jpg"
                                                                                    src="/frontend/images/products/brown-3.jpg"
                                                                                    alt="image-product">
                                                                            </div>
                                                                            <div class="size-list">
                                                                                <span>S</span>
                                                                                <span>M</span>
                                                                                <span>L</span>
                                                                                <span>XL</span>
                                                                            </div>
                                                                            <div class="list-product-btn">
                                                                                <a href="#quick_add"
                                                                                    data-bs-toggle="modal"
                                                                                    class="box-icon bg_white quick-add tf-btn-loading">
                                                                                    <span class="icon icon-bag"></span>
                                                                                    <span class="tooltip">Quick
                                                                                        Add</span>
                                                                                </a>
                                                                                <a href="javascript:void(0);"
                                                                                    class="box-icon bg_white wishlist btn-icon-action">
                                                                                    <span
                                                                                        class="icon icon-heart"></span>
                                                                                    <span class="tooltip">Add to
                                                                                        Wishlist</span>
                                                                                    <span
                                                                                        class="icon icon-delete"></span>
                                                                                </a>
                                                                                <a href="#compare"
                                                                                    data-bs-toggle="offcanvas"
                                                                                    aria-controls="offcanvasLeft"
                                                                                    class="box-icon bg_white compare btn-icon-action">
                                                                                    <span
                                                                                        class="icon icon-compare"></span>
                                                                                    <span class="tooltip">Add to
                                                                                        Compare</span>
                                                                                    <span
                                                                                        class="icon icon-check"></span>
                                                                                </a>
                                                                                <a href="#quick_view"
                                                                                    data-bs-toggle="modal"
                                                                                    class="box-icon bg_white quickview tf-btn-loading">
                                                                                    <span
                                                                                        class="icon icon-view"></span>
                                                                                    <span class="tooltip">Quick
                                                                                        View</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-product-info">
                                                                            <a href="#"
                                                                                class="title link">V-neck linen
                                                                                T-shirt</a>
                                                                            <span class="price">$114.95</span>
                                                                            <ul class="list-color-product">
                                                                                <li
                                                                                    class="list-color-item color-swatch active">
                                                                                    <span class="tooltip">Brown</span>
                                                                                    <span
                                                                                        class="swatch-value bg_brown"></span>
                                                                                    <img class="lazyload"
                                                                                        data-src="/frontend/images/products/brown-2.jpg"
                                                                                        src="/frontend/images/products/brown-2.jpg"
                                                                                        alt="image-product">
                                                                                </li>
                                                                                <li
                                                                                    class="list-color-item color-swatch">
                                                                                    <span class="tooltip">White</span>
                                                                                    <span
                                                                                        class="swatch-value bg_white"></span>
                                                                                    <img class="lazyload"
                                                                                        data-src="/frontend/images/products/white-5.jpg"
                                                                                        src="/frontend/images/products/white-5.jpg"
                                                                                        alt="image-product">
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="nav-sw nav-next-slider nav-next-product-header box-icon w_46 round">
                                                            <span class="icon icon-arrow-left"></span>
                                                        </div>
                                                        <div
                                                            class="nav-sw nav-prev-slider nav-prev-product-header box-icon w_46 round">
                                                            <span class="icon icon-arrow-right"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="menu-item"><a href="/contact" class="item-link text_green-1">Contact
                                        Us</a></li>
                                @auth
                                    <li class="menu-item position-relative">
                                        <a href="#" class="item-link text_green-1">My Account</a>
                                        <div class="sub-menu submenu-default">
                                            <ul class="menu-list">
                                                <li><a href="{{ route('frontend.wishlists') }}"
                                                        class="menu-link-text link text_black-2">My Wishlists</a></li>
                                                <li><a href="{{ route('frontend.orders') }}"
                                                        class="menu-link-text link text_black-2">My Orders</a></li>
                                                <li><a href="{{ route('frontend.profile') }}"
                                                        class="menu-link-text link text_black-2">Profile</a></li>
                                                <li><a href="{{ route('frontend.addresses') }}"
                                                        class="menu-link-text link text_black-2">Addresses</a></li>
                                                <li>
                                                    <form id="logoutForm" action="{{ route('logout') }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                    </form>
                                                    <a href="#" class="menu-link-text link text_black-2"
                                                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @else
                                    <li class="menu-item"><a href="#login" data-bs-toggle="modal"
                                            class="item-link text_green-1">My Account</a></li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-3 col-md-4 col-3">
                        <ul class="nav-icon d-flex justify-content-end align-items-center gap-20">
                            <li class="nav-search">
                                <a href="#canvasSearch" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                    class="nav-icon-item">
                                    <i class="icon icon-search"></i>
                                </a>
                            </li>

                            <li class="nav-account">
                                @auth
                                    <a href="{{ route('frontend.profile') }}" class="nav-icon-item">
                                        <i class="icon icon-account"></i>
                                    </a>
                                @else
                                    <a href="#login" data-bs-toggle="modal" class="nav-icon-item">
                                        <i class="icon icon-account"></i>
                                    </a>
                                @endauth
                            </li>
                            <li class="nav-wishlist"><a href="/wishlists" class="nav-icon-item"><i
                                        class="icon icon-heart"></i><span class="count-box wishlist-count"></span></a>
                            </li>
                            <li class="nav-cart"><a href="{{ route('frontend.cart') }}" class="nav-icon-item"><i
                                        class="fas fa-cart-plus" style="font-size:1.5em;"></i><span
                                        class="count-box cart-count"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->

        <!-- Content -->
        @yield('content')
        <!-- /Content -->

        <!-- Footer -->

        <footer id="footer" class="footer md-pb-70">
            <div class="footer-wrap">
                <div class="footer-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="footer-infor">
                                    <div class="footer-logo">
                                        <a href="/">
                                            <img src="/frontend/tcul-img/logo.png" alt="" width="160px">
                                        </a>
                                    </div>
                                    <ul>
                                        <li>
                                            <p>Address: 1234 Fashion Street, Suite 567, <br> New York, NY 10001</p>
                                        </li>
                                        <li>
                                            <p>Email: <a href="#">info@fashionshop.com</a></p>
                                        </li>
                                        <li>
                                            <p>Phone: <a href="#">(212) 555-1234</a></p>
                                        </li>
                                    </ul>
                                    <a href="#0" class="tf-btn btn-line">Get direction<i
                                            class="icon icon-arrow1-top-left"></i></a>
                                    <ul class="tf-social-icon d-flex gap-10">
                                        <li><a href="#"
                                                class="box-icon w_34 round social-facebook social-line"><i
                                                    class="icon fs-14 icon-fb"></i></a></li>

                                        <li><a href="#"
                                                class="box-icon w_34 round social-instagram social-line"><i
                                                    class="icon fs-14 icon-instagram"></i></a></li>

                                        <li><a href="#"
                                                class="box-icon w_34 round social-pinterest social-line"><i
                                                    class="icon fs-14 icon-pinterest-1"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12 footer-col-block">
                                <div class="footer-heading footer-heading-desktop">
                                    <h6>Help</h6>
                                </div>
                                <div class="footer-heading footer-heading-moblie">
                                    <h6>Help</h6>
                                </div>
                                <ul class="footer-menu-list tf-collapse-content">
                                    <li>
                                        <a href="#0" class="footer-menu_item">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="#0" class="footer-menu_item"> Returns + Exchanges
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0" class="footer-menu_item">Shipping</a>
                                    </li>
                                    <li>
                                        <a href="#0" class="footer-menu_item">Terms &amp;
                                            Conditions</a>
                                    </li>
                                    <li>
                                        <a href="/faq" class="footer-menu_item">FAQ’s</a>
                                    </li>
                                    <li>
                                        <a href="#0" class="footer-menu_item">Compare</a>
                                    </li>
                                    <li>
                                        <a href="#0" class="footer-menu_item">My Wishlist</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="footer-col footer-col-2 footer-col-block">
                                    <div class="footer-heading footer-heading-desktop">
                                        <h6 class="fw-5">About us</h6>
                                    </div>
                                    <div class="footer-heading footer-heading-moblie">
                                        <h6 class="fw-5">About us</h6>
                                    </div>
                                    <ul class="footer-menu-list tf-collapse-content">
                                        <li>
                                            <a href="/about" class="footer-menu_item">Our Story</a>
                                        </li>
                                        <li>
                                            <a href="/contact" class="footer-menu_item">Contact Us</a>
                                        </li>
                                        @auth
                                            <li class="menu-item position-relative">
                                                <a href="/profile" class="footer-menu_item">My Account</a>
                                            </li>
                                        @else
                                            <li class="menu-item"><a href="#login" data-bs-toggle="modal"
                                                    class="footer-menu_item">My Account</a></li>
                                        @endauth

                                        <li>
                                            <a href="/news" class="footer-menu_item">News</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="footer-newsletter footer-col-block">
                                    <div class="footer-heading footer-heading-desktop">
                                        <h6 class="fw-5">Sign Up for Email</h6>
                                    </div>
                                    <div class="footer-heading footer-heading-moblie">
                                        <h6 class="fw-5">Sign Up for Email</h6>
                                    </div>
                                    <div class="tf-collapse-content">
                                        <div class="footer-menu_item">Sign up to get first dibs on new arrivals, sales,
                                            exclusive content, events and more!</div>
                                        <div class="sib-form">
                                            <div id="sib-form-container" class="sib-form-container">
                                                <div id="sib-container"
                                                    class="sib-container--large sib-container--vertical">
                                                    <form method="POST" action="/subscribe-enquiry"
                                                        id="subscribeForm" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="sib-input sib-form-block">
                                                            <div class="form__entry entry_block">
                                                                <div class="form__label-row ">
                                                                    <label class="entry__label" for="EMAIL">
                                                                    </label>
                                                                    <div class="entry__field">
                                                                        <input class="input radius-60" type="text"
                                                                            id="email" class="form-control"
                                                                            name="email" autocomplete="off"
                                                                            placeholder="Enter your Product Here...."
                                                                            data-required="true" />
                                                                        <div class="field_error" id="email-error"
                                                                            style="color:#ff0000"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="sib-form-block">
                                                            <div class="sib-optin sib-form-block">
                                                                <div class="form__entry entry_mcq">
                                                                    <label>
                                                                        <input type="checkbox" name="OPT_IN"
                                                                            id="OPT_IN" value="1" />
                                                                        <span
                                                                            class="checkbox checkbox_tick_positive"></span>
                                                                        I agree to receive updates
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="sib-form-block button-submit">
                                                            <button type="submit" id="started"
                                                                class="sib-form-block__button sib-form-block__button-with-loader tf-btn btn-sm radius-60 btn-fill btn-icon animate-hover-btn">
                                                                Request Your Product <i
                                                                    class="icon icon-arrow1-top-left"></i>
                                                            </button>
                                                            <div id="form_loader" style="display:none;">Loading...
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div
                                    class="footer-bottom-wrap d-flex gap-20 flex-wrap justify-content-between align-items-center">
                                    <div class="footer-menu_item">© 2026 Itsroop Store. All Rights Reserved</div>
                                    <div class="tf-payment">
                                        <img src="/frontend/images/payments/visa.png" alt="">
                                        <img src="/frontend/images/payments/img-1.png" alt="">
                                        <img src="/frontend/images/payments/img-2.png" alt="">
                                        <img src="/frontend/images/payments/img-3.png" alt="">
                                        <img src="/frontend/images/payments/img-4.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /Footer -->
    </div>

    <div class="floating-buttons">
        <!-- WhatsApp Floating Button -->
        <!-- gotop -->
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                    style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;">
                </path>
            </svg>
        </div>
    </div>
    <!-- /gotop -->

    <!-- toolbar-bottom -->
    <div class="tf-toolbar-bottom type-1150">
        <div class="toolbar-item">
            <a href="{{ route('frontend.products') }}">
                <div class="toolbar-icon">
                    <i class="icon-shop"></i>
                </div>
                <div class="toolbar-label">Shop</div>
            </a>
        </div>
        <div class="toolbar-item">
            @auth
                <a href="{{ route('frontend.profile') }}">
                    <div class="toolbar-icon">
                        <i class="icon-account"></i>
                    </div>
                    <div class="toolbar-label">Account</div>
                </a>
            @else
                <a href="#login" data-bs-toggle="modal">
                    <div class="toolbar-icon">
                        <i class="icon-account"></i>
                    </div>
                    <div class="toolbar-label">Account</div>
                </a>
            @endauth
        </div>
        <div class="toolbar-item">
            <a href="{{ route('frontend.wishlists') }}">
                <div class="toolbar-icon">
                    <i class="icon-heart"></i>
                    <div class="count-box wishlist-count toolbar-count">0</div>
                </div>
                <div class="toolbar-label">Wishlist</div>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="{{ route('frontend.cart') }}">
                <div class="toolbar-icon">
                    <i class="fas fa-cart-plus" style="font-size:1.5em;"></i>
                    <div class="count-box cart-count toolbar-count">0</div>
                </div>
                <div class="toolbar-label">Cart</div>
            </a>
        </div>
    </div>
    <!-- /toolbar-bottom -->

    <!-- mobile menu -->
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item">
                        <a href="/" class="mb-menu-link">Home</a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="/products" class="mb-menu-link">Products</a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="/about" class="mb-menu-link">About</a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="/blogs" class="mb-menu-link">Blogs</a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="/contact" class="mb-menu-link">Contact Us</a>
                    </li>

                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-five" class="collapsed mb-menu-link current"
                            data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-five">
                            <span>My Account</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-five" class="collapse">
                            <ul class="sub-nav-menu">
                                <li><a href="{{ route('frontend.wishlists') }}" class="sub-nav-link">My
                                        Wishlists</a>
                                </li>
                                <li><a href="{{ route('frontend.orders') }}" class="sub-nav-link">My Orders</a>
                                </li>
                                <li><a href="{{ route('frontend.profile') }}" class="sub-nav-link">Profile</a></li>
                                <li><a href="{{ route('frontend.addresses') }}" class="sub-nav-link">Addresses</a>
                                </li>
                                <li>
                                    <form id="logoutForm" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#" class="sub-nav-link"
                                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</a>
                                </li>
                            </ul>
                        </div>

                    </li>


                </ul>
                <div class="mb-other-content">
                    {{-- <div class="d-flex group-icon">
                        <a href="/wishlists" class="site-nav-icon"><i class="icon icon-heart"></i>Wishlist</a>
                    </div> --}}
                    <div class="mb-notice">
                        <a href="/contact" class="text-need">Need help ?</a>
                    </div>
                    <ul class="mb-info">
                        {{-- <li>Address: RH No. 43, Grand Kalyan, Opp WALMI, Kanchanwadi, Aurangabad, Maharashtra, India -
                            431136</li> --}}
                        <li><i class="fas fa-phone" style="margin-right: 8px; color: #36614b;"></i>
                            <a href="tel:+91 7304229346"><b>
                                    +91
                                    7304229346</b></a>
                        </li>
                        <li><i class="fas fa-envelope" style="margin-right: 8px; color: #36614b;"></i><a
                                href="mailto:updates@bamboostreet.in"><b>
                                    updates@bamboostreet.in</b></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /mobile menu -->

    {{-- Modals --}}
    @include('Frontend.Modals.login')
    @include('Frontend.Modals.verify-otp')
    @include('Frontend.Modals.register')
    @include('Frontend.Modals.quick-view')
    @include('Frontend.Modals.search')

    <!-- Javascript -->
    <script type="text/javascript" src="/frontend/js/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="/frontend/js/carousel.js"></script>
    <script type="text/javascript" src="/frontend/js/lazysize.min.js"></script>
    <script type="text/javascript" src="/frontend/js/count-down.js"></script>
    <script type="text/javascript" src="/frontend/js/wow.min.js"></script>
    <script type="text/javascript" src="/frontend/js/multiple-modal.js"></script>
    <script type="text/javascript" src="/frontend/js/main.js"></script>
    <script type="text/javascript" src="/frontend/js/drift.min.js"></script>
    <script type="module" src="/frontend/js/zoom.js"></script>
    <script src="/frontend/js/sibforms.js" defer></script>

    {{-- Login & Verify OTP Script - START --}}
    <script>
        $(document).ready(function() {
            $('#login').on('hidden.bs.modal', function() {
                $('#loginForm')[0].reset();
            });

            $('#verifyOtp').on('hidden.bs.modal', function() {
                $('#verifyOtpForm')[0].reset();
            });

            $('#register').on('hidden.bs.modal', function() {
                $('#registerForm')[0].reset();
            });

            $('#loginForm').submit(function(e) {
                e.preventDefault();
                $('#mobileError').empty();

                $('#loginBtnText').addClass('d-none');
                $('#loginBtnLoader').removeClass('d-none');
                $('#loginBtn').prop('disabled', true);

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#loginBtnText').removeClass('d-none');
                        $('#loginBtnLoader').addClass('d-none');
                        $('#loginBtn').prop('disabled', false);

                        if (data.status == 'success') {
                            $('#verifyOtpMobile').val(data.mobile);
                            $('#mobile').val('');
                            $('#otp').val('');
                            $('#login').modal('hide');
                            $('#verifyOtp').modal('show');

                            toastr.success(
                                data.message,
                                '', {
                                    showMethod: "slideDown",
                                    timeOut: 1000,
                                    closeButton: true,
                                });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $('#loginBtnText').removeClass('d-none');
                        $('#loginBtnLoader').addClass('d-none');
                        $('#loginBtn').prop('disabled', false);

                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#mobileError').html(value);
                        });
                    }
                });
            });

            $('#verifyOtpForm').submit(function(e) {
                e.preventDefault();
                $('#otpError').empty();

                $('#verifyOtpBtnText').addClass('d-none');
                $('#verifyOtpBtnLoader').removeClass('d-none');
                $('#verifyOtpBtn').prop('disabled', true);

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#verifyOtpBtnText').removeClass('d-none');
                        $('#verifyOtpBtnLoader').addClass('d-none');
                        $('#verifyOtpBtn').prop('disabled', false);
                        if (data.status == 'success') {
                            $('#user_id').val(data.user_id);
                            $('#verifyOtp').modal('hide');
                            $('#mobile').val('');
                            $('#otp').val('');
                            $('#verifyOtpMobile').val('');

                            toastr.success(
                                data.message,
                                '', {
                                    showMethod: "slideDown",
                                    timeOut: 1000,
                                    closeButton: true,
                                });

                            if (parseInt(data.is_registered) === 0) {
                                $('#register').modal('show');
                                $('#user_id').val(data.user_id);
                            } else {
                                location.reload();
                            }
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $('#verifyOtpBtnText').removeClass('d-none');
                        $('#verifyOtpBtnLoader').addClass('d-none');
                        $('#verifyOtpBtn').prop('disabled', false);
                        if (xhr.responseJSON.status == 'error') {
                            $('#otpError').html(xhr.responseJSON.message);
                        }
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#otpError').html(value);
                        });
                    }
                });
            });

            $('#registerForm').submit(function(e) {
                e.preventDefault();
                $('#first_name_error').empty();
                $('#last_name_error').empty();
                $('#email_error').empty();

                $('#registerBtnText').addClass('d-none');
                $('#registerBtnLoader').removeClass('d-none');
                $('#registerBtn').prop('disabled', true);

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#registerBtnText').removeClass('d-none');
                        $('#registerBtnLoader').addClass('d-none');
                        $('#registerBtn').prop('disabled', false);

                        if (data.status == 'success') {
                            toastr.success(
                                data.message,
                                '', {
                                    showMethod: "slideDown",
                                    timeOut: 1000,
                                    closeButton: true,
                                });

                            location.reload();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $('#registerBtnText').removeClass('d-none');
                        $('#registerBtnLoader').addClass('d-none');
                        $('#registerBtn').prop('disabled', false);

                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#' + key + '_error').html(value);
                        });
                    }
                });
            });
        });
    </script>
    {{-- Login and Verify OTP script - END --}}

    {{-- Product Wishlist - START --}}
    <script>
        $(document).ready(function(e) {
            getWishlistCount();

            $('.product-wishlist').click(function() {
                if (isAuthenticated) {
                    let event = $(this)
                    event.addClass("loading");
                    let productId = $(this).data('id')

                    $.ajax({
                        type: "POST",
                        url: "{{ route('frontend.wishlists.toggle') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            product_id: productId
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                event.removeClass("loading");

                                if (window.location.href.includes('wishlists')) {
                                    event.closest('.card-product').remove();
                                } else {
                                    event.toggleClass("active");
                                    let tooltip = $('#wishlist-tooltip-' + productId);

                                    if (data.message == 'Product added in wishlist.') {
                                        tooltip.text('Remove from wishlist');
                                    } else {
                                        tooltip.text('Add to wishlist');
                                    }
                                }

                                toastr.success(
                                    data.message,
                                    '', {
                                        showMethod: "slideDown",
                                        timeOut: 1000,
                                        closeButton: true,
                                    });

                                getWishlistCount();
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseJSON);
                        }
                    });
                } else {
                    $('#login').modal('show');
                }
            })
        })

        function getWishlistCount() {
            if (!isAuthenticated) {
                $('.wishlist-count').text(0);
                return false;
            }
            $.ajax({
                type: "GET",
                url: "{{ route('frontend.wishlists.count') }}",
                success: function(data) {
                    if (data.status == 'success') {
                        $('.wishlist-count').text(data.wishlist_count);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                }
            });
        }
    </script>
    {{-- Product Wish List - END --}}

    {{-- Product Cart - START --}}
    <script>
        $(document).ready(function(e) {
            $('.add-to-cart-btn').click(function(e) {
                e.preventDefault();
                if (isAuthenticated) {
                    if (window.location.href.includes('details')) {
                        var text = $(this).html();
                    }
                    let productId = $(this).data('id');
                    let propertyValueIds = $(this).data('primary-property-values') ||
                        getSelectedPropertyValues().map(propertyValue => propertyValue.property_value_id);

                    $.ajax({
                        url: "{{ route('frontend.cart.add') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            product_id: productId,
                            property_values: propertyValueIds,
                            quantity: $('#quantity').val(),
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                if (window.location.href.includes('details')) {
                                    $('.add-to-cart-btn').html(text);
                                }

                                getCartCount();

                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(error) {
                            if (error.responseJSON && error.responseJSON.message) {
                                toastr.error(error.responseJSON.message);
                            } else {
                                toastr.error("Something went wrong.");
                            }

                            if (window.location.href.includes('details')) {
                                button.html(originalText);
                            }
                        }
                    });
                } else {
                    $('#login').modal('show');
                }
            })

            $('.remove-cart-btn').click(function(e) {
                e.preventDefault();
                let productId = $(this).data('id');
                let propertyValues = $(this).data('property-values');

                $.ajax({
                    url: "{{ route('frontend.cart.remove') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        property_values: propertyValues
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);

                            setTimeout(() => {
                                location.reload();
                            }, 500);

                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            })

            getCartCount();
        })

        // Function to fetch all selected property values
        function getSelectedPropertyValues() {
            let propertyValues = [];
            $('.property-value:checked').each(function() {
                propertyValues.push({
                    property_value: $(this).val(),
                    property_value_id: $(this).data('property-value-id'),
                    is_image_property: $(this).data('image-property') === "YES" ? 'YES' : 'NO',
                });
            });

            return propertyValues;
        }

        function getCartCount() {
            var totalCartProducts = 0;
            if (!isAuthenticated) {
                $('.cart-count').text(0);
                return false;
            }

            $.ajax({
                type: "GET",
                url: "{{ route('frontend.cart.count') }}",
                success: function(data) {
                    if (data.status == 'success') {
                        $('.cart-count').text(data.cart_count);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                }
            });

            return totalCartProducts;
        }
    </script>
    {{-- Product Cart - END --}}

    {{-- Subscribe ajax --}}
    <script>
        $(document).ready(function() {
            $('#subscribeForm').submit(function(e) {
                e.preventDefault();
                $('div[id$="-error"]').empty();

                var form = $(this);
                var url = form.attr('action');
                var formData = new FormData(this);

                // Ensure CSRF token is included
                formData.append('_token', $('input[name="_token"]').val());

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#started').attr('disabled', true).hide();
                        $('#form_loader').show();
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message, '', {
                                showMethod: "slideDown",
                                hideMethod: "slideUp",
                                timeOut: 1500,
                                closeButton: true,
                            });

                            form[0].reset();
                        }
                    },
                    error: function(xhr) {
                        toastr.error(
                            'There are some errors in the form. Please check your inputs.',
                            '', {
                                showMethod: "slideDown",
                                hideMethod: "slideUp",
                                timeOut: 1500,
                                closeButton: true,
                            });

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                var errorText = Array.isArray(value) ? value.join(
                                    ', ') : value;
                                $('#' + key + '-error').html(errorText);
                            });

                            $('html, body').animate({
                                scrollTop: $('#' + Object.keys(xhr.responseJSON.errors)[
                                    0] + '-error').offset().top - 200
                            }, 500);
                        }
                    },
                    complete: function() {
                        $('#started').attr('disabled', false).show();
                        $('#form_loader').hide();
                    }
                });
            });
        });
    </script>

    {{-- Global Search --}}
    <script>
        $(document).ready(function() {
            $('#searchForm').submit(function(e) {
                e.preventDefault();
                var searchQuery = $('#searchInput').val();

                if (searchQuery) {
                    window.location.href = '/products?search=' + encodeURIComponent(searchQuery);
                }
            });

            $('#searchInput').on('input', function() {
                var searchQuery = $(this).val();
                if (searchQuery.length > 0) {
                    $('#searchBtn').removeAttr('disabled');
                } else {
                    $('#searchBtn').attr('disabled', 'disabled');
                }
            });
        });
    </script>
</body>

</html>
