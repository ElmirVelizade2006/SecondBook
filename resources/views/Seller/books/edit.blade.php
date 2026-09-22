@extends('Layout.Seller.master')

@section('title', 'Edit Book')

@push('css')
    <link rel="stylesheet" href="{{ asset('seller/css/books.css') }}">
@endpush

@section('content')

<div class="seller-books-page">

    {{-- Header --}}
    <div class="seller-page-heading">

        <div>
            <h1>Edit Book</h1>
            <p>Update your book information.</p>
        </div>

        <a
            href="{{ route('seller.books.show', $book) }}"
            class="seller-outline-button"
        >
            <i class="bi bi-arrow-left"></i>
            Back to Book
        </a>

    </div>

    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="seller-alert seller-alert-danger mb-4">

            <div class="seller-alert-icon">
                <i class="bi bi-exclamation-circle"></i>
            </div>

            <div>
                <strong>Please check the following errors:</strong>

                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        </div>

    @endif

    <form
        action="{{ route('seller.books.update', $book) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- Book Information --}}
            <div class="col-xl-8">

                <div class="seller-books-form-card">

                    <div class="seller-form-header">

                        <div>
                            <h5>Book Information</h5>
                            <p>Update the basic information of your book.</p>
                        </div>

                        <div class="seller-form-header-icon">
                            <i class="bi bi-book"></i>
                        </div>

                    </div>

                    <div class="seller-form-body">

                        {{-- Title --}}
                        <div class="seller-form-group">

                            <label for="title">
                                Book Title <span>*</span>
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="form-control"
                                value="{{ old('title', $book->title) }}"
                                placeholder="Enter book title"
                                required
                            >

                        </div>

                        <div class="row">

                            {{-- ISBN --}}
                            <div class="col-md-6">

                                <div class="seller-form-group">

                                    <label for="isbn">
                                        ISBN
                                    </label>

                                    <input
                                        type="text"
                                        id="isbn"
                                        name="isbn"
                                        class="form-control"
                                        value="{{ old('isbn', $book->isbn) }}"
                                        placeholder="Enter ISBN"
                                    >

                                </div>

                            </div>

                            {{-- Language --}}
                            <div class="col-md-6">

                                <div class="seller-form-group">

                                    <label for="language">
                                        Language
                                    </label>

                                    <input
                                        type="text"
                                        id="language"
                                        name="language"
                                        class="form-control"
                                        value="{{ old('language', $book->language) }}"
                                        placeholder="Enter language"
                                    >

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            {{-- Category --}}
                            <div class="col-md-4">

                                <div class="seller-form-group">

                                    <label for="category_id">
                                        Category
                                    </label>

                                    <select
                                        id="category_id"
                                        name="category_id"
                                        class="form-select"
                                    >

                                        <option value="">Select category</option>

                                        @foreach($categories as $category)

                                            <option
                                                value="{{ $category->id }}"
                                                @selected(old('category_id', $book->category_id) == $category->id)
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

                                    <label for="author_id">
                                        Author
                                    </label>

                                    <select
                                        id="author_id"
                                        name="author_id"
                                        class="form-select"
                                    >

                                        <option value="">Select author</option>

                                        @foreach($authors as $author)

                                            <option
                                                value="{{ $author->id }}"
                                                @selected(old('author_id', $book->author_id) == $author->id)
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

                                    <label for="publisher_id">
                                        Publisher
                                    </label>

                                    <select
                                        id="publisher_id"
                                        name="publisher_id"
                                        class="form-select"
                                    >

                                        <option value="">Select publisher</option>

                                        @foreach($publishers as $publisher)

                                            <option
                                                value="{{ $publisher->id }}"
                                                @selected(old('publisher_id', $book->publisher_id) == $publisher->id)
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

                            <label for="description">
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                class="form-control"
                                rows="6"
                                placeholder="Write a description about the book..."
                            >{{ old('description', $book->description) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Cover --}}
            <div class="col-xl-4">

                <div class="seller-books-form-card">

                    <div class="seller-form-header">

                        <div>
                            <h5>Book Cover</h5>
                            <p>Update the book cover.</p>
                        </div>

                        <div class="seller-form-header-icon">
                            <i class="bi bi-image"></i>
                        </div>

                    </div>

                    <div class="seller-form-body">

                        <div class="seller-book-cover-upload">

                            <div class="seller-book-cover-preview">

                                @if($book->cover)

                                    <img
                                        src="{{ asset('storage/' . $book->cover) }}"
                                        alt="{{ $book->title }}"
                                        id="coverPreview"
                                    >

                                @else

                                    <div id="coverPlaceholder">
                                        <i class="bi bi-book"></i>
                                        <span>No Cover</span>
                                    </div>

                                    <img
                                        id="coverPreview"
                                        src=""
                                        alt="Cover Preview"
                                        style="display:none;"
                                    >

                                @endif

                            </div>

                            <label
                                for="cover"
                                class="seller-cover-upload-button"
                            >
                                <i class="bi bi-upload"></i>
                                Change Cover
                            </label>

                            <input
                                type="file"
                                id="cover"
                                name="cover"
                                accept=".jpg,.jpeg,.png,.webp"
                                hidden
                            >

                            <small>
                                JPG, JPEG, PNG or WEBP. Maximum 2MB.
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Pricing & Inventory --}}
        <div class="seller-books-form-card mt-4">

            <div class="seller-form-header">

                <div>
                    <h5>Pricing & Inventory</h5>
                    <p>Update pricing, stock and book condition.</p>
                </div>

                <div class="seller-form-header-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

            </div>

            <div class="seller-form-body">

                <div class="row">

                    {{-- Price --}}
                    <div class="col-md-3">

                        <div class="seller-form-group">

                            <label for="price">
                                Price <span>*</span>
                            </label>

                            <div class="seller-input-prefix">
                                <span>$</span>

                                <input
                                    type="number"
                                    id="price"
                                    name="price"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('price', $book->price) }}"
                                    placeholder="0.00"
                                    required
                                >
                            </div>

                        </div>

                    </div>

                    {{-- Stock --}}
                    <div class="col-md-3">

                        <div class="seller-form-group">

                            <label for="stock">
                                Stock <span>*</span>
                            </label>

                            <input
                                type="number"
                                id="stock"
                                name="stock"
                                min="1"
                                value="{{ old('stock', $book->stock) }}"
                                placeholder="1"
                                required
                            >

                        </div>

                    </div>

                    {{-- Condition --}}
                    <div class="col-md-3">

                        <div class="seller-form-group">

                            <label for="condition">
                                Condition <span>*</span>
                            </label>

                            <select
                                id="condition"
                                name="condition"
                                class="form-select"
                                required
                            >

                                <option
                                    value="new"
                                    @selected(old('condition', $book->condition) === 'new')
                                >
                                    New
                                </option>

                                <option
                                    value="like_new"
                                    @selected(old('condition', $book->condition) === 'like_new')
                                >
                                    Like New
                                </option>

                                <option
                                    value="good"
                                    @selected(old('condition', $book->condition) === 'good')
                                >
                                    Good
                                </option>

                                <option
                                    value="fair"
                                    @selected(old('condition', $book->condition) === 'fair')
                                >
                                    Fair
                                </option>

                            </select>

                        </div>

                    </div>

                    {{-- Publication Year --}}
                    <div class="col-md-3">

                        <div class="seller-form-group">

                            <label for="publication_year">
                                Publication Year
                            </label>

                            <input
                                type="number"
                                id="publication_year"
                                name="publication_year"
                                min="1000"
                                max="{{ date('Y') }}"
                                value="{{ old('publication_year', $book->publication_year) }}"
                                placeholder="{{ date('Y') }}"
                            >

                        </div>

                    </div>

                </div>

                <div class="row">

                    {{-- Pages --}}
                    <div class="col-md-3">

                        <div class="seller-form-group">

                            <label for="pages">
                                Pages
                            </label>

                            <input
                                type="number"
                                id="pages"
                                name="pages"
                                min="1"
                                value="{{ old('pages', $book->pages) }}"
                                placeholder="Number of pages"
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Actions --}}
        <div class="seller-books-form-actions">

            <a
                href="{{ route('seller.books.show', $book) }}"
                class="seller-cancel-button"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="seller-save-button"
            >
                <i class="bi bi-check2"></i>
                Update Book
            </button>

        </div>

    </form>

</div>

@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const coverInput = document.getElementById('cover');
    const coverPreview = document.getElementById('coverPreview');
    const coverPlaceholder = document.getElementById('coverPlaceholder');

    if (coverInput && coverPreview) {

        coverInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                coverPreview.src = e.target.result;
                coverPreview.style.display = 'block';

                if (coverPlaceholder) {
                    coverPlaceholder.style.display = 'none';
                }

            };

            reader.readAsDataURL(file);
        });
    }

});
</script>
@endpush