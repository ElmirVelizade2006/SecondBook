@extends('Layout.Seller.master')

@section('title', 'My Books')

@push('css')

<link rel="stylesheet" href="{{ asset('seller/css/books.css') }}">

@endpush

@section('content')

<div class="seller-books-page">

    {{-- Header --}}

    <div class="seller-page-heading">

        <div>
            <h1>My Books</h1>
            <p>Manage the books available in your store.</p>
        </div>

        <a href="{{ route('seller.books.create') }}" class="seller-primary-button">
            <i class="bi bi-plus-lg"></i>
            Add New Book
        </a>

    </div>


    {{-- Statistics --}}

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="seller-book-stat-card">

                <div class="seller-book-stat-icon">
                    <i class="bi bi-book"></i>
                </div>

                <div>
                    <span>Total Books</span>
                    <h3 id="totalBooksCount">{{ $totalBooks }}</h3>
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="seller-book-stat-card">

                <div class="seller-book-stat-icon approved">
                    <i class="bi bi-check-circle"></i>
                </div>

                <div>
                    <span>Approved</span>
                    <h3>{{ $approvedBooks }}</h3>
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="seller-book-stat-card">

                <div class="seller-book-stat-icon pending">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div>
                    <span>Pending</span>
                    <h3>{{ $pendingBooks }}</h3>
                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="seller-book-stat-card">

                <div class="seller-book-stat-icon rejected">
                    <i class="bi bi-x-circle"></i>
                </div>

                <div>
                    <span>Rejected</span>
                    <h3>{{ $rejectedBooks }}</h3>
                </div>

            </div>

        </div>

    </div>


    {{-- Books Panel --}}

    <div class="seller-books-panel">

        {{-- Filters --}}

        <div class="seller-books-filter">

            <form
                method="GET"
                action="{{ route('seller.books.index') }}"
            >

                <div class="seller-search-group">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search books..."
                    >

                </div>


                <select name="status" class="seller-filter-select">

                    <option value="">All Statuses</option>

                    <option
                        value="approved"
                        {{ request('status') === 'approved' ? 'selected' : '' }}
                    >
                        Approved
                    </option>

                    <option
                        value="pending"
                        {{ request('status') === 'pending' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="rejected"
                        {{ request('status') === 'rejected' ? 'selected' : '' }}
                    >
                        Rejected
                    </option>

                </select>


                <select name="condition" class="seller-filter-select">

                    <option value="">All Conditions</option>

                    <option
                        value="new"
                        {{ request('condition') === 'new' ? 'selected' : '' }}
                    >
                        New
                    </option>

                    <option
                        value="like_new"
                        {{ request('condition') === 'like_new' ? 'selected' : '' }}
                    >
                        Like New
                    </option>

                    <option
                        value="good"
                        {{ request('condition') === 'good' ? 'selected' : '' }}
                    >
                        Good
                    </option>

                    <option
                        value="fair"
                        {{ request('condition') === 'fair' ? 'selected' : '' }}
                    >
                        Fair
                    </option>

                </select>


                <button
                    type="submit"
                    class="seller-filter-button"
                >
                    Search
                </button>


                @if(
                    request()->filled('search') ||
                    request()->filled('status') ||
                    request()->filled('condition')
                )

                    <a
                        href="{{ route('seller.books.index') }}"
                        class="seller-reset-button"
                    >
                        Reset
                    </a>

                @endif

            </form>

        </div>


        {{-- Table --}}

        @if($books->count())

            <div class="table-responsive">

                <table class="table seller-books-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Book</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Condition</th>
                            <th>Status</th>
                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($books as $book)

                            <tr id="book-row-{{ $book->id }}">

                                {{-- Book --}}

                                <td>

                                    <div class="seller-book-info">

                                        <div class="seller-book-cover">

                                            @if($book->cover)

                                                <img
                                                    src="{{ asset('storage/' . $book->cover) }}"
                                                    alt="{{ $book->title }}"
                                                >

                                            @else

                                                <i class="bi bi-book"></i>

                                            @endif

                                        </div>


                                        <div>

                                            <strong>
                                                {{ $book->title }}
                                            </strong>

                                            @if($book->isbn)

                                                <span>
                                                    ISBN: {{ $book->isbn }}
                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Category --}}

                                <td>
                                    {{ $book->category?->name ?? '—' }}
                                </td>


                                {{-- Price --}}

                                <td>

                                    <strong>
                                        ${{ number_format($book->price, 2) }}
                                    </strong>

                                </td>


                                {{-- Stock --}}

                                <td>
                                    {{ $book->stock }}
                                </td>


                                {{-- Condition --}}

                                <td>

                                    <span class="seller-condition">
                                        {{ ucwords(str_replace('_', ' ', $book->condition)) }}
                                    </span>

                                </td>


                                {{-- Status --}}

                                <td>

                                    <span class="seller-book-status {{ $book->status }}">
                                        {{ ucfirst($book->status) }}
                                    </span>

                                </td>


                                {{-- Actions --}}

                                <td>

                                    <div class="seller-book-actions">

                                        <a
                                            href="{{ route('seller.books.show', $book) }}"
                                            title="View"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        <a
                                            href="{{ route('seller.books.edit', $book) }}"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        <button
                                            type="button"
                                            class="seller-action-button seller-delete-button"
                                            title="Delete"
                                            data-delete-book="{{ $book->id }}"
                                            data-book-title="{{ $book->title }}"
                                            data-delete-url="{{ route('seller.books.destroy', $book) }}"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}

            @if($books->hasPages())

                <div class="seller-books-pagination">
                    {{ $books->links() }}
                </div>

            @endif

        @else

            <div class="seller-books-empty">

                <div class="seller-books-empty-icon">
                    <i class="bi bi-book"></i>
                </div>

                <h5>No Books Found</h5>

                <p>
                    You don't have any books matching your search.
                </p>

                <a
                    href="{{ route('seller.books.create') }}"
                    class="seller-primary-button"
                >
                    <i class="bi bi-plus-lg"></i>
                    Add Your First Book
                </a>

            </div>

        @endif

    </div>

