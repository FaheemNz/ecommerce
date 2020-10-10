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
                        <li class="nav-item {{ request()->routeIs('landing') ? 'active' : '' }}"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item {{ request()->routeIs('shop.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('shop.index') }}">Shop</a></li>
                        <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    </ul>

                    <ul class="nav-shop">
                        @guest
                        <li class="nav-item d-flex">
                            <a href="{{ route('login') }}" class="btn mr-2 is-rounded btn-sm btn-outline-info nav-link">Login</a>
                            <a href="{{ route('register') }}" class="btn is-rounded btn-sm btn-outline-primary nav-link">Register</a>
                        </li>
                        @endguest
                        @auth
                        <li class="nav-item">
                            <button class="{{ request()->routeIs('cart.index') ? 'border px-2 border-primary' : '' }}">
                            <a href="/cart" class="text-dark">
                                <i class="fa fa-shopping-cart"></i>
                                <span id="cart-nav-items-count" class="nav-shop__circle">{{ Cart::count() }}</span>
                            </a>
                            </button>
                        </li>
                        <li class="nav-item ml-1">
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