@extends('Layout.Frontend.master')

@section('title', 'Privacy Policy | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/privacy-policy.css') }}">
@endpush

@section('content')

<main class="sb-privacy-page">

    {{-- =========================================================
         HERO
    ========================================================== --}}
    <section class="sb-privacy-hero">

        <div class="container">

            <div class="sb-privacy-hero-content">

                <div class="sb-privacy-eyebrow">
                    <span class="sb-privacy-eyebrow-icon">
                        <i class="bi bi-shield-check"></i>
                    </span>
                    <span>SECOND BOOK PRIVACY</span>
                </div>

                <h1>
                    Your privacy,<br>
                    <span>our priority.</span>
                </h1>

                <p>
                    We believe your personal information should be handled
                    with care, transparency, and respect. Here's how
                    SecondBook collects, uses, and protects your information.
                </p>

                <div class="sb-privacy-updated">
                    <i class="bi bi-calendar3"></i>
                    <span>Last updated: September 2026</span>
                </div>

            </div>

        </div>

        <div class="sb-privacy-decoration sb-privacy-decoration-one"></div>
        <div class="sb-privacy-decoration sb-privacy-decoration-two"></div>

    </section>


    {{-- =========================================================
         INTRODUCTION
    ========================================================== --}}
    <section class="sb-privacy-intro">

        <div class="container">

            <div class="sb-privacy-intro-grid">

                <div class="sb-privacy-section-heading">

                    <span class="sb-privacy-section-label">
                        PRIVACY OVERVIEW
                    </span>

                    <h2>
                        Keeping your information
                        clear and protected.
                    </h2>

                </div>

                <div class="sb-privacy-intro-content">

                    <p>
                        When you use SecondBook, certain information may be
                        collected to provide our marketplace services, process
                        orders, maintain your account, and improve your experience.
                    </p>

                    <p>
                        This Privacy Policy explains the types of information
                        we may collect, how it may be used, and the choices
                        available to you.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         INFORMATION WE COLLECT
    ========================================================== --}}
    <section class="sb-privacy-information">

        <div class="container">

            <div class="sb-privacy-section-heading">

                <span class="sb-privacy-section-label">
                    INFORMATION WE COLLECT
                </span>

                <h2>
                    What information may<br>
                    we collect?
                </h2>

            </div>


            <div class="sb-privacy-information-grid">

                {{-- ACCOUNT INFORMATION --}}
                <article class="sb-privacy-info-card">

                    <div class="sb-privacy-info-icon">
                        <i class="bi bi-person"></i>
                    </div>

                    <h3>Account Information</h3>

                    <p>
                        Information you provide when creating or managing
                        your account, such as your name, email address,
                        phone number, and account details.
                    </p>

                </article>


                {{-- ORDER INFORMATION --}}
                <article class="sb-privacy-info-card">

                    <div class="sb-privacy-info-icon">
                        <i class="bi bi-bag"></i>
                    </div>

                    <h3>Order Information</h3>

                    <p>
                        Information required to process purchases, deliveries,
                        payments, returns, and other marketplace transactions.
                    </p>

                </article>


                {{-- COMMUNICATION --}}
                <article class="sb-privacy-info-card">

                    <div class="sb-privacy-info-icon">
                        <i class="bi bi-chat-left-text"></i>
                    </div>

                    <h3>Communication</h3>

                    <p>
                        Information you provide when contacting support,
                        submitting requests, sending messages, or communicating
                        with SecondBook.
                    </p>

                </article>


                {{-- USAGE INFORMATION --}}
                <article class="sb-privacy-info-card">

                    <div class="sb-privacy-info-icon">
                        <i class="bi bi-bar-chart"></i>
                    </div>

                    <h3>Usage Information</h3>

                    <p>
                        Technical and usage information may be collected to
                        help maintain website functionality, security, and
                        overall service performance.
                    </p>

                </article>

            </div>

        </div>

    </section>


    {{-- =========================================================
         HOW WE USE INFORMATION
    ========================================================== --}}
    <section class="sb-privacy-usage">

        <div class="container">

            <div class="sb-privacy-usage-box">

                <div class="sb-privacy-usage-icon">
                    <i class="bi bi-gear"></i>
                </div>

                <div class="sb-privacy-usage-content">

                    <span class="sb-privacy-section-label">
                        HOW WE USE INFORMATION
                    </span>

                    <h2>
                        Why do we use your information?
                    </h2>

                    <div class="sb-privacy-usage-grid">

                        <div class="sb-privacy-usage-item">
                            <span class="sb-privacy-usage-number">01</span>
                            <div>
                                <h3>Provide our services</h3>
                                <p>
                                    To create accounts, process orders,
                                    support marketplace features, and provide
                                    requested services.
                                </p>
                            </div>
                        </div>

                        <div class="sb-privacy-usage-item">
                            <span class="sb-privacy-usage-number">02</span>
                            <div>
                                <h3>Process transactions</h3>
                                <p>
                                    To manage purchases, payments, shipping,
                                    refunds, and related order activities.
                                </p>
                            </div>
                        </div>

                        <div class="sb-privacy-usage-item">
                            <span class="sb-privacy-usage-number">03</span>
                            <div>
                                <h3>Improve SecondBook</h3>
                                <p>
                                    To understand how our services are used
                                    and improve functionality and usability.
                                </p>
                            </div>
                        </div>

                        <div class="sb-privacy-usage-item">
                            <span class="sb-privacy-usage-number">04</span>
                            <div>
                                <h3>Protect our platform</h3>
                                <p>
                                    To detect suspicious activity, maintain
                                    security, and help prevent misuse.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         DATA PROTECTION
    ========================================================== --}}
    <section class="sb-privacy-protection">

        <div class="container">

            <div class="sb-privacy-protection-grid">

                <div class="sb-privacy-section-heading">

                    <span class="sb-privacy-section-label">
                        DATA PROTECTION
                    </span>

                    <h2>
                        We take reasonable steps
                        to protect your data.
                    </h2>

                    <p>
                        We use appropriate technical and organizational
                        measures intended to protect information against
                        unauthorized access, misuse, alteration, or loss.
                    </p>

                </div>


                <div class="sb-privacy-protection-list">

                    <div class="sb-privacy-protection-item">

                        <span class="sb-privacy-protection-icon">
                            <i class="bi bi-lock"></i>
                        </span>

                        <div>
                            <h3>Account security</h3>
                            <p>
                                Account information is handled with security
                                measures designed to help protect your access.
                            </p>
                        </div>

                    </div>


                    <div class="sb-privacy-protection-item">

                        <span class="sb-privacy-protection-icon">
                            <i class="bi bi-shield-check"></i>
                        </span>

                        <div>
                            <h3>Limited access</h3>
                            <p>
                                Access to information should be limited to
                                purposes connected with providing our services.
                            </p>
                        </div>

                    </div>


                    <div class="sb-privacy-protection-item">

                        <span class="sb-privacy-protection-icon">
                            <i class="bi bi-eye-slash"></i>
                        </span>

                        <div>
                            <h3>Responsible handling</h3>
                            <p>
                                We aim to handle personal information in a
                                transparent and responsible manner.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         COOKIES
    ========================================================== --}}
    <section class="sb-privacy-cookies">

        <div class="container">

            <div class="sb-privacy-cookies-box">

                <div class="sb-privacy-cookies-icon">
                    <i class="bi bi-cookie"></i>
                </div>

                <div class="sb-privacy-cookies-content">

                    <span class="sb-privacy-section-label">
                        COOKIES & TECHNOLOGIES
                    </span>

                    <h2>
                        About cookies
                    </h2>

                    <p>
                        SecondBook may use cookies and similar technologies
                        to remember preferences, support essential website
                        functionality, maintain sessions, and understand
                        how the website is used.
                    </p>

                    <p>
                        Depending on your browser and settings, you may be
                        able to manage or restrict cookies through your
                        browser controls.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         YOUR RIGHTS
    ========================================================== --}}
    <section class="sb-privacy-rights">

        <div class="container">

            <div class="sb-privacy-section-heading">

                <span class="sb-privacy-section-label">
                    YOUR PRIVACY CHOICES
                </span>

                <h2>
                    You have control<br>
                    over your information.
                </h2>

                <p>
                    Depending on applicable law, you may have rights regarding
                    the personal information associated with your account.
                </p>

            </div>


            <div class="sb-privacy-rights-grid">

                <article class="sb-privacy-right-card">

                    <div class="sb-privacy-right-icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>

                    <h3>Access</h3>

                    <p>
                        Request information about the personal data associated
                        with your account.
                    </p>

                </article>


                <article class="sb-privacy-right-card">

                    <div class="sb-privacy-right-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <h3>Update</h3>

                    <p>
                        Review and update certain account information through
                        your profile and account settings.
                    </p>

                </article>


                <article class="sb-privacy-right-card">

                    <div class="sb-privacy-right-icon">
                        <i class="bi bi-trash3"></i>
                    </div>

                    <h3>Deletion</h3>

                    <p>
                        Depending on applicable requirements, you may request
                        deletion of certain personal information.
                    </p>

                </article>


                <article class="sb-privacy-right-card">

                    <div class="sb-privacy-right-icon">
                        <i class="bi bi-envelope"></i>
                    </div>

                    <h3>Questions</h3>

                    <p>
                        Contact us if you have questions about how your
                        information is handled.
                    </p>

                </article>

            </div>

        </div>

    </section>


    {{-- =========================================================
         POLICY NOTE
    ========================================================== --}}
    <section class="sb-privacy-note">

        <div class="container">

            <div class="sb-privacy-note-box">

                <div class="sb-privacy-note-icon">
                    <i class="bi bi-info-circle"></i>
                </div>

                <div class="sb-privacy-note-content">

                    <span class="sb-privacy-section-label">
                        IMPORTANT
                    </span>

                    <h2>
                        This policy may be updated.
                    </h2>

                    <p>
                        As SecondBook grows and our services change, this
                        Privacy Policy may be updated from time to time.
                        Any updated version should replace the previous
                        version on this page.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         CONTACT CTA
    ========================================================== --}}
    <section class="sb-privacy-contact">

        <div class="container">

            <div class="sb-privacy-contact-box">

                <div class="sb-privacy-contact-icon">
                    <i class="bi bi-headset"></i>
                </div>

                <div class="sb-privacy-contact-content">

                    <span class="sb-privacy-section-label">
                        HAVE A QUESTION?
                    </span>

                    <h2>
                        Need more information about privacy?
                    </h2>

                    <p>
                        Contact the SecondBook team if you have questions
                        about this Privacy Policy or your personal information.
                    </p>

                </div>

                <div class="sb-privacy-contact-actions">

                    <a href="{{ route('frontend.contact') }}"
                       class="sb-privacy-contact-btn">
                        Contact Support
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

                <div class="sb-privacy-contact-decoration"></div>

            </div>

        </div>

    </section>

</main>

@endsection