</div>

@endsection


{{-- Delete Form --}}

<form
    id="deleteBookForm"
    method="POST"
    style="display: none;"
>
    @csrf
    @method('DELETE')
</form>


{{-- Delete Confirmation Modal --}}

<div
    class="seller-modal-overlay"
    id="deleteBookModal"
>

    <div class="seller-delete-modal">

        <button
            type="button"
            class="seller-modal-close"
            id="closeDeleteModal"
        >
            <i class="bi bi-x"></i>
        </button>


        <div class="seller-delete-icon">
            <i class="bi bi-trash3"></i>
        </div>


        <h4>Delete Book?</h4>


        <p>
            Are you sure you want to delete
            <strong id="deleteBookTitle"></strong>?
            <br>
            This action cannot be undone.
        </p>


        <div class="seller-delete-actions">

            <button
                type="button"
                class="seller-modal-cancel"
                id="cancelDelete"
            >
                Cancel
            </button>


            <button
                type="button"
                class="seller-modal-delete"
                id="confirmDelete"
            >
                <i class="bi bi-trash3"></i>
                Delete Book
            </button>

        </div>

    </div>

</div>


{{-- Success Alert --}}

<div
    class="seller-success-alert"
    id="sellerSuccessAlert"
    style="display: none;"
>

    <div class="seller-success-icon">
        <i class="bi bi-check-lg"></i>
    </div>


    <div class="seller-success-content">

        <strong>Success</strong>

        <span id="sellerSuccessMessage">
            Book deleted successfully.
        </span>

    </div>


    <button
        type="button"
        class="seller-success-close"
        id="closeSuccessAlert"
    >
        <i class="bi bi-x"></i>
    </button>

</div>


@push('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('deleteBookModal');

    const deleteForm = document.getElementById('deleteBookForm');

    const deleteTitle = document.getElementById('deleteBookTitle');

    const closeModal = document.getElementById('closeDeleteModal');

    const cancelDelete = document.getElementById('cancelDelete');

    const confirmDelete = document.getElementById('confirmDelete');

    const deleteButtons = document.querySelectorAll(
        '[data-delete-book]'
    );


    let selectedBookId = null;

    let selectedBookRow = null;

    let selectedDeleteUrl = null;


    /*
    |--------------------------------------------------------------------------
    | Open Delete Modal
    |--------------------------------------------------------------------------
    */

    deleteButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            selectedBookId = this.dataset.deleteBook;

            selectedBookRow = document.getElementById(
                'book-row-' + selectedBookId
            );

            selectedDeleteUrl = this.dataset.deleteUrl;


            const bookTitle = this.dataset.bookTitle;

            deleteTitle.textContent = bookTitle;


            deleteForm.action = selectedDeleteUrl;


            modal.classList.add('show');

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Hide Delete Modal
    |--------------------------------------------------------------------------
    */

    function hideDeleteModal() {

        modal.classList.remove('show');

        selectedBookId = null;

        selectedBookRow = null;

        selectedDeleteUrl = null;

    }


    closeModal.addEventListener(
        'click',
        hideDeleteModal
    );


    cancelDelete.addEventListener(
        'click',
        hideDeleteModal
    );


    modal.addEventListener('click', function (event) {

        if (event.target === modal) {

            hideDeleteModal();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Delete Book With AJAX
    |--------------------------------------------------------------------------
    */

    confirmDelete.addEventListener(
        'click',
        async function () {

            if (
                !selectedBookId ||
                !selectedBookRow ||
                !selectedDeleteUrl
            ) {
                return;
            }


            const row = selectedBookRow;


            confirmDelete.disabled = true;


            const originalButtonContent =
                confirmDelete.innerHTML;


            confirmDelete.innerHTML = `
                <span
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                ></span>
                Deleting...
            `;


            try {

                const csrfToken =
                    deleteForm.querySelector(
                        'input[name="_token"]'
                    ).value;


                const formData =
                    new FormData(deleteForm);


                const response = await fetch(
                    selectedDeleteUrl,
                    {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },

                        body: formData
                    }
                );


                const data =
                    await response.json();


                if (
                    !response.ok ||
                    !data.success
                ) {

                    throw new Error(
                        data.message ||
                        'Unable to delete the book.'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Close Modal
                |--------------------------------------------------------------------------
                */

                hideDeleteModal();


                /*
                |--------------------------------------------------------------------------
                | Get Book Status Before Removing Row
                |--------------------------------------------------------------------------
                */

                const statusElement =
                    row.querySelector(
                        '.seller-book-status'
                    );


                const bookStatus =
                    statusElement
                        ? statusElement.textContent
                            .trim()
                            .toLowerCase()
                        : null;


                /*
                |--------------------------------------------------------------------------
                | Remove Row With Animation
                |--------------------------------------------------------------------------
                */

                row.style.transition =
                    'opacity 0.25s ease, transform 0.25s ease';

                row.style.opacity = '0';

                row.style.transform =
                    'translateX(15px)';


                setTimeout(function () {

                    row.remove();


                    /*
                    |--------------------------------------------------------------------------
                    | Update Total Books
                    |--------------------------------------------------------------------------
                    */

                    const totalBooks =
                        document.getElementById(
                            'totalBooksCount'
                        );


                    if (totalBooks) {

                        const currentTotal =
                            parseInt(
                                totalBooks.textContent
                            ) || 0;


                        totalBooks.textContent =
                            Math.max(
                                0,
                                currentTotal - 1
                            );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Update Status Statistic
                    |--------------------------------------------------------------------------
                    */

                    if (bookStatus) {

                        let statusIcon = null;


                        if (
                            bookStatus === 'approved'
                        ) {

                            statusIcon =
                                document.querySelector(
                                    '.seller-book-stat-icon.approved'
                                );

                        }


                        if (
                            bookStatus === 'pending'
                        ) {

                            statusIcon =
                                document.querySelector(
                                    '.seller-book-stat-icon.pending'
                                );

                        }


                        if (
                            bookStatus === 'rejected'
                        ) {

                            statusIcon =
                                document.querySelector(
                                    '.seller-book-stat-icon.rejected'
                                );

                        }


                        if (statusIcon) {

                            const statNumber =
                                statusIcon
                                    .closest(
                                        '.seller-book-stat-card'
                                    )
                                    .querySelector('h3');


                            if (statNumber) {

                                const currentValue =
                                    parseInt(
                                        statNumber.textContent
                                    ) || 0;


                                statNumber.textContent =
                                    Math.max(
                                        0,
                                        currentValue - 1
                                    );

                            }

                        }

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Show Empty State If No Rows Remain
                    |--------------------------------------------------------------------------
                    */

                    const tbody =
                        document.querySelector(
                            '.seller-books-table tbody'
                        );


                    if (
                        tbody &&
                        tbody.querySelectorAll('tr').length === 0
                    ) {

                        const tableResponsive =
                            document.querySelector(
                                '.seller-books-page .table-responsive'
                            );


                        const pagination =
                            document.querySelector(
                                '.seller-books-pagination'
                            );


                        if (tableResponsive) {
                            tableResponsive.remove();
                        }


                        if (pagination) {
                            pagination.remove();
                        }


                        const emptyState =
                            document.createElement('div');


                        emptyState.className =
                            'seller-books-empty';


                        emptyState.innerHTML = `
                            <div class="seller-books-empty-icon">
                                <i class="bi bi-book"></i>
                            </div>

                            <h5>No Books Found</h5>

                            <p>
                                You don't have any books matching your search.
                            </p>

                            <a
                                href="{{ route('seller.books.create') }}"
                                class="seller-primary-button"
                            >
                                <i class="bi bi-plus-lg"></i>
                                Add Your First Book
                            </a>
                        `;


                        const booksPanel =
                            document.querySelector(
                                '.seller-books-panel'
                            );


                        if (booksPanel) {

                            booksPanel.appendChild(
                                emptyState
                            );

                        }

                    }

                }, 250);


                /*
                |--------------------------------------------------------------------------
                | Success Alert
                |--------------------------------------------------------------------------
                */

                showSuccessAlert(
                    data.message ||
                    'Book deleted successfully.'
                );


            } catch (error) {

                console.error(
                    'Delete book error:',
                    error
                );


                alert(
                    error.message ||
                    'Something went wrong while deleting the book.'
                );


            } finally {

                confirmDelete.disabled = false;

                confirmDelete.innerHTML =
                    originalButtonContent;

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Success Alert
    |--------------------------------------------------------------------------
    */

    function showSuccessAlert(message) {

        const successAlert =
            document.getElementById(
                'sellerSuccessAlert'
            );


        const successMessage =
            document.getElementById(
                'sellerSuccessMessage'
            );


        if (!successAlert || !successMessage) {
            return;
        }


        successMessage.textContent = message;


        successAlert.style.display = 'flex';


        clearTimeout(
            successAlert.hideTimer
        );


        successAlert.hideTimer =
            setTimeout(function () {

                successAlert.style.display =
                    'none';

            }, 4000);

    }


    /*
    |--------------------------------------------------------------------------
    | Close Success Alert
    |--------------------------------------------------------------------------
    */

    const successAlert =
        document.getElementById(
            'sellerSuccessAlert'
        );


    const closeSuccessAlert =
        document.getElementById(
            'closeSuccessAlert'
        );


    if (
        successAlert &&
        closeSuccessAlert
    ) {

        closeSuccessAlert.addEventListener(
            'click',
            function () {

                successAlert.style.display =
                    'none';

            }
        );

    }

});

</script>

@endpush