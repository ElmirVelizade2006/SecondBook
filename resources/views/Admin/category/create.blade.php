@extends('layout.admin.master')

@section('title', 'Add Category')

@section('content')

<div class="dashboard-section category-page">

    {{-- PAGE HEADER --}}
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


    {{-- FORM PANEL --}}
    <div class="dashboard-panel">

        {{-- VALIDATION ERRORS --}}
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <div class="fw-semibold mb-2">
                    Please fix the following errors:
                </div>

                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form
            action="{{ route('admin.categories.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="row g-4">

                {{-- LEFT SIDE --}}
                <div class="col-12 col-lg-8">

                    {{-- CATEGORY NAME --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Category Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter category name"
                            required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- SLUG --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Slug
                        </label>

                        <input
                            type="text"
                            class="form-control @error('slug') is-invalid @enderror"
                            name="slug"
                            value="{{ old('slug') }}"
                            placeholder="example: fiction-books">

                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            Leave empty if the slug is generated automatically in the controller.
                        </small>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Description
                        </label>

                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            name="description"
                            rows="6"
                            placeholder="Write a short description for this category...">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- STATUS --}}
                    <div class="form-check mt-4">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="status"
                            value="1"
                            id="status"
                            {{ old('status', 1) ? 'checked' : '' }}>

                        <label
                            class="form-check-label fw-medium"
                            for="status">
                            Active category
                        </label>

                    </div>

                </div>


                {{-- RIGHT SIDE --}}
                <div class="col-12 col-lg-4">

                    <div class="category-image-upload">

                        <label class="form-label fw-semibold">
                            Category Image
                        </label>

                        {{-- IMAGE PREVIEW --}}
                        <div
                            class="category-image-preview mb-3"
                            id="categoryImagePreview">

                            <div class="category-image-placeholder">
                                <i class="bi bi-image"></i>
                                <span>Image Preview</span>
                            </div>

                        </div>


                        {{-- FILE INPUT --}}
                        <input
                            type="file"
                            class="form-control @error('image') is-invalid @enderror"
                            name="image"
                            id="categoryImage"
                            accept="image/*">

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted d-block mt-2">
                            Recommended: square image for better category card consistency.
                        </small>

                    </div>


                    {{-- TIP --}}
                    <div class="p-3 rounded border small tip-box mt-4">

                        <div class="d-flex align-items-start gap-2">

                            <i class="bi bi-lightbulb mt-1"></i>

                            <div>
                                <strong class="d-block mb-1">
                                    Tip
                                </strong>

                                Use a clear, high-quality image related to the category.
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ACTIONS --}}
            <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">

                <button
                    type="submit"
                    class="btn btn-primary px-4">

                    <i class="bi bi-check2-circle me-2"></i>
                    Save Category

                </button>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-light border px-4">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>


{{-- IMAGE PREVIEW SCRIPT --}}
@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('categoryImage');
    const imagePreview = document.getElementById('categoryImagePreview');

    if (!imageInput || !imagePreview) {
        return;
    }

    imageInput.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {
            imagePreview.innerHTML = `
                <div class="category-image-placeholder">
                    <i class="bi bi-image"></i>
                    <span>Image Preview</span>
                </div>
            `;
            return;
        }

        if (!file.type.startsWith('image/')) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {

            imagePreview.innerHTML = `
                <img
                    src="${e.target.result}"
                    alt="Category preview"
                    class="img-fluid rounded category-preview-image">
            `;

        };

        reader.readAsDataURL(file);

    });

});
</script>

@endpush

@endsection

