@extends('Layout.Frontend.master')

@section('title', 'Books | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/books.css') }}">
@endpush

@section('content')

<section class="books-hero">

    <div class="books-hero-bg"></div>

    <div class="container">

        <div class="books-hero-grid">

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

                    <a href="#books-collection" class="books-hero-btn">
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

            <div class="books-hero-visual">

                <div class="hero-circle hero-circle-one"></div>
                <div class="hero-circle hero-circle-two"></div>

                <div class="hero-bookshop-image">
                    <img
                        src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=900&q=85"
                        alt="Bookshelf"
                    >
                </div>

                <div class="hero-floating-card hero-floating-top">

                    <i class="bi bi-stars"></i>

                    <div>
                        <strong>Discover</strong>
                        <span>Something new</span>
                    </div>

                </div>

                <div class="hero-book-stack">

                    @php
                        $heroBooks = $books->take(3);
                    @endphp

                    @foreach($heroBooks as $index => $heroBook)

                        @php
                            $heroCoverUrl = null;

                            if (!empty($heroBook->cover)) {
                                $heroCoverUrl = filter_var(
                                    $heroBook->cover,
                                    FILTER_VALIDATE_URL
                                )
                                    ? $heroBook->cover
                                    : asset('storage/' . $heroBook->cover);
                            }
                        @endphp

                        <div class="hero-stack-book hero-stack-book-{{ $index + 1 }}">

                            @if($heroCoverUrl)

                                <img
                                    src="{{ $heroCoverUrl }}"
                                    alt="{{ $heroBook->title }}"
                                    loading="lazy"
                                >

                            @else

                                <div class="hero-stack-placeholder">
                                    <i class="bi bi-book"></i>
                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>

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

</section>


<section class="books-stats-section">

    <div class="container">

        <div class="books-stats">

            <div class="books-stat-item">

                <div class="books-stat-icon">
                    <i class="bi bi-book"></i>
                </div>

                <div>
                    <strong>{{ $books->total() }}+</strong>
                    <span>Books Available</span>
                </div>

            </div>

            <div class="books-stat-item">

                <div class="books-stat-icon">
                    <i class="bi bi-arrow-repeat"></i>
                </div>

                <div>
                    <strong>Pre-Loved</strong>
                    <span>Ready for New Readers</span>
                </div>

            </div>

            <div class="books-stat-item">

                <div class="books-stat-icon">
                    <i class="bi bi-tags"></i>
                </div>

                <div>
                    <strong>Great Value</strong>
                    <span>Affordable Books</span>
                </div>

            </div>

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

</section>


<section class="books-section" id="books-collection">

    <div class="container">

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


            <form
                action="{{ route('frontend.books') }}"
                method="GET"
                class="books-filter-form"
                id="books-filter-form"
            >

                @if(request()->filled('category'))
                    <input
                        type="hidden"
                        name="category"
                        value="{{ request('category') }}"
                    >
                @endif


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


                <div class="books-filter-actions">

                    <button
                        type="submit"
                        class="books-filter-btn"
                        id="books-search-btn"
                    >
                        <i class="bi bi-search"></i>
                        <span>Search</span>
                    </button>

                    @if(request()->hasAny(['search', 'condition', 'sort', 'category']))

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


        {{-- RESULTS --}}

        <div class="books-results-header" id="available-books">

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


        @if($books->count())

            <div class="row g-4">

                @foreach($books as $book)

                    @php
                        $bookCoverUrl = null;

                        if (!empty($book->cover)) {
                            $bookCoverUrl = filter_var(
                                $book->cover,
                                FILTER_VALIDATE_URL
                            )
                                ? $book->cover
                                : asset('storage/' . $book->cover);
                        }
                    @endphp


                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                        <article class="book-card">

                            {{-- COVER --}}

                            <div class="book-cover">

                                @if($bookCoverUrl)

                                    <img
                                        src="{{ $bookCoverUrl }}"
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
                                            data-wishlist-form
                                            data-action="remove"
                                            data-add-url="{{ route('frontend.wishlist.add', $book->id) }}"
                                            data-remove-url="{{ route('frontend.wishlist.remove', $book->id) }}"
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
                                            data-wishlist-form
                                            data-action="add"
                                            data-add-url="{{ route('frontend.wishlist.add', $book->id) }}"
                                            data-remove-url="{{ route('frontend.wishlist.remove', $book->id) }}"
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

                                        <a
                                            href="{{ route('frontend.books.show', $book->id) }}"
                                            class="book-view-btn"
                                        >
                                            View
                                            <i class="bi bi-arrow-right"></i>
                                        </a>


                                        @auth

                                            @if(
                                                $book->stock > 0 &&
                                                $book->status === 'approved'
                                            )

                                                <form
                                                    action="{{ route('frontend.cart.add', $book->id) }}"
                                                    method="POST"
                                                    class="book-cart-form"
                                                    data-cart-form
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


            @if($books->hasPages())

                <div class="books-pagination">
                    {{ $books->withQueryString()->links() }}
                </div>

            @endif

        @else

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

