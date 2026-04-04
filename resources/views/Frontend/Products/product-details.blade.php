@extends('layouts.frontend')
@section('title')
    Products | Bamboo Street
@endsection
@section('content')
    <style>
        .text-muted.description ul {
            list-style: none;
            padding-left: 0;
            margin: 1em 0;
        }

        .text-muted.description ol {
            list-style: decimal !important;
            padding-left: 0.8em;
            margin: 1em 0;
        }

        .text-muted.description ol li {
            list-style: decimal !important;
        }

        .text-muted.description ul li {
            position: relative;
            padding-left: 0.8em;
            margin-bottom: 0.5em;
            line-height: 1.5;
        }

        .text-muted.description ul li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.65em;
            width: 0.3em;
            height: 0.3em;
            background-color: rgb(48, 48, 48);
            border-radius: 50%;
        }
    </style>
    <section class="flat-spacing-4 pt_0  mt-5">
        <div class="tf-main-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="tf-product-media-wrap sticky-top">
                            <div class="thumbs-slider">
                                <!-- Thumbnail Swiper -->
                                <div class="swiper tf-product-media-thumbs" id="thumbs-swiper" data-direction="vertical">
                                    <div class="swiper-wrapper">
                                        @foreach ($product_images as $product_image)
                                            <div class="swiper-slide" data-color="white">
                                                <div class="item">
                                                    <img class="lazyload" src="{{ Storage::url($product_image->image) }}"
                                                        data-src="{{ Storage::url($product_image->image) }}"
                                                        alt="img-product">
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ($product->video_type === 'video' && $product->video)
                                            <div class="swiper-slide">
                                                <div class="item">
                                                    <video playsinline autoplay preload="metadata" muted controls loop
                                                        src="{{ Storage::url($product->video) }}"></video>
                                                </div>
                                            </div>
                                        @elseif ($product->video_type === 'youtube_link' && $product->youtube_link)
                                            @php
                                                preg_match(
                                                    '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]+)/',
                                                    $product->youtube_link,
                                                    $matches,
                                                );

                                                $youtube_id = $matches[1] ?? null;
                                                $thumbnail = $youtube_id
                                                    ? "https://img.youtube.com/vi/$youtube_id/0.jpg"
                                                    : null;
                                            @endphp
                                            @if ($thumbnail)
                                                <div class="swiper-slide">
                                                    <div class="item">
                                                        <img src="{{ $thumbnail }}" alt="YouTube Thumbnail"
                                                            style="{{ is_mobile() ? 'width: 75px; height: 107px;' : 'width: 79px; height: 95px;' }}" />

                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <!-- Main Image Swiper -->
                                <div class="swiper tf-product-media-main" id="main-swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($product_images as $product_image)
                                            <div class="swiper-slide" data-color="beige">
                                                <a href="{{ Storage::url($product_image->image) }}" class="item"
                                                    data-pswp-width="770" data-pswp-height="1075">
                                                    <img class="lazyload" src="{{ Storage::url($product_image->image) }}"
                                                        data-zoom="{{ Storage::url($product_image->image) }}"
                                                        data-src="{{ Storage::url($product_image->image) }}" alt="">
                                                </a>
                                            </div>
                                        @endforeach
                                        @if ($product->video_type === 'video' && $product->video)
                                            <div class="swiper-slide">
                                                <div class="item">
                                                    <video playsinline autoplay preload="metadata" muted controls loop
                                                        src="{{ Storage::url($product->video) }}"></video>
                                                </div>
                                            </div>
                                        @elseif ($product->video_type === 'youtube_link' && $product->youtube_link)
                                            @php
                                                preg_match(
                                                    '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]+)/',
                                                    $product->youtube_link,
                                                    $matches,
                                                );

                                                $youtube_id = $matches[1] ?? null;
                                                $embed_link = $youtube_id
                                                    ? "https://www.youtube.com/embed/$youtube_id"
                                                    : null;
                                            @endphp
                                            @if ($embed_link)
                                                <div class="swiper-slide">
                                                    <div class="item">
                                                        <iframe width="100%" height=" {{ is_mobile() ? 400 : 750 }}"
                                                            src="{{ $embed_link }}" title="YouTube video" frameborder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen>
                                                        </iframe>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                    <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tf-product-info-wrap position-relative">
                            {{-- <div class="tf-zoom-main"></div> --}}
                            <div class="tf-product-info-list other-image-zoom">
                                <div class="tf-product-info-title">
                                    <h5>{{ $product->name }}</h5>
                                </div>
                                <div class="tf-product-info-price">
                                    <div class="price-on-sale text_black" id="sellingPrice"></div>
                                    <div class="compare-at-price" id="actualPrice"></div>
                                    <div class="discount-percentage" id="discountPercentage"></div>
                                </div>
                                <div>
                                    <h6 class="fw-6">{{ $product->tag_line }}</h6>
                                </div>
                                <div class="tf-product-info-liveview">
                                    <div class="liveview-count" id="productStock">0</div>
                                    <p class="fw-6" id="stockStatus"></p>
                                </div>
                                <div class="tf-product-info-variant-picker">
                                    @foreach ($product_property_labels as $property_label)
                                        @php
                                            $product_property_values = getProductPropertyValues(
                                                $product->id,
                                                $property_label,
                                            );
                                        @endphp

                                        @if ($product_property_values->isNotEmpty())
                                            <div class="variant-picker-item">
                                                <div class="variant-picker-label">
                                                    {{ $property_label }}: <span
                                                        class="fw-6 variant-picker-label-value"></span>
                                                </div>
                                                <div class="variant-picker-values">
                                                    @foreach ($product_property_values as $product_property_value)
                                                        <input type="radio" class="property-value"
                                                            name="{{ $property_label }}"
                                                            id="{{ $product_property_value->id }}"
                                                            value="{{ $product_property_value->propertyValue->name }}"
                                                            {{ $product_property_value->is_primary === 'YES' ? 'checked' : '' }}
                                                            data-property-value-id="{{ $product_property_value->property_value_id }}"
                                                            data-image-property="{{ $product->primary_property_id == $product_property_value->property_id ? 'YES' : 'NO' }}">

                                                        @if ($property_label == 'Color')
                                                            <label class="hover-tooltip radius-60"
                                                                for="{{ $product_property_value->id }}"
                                                                data-value="{{ $product_property_value->color_name }}">
                                                                <span class="btn-checkbox"
                                                                    style="background: {{ $product_property_value->color_code }}">
                                                                </span>
                                                                <span
                                                                    class="tooltip">{{ $product_property_value->color_name }}</span>
                                                            </label>
                                                        @else
                                                            <label class="style-text"
                                                                for="{{ $product_property_value->id }}"
                                                                data-value="{{ $product_property_value->propertyValue->name }}">
                                                                <p>{{ $product_property_value->propertyValue->name }}</p>
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="tf-product-info-quantity">
                                    <div class="quantity-title fw-6">Quantity</div>
                                    <div class="wg-quantity">
                                        <span class="btn-quantity btn-decrease">-</span>
                                        <input type="text" class="quantity-product" name="quantity" value="1"
                                            id="quantity">
                                        <span class="btn-quantity btn-increase">+</span>
                                    </div>
                                </div>

                                <div class="tf-product-info-buy-button">
                                    <form>
                                        <a href="javascript:void(0);"
                                            class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart add-to-cart-btn"
                                            data-id="{{ $product->id }}">
                                            <span class="cart-btn-text">Add to cart -&nbsp;</span>
                                            <span class="tf-qty-price total-price" id="totalAmount"></span>
                                        </a>
                                        {{-- <a href="javascript:void(0);"
                                            class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart add-to-cart-btn"
                                            data-id="{{ $product->id }}">
                                            <span class="cart-btn-text">Add to cart -&nbsp;</span>
                                            <span class="tf-qty-price total-price" id="totalAmount"></span>
                                        </a> --}}
                                        <a href="javascript:void(0);"
                                            class="tf-product-btn-wishlist hover-tooltip box-icon bg_white btn-icon-action tf-btn-loading product-wishlist {{ $product->is_wishlisted ? 'active' : '' }}"
                                            data-id="{{ $product->id }}">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip" id="wishlist-tooltip-{{ $product->id }}">
                                                {{ $product->is_wishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                            </span>
                                            <span class="icon icon-delete"></span>
                                        </a>
                                    </form>
                                </div>
                                <div class="tf-product-info-delivery-return">
                                    <div class="row">
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery">
                                                <div class="icon">
                                                    <i class="icon-delivery-time"></i>
                                                </div>
                                                <p>Estimate delivery times:
                                                    <span class="fw-7">10-15 days</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery mb-0">
                                                <div class="icon">
                                                    <i class="icon-return-order"></i>
                                                </div>
                                                <p>Return within <span class="fw-7">07 days</span> of purchase. Duties &
                                                    taxes are non-refundable.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-product-info-trust-seal">
                                    <div class="tf-product-trust-mess">
                                        <i class="icon-safe"></i>
                                        <p class="fw-6">Guarantee Safe <br> Checkout</p>
                                    </div>
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
        </div>
    </section>
    <!-- /default -->

    {{-- @if ($product->video_type && ($product->video || $product->youtube_link))
        <section class="flat-spacing-8 pb_0">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="tf-product-media-wrap sticky-top">
                            <div class="thumbs-slider">
                                <div dir="ltr" class="swiper tf-product-media-thumbs" data-direction="vertical">
                                    <div class="swiper-wrapper stagger-wrap"></div>
                                </div>
                                <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                    <div class="swiper-wrapper">
                                        @if ($product->video_type === 'video' && $product->video)
                                          
                                            <div class="swiper-slide" data-color="beige">
                                                <video class="w-100 h-100 object-fit-cover" controls>
                                                    <source src="{{ Storage::url($product->video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @elseif ($product->video_type === 'youtube_link' && $product->youtube_link)
                                           
                                            @php
                                                $videoID = getYoutubeEmbedUrl($product->youtube_link);
                                            @endphp

                                            @if ($videoID)
                                                <div class="swiper-slide" data-color="beige">
                                                    <iframe class="w-100 h-100 object-fit-cover"
                                                        src="https://www.youtube.com/embed/{{ $videoID }}?rel=0&showinfo=0"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif --}}

    <!-- list -->
    <section class="flat-spacing-10">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div>
                        <div class="d-flex flex-column gap-20">
                            <div class="row g-4">
                                <!-- Description -->
                                <div class="col-12 col-md-4">
                                    <div class="p-4 border rounded shadow-sm h-100 bg-white">
                                        <h5 class="fw-bold mb-3">Description</h5>
                                        <div class="text-muted description">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Highlights -->
                                <div class="col-12 col-md-4">
                                    <div class="p-4 border rounded shadow-sm h-100 bg-white">
                                        <h5 class="fw-bold mb-3">Highlights</h5>
                                        {{-- <div class="text-muted">{!! $product->highlights !!}</div> --}}
                                        <div class="text-muted description">
                                            {!! $product->highlights !!}
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <div class="col-12 col-md-4">
                                    <div class="p-4 border rounded shadow-sm h-100 bg-white">
                                        <h5 class="fw-bold mb-3">Additional Information</h5>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($product_property_labels as $property_label)
                                                @php
                                                    $values = getProductPropertyValues($product->id, $property_label)
                                                        ->map(fn($v) => $v->propertyValue->name)
                                                        ->implode(', ');
                                                @endphp
                                                <li class="mb-2">
                                                    <span class="fw-bold fs-16" style="color: #34634b">
                                                        {{ $property_label }}:</span>
                                                    <span class="text-secondary fs-16"> {{ $values }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="lg_fs_18 fw-6 line py_15">Review</div>
                                <div class="py_20 lg_py_30">
                                    <div class="tab-reviews write-cancel-review-wrap">
                                        <div class="tab-reviews-heading">
                                            <div class="top">
                                                <div class="text-center">
                                                    <h1 class="number fw-6">{{ $product_review->average_rating }}
                                                    </h1>

                                                    <div class="list-star">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= floor($product_review->average_rating))
                                                                <i class="icon icon-star"></i> {{-- Full Star --}}
                                                            @elseif ($i - 0.5 <= $product_review->average_rating)
                                                                <i class="icon icon-star-half"></i> {{-- Half Star --}}
                                                            @else
                                                                <i class="icon icon-star" style="color: gray;"></i>
                                                                {{-- Empty Star --}}
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <p>({{ $product_review->total_reviews }} Ratings)</p>
                                                </div>
                                                <div class="rating-score">
                                                    <div class="item">
                                                        <div class="number-1 text-caption-1">5</div>
                                                        <i class="icon icon-star"></i>
                                                        <div class="line-bg">
                                                            <div
                                                                style="width: {{ $product_review->total_reviews > 0 ? ($product_review->five_star_count / $product_review->total_reviews) * 100 : 0 }}%;">
                                                            </div>
                                                        </div>
                                                        <div class="number-2 text-caption-1">
                                                            {{ $product_review->five_star_count }}</div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="number-1 text-caption-1">4</div>
                                                        <i class="icon icon-star"></i>
                                                        <div class="line-bg">
                                                            <div
                                                                style="width: {{ $product_review->total_reviews > 0 ? ($product_review->four_star_count / $product_review->total_reviews) * 100 : 0 }}%;">
                                                            </div>
                                                        </div>
                                                        <div class="number-2 text-caption-1">
                                                            {{ $product_review->four_star_count }}</div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="number-1 text-caption-1">3</div>
                                                        <i class="icon icon-star"></i>
                                                        <div class="line-bg">
                                                            <div
                                                                style="width: {{ $product_review->total_reviews > 0 ? ($product_review->three_star_count / $product_review->total_reviews) * 100 : 0 }}%;">
                                                            </div>
                                                        </div>
                                                        <div class="number-2 text-caption-1">
                                                            {{ $product_review->three_star_count }}</div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="number-1 text-caption-1">2</div>
                                                        <i class="icon icon-star"></i>
                                                        <div class="line-bg">
                                                            <div
                                                                style="width: {{ $product_review->total_reviews > 0 ? ($product_review->two_star_count / $product_review->total_reviews) * 100 : 0 }}%;">
                                                            </div>
                                                        </div>
                                                        <div class="number-2 text-caption-1">
                                                            {{ $product_review->two_star_count }}</div>
                                                    </div>
                                                    <div class="item">
                                                        <div class="number-1 text-caption-1">1</div>
                                                        <i class="icon icon-star"></i>
                                                        <div class="line-bg">
                                                            <div
                                                                style="width: {{ $product_review->total_reviews > 0 ? ($product_review->one_star_count / $product_review->total_reviews) * 100 : 0 }}%;">
                                                            </div>
                                                        </div>
                                                        <div class="number-2 text-caption-1">
                                                            {{ $product_review->one_star_count }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (isOrderedProduct($product->id))
                                                <div>
                                                    <div
                                                        class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-cancel-review">
                                                        Cancel Review
                                                    </div>
                                                    <div
                                                        class="tf-btn btn-outline-dark fw-6 btn-comment-review btn-write-review">
                                                        Write a review
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                        <div class="reply-comment cancel-review-wrap">
                                            <div class="reply-comment-wrap">
                                                <div class="reply-comment-item">
                                                    @if ($product->reviews->isNotEmpty())
                                                        @foreach ($product->reviews as $review)
                                                            <div class="reply-comment-item">
                                                                <div class="user">
                                                                    <div class="image">
                                                                        <img src="/frontend/images/item/user.png"
                                                                            alt="user-profile">
                                                                    </div>
                                                                    <div>
                                                                        <h6>
                                                                            <a href="#" class="link">
                                                                                {{ $review->title }}
                                                                            </a>
                                                                        </h6>
                                                                        <div class="day text_black-2">
                                                                            {{ $review->created_at->diffForHumans() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="text_black-2">{{ $review->description }}</p>
                                                                @if ($review->photos)
                                                                    <div class="review-images mt-2 d-flex flex-wrap gap-2">
                                                                        @foreach ($review->photos as $photo)
                                                                            <div class="review-image-item">
                                                                                <a href="{{ asset('storage/' . $photo) }}"
                                                                                    target="_blank">
                                                                                    <img src="{{ asset('storage/' . $photo) }}"
                                                                                        width="100" height="100"
                                                                                        class="img-thumbnail">
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <form class="form-write-review write-review-wrap"
                                            action="{{ route('frontend.reviews.store') }}" method="POST"
                                            id="reviewForm" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="heading">
                                                <h5>Write a review:</h5>
                                                <div class="list-rating-check">
                                                    <input type="radio" id="star5" name="rating" value="5"
                                                        checked />
                                                    <label for="star5" title="text"></label>
                                                    <input type="radio" id="star4" name="rating"
                                                        value="4" />
                                                    <label for="star4" title="text"></label>
                                                    <input type="radio" id="star3" name="rating"
                                                        value="3" />
                                                    <label for="star3" title="text"></label>
                                                    <input type="radio" id="star2" name="rating"
                                                        value="2" />
                                                    <label for="star2" title="text"></label>
                                                    <input type="radio" id="star1" name="rating"
                                                        value="1" />
                                                    <label for="star1" title="text"></label>
                                                </div>
                                            </div>
                                            <div class="form-content">
                                                <fieldset class="box-field">
                                                    <label class="label">Review Title</label>
                                                    <input type="text" placeholder="Give your review a title"
                                                        name="title" tabindex="2" aria-required="true">
                                                    <span class="text-danger" id="title_error"></span>
                                                </fieldset>
                                                <fieldset class="box-field">
                                                    <label class="label">Review Description</label>
                                                    <textarea rows="4" name="description" placeholder="Write your comment here" tabindex="2"
                                                        aria-required="true"></textarea>
                                                    <span class="text-danger" id="description_error"></span>
                                                </fieldset>
                                                <div class="col-6">
                                                    <fieldset class="box-field">
                                                        <label class="label">Upload Photos</label>
                                                        <input type="file" name="photos[]" class="form-control"
                                                            multiple accept="image/*">
                                                        <div id="imagePreview" class="image-preview-grid"></div>
                                                        <span class="text-danger" id="photos_error"></span>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="button-submit">
                                                <button class="tf-btn btn-fill animate-hover-btn" type="submit"
                                                    id="submitReviewBtn">
                                                    <span id="submitReviewBtnText"
                                                        style="display: inline-block; min-width: 100px;">Submit
                                                        Review</span>
                                                    <span id="submitReviewBtnLoader" class="d-none"
                                                        style="display: inline-block; min-width: 100px;">
                                                        <span class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script>
        $(document).ready(function() {
            let selectedPropertyValues = getSelectedPropertyValues();
            //   getProductImages(selectedPropertyValues);
            getProductPrice(selectedPropertyValues);

            $('.property-value').change(function() {
                let isImageProperty = $(this).data('image-property') === "YES"

                let selectedPropertyValues = getSelectedPropertyValues();

                if (isImageProperty) {
                    //   getProductImages(selectedPropertyValues);
                    getProductPrice(selectedPropertyValues);
                } else {
                    getProductPrice(selectedPropertyValues);
                }
            });

            $('#reviewForm').submit(function(e) {
                e.preventDefault();

                $('#submitReviewBtnText').addClass('d-none');
                $('#submitReviewBtnLoader').removeClass('d-none');
                $('#submitReviewBtn').prop('disabled', true);

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $('#submitReviewBtnText').removeClass('d-none');
                        $('#submitReviewBtnLoader').addClass('d-none');
                        $('#submitReviewBtn').prop('disabled', false);

                        if (response.status == 'success') {
                            toastr.success(
                                response.message,
                                '', {
                                    showMethod: "slideDown",
                                    timeOut: 1000,
                                    closeButton: true,
                                });

                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $('#submitReviewBtnText').removeClass('d-none');
                        $('#submitReviewBtnLoader').addClass('d-none');
                        $('#submitReviewBtn').prop('disabled', false);
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#' + key + '_error').html(value);
                        });
                    }
                });
            });
        });

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

        // Function to fetch product images
        // function getProductImages(propertyValues) {
        //   $('#image-section').empty();
        //   $.ajax({
        //     url: "{{ route('frontend.products.images', ['product' => $product->route_key]) }}",
        //     type: 'POST',
        //     data: {
        //       _token: '{{ csrf_token() }}',
        //       property_values: propertyValues
        //     },
        //     success: function(response) {
        //       $('#image-section').html(response);

        //       initSwipers();

        //     },
        //     error: function(error) {
        //       console.log(error);
        //     }
        //   });
        // }

        // Function to fetch product price
        function getProductPrice(propertyValues) {
            $.ajax({
                url: "{{ route('frontend.products.price', ['product' => $product->route_key]) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    property_values: propertyValues
                },
                success: function(response) {
                    if (response.product_price) {
                        $('#sellingPrice').text('₹' + response.product_price.selling_price);
                        $('#actualPrice').text('₹' + response.product_price.actual_price);
                        $('#totalAmount').text('₹' + response.product_price.selling_price);

                        const stock = response.product_price.stock;

                        if (stock === 0) {
                            $('#productStock').text('Out of Stock');
                            $('#stockStatus').text('');
                            $('.tf-product-info-liveview').show();
                        } else if (stock === 1) {
                            $('#productStock').text('Only 1 item left in stock');
                            $('#stockStatus').text('');
                            $('.tf-product-info-liveview').show();
                        } else {
                            $('.tf-product-info-liveview').hide(); // hide entire div when stock > 1
                        }

                        const discount = Math.round(response.product_price.discount_percentage);
                        if (discount > 0) {
                            $('#discountPercentage').html('<span>' + discount + '</span>% OFF');
                        } else {
                            $('#discountPercentage').html('');
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        // Function to initialize Swipers
        function initSwipers(totalImages) {
            var direction = $(".tf-product-media-thumbs").data("direction");

            // Initialize Thumbnails Swiper
            var thumbs = new Swiper(".tf-product-media-thumbs", {
                spaceBetween: 10,
                slidesPerView: "auto",
                // slidesPerView: 2,
                direction: "vertical",
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                breakpoints: {
                    0: {
                        direction: "horizontal",
                        slidesPerView: 5,
                    },
                    1150: {
                        direction: "vertical",
                        direction: direction,
                    },
                },
                450: {
                    direction: "vertical",
                },
            });

            // Initialize Main Swiper
            var main = new Swiper(".tf-product-media-main", {
                spaceBetween: 0,
                observer: true,
                observeParents: true,
                navigation: {
                    nextEl: ".thumbs-next",
                    prevEl: ".thumbs-prev",
                },
                thumbs: {
                    swiper: thumbs,
                },
            });
        }
    </script>
    <!-- /list -->
@endsection
