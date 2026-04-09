@extends('layouts.frontend')
@section('title')
    Products | Itsroop
@endsection
@section('content')
    <!-- page-title -->
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">New Arrival</div>
            <p class="text-center text-2 text_black-2 mt_5">Shop through our latest selection of Fashion</p>
        </div>
    </div>
    <!-- /page-title -->


    <!-- Section Product -->
    <section class="flat-spacing-2">
        <div class="container">
            <div class="tf-shop-control grid-2 align-items-center">
                <div class="tf-control-filter">
                    <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-btn-filter">
                        <span class="icon icon-filter"></span>
                        <span class="text">Filter</span>
                    </a>
                </div>
            </div>
            <div class="tf-categories-wrap justify-content-center">
                <div class="tf-categories-container">
                    @foreach ($product_categories as $category)
                        <div class="collection-item-circle style-2 hover-img">
                            <div class="has-saleoff-wrap position-relative">
                                <a href="{{ route('frontend.products', ['category_slug' => $category->slug]) }}"
                                    class="collection-image img-style">
                                    <img class="lazyload @if (isset($selected_category_slug) && $selected_category_slug === $category->slug) selected-category-img @endif"
                                        data-src="{{ Storage::url($category->image) }}"
                                        src="{{ Storage::url($category->image) }}" alt="collection-img">

                                </a>
                            </div>
                            <div class="collection-content text-center">
                                <a href="{{ route('frontend.products', ['category_slug' => $category->slug]) }}"
                                    class="link title fw-6 
                                        @if (isset($selected_category_slug) && $selected_category_slug === $category->slug) selected-category @endif">
                                    {{ $category->name }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if ($products->isNotEmpty())
                <div class="wrapper-control-shop">
                    <div class="meta-filter-shop">
                        <div id="product-count-grid" class="count-text"></div>
                        <div id="product-count-list" class="count-text"></div>
                        <div id="applied-filters"></div>
                        <button id="remove-all" class="remove-all-filters" style="display: none;">Remove All <i
                                class="icon icon-close"></i></button>
                    </div>
                    <div id="products-container" class="grid-layout wow fadeInUp" data-wow-delay="0s" data-grid="grid-4">
                        <!-- card product -->
                        @foreach ($products as $product)
                            @php
                                $product_image = $product->getImage();
                                $product_price = $product->getPrice();
                            @endphp
                            <div class="card-product fl-item" id="{{ 'product-' . $product->id }}">
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
                                    <div class="list-product-btn">
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
                                            class="box-icon bg_white btn-icon-action tf-btn-loading product-wishlist {{ $product->is_wishlisted ? 'active' : '' }}"
                                            data-id="{{ $product->id }}">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip" id="wishlist-tooltip-{{ $product->id }}">
                                                {{ $product->is_wishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                            </span>
                                            <span class="icon icon-delete"></span>
                                        </a>
                                    </div>
                                    @php $size_property_values = getProductPropertyValues($product->id, 'Size') @endphp
                                    @if ($size_property_values->isNotEmpty())
                                        <div class="size-list">
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
                                        <div class="price-on-sale text_black" style="font-size:14px; font-weight: 600;">
                                            @if ($product_price)
                                                {{ toIndianCurrency($product_price->selling_price) }}
                                            @endif
                                        </div>

                                        @if ($product_price && ($product_price->discount_percentage > 0 || $product_price->discount_price > 0))
                                            <div class="compare-at-price" style="font-size:14px; font-weight: 600;">
                                                {{ toIndianCurrency($product_price->actual_price) }}
                                            </div>
                                            <div class="discount-percentage">
                                                <span>{{ round($product_price->discount_percentage) }}</span>% OFF
                                            </div>
                                        @endif

                                    </div>
                                    <ul class="list-color-product">
                                        @php $color_property_values = getProductPropertyValues($product->id, 'Color') @endphp
                                        @if ($color_property_values->isNotEmpty())
                                            @foreach ($color_property_values as $color_property_value)
                                                <li class="list-color-item color-swatch">
                                                    <span class="tooltip">{{ $color_property_value->color_name }}
                                                    </span>
                                                    <span class="swatch-value"
                                                        style="background: {{ $color_property_value->color_code }}">
                                                    </span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="flat-spacing-2">
                    <div class="container">
                        <div class="tf-categories-wrap justify-content-center">
                            <div class="tf-categories-container">
                                <div class="collection-content text-center">
                                    <h4 class="text_green-1">No Products Found</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- /Section Product -->

    {{-- Filters --}}
    <div class="offcanvas offcanvas-start canvas-filter" id="filterShop">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <div class="filter-icon">
                    <span class="icon icon-filter"></span>
                    <span>Filter</span>
                </div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </header>
            <div class="canvas-body">
                <div class="widget-facet wd-types">
                    <div class="facet-title" data-bs-target="#types" data-bs-toggle="collapse" aria-expanded="true"
                        aria-controls="types">
                        <span>Sub Category</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="types" class="collapse show">
                        <ul class="list-types current-scrollbar mb_36">
                            @foreach ($subCategories as $subCategory)
                                <li class="cate-item">
                                    <a href="{{ request()->fullUrlWithQuery(['sub_category' => $subCategory->name]) }}"
                                        class="link">{{ $subCategory->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <form action="#" id="facet-filter-form" class="facet-filter-form">
                    @if ($properties->isNotEmpty())
                        @foreach ($properties as $property)
                            @php
                                if (strtolower($property->label) == 'size') {
                                    continue;
                                }
                            $property_values = $property->propertyValues()->orderBy('index', 'asc')->get(); @endphp
                            @if ($property->label == 'Color')
                                <div class="widget-facet">
                                    <div class="facet-title" data-bs-target="#color" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="color">
                                        <span>{{ $property->label }}</span>
                                        <span class="icon icon-arrow-up"></span>
                                    </div>
                                    <div id="color" class="collapse show">
                                        <ul class="tf-filter-group filter-color current-scrollbar mb_36">
                                            @if ($property_values->isNotEmpty())
                                                @foreach ($property_values as $property_value)
                                                    <li class="list-item d-flex gap-12 align-items-center">
                                                        <input type="radio" name="{{ $property->label }}"
                                                            class="tf-check-color property-value"
                                                            id="{{ $property_value->id }}"
                                                            value="{{ $property_value->id }}"
                                                            style="background: {{ $property_value->color }}">
                                                        <label for="{{ $property_value->id }}"
                                                            class="label"><span>{{ $property_value->name }}</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="widget-facet">
                                    <div class="facet-title" data-bs-target="#{{ $property->label }}"
                                        data-bs-toggle="collapse" aria-expanded="true"
                                        aria-controls="{{ $property->label }}">
                                        <span>{{ $property->label }}</span>
                                        <span class="icon icon-arrow-up"></span>
                                    </div>
                                    <div id="{{ $property->label }}" class="collapse show">
                                        <ul class="tf-filter-group current-scrollbar">
                                            @if ($property_values->isNotEmpty())
                                                @foreach ($property_values as $property_value)
                                                    <li class="list-item d-flex gap-12 align-items-center">
                                                        <input type="radio" name="{{ $property->label }}"
                                                            class="tf-check tf-check-{{ $property->label }} property-value"
                                                            value="{{ $property_value->id }}"
                                                            id="{{ $property_value->id }}">
                                                        <label for="{{ $property_value->id }}"
                                                            class="label"><span>{{ $property_value->name }}</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </form>
                <hr>
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#price-sort" data-bs-toggle="collapse" aria-expanded="true"
                        aria-controls="price-sort">
                        <span>Sort by Price</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="price-sort" class="collapse show">
                        <ul class="tf-filter-group current-scrollbar">
                            <li class="list-item d-flex gap-12 align-items-center">
                                <input type="radio" name="price_sort" class="tf-check price-sort" value="low_to_high"
                                    id="low_to_high">
                                <label for="low_to_high" class="label"><span>Low to High</span></label>
                            </li>
                            <li class="list-item d-flex gap-12 align-items-center">
                                <input type="radio" name="price_sort" class="tf-check price-sort" value="high_to_low"
                                    id="high_to_low">
                                <label for="high_to_low" class="label"><span>High to Low</span></label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#rating-sort" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="rating-sort">
                        <span>Sort by Rating</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="rating-sort" class="collapse show">
                        <ul class="tf-filter-group current-scrollbar">
                            <li class="list-item d-flex gap-12 align-items-center">
                                <input type="radio" name="rating_sort" class="tf-check rating-sort"
                                    value="low_to_high" id="rating_low_to_high">
                                <label for="rating_low_to_high" class="label"><span>Low to High</span></label>
                            </li>
                            <li class="list-item d-flex gap-12 align-items-center">
                                <input type="radio" name="rating_sort" class="tf-check rating-sort"
                                    value="high_to_low" id="rating_high_to_low">
                                <label for="rating_high_to_low" class="label"><span>High to Low</span></label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#stock-sort" data-bs-toggle="collapse" aria-expanded="true"
                        aria-controls="stock-sort">
                        <span>Sort by Stock</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="stock-sort" class="collapse show">
                        <ul class="tf-filter-group current-scrollbar">
                            <li class="list-item d-flex gap-12 align-items-center">
                                <input type="radio" name="stock_sort" class="tf-check stock-sort" value="available"
                                    id="available">
                                <label for="available" class="label"><span>Available</span></label>
                            </li>
                            <li class="list-item d-flex gap-12 align-items-center">
                                <input type="radio" name="stock_sort" class="tf-check stock-sort" value="out_of_stock"
                                    id="out_of_stock">
                                <label for="out_of_stock" class="label"><span>Out of Stock</span></label>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(e) {
            // Handle property filter change
            $('.property-value').change(function() {
                let propertyValues = getSelectedPropertyValueIds();
                const categorySlug = window.location.pathname.split('/products/')[1];
                const decodedCategory = decodeURIComponent(categorySlug);

                $.ajax({
                    url: "{{ route('frontend.products.filters') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        property_values: propertyValues,
                        category_slug: decodedCategory
                    },
                    success: function(response) {
                        $('#products-container').html(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });

        // Function to fetch all selected property values
        function getSelectedPropertyValueIds() {
            let propertyValues = [];
            $('.property-value:checked').each(function() {
                propertyValues.push($(this).val());
            });

            return propertyValues;
        }

        $('.rating-sort').change(function() {
            let ratingSort = $(this).val(); // Either 'low_to_high' or 'high_to_low'
            const categorySlug = window.location.pathname.split('/products/')[1];
            const decodedCategory = decodeURIComponent(categorySlug);

            $.ajax({
                url: "{{ route('frontend.products.filters') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    rating_sort: ratingSort,
                    category_slug: decodedCategory
                },
                success: function(response) {
                    $('#products-container').html(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });


        $('.price-sort').change(function() {
            let priceSort = $(this).val(); // Either 'low_to_high' or 'high_to_low'
            const categorySlug = window.location.pathname.split('/products/')[1];
            const decodedCategory = decodeURIComponent(categorySlug);

            $.ajax({
                url: "{{ route('frontend.products.filters') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    price_sort: priceSort,
                    category_slug: decodedCategory
                },
                success: function(response) {
                    $('#products-container').html(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });


        $('.stock-sort').change(function() {
            let stockSort = $(this).val(); // 'available' or 'out_of_stock'
            let propertyValues = getSelectedPropertyValueIds();
            const categorySlug = window.location.pathname.split('/products/')[1];
            const decodedCategory = decodeURIComponent(categorySlug);

            $.ajax({
                url: "{{ route('frontend.products.filters') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    category_slug: decodedCategory,
                    stock_sort: stockSort,
                    property_values: propertyValues // Keep this to preserve any selected filters
                },
                success: function(response) {
                    $('#products-container').html(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
@endsection
