@extends('layout.admin.master')

@section('title', 'Edit Category')

@section('content')

<div class="dashboard-section category-page">

    {{-- PAGE HEADER --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Edit Category</h5>
                <p class="text-muted mb-0 small">
                    Update category details
                </p>
            </div>

            <a
                href="{{ route('admin.categories.index') }}"
                class="btn btn-light border">

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
            action="{{ route('admin.categories.update', $category->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')


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
                            value="{{ old('name', $category->name) }}"
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
                            value="{{ old('slug', $category->slug) }}"
                            placeholder="example: fiction-books">

                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            Use a unique URL-friendly slug for this category.
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
                            placeholder="Write a short description for this category...">{{ old('description', $category->description) }}</textarea>

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
                            {{ old('status', $category->status) ? 'checked' : '' }}>

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


                        {{-- CURRENT IMAGE / PREVIEW --}}
                        <div
                            class="category-image-preview mb-3"
                            id="categoryImagePreview">

                            @if(!empty($category->image))

                                @php

                                    $categoryImageUrl = filter_var(
                                        $category->image,
                                        FILTER_VALIDATE_URL
                                    )
                                        ? $category->image
                                        : asset('storage/' . $category->image);

                                @endphp

                                <img
                                    src="{{ $categoryImageUrl }}"
                                    alt="{{ $category->name }}"
                                    class="img-fluid rounded border category-preview-image"
                                    loading="lazy">

                            @else

                                <div class="category-image-placeholder">

                                    <i class="bi bi-image"></i>

                                    <span>
                                        No image uploaded
                                    </span>

                                </div>

                            @endif

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
                            Leave empty to keep the current image.
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

                                Use a clear, square image for better consistency
                                across category cards.

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
                    Update Category

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
                    alt="New category preview"
                    class="img-fluid rounded border category-preview-image">
            `;

        };

        reader.readAsDataURL(file);

    });

});
</script>

@endpush

@endsection

