@extends('layout.admin.master')

@section('title', 'Edit FAQ')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/faq.css') }}">
@endpush

@section('content')

<div class="dashboard-section faq-page">

    {{-- PAGE HEADER --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Edit FAQ</h5>

                <p class="text-muted mb-0 small">
                    Update frequently asked question information
                </p>
            </div>

            <a
                href="{{ route('admin.faq.index') }}"
                class="btn btn-light border"
            >
                <i class="bi bi-arrow-left me-2"></i>
                Back to FAQ
            </a>

        </div>

    </div>


    {{-- VALIDATION ERRORS --}}
    @if($errors->any())

        <div class="alert alert-danger mb-4">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.faq.update', $faq->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="row g-4">

            {{-- MAIN FORM --}}
            <div class="col-12 col-lg-8">

                <div class="dashboard-panel">

                    <div class="panel-header">

                        <div>
                            <h5 class="mb-1">
                                FAQ Information
                            </h5>

                            <p class="text-muted mb-0 small">
                                Update the question and answer details.
                            </p>
                        </div>

                        <span class="badge bg-primary">
                            FAQ #{{ $faq->id }}
                        </span>

                    </div>


                    <div class="faq-form-body">

                        {{-- CATEGORY --}}
                        <div class="mb-4">

                            <label
                                for="category"
                                class="form-label fw-semibold"
                            >
                                Category
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="category"
                                name="category"
                                value="{{ old('category', $faq->category) }}"
                                class="form-control @error('category') is-invalid @enderror"
                                placeholder="e.g. Buying, Selling, Orders"
                                maxlength="100"
                                required
                            >

                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- QUESTION --}}
                        <div class="mb-4">

                            <label
                                for="question"
                                class="form-label fw-semibold"
                            >
                                Question
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="question"
                                name="question"
                                value="{{ old('question', $faq->question) }}"
                                class="form-control @error('question') is-invalid @enderror"
                                placeholder="Enter the frequently asked question..."
                                maxlength="255"
                                required
                            >

                            @error('question')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- ANSWER --}}
                        <div class="mb-4">

                            <label
                                for="answer"
                                class="form-label fw-semibold"
                            >
                                Answer
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                id="answer"
                                name="answer"
                                rows="8"
                                maxlength="5000"
                                class="form-control @error('answer') is-invalid @enderror"
                                placeholder="Write the answer to this question..."
                                required
                            >{{ old('answer', $faq->answer) }}</textarea>

                            <div class="d-flex justify-content-between mt-2">

                                <small class="text-muted">
                                    Provide a clear and helpful answer.
                                </small>

                                <small
                                    class="text-muted"
                                    id="answer-counter"
                                >
                                    0 / 5000
                                </small>

                            </div>

                            @error('answer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- SORT ORDER --}}
                        <div class="mb-4">

                            <label
                                for="sort_order"
                                class="form-label fw-semibold"
                            >
                                Sort Order
                            </label>

                            <input
                                type="number"
                                id="sort_order"
                                name="sort_order"
                                value="{{ old('sort_order', $faq->sort_order) }}"
                                class="form-control @error('sort_order') is-invalid @enderror"
                                min="0"
                                placeholder="0"
                            >

                            <small class="text-muted">
                                Lower numbers will appear first.
                            </small>

                            @error('sort_order')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- STATUS --}}
                        <div class="faq-status-box">

                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    role="switch"
                                    id="is_active"
                                    name="is_active"
                                    value="1"
                                    @checked(old('is_active', $faq->is_active))
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="is_active"
                                >
                                    Active FAQ
                                </label>

                            </div>

                            <small class="text-muted">
                                Active FAQs can be displayed on the frontend FAQ page.
                            </small>

                        </div>

                    </div>


                    {{-- FORM ACTIONS --}}
                    <div class="faq-form-actions">

                        <a
                            href="{{ route('admin.faq.index') }}"
                            class="btn btn-light border"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-check-circle me-2"></i>
                            Update FAQ
                        </button>

                    </div>

                </div>

            </div>


            {{-- SIDEBAR --}}
            <div class="col-12 col-lg-4">

                <div class="dashboard-panel faq-tip-panel">

                    <div class="panel-header">

                        <div>
                            <h5 class="mb-1">
                                FAQ Tips
                            </h5>

                            <p class="text-muted mb-0 small">
                                Keep your FAQ content clear and useful.
                            </p>
                        </div>

                    </div>


                    <div class="faq-tip-list">

                        <div class="faq-tip-item">

                            <div class="faq-tip-icon">
                                <i class="bi bi-question-circle"></i>
                            </div>

                            <div>
                                <strong>Clear Questions</strong>

                                <p>
                                    Keep questions short and easy to understand.
                                </p>
                            </div>

                        </div>


                        <div class="faq-tip-item">

                            <div class="faq-tip-icon">
                                <i class="bi bi-chat-left-text"></i>
                            </div>

                            <div>
                                <strong>Helpful Answers</strong>

                                <p>
                                    Make sure the answer directly addresses the question.
                                </p>
                            </div>

                        </div>


                        <div class="faq-tip-item">

                            <div class="faq-tip-icon">
                                <i class="bi bi-folder"></i>
                            </div>

                            <div>
                                <strong>Categories</strong>

                                <p>
                                    Use consistent category names for easier filtering.
                                </p>
                            </div>

                        </div>


                        <div class="faq-tip-item">

                            <div class="faq-tip-icon">
                                <i class="bi bi-sort-numeric-down"></i>
                            </div>

                            <div>
                                <strong>Sort Order</strong>

                                <p>
                                    Use smaller numbers for FAQs that should appear first.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="dashboard-panel faq-tip-box mt-4">

                    <div class="d-flex gap-3">

                        <div class="faq-info-icon">
                            <i class="bi bi-info-circle"></i>
                        </div>

                        <div>

                            <h6 class="mb-1">
                                Current Status
                            </h6>

                            <p class="mb-0 small">
                                This FAQ is currently
                                <strong>
                                    {{ $faq->is_active ? 'active' : 'inactive' }}
                                </strong>.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const answer = document.getElementById('answer');
        const counter = document.getElementById('answer-counter');

        if (!answer || !counter) {
            return;
        }

        function updateCounter() {
            counter.textContent = answer.value.length + ' / 5000';
        }

        updateCounter();

        answer.addEventListener('input', updateCounter);

    });
</script>

@endpush

@endsection