@extends('Layout.Seller.master')

@section('title', 'Add New Book')

@push('css') <link rel="stylesheet" href="{{ asset('seller/css/books.css') }}">
@endpush

@section('content')

<div class="seller-books-page">

```
{{-- Header --}}
<div class="seller-page-heading">

    <div>
        <h1>Add New Book</h1>
        <p>Add a new book to your store for admin approval.</p>
    </div>

    <a href="{{ route('seller.books.index') }}" class="seller-outline-button">
        <i class="bi bi-arrow-left"></i>
        Back to My Books
    </a>

</div>


{{-- Validation Errors --}}
@if($errors->any())

    <div class="seller-alert seller-alert-danger">

        <div class="seller-alert-icon">
            <i class="bi bi-exclamation-circle"></i>
        </div>

        <div>
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    </div>

@endif


<form
    action="{{ route('seller.books.store') }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf

    <div class="row g-4">

        {{-- Main Information --}}
        <div class="col-xl-8">

            <div class="seller-books-form-card">

                <div class="seller-form-header">

                    <div>
                        <h5>Book Information</h5>
                        <p>Enter the main information about your book.</p>
                    </div>

                    <div class="seller-form-header-icon">
                        <i class="bi bi-book"></i>
                    </div>

                </div>


                <div class="seller-form-body">

                    {{-- Title --}}
                    <div class="seller-form-group">

                        <label for="title">
                            Book Title
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Enter book title"
                            required
                        >

                    </div>


                    <div class="row g-4">

                        {{-- ISBN --}}
                        <div class="col-md-6">

                            <div class="seller-form-group">

                                <label for="isbn">ISBN</label>

                                <input
                                    type="text"
                                    id="isbn"
                                    name="isbn"
                                    value="{{ old('isbn') }}"
                                    placeholder="Enter ISBN"
                                >

                            </div>

                        </div>


                        {{-- Language --}}
                        <div class="col-md-6">

                            <div class="seller-form-group">

                                <label for="language">Language</label>

                                <input
                                    type="text"
                                    id="language"
                                    name="language"
                                    value="{{ old('language', 'English') }}"
                                    placeholder="e.g. English"
                                >

                            </div>

                        </div>

                    </div>


                    <div class="row g-4">

                        {{-- Category --}}
                        <div class="col-md-4">

                            <div class="seller-form-group">

                                <label for="category_id">Category</label>

                                <select id="category_id" name="category_id">

                                    <option value="">Select Category</option>

                                    @foreach($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- Author --}}
                        <div class="col-md-4">

                            <div class="seller-form-group">

                                <label for="author_id">Author</label>

                                <select id="author_id" name="author_id">

                                    <option value="">Select Author</option>

                                    @foreach($authors as $author)

                                        <option
                                            value="{{ $author->id }}"
                                            {{ old('author_id') == $author->id ? 'selected' : '' }}
                                        >
                                            {{ $author->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- Publisher --}}
                        <div class="col-md-4">

                            <div class="seller-form-group">

                                <label for="publisher_id">Publisher</label>

                                <select id="publisher_id" name="publisher_id">

                                    <option value="">Select Publisher</option>

                                    @foreach($publishers as $publisher)

                                        <option
                                            value="{{ $publisher->id }}"
                                            {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}
                                        >
                                            {{ $publisher->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>


                    {{-- Description --}}
                    <div class="seller-form-group">

                        <label for="description">Description</label>

                        <textarea
                            id="description"
                            name="description"
                            rows="7"
                            placeholder="Write a description about the book..."
                        >{{ old('description') }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- Side Information --}}
        <div class="col-xl-4">

            {{-- Cover --}}
            <div class="seller-books-form-card mb-4">

                <div class="seller-form-header">

                    <div>
                        <h5>Book Cover</h5>
                        <p>Upload the cover image.</p>
                    </div>

                    <div class="seller-form-header-icon">
                        <i class="bi bi-image"></i>
                    </div>

                </div>


                <div class="seller-form-body">

                    <div class="seller-book-cover-upload">

                        <div class="seller-book-cover-preview">

                            <i class="bi bi-book"></i>

                            <span>Preview</span>

                        </div>


                        <label for="cover" class="seller-cover-upload-button">

                            <i class="bi bi-cloud-arrow-up"></i>

                            <span>Choose Cover</span>

                            <small>JPG, PNG or WEBP · Max 2MB</small>

                        </label>

                        <input
                            type="file"
                            id="cover"
                            name="cover"
                            accept=".jpg,.jpeg,.png,.webp"
                            hidden
                        >

                    </div>

                </div>

            </div>


            {{-- Pricing & Inventory --}}
            <div class="seller-books-form-card">

                <div class="seller-form-header">

                    <div>
                        <h5>Pricing & Inventory</h5>
                        <p>Set price and stock information.</p>
                    </div>

                    <div class="seller-form-header-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                </div>


                <div class="seller-form-body">

                    {{-- Price --}}
                    <div class="seller-form-group">

                        <label for="price">
                            Price
                            <span>*</span>
                        </label>

                        <div class="seller-input-prefix">
                            <span>$</span>

                            <input
                                type="number"
                                id="price"
                                name="price"
                                value="{{ old('price') }}"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                                required
                            >
                        </div>

                    </div>


                    {{-- Stock --}}
                    <div class="seller-form-group">

                        <label for="stock">
                            Stock
                            <span>*</span>
                        </label>

                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="{{ old('stock', 1) }}"
                            min="1"
                            placeholder="Enter stock quantity"
                            required
                        >

                    </div>


                    {{-- Condition --}}
                    <div class="seller-form-group">

                        <label for="condition">
                            Condition
                            <span>*</span>
                        </label>

                        <select id="condition" name="condition" required>

                            <option value="">Select Condition</option>

                            <option value="new"
                                {{ old('condition') === 'new' ? 'selected' : '' }}>
                                New
                            </option>

                            <option value="like_new"
                                {{ old('condition') === 'like_new' ? 'selected' : '' }}>
                                Like New
                            </option>

                            <option value="good"
                                {{ old('condition', 'good') === 'good' ? 'selected' : '' }}>
                                Good
                            </option>

                            <option value="fair"
                                {{ old('condition') === 'fair' ? 'selected' : '' }}>
                                Fair
                            </option>

                        </select>

                    </div>


                    {{-- Publication Year --}}
                    <div class="seller-form-group">

                        <label for="publication_year">
                            Publication Year
                        </label>

                        <input
                            type="number"
                            id="publication_year"
                            name="publication_year"
                            value="{{ old('publication_year') }}"
                            min="1000"
                            max="{{ date('Y') }}"
                            placeholder="e.g. 2024"
                        >

                    </div>


                    {{-- Pages --}}
                    <div class="seller-form-group">

                        <label for="pages">Pages</label>

                        <input
                            type="number"
                            id="pages"
                            name="pages"
                            value="{{ old('pages') }}"
                            min="1"
                            placeholder="e.g. 320"
                        >

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Form Actions --}}
    <div class="seller-books-form-actions">

        <a
            href="{{ route('seller.books.index') }}"
            class="seller-cancel-button"
        >
            Cancel
        </a>

        <button type="submit" class="seller-save-button">
            <i class="bi bi-check-lg"></i>
            Add Book
        </button>

    </div>

</form>
```

</div>

@endsection
