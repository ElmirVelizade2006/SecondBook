@extends('layout.admin.master')

@section('title', 'Author Details')

@section('content')

<div class="dashboard-section">

    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Author Details</h5>
                <p class="text-muted mb-0 small">
                    Review details for this author
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.authors.edit', $author->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-2"></i>
                    Edit
                </a>
                <a href="{{ route('admin.authors.index') }}" class="btn btn-light border">
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Authors
                </a>
            </div>

        </div>

    </div>

    <div class="dashboard-panel">

        <div class="row g-3">
            <div class="col-12 col-md-4">
                <small class="text-muted d-block">ID</small>
                <strong>{{ $author->id }}</strong>
            </div>

            <div class="col-12 col-md-6">
                <small class="text-muted d-block">Name</small>
                <strong>{{ $author->name }}</strong>
            </div>

            <div class="col-12 col-md-6">
                <small class="text-muted d-block">Status</small>
                @if($author->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </div>

            <div class="col-12">
                <small class="text-muted d-block">Bio</small>
                <p class="mb-0">{{ $author->bio ?: '-' }}</p>
            </div>

            <div class="col-12 col-md-6">
                <small class="text-muted d-block mb-2">Photo</small>
                @if(!empty($author->photo))
                    <img
                        src="{{ asset('storage/' . $author->photo) }}"
                        alt="{{ $author->name }}"
                        class="img-fluid rounded border"
                        style="max-height: 220px; object-fit: cover;">
                @else
                    <span class="text-muted">-</span>
                @endif
            </div>

            <div class="col-12 col-md-3">
                <small class="text-muted d-block">Created At</small>
                <strong>{{ $author->created_at?->format('d M Y H:i') }}</strong>
            </div>

            <div class="col-12 col-md-3">
                <small class="text-muted d-block">Updated At</small>
                <strong>{{ $author->updated_at?->format('d M Y H:i') }}</strong>
            </div>
        </div>

    </div>

</div>

@endsection
