@extends('Layout.Frontend.master')

@section('title', 'Account Settings | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/account-settings.css') }}">
@endpush

@section('content')

<section class="account-settings-page">

    <div class="container">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="account-settings-header">

            <div>

                <span class="account-settings-overline">
                    <i class="bi bi-gear"></i>
                    ACCOUNT SETTINGS
                </span>

                <h1>
                    Manage Your
                    <em>Account.</em>
                </h1>

                <p>
                    Control your security, notifications and privacy
                    preferences from one place.
                </p>

            </div>

            <a
                href="{{ route('my.profile') }}"
                class="account-back-profile"
            >
                <i class="bi bi-arrow-left"></i>
                My Profile
            </a>

        </div>


        {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}

        @if(session('success'))

            <div class="account-alert account-alert-success">

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- =====================================================
             VALIDATION ERRORS
        ====================================================== --}}

        @if($errors->any())

            <div class="account-alert account-alert-error">

                <i class="bi bi-exclamation-circle-fill"></i>

                <div>

                    <strong>
                        Please check the following:
                    </strong>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif


        {{-- =====================================================
             MAIN LAYOUT
        ====================================================== --}}

        <div class="account-settings-layout">


            {{-- =================================================
                 SIDEBAR
            ================================================== --}}

            <aside class="account-settings-sidebar">

                {{-- Mini Profile --}}

                <div class="account-mini-profile">

                    <div class="account-avatar">
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    </div>

                    <div>

                        <strong>
                            {{ $user->name ?? 'User' }}
                        </strong>

                        <span>
                            {{ $user->email ?? '' }}
                        </span>

                    </div>

                </div>


                {{-- Navigation --}}

                <nav
                    class="account-settings-nav"
                    aria-label="Account Settings Navigation"
                >

                    <a
                        href="#account"
                        class="settings-nav-link active"
                    >
                        <i class="bi bi-person"></i>
                        <span>Account</span>
                    </a>

                    <a
                        href="#security"
                        class="settings-nav-link"
                    >
                        <i class="bi bi-shield-lock"></i>
                        <span>Security</span>
                    </a>

                    <a
                        href="#notifications"
                        class="settings-nav-link"
                    >
                        <i class="bi bi-bell"></i>
                        <span>Notifications</span>
                    </a>

                    <a
                        href="#privacy"
                        class="settings-nav-link"
                    >
                        <i class="bi bi-eye"></i>
                        <span>Privacy</span>
                    </a>

                    <a
                        href="#danger"
                        class="settings-nav-link"
                    >
                        <i class="bi bi-trash3"></i>
                        <span>Danger Zone</span>
                    </a>

                </nav>

            </aside>


            {{-- =================================================
                 MAIN CONTENT
            ================================================== --}}

            <div class="account-settings-content">


                {{-- =================================================
                     ACCOUNT
                ================================================== --}}

                <section
                    id="account"
                    class="settings-card"
                >

                    <div class="settings-card-header">

                        <div class="settings-card-icon">
                            <i class="bi bi-person"></i>
                        </div>

                        <div>

                            <h2>
                                Account Information
                            </h2>

                            <p>
                                Basic information connected to your account.
                            </p>

                        </div>

                    </div>


                    <div class="settings-info-grid">

                        {{-- Full Name --}}

                        <div class="settings-info-item">

                            <span>
                                FULL NAME
                            </span>

                            <strong>
                                {{ $user->name ?? '—' }}
                            </strong>

                        </div>


                        {{-- Email --}}

                        <div class="settings-info-item">

                            <span>
                                EMAIL ADDRESS
                            </span>

                            <strong>
                                {{ $user->email ?? '—' }}
                            </strong>

                        </div>


                        {{-- Member Since --}}

                        <div class="settings-info-item">

                            <span>
                                MEMBER SINCE
                            </span>

                            <strong>
                                {{ $user->created_at?->format('F Y') ?? '—' }}
                            </strong>

                        </div>


                        {{-- Account Status --}}

                        <div class="settings-info-item">

                            <span>
                                ACCOUNT STATUS
                            </span>

                            <strong class="settings-status">

                                <i class="bi bi-check-circle-fill"></i>

                                Active

                            </strong>

                        </div>

                    </div>


                    <div class="settings-card-footer">

                        <span>
                            Need to change your profile information?
                        </span>

                        <a
                            href="{{ route('profile.edit') }}"
                            class="settings-outline-btn"
                        >
                            Edit Profile
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>

                </section>



                {{-- =================================================
                     SECURITY
                ================================================== --}}

                <section
                    id="security"
                    class="settings-card"
                >

                    <div class="settings-card-header">

                        <div class="settings-card-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>

                        <div>

                            <h2>
                                Password & Security
                            </h2>

                            <p>
                                Keep your SecondBook account protected.
                            </p>

                        </div>

                    </div>


                    <form
                        action="{{ route('frontend.account.settings.password') }}"
                        method="POST"
                        class="settings-form"
                    >

                        @csrf

                        @method('PUT')


                        {{-- Current Password --}}

                        <div class="settings-form-group">

                            <label for="current_password">
                                Current Password
                            </label>

                            <div class="settings-input">

                                <i class="bi bi-lock"></i>

                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    placeholder="Enter your current password"
                                    autocomplete="current-password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    data-target="current_password"
                                    aria-label="Show password"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>

                            </div>

                        </div>


                        {{-- New Password + Confirm Password --}}

                        <div class="settings-form-row">


                            {{-- New Password --}}

                            <div class="settings-form-group">

                                <label for="password">
                                    New Password
                                </label>

                                <div class="settings-input">

                                    <i class="bi bi-key"></i>

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        placeholder="Minimum 8 characters"
                                        autocomplete="new-password"
                                        minlength="8"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="password"
                                        aria-label="Show password"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </div>

                            </div>


                            {{-- Confirm Password --}}

                            <div class="settings-form-group">

                                <label for="password_confirmation">
                                    Confirm New Password
                                </label>

                                <div class="settings-input">

                                    <i class="bi bi-key-fill"></i>

                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        placeholder="Repeat your new password"
                                        autocomplete="new-password"
                                        minlength="8"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="password_confirmation"
                                        aria-label="Show password"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </div>

                            </div>

                        </div>


                        {{-- Form Footer --}}

                        <div class="settings-form-footer">

                            <span>

                                <i class="bi bi-info-circle"></i>

                                Use a strong password you don't use elsewhere.

                            </span>

                            <button
                                type="submit"
                                class="settings-primary-btn"
                            >
                                Update Password
                                <i class="bi bi-arrow-right"></i>
                            </button>

                        </div>

                    </form>

                </section>



                {{-- =================================================
                     NOTIFICATIONS
                ================================================== --}}

                <section
                    id="notifications"
                    class="settings-card"
                >

                    <div class="settings-card-header">

                        <div class="settings-card-icon">
                            <i class="bi bi-bell"></i>
                        </div>

                        <div>

                            <h2>
                                Notifications
                            </h2>

                            <p>
                                Choose which updates you'd like to receive.
                            </p>

                        </div>

                    </div>


                    <form
                        action="{{ route('frontend.account.settings.preferences') }}"
                        method="POST"
                        class="settings-preferences-form"
                    >

                        @csrf

                        @method('PUT')


                        {{-- Email Notifications --}}

                        <label class="settings-toggle-row">

                            <div class="settings-toggle-text">

                                <div class="settings-toggle-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>

                                <div>

                                    <strong>
                                        Email Notifications
                                    </strong>

                                    <span>
                                        Receive important account emails.
                                    </span>

                                </div>

                            </div>

                            <input
                                type="checkbox"
                                name="email_notifications"
                                value="1"
                                {{ ($settings->email_notifications ?? false) ? 'checked' : '' }}
                            >

                            <span class="settings-switch"></span>

                        </label>


                        {{-- Order Updates --}}

                        <label class="settings-toggle-row">

                            <div class="settings-toggle-text">

                                <div class="settings-toggle-icon">
                                    <i class="bi bi-box-seam"></i>
                                </div>

                                <div>

                                    <strong>
                                        Order Updates
                                    </strong>

                                    <span>
                                        Get notified about your orders.
                                    </span>

                                </div>

                            </div>

                            <input
                                type="checkbox"
                                name="order_updates"
                                value="1"
                                {{ ($settings->order_updates ?? false) ? 'checked' : '' }}
                            >

                            <span class="settings-switch"></span>

                        </label>


                        {{-- Promotional Emails --}}

                        <label class="settings-toggle-row">

                            <div class="settings-toggle-text">

                                <div class="settings-toggle-icon">
                                    <i class="bi bi-megaphone"></i>
                                </div>

                                <div>

                                    <strong>
                                        Promotional Emails
                                    </strong>

                                    <span>
                                        Receive offers, news and special deals.
                                    </span>

                                </div>

                            </div>

                            <input
                                type="checkbox"
                                name="promotional_emails"
                                value="1"
                                {{ ($settings->promotional_emails ?? false) ? 'checked' : '' }}
                            >

                            <span class="settings-switch"></span>

                        </label>


                        {{-- Footer --}}

                        <div class="settings-preferences-footer">

                            <button
                                type="submit"
                                class="settings-primary-btn"
                            >
                                Save Preferences
                                <i class="bi bi-check2"></i>
                            </button>

                        </div>

                    </form>

                </section>



                {{-- =================================================
                     PRIVACY
                ================================================== --}}

                <section
                    id="privacy"
                    class="settings-card"
                >

                    <div class="settings-card-header">

                        <div class="settings-card-icon">
                            <i class="bi bi-eye"></i>
                        </div>

                        <div>

                            <h2>
                                Privacy
                            </h2>

                            <p>
                                Control how your profile appears to others.
                            </p>

                        </div>

                    </div>


                    <form
                        action="{{ route('frontend.account.settings.preferences') }}"
                        method="POST"
                        class="privacy-form"
                    >

                        @csrf

                        @method('PUT')


                        <label class="settings-toggle-row">

                            <div class="settings-toggle-text">

                                <div class="settings-toggle-icon">
                                    <i class="bi bi-person-check"></i>
                                </div>

                                <div>

                                    <strong>
                                        Visible Profile
                                    </strong>

                                    <span>
                                        Allow other users to see your public profile.
                                    </span>

                                </div>

                            </div>

                            <input
                                type="checkbox"
                                name="profile_visible"
                                value="1"
                                {{ ($settings->profile_visible ?? false) ? 'checked' : '' }}
                            >

                            <span class="settings-switch"></span>

                        </label>


                        <div class="settings-preferences-footer">

                            <button
                                type="submit"
                                class="settings-primary-btn"
                            >
                                Save Privacy
                                <i class="bi bi-check2"></i>
                            </button>

                        </div>

                    </form>

                </section>



                {{-- =================================================
                     DANGER ZONE
                ================================================== --}}

                <section
                    id="danger"
                    class="settings-card settings-danger-card"
                >

                    <div class="settings-card-header">

                        <div class="settings-card-icon danger">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>

                        <div>

                            <h2>
                                Danger Zone
                            </h2>

                            <p>
                                Actions here can permanently affect your account.
                            </p>

                        </div>

                    </div>


                    <div class="danger-action">

                        <div>

                            <strong>
                                Delete Account
                            </strong>

                            <span>
                                Permanently delete your SecondBook account
                                and associated information.
                            </span>

                        </div>


                        <form
                            action="{{ route('profile.destroy') }}"
                            method="POST"
                            class="danger-delete-form"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="danger-delete-btn"
                            >
                                <i class="bi bi-trash3"></i>
                                Delete Account
                            </button>

                        </form>

                    </div>

                </section>


            </div>

        </div>

    </div>

