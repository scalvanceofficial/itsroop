@extends('layouts.frontend')
@section('title')
    Orders | Bamboo Street
@endsection

@section('content')
    <section class="flat-spacing-11">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wd-form-order">
                        <div class="order-head d-flex justify-content-between align-items-center">
                            <div class="content">
                                <div class="badge"></div>
                                <h6 class="mt-8 fw-5">#{{ $order->order_number }}</h6>
                            </div>
                            <div class="content ms-auto">
                                <a href="{{ route('frontend.orders.pdf.download', $order->id) }}" class="btn btn-danger"
                                    target="_blank" title="Download PDF">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>Invoice</span>
                                </a>
                            </div>
                        </div>
                        <div class="tf-grid-layout md-col-3 gap-15">

                            <div class="item">
                                <div class="text-2 text_black-2">Items</div>
                                <div class="text-2 mt_4 fw-6">{{ $order->products()->count() }}</div>
                            </div>
                            <div class="item">
                                <div class="text-2 text_black-2">Order Date</div>
                                <div class="text-2 mt_4 fw-6">{{ toIndianDateTime($order->created_at) }}</div>
                            </div>
                            <div class="item">
                                <div class="text-2 text_black-2">Estimate Devlivery Date</div>
                                <div class="text-2 mt_4 fw-6"> {{ toIndianDate($order->created_at->addDays(10)) }}</div>
                            </div>
                            <div class="item">
                                <div class="text-2 text_black-2">Address</div>
                                <div class="text-2 mt_4 fw-6">
                                    {{ $order->address->address_line_1 }},
                                    {{ $order->address->address_line_2 }},
                                    {{ $order->address->city }},
                                    {{ $order->address->pincode }}
                                </div>
                            </div>
                        </div>
                        <div class="widget-tabs style-has-border widget-order-tab">
                            <ul class="widget-menu-tab">
                                <li class="item-title active">
                                    <span class="inner">Track Your Order</span>
                                </li>
                                <li class="item-title">
                                    <span class="inner">Item Details</span>
                                </li>
                                @if ($order->shiprocket_status !== 'DELIVERED')
                                    <li class="item-title">
                                        <span class="inner">Cancel Order</span>
                                    </li>
                                @endif
                            </ul>
                            <div class="widget-content-tab">
                                <div class="widget-content-inner active">
                                    <div class="widget-timeline">
                                        <ul class="timeline">
                                            @if (!empty($tracking_activities))
                                                @php
                                                    $in_transit_shown = false;
                                                    $delivery_statuses = [
                                                        'delivered',
                                                        'out for delivery',
                                                        'shipped',
                                                        'picked up',
                                                    ];
                                                @endphp
                                                @if ($order->shiprocket_status != 'Delivered')
                                                    @foreach ($tracking_activities as $tracking_activity)
                                                        @php
                                                            $current_status = strtolower(
                                                                $tracking_activity['sr-status-label'],
                                                            );
                                                        @endphp

                                                        @if (
                                                            $current_status !== 'na' &&
                                                                in_array($current_status, $delivery_statuses) &&
                                                                ($current_status !== 'in transit' || !$in_transit_shown))
                                                            <li>
                                                                <div class="timeline-badge success"></div>
                                                                <div class="timeline-box">
                                                                    <a class="timeline-panel" href="javascript:void(0);">
                                                                        <div class="text-2 fw-6">
                                                                            {{ strtoupper($current_status) }}
                                                                        </div>
                                                                        <span>{{ $tracking_activity['location'] }}</span><br>
                                                                        <span>{{ toIndianDateTime($tracking_activity['date']) }}</span>
                                                                    </a>
                                                                </div>
                                                            </li>
                                                            @php
                                                                if ($current_status === 'in transit') {
                                                                    $in_transit_shown = true;
                                                                }
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach ($delivery_statuses as $delivery_status)
                                                        <li>
                                                            <div class="timeline-badge success"></div>
                                                            <div class="timeline-box">
                                                                <a class="timeline-panel" href="javascript:void(0);">
                                                                    <div class="text-2 fw-6">
                                                                        {{ strtoupper($delivery_status) }}</div>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="widget-content-inner">
                                    @php
                                        $total_price = 0;
                                    @endphp
                                    @foreach ($order->products as $order_product)
                                        @php
                                            $product_image = $order_product->product->getImage(
                                                $order_product->property_values,
                                            );
                                            $total_price += $order_product->price * $order_product->quantity;
                                        @endphp
                                        <div class="order-head">
                                            <figure class="img-product">
                                                <img src="{{ $product_image }}" alt="product">
                                            </figure>
                                            <div class="content">
                                                <div class="text-2 fw-6">
                                                    <a
                                                        href="{{ route('frontend.products.product-details', $order_product->product->slug) }}">
                                                        {{ $order_product->product->name }}
                                                    </a>
                                                </div>
                                                <div class="mt_4">
                                                    <span class="fw-6">Price :</span>
                                                    {{ toIndianCurrency($order_product->price) }}
                                                </div>
                                                <div class="mt_4">
                                                    <span class="fw-6">Quantity :</span>
                                                    {{ $order_product->quantity }}
                                                </div>
                                                <div class="mt_4">
                                                    <span class="fw-6">Total :</span>
                                                    {{ toIndianCurrency($order_product->total_amount) }}
                                                </div>

                                                <div class="mt_4">
                                                    @php
                                                        $product_quantity = $order_product->quantity;
                                                        $returned_product = $order_product->returnedProduct;
                                                    @endphp

                                                    @if ($returned_product && $returned_product->return_quantity > 0)
                                                        <div class="mt_4">
                                                            @if ($returned_product->status == 'RETURN_IN_PROGRESS')
                                                                <span class="badge bg-warning text-dark">Return In Progress
                                                                    ({{ $returned_product->return_quantity }}/{{ $product_quantity }})
                                                                </span>
                                                            @elseif ($returned_product->status == 'PRODUCT_RECEIVED')
                                                                <span class="badge bg-info text-dark">Product Received
                                                                    ({{ $returned_product->return_quantity }}/{{ $product_quantity }})
                                                                </span>
                                                            @elseif ($returned_product->status == 'REFUND_INITIATE')
                                                                <span class="badge bg-primary text-white">Refund Initiate
                                                                    ({{ $returned_product->return_quantity }}/{{ $product_quantity }})
                                                                </span>
                                                                <span>
                                                                    {{ $returned_product->transaction_id ? '(Transaction ID: ' . $returned_product->transaction_id . ')' : '' }}
                                                                </span>
                                                            @elseif($returned_product->status == 'REFUND_PROCESSED')
                                                                <span class="badge bg-primary text-white">Refund
                                                                    Processed</span>
                                                                <div class="mt-2 px-2 py-1 bg_f5f5ec border rounded small text-muted"
                                                                    style="max-width: 350px;">
                                                                    <strong>Note:</strong> Refund will be processed in your
                                                                    original account.
                                                                </div>
                                                            @elseif ($returned_product->status == 'REFUND_COMPLETED')
                                                                <span class="badge bg-success"> Refund Completed
                                                                    ({{ $returned_product->return_quantity }}/{{ $product_quantity }})
                                                                </span>
                                                                <div class="mt-2 px-2 py-1 bg_f5f5ec border rounded small text-muted"
                                                                    style="max-width: 500px;">
                                                                    <strong>Note:</strong> Refund is completed and the
                                                                    amount is credited to your original account.
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <ul>
                                        <li class="d-flex justify-content-between text-2 mt_8">
                                            <span>Order Total</span>
                                            <span class="fw-6">{{ toIndianCurrency($order->total_amount) }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="widget-content-inner py-4 px-6 bg-custom-light rounded-lg shadow-sm">
                                    <div class="wd-form-order-cancel">
                                        @if (
                                            $order->created_at->diffInHours() < 24 &&
                                                $order->shiprocket_status == 'NEW' &&
                                                $order->shiprocket_status != 'Cancelled')
                                            <div class="alert alert-info mb-4">
                                                <h5 class="fw-bold text-custom-primary">Order Cancellation Available</h5>
                                                <p>You can cancel your order within 24 hours of placing it. If you have any
                                                    questions, please contact us at
                                                    <a href="mailto:{{ config('app.admin_email') }}"
                                                        class="text-decoration-underline text-custom-primary">{{ config('app.admin_email') }}</a>
                                                </p>
                                                <p>Please note that once an order is shipped, it cannot be cancelled.</p>
                                                <div class="d-flex justify-content-end">
                                                    <a href="javascript:void(0);" class="btn btn-danger"
                                                        data-bs-toggle="modal" data-bs-target="#cancelOrderModal">
                                                        Cancel Order
                                                    </a>
                                                </div>
                                            </div>
                                        @elseif($order->shiprocket_status == 'Cancelled')
                                            <div class="alert alert-warning mb-4">
                                                <h5 class="fw-bold text-custom-warning">Order Cancelled</h5>
                                                <p>Your order has been successfully cancelled. For further assistance,
                                                    contact us at
                                                    <a href="mailto:{{ config('app.admin_email') }}"
                                                        class="text-decoration-underline text-custom-warning">{{ config('app.admin_email') }}</a>
                                                </p>
                                            </div>
                                        @else
                                            <div class="alert alert-secondary mb-4">
                                                <h5 class="fw-bold text-custom-secondary">Order Cancellation Not Available
                                                </h5>
                                                <p>Order cancellation is not available. If you have any questions, please
                                                    contact us at
                                                    <a href="mailto:{{ config('app.admin_email') }}"
                                                        class="text-decoration-underline text-custom-secondary">{{ config('app.admin_email') }}</a>
                                                </p>
                                                <p>Note: Once an order is shipped, it cannot be cancelled.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
    </section>

    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-3 shadow-sm">
                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title text-danger" id="cancelOrderModalLabel">Cancel Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('frontend.orders.cancel', $order->route_key) }}" method="POST"
                    id="cancelOrderForm">
                    @csrf
                    <div class="modal-body">
                        <p class="mb-3">Are you sure you want to cancel this order?</p>
                        <textarea name="cancellation_reason" rows="3" class="form-control border-secondary rounded-2"
                            placeholder="Reason for cancellation"></textarea>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Cancel Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#cancelOrderForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var actionUrl = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status == 'success') {
                            $('.item-title').removeClass('active');
                            toastr.success(
                                response.message,
                                '', {
                                    showMethod: "slideDown",
                                    timeOut: 2000,
                                    closeButton: true,
                                });

                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection
