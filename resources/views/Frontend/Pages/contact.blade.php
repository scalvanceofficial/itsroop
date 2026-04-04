@extends('layouts.frontend')
@section('title')
    Contact | Bamboo Street
@endsection
@section('content')
    <!-- page-title -->
    <div class="tf-page-title bg_green-1 style-2">
        <div class="container-full">
            <div class="heading text-center text_white-2">Contact Us</div>
        </div>
    </div>
    <!-- /page-title -->


    <section class="flat-spacing-21">
        <div class="container">
            <div class="tf-grid-layout gap30 lg-col-2">
                {{-- get in touch --}}
                <div class="tf-content-left">
                    <h5 class="mb_20">Visit Our Store</h5>
                    <div class="mb_20">
                        <p class="mb_15"><strong>Address</strong></p>
                        <p>Address: RH No. 43, Grand Kalyan, Opp WALMI, Kanchanwadi, Aurangabad, Maharashtra, India -
                            431136</p>
                    </div>
                    <div class="mb_20">
                        <p class="mb_15"><strong>Phone</strong></p> <i class="fas fa-phone"
                            style="margin-right: 8px; color: #36614b;"></i>
                        <a href="tel:+91 7304229346" class="footer-menu_item">+91 7304229346</a>
                    </div>
                    <div class="mb_20">
                        <p class="mb_15"><strong>Email</strong></p><i class="fas fa-envelope"
                            style="margin-right: 8px; color: #36614b;"></i>
                        <a href="mailto:updates@bamboostreet.in" class="footer-menu_item">
                            updates@bamboostreet.in
                        </a>
                    </div>
                    <div class="mb_36">
                        <p class="mb_15"><strong>Open Time</strong></p>
                        <p><i class="fas fa-clock" style="color: #36614b; margin-right: 8px;"></i>Mon - Sat : 9am - 9pm</p>


                    </div>
                    <div>
                        <ul class="tf-social-icon d-flex gap-20 style-default">
                            <li>
                                <a href="https://www.facebook.com/share/18Um7RsCRv/?mibextid=wwXIfr"
                                    class="box-icon link round social-facebook border-line-black" target="_blank">
                                    <i class="icon fs-14 icon-fb"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://www.instagram.com/bamboostreet.in?igsh=MWE1ZGQzMTFkNWJ4ag=="
                                    class="box-icon link round social-instagram border-line-black" target="_blank">
                                    <i class="icon fs-14 icon-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://wa.me/7304229346" target="_blank" class="box-icon round social-pinterest">
                                    <i class="icon fs-14 icon-whatsapp"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- get in touch --}}

                {{-- contact form --}}
                <div class="tf-content-right">
                    <h5 class="mb_20">Get in Touch</h5>
                    <p class="mb_24">If you’ve got great products your making or looking to work with us then drop us a
                        line.</p>
                    <div>
                        <form method="POST" action="{{ route('frontend.enquiry.store') }}" id="enquiryForm">
                            @csrf

                            <div class="d-flex gap-15 mb_15">
                                <fieldset class="w-100">
                                    <input type="text" name="first_name" class="form-control mb-1" id="first_name"
                                        placeholder="Enter first name*">
                                    <div class="text-start" style="color:red" id="first_name-error"></div>
                                </fieldset>
                                <fieldset class="w-100">
                                    <input type="text" name="last_name" class="form-control mb-1" id="last_name"
                                        placeholder="Enter last name*">
                                    <div class="text-start" style="color:red" id="last_name-error"></div>
                                </fieldset>
                            </div>
                            <div class="d-flex gap-15 mb_15">
                                <fieldset class="w-100">
                                    <input type="number" name="mobile" class="form-control" id="mobile"
                                        placeholder="Enter Mobile Number*">
                                    <div class="text-start" id="mobile-error" style="color:red"></div>
                                </fieldset>
                                <fieldset class="w-100">
                                    <input type="email" name="email" class="form-control mb-1" id="email"
                                        placeholder="Enter email address*">
                                    <div class="text-start" style="color:red" id="email-error"></div>
                                </fieldset>
                            </div>
                            <div class="mb_15">
                                <textarea name="message" class="form-control" id="message" cols="30" rows="10"
                                    placeholder="Enter your message*"></textarea>
                                <div class="text-start" style="color:red" id="message-error"></div>
                            </div>
                            <div class="send-wrap">
                                <div class="send-wrap d-flex justify-content-center">
                                    <button type="submit"
                                        class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center"
                                        id="enquiryBtn">
                                        <span id="enquiryBtnText">Send</span>
                                        <span id="enquiryBtnLoader" class="d-none">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                        </span>
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
                {{-- contcat form --}}
            </div>
        </div>
    </section>




    <section class="bg_grey-7 flat-spacing-9 bg_f5f5ec">
        <div class="container">
            <div class="flat-title">
                <span class="title" id="faq">FAQs</span>
            </div>
            <div class="container">
                <div class="tf-accordion-wrap d-flex justify-content-between">
                    <div class="content">
                        <h5 class="mb_24">PRODUCTS</h5>
                        <div class="flat-accordion style-default has-btns-arrow mb_60">
                            <div class="flat-toggle">
                                <div class="toggle-title text_green-1"> I received products with slight variations. Is that
                                    normal?
                                </div>
                                <div class="toggle-content">
                                    <p>Yes, variations are expected and are a part of the unique charm of our products.
                                        Let’s check the category of the product you purchased:<br><br>
                                        1. <strong>Handmade Products – </strong> Our handcrafted items are skillfully made
                                        by talented
                                        artisans,
                                        each piece telling a unique story. Slight differences in texture, shape, or color
                                        are natural and enhance the beauty and authenticity of handmade craftsmanship. We
                                        believe imperfection is what makes handmade products truly special!<br><br>
                                        2. <strong>Non-Handmade Products – </strong> If your product is not handmade and you
                                        notice unexpected
                                        differences, don’t worry! Reach out to us via WhatsApp, and we’ll assist you in
                                        resolving your concern swiftly.</p>
                                </div>
                            </div>
                            <div class="flat-toggle">
                                <div class="toggle-title text_green-1">How can I style my Bamboo Street products?</div>
                                <div class="toggle-content">
                                    <p>Take inspiration from our amazing customers! Explore different ways to use and style
                                        our bamboo products, and let creativity shine in your space. Whether it’s a
                                        minimalist touch, a rustic vibe, or a modern twist—bamboo fits every
                                        aesthetic.<br><br>
                                        We’d love to see how you use our products! Share your styling ideas with us and
                                        don’t forget to tag us when you showcase them creatively. Your inspiration could
                                        help others embrace sustainable living in style!<br><br>
                                        Youtube link</p>
                                </div>
                            </div>
                            <div class="flat-toggle">
                                <div class="toggle-title text_green-1">How do I maintain my natural bamboo products?</div>
                                <div class="toggle-content">
                                    <p>Proper care ensures durability and longevity. Follow these simple maintenance
                                        tips:<br><br>
                                        1. <strong>Handmade Products (Baskets, Mats, Miniatures) –</strong> Our handcrafted
                                        items are easy to
                                        maintain. Simply wash with tap water at room temperature, using gentle hands—avoid
                                        detergents or any chemicals. Ensure they are thoroughly dried and always placed in a
                                        clean, dry, and airy place.<br><br>
                                        2. <strong>Kide Plates – </strong>These can be cleaned with mild detergent and
                                        rinsed well. Avoid
                                        abrasive scrubbing to maintain their natural texture and strength.<br>
                                        Regular care will preserve the beauty and functionality of your bamboo products. Let
                                        us know if you need additional guidance!</p>
                                </div>
                            </div>
                            <div class="flat-toggle">
                                <div class="toggle-title text_green-1">My table mat is curved or bent after placing it on
                                    the dining
                                    table. What should I do? </div>
                                <div class="toggle-content">
                                    <p>No worries! Since our table mats could be rolled for convenient shipping, they may
                                        have slight creases or bends upon unpacking. To restore their shape:<br><br>
                                        1. <strong>Lay the mat flat</strong> on the dining table or any smooth
                                        surface.<br><br>
                                        2. <strong> Allow it time to adjust— </strong>within a few hours or days, it
                                        will naturally settle.<br><br>
                                        3. <strong>For quicker results, </strong> place a heavy book or flat object on
                                        top to help flatten
                                        it.<br><br>
                                        4. <strong>Avoid direct moisture, </strong> as extreme conditions may affect the
                                        material.<br><br>
                                        5. <strong>If needed, gently roll the mat in the opposite direction </strong> to
                                        help it settle
                                        faster.<br><br>
                                        Your mat will soon regain its perfect form, ready to enhance your dining
                                        experience!.</p>
                                </div>
                            </div>
                        </div>
                        <h5 class="mb_24">RETURNS, REFUND and EXCHANGE</h5>
                        <div class="flat-accordion style-default has-btns-arrow mb_60">
                            <div class="flat-toggle">
                                <div class="toggle-title text_green-1"> Can I cancel my order?
                                </div>
                                <div class="toggle-content">
                                    <p>Yes, you can cancel your order, but only<strong> before it has been dispatched.
                                        </strong> Once the
                                        order is shipped, cancellations are no longer possible, and our standard
                                        <strong>return/exchange policies</strong> will apply.<br><br>
                                        If you need assistance with an order cancellation, please contact us as soon as
                                        possible.We're here to help
                                        If you are not happy with your product, feel free to contact us via Email or
                                        watsapp
                                        and we will handle the returns in accordance to the return policy.
                                    </p>
                                </div>
                            </div>
                            <div class="flat-toggle">
                                <div class="toggle-title text_green-1">How do I return a product? </div>
                                <div class="toggle-content">
                                    <p>If you’re not satisfied with your purchase, we’re here to help! Simply reach out to
                                        us via<strong> email or WhatsApp, </strong>and will handle the returns in accordance
                                        to the return
                                        policy.
                                        We strive to ensure a smooth experience, so let us know your concern, and we’ll
                                        assist you in resolving it as quickly as possible.
                                        Check our return policy <a href="/return-and-exchange"
                                            class="footer-menu_item"><strong>Returns &
                                                Exchanges</strong></a></p>
                                </div>
                            </div>
                            <div class="flat-toggle">
                                <div class="toggle-title text_green-1"> Is my purchase eligible for exchange, and how do I
                                    exchange it?
                                </div>
                                <div class="toggle-content">
                                    <p>Yes, you can request an exchange by following these steps:<br><br>
                                        1. <strong>Contact us within 2 days of delivery </strong>to initiate an exchange
                                        request.<br><br>
                                        2. Ensure the product is <strong>unused</strong> and that the<strong> original tags
                                            are intact.</strong><br><br>
                                        3. Once we receive the unused product at our warehouse, we will dispatch the
                                        exchanged
                                        item based on availability.<br><br>
                                        4. If the requested product is <strong>out of stock,</strong> we will issue a refund
                                        to the original
                                        payment method.<br><br>
                                        For any assistance, feel free to reach out—we’re here to help!</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div>
            </div>
    </section>





    <script>
        $('#enquiryForm').submit(function(e) {
            e.preventDefault();
            $('div[id$="-error"]').empty();

            $('#enquiryBtnText').addClass('d-none');
            $('#enquiryBtnLoader').removeClass('d-none');
            $('#enquiryBtn').prop('disabled', true);

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

                    $('#enquiryBtnText').removeClass('d-none');
                    $('#enquiryBtnLoader').addClass('d-none');
                    $('#enquiryBtn').prop('disabled', false);
                    if (data.status === 'success') {
                        toastr.success(data.message, '', {
                            showMethod: "slideDown",
                            hideMethod: "slideUp",
                            timeOut: 1500,
                            closeButton: true,
                        });
                        setTimeout(function() {
                            window.location.href = '{!! route('frontend.contact') !!}';
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    $('#enquiryBtnText').removeClass('d-none');
                    $('#enquiryBtnLoader').addClass('d-none');
                    $('#enquiryBtn').prop('disabled', false);
                    console.log(xhr);
                    toastr.error('There are some errors in the form. Please check your inputs.', '', {
                        showMethod: "slideDown",
                        hideMethod: "slideUp",
                        timeOut: 1500,
                        closeButton: true,
                    });

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        console.log(xhr.responseJSON.errors);
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#' + key + '-error').html(value.join(', '));
                        });

                        $('html, body').animate({
                            scrollTop: $('#' + Object.keys(xhr.responseJSON.errors)[0] +
                                '-error').offset().top - 200
                        }, 500);
                    } else {
                        toastr.error('An unexpected error occurred. Please try again later.', '', {
                            showMethod: "slideDown",
                            hideMethod: "slideUp",
                            timeOut: 1500,
                            closeButton: true,
                        });
                    }
                },
            });
        });
    </script>
@endsection
