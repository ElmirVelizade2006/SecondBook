@extends('layout.admin.master')

@section('title', 'Book Conditions')

@section('content')
<div class="dashboard-section">

    <div class="dashboard-panel mb-4">
        <div class="panel-header mb-0">
            <div>
                <h5 class="mb-1">Book Conditions</h5>
                <p class="text-muted mb-0 small">Manage all available book conditions</p>
            </div>

            <a href="{{ route('admin.book.conditions.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Add Condition
            </a>
        </div>
    </div>

    <div class="dashboard-panel mb-4">

            <form method="GET" action="{{ route('admin.book.conditions.index') }}" class="row g-3 align-items-end" autocomplete="off">
                <div class="col-12 col-md-4 col-lg-4">
                    <label class="form-label small text-muted fw-semibold">Search</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0" value="{{ request('search') }}" placeholder="Condition name...">
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <label class="form-label small text-muted fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-12 col-lg-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1 flex-lg-grow-0 px-4">
                        <i class="bi bi-funnel me-1"></i>
                        Filter
                    </button>
                    <a href="{{ route('admin.book.conditions.index') }}" class="btn btn-light border">Reset</a>
                </div>
            </form>

    </div>

    <div class="dashboard-panel">

        <div class="panel-header">
            <h5>Condition List</h5>
            <span class="badge bg-primary">{{ count($conditions) }} conditions</span>
        </div>

        <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Condition Name</th>
                            <th>Description</th>
                            <th>Books Count</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($conditions as $condition)
                            <tr>
                                <td>#{{ $loop->iteration }}</td>
                                <td><strong>{{ $condition['name'] }}</strong></td>
                                <td>{{ $condition['description'] }}</td>
                                <td>{{ $condition['books_count'] }}</td>
                                <td>
                                    <span class="badge {{ (int) $condition['status'] === 1 ? 'bg-success' : 'bg-secondary' }}">
                                        {{ (int) $condition['status'] === 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $condition['created_at'] }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <form action="{{ route('admin.book.conditions.status', ['condition' => $condition['id']]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ (int) $condition['status'] === 1 ? 'btn-warning' : 'btn-success' }}" title="Toggle Status">
                                                <i class="bi {{ (int) $condition['status'] === 1 ? 'bi-pause-circle' : 'bi-check-circle' }}"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.book.conditions.edit', ['condition' => $condition['id']]) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('admin.book.conditions.destroy', ['condition' => $condition['id']]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this condition?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No conditions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

    </div>

</div>
@endsection

@push('css')
<style>
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
