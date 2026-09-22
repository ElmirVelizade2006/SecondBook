@extends('layout.admin.master')

@section('title', 'Reviews')

@section('content')

<div class="dashboard-section reviews-page">

    {{-- Header --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Reviews</h5>

                <p class="text-muted mb-0 small">
                    Manage customer reviews and feedback on SecondBook
                </p>
            </div>

        </div>

    </div>


    {{-- Statistics --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="dashboard-panel review-stat-card h-100">

                <div class="d-flex align-items-center gap-3">

                    <div class="review-stat-icon">
                        <i class="bi bi-chat-square-text"></i>
                    </div>

                    <div>
                        <small class="text-muted d-block">
                            Total Reviews
                        </small>

                        <strong class="fs-4">
                            {{ $totalReviews }}
                        </strong>
                    </div>

                </div>

            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="dashboard-panel review-stat-card h-100">

                <div class="d-flex align-items-center gap-3">

                    <div class="review-stat-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>

                    <div>
                        <small class="text-muted d-block">
                            Pending
                        </small>

                        <strong class="fs-4">
                            {{ $pendingReviews }}
                        </strong>
                    </div>

                </div>

            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="dashboard-panel review-stat-card h-100">

                <div class="d-flex align-items-center gap-3">

                    <div class="review-stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>

                    <div>
                        <small class="text-muted d-block">
                            Approved
                        </small>

                        <strong class="fs-4">
                            {{ $approvedReviews }}
                        </strong>
                    </div>

                </div>

            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="dashboard-panel review-stat-card h-100">

                <div class="d-flex align-items-center gap-3">

                    <div class="review-stat-icon">
                        <i class="bi bi-x-circle"></i>
                    </div>

                    <div>
                        <small class="text-muted d-block">
                            Rejected
                        </small>

                        <strong class="fs-4">
                            {{ $rejectedReviews }}
                        </strong>
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Filters --}}
    <div class="dashboard-panel mb-4">

        <form
            method="GET"
            action="{{ route('admin.reviews.index') }}"
            class="row g-3 align-items-end"
        >

            {{-- Search --}}
            <div class="col-12 col-md-5 col-lg-5">

                <label class="form-label small text-muted fw-semibold">
                    Search
                </label>

                <div class="input-group">

                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-start-0"
                        placeholder="User, email, book or review..."
                    >

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Search
                    </button>

                </div>

            </div>


            {{-- Status --}}
            <div class="col-6 col-md-3 col-lg-2">

                <label class="form-label small text-muted fw-semibold">
                    Status
                </label>

                <select
                    name="status"
                    class="form-select"
                >

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="approved"
                        @selected(request('status') === 'approved')
                    >
                        Approved
                    </option>

                    <option
                        value="pending"
                        @selected(request('status') === 'pending')
                    >
                        Pending
                    </option>

                    <option
                        value="rejected"
                        @selected(request('status') === 'rejected')
                    >
                        Rejected
                    </option>

                </select>

            </div>


            {{-- Rating --}}
            <div class="col-6 col-md-3 col-lg-2">

                <label class="form-label small text-muted fw-semibold">
                    Rating
                </label>

                <select
                    name="rating"
                    class="form-select"
                >

                    <option value="">
                        All Ratings
                    </option>

                    @for($rating = 5; $rating >= 1; $rating--)

                        <option
                            value="{{ $rating }}"
                            @selected(
                                (string) request('rating') === (string) $rating
                            )
                        >
                            {{ $rating }} Stars
                        </option>

                    @endfor

                </select>

            </div>


            {{-- Actions --}}
            <div class="col-12 col-lg-3 d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-primary flex-grow-1 flex-lg-grow-0 px-4"
                >
                    <i class="bi bi-funnel me-1"></i>
                    Filter
                </button>

                <a
                    href="{{ route('admin.reviews.index') }}"
                    class="btn btn-light border"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- Reviews Table --}}
    <div class="dashboard-panel">

        <div class="panel-header">

            <h5>
                Review List
            </h5>

            <span class="badge bg-primary">
                {{ $reviews->total() }} reviews
            </span>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>
                            Customer
                        </th>

                        <th class="d-none d-md-table-cell">
                            Book
                        </th>

                        <th>
                            Rating
                        </th>

                        <th class="d-none d-lg-table-cell">
                            Review
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="d-none d-xl-table-cell">
                            Date
                        </th>

                        <th class="text-end">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($reviews as $key => $review)

                        <tr>

                            {{-- Number --}}
                            <td>
                                {{ $reviews->firstItem() + $key }}
                            </td>


                            {{-- Customer --}}
                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <div class="review-avatar">

                                        @if($review->user?->profile_photo)

                                            <img
                                                src="{{ asset('storage/' . $review->user->profile_photo) }}"
                                                alt="{{ $review->user->name }}"
                                            >

                                        @else

                                            {{ strtoupper(
                                                substr(
                                                    $review->user?->name ?? 'U',
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        @endif

                                    </div>

                                    <div>

                                        <strong class="d-block">
                                            {{ $review->user?->name ?? 'Unknown User' }}
                                        </strong>

                                        <small class="text-muted">
                                            {{ $review->user?->email ?? '-' }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- Book --}}
                            <td class="d-none d-md-table-cell">

                                <div class="d-flex align-items-center gap-2">

                                    @if($review->book?->cover)

                                        @php
                                            $cover = $review->book->cover;

                                            $coverUrl = filter_var(
                                                $cover,
                                                FILTER_VALIDATE_URL
                                            )
                                                ? $cover
                                                : asset('storage/' . $cover);
                                        @endphp

                                        <img
                                            src="{{ $coverUrl }}"
                                            alt="{{ $review->book->title }}"
                                            class="review-book-cover"
                                            loading="lazy"
                                        >

                                    @else

                                        <div class="review-book-placeholder">
                                            <i class="bi bi-book"></i>
                                        </div>

                                    @endif

                                    <div>

                                        <strong class="d-block">
                                            {{ $review->book?->title ?? 'Deleted Book' }}
                                        </strong>

                                        <small class="text-muted">
                                            {{ $review->book?->author?->name ?? '-' }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- Rating --}}
                            <td>

                                <div class="review-rating">

                                    <div class="review-stars">

                                        @for($star = 1; $star <= 5; $star++)

                                            @if($star <= $review->rating)

                                                <i class="bi bi-star-fill"></i>

                                            @else

                                                <i class="bi bi-star"></i>

                                            @endif

                                        @endfor

                                    </div>

                                    <small class="text-muted">
                                        {{ $review->rating }}/5
                                    </small>

                                </div>

                            </td>


                            {{-- Review --}}
                            <td class="d-none d-lg-table-cell">

                                @if($review->comment)

                                    <div class="review-comment-preview">
                                        {{ \Illuminate\Support\Str::limit(
                                            $review->comment,
                                            70
                                        ) }}
                                    </div>

                                @else

                                    <span class="text-muted">
                                        No comment
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($review->status === 'approved')

                                    <span class="badge bg-success">
                                        Approved
                                    </span>

                                @elseif($review->status === 'pending')

                                    <span class="badge bg-warning">
                                        Pending
                                    </span>

                                @elseif($review->status === 'rejected')

                                    <span class="badge bg-danger">
                                        Rejected
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Unknown
                                    </span>

                                @endif

                            </td>


                            {{-- Date --}}
                            <td class="d-none d-xl-table-cell">

                                <span class="text-muted small">

                                    {{ $review->created_at->format('M d, Y') }}

                                </span>

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex justify-content-end gap-2">


                                    {{-- View --}}
                                    <a
                                        href="{{ route('admin.reviews.show', $review->id) }}"
                                        class="btn btn-light btn-sm border"
                                        title="View"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    {{-- Approve --}}
                                    @if($review->status !== 'approved')

                                        <form
                                            action="{{ route('admin.reviews.approve', $review->id) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-success btn-sm"
                                                title="Approve"
                                            >
                                                <i class="bi bi-check-lg"></i>
                                            </button>

                                        </form>

                                    @endif


                                    {{-- Reject --}}
                                    @if($review->status !== 'rejected')

                                        <form
                                            action="{{ route('admin.reviews.reject', $review->id) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-warning btn-sm"
                                                title="Reject"
                                            >
                                                <i class="bi bi-x-lg"></i>
                                            </button>

                                        </form>

                                    @endif


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.reviews.destroy', $review->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this review?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Delete"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5"
                            >

                                <div class="chart-placeholder reviews-empty-state">

                                    <i class="bi bi-chat-square-text"></i>

                                    <h6>
                                        No reviews found
                                    </h6>

                                    <p>
                                        There are no reviews matching your current filters.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($reviews->hasPages())

            <div class="reviews-pagination">

                <div class="reviews-pagination-info">

                    Showing

                    <strong>
                        {{ $reviews->firstItem() }}
                    </strong>

                    to

                    <strong>
                        {{ $reviews->lastItem() }}
                    </strong>

                    of

                    <strong>
                        {{ $reviews->total() }}
                    </strong>

                    results

                </div>

                <div class="reviews-pagination-links">

                    {{ $reviews->onEachSide(1)->links() }}

                </div>

            </div>

        @endif

    </div>

</div>

@endsection