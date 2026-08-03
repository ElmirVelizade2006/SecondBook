@extends('Layout.Frontend.master')

@section('title', 'My Profile | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/profile.css') }}">
@endpush

@php
    $profileUser = auth()->user() ?? $user ?? null;
    $profileName = $profileUser->name ?? 'SecondBook User';
    $profileEmail = $profileUser->email ?? 'Not provided';
    $profileRole = strtoupper($profileUser->role ?? 'User');
    $profilePhone = $profileUser->phone ?? 'Not provided';
    $profileAddress = $profileUser->address ?? 'Not provided';
    $memberSince = optional($profileUser->created_at)->format('F Y') ?? 'N/A';
    $joinedDate = optional($profileUser->created_at)->format('F j, Y') ?? 'N/A';
    $lastPasswordUpdate = optional($profileUser->updated_at)->format('F j, Y') ?? 'Never updated';

    $avatarInitials = '';
    $nameParts = array_filter(preg_split('/\s+/', trim($profileName)) ?: []);
    foreach (array_slice($nameParts, 0, 2) as $part) {
        $avatarInitials .= mb_strtoupper(mb_substr($part, 0, 1));
    }
    if ($avatarInitials === '') {
        $avatarInitials = 'SB';
    }

    $recentActivities = [
        [
            'icon' => 'cart-check',
            'title' => 'Ordered Atomic Habits',
            'description' => 'Your order was confirmed and is preparing for shipment.',
            'date' => 'Today',
        ],
        [
            'icon' => 'heart',
            'title' => 'Added Rich Dad Poor Dad to Wishlist',
            'description' => 'You saved this title for future purchase.',
            'date' => 'Yesterday',
        ],
        [
            'icon' => 'book-half',
            'title' => 'Listed Clean Code for Sale',
            'description' => 'Your book listing is now visible to buyers.',
            'date' => '2 days ago',
        ],
        [
            'icon' => 'star',
            'title' => 'Left a Review',
            'description' => 'You shared your feedback on a recent book purchase.',
            'date' => '1 week ago',
        ],
    ];

    $orderCount = $orderCount ?? 0;
    $wishlistCount = $wishlistCount ?? 0;
    $booksSoldCount = $booksSoldCount ?? 0;
    $reviewsCount = $reviewsCount ?? 0;
@endphp

