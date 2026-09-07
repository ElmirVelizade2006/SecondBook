@extends('Layout.Frontend.master')

@section('title', 'Edit Profile | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/edit-profile.css') }}?v={{ filemtime(public_path('frontend/edit-profile.css')) }}">
@endpush

@php
    $profileUser = auth()->user() ?? $user ?? null;
    $profileFirstName = old('first_name', $profileUser->first_name ?? trim(explode(' ', (string) ($profileUser->name ?? ''))[0] ?? ''));
    $profileLastName = old('last_name', $profileUser->last_name ?? trim(explode(' ', (string) ($profileUser->name ?? ''))[1] ?? ''));
    $profileUsername = old('username', $profileUser->username ?? '');
    $profileEmail = old('email', $profileUser->email ?? '');
    $profilePhone = old('phone', $profileUser->phone ?? '');
    $profileDob = old('date_of_birth', optional($profileUser->date_of_birth ?? null)->format('Y-m-d'));
    $profileGender = old('gender', $profileUser->gender ?? '');
    $profileCountry = old('country', $profileUser->country ?? '');
    $profileCity = old('city', $profileUser->city ?? '');
    $profileState = old('state', $profileUser->state ?? '');
    $profilePostalCode = old('postal_code', $profileUser->postal_code ?? '');
    $profileAddress = old('address', $profileUser->address ?? '');
    $profileBio = old('bio', $profileUser->bio ?? '');
    $hasPhoto = filled($profileUser->profile_photo ?? null);
    $profilePhotoUrl = $hasPhoto ? asset('storage/' . $profileUser->profile_photo) : null;
    $avatarText = '';
    $sourceName = trim(($profileUser->first_name ?? '') . ' ' . ($profileUser->last_name ?? '')) ?: ($profileUser->name ?? 'SB');
    $nameParts = array_filter(preg_split('/\s+/', trim($sourceName)) ?: []);
    foreach (array_slice($nameParts, 0, 2) as $part) {
        $avatarText .= mb_strtoupper(mb_substr($part, 0, 1));
    }
    if ($avatarText === '') {
        $avatarText = 'SB';
    }

    $emailNotifications = old('receive_email_notifications', $profileUser->receive_email_notifications ?? true);
    $orderUpdates = old('receive_order_updates', $profileUser->receive_order_updates ?? true);
    $promotionalEmails = old('receive_promotional_emails', $profileUser->receive_promotional_emails ?? false);
    $profileVisibility = old('profile_visibility', $profileUser->profile_visibility ?? true);
    $profileUpdatedAt = optional($profileUser->updated_at)->format('d M Y') ?? 'N/A';
    $isEmailVerified = filled($profileUser->email_verified_at ?? null);
@endphp

@section('content')
<main class="sb-edit-profile-page">
    <div class="container py-4 py-lg-5">
        <nav aria-label="breadcrumb" class="mb-3 mb-lg-4">
            <ol class="breadcrumb sb-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('my.profile') }}">My Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </ol>
        </nav>

        <section class="sb-profile-header mb-4 mb-lg-5">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <div class="sb-page-icon" aria-hidden="true"><i class="bi bi-person-gear"></i></div>
                <div>
                    <h1 class="sb-page-title mb-1">Edit Profile</h1>
                    <p class="sb-page-subtitle mb-0">Update your personal information and account details.</p>
                    <div class="d-flex align-items-center gap-2 mt-2 small text-secondary">
                        <i class="bi bi-clock-history"></i>
                        <span>Last updated: {{ $profileUpdatedAt }}</span>
                    </div>
                </div>
            </div>
        </section>

        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if ($errors->profileUpdate->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Please review the highlighted fields and try again.
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="sb-profile-form" id="profileUpdateForm">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-12">
                    <div class="card sb-card">
                        <div class="card-body p-4 p-xl-5">
                            <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
                                <div>
                                    <h2 class="h4 fw-semibold mb-1"><i class="bi bi-camera me-2"></i>Profile Photo</h2>
                                    <p class="text-secondary mb-0">Accepted formats: JPG, PNG, WEBP. Maximum size: 2MB.</p>
                                </div>
                            </div>

                            <div class="row g-4 align-items-center">
                                <div class="col-12 col-lg-4">
                                    <div class="sb-photo-wrap mx-auto mx-lg-0">
                                        <div class="sb-photo-circle" id="photoPreview">
                                            @if ($profilePhotoUrl)
                                                <img src="{{ $profilePhotoUrl }}" alt="Profile photo" class="sb-photo-img">
                                            @else
                                                <span>{{ $avatarText }}</span>
                                            @endif
                                        </div>
                                        <label for="profilePhoto" class="sb-photo-camera" role="button" aria-label="Upload profile photo">
                                            <i class="bi bi-camera-fill"></i>
                                        </label>
                                        <input type="file" name="profile_photo" id="profilePhoto" class="d-none" accept=".jpg,.jpeg,.png,.webp">
                                        @error('profile_photo', 'profileUpdate')
                                            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-lg-8">
                                    <div class="d-flex flex-wrap gap-2">
                                        <label for="profilePhoto" class="btn btn-primary sb-btn-primary">
                                            <i class="bi bi-upload me-2"></i>Upload New Photo
                                        </label>
                                        @if ($hasPhoto)
                                            <button type="submit" form="removePhotoForm" class="btn btn-outline-danger sb-btn-danger">
                                                <i class="bi bi-trash3 me-2"></i>Remove Photo
                                            </button>
                                        @endif
                                        <a href="{{ route('my.profile') }}" class="btn btn-outline-secondary sb-btn-secondary">
                                            <i class="bi bi-x-circle me-2"></i>Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card sb-card h-100">
                        <div class="card-body p-4 p-xl-5">
                            <h2 class="h4 fw-semibold mb-4"><i class="bi bi-person-vcard me-2"></i>Personal Information</h2>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="firstName">First Name <span class="text-danger">*</span></label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control @error('first_name', 'profileUpdate') is-invalid @enderror" id="firstName" name="first_name" value="{{ old('first_name', $profileFirstName) }}" placeholder="First name">
                                    </div>
                                    @error('first_name', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="lastName">Last Name <span class="text-danger">*</span></label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control @error('last_name', 'profileUpdate') is-invalid @enderror" id="lastName" name="last_name" value="{{ old('last_name', $profileLastName) }}" placeholder="Last name">
                                    </div>
                                    @error('last_name', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="username">Username</label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-at"></i></span>
                                        <input type="text" class="form-control @error('username', 'profileUpdate') is-invalid @enderror" id="username" name="username" value="{{ old('username', $profileUsername) }}" placeholder="username" readonly>
                                    </div>
                                    <div class="form-text">Username cannot be changed.</div>
                                    @error('username', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                    <div class="d-flex align-items-center justify-content-between gap-2 mb-2 flex-wrap">
                                        <span></span>
                                        @if ($isEmailVerified)
                                            <span class="badge rounded-pill text-bg-success"><i class="bi bi-check-circle-fill me-1"></i>Verified</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-warning text-dark"><i class="bi bi-exclamation-triangle-fill me-1"></i>Not Verified</span>
                                        @endif
                                    </div>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control @error('email', 'profileUpdate') is-invalid @enderror" id="email" name="email" value="{{ old('email', $profileEmail) }}" placeholder="name@example.com">
                                    </div>
                                    @error('email', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" class="form-control @error('phone', 'profileUpdate') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $profilePhone) }}" placeholder="+994 50 123 45 67">
                                    </div>
                                    @error('phone', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="dob">Date of Birth</label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                        <input type="date" class="form-control @error('date_of_birth', 'profileUpdate') is-invalid @enderror" id="dob" name="date_of_birth" value="{{ old('date_of_birth', $profileDob) }}" min="1900-01-01" max="{{ now()->format('Y-m-d') }}">
                                    </div>
                                    @error('date_of_birth', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="gender">Gender</label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                                        <select class="form-select @error('gender', 'profileUpdate') is-invalid @enderror" id="gender" name="gender">
                                            <option value="">Select gender</option>
                                            <option value="male" @selected(old('gender', $profileGender) === 'male')>Male</option>
                                            <option value="female" @selected(old('gender', $profileGender) === 'female')>Female</option>
                                            <option value="prefer_not_to_say" @selected(old('gender', $profileGender) === 'prefer_not_to_say')>Prefer not to say</option>
                                        </select>
                                    </div>
                                    @error('gender', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card sb-card h-100">
                        <div class="card-body p-4 p-xl-5">
                            <h2 class="h4 fw-semibold mb-4"><i class="bi bi-geo-alt me-2"></i>Address</h2>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="country">Country</label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-globe2"></i></span>
                                        <input type="text" class="form-control @error('country', 'profileUpdate') is-invalid @enderror" id="country" name="country" value="{{ old('country', $profileCountry) }}" placeholder="Country">
                                    </div>
                                    @error('country', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="city">City</label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                                        <input type="text" class="form-control @error('city', 'profileUpdate') is-invalid @enderror" id="city" name="city" value="{{ old('city', $profileCity) }}" placeholder="City">
                                    </div>
                                    @error('city', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="state">State / Region</label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-map"></i></span>
                                        <input type="text" class="form-control @error('state', 'profileUpdate') is-invalid @enderror" id="state" name="state" value="{{ old('state', $profileState) }}" placeholder="State or region">
                                    </div>
                                    @error('state', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="postalCode">Postal Code</label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-mailbox"></i></span>
                                        <input type="text" class="form-control @error('postal_code', 'profileUpdate') is-invalid @enderror" id="postalCode" name="postal_code" value="{{ old('postal_code', $profilePostalCode) }}" placeholder="Postal code">
                                    </div>
                                    @error('postal_code', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="streetAddress">Street Address</label>
                                    <div class="input-group sb-input-group">
                                        <span class="input-group-text"><i class="bi bi-house-door"></i></span>
                                        <input type="text" class="form-control @error('address', 'profileUpdate') is-invalid @enderror" id="streetAddress" name="address" value="{{ old('address', $profileAddress) }}" placeholder="Street address">
                                    </div>
                                    @error('address', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card sb-card h-100">
                        <div class="card-body p-4 p-xl-5">
                            <h2 class="h4 fw-semibold mb-4"><i class="bi bi-file-earmark-text me-2"></i>About Me</h2>

                            <div class="row g-4 align-items-start">
                                <div class="col-12 col-lg-6">
                                    <label class="form-label" for="bio">Bio</label>
                                    <div class="position-relative">
                                        <textarea class="form-control sb-textarea @error('bio', 'profileUpdate') is-invalid @enderror" id="bio" name="bio" rows="7" maxlength="300" placeholder="Write a short bio about yourself">{{ old('bio', $profileBio) }}</textarea>
                                        <div class="sb-counter text-secondary small mt-2 text-end" id="bioCounter">0 / 300</div>
                                    </div>
                                    <div class="form-text mt-2">This information may appear on your public profile.</div>
                                    @error('bio', 'profileUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="sb-preferences-panel h-100">
                                        <h3 class="h6 fw-semibold mb-3"><i class="bi bi-sliders me-2"></i>Account Preferences</h3>
                                        <div class="d-flex flex-column gap-3">
                                            <div class="form-check form-switch sb-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="emailNotifications" name="receive_email_notifications" value="1" @checked((bool) $emailNotifications)>
                                                <label class="form-check-label" for="emailNotifications">Receive email notifications</label>
                                            </div>
                                            <div class="form-check form-switch sb-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="orderUpdates" name="receive_order_updates" value="1" @checked((bool) $orderUpdates)>
                                                <label class="form-check-label" for="orderUpdates">Receive order updates</label>
                                            </div>
                                            <div class="form-check form-switch sb-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="promotionalEmails" name="receive_promotional_emails" value="1" @checked((bool) $promotionalEmails)>
                                                <label class="form-check-label" for="promotionalEmails">Receive promotional emails</label>
                                            </div>
                                            <div class="form-check form-switch sb-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="profileVisibility" name="profile_visibility" value="1" @checked((bool) $profileVisibility)>
                                                <label class="form-check-label" for="profileVisibility">Profile visibility</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card sb-card">
                        <div class="card-body p-4 p-xl-5">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                <div>
                                    <h2 class="h4 fw-semibold mb-1">Save Changes</h2>
                                    <p class="text-secondary mb-0">Review your profile details before updating your account.</p>
                                </div>
                                <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                                    <a href="{{ route('my.profile') }}" class="btn btn-outline-secondary sb-btn-secondary">
                                        <i class="bi bi-x-lg me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary sb-btn-primary" id="profileUpdateBtn">
                                        <i class="bi bi-check2-circle me-2"></i><span class="btn-text">Update Profile</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="{{ route('profile.photo.destroy') }}" method="POST" id="removePhotoForm" class="d-none">
            @csrf
            @method('DELETE')
        </form>

        <section class="mt-4 mt-lg-5">
            <div class="card sb-card h-100">
                <div class="card-body p-4 p-xl-5">
                    <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
                        <div>
                            <h2 class="h4 fw-semibold mb-1"><i class="bi bi-shield-lock me-2"></i>Account Security</h2>
                            <p class="text-secondary mb-0">Keep your account protected with a strong password.</p>
                        </div>
                    </div>

                    @if ($errors->passwordUpdate->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Please review your password details and try again.
                        </div>
                    @endif

                    <form action="{{ route('profile.password.update') }}" method="POST" id="passwordUpdateForm">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="currentPassword">Current Password</label>
                                <div class="input-group sb-input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control @error('current_password', 'passwordUpdate') is-invalid @enderror" id="currentPassword" name="current_password" placeholder="Current password" autocomplete="current-password">
                                </div>
                                @error('current_password', 'passwordUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="newPassword">New Password</label>
                                <div class="input-group sb-input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                                    <input type="password" class="form-control @error('password', 'passwordUpdate') is-invalid @enderror" id="newPassword" name="password" placeholder="New password" autocomplete="new-password">
                                </div>
                                @error('password', 'passwordUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                <div class="input-group sb-input-group">
                                    <span class="input-group-text"><i class="bi bi-check2-circle"></i></span>
                                    <input type="password" class="form-control @error('password_confirmation', 'passwordUpdate') is-invalid @enderror" id="confirmPassword" name="password_confirmation" placeholder="Confirm new password" autocomplete="new-password">
                                </div>
                                @error('password_confirmation', 'passwordUpdate')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary sb-btn-primary">
                                <i class="bi bi-key-fill me-2"></i>Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="mt-4 mt-lg-5 mb-2">
            <div class="card sb-card sb-danger-zone-card">
                <div class="card-body p-4 p-xl-5">
                    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-4">
                        <div>
                            <h2 class="h4 fw-semibold mb-2"><i class="bi bi-exclamation-octagon-fill me-2"></i>Danger Zone</h2>
                            <p class="mb-0 text-secondary">Once you permanently delete your account, all your books, wishlist and account information will be removed forever.</p>
                        </div>
                        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account permanently?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger sb-danger-zone-btn">
                                <i class="bi bi-trash3-fill me-2"></i>Delete Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@push('js')
<script>
    (function () {
        var bio = document.getElementById('bio');
        var counter = document.getElementById('bioCounter');
        var fileInput = document.getElementById('profilePhoto');
        var preview = document.getElementById('photoPreview');
        var profileForm = document.getElementById('profileUpdateForm');
        var profileButton = document.getElementById('profileUpdateBtn');

        function updateCounter() {
            if (!bio || !counter) return;
            counter.textContent = (bio.value || '').length + ' / 300';
        }

        updateCounter();

        if (bio) {
            bio.addEventListener('input', updateCounter);
        }

        if (fileInput && preview) {
            fileInput.addEventListener('change', function () {
                var file = this.files && this.files[0];
                if (!file) return;

                var reader = new FileReader();
                reader.onload = function (event) {
                    preview.innerHTML = '<img src="' + event.target.result + '" alt="Profile photo" class="sb-photo-img">';
                };
                reader.readAsDataURL(file);
            });
        }

        if (profileForm && profileButton) {
            profileForm.addEventListener('submit', function (event) {
                if (event.submitter && event.submitter !== profileButton) {
                    return;
                }

                profileButton.disabled = true;
                profileButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span><span class="btn-text">Updating...</span>';
            });
        }
    })();
</script>
@endpush