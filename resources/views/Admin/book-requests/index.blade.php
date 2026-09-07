@extends('layout.admin.master')

@section('title', 'Book Requests')

@section('content')
<div class="dashboard-section">

    <div class="dashboard-panel mb-4">
        <div class="panel-header mb-0">
            <div>
                <h5 class="mb-1">Book Requests</h5>
                <p class="text-muted mb-0 small">Manage all customer book requests</p>
            </div>

            <a href="{{ route('admin.book.requests.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Add Request
            </a>
        </div>
    </div>

    <div class="dashboard-panel mb-4">
            <form method="GET" action="{{ route('admin.book.requests.index') }}" class="row g-3 align-items-end" autocomplete="off">
                <div class="col-12 col-md-4 col-lg-4">
                    <label class="form-label small text-muted fw-semibold">Search</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="e.g. Atomic Habits">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-2">
                    <label class="form-label fw-semibold text-muted small">Category</label>
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        <option value="self_development" @selected(request('category') === 'self_development')>Self Development</option>
                        <option value="programming" @selected(request('category') === 'programming')>Programming</option>
                        <option value="business" @selected(request('category') === 'business')>Business</option>
                        <option value="fiction" @selected(request('category') === 'fiction')>Fiction</option>
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-2">
                    <label class="form-label fw-semibold text-muted small">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                        <option value="matched" @selected(request('status') === 'matched')>Matched</option>
                        <option value="completed" @selected(request('status') === 'completed')>Completed</option>
                        <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled</option>
                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <label class="form-label fw-semibold text-muted small">Date Range</label>
                    <input type="text" name="date_range" value="{{ request('date_range') }}" class="form-control" placeholder="01/07/2026 - 28/07/2026" style="min-width: 240px; padding: 10px 14px; height: 50px;">
                </div>

                <div class="col-12 col-lg-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1 flex-lg-grow-0 px-4">
                        <i class="bi bi-funnel me-1"></i>
                        Filter
                    </button>
                    <a href="{{ route('admin.book.requests.index') }}" class="btn btn-light border">Reset</a>
                </div>
            </form>
    </div>

    <div class="dashboard-panel">

        <div class="panel-header">
            <h5>Book Request List</h5>
            <span class="badge bg-primary">{{ count($bookRequests) }} requests</span>
        </div>

        <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Title</th>
                            <th>Requested By</th>
                            <th>Category</th>
                            <th>Budget</th>
                            <th>Status</th>
                            <th>Request Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookRequests as $request)
                            <tr>
                                <td>#{{ $loop->iteration }}</td>
                                <td><strong>{{ $request['title'] }}</strong></td>
                                <td>{{ $request['requester'] }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $request['category'])) }}</td>
                                <td>${{ number_format((float) $request['budget'], 2) }}</td>
                                <td>
                                    @php
                                        $statusClass = match($request['status']) {
                                            'approved' => 'bg-success',
                                            'rejected' => 'bg-danger',
                                            default => 'bg-warning text-dark',
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ ucfirst($request['status']) }}</span>
                                </td>
                                <td>{{ $request['created_at'] }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.book.requests.edit', ['request' => $request['id']]) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('admin.book.requests.destroy', ['request' => $request['id']]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this request?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No requests found.</td>
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

    .form-select,
    input[name="date_range"]{
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
