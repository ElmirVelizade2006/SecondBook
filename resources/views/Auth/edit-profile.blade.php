@extends('Layout.Frontend.master')

@section('title', 'Edit Profile | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/edit-profile.css') }}">
@endpush

@php
    $user = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | Full Name
    |--------------------------------------------------------------------------
    */

    $fullName = trim(
        ($user->first_name ?? '') . ' ' . ($user->last_name ?? '')
    );

    $fullName = $fullName ?: ($user->name ?? 'User');

    /*
    |--------------------------------------------------------------------------
    | Initials
    |--------------------------------------------------------------------------
    */

    $initials = collect(explode(' ', $fullName))
        ->filter()
        ->take(2)
        ->map(fn ($word) => strtoupper(substr($word, 0, 1)))
        ->implode('');

    $initials = $initials ?: 'U';

    /*
    |--------------------------------------------------------------------------
    | Phone
    |--------------------------------------------------------------------------
    */

    $phone = $user->phone ?? '';

    $phoneCountryCode = '+994';
    $phoneNumber = $phone;

    $countryCodes = [
        '+994' => '🇦🇿 +994',
        '+90'  => '🇹🇷 +90',
        '+7'   => '🇷🇺 +7',
        '+380' => '🇺🇦 +380',
        '+49'  => '🇩🇪 +49',
        '+33'  => '🇫🇷 +33',
        '+44'  => '🇬🇧 +44',
        '+39'  => '🇮🇹 +39',
        '+34'  => '🇪🇸 +34',
        '+1'   => '🇺🇸 +1',
    ];

    foreach ($countryCodes as $code => $label) {
        if (str_starts_with($phone, $code)) {
            $phoneCountryCode = $code;
            $phoneNumber = substr($phone, strlen($code));
            break;
        }
    }
@endphp

@section('content')

