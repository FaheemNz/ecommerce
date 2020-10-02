<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href=""><img src="{{ asset('img/logo.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                        <li class="nav-item active"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('shop.index') }}">Shop</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </ul>

                    <ul class="nav-shop">
                        @guest
                        <li class="nav-item d-flex">
                            <a href="{{ route('login') }}" class="btn mr-2 btn-outline-info nav-link">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary nav-link">Register</a>
                        </li>
                        @endguest
                        @auth
                        <li class="nav-item">
                            <button><a class="text-dark" href="{{ route('cart.index') }}">Cart</a>
                                <i class="ti-shopping-cart"></i>
                                <span id="cart-nav-items-count" class="nav-shop__circle">{{ Cart::instance('default')->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <a class="button button-header" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>