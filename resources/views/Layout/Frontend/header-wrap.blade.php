<div id="header-wrap">

    {{-- =========================================================
       TOP CONTENT
    ========================================================= --}}
    <div class="top-content">

        <div class="container-fluid">

            <div class="row align-items-center top-content-row">

                {{-- LEFT ANNOUNCEMENT --}}
                <div class="col-lg-3 col-md-6">

                    <div class="social-links top-announcement">

                        <span class="top-inline-item">
                            <i class="bi bi-book-fill" aria-hidden="true"></i>

                            Buy
                            <span class="dot">•</span>
                            Sell
                            <span class="dot">•</span>
                            Discover Books
                        </span>

                    </div>

                </div>


                {{-- CENTER BENEFITS --}}
                <div class="col-lg-5 d-none d-lg-block">

                    <div class="top-benefits text-center">

                        <span class="top-inline-item">
                            <i class="bi bi-truck" aria-hidden="true"></i>
                            Free Shipping on Orders over $50
                        </span>

                        <span class="top-inline-item">
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            Trusted Sellers
                        </span>

                        <span class="top-inline-item">
                            <i class="bi bi-shield-lock-fill" aria-hidden="true"></i>
                            Secure Payments
                        </span>

                    </div>

                </div>


                {{-- RIGHT ELEMENTS --}}
                <div class="col-lg-4 col-md-6">

                    <div class="right-element">


                        {{-- =================================================
                           WISHLIST
                        ================================================== --}}
                        <a
                            href="{{ route('frontend.wishlist') }}"
                            class="user-account for-buy"
                        >

                            <i
                                class="bi bi-heart"
                                aria-hidden="true"
                            ></i>

                            <span>Wishlist</span>

                        </a>


                        {{-- =================================================
                        CART
                        ================================================== --}}

                        @php
                            $headerCart = session()->get('cart', []);
                            $headerCartCount = collect($headerCart)->sum('quantity');
                        @endphp

                        <a
                            href="{{ route('frontend.cart') }}"
                            class="cart for-buy header-cart-link"
                            aria-label="Shopping Cart"
                        >

                            <span class="header-cart-icon">

                                <i
                                    class="bi bi-cart3"
                                    aria-hidden="true"
                                ></i>

                                <span
                                    class="cart-count-badge"
                                    id="header-cart-count"
                                    @if($headerCartCount <= 0)
                                        style="display: none;"
                                    @endif
                                >
                                    {{ $headerCartCount > 99 ? '99+' : $headerCartCount }}
                                </span>

                            </span>

                            <span>Cart</span>

                        </a>


                        {{-- =================================================
                           AUTHENTICATED USER
                        ================================================== --}}
                        @auth

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | HEADER NOTIFICATIONS
                                |--------------------------------------------------------------------------
                                */

                                $headerNotifications = Auth::user()
                                    ->notifications()
                                    ->latest()
                                    ->take(5)
                                    ->get();

                                $headerUnreadCount = Auth::user()
                                    ->notifications()
                                    ->whereNull('read_at')
                                    ->count();

                            @endphp


                            {{-- =================================================
                               NOTIFICATIONS
                            ================================================== --}}
                            <div class="dropdown notification-dropdown">

                                <a
                                    href="#"
                                    class="notification-trigger"
                                    id="notificationDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    aria-label="Notifications"
                                >

                                    <i class="bi bi-bell"></i>


                                    {{-- UNREAD BADGE --}}
                                    @if($headerUnreadCount > 0)

                                        <span class="notification-badge">

                                            {{ $headerUnreadCount > 99 ? '99+' : $headerUnreadCount }}

                                        </span>

                                    @endif

                                </a>


                                {{-- =================================================
                                   NOTIFICATION MENU
                                ================================================== --}}
                                <div
                                    class="dropdown-menu dropdown-menu-end notification-menu"
                                    aria-labelledby="notificationDropdown"
                                >


                                    {{-- HEADER --}}
                                    <div class="notification-header">

                                        <div>

                                            <h6>
                                                Notifications
                                            </h6>


                                            @if($headerUnreadCount > 0)

                                                <span>
                                                    {{ $headerUnreadCount }} unread
                                                </span>

                                            @else

                                                <span>
                                                    You're all caught up
                                                </span>

                                            @endif

                                        </div>


                                        {{-- MARK ALL --}}
                                        @if($headerUnreadCount > 0)

                                            <form
                                                action="{{ route('frontend.notifications.read-all') }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="mark-all-btn"
                                                >
                                                    Mark all as read
                                                </button>

                                            </form>

                                        @endif

                                    </div>


                                    {{-- =================================================
                                       NOTIFICATION LIST
                                    ================================================== --}}
                                    <div class="notification-list">

                                        @forelse($headerNotifications as $notification)

                                            <form
                                                action="{{ route('frontend.notifications.read', $notification) }}"
                                                method="POST"
                                                class="notification-item-form"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="notification-item {{ is_null($notification->read_at) ? 'unread' : '' }}"
                                                >

                                                    {{-- ICON --}}
                                                    <span class="notification-icon">

                                                        @if($notification->type === 'book_request')

                                                            <i class="bi bi-book"></i>

                                                        @else

                                                            <i class="bi bi-bell"></i>

                                                        @endif

                                                    </span>


                                                    {{-- CONTENT --}}
                                                    <span class="notification-content">

                                                        <strong>
                                                            {{ $notification->title }}
                                                        </strong>

                                                        <span>
                                                            {{ Str::limit($notification->message, 75) }}
                                                        </span>

                                                        <small>
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        </small>

                                                    </span>


                                                    {{-- UNREAD DOT --}}
                                                    @if(is_null($notification->read_at))

                                                        <span class="notification-dot"></span>

                                                    @endif

                                                </button>

                                            </form>

                                        @empty

                                            {{-- EMPTY STATE --}}
                                            <div class="notification-empty">

                                                <i class="bi bi-bell-slash"></i>

                                                <strong>
                                                    No notifications
                                                </strong>

                                                <span>
                                                    You don't have any notifications yet.
                                                </span>

                                            </div>

                                        @endforelse

                                    </div>


                                    {{-- =================================================
                                       FOOTER
                                    ================================================== --}}
                                    <div class="notification-footer">

                                        <a
                                            href="{{ route('frontend.notifications.index') }}"
                                        >

                                            View all notifications

                                            <i class="bi bi-arrow-right"></i>

                                        </a>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                               PROFILE DROPDOWN
                            ================================================== --}}
                            <div class="dropdown profile-dropdown">

                                <a
                                    class="user-account for-buy dropdown-toggle"
                                    href="#"
                                    id="profileDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >

                                    <i class="bi bi-person-circle"></i>

                                    <span>
                                        {{ Auth::user()->name }}
                                    </span>

                                    <i class="bi bi-chevron-down chevron-icon"></i>

                                </a>


                                {{-- PROFILE MENU --}}
                                <ul
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="profileDropdown"
                                >

                                    {{-- USER HEADER --}}
                                    <li>

                                        <div class="dropdown-header d-flex align-items-center gap-3">

                                            <div class="avatar-wrap">

                                                {{ Str::substr(Auth::user()->name, 0, 1) }}

                                            </div>


                                            <div>

                                                <div class="user-name">

                                                    {{ Auth::user()->name }}

                                                </div>


                                                <div class="user-meta">

                                                    Logged in • Member since

                                                </div>

                                            </div>

                                        </div>

                                    </li>


                                    {{-- MY PROFILE --}}
                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="{{ route('my.profile') }}"
                                        >

                                            <i class="bi bi-person-circle"></i>

                                            My Profile

                                        </a>

                                    </li>


                                    {{-- MY ORDERS --}}
                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="{{ route('frontend.orders') }}"
                                        >

                                            <i class="bi bi-bag-check"></i>

                                            My Orders

                                        </a>

                                    </li>


                                    {{-- WISHLIST --}}
                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="{{ route('frontend.wishlist') }}"
                                        >

                                            <i class="bi bi-heart"></i>

                                            Wishlist

                                        </a>

                                    </li>


                                    {{-- ADMIN PANEL --}}
                                    @if(Auth::user()->role === 'admin')

                                        <li>

                                            <a
                                                class="dropdown-item admin-panel-item"
                                                href="{{ route('admin.dashboard') }}"
                                            >

                                                <i class="bi bi-speedometer2"></i>

                                                Admin Panel

                                            </a>

                                        </li>

                                    @endif


                                    {{-- SELL A BOOK --}}
                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="{{ route('frontend.sell-book') }}"
                                        >

                                            <i class="bi bi-book"></i>

                                            Sell a Book

                                        </a>

                                    </li>


                                    {{-- ACCOUNT SETTINGS --}}
                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="{{ route('frontend.account.settings') }}"
                                        >

                                            <i class="bi bi-gear"></i>

                                            Account Settings

                                        </a>

                                    </li>


                                    {{-- DIVIDER --}}
                                    <li>

                                        <hr class="dropdown-divider">

                                    </li>


                                    {{-- LOGOUT --}}
                                    <li class="logout-wrap">

                                        <form
                                            action="{{ route('frontend.auth.logout') }}"
                                            method="POST"
                                            id="profileLogoutForm"
                                        >

                                            @csrf

                                            <button
                                                type="button"
                                                class="logout-btn"
                                                id="profileLogoutBtn"
                                            >

                                                <i class="bi bi-box-arrow-right"></i>

                                                Logout

                                            </button>

                                        </form>

                                    </li>

                                </ul>

                            </div>


                        @endauth


                        {{-- =================================================
                           GUEST USER
                        ================================================== --}}
                        @guest

                            <a
                                href="{{ route('frontend.auth.login') }}"
                                class="user-account for-buy"
                            >

                                <i
                                    class="bi bi-person"
                                    aria-hidden="true"
                                ></i>

                                <span>
                                    Login
                                </span>

                            </a>


                            <a
                                href="{{ route('frontend.auth.register') }}"
                                class="user-account for-buy"
                            >

                                <i
                                    class="bi bi-pencil-square"
                                    aria-hidden="true"
                                ></i>

                                <span>
                                    Register
                                </span>

                            </a>

                        @endguest


                        {{-- =================================================
                           SEARCH
                        ================================================== --}}
                        <div class="action-menu">

                            <div class="search-bar">

                                <a
                                    href="#"
                                    class="search-button search-toggle"
                                    data-selector="#header-wrap"
                                    aria-label="Search"
                                >

                                    <i class="bi bi-search"></i>

                                </a>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
       MAIN HEADER
    ========================================================= --}}
    <header id="header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-2">

                    <div class="main-logo">

                        <a href="{{ route('frontend.home') }}">

                            <img
                                src="{{ asset('main-logo.png') }}"
                                alt="SecondBook"
                            >

                        </a>

                    </div>

                </div>


                <div class="col-md-10">

                    <nav
                        id="navbar"
                        class="header-nav"
                    >

                        <div class="main-menu stellarnav">

                            <ul class="menu-list">

                                {{-- HOME --}}
                                <li class="menu-item {{ request()->routeIs('frontend.home') ? 'active' : '' }}">

                                    <a href="{{ route('frontend.home') }}">
                                        Home
                                    </a>

                                </li>


                                {{-- BOOKS --}}
                                <li class="menu-item {{ request()->routeIs('frontend.books*') ? 'active' : '' }}">

                                    <a href="{{ route('frontend.books') }}">
                                        Books
                                    </a>

                                </li>


                                {{-- CATEGORIES --}}
                                <li class="menu-item {{ request()->routeIs('frontend.categories*') ? 'active' : '' }}">

                                    <a href="{{ route('frontend.categories') }}">
                                        Categories
                                    </a>

                                </li>


                                {{-- AUTHORS --}}
                                <li class="menu-item {{ request()->routeIs('frontend.authors*') ? 'active' : '' }}">

                                    <a href="{{ route('frontend.authors') }}">
                                        Authors
                                    </a>

                                </li>


                                {{-- ABOUT --}}
                                <li class="menu-item {{ request()->routeIs('frontend.about') ? 'active' : '' }}">

                                    <a href="{{ route('frontend.about') }}">
                                        About
                                    </a>

                                </li>


                                {{-- CONTACT --}}
                                <li class="menu-item {{ request()->routeIs('frontend.contact') ? 'active' : '' }}">

                                    <a href="{{ route('frontend.contact') }}">
                                        Contact
                                    </a>

                                </li>

                            </ul>

                        </div>

                    </nav>

                </div>

            </div>

        </div>

    </header>

</div>