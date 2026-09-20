@extends('layout.admin.master')

@section('title', 'Book Requests')

@section('content')

<div class="dashboard-section book-requests-page">

    {{-- PAGE HEADER --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Book Requests</h5>

                <p class="text-muted mb-0 small">
                    Manage books submitted by sellers for approval
                </p>
            </div>

        </div>

    </div>


    {{-- FILTERS --}}
    <div class="dashboard-panel mb-4">

        <form
            method="GET"
            action="{{ route('admin.book.requests.index') }}"
            class="row g-3 align-items-end"
            autocomplete="off"
        >

            {{-- SEARCH --}}
            <div class="col-12 col-md-6 col-lg-5">

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
                        placeholder="Search book or seller..."
                    >

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Search
                    </button>

                </div>

            </div>


            {{-- CATEGORY --}}
            <div class="col-12 col-md-6 col-lg-3">

                <label class="form-label fw-semibold text-muted small">
                    Category
                </label>

                <select
                    name="category"
                    class="form-select"
                >

                    <option value="">
                        All Categories
                    </option>

                    @foreach(\App\Models\Category::orderBy('name')->get() as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected((string) request('category') === (string) $category->id)
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- FILTER BUTTONS --}}
            <div class="col-12 col-lg-4 d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-primary flex-grow-1 flex-lg-grow-0 px-4"
                >
                    <i class="bi bi-funnel me-1"></i>
                    Filter
                </button>

                <a
                    href="{{ route('admin.book.requests.index') }}"
                    class="btn btn-light border"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- BOOK REQUEST LIST --}}
    <div class="dashboard-panel">

        <div class="panel-header">

            <div>

                <h5 class="mb-1">
                    Seller Book Requests
                </h5>

                <p class="text-muted mb-0 small">
                    Books waiting for admin review
                </p>

            </div>

            <span class="badge bg-primary">

                {{ $bookRequests->count() }}

                {{ $bookRequests->count() === 1 ? 'request' : 'requests' }}

            </span>

        </div>


        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Book</th>

                        <th>Seller</th>

                        <th>Category</th>

                        <th>Price</th>

                        <th>Stock</th>

                        <th>Condition</th>

                        <th>Status</th>

                        <th>Date</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($bookRequests as $book)

                        <tr>

                            {{-- ID --}}
                            <td>
                                #{{ $book->id }}
                            </td>


                            {{-- BOOK --}}
                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    @if($book->cover)

                                        <img
                                            src="{{ asset('storage/' . $book->cover) }}"
                                            alt="{{ $book->title }}"
                                            width="48"
                                            height="64"
                                            style="
                                                object-fit: cover;
                                                border-radius: 8px;
                                            "
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center"
                                            style="
                                                width: 48px;
                                                height: 64px;
                                                border-radius: 8px;
                                                background: #f3f4f6;
                                            "
                                        >

                                            <i class="bi bi-book fs-5 text-muted"></i>

                                        </div>

                                    @endif


                                    <div>

                                        <strong class="d-block">
                                            {{ $book->title }}
                                        </strong>

                                        @if($book->isbn)

                                            <small class="text-muted">
                                                ISBN: {{ $book->isbn }}
                                            </small>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- SELLER --}}
                            <td>

                                @if($book->seller)

                                    <div>

                                        <strong>
                                            {{ $book->seller->name }}
                                        </strong>

                                        @if($book->seller->email)

                                            <small class="d-block text-muted">
                                                {{ $book->seller->email }}
                                            </small>

                                        @endif

                                    </div>

                                @else

                                    <span class="text-muted">
                                        Unknown seller
                                    </span>

                                @endif

                            </td>


                            {{-- CATEGORY --}}
                            <td>

                                {{ $book->category?->name ?? '—' }}

                            </td>


                            {{-- PRICE --}}
                            <td>

                                <strong>
                                    ₼{{ number_format((float) $book->price, 2) }}
                                </strong>

                            </td>


                            {{-- STOCK --}}
                            <td>

                                {{ $book->stock }}

                            </td>


                            {{-- CONDITION --}}
                            <td>

                                @php

                                    $condition = match($book->condition) {

                                        'new' => 'New',

                                        'like_new' => 'Like New',

                                        'good' => 'Good',

                                        'fair' => 'Fair',

                                        default => ucfirst(
                                            str_replace('_', ' ', $book->condition)
                                        ),

                                    };

                                @endphp

                                {{ $condition }}

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @php

                                    $statusClass = match($book->status) {

                                        'approved' => 'bg-success',

                                        'rejected' => 'bg-danger',

                                        default => 'bg-warning text-dark',

                                    };

                                @endphp


                                <span class="badge {{ $statusClass }}">

                                    {{ ucfirst($book->status) }}

                                </span>

                            </td>


                            {{-- DATE --}}
                            <td>

                                {{ $book->created_at?->format('d.m.Y') }}

                            </td>


                            {{-- ACTIONS --}}
                            <td>

                                <div class="d-flex justify-content-end gap-2">

                                    {{-- REVIEW --}}
                                    <a
                                        href="{{ route('admin.book.requests.edit', $book->id) }}"
                                        class="btn btn-warning btn-sm"
                                        title="Review Request"
                                    >

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('admin.book.requests.destroy', $book->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this book request?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Delete Request"
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
                                colspan="10"
                                class="text-center py-5"
                            >

                                <div class="text-muted">

                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>

                                    <h6 class="mb-1">
                                        No Book Requests
                                    </h6>

                                    <p class="mb-0 small">
                                        There are currently no books waiting for approval.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection