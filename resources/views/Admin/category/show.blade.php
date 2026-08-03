@extends('layout.admin.master')

@section('title', 'Category Details')

@section('content')

<div class="dashboard-section">

    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Category Details</h5>
                <p class="text-muted mb-0 small">
                    Review category information
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-2"></i>
                    Edit
                </a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light border">
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Categories
                </a>
            </div>

        </div>

    </div>

    <div class="row g-4">

        <div class="col-12 col-lg-4">
            <div class="dashboard-panel h-100">
                <h6 class="mb-3">Image</h6>

                @if(!empty($category->image))
                    <img
                        src="{{ asset('storage/' . $category->image) }}"
                        alt="{{ $category->name }}"
                        class="img-fluid rounded border w-100"
                        style="max-height: 320px; object-fit: cover;">
                @else
                    <div class="chart-placeholder" style="height:220px;">
                        <i class="bi bi-image"></i>
                        <h6>No image uploaded</h6>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="dashboard-panel h-100">

                <h6 class="mb-3">Information</h6>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <small class="text-muted d-block">ID</small>
                        <strong>{{ $category->id }}</strong>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted d-block">Name</small>
                        <strong>{{ $category->name }}</strong>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted d-block">Slug</small>
                        <strong>{{ $category->slug }}</strong>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted d-block">Book Count</small>
                        <strong>{{ $category->books_count }}</strong>
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted d-block">Status</small>
                        @if($category->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </div>

                    <div class="col-12 col-md-6">
                        <small class="text-muted d-block">Created Date</small>
                        <strong>{{ $category->created_at?->format('d M Y H:i') }}</strong>
                    </div>

                    <div class="col-12">
                        <small class="text-muted d-block">Description</small>
                        <p class="mb-0">{{ $category->description ?: '-' }}</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection
