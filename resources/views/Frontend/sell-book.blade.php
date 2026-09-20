@extends('Layout.Frontend.master')

@section('title', 'Sell a Book | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/sell-book.css') }}">
@endpush

@section('content')

<main class="sb-sell-page">

    {{-- =========================================================
        HERO
    ========================================================== --}}
    <section class="sell-hero">

        <div class="container">

            <div class="sell-breadcrumb">
                <a href="{{ route('frontend.home') }}">
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>Sell a Book</span>
            </div>

            <div class="sell-hero-content">

                <span class="sell-eyebrow">
                    <i class="bi bi-book-half"></i>
                    Give Your Book A New Chapter
                </span>

                <h1>
                    Sell Your Book
                </h1>

                <p>
                    List your book on SecondBook and connect it
                    with someone who is looking for their next read.
                </p>

            </div>

        </div>

    </section>


    {{-- =========================================================
        FORM SECTION
    ========================================================== --}}
    <section class="sell-section">

        <div class="container">

            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="sell-alert sell-alert-success">
                    <i class="bi bi-check-circle-fill"></i>

                    <div>
                        <strong>Book submitted successfully</strong>

                        <span>
                            {{ session('success') }}
                        </span>
                    </div>
                </div>

            @endif


            {{-- VALIDATION ERRORS --}}
            @if($errors->any())

                <div class="sell-alert sell-alert-error">

                    <i class="bi bi-exclamation-circle-fill"></i>

                    <div>

                        <strong>
                            Please check the form
                        </strong>

                        <ul>
                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>

                    </div>

                </div>

            @endif


            <div class="sell-layout">

                {{-- =================================================
                    MAIN FORM
                ================================================== --}}
                <div class="sell-main">

                    <form
                        action="{{ route('frontend.sell-book.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="sell-form"
                    >

                        @csrf


                        {{-- =================================================
                            BOOK INFORMATION
                        ================================================== --}}
                        <div class="sell-card">

                            <div class="sell-card-header">

                                <div class="sell-card-icon">
                                    <i class="bi bi-book"></i>
                                </div>

                                <div>
                                    <span>
                                        STEP 01
                                    </span>

                                    <h2>
                                        Book Information
                                    </h2>

                                    <p>
                                        Tell us about the book you want to sell.
                                    </p>
                                </div>

                            </div>


                            <div class="sell-form-grid">

                                {{-- TITLE --}}
                                <div class="sell-field full">

                                    <label for="title">
                                        Book Title
                                        <span>*</span>
                                    </label>

                                    <div class="sell-input-wrap">

                                        <i class="bi bi-bookmark"></i>

                                        <input
                                            type="text"
                                            id="title"
                                            name="title"
                                            value="{{ old('title') }}"
                                            placeholder="Enter the book title"
                                            required
                                        >

                                    </div>

                                    @error('title')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- ISBN --}}
                                <div class="sell-field">

                                    <label for="isbn">
                                        ISBN
                                    </label>

                                    <div class="sell-input-wrap">

                                        <i class="bi bi-upc-scan"></i>

                                        <input
                                            type="text"
                                            id="isbn"
                                            name="isbn"
                                            value="{{ old('isbn') }}"
                                            placeholder="Enter ISBN"
                                        >

                                    </div>

                                    @error('isbn')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- LANGUAGE --}}
                                <div class="sell-field">

                                    <label for="language">
                                        Language
                                        <span>*</span>
                                    </label>

                                    <div class="sell-input-wrap">

                                        <i class="bi bi-translate"></i>

                                        <input
                                            type="text"
                                            id="language"
                                            name="language"
                                            value="{{ old('language', 'English') }}"
                                            placeholder="e.g. English"
                                            required
                                        >

                                    </div>

                                    @error('language')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- CATEGORY --}}
                                <div class="sell-field">

                                    <label for="category_id">
                                        Category
                                        <span>*</span>
                                    </label>

                                    <div class="sell-select-wrap">

                                        <i class="bi bi-grid"></i>

                                        <select
                                            id="category_id"
                                            name="category_id"
                                            required
                                        >

                                            <option value="">
                                                Select category
                                            </option>

                                            @foreach($categories as $category)

                                                <option
                                                    value="{{ $category->id }}"
                                                    @selected(
                                                        old('category_id') == $category->id
                                                    )
                                                >
                                                    {{ $category->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <i class="bi bi-chevron-down select-arrow"></i>

                                    </div>

                                    @error('category_id')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- AUTHOR --}}
                                <div class="sell-field">

                                    <label for="author_id">
                                        Author
                                        <span>*</span>
                                    </label>

                                    <div class="sell-select-wrap">

                                        <i class="bi bi-person"></i>

                                        <select
                                            id="author_id"
                                            name="author_id"
                                            required
                                        >

                                            <option value="">
                                                Select author
                                            </option>

                                            @foreach($authors as $author)

                                                <option
                                                    value="{{ $author->id }}"
                                                    @selected(
                                                        old('author_id') == $author->id
                                                    )
                                                >
                                                    {{ $author->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <i class="bi bi-chevron-down select-arrow"></i>

                                    </div>

                                    @error('author_id')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- PUBLISHER --}}
                                <div class="sell-field">

                                    <label for="publisher_id">
                                        Publisher
                                    </label>

                                    <div class="sell-select-wrap">

                                        <i class="bi bi-building"></i>

                                        <select
                                            id="publisher_id"
                                            name="publisher_id"
                                        >

                                            <option value="">
                                                Select publisher
                                            </option>

                                            @foreach($publishers as $publisher)

                                                <option
                                                    value="{{ $publisher->id }}"
                                                    @selected(
                                                        old('publisher_id') == $publisher->id
                                                    )
                                                >
                                                    {{ $publisher->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <i class="bi bi-chevron-down select-arrow"></i>

                                    </div>

                                    @error('publisher_id')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- PUBLICATION YEAR --}}
                                <div class="sell-field">

                                    <label for="publication_year">
                                        Publication Year
                                    </label>

                                    <div class="sell-input-wrap">

                                        <i class="bi bi-calendar3"></i>

                                        <input
                                            type="number"
                                            id="publication_year"
                                            name="publication_year"
                                            value="{{ old('publication_year') }}"
                                            placeholder="e.g. 2024"
                                            min="1000"
                                            max="{{ date('Y') }}"
                                        >

                                    </div>

                                    @error('publication_year')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- PAGES --}}
                                <div class="sell-field">

                                    <label for="pages">
                                        Number of Pages
                                    </label>

                                    <div class="sell-input-wrap">

                                        <i class="bi bi-file-text"></i>

                                        <input
                                            type="number"
                                            id="pages"
                                            name="pages"
                                            value="{{ old('pages') }}"
                                            placeholder="e.g. 320"
                                            min="1"
                                        >

                                    </div>

                                    @error('pages')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            PRICING & CONDITION
                        ================================================== --}}
                        <div class="sell-card">

                            <div class="sell-card-header">

                                <div class="sell-card-icon">
                                    <i class="bi bi-tags"></i>
                                </div>

                                <div>
                                    <span>
                                        STEP 02
                                    </span>

                                    <h2>
                                        Pricing & Condition
                                    </h2>

                                    <p>
                                        Set your selling price and describe
                                        the condition of your book.
                                    </p>
                                </div>

                            </div>


                            <div class="sell-form-grid">

                                {{-- PRICE --}}
                                <div class="sell-field">

                                    <label for="price">
                                        Price
                                        <span>*</span>
                                    </label>

                                    <div class="sell-input-wrap price-input">

                                        <span class="currency-symbol">
                                            ₼
                                        </span>

                                        <input
                                            type="number"
                                            id="price"
                                            name="price"
                                            value="{{ old('price') }}"
                                            placeholder="0.00"
                                            step="0.01"
                                            min="0"
                                            required
                                        >

                                    </div>

                                    @error('price')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- STOCK --}}
                                <div class="sell-field">

                                    <label for="stock">
                                        Stock
                                        <span>*</span>
                                    </label>

                                    <div class="sell-input-wrap">

                                        <i class="bi bi-box-seam"></i>

                                        <input
                                            type="number"
                                            id="stock"
                                            name="stock"
                                            value="{{ old('stock', 1) }}"
                                            placeholder="Available quantity"
                                            min="1"
                                            required
                                        >

                                    </div>

                                    @error('stock')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- CONDITION --}}
                                <div class="sell-field full">

                                    <label>
                                        Book Condition
                                        <span>*</span>
                                    </label>

                                    <div class="condition-grid">

                                        <label class="condition-option">

                                            <input
                                                type="radio"
                                                name="condition"
                                                value="new"
                                                @checked(old('condition') === 'new')
                                                required
                                            >

                                            <span class="condition-content">

                                                <i class="bi bi-stars"></i>

                                                <strong>
                                                    New
                                                </strong>

                                                <small>
                                                    Brand new condition
                                                </small>

                                            </span>

                                        </label>


                                        <label class="condition-option">

                                            <input
                                                type="radio"
                                                name="condition"
                                                value="like_new"
                                                @checked(old('condition') === 'like_new')
                                            >

                                            <span class="condition-content">

                                                <i class="bi bi-gem"></i>

                                                <strong>
                                                    Like New
                                                </strong>

                                                <small>
                                                    Almost perfect
                                                </small>

                                            </span>

                                        </label>


                                        <label class="condition-option">

                                            <input
                                                type="radio"
                                                name="condition"
                                                value="good"
                                                @checked(old('condition', 'good') === 'good')
                                            >

                                            <span class="condition-content">

                                                <i class="bi bi-hand-thumbs-up"></i>

                                                <strong>
                                                    Good
                                                </strong>

                                                <small>
                                                    Good overall condition
                                                </small>

                                            </span>

                                        </label>


                                        <label class="condition-option">

                                            <input
                                                type="radio"
                                                name="condition"
                                                value="fair"
                                                @checked(old('condition') === 'fair')
                                            >

                                            <span class="condition-content">

                                                <i class="bi bi-bookmark"></i>

                                                <strong>
                                                    Fair
                                                </strong>

                                                <small>
                                                    Shows some wear
                                                </small>

                                            </span>

                                        </label>

                                    </div>

                                    @error('condition')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            COVER & DESCRIPTION
                        ================================================== --}}
                        <div class="sell-card">

                            <div class="sell-card-header">

                                <div class="sell-card-icon">
                                    <i class="bi bi-image"></i>
                                </div>

                                <div>
                                    <span>
                                        STEP 03
                                    </span>

                                    <h2>
                                        Cover & Description
                                    </h2>

                                    <p>
                                        Add a cover and describe your book.
                                    </p>
                                </div>

                            </div>


                            <div class="sell-form-grid">

                                {{-- COVER --}}
                                <div class="sell-field full">

                                    <label for="cover">
                                        Book Cover
                                    </label>

                                    <div class="cover-upload">

                                        <input
                                            type="file"
                                            id="cover"
                                            name="cover"
                                            accept=".jpg,.jpeg,.png,.webp"
                                        >

                                        <label
                                            for="cover"
                                            class="cover-upload-box"
                                        >

                                            <span class="cover-upload-icon">
                                                <i class="bi bi-cloud-arrow-up"></i>
                                            </span>

                                            <strong>
                                                Upload Book Cover
                                            </strong>

                                            <small>
                                                JPG, JPEG, PNG or WEBP
                                                · Max 5MB
                                            </small>

                                        </label>

                                    </div>

                                    @error('cover')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- DESCRIPTION --}}
                                <div class="sell-field full">

                                    <label for="description">
                                        Description
                                        <span>*</span>
                                    </label>

                                    <div class="sell-textarea-wrap">

                                        <textarea
                                            id="description"
                                            name="description"
                                            rows="7"
                                            maxlength="5000"
                                            placeholder="Tell potential buyers about the book, its condition, special notes, etc."
                                            required
                                        >{{ old('description') }}</textarea>

                                        <span class="textarea-counter">
                                            0 / 5000
                                        </span>

                                    </div>

                                    @error('description')
                                        <small class="sell-error">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            SUBMIT
                        ================================================== --}}
                        <div class="sell-submit-area">

                            <div class="sell-submit-note">

                                <i class="bi bi-shield-check"></i>

                                <span>
                                    Your book will be reviewed by our team
                                    before it becomes visible to buyers.
                                </span>

                            </div>

                            <button
                                type="submit"
                                class="sell-submit-btn"
                            >
                                <i class="bi bi-send"></i>
                                Submit Book
                            </button>

                        </div>

                    </form>

                </div>


                {{-- =================================================
                    SIDEBAR
                ================================================== --}}
                <aside class="sell-sidebar">

                    <div class="sell-sidebar-card">

                        <div class="sell-sidebar-icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>

                        <h3>
                            Before You Submit
                        </h3>

                        <p>
                            A few things to keep in mind when listing
                            your book.
                        </p>

                        <ul>

                            <li>
                                <i class="bi bi-check2"></i>
                                Make sure your book information is accurate.
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Use a clear and recognizable book cover.
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Select the correct book condition.
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Set a fair and realistic price.
                            </li>

                            <li>
                                <i class="bi bi-check2"></i>
                                Your listing will require admin approval.
                            </li>

                        </ul>

                    </div>


                    <div class="sell-sidebar-card sell-how-card">

                        <span class="sell-sidebar-label">
                            HOW IT WORKS
                        </span>

                        <div class="sell-step">

                            <span>01</span>

                            <div>
                                <strong>
                                    Submit
                                </strong>

                                <p>
                                    Add your book details.
                                </p>
                            </div>

                        </div>


                        <div class="sell-step">

                            <span>02</span>

                            <div>
                                <strong>
                                    Review
                                </strong>

                                <p>
                                    Our admin reviews your listing.
                                </p>
                            </div>

                        </div>


                        <div class="sell-step">

                            <span>03</span>

                            <div>
                                <strong>
                                    Sell
                                </strong>

                                <p>
                                    Your approved book goes live.
                                </p>
                            </div>

                        </div>

                    </div>

                </aside>

            </div>

        </div>

    </section>

</main>

@endsection

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const textarea = document.getElementById('description');
    const counter = document.querySelector('.textarea-counter');
    const coverInput = document.getElementById('cover');
    const uploadBox = document.querySelector('.cover-upload-box');

    if (textarea && counter) {

        function updateCounter() {
            counter.textContent =
                textarea.value.length + ' / 5000';
        }

        textarea.addEventListener('input', updateCounter);

        updateCounter();
    }


    if (coverInput && uploadBox) {

        coverInput.addEventListener('change', function () {

            if (!this.files.length) {
                return;
            }

            const file = this.files[0];

            uploadBox.querySelector('strong').textContent =
                file.name;

            uploadBox.querySelector('small').textContent =
                (file.size / 1024 / 1024).toFixed(2) + ' MB selected';
        });

    }

});
</script>

@endpush