@extends('layouts.app')

@section('title', isset($meta_tags) ? $meta_tags->title : $title . " - " . config('app.name', 'PetsWorld, Inc'))
@section('meta_description', isset($meta_tags) ? $meta_tags->description : '')

@section('content')
    <!-- Start Section: home -->
    <section id="home">
        <div class="container-fluid p-0">
            @include('frontend/_slider', ['home_sliders' => $home_sliders])
        </div>
    </section>
    <!-- End Section: home -->

    <!-- Shop -->
    <div class="main_title chart_bg" id="main-title-custom">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-6">
                    <h2 class="title text-left">
                        @if(count($homepage_product) > 0)
                            Our Products
                        @else
                            &nbsp;
                        @endif
                    </h2>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 text-right"><a id="showAreVideo" href="javascript:void(0);"
                                                                      data-toggle="modal"
                                                                      data-target="#modal-window-video"
                                                                      class="play-btn-homepage"><i
                                class="fa fa-play-circle" aria-hidden="true"></i><span class="play-text">Play Video</span></a></div>
            </div>
        </div>
    </div>
    <section class="shop_wrap">
        <div class="container" id="homepage-container">
            @include('frontend/_product', ['homepage_product' => $homepage_product ])
            <div class="row">
                <div class="col-md-12 headings-homepage">
                    <h1>Looking For The Best Dog Training Pads? Petpads.net can help with fast delivery and bulk pricing available.</h1>
                    <p>Housebreaking a dog can be one of the most difficult parts of pet ownership. The good news is you have options to help you manage pet potty training much easier. Pets World Training Pads carries absorbent puppy toilet pads. New York residents get free shipping next day. These pads are used in a variety of ways for pet owners, such as teaching pets to do their bathroom business in one spot. Pet pads can be a great tool to train your pet on where it is acceptable for them to "go". Our absorbent pads help protect your carpeting or flooring and make clean-up a breeze. </p>
                    <h2>Buy Indoor Pet Potty Pads Online</h2>
                    <p>Our indoor potty pads for pets are available in a variety of sizes in various numbers so you can get exactly what you need to help train your puppy. Our quality pads are competitively priced, we offer bulk and free shipping.</p>
                    <h2>Get the Best Dog Training Pads</h2>

                    <p>Our indoor potty pads for pets are especially popular for New York pet owners. Many individuals live in apartments in the city, which can make it difficult to allow your pet to take care of its needs outside, especially when you are away at work. With the disposable pet pads strategically located in the house, you can rest assured you won’t come home to a major mess. We offer a variety of pet pad sizes, so whether you’ve got a Chihuahua-sized dog, a Saint Bernard-sized dog, or multiple dogs, you can choose the pet pad that best suits your needs. </p>

                    <h2>Buy Pet Potty Pads in Bulk and Save</h2>

                    <p>We offer convenient delivery of disposable wee wee pads for dogs and the larger the quantity bought, the more money you’ll save. We make it convenient and offer free shipping, too. Many of our customers choose auto shipment options so that they’ll never run out of fresh and clean disposable pet pads.<br/>In addition to training puppies, some of our customers use our pet pads for cats who won’t use their litter box, or for elderly dogs and cats with incontinence, who need extra protection in their pet bed.   Whatever your pet pad needs are, the Pets World Training Pads team looks forward to showing you a great customer experience. </p>
                </div>
            </div>
        </div>
    </section>
        <section class="chart_bg">
            <div class="container pt-0 pb-30">
                <div class="row">
                    <div class="call-to-action pt-30 pb-20">
                        <div class="col-md-12">
                            <h3 class="mt-5">What People Are Saying About Us…</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="testimonials">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div style="min-height: 100px; overflow: hidden;" class="shopperapproved_widget sa_rotate sa_count1 sa_horizontal sa_count1 sa_bgWhite sa_colorBlack sa_borderWhite sa_rounded sa_FjY sa_flex sa_showlinks sa_large sa_showdate "></div><script type="text/javascript">var sa_interval = 5000;function saLoadScript(src) { var js = window.document.createElement('script'); js.src = src; js.type = 'text/javascript'; document.getElementsByTagName("head")[0].appendChild(js); } if (typeof(shopper_first) == 'undefined') saLoadScript('//www.shopperapproved.com/widgets/testimonial/3.0/27575.js'); shopper_first = true; </script><div style="text-align:right;"><a class="sa_footer" href="https://www.shopperapproved.com/reviews/petpads.net/" target="_blank" rel="nofollow"><img class="sa_widget_footer" style="border: 0;" alt="" src=https://www.shopperapproved.com/widgets/widgetfooter-darklogo.png></a></div>
                    </div>
                </div>
            </div>
        </section>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.ratingPreview').rateYo({
                normalFill: "#FFF",
                spacing: '3px',
                starWidth: '14px',
                strokeFill: '#ff9800',
                ratedFill: '#ff9800',
                strokeWidth: 20,
                numStars: 5,
                readOnly: true
            }); // Call the rating plugin for preview
        });

    </script>
@endsection
