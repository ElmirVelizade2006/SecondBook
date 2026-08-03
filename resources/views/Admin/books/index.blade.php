@extends('layout.admin.master')

@section('title', 'Books')

@section('content')

<div class="dashboard-section">

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

        <form method="GET" action="{{ route('admin.books.index') }}" class="row g-3 align-items-end">

            <div class="col-12 col-md-4 col-lg-4">
                <label class="form-label small text-muted fw-semibold">Search</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-start-0"
                        placeholder="Title, author, seller...">
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <label class="form-label small text-muted fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="approved" @selected(request('status') === 'approved')>Approved</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                    <option value="rejected" @selected(request('status') === 'rejected')>Rejected</option>
                </select>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <label class="form-label small text-muted fw-semibold">Condition</label>
                <select name="condition" class="form-select">
                    <option value="">All Conditions</option>
                    <option value="new" @selected(request('condition') === 'new')>New</option>
                    <option value="like_new" @selected(request('condition') === 'like_new')>Like New</option>
                    <option value="good" @selected(request('condition') === 'good')>Good</option>
                    <option value="fair" @selected(request('condition') === 'fair')>Fair</option>
                </select>
            </div>

            <div class="col-12 col-lg-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1 flex-lg-grow-0 px-4">
                    <i class="bi bi-funnel me-1"></i>
                    Filter
                </button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-light border">
                    Reset
                </a>
            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="dashboard-panel">

        <div class="panel-header">
            <h5>Book List</h5>
            <span class="badge bg-primary">{{ $books->total() }} books</span>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Book</th>
                        <th class="d-none d-md-table-cell">Category</th>
                        <th class="d-none d-lg-table-cell">Author</th>
                        <th class="d-none d-xl-table-cell">Seller</th>
                        <th>Price</th>
                        <th class="d-none d-md-table-cell">Condition</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($books as $key => $book)

                        <tr>

                            <td>{{ $books->firstItem() + $key }}</td>

                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if(!empty($book->cover))
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="book-cover-image rounded">
                                    @else
                                        <div class="book-cover-thumb">
                                            <i class="bi bi-book"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong class="d-block">{{ $book->title }}</strong>
                                        <small class="text-muted d-lg-none">{{ $book->author?->name ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>

                            <td class="d-none d-md-table-cell">{{ $book->category?->name ?? '-' }}</td>

                            <td class="d-none d-lg-table-cell">{{ $book->author?->name ?? '-' }}</td>

                            <td class="d-none d-xl-table-cell">{{ $book->seller?->name ?? '-' }}</td>

                            <td>
                                <strong>${{ number_format((float) ($book->price ?? 0), 2) }}</strong>
                            </td>

                            <td class="d-none d-md-table-cell">
                                <span class="badge bg-primary">{{ $book->condition ? str_replace('_', ' ', ucfirst($book->condition)) : '-' }}</span>
                            </td>

                            <td>
                                @if($book->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($book->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($book->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Unknown</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.books.show', $book->id) }}" class="btn btn-light btn-sm border" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Delete this book?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <div class="chart-placeholder" style="height:auto;padding:30px 0;">
                                    <i class="bi bi-book"></i>
                                    <h6>No books found</h6>
                                    <p>Add your first book to get started.</p>
                                    <a href="{{ route('admin.books.create') }}" class="btn btn-primary mt-3">
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

        @if($books->hasPages())
            <div class="pt-3">
                {{ $books->links() }}
            </div>
        @endif

    </div>

</div>

@endsection

@push('css')
<style>
    .book-cover-thumb{
        width:44px;
        height:56px;
        flex-shrink:0;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
        background:linear-gradient(135deg,#eff6ff,#e0e7ff);
        color:#2563eb;
        font-size:18px;
    }

    .book-cover-image{
        width:44px;
        height:56px;
        object-fit:cover;
        flex-shrink:0;
    }

    .input-group-text{
        border-radius:14px 0 0 14px;
    }

    .input-group .form-control{
        border-radius:0;
        padding:12px 14px;
    }

    .input-group .btn{
        border-radius:0 14px 14px 0;
    }

    .form-select{
        border-radius:14px;
        padding:12px 14px;
    }

    .dashboard-panel .btn-sm{
        width:36px;
        height:36px;
        padding:0;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
    }
</style>
@endpush