</section>

@endsection

<script>
(function () {

    'use strict';


    /* =========================================================
       PAGE READY
    ========================================================= */

    function initAccountSettings() {

        const navLinks = Array.from(
            document.querySelectorAll('.settings-nav-link')
        );

        const sections = Array.from(
            document.querySelectorAll(
                '.account-settings-content .settings-card'
            )
        );


        if (!navLinks.length || !sections.length) {
            console.warn(
                'SecondBook Account Settings: navigation or sections not found.'
            );

            return;
        }


        /* =====================================================
           ACTIVE LINK
        ===================================================== */

        function setActive(id) {

            navLinks.forEach(function (link) {

                const href = link.getAttribute('href');

                if (href === '#' + id) {

                    link.classList.add('active');

                } else {

                    link.classList.remove('active');

                }

            });

        }


        /* =====================================================
           PASSWORD TOGGLE
        ===================================================== */

        const passwordButtons =
            document.querySelectorAll('.password-toggle');


        passwordButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const targetId =
                    this.getAttribute('data-target');

                const input =
                    document.getElementById(targetId);

                const icon =
                    this.querySelector('i');


                if (!input || !icon) {
                    return;
                }


                if (input.type === 'password') {

                    input.type = 'text';

                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');

                    this.setAttribute(
                        'aria-label',
                        'Hide password'
                    );

                } else {

                    input.type = 'password';

                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');

                    this.setAttribute(
                        'aria-label',
                        'Show password'
                    );

                }

            });

        });


        /* =====================================================
           NAVIGATION CLICK
        ===================================================== */

        navLinks.forEach(function (link) {

            link.addEventListener('click', function (event) {

                event.preventDefault();


                const href =
                    this.getAttribute('href');


                if (!href || href === '#') {
                    return;
                }


                const targetId =
                    href.substring(1);


                const target =
                    document.getElementById(targetId);


                if (!target) {
                    return;
                }


                setActive(targetId);


                /*
                 * Scroll manually.
                 * This works independently from CSS scroll-margin.
                 */

                const navbar =
                    document.querySelector(
                        '.navbar, header, .site-header'
                    );


                let offset = 100;


                if (navbar) {

                    const navbarHeight =
                        navbar.getBoundingClientRect().height;

                    if (navbarHeight > 0) {
                        offset = navbarHeight + 25;
                    }

                }


                const targetPosition =
                    target.getBoundingClientRect().top +
                    window.pageYOffset -
                    offset;


                window.scrollTo({

                    top: Math.max(
                        0,
                        targetPosition
                    ),

                    behavior: 'smooth'

                });

            });

        });


        /* =====================================================
           FIND ACTIVE SECTION
        ===================================================== */

        function updateActiveSection() {

            const detectionLine = 220;

            let activeSection = sections[0];


            sections.forEach(function (section) {

                const rect =
                    section.getBoundingClientRect();


                if (rect.top <= detectionLine) {

                    activeSection = section;

                }

            });


            if (activeSection) {

                setActive(
                    activeSection.id
                );

            }

        }


        /* =====================================================
           SCROLL
        ===================================================== */

        let ticking = false;


        function onScroll() {

            if (ticking) {
                return;
            }


            window.requestAnimationFrame(function () {

                updateActiveSection();

                ticking = false;

            });


            ticking = true;

        }


        /*
         * capture:true
         *
         * Bu vacibdir.
         * Əgər səhifədə nested scroll container varsa,
         * scroll event-i yenə tutulur.
         */

        window.addEventListener(
            'scroll',
            onScroll,
            {
                passive: true,
                capture: true
            }
        );


        /* =====================================================
           RESIZE
        ===================================================== */

        window.addEventListener(
            'resize',
            updateActiveSection
        );


        /* =====================================================
           INTERSECTION OBSERVER
        ===================================================== */

        /*
         * Scroll event-dən əlavə observer də istifadə edirik.
         * Beləliklə section ekranda dəyişəndə active link yenilənir.
         */

        if ('IntersectionObserver' in window) {

            const observer =
                new IntersectionObserver(
                    function (entries) {

                        const visibleSections =
                            entries
                                .filter(function (entry) {
                                    return entry.isIntersecting;
                                })
                                .sort(function (a, b) {
                                    return (
                                        a.boundingClientRect.top -
                                        b.boundingClientRect.top
                                    );
                                });


                        if (visibleSections.length) {

                            setActive(
                                visibleSections[0].target.id
                            );

                        }

                    },
                    {
                        root: null,
                        rootMargin: '-15% 0px -65% 0px',
                        threshold: 0
                    }
                );


            sections.forEach(function (section) {

                observer.observe(section);

            });

        }


        /* =====================================================
           INITIAL STATE
        ===================================================== */

        updateActiveSection();


        /* =====================================================
           PASSWORD MATCH
        ===================================================== */

        const password =
            document.getElementById('password');

        const confirmation =
            document.getElementById(
                'password_confirmation'
            );


        if (password && confirmation) {

            function validatePasswords() {

                if (
                    confirmation.value &&
                    password.value !== confirmation.value
                ) {

                    confirmation.setCustomValidity(
                        'Passwords do not match.'
                    );

                } else {

                    confirmation.setCustomValidity('');

                }

            }


            password.addEventListener(
                'input',
                validatePasswords
            );


            confirmation.addEventListener(
                'input',
                validatePasswords
            );

        }


        /* =====================================================
           DELETE ACCOUNT
        ===================================================== */

        const deleteForm =
            document.querySelector(
                '.danger-delete-form'
            );


        if (deleteForm) {

            deleteForm.addEventListener(
                'submit',
                function (event) {

                    const confirmed =
                        window.confirm(
                            'Are you sure you want to permanently delete your account? This action cannot be undone.'
                        );


                    if (!confirmed) {

                        event.preventDefault();

                    }

                }
            );

        }


        /* =====================================================
           DEBUG
        ===================================================== */

        console.log(
            'SecondBook Account Settings JS loaded successfully.'
        );

    }


    /* =========================================================
       START
    ========================================================= */

    if (
        document.readyState === 'loading'
    ) {

        document.addEventListener(
            'DOMContentLoaded',
            initAccountSettings
        );

    } else {

        initAccountSettings();

    }

})();
</script>


