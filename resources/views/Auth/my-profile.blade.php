@extends('Layout.Frontend.master')

@section('title', 'My Profile | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/profile.css') }}">
@endpush

@php
    $profileUser = auth()->user();

    $profileName = $profileUser->name ?? 'SecondBook User';
    $profileEmail = $profileUser->email ?? 'Not provided';
    $profilePhone = $profileUser->phone ?? 'Not provided';
    $profileAddress = $profileUser->address ?? 'Not provided';

    $profileRole = ucfirst($profileUser->role ?? 'User');

    $memberSince = optional($profileUser->created_at)->format('F Y') ?? 'N/A';
    $joinedDate = optional($profileUser->created_at)->format('F j, Y') ?? 'N/A';
    $lastAccountUpdate = optional($profileUser->updated_at)->format('F j, Y') ?? 'N/A';

    /*
    |--------------------------------------------------------------------------
    | Avatar Initials
    |--------------------------------------------------------------------------
    */
    $avatarInitials = '';

    $nameParts = array_filter(
        preg_split('/\s+/', trim($profileName)) ?: []
    );

    foreach (array_slice($nameParts, 0, 2) as $part) {
        $avatarInitials .= mb_strtoupper(
            mb_substr($part, 0, 1)
        );
    }

    if ($avatarInitials === '') {
        $avatarInitials = 'SB';
    }

    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */
    $orderCount = $orderCount ?? 0;
    $wishlistCount = $wishlistCount ?? 0;
    $booksSoldCount = $booksSoldCount ?? 0;
    $reviewsCount = $reviewsCount ?? 0;
@endphp


@section('content')

