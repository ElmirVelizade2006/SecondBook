@extends('Layout.Frontend.master')

@section('title', 'Authors | SecondBook')

@push('css') <link rel="stylesheet" href="{{ asset('frontend/css/authors.css') }}">
@endpush

@section('content')

{{-- =========================================================
AUTHORS HERO
========================================================= --}}

<section class="authors-hero">
    <div class="authors-hero-pattern"></div>

```
<div class="container">
    <div class="row align-items-center g-5">

        {{-- Hero Content --}}
        <div class="col-lg-6">
            <div class="authors-hero-content">

                <span class="authors-eyebrow">
                    <i class="bi bi-pen"></i>
                    Meet the Authors
                </span>

                <h1>
                    Stories begin with
                    <span>great authors.</span>
                </h1>

                <p>
                    Discover the talented writers behind the books
                    available on SecondBook. Explore their stories,
                    ideas, and unforgettable worlds.
                </p>

                <div class="authors-hero-actions">

                    <a href="{{ route('frontend.books') }}" class="authors-primary-btn">
                        <span>Explore Books</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <a href="#authors-list" class="authors-secondary-btn">
                        Meet the Authors
                    </a>

                </div>

            </div>
        </div>

        {{-- Hero Visual --}}
        <div class="col-lg-6">
            <div class="authors-hero-visual">

                <div class="authors-main-image">
                    <img
                        src="https://images.pexels.com/photos/9572569/pexels-photo-9572569.jpeg?auto=compress&cs=tinysrgb&w=1200"
                        alt="Author reading a book"
                    >
                </div>

                <div class="authors-floating-card authors-floating-card-top">

                    <div class="floating-icon">
                        <i class="bi bi-book"></i>
                    </div>

                    <div>
                        <strong>{{ $authors->count() }}</strong>
                        <span>Authors</span>
                    </div>

                </div>

                <div class="authors-floating-card authors-floating-card-bottom">

                    <div class="floating-avatar">
                        <i class="bi bi-person"></i>
                    </div>

                    <div>
                        <strong>Unique Stories</strong>
                        <span>One book at a time</span>
                    </div>

                </div>

                <div class="authors-circle circle-one"></div>
                <div class="authors-circle circle-two"></div>

            </div>
        </div>

    </div>
</div>
```

</section>

{{-- =========================================================
INTRO
========================================================= --}}

<section class="authors-intro">

```
<div class="container">

    <div class="authors-section-heading text-center">

        <span>Discover Their Work</span>

        <h2>
            Authors worth
            <strong>knowing.</strong>
        </h2>

        <p>
            Browse our growing community of authors and discover
            books that match your interests.
        </p>

    </div>

</div>
```

</section>

{{-- =========================================================
AUTHORS LIST
========================================================= --}}

<section class="authors-list-section" id="authors-list">

```
<div class="container">

    @if($authors->count())

        <div class="authors-grid">

            @foreach($authors as $index => $author)

                @php

                    /*
                    |-------------------------------------------------------------------------- 
                    | Author Photo
                    |-------------------------------------------------------------------------- 
                    | Supports both:
                    | 1. External URLs
                    | 2. Local storage images
                    */

                    $authorImage = null;

                    if (!empty($author->photo)) {

                        $authorImage = filter_var(
                            $author->photo,
                            FILTER_VALIDATE_URL
                        )
                            ? $author->photo
                            : asset('storage/' . $author->photo);

                    }

                @endphp

                <article class="author-card">

                    {{-- Image --}}
                    <div class="author-card-image">

                        @if($authorImage)

                            <img
                                src="{{ $authorImage }}"
                                alt="{{ $author->name }}"
                                loading="lazy"
                            >

                        @else

                            <div class="author-card-placeholder">
                                <i class="bi bi-person"></i>
                            </div>

                        @endif

                        <div class="author-image-overlay"></div>

                        <span class="author-number">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                    </div>


                    {{-- Content --}}
                    <div class="author-card-content">

                        <span class="author-label">
                            AUTHOR
                        </span>

                        <h3>
                            {{ $author->name }}
                        </h3>

                        <p>
                            {{ \Illuminate\Support\Str::limit(
                                $author->bio ?: 'Discover books and stories from ' . $author->name . '.',
                                110
                            ) }}
                        </p>

                        <a
                            href="{{ route('frontend.books', ['search' => $author->name]) }}"
                            class="author-view-btn"
                        >
                            <span>View Books</span>
                            <i class="bi bi-arrow-up-right"></i>
                        </a>

                    </div>

                </article>

            @endforeach

        </div>

    @else

        {{-- Empty State --}}
        <div class="authors-empty">

            <div class="authors-empty-icon">
                <i class="bi bi-person-lines-fill"></i>
            </div>

            <h3>
                No authors available yet
            </h3>

            <p>
                Our author collection is growing.
                Check back soon for new writers and stories.
            </p>

            <a
                href="{{ route('frontend.books') }}"
                class="authors-primary-btn"
            >
                <span>Browse Books</span>
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

    @endif

</div>
```

</section>

{{-- =========================================================
AUTHOR DISCOVERY
========================================================= --}}

<section class="authors-discovery">

```
<div class="container">

    <div class="authors-discovery-box">

        <div class="discovery-decoration discovery-decoration-one"></div>
        <div class="discovery-decoration discovery-decoration-two"></div>

        <div class="row align-items-center g-5">

            <div class="col-lg-7">

                <span class="discovery-eyebrow">
                    <i class="bi bi-stars"></i>
                    Keep Exploring
                </span>

                <h2>
                    Every author has a
                    <span>story to tell.</span>
                </h2>

                <p>
                    From timeless classics to modern discoveries,
                    find your next favorite book and explore the
                    minds behind the pages.
                </p>

                <a
                    href="{{ route('frontend.books') }}"
                    class="discovery-btn"
                >
                    Explore the Collection
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="col-lg-5">

                <div class="discovery-books">

                    <div class="discovery-book book-one">
                        <span>STORIES</span>
                    </div>

                    <div class="discovery-book book-two">
                        <span>IDEAS</span>
                    </div>

                    <div class="discovery-book book-three">
                        <span>WORDS</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
```

</section>

{{-- =========================================================
BOTTOM CTA
========================================================= --}}

<section class="authors-cta">

```
<div class="container">

    <div class="authors-cta-content">

        <div>

            <span>Find Your Next Read</span>

            <h2>
                A new story is
                <strong>waiting for you.</strong>
            </h2>

        </div>

        <a
            href="{{ route('frontend.books') }}"
            class="authors-cta-btn"
        >
            Browse Books
            <i class="bi bi-arrow-right"></i>
        </a>

    </div>

</div>
```

</section>

@endsection
