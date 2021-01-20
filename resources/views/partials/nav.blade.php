<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="/"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    {{ menu('main-menu', 'partials.menus.main') }}
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
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle btn border" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-user mr-2"></i> Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                   <i class="fa fa-gear mr-2"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>