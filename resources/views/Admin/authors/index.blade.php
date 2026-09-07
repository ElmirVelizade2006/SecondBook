@extends('layout.admin.master')

@section('title', 'Authors')

@section('content')

<div class="dashboard-section">

    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Authors</h5>
                <p class="text-muted mb-0 small">
                    Manage all authors listed on SecondBook
                </p>
            </div>

            <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Add Author
            </a>

        </div>

    </div>

    <div class="dashboard-panel mb-4">

        <form method="GET" action="{{ route('admin.authors.index') }}" class="row g-3 align-items-end">

            <div class="col-12 col-md-8 col-lg-8">
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
                        placeholder="Author name...">
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1 flex-lg-grow-0 px-4">
                    <i class="bi bi-funnel me-1"></i>
                    Filter
                </button>
                <a href="{{ route('admin.authors.index') }}" class="btn btn-light border">
                    Reset
                </a>
            </div>

        </form>

    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="dashboard-panel">

        <div class="panel-header">
            <h5>Author List</h5>
            <span class="badge bg-primary">{{ $authors->total() }} authors</span>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th class="d-none d-lg-table-cell">Bio</th>
                        <th>Status</th>
                        <th class="d-none d-lg-table-cell">Created At</th>
                        <th class="d-none d-lg-table-cell">Updated At</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($authors as $key => $author)
                        <tr>

                            <td>{{ $author->id }}</td>

                            <td>
                                @if(!empty($author->photo))
                                    <img
                                        src="{{ asset('storage/' . $author->photo) }}"
                                        alt="{{ $author->name }}"
                                        class="author-thumb rounded border">
                                @else
                                    <div class="book-cover-thumb">
                                        <i class="bi bi-person"></i>
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div>
                                    <strong class="d-block">{{ $author->name }}</strong>
                                    <small class="text-muted d-lg-none">{{ \Illuminate\Support\Str::limit($author->bio, 40) ?: '-' }}</small>
                                </div>
                            </td>

                            <td class="d-none d-lg-table-cell">{{ \Illuminate\Support\Str::limit($author->bio, 80) ?: '-' }}</td>

                            <td>
                                @if($author->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td class="d-none d-lg-table-cell">{{ $author->created_at?->format('d M Y H:i') }}</td>

                            <td class="d-none d-lg-table-cell">{{ $author->updated_at?->format('d M Y H:i') }}</td>

                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.authors.show', $author->id) }}" class="btn btn-light btn-sm border" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <form action="{{ route('admin.authors.status', $author->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-sm {{ $author->status ? 'btn-warning text-dark' : 'btn-success' }}"
                                            title="{{ $author->status ? 'Deactivate' : 'Activate' }}">
                                            <i class="bi {{ $author->status ? 'bi-pause-circle' : 'bi-check-circle' }}"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.authors.edit', $author->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" onsubmit="return confirm('Delete this author?')">
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
                            <td colspan="8" class="text-center py-5">
                                <div class="chart-placeholder" style="height:auto;padding:30px 0;">
                                    <i class="bi bi-person"></i>
                                    <h6>No authors found</h6>
                                    <p>Add your first author to get started.</p>
                                    <a href="{{ route('admin.authors.create') }}" class="btn btn-primary mt-3">
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Add Author
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        @if($authors->hasPages())
            <div class="pt-3">
                {{ $authors->links() }}
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

    .dashboard-panel .btn-sm{
        width:36px;
        height:36px;
        padding:0;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        border-radius:10px;
    }

    .author-thumb{
        width:44px;
        height:56px;
        object-fit:cover;
        display:block;
    }
</style>
@endpush
