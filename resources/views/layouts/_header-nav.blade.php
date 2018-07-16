<header class="header">
    <div class="header-top sm-text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="social">
                        <a href="javascript:void(0)"><img src="{{ asset('images/f_icon.png') }}" width="30"
                                                          alt="Facebook"></a>
                        <a href="javascript:void(0)"><img src="{{ asset('images/t_icon.png') }}" width="30"
                                                          alt="Twitter"></a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8">

                    <div class="widget no-border m-0">
                        <ul class="list-inline text-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false">Help <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="phone_num">
                                        Get help from our experts
                                        <span>{{ config('app.phone_no', '(123) 456-7890') }}</span>
                                    </li>
                                    <li class="live_chat"><a href="javascript:void(0);" id="chat-live"><i
                                                    class="fa fa-comment" aria-hidden="true"></i> Chat Live</a><a
                                                href="{{ route('static-page', ['slug' => 'contact-us'])}}"><i
                                                    class="fa fa-envelope" aria-hidden="true"></i> Contact Us</a></li>
                                    <li class="expert_available">
                                        <span>Live Chat Experts Are Available Mon to Fri 9am-5pm EST</span>
                                    </li>
                                    <li class="inline_link">
                                        <ul class="dropdown">
                                            <li><a href="{{ route('track.order') }}">Track Order</a></li>
                                            <li>
                                                <a href="{{ route('static-page', ['slug' => 'return-policy'])}}">Returns</a>
                                            </li>
                                            <li><a href="{{ route('static-page', ['slug' => 'shipping-policy'])}}">Shipping
                                                    Info</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="text-white">|</li>
                            @if (Auth::guest())
                                <li><a class="text-white" href="{{ route('login') }}">Sigin In</a></li>
                                <li class="text-white">|</li>
                                <li><a class="text-white" href="{{ route('register') }}">Sign Up</a></li>
                            @else
                                <li><a class="text-white" href="{{ route('edit.profile') }}">Profile</a></li>
                                <li class="text-white">|</li>
                                <li><a class="text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Sign Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav">
        <div class="header-nav-wrapper"><!-- navbar-scrolltofixed -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <a class="menuzord-brand red" href="{{ url('/homepage') }}">
                                    PetsWorld
                                    <span>Training Pads</span>
                                </a>
                                <img src="{{ asset('images/free_next.png') }}" alt="Free Next Day Delivery NYC of Dog Pads" width="130" class="shipping_m2">
                                <img src="{{ asset('images/free_fast.png') }}" alt="Free Fast Shipping No Minimum of Training Pads" width="200" class="shipping_m">
                            </div>
                            <div class="col-sm-8 hidden-xs text-right">
                                <div class="desktop_logo">
                                    <a href="https://www.shopperapproved.com/reviews/petpads.net/" class="shopperlink"><img src="//www.shopperapproved.com/newseals/27575/white-mini-icon.gif" style="border: 0" alt="Customer Reviews" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by Shopper Approved \251 '+d.getFullYear()+'.'); return false;" /></a><script type="text/javascript">(function() { var js = window.document.createElement("script"); js.src = '//www.shopperapproved.com/seals/certificate.js'; js.type = "text/javascript"; document.getElementsByTagName("head")[0].appendChild(js); })();</script>
                                    <img src="{{ asset('images/free_next.png') }}" alt="Free Next Day Delivery NYC of Dog Pads" width="124" class="badge1">
                                    <img src="{{ asset('images/free_fast.png') }}" alt="Free Fast Shipping No Minimum of Training Pads" width="149" class="badge2">
                                </div>
                                <div class="cart_btn {{ set_active('shop/cart') }}">
                                    <a href="{{ url('shop/cart') }}"><i class="fa fa-shopping-cart"
                                                                        aria-hidden="true"></i>
                                        <span>
                                            @if (Auth::guest())
                                                Hi Guest,
                                            @else
                                                Hi {{ Auth::user()->first_name }},
                                            @endif
                                            <span>{{ Cart::content()->count() }} items</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fluid-container">
                    <div class="row">
                        <div class="col-sm-12">
                            <nav id="menuzord-right" class="menuzord">
                                <ul class="menuzord-menu">
                                    <li class="{{ isset($page) && $page == 'home' ? 'active' : '' }}"><a
                                                href="{{ route('homepage') }}" title="PetsWorld Inc">Home</a></li>
                                    <li class="{{ isset($page) && $page == 'shop' ? 'active' : '' }}">
                                        <a href="{{ route('shop') }}" title="Shop Training Pads">Shop</a>
                                        <ul class="dropdown" role="menu">
                                            @if(count($nav_categories) > 0)
                                                @foreach($nav_categories as $category)
                                                    <li class="{{ isset($page) && $page == $category->slug ? 'active' : '' }}">
                                                        <a href="{{ route('category', ['slug' => $category->slug]) }}" title="{{ $category->name }}">
                                                            {{ $category->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                    <li class="{{ isset($page) && $page == 'deal' ? 'active' : '' }}"><a
                                                href="{{ route('deal') }}" title="Today Deals">Today Deals</a></li>
                                    @if(count($nav_static_pages) > 0)
                                        @foreach($nav_static_pages as $static_page)
                                            <li class="{{ isset($page) && $page == $static_page->slug ? 'active' : '' }}">
                                                <a href="{{ route('static-page', ['slug' => $static_page->slug])}}" title="{{ $static_page->page_name }}">{{ $static_page->page_name }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                    @if ($app_settings->sample_request)
                                        <li class="{{ isset($page) && $page == 'sample' ? 'active' : '' }}"><a
                                                    href="{{ route('sample.request') }}" title="Free Sample Request">Free Sample Request</a></li>
                                    @endif
                                    @if (Auth::user())
                                        <li class="{{ isset($page) && $page == 'order' ? 'active' : '' }}"><a
                                                    href="{{ route('order') }}" title="My Orders">My Orders</a></li>
                                    @endif
                                    <li class="{{ isset($page) && $page == 'blog' ? 'active' : '' }}"><a
                                                href="{{ route('blog.index') }}" title="Blog">Blog</a></li>
                                    <li class="{{ isset($page) && $page == 'reviews-list' ? 'active' : '' }}"><a
                                                href="{{ route('reviews.list') }}" title="Reviews">Reviews</a></li>
                                    @if (Auth::guest())
                                        <li class="visible-sm visible-xs"><a href="{{ route('login') }}" title="Sign In">Sign In</a>
                                        </li>
                                        <li class="visible-sm visible-xs"><a href="{{ route('register') }}" title="Sign Up">Sign Up</a>
                                        </li>
                                    @else
                                        <li class="visible-sm visible-xs"><a
                                                    href="{{ route('edit.profile') }}">Profile</a></li>
                                        <li class="visible-sm visible-xs"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">Sign Out</a>
                                        </li>
                                    @endif
                                    <li class="visible-xs">
                                        <div class="cart_btn mt-5 mb-5 float_none {{ set_active('shop/cart') }}">
                                            <a href="{{ url('shop/cart') }}"><i class="fa fa-shopping-cart"
                                                                                aria-hidden="true"></i>
                                                <span>
                                                    @if (Auth::guest())
                                                        Hi Guest,
                                                    @else
                                                        Hi {{ Auth::user()->name }},
                                                    @endif
                                                    <span>{{ Cart::content()->count() }} items</span>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    </nav>
                </div>
            </div>
            <div class="save_today"><a href="javascript:void(0);" data-toggle="modal"
                                       data-target="#first-autoship-model"> <span
                            class="promo-ticket">SAVE 20% TODAY</span> when you set up your first Autoship <span
                            class="promo-link">Learn more</span> </a></div>
        </div>
</header>