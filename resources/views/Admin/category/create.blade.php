@extends('layout.admin.master')

@section('title', 'Add Category')

@section('content')

<div class="dashboard-section">

    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Add Category</h5>
                <p class="text-muted mb-0 small">
                    Create a new category for books
                </p>
            </div>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-light border">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Categories
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

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row g-4">

                <div class="col-12 col-lg-8">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter category name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Slug</label>
                        <input
                            type="text"
                            class="form-control @error('slug') is-invalid @enderror"
                            name="slug"
                            value="{{ old('slug') }}"
                            placeholder="example: fiction-books">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Leave empty if generated automatically in controller.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            name="description"
                            rows="5"
                            placeholder="Write short description for this category...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mt-4">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="status"
                            value="1"
                            id="status"
                            {{ old('status', 1) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">
                            Active category
                        </label>
                    </div>

                </div>

                <div class="col-12 col-lg-4">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category Image</label>
                        <input
                            type="file"
                            class="form-control @error('image') is-invalid @enderror"
                            name="image"
                            accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="p-3 rounded border small tip-box">
                        <strong class="d-block mb-1">Tip</strong>
                        Use a square image for better consistency in category cards.
                    </div>

                </div>

            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check2-circle me-2"></i>
                    Save Category
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-light border">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection

@push('css')
<style>
    .tip-box{
        background:rgba(248, 250, 252, 0.9);
        color:#475569;
        border-color:#e2e8f0;
    }

    :root[data-theme="dark"] .tip-box{
        background:#111827;
        color:#e5e7eb;
        border-color:#334155;
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
</style>
@endpush