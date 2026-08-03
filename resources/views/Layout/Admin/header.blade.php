<nav class="navbar navbar-expand-lg bg-white shadow-sm border-bottom px-3 px-md-4 py-3">

    <div class="container-fluid p-0">

        <div class="d-flex align-items-center">

            <button class="header-toggle me-2 me-md-3 is-active"
                    id="toggleSidebar"
                    type="button"
                    aria-label="Menyunu aç / bağla"
                    aria-expanded="true">
                <span class="hamburger-box" aria-hidden="true">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </span>

            </button>

            <div>
                <h4 class="mb-0 fw-bold header-title">
                    @yield('title','Dashboard')
                </h4>

                <small class="text-muted d-none d-sm-inline">
                    Welcome back, Admin 👋
                </small>
            </div>

        </div>

        <div class="d-flex align-items-center">

            {{-- Search - yalnız md və yuxarıda tam görünsün --}}
            <div class="search-box me-2 me-lg-4 d-none d-md-flex">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Search books, users, orders...">
            </div>

            {{-- Kicik ekranda sadece axtaris ikonu --}}
            <button class="header-icon me-2 d-flex d-md-none">
                <i class="bi bi-search"></i>
            </button>

            {{-- Notification --}}
            <button class="header-icon me-2 me-md-3">
                <i class="bi bi-bell"></i>
                <span class="notification-badge">3</span>
            </button>

            {{-- Messages - kicik ekranda gizlensin --}}
            <button class="header-icon me-2 me-md-4 d-none d-lg-flex">
                <i class="bi bi-chat-dots"></i>
            </button>

            {{-- Profile --}}
            <div class="dropdown">
                @auth
                    <a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown">

                        <img src="https://i.pravatar.cc/100?img=12" class="profile-image">

                        <div class="ms-3 d-none d-sm-block">
                            <h6 class="mb-0 fw-semibold">{{ auth()->user()->name }}</h6>
                            <small class="text-muted">Administrator</small>
                        </div>

                        <i class="bi bi-chevron-down ms-2 ms-md-3 text-secondary d-none d-sm-inline"></i>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4">
                        <li><a class="dropdown-item py-2" href="{{ route('my.profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item py-2" href="{{ route('admin.settings.index') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>

                            <form action="{{ route('frontend.auth.logout') }}" 
                                method="POST"
                                id="logoutForm">

                                @csrf

                                <button type="button"
                                        class="dropdown-item text-danger py-2"
                                        id="logoutBtn">

                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout

                                </button>

                            </form>

                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item py-2" href="#" id="themeToggleBtn">
                                <i class="bi bi-moon-stars me-2" id="themeToggleIcon"></i>
                                <span id="themeToggleLabel">Switch to Dark Mode</span>
                            </a>
                        </li>
                    </ul>
                @endauth
            </div>

        </div>

    </div>

</nav>