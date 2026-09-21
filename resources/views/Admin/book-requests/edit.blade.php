@extends('layout.admin.master')

@section('title', 'Book Request')

@section('content')

<div class="dashboard-section book-requests-page">

    {{-- PAGE HEADER --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Book Request</h5>
                <p class="text-muted mb-0 small">
                    Review the seller's book submission and respond to the request.
                </p>
            </div>

            <a
                href="{{ route('admin.book.requests.index') }}"
                class="btn btn-light border"
            >
                <i class="bi bi-arrow-left me-2"></i>
                Back to Requests
            </a>

        </div>

    </div>


    {{-- BOOK INFORMATION --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header">

            <div>
                <h5 class="mb-1">Book Information</h5>
                <p class="text-muted mb-0 small">
                    Information submitted by the seller.
                </p>
            </div>

        </div>


        <div class="row g-4">

            {{-- COVER --}}
            <div class="col-md-3">

                <div class="book-request-cover">

                    @if($bookRequest->cover)

                        <img
                            src="{{ asset('storage/' . $bookRequest->cover) }}"
                            alt="{{ $bookRequest->title }}"
                            class="img-fluid rounded"
                        >

                    @else

                        <div class="book-request-no-cover">
                            <i class="bi bi-book"></i>
                            <span>No Cover</span>
                        </div>

                    @endif

                </div>

            </div>


            {{-- DETAILS --}}
            <div class="col-md-9">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Title
                        </label>

                        <div class="form-control bg-light">
                            {{ $bookRequest->title }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            ISBN
                        </label>

                        <div class="form-control bg-light">
                            {{ $bookRequest->isbn ?: 'Not provided' }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Category
                        </label>

                        <div class="form-control bg-light">
                            {{ $bookRequest->category?->name ?? 'Not provided' }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Author
                        </label>

                        <div class="form-control bg-light">
                            {{ $bookRequest->author?->name ?? 'Not provided' }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Publisher
                        </label>

                        <div class="form-control bg-light">
                            {{ $bookRequest->publisher?->name ?? 'Not provided' }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Seller
                        </label>

                        <div class="form-control bg-light">
                            {{ $bookRequest->seller?->name ?? 'Unknown seller' }}
                        </div>

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Publication Year
                        </label>

                        <div class="form-control bg-light">
                            {{ $bookRequest->publication_year ?? 'Not provided' }}
                        </div>

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Pages
                        </label>

                        <div class="form-control bg-light">
                            {{ $bookRequest->pages ?? 'Not provided' }}
                        </div>

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Language
                        </label>

                        <div class="form-control bg-light">
                            {{ $bookRequest->language ?? 'Not provided' }}
                        </div>

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Price
                        </label>

                        <div class="form-control bg-light">
                            ₼{{ number_format($bookRequest->price, 2) }}
                        </div>

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Stock
                        </label>

                        <div class="form-control bg-light">
                            {{ $bookRequest->stock }}
                        </div>

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Condition
                        </label>

                        <div class="form-control bg-light">
                            {{ ucwords(str_replace('_', ' ', $bookRequest->condition)) }}
                        </div>

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Description
                        </label>

                        <div
                            class="form-control bg-light"
                            style="min-height: 100px;"
                        >
                            {{ $bookRequest->description ?: 'No description provided.' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ADMIN RESPONSE --}}
    <div class="dashboard-panel">

        <div class="panel-header">

            <div>

                <h5 class="mb-1">
                    Admin Response
                </h5>

                <p class="text-muted mb-0 small">
                    Send a response to the seller about this book request.
                </p>

            </div>

        </div>


        <form
            action="{{ route('admin.book.requests.update', ['book' => $bookRequest->id]) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            {{-- STATUS --}}
            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Request Status
                </label>

                <select
                    name="status"
                    class="form-select @error('status') is-invalid @enderror"
                >

                    <option
                        value="pending"
                        @selected(old('status', $bookRequest->status) === 'pending')
                    >
                        Pending
                    </option>

                    <option
                        value="approved"
                        @selected(old('status', $bookRequest->status) === 'approved')
                    >
                        Approved
                    </option>

                    <option
                        value="changes_requested"
                        @selected(old('status', $bookRequest->status) === 'changes_requested')
                    >
                        Changes Requested
                    </option>

                    <option
                        value="rejected"
                        @selected(old('status', $bookRequest->status) === 'rejected')
                    >
                        Rejected
                    </option>

                </select>

                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- MESSAGE --}}
            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Message to Seller
                </label>

                <textarea
                    name="message"
                    rows="5"
                    class="form-control @error('message') is-invalid @enderror"
                    placeholder="Write a message for the seller..."
                >{{ old('message') }}</textarea>

                <div class="form-text">
                    The seller will receive this message as a notification.
                </div>

                @error('message')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- ACTIONS --}}
            <div class="d-flex flex-wrap gap-2">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-send me-2"></i>
                    Send Response
                </button>

                <a
                    href="{{ route('admin.book.requests.index') }}"
                    class="btn btn-light border"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection