@extends('Layout.Frontend.master')

@section('title', 'My Wishlist | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/wishlist.css') }}">
@endpush

@section('content')

<main class="sb-wishlist-page">

    {{-- HERO --}}
    <section class="wishlist-hero">
        <div class="container">

            <div class="wishlist-breadcrumb">
                <a href="{{ route('frontend.home') }}">
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>Wishlist</span>
            </div>

            <div class="wishlist-hero-content">

                <span class="wishlist-eyebrow">
                    <i class="bi bi-heart"></i>
                    Your Collection
                </span>

                <h1>My Wishlist</h1>

                <p>
                    Keep track of the books you love and come back
                    whenever you are ready.
                </p>

            </div>

        </div>
    </section>


    {{-- CONTENT --}}
    <section class="wishlist-section">
        <div class="container">

            {{-- ALERTS --}}
            @if(session('success'))
                <div class="wishlist-alert success">
                    <i class="bi bi-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="wishlist-alert error">
                    <i class="bi bi-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif


            @if($wishlists->count())

                <div class="wishlist-topbar">

                    <div>
                        <span class="wishlist-count-label">
                            SAVED BOOKS
                        </span>

                        <h2>
                            {{ $wishlists->total() }}
                            {{ $wishlists->total() === 1 ? 'Book' : 'Books' }}
                        </h2>
                    </div>

                    <a
                        href="{{ route('frontend.books') }}"
                        class="wishlist-browse-btn"
                    >
                        <i class="bi bi-book"></i>
                        Browse Books
                    </a>

                </div>


                <div class="wishlist-grid">

                    @foreach($wishlists as $wishlist)

                        @php
                            $book = $wishlist->book;
                        @endphp

                        @if($book)

                            <article class="wishlist-card">

                                {{-- COVER --}}
                                <div class="wishlist-cover">

                                    @if($book->cover)
                                        <img
                                            src="{{ asset('storage/' . $book->cover) }}"
                                            alt="{{ $book->title }}"
                                        >
                                    @else
                                        <div class="wishlist-no-cover">
                                            <i class="bi bi-book"></i>
                                        </div>
                                    @endif

                                    <span class="wishlist-heart">
                                        <i class="bi bi-heart-fill"></i>
                                    </span>

                                </div>


                                {{-- CONTENT --}}
                                <div class="wishlist-card-content">

                                    <div class="wishlist-category">
                                        {{ $book->category->name ?? 'Book' }}
                                    </div>

                                    <h3>
                                        {{ $book->title }}
                                    </h3>

                                    @if($book->author)
                                        <p class="wishlist-author">
                                            <i class="bi bi-person"></i>
                                            {{ $book->author->name }}
                                        </p>
                                    @endif


                                    <div class="wishlist-bottom">

                                        <strong class="wishlist-price">
                                            ${{ number_format($book->price, 2) }}
                                        </strong>

                                        @if($book->stock > 0)
                                            <span class="wishlist-stock available">
                                                In Stock
                                            </span>
                                        @else
                                            <span class="wishlist-stock unavailable">
                                                Out of Stock
                                            </span>
                                        @endif

                                    </div>


                                    <div class="wishlist-actions">

                                        <a
                                            href="{{ route('frontend.books') }}?search={{ urlencode($book->title) }}"
                                            class="wishlist-view-btn"
                                        >
                                            <i class="bi bi-eye"></i>
                                            View Book
                                        </a>

                                        <form
                                            action="{{ route('frontend.wishlist.remove', $book->id) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="wishlist-remove-btn"
                                                aria-label="Remove from wishlist"
                                            >
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>

                                    </div>

                                </div>

                            </article>

                        @endif

                    @endforeach

                </div>


                {{-- PAGINATION --}}
                @if($wishlists->hasPages())
                    <div class="wishlist-pagination">
                        {{ $wishlists->links() }}
                    </div>
                @endif


            @else

                {{-- EMPTY --}}
                <div class="wishlist-empty">

                    <div class="wishlist-empty-icon">
                        <i class="bi bi-heart"></i>
                    </div>

                    <span>YOUR WISHLIST</span>

                    <h2>Your wishlist is empty</h2>

                    <p>
                        Save books you love and they will appear here
                        for you to find later.
                    </p>

                    <a
                        href="{{ route('frontend.books') }}"
                        class="wishlist-empty-btn"
                    >
                        <i class="bi bi-book"></i>
                        Explore Books
                    </a>

                </div>

            @endif

        </div>
    </section>

</main>

@endsection