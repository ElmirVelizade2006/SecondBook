@extends('layout.admin.master')

@section('title', 'Create Refund')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/refunds.css') }}">
@endpush

@section('content')

<div class="dashboard-section refunds-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================= --}}

    <div class="refund-form-hero mb-4">

        <div class="refund-form-hero-content">

            <a
                href="{{ route('admin.refunds.index') }}"
                class="refund-back-link"
            >
                <i class="bi bi-arrow-left"></i>
                Back to Refunds
            </a>

            <span class="hero-badge">
                <i class="bi bi-arrow-counterclockwise"></i>
                Payments Recovery
            </span>

            <h1>Create Refund</h1>

            <p>
                Create a new refund request for an existing customer order.
            </p>

        </div>

        <div class="refund-form-hero-mark">
            <i class="bi bi-receipt"></i>
        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================= --}}

    @if($errors->any())

        <div class="refund-alert refund-alert-danger">

            <i class="bi bi-exclamation-circle-fill"></i>

            <div>
                <strong>Please check the form.</strong>

                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        </div>

    @endif


    {{-- =========================================================
        FORM
    ========================================================= --}}

    <div class="dashboard-panel refund-form-panel">

        <div class="panel-header refund-form-panel-header">

            <div>

                <span class="eyebrow">
                    Refund Details
                </span>

                <h5>New Refund</h5>

                <p>
                    Select the order and provide the refund information.
                </p>

            </div>

        </div>


        <form
            method="POST"
            action="{{ route('admin.refunds.store') }}"
            class="refund-form"
        >

            @csrf


            {{-- =================================================
                ORDER
            ================================================= --}}

            <div class="refund-form-section">

                <div class="refund-form-section-heading">

                    <div class="refund-form-section-icon">
                        <i class="bi bi-bag-check"></i>
                    </div>

                    <div>
                        <h6>Order Information</h6>
                        <p>Select the order that requires a refund.</p>
                    </div>

                </div>


                <div class="row g-4">

                    <div class="col-12">

                        <label
                            for="order_id"
                            class="refund-form-label"
                        >
                            Order <span>*</span>
                        </label>

                        <select
                            name="order_id"
                            id="order_id"
                            class="form-select refund-form-control @error('order_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Select an order
                            </option>

                            @foreach($orders as $order)

                                <option
                                    value="{{ $order->id }}"
                                    data-total="{{ $order->payment?->amount ?? $order->total_price }}"
                                    @selected(old('order_id') == $order->id)
                                >
                                    #{{ $order->order_number }}
                                    — {{ $order->user?->name ?? 'Unknown customer' }}
                                    — ${{ number_format($order->payment?->amount ?? $order->total_price, 2) }}
                                </option>

                            @endforeach

                        </select>

                        @error('order_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- =================================================
                REFUND DETAILS
            ================================================= --}}

            <div class="refund-form-section">

                <div class="refund-form-section-heading">

                    <div class="refund-form-section-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>

                    <div>
                        <h6>Refund Details</h6>
                        <p>Enter the amount and reason for the refund.</p>
                    </div>

                </div>


                <div class="row g-4">

                    {{-- Amount --}}
                    <div class="col-md-6">

                        <label
                            for="amount"
                            class="refund-form-label"
                        >
                            Refund Amount <span>*</span>
                        </label>

                        <div class="refund-input-group">

                            <span class="refund-input-prefix">
                                $
                            </span>

                            <input
                                type="number"
                                name="amount"
                                id="amount"
                                value="{{ old('amount') }}"
                                class="form-control refund-form-control refund-amount-input @error('amount') is-invalid @enderror"
                                placeholder="0.00"
                                min="0.01"
                                step="0.01"
                                required
                            >

                        </div>

                        @error('amount')
                            <div class="refund-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="refund-form-help">
                            The amount cannot exceed the refundable order amount.
                        </small>

                    </div>


                    {{-- Reason --}}
                    <div class="col-md-6">

                        <label
                            for="reason"
                            class="refund-form-label"
                        >
                            Reason <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="reason"
                            id="reason"
                            value="{{ old('reason') }}"
                            class="form-control refund-form-control @error('reason') is-invalid @enderror"
                            placeholder="Enter refund reason"
                            maxlength="255"
                            required
                        >

                        @error('reason')
                            <div class="refund-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Note --}}
                    <div class="col-12">

                        <label
                            for="note"
                            class="refund-form-label"
                        >
                            Internal Note
                        </label>

                        <textarea
                            name="note"
                            id="note"
                            rows="5"
                            maxlength="2000"
                            class="form-control refund-form-control refund-textarea @error('note') is-invalid @enderror"
                            placeholder="Add any additional information about this refund..."
                        >{{ old('note') }}</textarea>

                        @error('note')
                            <div class="refund-field-error">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="refund-textarea-footer">
                            <small class="refund-form-help">
                                This note is for administrative records.
                            </small>

                            <small class="refund-character-count">
                                <span id="noteCount">0</span>/2000
                            </small>
                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                INFORMATION
            ================================================= --}}

            <div class="refund-info-box">

                <div class="refund-info-icon">
                    <i class="bi bi-info-circle"></i>
                </div>

                <div>
                    <strong>Refund workflow</strong>

                    <p>
                        New refunds are created with
                        <strong>Pending</strong> status.
                        After creation, you can review and approve,
                        reject, or process the refund from the refund
                        management page.
                    </p>
                </div>

            </div>


            {{-- =================================================
                ACTIONS
            ================================================= --}}

            <div class="refund-form-actions">

                <a
                    href="{{ route('admin.refunds.index') }}"
                    class="refund-cancel-button"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="refund-submit-button"
                >
                    <i class="bi bi-plus-lg"></i>
                    Create Refund
                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@push('js')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const note = document.getElementById('note');
    const noteCount = document.getElementById('noteCount');

    if (note && noteCount) {

        function updateNoteCount() {
            noteCount.textContent = note.value.length;
        }

        note.addEventListener('input', updateNoteCount);

        updateNoteCount();
    }


    const orderSelect = document.getElementById('order_id');
    const amountInput = document.getElementById('amount');

    if (orderSelect && amountInput) {

        orderSelect.addEventListener('change', function () {

            const selectedOption =
                this.options[this.selectedIndex];

            const total =
                selectedOption.dataset.total;

            if (total) {
                amountInput.max = total;
            } else {
                amountInput.removeAttribute('max');
            }

        });

    }

});
</script>

@endpush