@section('content')
<main class="sb-profile-page">
    <div class="container py-4 py-lg-5">
        <section class="sb-profile-hero mb-4 mb-lg-5">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <div class="sb-hero-icon" aria-hidden="true">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div>
                    <h1 class="sb-page-title mb-1">My Profile</h1>
                    <p class="sb-page-subtitle mb-0">Manage your personal information and account settings.</p>
                </div>
            </div>
        </section>

        <section class="row g-4 mb-4 mb-lg-5 align-items-stretch">
            <div class="col-12 col-lg-4">
                <div class="card sb-card sb-profile-summary-card h-100">
                    <div class="card-body p-4 p-xl-5 d-flex flex-column align-items-center text-center">
                        <div class="sb-avatar mb-4" aria-hidden="true">
                            <span>{{ $avatarInitials }}</span>
                        </div>

                        <h2 class="h4 fw-semibold mb-2">{{ $profileName }}</h2>

                        <span class="badge rounded-pill sb-role-badge mb-3">
                            <i class="bi bi-shield-check me-1"></i>
                            {{ $profileRole }}
                        </span>

                        <p class="text-secondary mb-4">Member since {{ $memberSince }}</p>

                        <a href="{{ route('profile.edit') }}" class="btn btn-primary sb-primary-btn w-100">
                            <i class="bi bi-pencil-square me-2"></i>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="card sb-card h-100">
                    <div class="card-body p-4 p-xl-5">
                        <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
                            <div>
                                <h2 class="h4 fw-semibold mb-1">Personal Information</h2>
                                <p class="text-secondary mb-0">Your account details at a glance.</p>
                            </div>
                            <span class="sb-section-chip">
                                <i class="bi bi-person-vcard me-1"></i>
                                Profile Details
                            </span>
                        </div>

                        <div class="row g-3 g-xl-4">
                            <div class="col-12 col-md-6">
                                <div class="sb-info-item">
                                    <div class="sb-info-icon"><i class="bi bi-person-fill"></i></div>
                                    <div>
                                        <span class="sb-info-label">Full Name</span>
                                        <div class="sb-info-value">{{ $profileName }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="sb-info-item">
                                    <div class="sb-info-icon"><i class="bi bi-envelope-fill"></i></div>
                                    <div>
                                        <span class="sb-info-label">Email Address</span>
                                        <div class="sb-info-value">{{ $profileEmail }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="sb-info-item">
                                    <div class="sb-info-icon"><i class="bi bi-telephone-fill"></i></div>
                                    <div>
                                        <span class="sb-info-label">Phone Number</span>
                                        <div class="sb-info-value">{{ $profilePhone }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="sb-info-item">
                                    <div class="sb-info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                    <div>
                                        <span class="sb-info-label">Address</span>
                                        <div class="sb-info-value">{{ $profileAddress }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="sb-info-item">
                                    <div class="sb-info-icon"><i class="bi bi-calendar-event-fill"></i></div>
                                    <div>
                                        <span class="sb-info-label">Member Since</span>
                                        <div class="sb-info-value">{{ $memberSince }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="sb-info-item">
                                    <div class="sb-info-icon"><i class="bi bi-calendar-check-fill"></i></div>
                                    <div>
                                        <span class="sb-info-label">Joined Date</span>
                                        <div class="sb-info-value">{{ $joinedDate }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-4 mb-lg-5">
            <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-3 mb-lg-4">
                <div>
                    <h2 class="h4 fw-semibold mb-1">Quick Actions</h2>
                    <p class="text-secondary mb-0">Shortcuts to your most common account areas.</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6 col-xl-3">
                    <a href="#" class="card sb-card sb-action-card h-100 text-decoration-none">
                        <div class="card-body p-4">
                            <div class="sb-action-icon mb-3"><i class="bi bi-bag-check-fill"></i></div>
                            <h3 class="h5 fw-semibold mb-2">My Orders</h3>
                            <p class="text-secondary mb-0">Review purchases, track delivery, and check order history.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <a href="#" class="card sb-card sb-action-card h-100 text-decoration-none">
                        <div class="card-body p-4">
                            <div class="sb-action-icon mb-3"><i class="bi bi-heart-fill"></i></div>
                            <h3 class="h5 fw-semibold mb-2">Wishlist</h3>
                            <p class="text-secondary mb-0">Save books you want to revisit later or compare prices.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <a href="#" class="card sb-card sb-action-card h-100 text-decoration-none">
                        <div class="card-body p-4">
                            <div class="sb-action-icon mb-3"><i class="bi bi-book-fill"></i></div>
                            <h3 class="h5 fw-semibold mb-2">My Books</h3>
                            <p class="text-secondary mb-0">Manage the books you have listed or sold on SecondBook.</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <a href="#" class="card sb-card sb-action-card h-100 text-decoration-none">
                        <div class="card-body p-4">
                            <div class="sb-action-icon mb-3"><i class="bi bi-plus-circle-fill"></i></div>
                            <h3 class="h5 fw-semibold mb-2">Sell a Book</h3>
                            <p class="text-secondary mb-0">Create a new listing and start earning from your books.</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section class="mb-4 mb-lg-5">
            <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-3 mb-lg-4">
                <div>
                    <h2 class="h4 fw-semibold mb-1">Account Statistics</h2>
                    <p class="text-secondary mb-0">A quick dashboard snapshot of your activity.</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card sb-card sb-stat-card h-100">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <div class="sb-stat-value">{{ $orderCount }}</div>
                                <div class="sb-stat-label">Orders</div>
                            </div>
                            <div class="sb-stat-icon"><i class="bi bi-bag-check"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card sb-card sb-stat-card h-100">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <div class="sb-stat-value">{{ $wishlistCount }}</div>
                                <div class="sb-stat-label">Wishlist</div>
                            </div>
                            <div class="sb-stat-icon"><i class="bi bi-heart"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card sb-card sb-stat-card h-100">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <div class="sb-stat-value">{{ $booksSoldCount }}</div>
                                <div class="sb-stat-label">Books Sold</div>
                            </div>
                            <div class="sb-stat-icon"><i class="bi bi-book"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card sb-card sb-stat-card h-100">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <div class="sb-stat-value">{{ $reviewsCount }}</div>
                                <div class="sb-stat-label">Reviews</div>
                            </div>
                            <div class="sb-stat-icon"><i class="bi bi-star"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="row g-4 mb-4 mb-lg-5">
            <div class="col-12 col-lg-6">
                <div class="card sb-card h-100">
                    <div class="card-body p-4 p-xl-5">
                        <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
                            <div>
                                <h2 class="h4 fw-semibold mb-1">Account Security</h2>
                                <p class="text-secondary mb-0">Keep your account protected with an updated password.</p>
                            </div>
                            <span class="sb-section-chip">
                                <i class="bi bi-shield-lock me-1"></i>
                                Secure Access
                            </span>
                        </div>

                        <div class="sb-security-panel mb-4">
                            <div class="sb-info-item mb-3 mb-sm-4">
                                <div class="sb-info-icon"><i class="bi bi-lock-fill"></i></div>
                                <div>
                                    <span class="sb-info-label">Password</span>
                                    <div class="sb-info-value">********</div>
                                </div>
                            </div>

                            <div class="sb-security-meta">
                                <div class="text-secondary small mb-1">Last password update</div>
                                <div class="fw-semibold">{{ $lastPasswordUpdate }}</div>
                            </div>
                        </div>

                        <a href="#" class="btn btn-primary sb-primary-btn">
                            <i class="bi bi-key-fill me-2"></i>
                            Change Password
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card sb-card h-100">
                    <div class="card-body p-4 p-xl-5">
                        <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
                            <div>
                                <h2 class="h4 fw-semibold mb-1">Recent Activity</h2>
                                <p class="text-secondary mb-0">A quick view of what you have done recently.</p>
                            </div>
                        </div>

                        <div class="sb-timeline">
                            @foreach ($recentActivities as $activity)
                                <div class="sb-timeline-item">
                                    <div class="sb-timeline-icon">
                                        <i class="bi bi-{{ $activity['icon'] }}"></i>
                                    </div>
                                    <div class="sb-timeline-content">
                                        <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                                            <h3 class="h6 fw-semibold mb-1">{{ $activity['title'] }}</h3>
                                            <span class="sb-timeline-date">{{ $activity['date'] }}</span>
                                        </div>
                                        <p class="text-secondary mb-0">{{ $activity['description'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-2">
            <div class="card sb-card sb-support-card">
                <div class="card-body p-4 p-xl-5 d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-4">
                    <div>
                        <h2 class="h4 fw-semibold mb-2">Need Help?</h2>
                        <p class="text-secondary mb-0">Contact our support team if you need any assistance with your account.</p>
                    </div>
                    <a href="mailto:support@secondbook.com" class="btn btn-primary sb-primary-btn">
                        <i class="bi bi-headset me-2"></i>
                        Contact Support
                    </a>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection