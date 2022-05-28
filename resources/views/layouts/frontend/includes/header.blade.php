<header class="top-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food"
                aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-rs-food">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ request()->routeIs('customer.home') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('customer.home') }}">Home</a></li>
                    <li class="nav-item {{ request()->routeIs('customer.menu') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('customer.menu') }}">Menu</a>
                    </li>
                    {{-- <li class="nav-item {{ request()->routeIs('customer.about') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('customer.about') }}">About</a></li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-a">
                            <a class="dropdown-item" href="reservation.html">Reservation</a>
                            <a class="dropdown-item" href="{{ route('customer.stuff') }}">Stuff</a>
                            <a class="dropdown-item" href="{{ route('customer.gallery') }}">Gallery</a>
                            <a class="dropdown-item" href="{{ route('customer.blog') }}">blog</a>
                            <a class="dropdown-item" href="{{ route('customer.blog-detail') }}">blog Single</a>
                            <a class="dropdown-item" href="{{ route('customer.contact') }}">Contact</a>
                            <a class="dropdown-item" href="{{ route('customer.about') }}">About</a>
                        </div>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">Blog</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-a">
                            <a class="dropdown-item" href="{{ route('customer.blog') }}">blog</a>
                            <a class="dropdown-item" href="{{ route('customer.blog-detail') }}">blog Single</a>
                        </div>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.contact') }}">Contact</a>
                    </li> --}}
                    @auth
                        <li class="nav-item">
                            <a class="nav-link nav-icon" href="{{ route('customer.cart.list') }}"><i
                                    class='icon bx bxs-cart-alt'></i> Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.cart.list') }}">Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
