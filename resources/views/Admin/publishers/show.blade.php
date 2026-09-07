@extends('layout.admin.master')

@section('title', 'Publisher Details')

@section('content')

<div class="dashboard-section">

    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Publisher Details</h5>
                <p class="text-muted mb-0 small">
                    Review details for this publisher
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.publishers.edit', $publisher->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-2"></i>
                    Edit
                </a>
                <a href="{{ route('admin.publishers.index') }}" class="btn btn-light border">
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Publishers
                </a>
            </div>

        </div>

    </div>

    <div class="dashboard-panel">

        <div class="row g-3">
            <div class="col-12 col-md-3">
                <small class="text-muted d-block">ID</small>
                <strong>{{ $publisher->id }}</strong>
            </div>

            <div class="col-12 col-md-5">
                <small class="text-muted d-block">Name</small>
                <strong>{{ $publisher->name }}</strong>
            </div>

            <div class="col-12 col-md-4">
                <small class="text-muted d-block">Country</small>
                <strong>{{ $publisher->country ?: '-' }}</strong>
            </div>

            <div class="col-12 col-md-6">
                <small class="text-muted d-block">Website</small>
                @if(!empty($publisher->website))
                    <a href="{{ $publisher->website }}" target="_blank" rel="noopener">{{ $publisher->website }}</a>
                @else
                    <strong>-</strong>
                @endif
            </div>

            <div class="col-12 col-md-6">
                <small class="text-muted d-block">Logo</small>
                @if(!empty($publisher->logo))
                    <img
                        src="{{ asset('storage/' . $publisher->logo) }}"
                        alt="{{ $publisher->name }}"
                        class="img-fluid rounded border"
                        style="max-height: 180px; object-fit: cover;">
                @else
                    <strong>-</strong>
                @endif
            </div>

            <div class="col-12">
                <small class="text-muted d-block">Description</small>
                <p class="mb-0">{{ $publisher->description ?: '-' }}</p>
            </div>

            <div class="col-12 col-md-4">
                <small class="text-muted d-block">Status</small>
                @if($publisher->status ?? false)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </div>

            <div class="col-12 col-md-6">
                <small class="text-muted d-block">Created At</small>
                <strong>{{ $publisher->created_at?->format('d M Y H:i') }}</strong>
            </div>

            <div class="col-12 col-md-6">
                <small class="text-muted d-block">Updated At</small>
                <strong>{{ $publisher->updated_at?->format('d M Y H:i') }}</strong>
            </div>
        </div>

    </div>

</div>

@endsection