<main class="sb-profile-page">

    <div class="container">

        {{-- =========================================================
             HERO
        ========================================================== --}}
        <section class="sb-profile-hero">

            <div class="sb-profile-hero-main">

                <div class="sb-profile-avatar-wrap">

                    <div class="sb-profile-avatar">
                        {{ $avatarInitials }}
                    </div>

                    <div class="sb-profile-online">
                        <span></span>
                        Active
                    </div>

                </div>


                <div class="sb-profile-identity">

                    <div class="sb-profile-eyebrow">
                        <i class="bi bi-person-badge"></i>
                        MY ACCOUNT
                    </div>

                    <h1>
                        {{ $profileName }}
                    </h1>

                    <p>
                        Manage your personal information, account details
                        and SecondBook preferences from one place.
                    </p>

                    <div class="sb-profile-meta">

                        <span>
                            <i class="bi bi-envelope"></i>
                            {{ $profileEmail }}
                        </span>

                        <span>
                            <i class="bi bi-calendar3"></i>
                            Member since {{ $memberSince }}
                        </span>

                        <span class="sb-profile-role">
                            <i class="bi bi-shield-check"></i>
                            {{ $profileRole }}
                        </span>

                    </div>

                </div>

            </div>


            <div class="sb-profile-hero-actions">

                <a
                    href="{{ route('profile.edit') }}"
                    class="sb-profile-primary-btn"
                >
                    <i class="bi bi-pencil-square"></i>
                    Edit Profile
                </a>

                <a
                    href="{{ route('frontend.account.settings') }}"
                    class="sb-profile-secondary-btn"
                >
                    <i class="bi bi-gear"></i>
                    Account Settings
                </a>

            </div>

        </section>


        {{-- =========================================================
             STATISTICS
        ========================================================== --}}
        <section class="sb-profile-stats">

            {{-- ORDERS --}}
            <div class="sb-profile-stat">

                <div class="sb-profile-stat-icon">
                    <i class="bi bi-bag-check"></i>
                </div>

                <div class="sb-profile-stat-content">

                    <span>
                        ORDERS
                    </span>

                    <strong>
                        {{ $orderCount }}
                    </strong>

                </div>

            </div>


            {{-- WISHLIST --}}
            <div class="sb-profile-stat">

                <div class="sb-profile-stat-icon">
                    <i class="bi bi-heart"></i>
                </div>

                <div class="sb-profile-stat-content">

                    <span>
                        WISHLIST
                    </span>

                    <strong>
                        {{ $wishlistCount }}
                    </strong>

                </div>

            </div>


            {{-- BOOKS SOLD --}}
            <div class="sb-profile-stat">

                <div class="sb-profile-stat-icon">
                    <i class="bi bi-book"></i>
                </div>

                <div class="sb-profile-stat-content">

                    <span>
                        BOOKS SOLD
                    </span>

                    <strong>
                        {{ $booksSoldCount }}
                    </strong>

                </div>

            </div>


            {{-- REVIEWS --}}
            <div class="sb-profile-stat">

                <div class="sb-profile-stat-icon">
                    <i class="bi bi-star"></i>
                </div>

                <div class="sb-profile-stat-content">

                    <span>
                        REVIEWS
                    </span>

                    <strong>
                        {{ $reviewsCount }}
                    </strong>

                </div>

            </div>

        </section>


        {{-- =========================================================
             MAIN PROFILE GRID
        ========================================================== --}}
        <section class="sb-profile-grid">


            {{-- =====================================================
                 PERSONAL INFORMATION
            ====================================================== --}}
            <div class="sb-profile-card">

                <div class="sb-profile-card-header">

                    <div>

                        <span class="sb-card-overline">
                            PROFILE DETAILS
                        </span>

                        <h2>
                            Personal Information
                        </h2>

                        <p>
                            Your personal information and contact details.
                        </p>

                    </div>

                    <div class="sb-profile-card-icon">
                        <i class="bi bi-person-vcard"></i>
                    </div>

                </div>


                <div class="sb-profile-info-grid">

                    {{-- FULL NAME --}}
                    <div class="sb-profile-info">

                        <span class="sb-profile-info-label">
                            Full Name
                        </span>

                        <div class="sb-profile-info-value">

                            <i class="bi bi-person"></i>

                            <span title="{{ $profileName }}">
                                {{ $profileName }}
                            </span>

                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div class="sb-profile-info">

                        <span class="sb-profile-info-label">
                            Email Address
                        </span>

                        <div class="sb-profile-info-value">

                            <i class="bi bi-envelope"></i>

                            <span title="{{ $profileEmail }}">
                                {{ $profileEmail }}
                            </span>

                        </div>

                    </div>


                    {{-- PHONE --}}
                    <div class="sb-profile-info">

                        <span class="sb-profile-info-label">
                            Phone Number
                        </span>

                        <div class="sb-profile-info-value">

                            <i class="bi bi-telephone"></i>

                            <span title="{{ $profilePhone }}">
                                {{ $profilePhone }}
                            </span>

                        </div>

                    </div>


                    {{-- ADDRESS --}}
                    <div class="sb-profile-info">

                        <span class="sb-profile-info-label">
                            Address
                        </span>

                        <div class="sb-profile-info-value">

                            <i class="bi bi-geo-alt"></i>

                            <span title="{{ $profileAddress }}">
                                {{ $profileAddress }}
                            </span>

                        </div>

                    </div>


                    {{-- MEMBER SINCE --}}
                    <div class="sb-profile-info">

                        <span class="sb-profile-info-label">
                            Member Since
                        </span>

                        <div class="sb-profile-info-value">

                            <i class="bi bi-calendar-event"></i>

                            <span>
                                {{ $memberSince }}
                            </span>

                        </div>

                    </div>


                    {{-- LAST ACCOUNT UPDATE --}}
                    <div class="sb-profile-info">

                        <span class="sb-profile-info-label">
                            Last Account Update
                        </span>

                        <div class="sb-profile-info-value">

                            <i class="bi bi-clock-history"></i>

                            <span>
                                {{ $lastAccountUpdate }}
                            </span>

                        </div>

                    </div>

                </div>


                <div class="sb-profile-card-footer">

                    <span>
                        Keep your information up to date.
                    </span>

                    <a
                        href="{{ route('profile.edit') }}"
                        class="sb-profile-text-btn"
                    >
                        Edit information
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>


            {{-- =====================================================
                 ACCOUNT OVERVIEW
            ====================================================== --}}
            <div class="sb-profile-card sb-status-card">

                <div class="sb-profile-card-header">

                    <div>

                        <span class="sb-card-overline">
                            ACCOUNT
                        </span>

                        <h2>
                            Account Overview
                        </h2>

                        <p>
                            Your current account status.
                        </p>

                    </div>

                    <div class="sb-profile-card-icon">
                        <i class="bi bi-person-check"></i>
                    </div>

                </div>


                {{-- STATUS --}}
                <div class="sb-account-status">

                    <div class="sb-status-visual">

                        <div class="sb-status-check">
                            <i class="bi bi-check-lg"></i>
                        </div>

                    </div>

                    <div class="sb-status-content">

                        <span class="sb-status-label">
                            ACCOUNT STATUS
                        </span>

                        <h3>
                            Active
                        </h3>

                        <p>
                            Your account is active and ready to use.
                        </p>

                    </div>

                </div>


                {{-- ACCOUNT DETAILS --}}
                <div class="sb-account-details">

                    <div>

                        <span>
                            Account Type
                        </span>

                        <strong>
                            {{ $profileRole }}
                        </strong>

                    </div>

                    <div>

                        <span>
                            Member Since
                        </span>

                        <strong>
                            {{ $memberSince }}
                        </strong>

                    </div>

                </div>


                <a
                    href="{{ route('frontend.account.settings') }}"
                    class="sb-profile-outline-btn"
                >
                    <i class="bi bi-sliders"></i>
                    Manage Account
                </a>

            </div>

        </section>


        {{-- =========================================================
             QUICK ACTIONS
        ========================================================== --}}
        <section class="sb-profile-section">

            <div class="sb-profile-section-heading">

                <h2>
                    Quick Actions
                </h2>

                <p>
                    Shortcuts to the most important areas of your account.
                </p>

            </div>


            <div class="sb-profile-actions-grid">


                {{-- EDIT PROFILE --}}
                <a
                    href="{{ route('profile.edit') }}"
                    class="sb-profile-action"
                >

                    <div class="sb-profile-action-icon">
                        <i class="bi bi-person-gear"></i>
                    </div>

                    <h3>
                        Edit Profile
                    </h3>

                    <p>
                        Update your name, phone number, address and other
                        personal information.
                    </p>

                    <span class="sb-action-arrow">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>

                </a>


                {{-- ACCOUNT SETTINGS --}}
                <a
                    href="{{ route('frontend.account.settings') }}"
                    class="sb-profile-action"
                >

                    <div class="sb-profile-action-icon">
                        <i class="bi bi-sliders"></i>
                    </div>

                    <h3>
                        Account Settings
                    </h3>

                    <p>
                        Manage notifications, privacy and your account
                        preferences.
                    </p>

                    <span class="sb-action-arrow">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>

                </a>


                {{-- SECURITY --}}
                <a
                    href="{{ route('frontend.account.settings') }}#security"
                    class="sb-profile-action"
                >

                    <div class="sb-profile-action-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                    <h3>
                        Security
                    </h3>

                    <p>
                        Change your password and keep your account
                        protected.
                    </p>

                    <span class="sb-action-arrow">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>

                </a>


                {{-- SUPPORT --}}
                <a
                    href="mailto:support@secondbook.com"
                    class="sb-profile-action"
                >

                    <div class="sb-profile-action-icon">
                        <i class="bi bi-headset"></i>
                    </div>

                    <h3>
                        Support
                    </h3>

                    <p>
                        Contact the SecondBook support team if you need
                        assistance.
                    </p>

                    <span class="sb-action-arrow">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>

                </a>

            </div>

        </section>

    </div>

</main>

@endsection