@extends('layout.admin.master')

@section('title', 'Categories')

@section('content')

<div class="dashboard-section">

    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Categories</h5>
                <p class="text-muted mb-0 small">
                    Manage all book categories on SecondBook
                </p>
            </div>

            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Add Category
            </a>

        </div>

    </div>

    <div class="dashboard-panel mb-4">

        <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-3 align-items-end">

            <div class="col-12 col-md-6 col-lg-6">
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
                        placeholder="Category name, slug or description...">
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                </div>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <label class="form-label small text-muted fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="1" @selected(request('status') === '1')>Active</option>
                    <option value="0" @selected(request('status') === '0')>Inactive</option>
                </select>
            </div>

            <div class="col-6 col-md-3 col-lg-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1 flex-lg-grow-0 px-4">
                    <i class="bi bi-funnel me-1"></i>
                    Filter
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light border">
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
            <h5>Category List</h5>
            <span class="badge bg-primary">{{ $categories->total() }} categories</span>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th class="d-none d-md-table-cell">Slug</th>
                        <th class="d-none d-lg-table-cell">Description</th>
                        <th class="d-none d-lg-table-cell">Book Count</th>
                        <th>Status</th>
                        <th class="d-none d-lg-table-cell">Created Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($categories as $key => $category)
                        <tr>

                            <td>{{ $category->id }}</td>

                            <td>
                                @if(!empty($category->image))
                                    <img
                                        src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="category-thumb rounded border">
                                @else
                                    <div class="book-cover-thumb">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div>
                                        <strong class="d-block">{{ $category->name }}</strong>
                                        <small class="text-muted d-md-none">{{ $category->slug }}</small>
                                    </div>
                                </div>
                            </td>

                            <td class="d-none d-md-table-cell">{{ $category->slug }}</td>

                            <td class="d-none d-lg-table-cell">
                                {{ \Illuminate\Support\Str::limit($category->description ?? '-', 60) }}
                            </td>

                            <td class="d-none d-lg-table-cell">{{ $category->books_count }}</td>

                            <td>
                                @if($category->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td class="d-none d-lg-table-cell">{{ $category->created_at?->format('d M Y') }}</td>

                            <td>
                                <div class="d-flex justify-content-end gap-2">

                                    <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-light btn-sm border" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <form action="{{ route('admin.categories.status', $category->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-sm {{ $category->status ? 'btn-warning text-dark' : 'btn-success' }}"
                                            title="{{ $category->status ? 'Deactivate' : 'Activate' }}">
                                            <i class="bi {{ $category->status ? 'bi-pause-circle' : 'bi-check-circle' }}"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
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
                                    <i class="bi bi-tags"></i>
                                    <h6>No categories found</h6>
                                    <p>Create your first category to get started.</p>
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mt-3">
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Add Category
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        @if($categories->hasPages())
            <div class="pt-3">
                {{ $categories->links() }}
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

    .category-thumb{
        width:44px;
        height:56px;
        object-fit:cover;
        display:block;
    }
</style>
@endpush