@extends('Layout.Frontend.master')

@section('title', 'Write a Review | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/review.css') }}">
@endpush

@section('content')

<div class="review-page">

    <div class="review-container">

        {{-- Back --}}
        <div class="review-back">
            <a href="{{ route('frontend.orders.show', $order->id) }}">
                <i class="bi bi-arrow-left"></i>
                <span>Back to Order Details</span>
            </a>
        </div>


        {{-- Header --}}
        <div class="review-heading">

            <div class="review-heading-icon">
                <i class="bi bi-star"></i>
            </div>

            <div>
                <h1>Write a Review</h1>
                <p>
                    Share your experience with this book
                </p>
            </div>

        </div>


        {{-- Review Card --}}
        <div class="review-card">

            {{-- Book --}}
            <div class="review-book">

                <div class="review-book-cover">

                    @if($order->book->cover)

                        @php
                            $cover = $order->book->cover;

                            if (
                                str_starts_with($cover, 'http://') ||
                                str_starts_with($cover, 'https://')
                            ) {
                                $coverUrl = $cover;
                            } elseif (
                                str_starts_with($cover, 'storage/')
                            ) {
                                $coverUrl = asset($cover);
                            } else {
                                $coverUrl = asset('storage/' . $cover);
                            }
                        @endphp

                        <img
                            src="{{ $coverUrl }}"
                            alt="{{ $order->book->title }}"
                        >

                    @else

                        <div class="review-book-placeholder">
                            <i class="bi bi-book"></i>
                        </div>

                    @endif

                </div>


                <div class="review-book-info">

                    <span class="review-book-label">
                        REVIEWING
                    </span>

                    <h2>
                        {{ $order->book->title }}
                    </h2>

                    @if($order->book->author)
                        <p>
                            by {{ $order->book->author->name }}
                        </p>
                    @endif

                    <div class="review-order-number">
                        <i class="bi bi-receipt"></i>
                        Order #{{ $order->order_number }}
                    </div>

                </div>

            </div>


            {{-- Divider --}}
            <div class="review-divider"></div>


            {{-- Form --}}
            <form
                action="{{ route('frontend.reviews.store', $order->id) }}"
                method="POST"
            >

                @csrf


                {{-- Rating --}}
                <div class="review-form-group">

                    <label class="review-label">
                        Your Rating
                    </label>

                    <p class="review-help">
                        How would you rate this book?
                    </p>


                    <div class="rating-wrapper">

                        <div class="rating-stars">

                            @for($rating = 5; $rating >= 1; $rating--)

                                <input
                                    type="radio"
                                    name="rating"
                                    id="rating-{{ $rating }}"
                                    value="{{ $rating }}"
                                    {{ old('rating') == $rating ? 'checked' : '' }}
                                >

                                <label
                                    for="rating-{{ $rating }}"
                                    title="{{ $rating }} {{ $rating == 1 ? 'star' : 'stars' }}"
                                >
                                    <i class="bi bi-star-fill"></i>
                                </label>

                            @endfor

                        </div>

                        <span class="rating-text" id="ratingText">
                            Select a rating
                        </span>

                    </div>

                    @error('rating')
                        <div class="review-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Comment --}}
                <div class="review-form-group">

                    <div class="review-label-row">

                        <label
                            for="comment"
                            class="review-label"
                        >
                            Your Review
                        </label>

                        <span class="review-counter">
                            <span id="commentCount">0</span>/2000
                        </span>

                    </div>

                    <p class="review-help">
                        Tell other readers what you think about this book.
                    </p>

                    <textarea
                        name="comment"
                        id="comment"
                        class="review-textarea"
                        rows="7"
                        maxlength="2000"
                        placeholder="Write your thoughts about this book..."
                    >{{ old('comment') }}</textarea>

                    @error('comment')
                        <div class="review-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Notice --}}
                <div class="review-notice">

                    <div class="review-notice-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <div>
                        <strong>Review moderation</strong>

                        <p>
                            Your review will be submitted for approval
                            before it becomes visible to other users.
                        </p>
                    </div>

                </div>


                {{-- Actions --}}
                <div class="review-actions">

                    <a
                        href="{{ route('frontend.orders.show', $order->id) }}"
                        class="review-cancel"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="review-submit"
                    >
                        <i class="bi bi-send"></i>
                        <span>Submit Review</span>
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection


@push('js')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ratingInputs = document.querySelectorAll(
        '.rating-stars input'
    );

    const ratingText = document.getElementById(
        'ratingText'
    );

    const comment = document.getElementById(
        'comment'
    );

    const commentCount = document.getElementById(
        'commentCount'
    );


    const ratingLabels = {
        1: 'Very poor',
        2: 'Poor',
        3: 'Average',
        4: 'Good',
        5: 'Excellent'
    };


    ratingInputs.forEach(function (input) {

        input.addEventListener('change', function () {

            ratingText.textContent =
                ratingLabels[this.value];

        });

    });


    const checkedRating = document.querySelector(
        '.rating-stars input:checked'
    );

    if (checkedRating) {

        ratingText.textContent =
            ratingLabels[checkedRating.value];

    }


    function updateCommentCount() {

        commentCount.textContent =
            comment.value.length;

    }


    comment.addEventListener(
        'input',
        updateCommentCount
    );

    updateCommentCount();

});
</script>

@endpush