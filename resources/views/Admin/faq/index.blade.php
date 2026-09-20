@extends('layout.admin.master')

@section('title', 'FAQ')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/faq.css') }}">
@endpush

@section('content')

<div class="dashboard-section faq-page">

    {{-- PAGE HEADER --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">FAQ</h5>

                <p class="text-muted mb-0 small">
                    Manage frequently asked questions on SecondBook
                </p>
            </div>

            <a
                href="{{ route('admin.faq.create') }}"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-circle me-2"></i>
                Add FAQ
            </a>

        </div>

    </div>


    {{-- FILTERS --}}
    <div class="dashboard-panel mb-4">

        <form
            method="GET"
            action="{{ route('admin.faq.index') }}"
            class="row g-3 align-items-end"
        >

            {{-- SEARCH --}}
            <div class="col-12 col-md-6 col-lg-6">

                <label class="form-label small text-muted fw-semibold">
                    Search
                </label>

                <div class="input-group">

                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-start-0"
                        placeholder="Question, answer or category..."
                    >

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Search
                    </button>

                </div>

            </div>


            {{-- CATEGORY --}}
            <div class="col-6 col-md-3 col-lg-2">

                <label class="form-label small text-muted fw-semibold">
                    Category
                </label>

                <select
                    name="category"
                    class="form-select"
                >

                    <option value="">
                        All Categories
                    </option>

                    @foreach($categories as $category)
                        <option
                            value="{{ $category }}"
                            @selected(request('category') === $category)
                        >
                            {{ $category }}
                        </option>
                    @endforeach

                </select>

            </div>


            {{-- STATUS --}}
            <div class="col-6 col-md-3 col-lg-2">

                <label class="form-label small text-muted fw-semibold">
                    Status
                </label>

                <select
                    name="status"
                    class="form-select"
                >

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="1"
                        @selected(request('status') === '1')
                    >
                        Active
                    </option>

                    <option
                        value="0"
                        @selected(request('status') === '0')
                    >
                        Inactive
                    </option>

                </select>

            </div>


            {{-- FILTER ACTIONS --}}
            <div class="col-12 col-lg-2 d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-primary flex-grow-1"
                >
                    <i class="bi bi-funnel me-1"></i>
                    Filter
                </button>

                <a
                    href="{{ route('admin.faq.index') }}"
                    class="btn btn-light border"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>

    @endif


    {{-- FAQ LIST --}}
    <div class="dashboard-panel">

        <div class="panel-header">

            <h5>FAQ List</h5>

            <span class="badge bg-primary">
                {{ $faqs->total() }} FAQs
            </span>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Question</th>

                        <th class="d-none d-md-table-cell">
                            Category
                        </th>

                        <th class="d-none d-lg-table-cell">
                            Answer
                        </th>

                        <th class="d-none d-md-table-cell">
                            Sort
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="d-none d-lg-table-cell">
                            Created Date
                        </th>

                        <th class="text-end">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($faqs as $faq)

                        <tr>

                            {{-- ID --}}
                            <td>
                                {{ $faq->id }}
                            </td>


                            {{-- QUESTION --}}
                            <td>

                                <div class="faq-question">

                                    <strong class="d-block">
                                        {{ $faq->question }}
                                    </strong>

                                    <small class="text-muted d-md-none">
                                        {{ $faq->category }}
                                    </small>

                                </div>

                            </td>


                            {{-- CATEGORY --}}
                            <td class="d-none d-md-table-cell">

                                <span class="badge bg-light text-dark border">
                                    {{ $faq->category }}
                                </span>

                            </td>


                            {{-- ANSWER --}}
                            <td class="d-none d-lg-table-cell">

                                <div class="faq-answer faq-answer-preview">
                                    {{ $faq->answer }}
                                </div>

                            </td>


                            {{-- SORT ORDER --}}
                            <td class="d-none d-md-table-cell">

                                <span class="text-muted">
                                    {{ $faq->sort_order }}
                                </span>

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($faq->is_active)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- CREATED DATE --}}
                            <td class="d-none d-lg-table-cell">

                                {{ $faq->created_at?->format('d M Y') }}

                            </td>


                            {{-- ACTIONS --}}
                            <td>

                                <div class="d-flex justify-content-end gap-2">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.faq.edit', $faq->id) }}"
                                        class="btn btn-warning btn-sm"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('admin.faq.destroy', $faq->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this FAQ?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Delete"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5"
                            >

                                <div class="chart-placeholder faq-empty-state">

                                    <i class="bi bi-question-circle"></i>

                                    <h6>
                                        No FAQs found
                                    </h6>

                                    <p>
                                        Create your first FAQ to get started.
                                    </p>

                                    <a
                                        href="{{ route('admin.faq.create') }}"
                                        class="btn btn-primary mt-3"
                                    >
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Add FAQ
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($faqs->hasPages())

            <div class="pt-3">

                {{ $faqs->links() }}

            </div>

        @endif

    </div>

</div>

@endsection