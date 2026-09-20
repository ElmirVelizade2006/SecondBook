@extends('Layout.Frontend.master')

@section('title', 'Books | SecondBook')

@push('css') <link rel="stylesheet" href="{{ asset('frontend/css/books.css') }}">
@endpush

@section('content')

{{-- =====================================================
BOOKS HERO
===================================================== --}}

<section class="books-hero">

```
<div class="books-hero-bg"></div>

<div class="container">

    <div class="books-hero-grid">

        {{-- LEFT --}}
        <div class="books-hero-content">

            <span class="books-overline">
                <i class="bi bi-book-half"></i>
                SECOND BOOK COLLECTION
            </span>

            <h1>
                Stories Worth
                <span>Reading Again.</span>
            </h1>

            <p>
                Discover pre-loved books, hidden gems and
                stories waiting for their next reader.
            </p>

            <div class="books-hero-actions">

                <a
                    href="#books-collection"
                    class="books-hero-btn"
                >
                    Explore Collection
                    <i class="bi bi-arrow-right"></i>
                </a>

                <div class="books-hero-trust">

                    <div class="books-trust-icons">
                        <i class="bi bi-book"></i>
                        <i class="bi bi-heart"></i>
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                    <span>
                        Books with another chapter
                    </span>

                </div>

            </div>

        </div>


        {{-- RIGHT VISUAL --}}
        <div class="books-hero-visual">

            <div class="hero-circle hero-circle-one"></div>
            <div class="hero-circle hero-circle-two"></div>


            {{-- Decorative Image --}}
            <div class="hero-bookshop-image">

                <img
                    src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=900&q=85"
                    alt="Bookshelf"
                >

            </div>


            {{-- Floating Card --}}
            <div class="hero-floating-card hero-floating-top">

                <i class="bi bi-stars"></i>

                <div>
                    <strong>Discover</strong>
                    <span>Something new</span>
                </div>

            </div>


            {{-- Book Stack --}}
            <div class="hero-book-stack">

                @php
                    $heroBooks = $books->take(3);
                @endphp

                @foreach($heroBooks as $index => $heroBook)

                    <div
                        class="hero-stack-book hero-stack-book-{{ $index + 1 }}"
                    >

                        @if($heroBook->cover)

                            <img
                                src="{{ asset('storage/' . $heroBook->cover) }}"
                                alt="{{ $heroBook->title }}"
                            >

                        @else

                            <div class="hero-stack-placeholder">
                                <i class="bi bi-book"></i>
                            </div>

                        @endif

                    </div>

                @endforeach

            </div>


            {{-- Bottom Floating Card --}}
            <div class="hero-floating-card hero-floating-bottom">

                <div class="hero-floating-icon">
                    <i class="bi bi-bookmark-heart"></i>
                </div>

                <div>
                    <strong>{{ $books->total() }}+</strong>
                    <span>Books to explore</span>
                </div>

            </div>

        </div>

    </div>

</div>
```

</section>

{{-- =====================================================
QUICK STATS
===================================================== --}}

<section class="books-stats-section">

```
<div class="container">

    <div class="books-stats">

        {{-- STAT 1 --}}
        <div class="books-stat-item">

            <div class="books-stat-icon">
                <i class="bi bi-book"></i>
            </div>

            <div>
                <strong>{{ $books->total() }}+</strong>
                <span>Books Available</span>
            </div>

        </div>


        {{-- STAT 2 --}}
        <div class="books-stat-item">

            <div class="books-stat-icon">
                <i class="bi bi-arrow-repeat"></i>
            </div>

            <div>
                <strong>Pre-Loved</strong>
                <span>Ready for New Readers</span>
            </div>

        </div>


        {{-- STAT 3 --}}
        <div class="books-stat-item">

            <div class="books-stat-icon">
                <i class="bi bi-tags"></i>
            </div>

            <div>
                <strong>Great Value</strong>
                <span>Affordable Books</span>
            </div>

        </div>


        {{-- STAT 4 --}}
        <div class="books-stat-item">

            <div class="books-stat-icon">
                <i class="bi bi-heart"></i>
            </div>

            <div>
                <strong>One More</strong>
                <span>Chapter to Every Book</span>
            </div>

        </div>

    </div>

</div>
```

</section>

{{-- =====================================================
COLLECTION
===================================================== --}}

<section
    class="books-section"
    id="books-collection"
>

```
<div class="container">


    {{-- SECTION HEADING --}}
    <div class="books-section-heading">

        <div>

            <span class="books-results-label">
                EXPLORE OUR COLLECTION
            </span>

            <h2>
                Find Your Next
                <em>Favorite Book.</em>
            </h2>

        </div>

        <p>
            Search through our growing collection of
            pre-loved books and discover something special.
        </p>

    </div>


    {{-- FILTER --}}
    <div class="books-toolbar">


        {{-- TOOLBAR HEADER --}}
        <div class="books-toolbar-header">

            <div class="books-toolbar-title">

                <div class="toolbar-icon">
                    <i class="bi bi-sliders2"></i>
                </div>

                <div>
                    <strong>Find a Book</strong>
                    <span>Search and filter our collection</span>
                </div>

            </div>

            <div class="books-total">

                <span>{{ $books->total() }}</span>

                books

            </div>

        </div>


        {{-- FILTER FORM --}}
        <form
            action="{{ route('frontend.books') }}"
            method="GET"
            class="books-filter-form"
            id="books-filter-form"
        >

            {{-- SEARCH --}}
            <div class="books-filter-column books-search-column">

                <label for="book-search">
                    Search
                </label>

                <div class="books-search">

                    <i class="bi bi-search"></i>

                    <input
                        id="book-search"
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search books by title..."
                    >

                </div>

            </div>


            {{-- CONDITION --}}
            <div class="books-filter-column">

                <label for="book-condition">
                    Condition
                </label>

                <select
                    id="book-condition"
                    name="condition"
                    class="books-select"
                >

                    <option value="">
                        All Conditions
                    </option>

                    <option
                        value="new"
                        {{ request('condition') === 'new' ? 'selected' : '' }}
                    >
                        New
                    </option>

                    <option
                        value="like_new"
                        {{ request('condition') === 'like_new' ? 'selected' : '' }}
                    >
                        Like New
                    </option>

                    <option
                        value="good"
                        {{ request('condition') === 'good' ? 'selected' : '' }}
                    >
                        Good
                    </option>

                    <option
                        value="fair"
                        {{ request('condition') === 'fair' ? 'selected' : '' }}
                    >
                        Fair
                    </option>

                </select>

            </div>


            {{-- SORT --}}
            <div class="books-filter-column">

                <label for="book-sort">
                    Sort By
                </label>

                <select
                    id="book-sort"
                    name="sort"
                    class="books-select"
                >

                    <option value="">
                        Default
                    </option>

                    <option
                        value="newest"
                        {{ request('sort') === 'newest' ? 'selected' : '' }}
                    >
                        Newest
                    </option>

                    <option
                        value="price_low"
                        {{ request('sort') === 'price_low' ? 'selected' : '' }}
                    >
                        Price: Low to High
                    </option>

                    <option
                        value="price_high"
                        {{ request('sort') === 'price_high' ? 'selected' : '' }}
                    >
                        Price: High to Low
                    </option>

                    <option
                        value="oldest"
                        {{ request('sort') === 'oldest' ? 'selected' : '' }}
                    >
                        Oldest
                    </option>

                </select>

            </div>


            {{-- ACTIONS --}}
            <div class="books-filter-actions">

                <button
                    type="submit"
                    class="books-filter-btn"
                >
                    <i class="bi bi-search"></i>
                    <span>Search</span>
                </button>


                @if(request()->hasAny([
                    'search',
                    'condition',
                    'sort'
                ]))

                    <a
                        href="{{ route('frontend.books') }}"
                        class="books-clear-filter"
                        aria-label="Clear filters"
                        title="Clear filters"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                        <span>Clear</span>
                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- RESULTS HEADER --}}
    <div class="books-results-header">

        <div>

            <span class="books-results-label">
                OUR COLLECTION
            </span>

            <h2>
                Available
                <em>Books</em>
            </h2>

        </div>

        <div class="books-results-meta">

            Showing

            <strong>
                {{ $books->firstItem() ?? 0 }}
            </strong>

            –

            <strong>
                {{ $books->lastItem() ?? 0 }}
            </strong>

            of

            <strong>
                {{ $books->total() }}
            </strong>

        </div>

    </div>


    {{-- BOOK GRID --}}
    @if($books->count())

        <div class="row g-4">

            @foreach($books as $book)

                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                    <article class="book-card">


                        {{-- COVER --}}
                        <div class="book-cover">

                            @if($book->cover)

                                <img
                                    src="{{ asset('storage/' . $book->cover) }}"
                                    alt="{{ $book->title }}"
                                    loading="lazy"
                                >

                            @else

                                <div class="book-cover-placeholder">

                                    <i class="bi bi-book"></i>

                                    <span>
                                        No Cover
                                    </span>

                                </div>

                            @endif


                            {{-- CONDITION --}}
                            <span class="book-condition">

                                <i class="bi bi-check-circle-fill"></i>

                                {{ ucwords(str_replace('_', ' ', $book->condition)) }}

                            </span>


                            {{-- WISHLIST --}}
                            @auth
                                @php
                                    $isWishlisted = auth()->user()
                                        ->wishlists()
                                        ->where('book_id', $book->id)
                                        ->exists();
                                @endphp

                                @if($isWishlisted)
                                    <form
                                        action="{{ route('frontend.wishlist.remove', $book->id) }}"
                                        method="POST"
                                        class="book-wishlist-form"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="book-wishlist active"
                                            aria-label="Remove from wishlist"
                                            title="Remove from wishlist"
                                        >
                                            <i class="bi bi-heart-fill"></i>
                                        </button>
                                    </form>
                                @else
                                    <form
                                        action="{{ route('frontend.wishlist.add', $book->id) }}"
                                        method="POST"
                                        class="book-wishlist-form"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="book-wishlist"
                                            aria-label="Add to wishlist"
                                            title="Add to wishlist"
                                        >
                                            <i class="bi bi-heart"></i>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a
                                    href="{{ route('frontend.auth.login') }}"
                                    class="book-wishlist"
                                    aria-label="Login to add to wishlist"
                                    title="Login to add to wishlist"
                                >
                                    <i class="bi bi-heart"></i>
                                </a>
                            @endauth


                            {{-- HOVER --}}
                            <div class="book-cover-hover">

                                <span>
                                    Discover this book
                                </span>

                                <i class="bi bi-arrow-up-right"></i>

                            </div>

                        </div>


                        {{-- CONTENT --}}
                        <div class="book-content">

                            <span class="book-mini-label">
                                SECONDBOOK
                            </span>

                            <h3>
                                {{ $book->title }}
                            </h3>


                            {{-- AUTHOR --}}
                            @if($book->author)

                                <p class="book-author">

                                    <i class="bi bi-person"></i>

                                    {{ $book->author->name }}

                                </p>

                            @else

                                <p class="book-author">

                                    <i class="bi bi-person"></i>

                                    Unknown Author

                                </p>

                            @endif


                            <div class="book-card-divider"></div>


                            {{-- PRICE / ACTIONS --}}
                            <div class="book-bottom">

                                <div>

                                    <span class="book-price-label">
                                        PRICE
                                    </span>

                                    <strong class="book-price">
                                        ₼{{ number_format($book->price, 2) }}
                                    </strong>

                                </div>


                                <div class="book-card-actions">


                                    {{-- VIEW --}}
                                    <a
                                        href="#"
                                        class="book-view-btn"
                                    >
                                        View
                                        <i class="bi bi-arrow-right"></i>
                                    </a>


                                    {{-- ADD TO CART --}}
                                    @auth

                                        @if(
                                            $book->stock > 0 &&
                                            $book->status === 'approved'
                                        )

                                            <form
                                                action="{{ route('frontend.cart.add', $book->id) }}"
                                                method="POST"
                                                class="book-cart-form"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="book-cart-btn"
                                                    title="Add to Cart"
                                                    aria-label="Add {{ $book->title }} to cart"
                                                >
                                                    <i class="bi bi-bag-plus"></i>
                                                </button>

                                            </form>

                                        @else

                                            <button
                                                type="button"
                                                class="book-cart-btn book-cart-btn-disabled"
                                                disabled
                                                title="Out of Stock"
                                                aria-label="Out of Stock"
                                            >
                                                <i class="bi bi-bag-x"></i>
                                            </button>

                                        @endif

                                    @else

                                        <a
                                            href="{{ route('frontend.auth.login') }}"
                                            class="book-cart-btn"
                                            title="Login to add to cart"
                                            aria-label="Login to add this book to cart"
                                        >
                                            <i class="bi bi-bag-plus"></i>
                                        </a>

                                    @endauth

                                </div>

                            </div>

                        </div>

                    </article>

                </div>

            @endforeach

        </div>


        {{-- PAGINATION --}}
        @if($books->hasPages())

            <div class="books-pagination">

                {{ $books->withQueryString()->links() }}

            </div>

        @endif


    @else

        {{-- EMPTY STATE --}}
        <div class="books-empty">

            <div class="books-empty-visual">

                <div class="empty-book empty-book-one"></div>
                <div class="empty-book empty-book-two"></div>
                <div class="empty-book empty-book-three"></div>

                <i class="bi bi-search"></i>

            </div>

            <span>
                NOTHING FOUND
            </span>

            <h3>
                No Books Found
            </h3>

            <p>
                We couldn't find any books matching
                your current filters.
            </p>

            <a
                href="{{ route('frontend.books') }}"
                class="books-clear-btn"
            >
                <i class="bi bi-arrow-counterclockwise"></i>
                View All Books
            </a>

        </div>

    @endif

</div>
```

</section>

{{-- =====================================================
SELL BOOK CTA
===================================================== --}}

<section class="books-sell-section">

```
<div class="container">

    <div class="books-sell-card">

        <div class="books-sell-image">

            <img
                src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?auto=format&fit=crop&w=900&q=85"
                alt="Books"
                loading="lazy"
            >

        </div>

        <div class="books-sell-content">

            <span>
                GIVE YOUR BOOK ANOTHER CHAPTER
            </span>

            <h2>
                Have Books Sitting
                <em>Unused?</em>
            </h2>

            <p>
                Sell your books on SecondBook and let
                someone else discover the story you once loved.
            </p>

            <a
                href="#"
                class="books-sell-btn"
            >
                Sell Your Books
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

    </div>

</div>
```

</section>

{{-- =====================================================
FILTER SCROLL
===================================================== --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const params = new URLSearchParams(window.location.search);

    const hasFilter =
        params.get('search') ||
        params.get('condition') ||
        params.get('sort');

    if (!hasFilter) {
        return;
    }

    const booksSection = document.getElementById('books-collection');

    if (!booksSection) {
        return;
    }

    setTimeout(function () {

        const headerOffset = 90;

        const sectionTop =
            booksSection.getBoundingClientRect().top +
            window.scrollY;

        window.scrollTo({
            top: sectionTop - headerOffset,
            behavior: 'smooth'
        });

    }, 300);

});
</script>

@endsection