</section>


<section class="books-sell-section">

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

                <a href="#" class="books-sell-btn">
                    Sell Your Books
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>

</section>



@push('js')

<script>
(function () {

    "use strict";


    /* =========================================================
       CART ALERT
    ========================================================= */

    function showCartAlert() {

        let alert =
            document.getElementById('cart-success-alert');

        if (!alert) {

            alert = document.createElement('div');

            alert.id = 'cart-success-alert';

            alert.className = 'cart-success-alert';

            alert.innerHTML = `
                <div class="cart-alert-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <div class="cart-alert-content">
                    <strong>Success</strong>
                    <span>Book added to cart successfully!</span>
                </div>

                <button
                    type="button"
                    class="cart-alert-close"
                    aria-label="Close"
                >
                    <i class="bi bi-x"></i>
                </button>
            `;

            document.body.appendChild(alert);

            const closeButton =
                alert.querySelector('.cart-alert-close');

            if (closeButton) {

                closeButton.addEventListener(
                    'click',
                    function () {
                        hideCartAlert();
                    }
                );

            }

        }

        alert.classList.add('is-visible');

        clearTimeout(window.cartAlertTimeout);

        window.cartAlertTimeout =
            setTimeout(function () {
                hideCartAlert();
            }, 3000);

    }


    function hideCartAlert() {

        const alert =
            document.getElementById('cart-success-alert');

        if (!alert) {
            return;
        }

        alert.classList.remove('is-visible');

    }


    /* =========================================================
       WISHLIST
    ========================================================= */

    function initWishlist() {

        const wishlistForms =
            document.querySelectorAll(
                '[data-wishlist-form]'
            );

        wishlistForms.forEach(function (form) {

            if (form.dataset.ajaxReady === 'true') {
                return;
            }

            form.dataset.ajaxReady = 'true';

            form.addEventListener(
                'submit',
                async function (event) {

                    event.preventDefault();

                    const button =
                        form.querySelector('button');

                    const icon =
                        form.querySelector('i');

                    if (!button) {
                        return;
                    }

                    const isActive =
                        button.classList.contains('active') ||
                        form.dataset.active === 'true';

                    const addUrl =
                        form.dataset.addUrl;

                    const removeUrl =
                        form.dataset.removeUrl;

                    const url =
                        isActive
                            ? removeUrl
                            : addUrl;

                    if (!url) {
                        return;
                    }

                    const csrfToken =
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        )?.getAttribute('content');

                    try {

                        button.disabled = true;

                        const response =
                            await fetch(url, {

                                method:
                                    isActive
                                        ? 'DELETE'
                                        : 'POST',

                                headers: {

                                    'X-CSRF-TOKEN':
                                        csrfToken,

                                    'X-Requested-With':
                                        'XMLHttpRequest',

                                    'Accept':
                                        'application/json'
                                }

                            });


                        const data =
                            await response.json();


                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                'Something went wrong.'
                            );

                        }


                        if (
                            data.status === 'success' ||
                            data.success === true
                        ) {

                            if (isActive) {

                                button.classList.remove(
                                    'active'
                                );

                                form.dataset.active =
                                    'false';


                                if (icon) {

                                    icon.classList.remove(
                                        'bi-heart-fill'
                                    );

                                    icon.classList.add(
                                        'bi-heart'
                                    );

                                }


                                form.setAttribute(
                                    'action',
                                    addUrl
                                );


                                let methodInput =
                                    form.querySelector(
                                        'input[name="_method"]'
                                    );

                                if (methodInput) {
                                    methodInput.remove();
                                }

                            } else {

                                button.classList.add(
                                    'active'
                                );

                                form.dataset.active =
                                    'true';


                                if (icon) {

                                    icon.classList.remove(
                                        'bi-heart'
                                    );

                                    icon.classList.add(
                                        'bi-heart-fill'
                                    );

                                }


                                form.setAttribute(
                                    'action',
                                    removeUrl
                                );


                                let methodInput =
                                    form.querySelector(
                                        'input[name="_method"]'
                                    );

                                if (!methodInput) {

                                    methodInput =
                                        document.createElement(
                                            'input'
                                        );

                                    methodInput.type =
                                        'hidden';

                                    methodInput.name =
                                        '_method';

                                    methodInput.value =
                                        'DELETE';

                                    form.appendChild(
                                        methodInput
                                    );

                                }

                            }

                        }

                    } catch (error) {

                        console.error(
                            'Wishlist error:',
                            error
                        );

                    } finally {

                        button.disabled = false;

                    }

                }
            );

        });

    }


    /* =========================================================
       CART
    ========================================================= */

    function initCart() {

        const cartForms =
            document.querySelectorAll(
                '[data-cart-form]'
            );

        cartForms.forEach(function (form) {

            if (form.dataset.ajaxReady === 'true') {
                return;
            }

            form.dataset.ajaxReady = 'true';

            form.addEventListener(
                'submit',
                async function (event) {

                    event.preventDefault();

                    const button =
                        form.querySelector(
                            'button[type="submit"]'
                        );

                    if (!button) {
                        return;
                    }

                    const originalHtml =
                        button.innerHTML;

                    const csrfToken =
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        )?.getAttribute('content');

                    try {

                        button.disabled = true;

                        const formData =
                            new FormData(form);


                        const response =
                            await fetch(
                                form.getAttribute(
                                    'action'
                                ),
                                {
                                    method: 'POST',

                                    headers: {

                                        'X-CSRF-TOKEN':
                                            csrfToken,

                                        'X-Requested-With':
                                            'XMLHttpRequest',

                                        'Accept':
                                            'application/json'
                                    },

                                    body: formData
                                }
                            );


                        const data =
                            await response.json();


                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                'Unable to add book to cart.'
                            );

                        }


                        const cartCount =
                            document.getElementById(
                                'header-cart-count'
                            );


                        if (
                            cartCount &&
                            data.cart_count !== undefined
                        ) {

                            cartCount.textContent =
                                data.cart_count;

                            cartCount.classList.add(
                                'is-visible'
                            );

                        }


                        showCartAlert();

                    } catch (error) {

                        console.error(
                            'Cart error:',
                            error
                        );

                    } finally {

                        button.disabled = false;

                        button.innerHTML =
                            originalHtml;

                    }

                }
            );

        });

    }


    /* =========================================================
       SCROLL TO AVAILABLE BOOKS
    ========================================================= */

    function scrollToAvailableBooks() {

        const availableBooks =
            document.getElementById(
                'available-books'
            );

        if (!availableBooks) {
            return;
        }

        const offset = 30;

        const position =
            availableBooks.getBoundingClientRect().top +
            window.pageYOffset -
            offset;

        window.scrollTo({

            top: position,

            behavior: 'smooth'

        });

    }


    /* =========================================================
       SCROLL TO SEARCH
    ========================================================= */

    function scrollToSearch() {

        const searchSection =
            document.getElementById(
                'books-filter-form'
            );

        if (!searchSection) {
            return;
        }

        const offset = 30;

        const position =
            searchSection.getBoundingClientRect().top +
            window.pageYOffset -
            offset;

        window.scrollTo({

            top: position,

            behavior: 'smooth'

        });

    }


    /* =========================================================
       BOOKS FILTER AJAX
    ========================================================= */

    function initBooksFilter() {

        const filterForm =
            document.getElementById(
                'books-filter-form'
            );

        if (!filterForm) {
            return;
        }

        if (filterForm.dataset.ajaxReady === 'true') {
            return;
        }

        filterForm.dataset.ajaxReady = 'true';


        const currentCollection =
            document.getElementById(
                'books-collection'
            );

        if (!currentCollection) {
            return;
        }


        /* =====================================================
           SEARCH
        ===================================================== */

        filterForm.addEventListener(
            'submit',
            async function (event) {

                event.preventDefault();


                const formData =
                    new FormData(filterForm);


                const params =
                    new URLSearchParams();


                formData.forEach(function (value, key) {

                    if (
                        value !== null &&
                        value !== ''
                    ) {

                        params.append(
                            key,
                            value
                        );

                    }

                });


                const baseUrl =
                    filterForm.getAttribute(
                        'action'
                    );


                const queryString =
                    params.toString();


                const url =
                    queryString
                        ? `${baseUrl}?${queryString}`
                        : baseUrl;


                try {

                    currentCollection.classList.add(
                        'is-loading'
                    );


                    const response =
                        await fetch(url, {

                            method: 'GET',

                            headers: {

                                'X-Requested-With':
                                    'XMLHttpRequest',

                                'Accept':
                                    'text/html'

                            }

                        });


                    if (!response.ok) {

                        throw new Error(
                            'Failed to load books.'
                        );

                    }


                    const html =
                        await response.text();


                    const parser =
                        new DOMParser();


                    const documentHtml =
                        parser.parseFromString(
                            html,
                            'text/html'
                        );


                    const newCollection =
                        documentHtml.getElementById(
                            'books-collection'
                        );


                    if (!newCollection) {

                        throw new Error(
                            'Books collection not found.'
                        );

                    }


                    currentCollection.innerHTML =
                        newCollection.innerHTML;


                    window.history.pushState(
                        {},
                        '',
                        url
                    );


                    initWishlist();

                    initCart();

                    initBooksFilter();


                    requestAnimationFrame(
                        function () {

                            scrollToAvailableBooks();

                        }
                    );


                } catch (error) {

                    console.error(
                        'Books filter error:',
                        error
                    );

                } finally {

                    currentCollection.classList.remove(
                        'is-loading'
                    );

                }

            }
        );


        /* =====================================================
           CLEAR FILTERS
        ===================================================== */

        const clearButton =
            currentCollection.querySelector(
                '.books-clear-filter'
            );


        if (clearButton) {

            clearButton.addEventListener(
                'click',
                async function (event) {

                    event.preventDefault();


                    const clearUrl =
                        clearButton.getAttribute(
                            'href'
                        );


                    if (!clearUrl) {
                        return;
                    }


                    try {

                        currentCollection.classList.add(
                            'is-loading'
                        );


                        const response =
                            await fetch(
                                clearUrl,
                                {

                                    method: 'GET',

                                    headers: {

                                        'X-Requested-With':
                                            'XMLHttpRequest',

                                        'Accept':
                                            'text/html'

                                    }

                                }
                            );


                        if (!response.ok) {

                            throw new Error(
                                'Failed to clear filters.'
                            );

                        }


                        const html =
                            await response.text();


                        const parser =
                            new DOMParser();


                        const documentHtml =
                            parser.parseFromString(
                                html,
                                'text/html'
                            );


                        const newCollection =
                            documentHtml.getElementById(
                                'books-collection'
                            );


                        if (!newCollection) {

                            throw new Error(
                                'Books collection not found.'
                            );

                        }


                        currentCollection.innerHTML =
                            newCollection.innerHTML;


                        window.history.pushState(
                            {},
                            '',
                            clearUrl
                        );


                        initWishlist();

                        initCart();

                        initBooksFilter();


                        requestAnimationFrame(
                            function () {

                                scrollToSearch();

                            }
                        );


                    } catch (error) {

                        console.error(
                            'Clear filters error:',
                            error
                        );

                    } finally {

                        currentCollection.classList.remove(
                            'is-loading'
                        );

                    }

                }
            );

        }

    }


    /* =========================================================
       BROWSER BACK / FORWARD
    ========================================================= */

    window.addEventListener(
        'popstate',
        function () {

            window.location.reload();

        }
    );


    /* =========================================================
       INITIALIZE
    ========================================================= */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            initWishlist();

            initCart();

            initBooksFilter();


            /* =================================================
               AUTO SEARCH FROM CATEGORY
            ================================================= */

            const searchInput =
                document.getElementById(
                    'book-search'
                );

            const urlParams =
                new URLSearchParams(
                    window.location.search
                );


            if (
                searchInput &&
                urlParams.has('search') &&
                urlParams.get('search') !== ''
            ) {

                setTimeout(function () {

                    const form =
                        searchInput.closest('form');

                    if (form) {

                        form.dispatchEvent(
                            new Event(
                                'submit',
                                {
                                    bubbles: true,
                                    cancelable: true
                                }
                            )
                        );

                    }

                }, 100);

            }

        }
    );

})();
</script>

@endpush





@endsection