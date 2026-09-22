@extends('layout.admin.master')

@section('title', 'Books')

@section('content')

<div class="dashboard-section books-page">

    {{-- Header --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Books</h5>

                <p class="text-muted mb-0 small">
                    Manage all books listed on SecondBook
                </p>
            </div>

            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Add Book
            </a>

        </div>

    </div>


    {{-- Filters --}}
    <div class="dashboard-panel mb-4">

        <form
            method="GET"
            action="{{ route('admin.books.index') }}"
            class="row g-3 align-items-end"
        >

            {{-- Search --}}
            <div class="col-12 col-md-4 col-lg-4">

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
                        placeholder="Title, author, seller..."
                    >

                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>

                </div>

            </div>


            {{-- Status --}}
            <div class="col-6 col-md-4 col-lg-2">

                <label class="form-label small text-muted fw-semibold">
                    Status
                </label>

                <select name="status" class="form-select">

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


            {{-- Condition --}}
            <div class="col-6 col-md-4 col-lg-2">

                <label class="form-label small text-muted fw-semibold">
                    Condition
                </label>

                <select name="condition" class="form-select">

                    <option value="">
                        All Conditions
                    </option>

                    <option
                        value="new"
                        @selected(request('condition') === 'new')
                    >
                        New
                    </option>

                    <option
                        value="like_new"
                        @selected(request('condition') === 'like_new')
                    >
                        Like New
                    </option>

                    <option
                        value="good"
                        @selected(request('condition') === 'good')
                    >
                        Good
                    </option>

                    <option
                        value="fair"
                        @selected(request('condition') === 'fair')
                    >
                        Fair
                    </option>

                </select>

            </div>


            {{-- Filter Actions --}}
            <div class="col-12 col-lg-4 d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-primary flex-grow-1 flex-lg-grow-0 px-4"
                >
                    <i class="bi bi-funnel me-1"></i>
                    Filter
                </button>

                <a
                    href="{{ route('admin.books.index') }}"
                    class="btn btn-light border"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- Table --}}
    <div class="dashboard-panel">

        <div class="panel-header">

            <h5>
                Book List
            </h5>

            <span class="badge bg-primary">
                {{ $books->total() }} books
            </span>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>
                            Book
                        </th>

                        <th class="d-none d-md-table-cell">
                            Category
                        </th>

                        <th class="d-none d-lg-table-cell">
                            Author
                        </th>

                        <th class="d-none d-xl-table-cell">
                            Seller
                        </th>

                        <th>
                            Price
                        </th>

                        <th class="d-none d-md-table-cell">
                            Condition
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="text-end">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($books as $key => $book)

                        <tr>

                            {{-- Number --}}
                            <td>
                                {{ $books->firstItem() + $key }}
                            </td>


                            {{-- Book --}}
                            <td>

                                <div class="d-flex align-items-center gap-3">

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
                                            class="book-cover-image rounded"
                                            loading="lazy"
                                        >

                                    @else

                                        <div class="book-cover-thumb">
                                            <i class="bi bi-book"></i>
                                        </div>

                                    @endif


                                    <div>

                                        <strong class="d-block">
                                            {{ $book->title }}
                                        </strong>

                                        <small class="text-muted d-lg-none">
                                            {{ $book->author?->name ?? '-' }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- Category --}}
                            <td class="d-none d-md-table-cell">
                                {{ $book->category?->name ?? '-' }}
                            </td>


                            {{-- Author --}}
                            <td class="d-none d-lg-table-cell">
                                {{ $book->author?->name ?? '-' }}
                            </td>


                            {{-- Seller --}}
                            <td class="d-none d-xl-table-cell">
                                {{ $book->seller?->name ?? '-' }}
                            </td>


                            {{-- Price --}}
                            <td>

                                <strong>
                                    ${{ number_format((float) ($book->price ?? 0), 2) }}
                                </strong>

                            </td>


                            {{-- Condition --}}
                            <td class="d-none d-md-table-cell">

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

                            </td>


                            {{-- Status --}}
                            <td>

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

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex justify-content-end gap-2">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('admin.books.show', $book->id) }}"
                                        class="btn btn-light btn-sm border"
                                        title="View"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('admin.books.edit', $book->id) }}"
                                        class="btn btn-warning btn-sm"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.books.destroy', $book->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this book?')"
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

                            <td colspan="9" class="text-center py-5">

                                <div class="chart-placeholder books-empty-state">

                                    <i class="bi bi-book"></i>

                                    <h6>
                                        No books found
                                    </h6>

                                    <p>
                                        Add your first book to get started.
                                    </p>

                                    <a
                                        href="{{ route('admin.books.create') }}"
                                        class="btn btn-primary mt-3"
                                    >
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Add Book
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($books->hasPages())
            <div class="books-pagination">
                <div class="books-pagination-info">
                    Showing
                    <strong>{{ $books->firstItem() }}</strong>
                    to
                    <strong>{{ $books->lastItem() }}</strong>
                    of
                    <strong>{{ $books->total() }}</strong>
                    results
                </div>

                <div class="books-pagination-links">
                    {{ $books->onEachSide(1)->links() }}
                </div>
            </div>
        @endif
    </div>

</div>

@endsection
