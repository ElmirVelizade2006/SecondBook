@extends('Layout.Frontend.master')

@section('title', 'About Us | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/about.css') }}">
@endpush

@section('content')

{{-- =====================================================
     ABOUT HERO
===================================================== --}}

<section class="about-hero">

    <div class="about-hero-bg"></div>
    <div class="about-hero-circle about-hero-circle-one"></div>
    <div class="about-hero-circle about-hero-circle-two"></div>

    <div class="container">

        <div class="about-hero-grid">

            {{-- Hero Content --}}
            <div class="about-hero-content">

                <span class="about-overline">
                    <i class="bi bi-book-half"></i>
                    ABOUT SECOND BOOK
                </span>

                <h1>
                    Every Book<br>
                    Deserves a <em>Second Life.</em>
                </h1>

                <p>
                    SecondBook is a marketplace where readers can
                    discover, buy and give new life to pre-loved books.
                    Because every story deserves another reader.
                </p>

                <div class="about-hero-actions">

                    <a href="{{ route('frontend.books') }}" class="about-primary-btn">
                        Explore Books
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <div class="about-hero-note">

                        <div class="about-hero-note-icons">
                            <span><i class="bi bi-book"></i></span>
                            <span><i class="bi bi-arrow-repeat"></i></span>
                            <span><i class="bi bi-heart"></i></span>
                        </div>

                        <div>
                            <strong>Stories continue</strong>
                            <span>One reader at a time</span>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Hero Visual --}}
            <div class="about-hero-visual">

                <div class="about-visual-circle about-visual-circle-one"></div>
                <div class="about-visual-circle about-visual-circle-two"></div>

                <div class="about-hero-image">

                    <img
                        src="https://images.pexels.com/photos/5503752/pexels-photo-5503752.jpeg"
                        alt="SecondBook Library"
                    >

                </div>


                {{-- Floating Card --}}
                <div class="about-floating-card about-floating-top">

                    <div class="about-floating-icon">
                        <i class="bi bi-stars"></i>
                    </div>

                    <div>
                        <strong>Discover</strong>
                        <span>Something special</span>
                    </div>

                </div>


                {{-- Book Card --}}
                <div class="about-book-card">

                    <div class="about-book-card-icon">
                        <i class="bi bi-bookmark-heart"></i>
                    </div>

                    <div>
                        <span>SECOND LIFE</span>
                        <strong>One more chapter</strong>
                    </div>

                </div>


                {{-- Bottom Badge --}}
                <div class="about-floating-card about-floating-bottom">

                    <div class="about-floating-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                    <div>
                        <strong>Read. Share. Repeat.</strong>
                        <span>Keep stories moving</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     INTRO / OUR STORY
===================================================== --}}

<section class="about-intro">

    <div class="container">

        <div class="about-story-grid">

            {{-- Image --}}
            <div class="about-story-visual">

                <div class="about-story-image">

                    <img
                        src="https://images.squarespace-cdn.com/content/v1/659dcbb6b43b2d4b70278919/19acc103-d808-4ee1-9a71-90aeb43677e3/Austin-Literary-Scene-Bookstore-Interior.png?format=2500w"
                        alt="Books on a shelf"
                        loading="lazy"
                    >

                </div>

                <div class="about-story-badge">

                    <span class="about-story-badge-icon">
                        <i class="bi bi-book-half"></i>
                    </span>

                    <div>
                        <strong>Another chapter</strong>
                        <span>starts here.</span>
                    </div>

                </div>

                <div class="about-story-number">
                    <span>01</span>
                </div>

            </div>


            {{-- Content --}}
            <div class="about-section-content">

                <span class="about-overline">
                    <i class="bi bi-book"></i>
                    OUR STORY
                </span>

                <h2>
                    Books deserve more<br>
                    than <em>one reader.</em>
                </h2>

                <div class="about-content-line"></div>

                <p>
                    SecondBook was created with a simple idea:
                    a book that has already been read can still
                    have a meaningful journey ahead.
                </p>

                <p>
                    Our platform brings readers and book lovers
                    together, making it easier to find affordable
                    second-hand books while giving existing books
                    a chance to reach new readers.
                </p>

                <div class="about-story-points">

                    <div class="about-story-point">
                        <span>
                            <i class="bi bi-check2"></i>
                        </span>

                        <div>
                            <strong>Affordable reading</strong>
                            <small>Great stories without unnecessary cost.</small>
                        </div>
                    </div>

                    <div class="about-story-point">
                        <span>
                            <i class="bi bi-check2"></i>
                        </span>

                        <div>
                            <strong>Books get another journey</strong>
                            <small>Give your old books a chance to be loved again.</small>
                        </div>
                    </div>

                </div>

                <a href="{{ route('frontend.books') }}" class="about-primary-btn">
                    Explore Collection
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     WHY SECOND BOOK
===================================================== --}}

<section class="about-features">

    <div class="container">

        <div class="about-section-heading">

            <div>

                <span class="about-overline">
                    <i class="bi bi-stars"></i>
                    WHY SECOND BOOK
                </span>

                <h2>
                    More than just a<br>
                    <em>book marketplace.</em>
                </h2>

            </div>

            <p>
                We make buying and selling second-hand books
                simple, accessible and enjoyable — while helping
                great stories continue their journey.
            </p>

        </div>


        <div class="about-feature-grid">

            {{-- Feature 1 --}}
            <article class="about-feature-card">

                <div class="about-feature-top">

                    <span class="about-feature-number">
                        01
                    </span>

                    <div class="about-feature-icon">
                        <i class="bi bi-search"></i>
                    </div>

                </div>

                <h3>
                    Discover
                </h3>

                <p>
                    Explore a growing selection of books
                    from different categories and genres.
                </p>

                <div class="about-feature-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </div>

            </article>


            {{-- Feature 2 --}}
            <article class="about-feature-card">

                <div class="about-feature-top">

                    <span class="about-feature-number">
                        02
                    </span>

                    <div class="about-feature-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>

                </div>

                <h3>
                    Affordable
                </h3>

                <p>
                    Find books at accessible prices without
                    compromising the joy of reading.
                </p>

                <div class="about-feature-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </div>

            </article>


            {{-- Feature 3 --}}
            <article class="about-feature-card">

                <div class="about-feature-top">

                    <span class="about-feature-number">
                        03
                    </span>

                    <div class="about-feature-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                </div>

                <h3>
                    Reuse
                </h3>

                <p>
                    Give books another journey instead of
                    leaving them unused on a shelf.
                </p>

                <div class="about-feature-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </div>

            </article>


            {{-- Feature 4 --}}
            <article class="about-feature-card">

                <div class="about-feature-top">

                    <span class="about-feature-number">
                        04
                    </span>

                    <div class="about-feature-icon">
                        <i class="bi bi-people"></i>
                    </div>

                </div>

                <h3>
                    Community
                </h3>

                <p>
                    Connect readers and sellers through
                    a simple and trusted marketplace.
                </p>

                <div class="about-feature-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </div>

            </article>

        </div>

    </div>

</section>


{{-- =====================================================
     HOW IT WORKS
===================================================== --}}

<section class="about-how">

    <div class="container">

        <div class="about-section-heading about-how-heading">

            <div>

                <span class="about-overline">
                    <i class="bi bi-arrow-repeat"></i>
                    HOW IT WORKS
                </span>

                <h2>
                    From shelf to<br>
                    <em>new story.</em>
                </h2>

            </div>

            <p>
                A simple journey that helps books move from
                one reader to another.
            </p>

        </div>


        <div class="about-steps">

            <div class="about-step-line"></div>


            {{-- Step 1 --}}
            <div class="about-step">

                <div class="about-step-top">

                    <span class="about-step-number">
                        01
                    </span>

                    <div class="about-step-icon">
                        <i class="bi bi-search"></i>
                    </div>

                </div>

                <div class="about-step-content">

                    <span class="about-step-label">
                        DISCOVER
                    </span>

                    <h3>
                        Find a Book
                    </h3>

                    <p>
                        Browse our collection and discover
                        a book that interests you.
                    </p>

                </div>

            </div>


            {{-- Step 2 --}}
            <div class="about-step">

                <div class="about-step-top">

                    <span class="about-step-number">
                        02
                    </span>

                    <div class="about-step-icon">
                        <i class="bi bi-handbag"></i>
                    </div>

                </div>

                <div class="about-step-content">

                    <span class="about-step-label">
                        ORDER
                    </span>

                    <h3>
                        Place Your Order
                    </h3>

                    <p>
                        Choose your book and complete
                        your order through our platform.
                    </p>

                </div>

            </div>


            {{-- Step 3 --}}
            <div class="about-step">

                <div class="about-step-top">

                    <span class="about-step-number">
                        03
                    </span>

                    <div class="about-step-icon">
                        <i class="bi bi-book-half"></i>
                    </div>

                </div>

                <div class="about-step-content">

                    <span class="about-step-label">
                        READ
                    </span>

                    <h3>
                        Start Reading
                    </h3>

                    <p>
                        Receive your book and let another
                        story become part of your journey.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     STATS
===================================================== --}}

<section class="about-stats">

    <div class="container">

        <div class="about-stats-card">

            <div class="about-stats-intro">

                <span class="about-overline">
                    SECOND BOOK
                </span>

                <h2>
                    Built around<br>
                    <em>great stories.</em>
                </h2>

                <p>
                    Every number represents another step
                    in keeping books moving from reader to reader.
                </p>

            </div>


            <div class="about-stat-list">

                <div class="about-stat">

                    <div class="about-stat-icon">
                        <i class="bi bi-book"></i>
                    </div>

                    <strong>
                        100+
                    </strong>

                    <span>
                        Books
                    </span>

                </div>


                <div class="about-stat">

                    <div class="about-stat-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <strong>
                        50+
                    </strong>

                    <span>
                        Readers
                    </span>

                </div>


                <div class="about-stat">

                    <div class="about-stat-icon">
                        <i class="bi bi-grid"></i>
                    </div>

                    <strong>
                        20+
                    </strong>

                    <span>
                        Categories
                    </span>

                </div>


                <div class="about-stat">

                    <div class="about-stat-icon">
                        <i class="bi bi-clock"></i>
                    </div>

                    <strong>
                        24/7
                    </strong>

                    <span>
                        Online Access
                    </span>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- =====================================================
     CTA
===================================================== --}}

<section class="about-cta">

    {{-- Decorative elements --}}
    <div class="about-cta-decoration about-cta-decoration-one"></div>
    <div class="about-cta-decoration about-cta-decoration-two"></div>

    <div class="container">

        <div
            class="about-cta-card"
            data-aos="fade-up"
        >

            {{-- =================================================
                 LEFT CONTENT
            ================================================== --}}

            <div class="about-cta-content">

                <span class="about-overline">

                    <i class="bi bi-bookmark-heart"></i>

                    YOUR NEXT STORY AWAITS

                </span>

                <h2>
                    Every book has
                    <br>
                    <em>another chapter.</em>
                </h2>

                <p>
                    Explore our collection and discover books
                    waiting for their next reader.
                </p>

                <a
                    href="{{ route('frontend.books') }}"
                    class="about-primary-btn"
                >

                    <span>
                        Browse Books
                    </span>

                    <i class="bi bi-arrow-up-right"></i>

                </a>

            </div>


            {{-- =================================================
                 RIGHT VISUAL
            ================================================== --}}

            <div class="about-cta-visual">

                {{-- Orbit --}}
                <div class="about-cta-orbit"></div>


                {{-- Book --}}
                <div class="about-cta-book">

                    <div class="about-cta-book-spine"></div>

                    <div class="about-cta-book-cover">

                        <i class="bi bi-book-half"></i>

                        <span>
                            SECOND
                            <br>
                            BOOK
                        </span>

                        <small>
                            YOUR NEXT CHAPTER
                        </small>

                    </div>

                </div>


                {{-- Floating information --}}
                <div class="about-cta-floating">

                    <i class="bi bi-stars"></i>

                    <div>

                        <strong>
                            Discover something new
                        </strong>

                        <span>
                            One book at a time.
                        </span>

                    </div>

                </div>


                {{-- Decorative mark --}}
                <div class="about-cta-mark">

                    <i class="bi bi-arrow-down-left"></i>

                </div>

            </div>

        </div>

    </div>

</section>



@endsection