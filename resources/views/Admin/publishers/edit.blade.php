@extends('layout.admin.master')

@section('title', 'Edit Publisher')

@section('content')

<div class="dashboard-section publishers-page">

    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Edit Publisher</h5>
                <p class="text-muted mb-0 small">
                    Update publisher information
                </p>
            </div>

            <a href="{{ route('admin.publishers.index') }}" class="btn btn-light border">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Publishers
            </a>

        </div>

    </div>

    <div class="dashboard-panel">

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.publishers.update', $publisher->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Publisher Name <span class="text-danger">*</span></label>
                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $publisher->name) }}"
                    placeholder="Enter publisher name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Logo</label>
                <input
                    type="file"
                    name="logo"
                    accept="image/*"
                    class="form-control @error('logo') is-invalid @enderror">
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if(!empty($publisher->logo))
                <div class="mb-3">
                    <small class="text-muted d-block mb-2">Current Logo</small>
                    <img
                        src="{{ asset('storage/' . $publisher->logo) }}"
                        alt="{{ $publisher->name }}"
                        class="img-fluid rounded border"
                        class="publisher-detail-image">
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label fw-semibold">Country</label>
                <input
                    type="text"
                    name="country"
                    class="form-control @error('country') is-invalid @enderror"
                    value="{{ old('country', $publisher->country) }}"
                    placeholder="Enter country">
                @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Website</label>
                <input
                    type="url"
                    name="website"
                    class="form-control @error('website') is-invalid @enderror"
                    value="{{ old('website', $publisher->website) }}"
                    placeholder="https://example.com">
                @error('website')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea
                    name="description"
                    rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Write short description about publisher...">{{ old('description', $publisher->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input
                    class="form-check-input"
                    type="checkbox"
                    name="status"
                    value="1"
                    id="status"
                    {{ old('status', $publisher->status ?? 0) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">
                    Active publisher
                </label>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check2-circle me-2"></i>
                    Update Publisher
                </button>

                <a href="{{ route('admin.publishers.index') }}" class="btn btn-light border">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection

