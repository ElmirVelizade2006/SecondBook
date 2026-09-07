@extends('layout.admin.master')

@section('title', 'Add Book')

@section('content')

<div class="dashboard-section">

    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Add Book</h5>
                <p class="text-muted mb-0 small">
                    Create a new book listing
                </p>
            </div>

            <a href="{{ route('admin.books.index') }}" class="btn btn-light border">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Books
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

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row g-4">

                <div class="col-12 col-lg-8">

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Book Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" placeholder="Enter book title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ISBN --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">ISBN</label>
                        <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror"
                               value="{{ old('isbn') }}" placeholder="e.g. 978-3-16-148410-0">
                        @error('isbn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">

                        {{-- Author --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Author</label>
                            <select name="author_id" class="form-select @error('author_id') is-invalid @enderror">
                                <option value="">Select author</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Publisher --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Publisher</label>
                            <select name="publisher_id" class="form-select @error('publisher_id') is-invalid @enderror">
                                <option value="">Select publisher</option>
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                        {{ $publisher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('publisher_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Condition --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Condition</label>
                            <select name="condition" class="form-select">
                                <option value="new"      {{ old('condition') == 'new'      ? 'selected' : '' }}>New</option>
                                <option value="like_new" {{ old('condition', 'like_new') == 'like_new' ? 'selected' : '' }}>Like New</option>
                                <option value="good"     {{ old('condition') == 'good'     ? 'selected' : '' }}>Good</option>
                                <option value="fair"     {{ old('condition') == 'fair'     ? 'selected' : '' }}>Fair</option>
                            </select>
                        </div>

                        {{-- Price --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Price ($)</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                   step="0.01" min="0" value="{{ old('price', '0.00') }}" placeholder="0.00">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Stock --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Stock</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                   min="0" value="{{ old('stock', 1) }}" placeholder="1">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Language --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Language</label>
                            <input type="text" name="language" class="form-control"
                                   value="{{ old('language', 'English') }}" placeholder="English">
                        </div>

                        {{-- Publication Year --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Publication Year</label>
                            <input type="number" name="publication_year" class="form-control @error('publication_year') is-invalid @enderror"
                                   min="1000" max="{{ date('Y') }}" value="{{ old('publication_year') }}" placeholder="{{ date('Y') }}">
                            @error('publication_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pages --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pages</label>
                            <input type="number" name="pages" class="form-control @error('pages') is-invalid @enderror"
                                   min="1" value="{{ old('pages') }}" placeholder="Number of pages">
                            @error('pages')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Seller --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Seller</label>
                            <select name="seller_id" class="form-select @error('seller_id') is-invalid @enderror">
                                <option value="">Select seller</option>
                                @foreach($sellers as $seller)
                                    <option value="{{ $seller->id }}" {{ old('seller_id') == $seller->id ? 'selected' : '' }}>
                                        {{ $seller->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('seller_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="5"
                                  placeholder="Write a short description about the book...">{{ old('description') }}</textarea>
                    </div>

                </div>

                <div class="col-12 col-lg-4">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Cover Image</label>
                            <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
                            @error('cover')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="pending"  {{ old('status', 'pending') == 'pending'  ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            Save Book
                        </button>
                        <a href="{{ route('admin.books.index') }}" class="btn btn-light border">
                            Cancel
                        </a>
                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection

@push('css')
<style>
    .form-control,
    .form-select{
        border-radius:14px;
        padding:12px 16px;
        color:#111827 !important;
        background-color:#fff !important;
        border-color:#cbd5e1;
    }

    .form-control::placeholder{
        color:#64748b;
        opacity:1;
    }

    :root[data-theme="dark"] .form-control,
    :root[data-theme="dark"] .form-select{
        color:#f8fafc !important;
        background-color:#0f172a !important;
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

    .cover-upload-card{
        background-color:var(--bs-tertiary-bg);
        border:1px solid var(--bs-border-color);
    }

    .form-label{
        color:var(--bs-body-color);
        margin-bottom:8px;
        font-weight:600;
    }
</style>
@endpush