{{-- =============================================================
     JAVASCRIPT
============================================================== --}}

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       ELEMENTS
    ========================================================= */

    const navLinks = document.querySelectorAll(
        '.settings-nav-link'
    );

    const sections = Array.from(
        document.querySelectorAll(
            '.account-settings-content > .settings-card'
        )
    );


    /* =========================================================
       PASSWORD TOGGLE
    ========================================================= */

    document.querySelectorAll('.password-toggle').forEach(function (button) {

        button.addEventListener('click', function () {

            const targetId = this.getAttribute('data-target');

            const input = document.getElementById(targetId);

            const icon = this.querySelector('i');

            if (!input || !icon) {
                return;
            }


            if (input.type === 'password') {

                input.type = 'text';

                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');

                this.setAttribute(
                    'aria-label',
                    'Hide password'
                );

            } else {

                input.type = 'password';

                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');

                this.setAttribute(
                    'aria-label',
                    'Show password'
                );

            }

        });

    });


    /* =========================================================
       ACTIVE NAV LINK
    ========================================================= */

    function setActiveLink(sectionId) {

        navLinks.forEach(function (link) {

            const href = link.getAttribute('href');

            const isActive =
                href === '#' + sectionId;

            link.classList.toggle(
                'active',
                isActive
            );

        });

    }


    /* =========================================================
       NAVIGATION CLICK
    ========================================================= */

    navLinks.forEach(function (link) {

        link.addEventListener('click', function (event) {

            event.preventDefault();

            const href = this.getAttribute('href');

            if (!href || href === '#') {
                return;
            }

            const targetId = href.substring(1);

            const targetSection =
                document.getElementById(targetId);

            if (!targetSection) {
                return;
            }


            setActiveLink(targetId);


            /*
             * Header offset.
             * This prevents the section from going underneath
             * the website navbar.
             */

            const headerOffset = 110;

            const targetTop =
                targetSection.getBoundingClientRect().top +
                window.pageYOffset -
                headerOffset;


            window.scrollTo({
                top: Math.max(0, targetTop),
                behavior: 'smooth'
            });

        });

    });


    /* =========================================================
       DETECT CURRENT SECTION
    ========================================================= */

    function updateActiveSection() {

        if (!sections.length) {
            return;
        }


        /*
         * Detection line.
         *
         * When a section crosses this point,
         * its sidebar link becomes active.
         */

        const detectionPoint = 180;

        let currentSection = sections[0];


        sections.forEach(function (section) {

            const rect =
                section.getBoundingClientRect();


            if (rect.top <= detectionPoint) {
                currentSection = section;
            }

        });


        if (currentSection) {

            setActiveLink(
                currentSection.id
            );

        }

    }


    /* =========================================================
       SCROLL HANDLER
    ========================================================= */

    let scrollTicking = false;

    function handleScroll() {

        if (scrollTicking) {
            return;
        }

        window.requestAnimationFrame(function () {

            updateActiveSection();

            scrollTicking = false;

        });

        scrollTicking = true;

    }


    window.addEventListener(
        'scroll',
        handleScroll,
        {
            passive: true
        }
    );


    /* =========================================================
       RESIZE
    ========================================================= */

    window.addEventListener(
        'resize',
        updateActiveSection
    );


    /* =========================================================
       INITIAL STATE
    ========================================================= */

    updateActiveSection();


    /* =========================================================
       DELETE ACCOUNT CONFIRMATION
    ========================================================= */

    const deleteForm =
        document.querySelector('.danger-delete-form');


    if (deleteForm) {

        deleteForm.addEventListener(
            'submit',
            function (event) {

                const confirmed = window.confirm(
                    'Are you sure you want to permanently delete your account? This action cannot be undone.'
                );


                if (!confirmed) {
                    event.preventDefault();
                }

            }
        );

    }


    /* =========================================================
       PASSWORD MATCH CHECK
    ========================================================= */

    const password =
        document.getElementById('password');

    const passwordConfirmation =
        document.getElementById(
            'password_confirmation'
        );


    if (password && passwordConfirmation) {

        function checkPasswordMatch() {

            if (
                passwordConfirmation.value &&
                password.value !== passwordConfirmation.value
            ) {

                passwordConfirmation.setCustomValidity(
                    'Passwords do not match.'
                );

            } else {

                passwordConfirmation.setCustomValidity('');

            }

        }


        password.addEventListener(
            'input',
            checkPasswordMatch
        );

        passwordConfirmation.addEventListener(
            'input',
            checkPasswordMatch
        );

    }

});
</script>

@endpush