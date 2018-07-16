@extends('layouts.app')
@section('title', isset($meta_tags) ? $meta_tags->title : $title . " - " . config('app.name', 'PetsWorld, Inc'))
@section('meta_description', isset($meta_tags) ? $meta_tags->description : '')
@section('content')
    <!-- Section: inner-header -->
    <div class="main-content">
        <div class="main_title chart_bg">
            <div class="container text-center">
                <h2 class="title">Product Detail</h2>
            </div>
        </div>

        <section class="divider">
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert"
                           aria-label="close">&times;</a> {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert"
                           aria-label="close">&times;</a> {{ session('error') }}
                    </div>
                @endif
                <div class="section-content">
                    <div class="row">
                        <div class="product" itemscope itemtype="http://schema.org/Product">
                            <meta itemprop="name" content="{{$product->name}}"/>
                            <meta itemprop="description" content="{!! strip_tags($product->product_description) !!}"/>
                            <div class="col-md-4">
                                <div class="product-image">
                                    <?php $offerDis = $product->getActiveOffers(); ?>
                                    <?php $autoShip = $product->getActiveAutoShip(); ?>
                                    @if(!is_null($offerDis) && count($offerDis) > 1)
                                        <span class="tag-sale">Sale!</span>
                                    @endif
                                    <ul class="owl-carousel-1col" data-nav="true">
                                        @if(!is_null($product->getActiveProductImages()) && count($product->getActiveProductImages()) > 0)
                                            @foreach($product->getActiveProductImages() as $productImage)
                                                <li data-thumb="{{ asset('uploads/product/original/'. $productImage->product_image) }}">
                                                    <a rel="prettyPhoto[gallery_name]"
                                                       href="{{ asset('uploads/product/original/'. $productImage->product_image) }}"
                                                       data-lightbox="single-product">
                                                        <img  itemprop="image" src="{{ asset('uploads/product/original/'. $productImage->product_image) }}"
                                                             alt="{{ $product->name }}">
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="product-summary">
                                    <h2 class="product-title">{{ $product->name }}</h2>
                                    <div class="product_review" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                        <ul class="review_text list-inline">
                                            <li>
                                                <div title="{{ $product->avg_rating }} out of 5">
                                                   <div class="ratingPreview" data-rateyo-rating="{{$product->avg_rating}}"></div>
                                                        <meta itemprop="worstRating" content="1">
                                                        <meta itemprop="bestRating" content="5">
                                                        <meta itemprop="ratingValue" content="{{$product->avg_rating}}">
                                                </div>
                                            </li>
                                            <li class="review-count-total" ><a href="{{ route('feedback.show', ['feedback' => $product->slug ])}}" target="_blank"><span itemprop="reviewCount" id="reviewCount">{{ $product->reviews_count }}</span>&nbsp;Reviews</a></li>
                                            @if (Auth::user())
                                                <li class="review-count-total"><a href="javascript:void(0);"
                                                                                  data-toggle="modal"
                                                                                  data-target="#product-feedback-model">Add
                                                        reviews</a></li>
                                            @endif
                                        </ul>
                                        <ul class="review_text list-inline">
                                            <li>
                                                <div id="product_just_stars" class="reg"></div> <script type="text/javascript"> var sa_product = {{$product->id}}; (function(w,d,t,f,o,s,a){ o = 'shopperapproved'; if (!w[o]) { w[o] = function() { (w[o].arg = w[o].arg || []).push(arguments) }; s=d.createElement(t), a=d.getElementsByTagName(t)[0];s.async=1;s.src=f;a.parentNode.insertBefore(s,a)} })(window,document,'script','//www.shopperapproved.com/product/27575/'+sa_product+'.js'); </script>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="price"><strong>Price: </strong>
                                                <ins><span class="amount">&#36;{{ $product->price }}</span></ins>
                                            </div>
                                            <div class="short-description"></div>
                                            <table class="table table-striped price_save">
                                                <tr>
                                                    <th>Category:</th>
                                                    <td>
                                                        <a href="{{ route('category', ['slug' => $product->getCategory->slug]) }}">{{ $product->getCategory->name }}</a>
                                                    </td>
                                                </tr>
                                                @if(!is_null($offerDis) && count($offerDis) > 0)
                                                    <tr>
                                                        <th>Save:</th>
                                                        <td>
                                                            @foreach($offerDis as $offer)
                                                                <p>({{ $offer->offer }}&#37;) Buy {{ $offer->quantity }}
                                                                    at
                                                                    $<?php echo round($product->price - ($product->price * $offer->offer) / 100, 2) ?>
                                                                    per case!</p>
                                                            @endforeach

                                                        </td>
                                                    </tr>
                                                @endif
                                                @if($autoShip)
                                                    <tr>
                                                        <th colspan="2">
                                                            <div class="save" title="Auto Ship"><img
                                                                        src="{{ asset('images/ship1.png') }}" alt=""
                                                                        class="autoship-save" width="20"> Autoship &amp;
                                                                Save an
                                                                extra {{ $product->getActiveAutoShip()->autoship_percentage }}
                                                                %
                                                            </div>
                                                        </th>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            @if($product->out_of_stock != 2)
                                                <div class="cart-form-wrapper mt-30">
                                                    <form id="cart-added" enctype="multipart/form-data" method="POST"
                                                          class="cart" action="{{ route('cart.store') }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="product_slug"
                                                               value="{{ $product->slug }}">
                                                        <table class="table variations no-border">
                                                            <tbody>
                                                            <tr>
                                                                <td class="name">Quantity</td>
                                                                <td class="value">
                                                                    <div class="quantity buttons_added">
                                                                        <input type="button" class="minus" value="-">
                                                                        <input type="number" size="4"
                                                                               class="input-text qty text" title="Qty"
                                                                               value="1" name="quantity" min="1" max="5"
                                                                               step="1">
                                                                        <input type="button" class="plus" value="+">
                                                                        <div class="cart-button">
                                                                            <button class="btn btn-theme-colored"
                                                                                    type="submit">Add to cart
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </div>
                                            @else
                                                <img src="{{ asset('images/out-of-stock.png') }}" alt="Out of Stock"
                                                     width="200">
                                            @endif
                                            <br/>

                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="horizontal-tab product-tab">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1" data-toggle="tab">Description</a></li>
                                        <!--<li><a href="#tab2" data-toggle="tab">Additional Information</a></li>-->
                                        <li><a href="#tab3" data-toggle="tab">Reviews</a></li>
                                        @if($product->show_video == 1)
                                            <li><a href="#video_tab" data-toggle="tab">Video</a></li>
                                        @endif
                                        @if($product->sample_product == 1)
                                            <li><a href="{{route('sample.request')}}?product={{$product->slug}}">Get Free Sample</a></li>
                                        @endif
                                        <li><a href="{{ route('static-page', ['slug' => 'return-policy'])}}" target="_blank">Return Policy</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab1">
                                            <h3>Product Description</h3>
                                            <p>{!! html_entity_decode($product->product_description) !!}</p>
                                        </div>
                                        <div class="tab-pane fade" id="tab3">
                                            <div class="reviews">
                                                <ol class="commentlist">
                                                    <script type="text/javascript"> var sa_products_count = 5; var sa_date_format = 'F j, Y'; var sa_product = {{$product->id}}; (function(w,d,t,f,o,s,a){ o = 'shopperapproved'; if (!w[o]) { w[o] = function() { (w[o].arg = w[o].arg || []).push(arguments) }; s=d.createElement(t), a=d.getElementsByTagName(t)[0];s.async=1;s.src=f;a.parentNode.insertBefore(s,a)} })(window,document,'script','//www.shopperapproved.com/product/27575/'+sa_product+'.js'); </script> <div id="shopper_review_page"><div id="review_header"></div><div id="product_page"></div><div id="review_image"><a href="https://www.shopperapproved.com/reviews/petpads.net/" onclick="var nonwin=navigator.appName!='Microsoft Internet Explorer'?'yes':'no'; var certheight=screen.availHeight-90; window.open(this.href,'shopperapproved','location='+nonwin+',scrollbars=yes,width=620,height='+certheight+',menubar=no,toolbar=no'); return false;" target="_blank" rel="nofollow"></a></div></div>
                                                    @if(count($product->getApprovedProductFeedbacks()) > 0)
                                                        @foreach($product->getApprovedProductFeedbacks() as $feedback)
                                                            <li class="comment">
                                                                <div class="media-body" itemprop="review" itemscope itemtype="http://schema.org/Review">
                                                                    <meta itemprop="itemReviewed" content="{{$product->name}}">
                                                                    @if($feedback->subject)
                                                                        <p>{{$feedback->subject}}</p>
                                                                    @endif
                                                                    <ul class="review_text list-inline mt-5">
                                                                        <li>
                                                                            <div title="{{ $feedback->rating }} out of 5" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                                                                <div class="ratingPreview" data-rateyo-rating="{{ $feedback->rating }}"></div>
                                                                                    <meta itemprop="worstRating" content="1">
                                                                                    <meta itemprop="bestRating" content="5">
                                                                                    <meta itemprop="ratingValue" content="{{$feedback->rating}}">
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <h5 class="media-heading meta"><span class="author" itemprop="author" itemscope itemtype="http://schema.org/Person"><meta itemprop="name"  content="{{ $feedback->is_anonymous == 1 ? 'Anonymous User' : $feedback->getUser->first_name }}"/>{{ $feedback->is_anonymous == 1 ? 'Anonymous User' : $feedback->getUser->first_name }}</span>
                                                                                – <span itemprop="datePublished">{{ Carbon\Carbon::parse($feedback->review_date)->format('M d, Y') }}</span>
                                                                            </h5>
                                                                        </li>
                                                                    </ul>
                                                                    <p itemprop="reviewBody">{{ $feedback->product_feedback }}</p>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        No Review Found
                                                    @endif
                                                </ol>
                                            </div>
                                            <?php $reviewsCount = $product->getApprovedProductFeedbacksCount(); ?>
                                            @if(count($reviewsCount) > 5)
                                                <div class="text-right cart-button">
                                                    <a class="btn btn-theme-colored"
                                                       href="{{ route('feedback.show', ['feedback' => $product->slug ])}}">Read
                                                        All {{ count($reviewsCount) }} Reviews</a>
                                                </div>
                                            @endif
                                        </div>
                                        @if($product->show_video == 1)
                                            <div class="tab-pane fade" id="video_tab">
                                                <h3>Sample Video</h3>
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-6">
                                                        <video class="embed-responsive-item" id="videoContainer"
                                                               preload="auto" controls="controls"
                                                               controlsList="nodownload" poster="" width="100%">
                                                            <source src="{{asset('wlmrt.mp4')}}" type='video/mp4'>
                                                        </video>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!is_null($relatedProducts) && count($relatedProducts) > 0)
                            <div class="col-md-12 mt-30">
                                <h4>Related Products</h4>
                                <div class="products related owl-carousel-4col" data-nav="true">
                                    @foreach($relatedProducts as $relatedProduct)
                                        <?php $relOffer = $relatedProduct->getSaleActiveOffers(); ?>
                                        <?php $relAutoShip = $relatedProduct->getActiveAutoShip(); ?>
                                        <?php $relOfferDis = $relatedProduct->getActiveOffers(); ?>
                                        <?php $maxOffer = $relatedProduct->getMaxOffer(); ?>
                                        <div class="item">
                                            <div class="product">
                                                @if(!is_null($relOfferDis) && count($relOfferDis) > 1)
                                                    <span class="tag-sale">Sale!</span>
                                                @endif
                                                <a href="{{ route('product', ['slug' => $relatedProduct->slug] ) }}">
                                                    <div class="product-thumb"><img alt=""
                                                                                    src="{{ asset('uploads/product/thumbnail/'. $relatedProduct->getFeaturedImage()->product_image) }}"
                                                                                    class="img-responsive img-fullwidth">
                                                        <div class="overlay"></div>
                                                    </div>
                                                </a>
                                                <div class="product-details text-center">
                                                    <a href="{{ route('product', ['slug' => $relatedProduct->slug] ) }}">
                                                        <h5 class="product-title">{{ $relatedProduct->name }}</h5></a>
                                                    <div class="glyphicon-star-rating"
                                                         title="{{ $relatedProduct->avg_rating }} out of 5">
                                                       <div class="ratingPreview" data-rateyo-rating="{{ $relatedProduct->avg_rating }}"></div>
                                                        <span class="review-count-total">{{ $relatedProduct->reviews_count }}
                                                            Reviews</span>
                                                    </div>
                                                    @if(!is_null($relOffer) && count($relOffer) > 0)
                                                        <div class="price">
                                                            <ins>
                                                                <span class="amount">$<?php echo round($relatedProduct->price - ($relatedProduct->price * $maxOffer->offer) / 100, 2) ?></span>
                                                            </ins>
                                                            <del>
                                                                <span class="amount">${{ $relatedProduct->price }}</span>
                                                            </del>
                                                            <strong class="price-sale">on sale!</strong>
                                                        </div>
                                                    @else
                                                        <div class="price">
                                                            <ins>
                                                                <span class="amount">${{ $relatedProduct->price }}</span>
                                                            </ins>
                                                        </div>
                                                    @endif
                                                    @if($relAutoShip)
                                                        <div class="price">
                                                            <span class="autoship_n"><img
                                                                        src="{{ asset('images/ship1.png') }}" width="20"
                                                                        alt="" class="rel-autoship autoship-save"> Autoship & Save an extra {{ $relatedProduct->getActiveAutoShip()->autoship_percentage }}
                                                                % </span>
                                                        </div>
                                                    @endif
                                                    <div class="btn-add-to-cart-wrapper">
                                                        <a class="btn btn-default btn-xs btn-add-to-cart"
                                                           href="{{ route('product', ['slug' => $relatedProduct->slug] ) }}">Add
                                                            To Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
    @if(Auth::user())
        <!-- Modal -->
        <div class="modal fade" id="product-feedback-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="product-feedback-form" name="product_feedback_form" class="login-form"
                          action="{{ route('feedback.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h5 class="widget-title line-bottom line- font-20">Write Review</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget border-1px p-30">

                                        <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
                                            <label class="control-label">Rate this item</label>
                                            <div id="rating">
                                            </div>
                                            <input type='hidden' id="ratingValue" name="rating" value="{{old('rating') ? old('rating') : 5}}" />

                                            @if ($errors->has('rating'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('rating') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                            <input type="text" id="subject" name="subject" class="form-control"
                                                   placeholder="Subject" required="" value="{{ old('subject') }}"/>
                                            @if ($errors->has('subject'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                            @endif
                                        </div>


                                        <div class="form-group{{ $errors->has('product_feedback') ? ' has-error' : '' }}">
                                                <textarea rows="10" id="product-feedback" name="product_feedback"
                                                          class="form-control" type="text" placeholder="Write Review"
                                                          required="">{{ old('product_feedback') }}</textarea>

                                            @if ($errors->has('product_feedback'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('product_feedback') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                        <div class="checkbox form-group">
                                            <label class="control-label">
                                                <input type="checkbox" name="is_anonymous"
                                                       value="1" {{ old('is_anonymous') == 1 ? 'checked' : '' }} />
                                                <span class="text-primary">As Anonymous User</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="product_slug" value="{{ $product->slug }}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-theme-colored">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <script type="text/javascript">
        $('#cart-added, #product-feedback-form').submit(function () {
            $(this).find(':input[type=submit]').prop('disabled', true);
        });
        $(document).ready(function () {
            $("a[rel^='prettyPhoto']").prettyPhoto({
//            theme: 'dark_rounded',
//            theme: 'light_rounded',
                theme: 'facebook',
                slideshow: 3000,
                autoplay_slideshow: false
            });
            // Start when document ready
            // $('#rating').rating(); // Call the rating plugin
            $('#rating').rateYo({
                normalFill: "#FFF",
                spacing: '3px',
                starWidth: '14px',
                strokeFill: '#ff9800',
                ratedFill: '#ff9800',
                strokeWidth: 20,
                rating: {{ old('rating') ? old('rating') : '5' }},
                numStars: 5,
                fullStar: true,
                onChange: function(rating, rateYoInstance){
                    $("#ratingValue").val(rating);
                }
            }); // Call the rating plugin for form
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
            <?php    if (count($errors) > 0) { ?>
            $('#product-feedback-model').modal('show');
            <?php } ?>
        });
    </script>
@endsection
