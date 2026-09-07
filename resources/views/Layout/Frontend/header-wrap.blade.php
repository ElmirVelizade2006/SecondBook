    <div id="header-wrap">

        <div class="top-content">
            <div class="container-fluid">
                <div class="row align-items-center top-content-row">
                    <div class="col-lg-3 col-md-6">
                        <div class="social-links top-announcement">
                            <span class="top-inline-item">
                                <i class="bi bi-book-fill" aria-hidden="true"></i>
                                Buy <span class="dot">•</span> Sell <span class="dot">•</span> Discover Books
                            </span>
                        </div><!--social-links-->
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="top-benefits text-center">
                            <span class="top-inline-item"><i class="bi bi-truck" aria-hidden="true"></i> Free Shipping on Orders over $50</span>
                            <span class="top-inline-item"><i class="bi bi-star-fill" aria-hidden="true"></i> Trusted Sellers</span>
                            <span class="top-inline-item"><i class="bi bi-shield-lock-fill" aria-hidden="true"></i> Secure Payments</span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="right-element">
                            <a href="#wishlist" class="user-account for-buy"><i class="bi bi-heart" aria-hidden="true"></i><span>Wishlist</span></a>
                            <a href="#cart" class="cart for-buy"><i class="bi bi-cart3" aria-hidden="true"></i><span>Cart</span></a>

                            @guest
                                <a href="{{ route('frontend.auth.login') }}" class="user-account for-buy"><i class="bi bi-person" aria-hidden="true"></i><span>Login</span></a>
                                <a href="{{ route('frontend.auth.register') }}" class="user-account for-buy"><i class="bi bi-pencil-square" aria-hidden="true"></i><span>Register</span></a>
                            @endguest

                            @auth
                                <div class="dropdown profile-dropdown">
                                    <a class="user-account for-buy dropdown-toggle"
                                    href="#"
                                    id="profileDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">

                                        <i class="bi bi-person-circle"></i>

                                        <span>{{ Auth::user()->name }}</span>

                                        <i class="bi bi-chevron-down chevron-icon"></i>

                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                        <li>
                                            <div class="dropdown-header d-flex align-items-center gap-3">
                                                <div class="avatar-wrap">{{ Str::substr(Auth::user()->name, 0, 1) }}</div>
                                                <div>
                                                    <div class="user-name">{{ Auth::user()->name }}</div>
                                                    <div class="user-meta">Logged in • Member since</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('my.profile') }}"><i class="bi bi-person-circle"></i>My Profile</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-bag-check"></i>My Orders</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-heart"></i>Wishlist</a></li>
                                        @if(Auth::user()->role === 'admin')
                                            <li>
                                                <a class="dropdown-item admin-panel-item" href="{{ route('admin.dashboard') }}">
                                                    <i class="bi bi-speedometer2"></i>
                                                    Admin Panel
                                                </a>
                                            </li>
                                        @endif
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-book"></i>Sell a Book</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i>Account Settings</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li class="logout-wrap">
                                            <form action="{{ route('frontend.auth.logout') }}" 
                                                method="POST"
                                                id="profileLogoutForm">

                                                @csrf

                                                <button type="button" 
                                                        class="logout-btn"
                                                        id="profileLogoutBtn">

                                                    <i class="bi bi-box-arrow-right"></i>
                                                    Logout

                                                </button>

                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endauth

                            <div class="action-menu">
                                <div class="search-bar">
                                    <a href="#" class="search-button search-toggle" data-selector="#header-wrap" aria-label="Search">
                                        <i class="bi bi-search"></i>
                                    </a>
                                </div>
                            </div>

                        </div><!--top-right-->
                    </div>

                </div>
            </div>
        </div><!--top-content-->

        <header id="header">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-2">
                        <div class="main-logo">
                            <a href="{{ route('frontend.home') }}"><img src="{{ asset('main-logo.png') }}" alt="logo"></a>
                        </div>

                    </div>

                    <div class="col-md-10">

                        <nav id="navbar">
                            <div class="main-menu stellarnav">
                                <ul class="menu-list">

                                    <li class="menu-item {{ request()->routeIs('frontend.home') ? 'active' : '' }}">
                                        <a href="{{ route('frontend.home') }}">
                                            Home
                                        </a>
                                    </li>


                                    <li class="menu-item">
                                        <a href="{{ route('frontend.home') }}#books" class="nav-link">
                                            Books
                                        </a>
                                    </li>


                                    <li class="menu-item">
                                        <a href="{{ route('frontend.home') }}#categories" class="nav-link">
                                            Categories
                                        </a>
                                    </li>


                                    <li class="menu-item">
                                        <a href="{{ route('frontend.home') }}#authors" class="nav-link">
                                            Authors
                                        </a>
                                    </li>


                                    <li class="menu-item">
                                        <a href="{{ route('frontend.home') }}#about" class="nav-link">
                                            About
                                        </a>
                                    </li>


                                    <li class="menu-item">
                                        <a href="{{ route('frontend.home') }}#contact" class="nav-link">
                                            Contact
                                        </a>
                                    </li>
                                </ul>

                                <div class="hamburger">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>

                            </div>
                        </nav>

                    </div>

                </div>
            </div>
        </header>

    </div><!--header-wrap-->
