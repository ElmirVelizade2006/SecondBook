@extends('layout.admin.master')

@section('title', 'Book Details')

@section('content')

<div class="dashboard-section">

    {{-- Header --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Book Details</h5>

                <p class="text-muted mb-0 small">
                    Review detailed information for this book
                </p>
            </div>

            <div class="d-flex gap-2">

                <a
                    href="{{ route('admin.books.edit', $book->id) }}"
                    class="btn btn-warning"
                >
                    <i class="bi bi-pencil me-2"></i>
                    Edit
                </a>

                <a
                    href="{{ route('admin.books.index') }}"
                    class="btn btn-light border"
                >
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Books
                </a>

            </div>

        </div>

    </div>


    {{-- Book Content --}}
    <div class="row g-4">

        {{-- Cover --}}
        <div class="col-12 col-lg-4">

            <div class="dashboard-panel h-100">

                <h6 class="mb-3">
                    Cover
                </h6>

                @if(!empty($book->cover))

                    @php
                        $coverUrl = filter_var(
                            $book->cover,
                            FILTER_VALIDATE_URL
                        )
                            ? $book->cover
                            : asset('storage/' . $book->cover);
                    @endphp

                    <img
                        src="{{ $coverUrl }}"
                        alt="{{ $book->title }}"
                        class="img-fluid rounded border w-100"
                        style="max-height: 420px; object-fit: cover;"
                        loading="lazy"
                    >

                @else

                    <div
                        class="chart-placeholder"
                        style="height: 260px;"
                    >
                        <i class="bi bi-book"></i>

                        <h6>
                            No cover uploaded
                        </h6>
                    </div>

                @endif

            </div>

        </div>


        {{-- Information --}}
        <div class="col-12 col-lg-8">

            <div class="dashboard-panel h-100">

                <h6 class="mb-3">
                    Information
                </h6>

                <div class="row g-3">

                    {{-- Title --}}
                    <div class="col-12 col-md-6">

                        <small class="text-muted d-block">
                            Title
                        </small>

                        <strong>
                            {{ $book->title }}
                        </strong>

                    </div>


                    {{-- ISBN --}}
                    <div class="col-12 col-md-6">

                        <small class="text-muted d-block">
                            ISBN
                        </small>

                        <strong>
                            {{ $book->isbn ?: '-' }}
                        </strong>

                    </div>


                    {{-- Category --}}
                    <div class="col-12 col-md-6">

                        <small class="text-muted d-block">
                            Category
                        </small>

                        <strong>
                            {{ $book->category?->name ?? '-' }}
                        </strong>

                    </div>


                    {{-- Author --}}
                    <div class="col-12 col-md-6">

                        <small class="text-muted d-block">
                            Author
                        </small>

                        <strong>
                            {{ $book->author?->name ?? '-' }}
                        </strong>

                    </div>


                    {{-- Publisher --}}
                    <div class="col-12 col-md-6">

                        <small class="text-muted d-block">
                            Publisher
                        </small>

                        <strong>
                            {{ $book->publisher?->name ?? '-' }}
                        </strong>

                    </div>


                    {{-- Seller --}}
                    <div class="col-12 col-md-6">

                        <small class="text-muted d-block">
                            Seller
                        </small>

                        <strong>
                            {{ $book->seller?->name ?? '-' }}
                        </strong>

                    </div>


                    {{-- Price --}}
                    <div class="col-12 col-md-4">

                        <small class="text-muted d-block">
                            Price
                        </small>

                        <strong>
                            ${{ number_format((float) ($book->price ?? 0), 2) }}
                        </strong>

                    </div>


                    {{-- Stock --}}
                    <div class="col-12 col-md-4">

                        <small class="text-muted d-block">
                            Stock
                        </small>

                        <strong>
                            {{ $book->stock }}
                        </strong>

                    </div>


                    {{-- Condition --}}
                    <div class="col-12 col-md-4">

                        <small class="text-muted d-block">
                            Condition
                        </small>

                        <span class="badge bg-primary">

                            {{
                                $book->condition
                                    ? str_replace(
                                        '_',
                                        ' ',
                                        ucfirst($book->condition)
                                    )
                                    : '-'
                            }}

                        </span>

                    </div>


                    {{-- Status --}}
                    <div class="col-12 col-md-4">

                        <small class="text-muted d-block">
                            Status
                        </small>

                        @if($book->status === 'approved')

                            <span class="badge bg-success">
                                Approved
                            </span>

                        @elseif($book->status === 'pending')

                            <span class="badge bg-warning">
                                Pending
                            </span>

                        @elseif($book->status === 'rejected')

                            <span class="badge bg-danger">
                                Rejected
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                Unknown
                            </span>

                        @endif

                    </div>


                    {{-- Language --}}
                    <div class="col-12 col-md-4">

                        <small class="text-muted d-block">
                            Language
                        </small>

                        <strong>
                            {{ $book->language ?: '-' }}
                        </strong>

                    </div>


                    {{-- Publication Year --}}
                    <div class="col-12 col-md-4">

                        <small class="text-muted d-block">
                            Publication Year
                        </small>

                        <strong>
                            {{ $book->publication_year ?: '-' }}
                        </strong>

                    </div>


                    {{-- Pages --}}
                    <div class="col-12 col-md-4">

                        <small class="text-muted d-block">
                            Pages
                        </small>

                        <strong>
                            {{ $book->pages ?: '-' }}
                        </strong>

                    </div>


                    {{-- Description --}}
                    <div class="col-12">

                        <small class="text-muted d-block">
                            Description
                        </small>

                        <p class="mb-0">
                            {{ $book->description ?: '-' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
