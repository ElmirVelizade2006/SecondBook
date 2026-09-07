@extends('layout.admin.master')

@section('title', 'Add Author')

@section('content')

<div class="dashboard-section">

    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Add Author</h5>
                <p class="text-muted mb-0 small">
                    Create a new author
                </p>
            </div>

            <a href="{{ route('admin.authors.index') }}" class="btn btn-light border">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Authors
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

        <form action="{{ route('admin.authors.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Author Name <span class="text-danger">*</span></label>
                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Enter author name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Bio</label>
                <textarea
                    name="bio"
                    rows="4"
                    class="form-control @error('bio') is-invalid @enderror"
                    placeholder="Write short bio for author...">{{ old('bio') }}</textarea>
                @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Photo</label>
                <input
                    type="file"
                    name="photo"
                    accept="image/*"
                    class="form-control @error('photo') is-invalid @enderror">
                @error('photo')
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
                    {{ old('status', 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">
                    Active author
                </label>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check2-circle me-2"></i>
                    Save Author
                </button>

                <a href="{{ route('admin.authors.index') }}" class="btn btn-light border">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection

@push('css')
<style>
    .form-control{
        border-radius:14px;
        padding:12px 16px;
    }

    input[type="file"].form-control{
        padding:6px;
        background:#f8fafc;
        color:#0f172a;
        border-color:#cbd5e1;
    }

    input[type="file"].form-control::file-selector-button,
    input[type="file"].form-control::-webkit-file-upload-button{
        margin:0 10px 0 0;
        padding:10px 14px;
        border:0;
        border-right:1px solid #cbd5e1;
        border-radius:10px;
        background:#e2e8f0;
        color:#0f172a;
        font-weight:600;
    }

    :root[data-theme="dark"] input[type="file"].form-control{
        background:#0b1220 !important;
        color:#e5e7eb !important;
        border-color:#334155 !important;
    }

    :root[data-theme="dark"] input[type="file"].form-control::file-selector-button,
    :root[data-theme="dark"] input[type="file"].form-control::-webkit-file-upload-button{
        background:#1e293b;
        color:#e5e7eb;
        border-right:1px solid #334155;
    }

    .form-label{
        color:#334155;
        margin-bottom:8px;
    }
</style>
@endpush
