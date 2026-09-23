@extends('layout.admin.master')

@section('title', 'FAQ')

@push('css') <link rel="stylesheet" href="{{ asset('admin/css/faq.css') }}">
@endpush

@section('content')

<div class="dashboard-section faq-page">


{{-- Header --}}
<div class="dashboard-panel faq-header-panel">

    <div class="faq-header-content">

        <div>
            <h5>FAQ</h5>
            <p>Manage frequently asked questions on SecondBook</p>
        </div>

        <a href="{{ route('admin.faq.create') }}"
           class="faq-add-btn">
            <i class="bi bi-plus-lg"></i>
            <span>Add FAQ</span>
        </a>

    </div>

</div>


{{-- Success --}}
@if(session('success'))

    <div class="faq-alert">

        <i class="bi bi-check-circle-fill"></i>

        <span>{{ session('success') }}</span>

        <button type="button"
                class="faq-alert-close"
                onclick="this.parentElement.remove()">
            <i class="bi bi-x"></i>
        </button>

    </div>

@endif


{{-- Filters --}}
<div class="dashboard-panel faq-filter-panel">

    <form method="GET"
          action="{{ route('admin.faq.index') }}">

        <div class="faq-filter-row">

            {{-- Search --}}
            <div class="faq-search">

                <label for="faq-search">
                    Search
                </label>

                <div class="faq-search-group">

                    <i class="bi bi-search"></i>

                    <input type="text"
                           id="faq-search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Question, answer or category...">

                </div>

            </div>


            {{-- Category --}}
            <div class="faq-category-filter">

                <label for="faq-category">
                    Category
                </label>

                <select id="faq-category"
                        name="category">

                    <option value="">
                        All Categories
                    </option>

                    @foreach($categories as $category)

                        <option value="{{ $category }}"
                            @selected(request('category') === $category)>
                            {{ $category }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Status --}}
            <div class="faq-status-filter">

                <label for="faq-status">
                    Status
                </label>

                <select id="faq-status"
                        name="status">

                    <option value="">
                        All Status
                    </option>

                    <option value="1"
                        @selected(request('status') === '1')>
                        Active
                    </option>

                    <option value="0"
                        @selected(request('status') === '0')>
                        Inactive
                    </option>

                </select>

            </div>


            {{-- Actions --}}
            <div class="faq-filter-actions">

                <button type="submit"
                        class="faq-search-btn">
                    <i class="bi bi-funnel"></i>
                    Filter
                </button>

                @if(request()->filled('search') ||
                    request()->filled('category') ||
                    request()->filled('status'))

                    <a href="{{ route('admin.faq.index') }}"
                       class="faq-reset-btn"
                       title="Reset filters">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>

                @endif

            </div>

        </div>

    </form>

</div>


{{-- FAQ Table --}}
<div class="dashboard-panel faq-table-panel">

    <div class="faq-table-header">

        <div>
            <h5>FAQ List</h5>
            <p>All frequently asked questions</p>
        </div>

        <span class="faq-count">
            {{ $faqs->total() }} FAQs
        </span>

    </div>


    <div class="faq-table-wrapper">

        <table class="faq-table">

            <thead>

                <tr>

                    <th class="faq-col-id">
                        #
                    </th>

                    <th>
                        Question
                    </th>

                    <th class="faq-col-category">
                        Category
                    </th>

                    <th class="faq-col-answer">
                        Answer
                    </th>

                    <th class="faq-col-sort">
                        Sort
                    </th>

                    <th class="faq-col-status">
                        Status
                    </th>

                    <th class="faq-col-date">
                        Created
                    </th>

                    <th class="faq-col-actions">
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($faqs as $faq)

                    <tr>

                        {{-- ID --}}
                        <td class="faq-id">
                            {{ $faq->id }}
                        </td>


                        {{-- Question --}}
                        <td>

                            <div class="faq-question-info">

                                <div class="faq-question-title">
                                    {{ $faq->question }}
                                </div>

                                <div class="faq-mobile-category">
                                    {{ $faq->category }}
                                </div>

                            </div>

                        </td>


                        {{-- Category --}}
                        <td>

                            <span class="faq-category">
                                {{ $faq->category }}
                            </span>

                        </td>


                        {{-- Answer --}}
                        <td>

                            <div class="faq-answer">
                                {{ $faq->answer }}
                            </div>

                        </td>


                        {{-- Sort --}}
                        <td>

                            <span class="faq-sort">
                                {{ $faq->sort_order }}
                            </span>

                        </td>


                        {{-- Status --}}
                        <td>

                            @if($faq->is_active)

                                <span class="faq-status faq-status-active">
                                    <span></span>
                                    Active
                                </span>

                            @else

                                <span class="faq-status faq-status-inactive">
                                    <span></span>
                                    Inactive
                                </span>

                            @endif

                        </td>


                        {{-- Created --}}
                        <td>

                            <span class="faq-date">
                                {{ $faq->created_at?->format('d M Y') }}
                            </span>

                        </td>


                        {{-- Actions --}}
                        <td>

                            <div class="faq-actions">

                                <a href="{{ route('admin.faq.edit', $faq->id) }}"
                                   class="faq-edit-btn"
                                   title="Edit FAQ">
                                    <i class="bi bi-pencil"></i>
                                </a>


                                <form action="{{ route('admin.faq.destroy', $faq->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this FAQ?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="faq-delete-btn"
                                            title="Delete FAQ">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8">

                            <div class="faq-empty">

                                <div class="faq-empty-icon">
                                    <i class="bi bi-question-circle"></i>
                                </div>

                                <h6>No FAQs Found</h6>

                                <p>
                                    Create your first FAQ to get started.
                                </p>

                                <a href="{{ route('admin.faq.create') }}"
                                   class="faq-add-btn">
                                    <i class="bi bi-plus-lg"></i>
                                    Add FAQ
                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    @if($faqs->hasPages())

        <div class="faq-pagination">
            {{ $faqs->links() }}
        </div>

    @endif

</div>


</div>

@endsection
