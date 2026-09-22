@extends('Layout.Seller.master')

@section('title', 'Reviews')

@push('css')
    <link rel="stylesheet" href="{{ asset('seller/css/reviews.css') }}">
@endpush

@section('content')

<div class="seller-reviews-page">

    {{-- Page Header --}}
    <div class="seller-page-heading">

        <div>
            <h1>Reviews</h1>
            <p>Monitor customer reviews and ratings for your books.</p>
        </div>

    </div>


    {{-- Statistics --}}
    <div class="seller-reviews-stats">

        <div class="seller-reviews-stat-card">

            <div class="seller-reviews-stat-icon reviews">
                <i class="bi bi-chat-square-text"></i>
            </div>

            <div class="seller-reviews-stat-content">
                <span>Total Reviews</span>
                <h3>{{ $totalReviews }}</h3>
            </div>

        </div>


        <div class="seller-reviews-stat-card">

            <div class="seller-reviews-stat-icon rating">
                <i class="bi bi-star-fill"></i>
            </div>

            <div class="seller-reviews-stat-content">
                <span>Average Rating</span>

                <h3>
                    {{ $averageRating ? number_format($averageRating, 1) : '0.0' }}
                </h3>
            </div>

        </div>


        <div class="seller-reviews-stat-card">

            <div class="seller-reviews-stat-icon five">
                <i class="bi bi-stars"></i>
            </div>

            <div class="seller-reviews-stat-content">
                <span>5 Star Reviews</span>
                <h3>{{ $fiveStarReviews }}</h3>
            </div>

        </div>


        <div class="seller-reviews-stat-card">

            <div class="seller-reviews-stat-icon one">
                <i class="bi bi-star"></i>
            </div>

            <div class="seller-reviews-stat-content">
                <span>1 Star Reviews</span>
                <h3>{{ $oneStarReviews }}</h3>
            </div>

        </div>

    </div>


    {{-- Reviews Panel --}}
    <div class="seller-reviews-panel">

        <div class="seller-reviews-panel-header">

            <div>
                <h5>Customer Reviews</h5>
                <p>See what buyers think about your books.</p>
            </div>

            <div class="seller-reviews-count">
                {{ $reviews->total() }} reviews
            </div>

        </div>


        {{-- Filters --}}
        <div class="seller-reviews-filter">

            <form
                action="{{ route('seller.reviews.index') }}"
                method="GET"
            >

                <div class="seller-reviews-search">

                    <div class="seller-reviews-search-input">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search reviews..."
                        >

                    </div>


                    <select
                        name="rating"
                        class="seller-reviews-rating-select"
                    >
                        <option value="">All Ratings</option>

                        <option
                            value="5"
                            {{ request('rating') == '5' ? 'selected' : '' }}
                        >
                            5 Stars
                        </option>

                        <option
                            value="4"
                            {{ request('rating') == '4' ? 'selected' : '' }}
                        >
                            4 Stars
                        </option>

                        <option
                            value="3"
                            {{ request('rating') == '3' ? 'selected' : '' }}
                        >
                            3 Stars
                        </option>

                        <option
                            value="2"
                            {{ request('rating') == '2' ? 'selected' : '' }}
                        >
                            2 Stars
                        </option>

                        <option
                            value="1"
                            {{ request('rating') == '1' ? 'selected' : '' }}
                        >
                            1 Star
                        </option>
                    </select>


                    <button
                        type="submit"
                        class="seller-reviews-search-button"
                    >
                        <i class="bi bi-search"></i>
                        Search
                    </button>


                    @if(request()->filled('search') || request()->filled('rating'))

                        <a
                            href="{{ route('seller.reviews.index') }}"
                            class="seller-reviews-reset-button"
                        >
                            <i class="bi bi-arrow-counterclockwise"></i>
                            Reset
                        </a>

                    @endif

                </div>

            </form>

        </div>


        {{-- Reviews --}}
        @if($reviews->count())

            <div class="table-responsive">

                <table class="seller-reviews-table">

                    <thead>

                        <tr>
                            <th>Book</th>
                            <th>Buyer</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Date</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach($reviews as $review)

                            <tr>

                                {{-- Book --}}
                                <td>

                                    <div class="seller-review-book">

                                        <div class="seller-review-book-cover">

                                            @if($review->book && $review->book->cover)

                                                <img
                                                    src="{{ asset('storage/' . $review->book->cover) }}"
                                                    alt="{{ $review->book->title }}"
                                                >

                                            @else

                                                <i class="bi bi-book"></i>

                                            @endif

                                        </div>


                                        <div class="seller-review-book-info">

                                            <strong>
                                                {{ $review->book->title ?? 'Deleted Book' }}
                                            </strong>

                                            @if($review->book && $review->book->author)

                                                <span>
                                                    {{ $review->book->author->name }}
                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Buyer --}}
                                <td>

                                    <div class="seller-review-buyer">

                                        <div class="seller-review-buyer-avatar">

                                            {{
                                                strtoupper(
                                                    substr(
                                                        $review->user->name
                                                        ?? $review->user->first_name
                                                        ?? 'U',
                                                        0,
                                                        1
                                                    )
                                                )
                                            }}

                                        </div>


                                        <div class="seller-review-buyer-info">

                                            <strong>
                                                {{ $review->user->name
                                                    ?? trim(
                                                        ($review->user->first_name ?? '')
                                                        . ' '
                                                        . ($review->user->last_name ?? '')
                                                    )
                                                    ?: 'Unknown Buyer'
                                                }}
                                            </strong>

                                            <span>
                                                {{ $review->user->email ?? 'No email' }}
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- Rating --}}
                                <td>

                                    <div class="seller-review-rating">

                                        <div class="seller-review-stars">

                                            @for($i = 1; $i <= 5; $i++)

                                                <i
                                                    class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"
                                                ></i>

                                            @endfor

                                        </div>

                                        <span>
                                            {{ $review->rating }}.0
                                        </span>

                                    </div>

                                </td>


                                {{-- Comment --}}
                                <td>

                                    <div class="seller-review-comment">

                                        @if($review->comment)

                                            <p>
                                                {{ $review->comment }}
                                            </p>

                                        @else

                                            <span class="seller-review-no-comment">
                                                No comment provided
                                            </span>

                                        @endif

                                    </div>

                                </td>


                                {{-- Date --}}
                                <td>

                                    <div class="seller-review-date">

                                        <strong>
                                            {{ $review->created_at->format('M d, Y') }}
                                        </strong>

                                        <span>
                                            {{ $review->created_at->format('H:i') }}
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if($reviews->hasPages())

                <div class="seller-reviews-pagination">

                    {{ $reviews->links() }}

                </div>

            @endif


        @else

            <div class="seller-reviews-empty">

                <div class="seller-reviews-empty-icon">
                    <i class="bi bi-star"></i>
                </div>

                <h5>No Reviews Found</h5>

                <p>
                    There are no customer reviews matching your search.
                </p>


                @if(request()->filled('search') || request()->filled('rating'))

                    <a
                        href="{{ route('seller.reviews.index') }}"
                        class="seller-reviews-empty-button"
                    >
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Clear Filters
                    </a>

                @endif

            </div>

        @endif

    </div>

</div>

@endsection