<main class="sb-profile-page">

    <div class="container">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="sb-profile-header">

            <div class="sb-profile-header-left">

                <a href="{{ route('my.profile') }}" class="sb-profile-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to profile</span>
                </a>

                <div class="sb-profile-heading">

                    <div class="sb-profile-kicker">
                        <span></span>
                        ACCOUNT SETTINGS
                    </div>

                    <h1>
                        Edit your
                        <em>profile.</em>
                    </h1>

                    <p>
                        Keep your personal information accurate and up to date.
                    </p>

                </div>

            </div>

            <div class="sb-profile-header-mark">
                <i class="bi bi-person-gear"></i>
            </div>

        </div>


        {{-- =====================================================
             SUCCESS ALERT
        ====================================================== --}}

        @if(session('success'))

            <div class="sb-profile-alert sb-profile-alert-success">

                <div class="sb-profile-alert-icon">
                    <i class="bi bi-check2"></i>
                </div>

                <div>

                    <strong>Profile updated</strong>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

                <button
                    type="button"
                    class="sb-profile-alert-close"
                    onclick="this.parentElement.remove()"
                    aria-label="Close"
                >
                    <i class="bi bi-x"></i>
                </button>

            </div>

        @endif


        {{-- =====================================================
             ERROR ALERT
        ====================================================== --}}

        @if($errors->any())

            <div class="sb-profile-alert sb-profile-alert-error">

                <div class="sb-profile-alert-icon">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>

                <div>

                    <strong>
                        Please check your information
                    </strong>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

                <button
                    type="button"
                    class="sb-profile-alert-close"
                    onclick="this.parentElement.remove()"
                    aria-label="Close"
                >
                    <i class="bi bi-x"></i>
                </button>

            </div>

        @endif


        {{-- =====================================================
             MAIN LAYOUT
        ====================================================== --}}

        <div class="sb-profile-layout">


            {{-- =================================================
                 MAIN
            ================================================== --}}

            <section class="sb-profile-main">

                <form
                    action="{{ route('profile.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="profileEditForm"
                >

                    @csrf
                    @method('PUT')


                    {{-- =============================================
                         PERSONAL INFORMATION
                    ============================================== --}}

                    <div class="sb-profile-card">

                        <div class="sb-profile-card-header">

                            <div>

                                <span class="sb-profile-card-label">
                                    PERSONAL
                                </span>

                                <h2>
                                    Personal information
                                </h2>

                                <p>
                                    Update the information associated with your account.
                                </p>

                            </div>

                            <div class="sb-profile-card-icon">
                                <i class="bi bi-person"></i>
                            </div>

                        </div>


                        <div class="sb-profile-card-body">


                            {{-- =====================================
                                 PROFILE PHOTO
                            ====================================== --}}

                            <div class="sb-profile-photo-section">

                                <div class="sb-profile-photo-title">

                                    <div>

                                        <label>
                                            Profile photo
                                        </label>

                                        <span>
                                            Your profile picture helps others recognize you.
                                        </span>

                                    </div>

                                    <span class="sb-profile-photo-format">
                                        2 MB MAX
                                    </span>

                                </div>


                                <div class="sb-profile-photo-row">


                                    {{-- PHOTO --}}

                                    <div class="sb-profile-photo">

                                        @if($user->profile_photo)

                                            <img
                                                src="{{ asset('storage/' . $user->profile_photo) }}"
                                                alt="{{ $fullName }}"
                                                id="profilePhotoPreview"
                                            >

                                        @else

                                            <span id="profilePhotoInitials">
                                                {{ $initials }}
                                            </span>

                                        @endif


                                        <div class="sb-profile-photo-camera">
                                            <i class="bi bi-camera-fill"></i>
                                        </div>

                                    </div>


                                    {{-- PHOTO INFO --}}

                                    <div class="sb-profile-photo-info">

                                        <strong>
                                            {{ $fullName }}
                                        </strong>

                                        <span>
                                            JPG, JPEG, PNG or WEBP
                                        </span>


                                        <div class="sb-profile-photo-actions">


                                            {{-- CHANGE PHOTO --}}

                                            <label
                                                for="profile_photo"
                                                class="sb-profile-photo-change"
                                            >
                                                <i class="bi bi-upload"></i>
                                                Change photo
                                            </label>


                                            {{-- REMOVE PHOTO --}}

                                            @if($user->profile_photo)

                                                <button
                                                    type="button"
                                                    class="sb-profile-photo-delete"
                                                    id="removeProfilePhotoBtn"
                                                >
                                                    Remove
                                                </button>

                                            @endif

                                        </div>

                                    </div>

                                </div>


                                {{-- FILE INPUT --}}

                                <input
                                    type="file"
                                    name="profile_photo"
                                    id="profile_photo"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                    hidden
                                >


                                @error('profile_photo')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- DIVIDER --}}

                            <div class="sb-profile-divider"></div>


                            {{-- =====================================
                                 FULL NAME
                            ====================================== --}}

                            <div class="sb-profile-field">

                                <label for="full_name">

                                    Full name

                                    <span>*</span>

                                </label>


                                <div class="sb-profile-input">

                                    <i class="bi bi-person"></i>

                                    <input
                                        type="text"
                                        id="full_name"
                                        value="{{ old('full_name', $fullName) }}"
                                        placeholder="Your full name"
                                        autocomplete="name"
                                    >

                                </div>


                                {{-- Hidden first name --}}

                                <input
                                    type="hidden"
                                    name="first_name"
                                    id="first_name"
                                    value="{{ old('first_name', $user->first_name ?? '') }}"
                                >


                                {{-- Hidden last name --}}

                                <input
                                    type="hidden"
                                    name="last_name"
                                    id="last_name"
                                    value="{{ old('last_name', $user->last_name ?? '') }}"
                                >


                                @error('first_name')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror


                                @error('last_name')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- =====================================
                                 EMAIL
                            ====================================== --}}

                            <div class="sb-profile-field">

                                <label for="email">

                                    Email address

                                    <span>*</span>

                                </label>


                                <div class="sb-profile-input">

                                    <i class="bi bi-envelope"></i>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email', $user->email) }}"
                                        placeholder="you@example.com"
                                        autocomplete="email"
                                    >

                                </div>


                                @error('email')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- =====================================
                                 PHONE
                            ====================================== --}}

                            <div class="sb-profile-field">

                                <label for="phone">
                                    Phone number
                                </label>


                                <div class="sb-profile-phone">


                                    {{-- COUNTRY CODE --}}

                                    <div class="sb-profile-country">

                                        <select
                                            name="phone_country_code"
                                            id="phone_country_code"
                                            aria-label="Country code"
                                        >

                                            @foreach($countryCodes as $code => $label)

                                                <option
                                                    value="{{ $code }}"
                                                    @selected($phoneCountryCode === $code)
                                                >
                                                    {{ $label }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>


                                    {{-- PHONE NUMBER --}}

                                    <div class="sb-profile-input">

                                        <i class="bi bi-telephone"></i>

                                        <input
                                            type="tel"
                                            name="phone"
                                            id="phone"
                                            value="{{ old('phone', $phoneNumber) }}"
                                            placeholder="501234567"
                                            inputmode="numeric"
                                            autocomplete="tel-national"
                                            maxlength="15"
                                        >

                                    </div>

                                </div>


                                @error('phone')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- =====================================
                                 DATE OF BIRTH
                            ====================================== --}}

                            <div class="sb-profile-field">

                                <label for="date_of_birth">
                                    Date of birth
                                </label>


                                <div class="sb-profile-input">

                                    <i class="bi bi-calendar3"></i>

                                    <input
                                        type="date"
                                        name="date_of_birth"
                                        id="date_of_birth"
                                        value="{{ old('date_of_birth', $user->date_of_birth ? \Illuminate\Support\Carbon::parse($user->date_of_birth)->format('Y-m-d') : '') }}"
                                        autocomplete="bday"
                                    >

                                </div>


                                @error('date_of_birth')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- =====================================
                                 GENDER
                            ====================================== --}}

                            <div class="sb-profile-field">

                                <label for="gender">
                                    Gender
                                </label>


                                <div class="sb-profile-input sb-profile-select">

                                    <i class="bi bi-person-vcard"></i>

                                    <select
                                        name="gender"
                                        id="gender"
                                    >

                                        <option value="">
                                            Select gender
                                        </option>

                                        <option
                                            value="male"
                                            @selected(old('gender', $user->gender) === 'male')
                                        >
                                            Male
                                        </option>

                                        <option
                                            value="female"
                                            @selected(old('gender', $user->gender) === 'female')
                                        >
                                            Female
                                        </option>

                                        <option
                                            value="other"
                                            @selected(old('gender', $user->gender) === 'other')
                                        >
                                            Other
                                        </option>

                                    </select>

                                </div>


                                @error('gender')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- =============================================
                         LOCATION
                    ============================================== --}}

                    <div class="sb-profile-card">

                        <div class="sb-profile-card-header">

                            <div>

                                <span class="sb-profile-card-label">
                                    LOCATION
                                </span>

                                <h2>
                                    Where you live
                                </h2>

                                <p>
                                    Keep your location and delivery information current.
                                </p>

                            </div>

                            <div class="sb-profile-card-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>

                        </div>


                        <div class="sb-profile-card-body">


                            {{-- COUNTRY --}}

                            <div class="sb-profile-field">

                                <label for="country">
                                    Country
                                </label>

                                <div class="sb-profile-input">

                                    <i class="bi bi-globe2"></i>

                                    <input
                                        type="text"
                                        name="country"
                                        id="country"
                                        value="{{ old('country', $user->country) }}"
                                        placeholder="Country"
                                        autocomplete="country-name"
                                    >

                                </div>


                                @error('country')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- CITY --}}

                            <div class="sb-profile-field">

                                <label for="city">
                                    City
                                </label>

                                <div class="sb-profile-input">

                                    <i class="bi bi-buildings"></i>

                                    <input
                                        type="text"
                                        name="city"
                                        id="city"
                                        value="{{ old('city', $user->city) }}"
                                        placeholder="City"
                                        autocomplete="address-level2"
                                    >

                                </div>


                                @error('city')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- STATE --}}

                            <div class="sb-profile-field">

                                <label for="state">
                                    State / Region
                                </label>

                                <div class="sb-profile-input">

                                    <i class="bi bi-map"></i>

                                    <input
                                        type="text"
                                        name="state"
                                        id="state"
                                        value="{{ old('state', $user->state) }}"
                                        placeholder="State or region"
                                        autocomplete="address-level1"
                                    >

                                </div>


                                @error('state')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- POSTAL CODE --}}

                            <div class="sb-profile-field">

                                <label for="postal_code">
                                    Postal code
                                </label>

                                <div class="sb-profile-input">

                                    <i class="bi bi-mailbox"></i>

                                    <input
                                        type="text"
                                        name="postal_code"
                                        id="postal_code"
                                        value="{{ old('postal_code', $user->postal_code) }}"
                                        placeholder="Postal code"
                                        autocomplete="postal-code"
                                    >

                                </div>


                                @error('postal_code')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- ADDRESS --}}

                            <div class="sb-profile-field sb-profile-field-full">

                                <label for="address">
                                    Address
                                </label>

                                <div class="sb-profile-input sb-profile-textarea">

                                    <i class="bi bi-house"></i>

                                    <textarea
                                        name="address"
                                        id="address"
                                        placeholder="Street, building, apartment..."
                                        autocomplete="street-address"
                                    >{{ old('address', $user->address) }}</textarea>

                                </div>


                                @error('address')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- =============================================
                         ABOUT
                    ============================================== --}}

                    <div class="sb-profile-card">

                        <div class="sb-profile-card-header">

                            <div>

                                <span class="sb-profile-card-label">
                                    ABOUT YOU
                                </span>

                                <h2>
                                    A little about yourself
                                </h2>

                                <p>
                                    Add a short introduction to your profile.
                                </p>

                            </div>

                            <div class="sb-profile-card-icon">
                                <i class="bi bi-chat-square-text"></i>
                            </div>

                        </div>


                        <div class="sb-profile-card-body sb-profile-card-body-single">

                            <div class="sb-profile-field">

                                <label for="bio">
                                    Biography
                                </label>


                                <div class="sb-profile-input sb-profile-textarea">

                                    <i class="bi bi-pencil"></i>

                                    <textarea
                                        name="bio"
                                        id="bio"
                                        maxlength="1000"
                                        placeholder="Tell us a little about yourself..."
                                    >{{ old('bio', $user->bio) }}</textarea>

                                </div>


                                @error('bio')

                                    <small class="sb-profile-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- =============================================
                         ACTIONS
                    ============================================== --}}

                    <div class="sb-profile-actions">

                        <a
                            href="{{ route('my.profile') }}"
                            class="sb-profile-cancel"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="sb-profile-save"
                        >
                            <i class="bi bi-check2"></i>
                            Save changes
                        </button>

                    </div>

                </form>

            </section>


            {{-- =================================================
                 SIDEBAR
            ================================================== --}}

            <aside class="sb-profile-sidebar">


                {{-- =============================================
                     PROFILE PREVIEW
                ============================================== --}}

                <div class="sb-profile-preview-card">

                    <span class="sb-profile-preview-label">
                        PROFILE PREVIEW
                    </span>


                    <div class="sb-profile-avatar">

                        @if($user->profile_photo)

                            <img
                                src="{{ asset('storage/' . $user->profile_photo) }}"
                                alt="{{ $fullName }}"
                                id="sidebarProfilePreview"
                            >

                        @else

                            <span id="sidebarProfileInitials">
                                {{ $initials }}
                            </span>

                        @endif

                    </div>


                    <h3>
                        {{ $fullName }}
                    </h3>


                    <p>
                        {{ $user->email }}
                    </p>


                    <div class="sb-profile-role">

                        <i class="bi bi-person-check"></i>

                        <span>
                            {{ ucfirst($user->role ?? 'User') }}
                        </span>

                    </div>


                    <div class="sb-profile-preview-line"></div>


                    <div class="sb-profile-preview-status">

                        <span class="sb-status-dot"></span>

                        <span>
                            Profile information
                        </span>

                    </div>

                </div>


                {{-- =============================================
                     SECURITY CARD
                ============================================== --}}

                <div class="sb-profile-side-card">

                    <div class="sb-profile-side-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>

                    <div>

                        <span class="sb-profile-side-label">
                            ACCOUNT SECURITY
                        </span>

                        <h3>
                            Keep your account safe
                        </h3>

                        <p>
                            Use accurate information and keep your account details
                            up to date.
                        </p>

                    </div>

                </div>


                {{-- =============================================
                     PROFILE TIPS
                ============================================== --}}

                <div class="sb-profile-tips">

                    <div class="sb-profile-tips-title">

                        <i class="bi bi-stars"></i>

                        <span>
                            PROFILE TIPS
                        </span>

                    </div>


                    <div class="sb-profile-tip">

                        <i class="bi bi-check2"></i>

                        <span>
                            Use your real name
                        </span>

                    </div>


                    <div class="sb-profile-tip">

                        <i class="bi bi-check2"></i>

                        <span>
                            Keep your email updated
                        </span>

                    </div>


                    <div class="sb-profile-tip">

                        <i class="bi bi-check2"></i>

                        <span>
                            Add a clear profile photo
                        </span>

                    </div>

                </div>

            </aside>

        </div>

    </div>

</main>


{{-- =========================================================
     REMOVE PROFILE PHOTO FORM
========================================================= --}}

@if($user->profile_photo)

    <form
        action="{{ route('profile.photo.destroy') }}"
        method="POST"
        id="removeProfilePhotoForm"
        style="display: none;"
    >

        @csrf
        @method('DELETE')

    </form>

@endif


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('profileEditForm');

    const fullNameInput = document.getElementById('full_name');
    const firstNameInput = document.getElementById('first_name');
    const lastNameInput = document.getElementById('last_name');

    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');

    const photoInput = document.getElementById('profile_photo');

    const removeButton = document.getElementById('removeProfilePhotoBtn');
    const removeForm = document.getElementById('removeProfilePhotoForm');


    /*
    |--------------------------------------------------------------------------
    | FULL NAME
    |--------------------------------------------------------------------------
    */

    if (
        form &&
        fullNameInput &&
        firstNameInput &&
        lastNameInput
    ) {

        form.addEventListener('submit', function (event) {

            const fullName = fullNameInput.value.trim();

            const parts = fullName
                .split(/\s+/)
                .filter(Boolean);


            if (parts.length < 2) {

                event.preventDefault();

                fullNameInput.setCustomValidity(
                    'Please enter your first and last name.'
                );

                fullNameInput.reportValidity();

                return;
            }


            fullNameInput.setCustomValidity('');

            firstNameInput.value = parts.shift();

            lastNameInput.value = parts.join(' ');

        });


        fullNameInput.addEventListener('input', function () {

            this.setCustomValidity('');

        });

    }


    /*
    |--------------------------------------------------------------------------
    | EMAIL
    |--------------------------------------------------------------------------
    */

    if (emailInput) {

        emailInput.addEventListener('blur', function () {

            this.value = this.value
                .trim()
                .toLowerCase();

        });

    }


    /*
    |--------------------------------------------------------------------------
    | PHONE
    |--------------------------------------------------------------------------
    */

    if (phoneInput) {

        phoneInput.addEventListener('input', function () {

            this.value = this.value.replace(/\D/g, '');

        });


        phoneInput.addEventListener('paste', function () {

            setTimeout(() => {

                this.value = this.value.replace(/\D/g, '');

            }, 0);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | PROFILE PHOTO PREVIEW
    |--------------------------------------------------------------------------
    */

    if (photoInput) {

        photoInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }


            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];


            if (!allowedTypes.includes(file.type)) {

                alert(
                    'Please select a JPG, JPEG, PNG or WEBP image.'
                );

                this.value = '';

                return;
            }


            if (file.size > 2 * 1024 * 1024) {

                alert(
                    'The profile photo must be smaller than 2 MB.'
                );

                this.value = '';

                return;
            }


            const reader = new FileReader();


            reader.onload = function (event) {

                const imageUrl = event.target.result;


                /*
                |--------------------------------------------------------------
                | MAIN PREVIEW
                |--------------------------------------------------------------
                */

                const currentMainPreview =
                    document.getElementById('profilePhotoPreview');

                const currentMainInitials =
                    document.getElementById('profilePhotoInitials');


                if (currentMainPreview) {

                    currentMainPreview.src = imageUrl;

                } else if (currentMainInitials) {

                    currentMainInitials.outerHTML = `
                        <img
                            src="${imageUrl}"
                            alt="Profile photo"
                            id="profilePhotoPreview"
                        >
                    `;

                }


                /*
                |--------------------------------------------------------------
                | SIDEBAR PREVIEW
                |--------------------------------------------------------------
                */

                const currentSidebarPreview =
                    document.getElementById('sidebarProfilePreview');

                const currentSidebarInitials =
                    document.getElementById('sidebarProfileInitials');


                if (currentSidebarPreview) {

                    currentSidebarPreview.src = imageUrl;

                } else if (currentSidebarInitials) {

                    currentSidebarInitials.outerHTML = `
                        <img
                            src="${imageUrl}"
                            alt="Profile photo"
                            id="sidebarProfilePreview"
                        >
                    `;

                }

            };


            reader.readAsDataURL(file);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | REMOVE PROFILE PHOTO
    |--------------------------------------------------------------------------
    */

    if (removeButton && removeForm) {

        removeButton.addEventListener('click', function () {

            const confirmed = confirm(
                'Are you sure you want to remove your profile photo?'
            );


            if (!confirmed) {
                return;
            }


            removeForm.submit();

        });

    }

});
</script>

@endpush

@endsection