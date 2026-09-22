@extends('layout.admin.master')

@section('title', 'Edit Refund')

@push('css') <link rel="stylesheet" href="{{ asset('admin/css/refunds.css') }}">
@endpush

@section('content')

<div class="dashboard-section refunds-page">


{{-- Hero --}}
<div class="refund-form-hero mb-4">

    <div class="refund-form-hero-content">

        <a href="{{ route('admin.refunds.show', $refund) }}" class="refund-back-link">
            <i class="bi bi-arrow-left"></i>
            Back to Refund Details
        </a>

        <div class="refund-hero-badge">
            <i class="bi bi-pencil-square"></i>
            Payments Recovery
        </div>

        <h1>Edit Refund</h1>

        <p>
            Update the refund request information and customer details.
        </p>

    </div>

    <div class="refund-hero-icon">
        <i class="bi bi-pencil-square"></i>
    </div>

</div>


{{-- Validation Errors --}}
@if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm mb-4">
        <div class="d-flex align-items-start gap-2">
            <i class="bi bi-exclamation-triangle-fill mt-1"></i>

            <div>
                <strong>Please fix the following errors:</strong>

                <ul class="mb-0 mt-1 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif


{{-- Main Form --}}
<form method="POST"
      action="{{ route('admin.refunds.update', $refund) }}">

    @csrf
    @method('PUT')

    <div class="dashboard-panel refund-form-panel">

        {{-- Header --}}
        <div class="refund-form-panel-header">

            <div>
                <span class="refund-section-kicker">
                    REFUND INFORMATION
                </span>

                <h5>
                    {{ $refund->refund_number }}
                </h5>

                <p>
                    Modify the information associated with this refund.
                </p>
            </div>

            <span class="refund-status status-{{ $refund->status }}">
                {{ ucfirst($refund->status) }}
            </span>

        </div>


        {{-- Refund Summary --}}
        <div class="refund-edit-summary">

            <div class="refund-edit-summary-item">

                <span>
                    <i class="bi bi-hash"></i>
                    Refund Number
                </span>

                <strong>
                    {{ $refund->refund_number }}
                </strong>

            </div>

            <div class="refund-edit-summary-item">

                <span>
                    <i class="bi bi-calendar3"></i>
                    Requested
                </span>

                <strong>
                    {{ $refund->requested_at?->format('M d, Y H:i') ?? '—' }}
                </strong>

            </div>

            <div class="refund-edit-summary-item">

                <span>
                    <i class="bi bi-person"></i>
                    Customer
                </span>

                <strong>
                    {{ $refund->user?->name ?? '—' }}
                </strong>

            </div>

        </div>


        {{-- Refund Details --}}
        <div class="refund-form-section">

            <div class="refund-form-section-heading">

                <div class="refund-form-section-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <div>
                    <h6>Refund Details</h6>
                    <p>
                        Update the refund amount and reason.
                    </p>
                </div>

            </div>


            <div class="row g-4">

                {{-- Amount --}}
                <div class="col-md-6">

                    <label for="amount" class="refund-form-label">
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
                            class="form-control refund-form-control refund-amount-input @error('amount') is-invalid @enderror"
                            value="{{ old('amount', $refund->amount) }}"
                            min="0.01"
                            step="0.01"
                            required
                        >

                    </div>

                    @error('amount')
                        <div class="refund-field-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Reason --}}
                <div class="col-md-6">

                    <label for="reason" class="refund-form-label">
                        Reason <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="reason"
                        id="reason"
                        class="form-control refund-form-control @error('reason') is-invalid @enderror"
                        value="{{ old('reason', $refund->reason) }}"
                        maxlength="255"
                        required
                    >

                    @error('reason')
                        <div class="refund-field-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Note --}}
                <div class="col-12">

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <label for="note" class="refund-form-label mb-0">
                            Additional Note
                        </label>

                        <span class="refund-note-counter">
                            <span id="refundNoteCount">
                                {{ strlen(old('note', $refund->note ?? '')) }}
                            </span>
                            / 2000
                        </span>

                    </div>

                    <textarea
                        name="note"
                        id="note"
                        rows="6"
                        maxlength="2000"
                        class="form-control refund-form-control refund-form-textarea @error('note') is-invalid @enderror"
                        placeholder="Add any additional information about this refund..."
                    >{{ old('note', $refund->note) }}</textarea>

                    @error('note')
                        <div class="refund-field-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>


        {{-- Order Information --}}
        <div class="refund-form-section">

            <div class="refund-form-section-heading">

                <div class="refund-form-section-icon">
                    <i class="bi bi-bag-check"></i>
                </div>

                <div>
                    <h6>Related Order</h6>
                    <p>
                        Order connected to this refund.
                    </p>
                </div>

            </div>


            @if($refund->order)

                <div class="refund-edit-order">

                    <div class="refund-edit-order-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div class="refund-edit-order-content">

                        <span>Order Number</span>

                        <strong>
                            #{{ $refund->order->order_number }}
                        </strong>

                    </div>

                    <div class="refund-edit-order-total">

                        <span>Order Total</span>

                        <strong>
                            ${{ number_format($refund->order->total_price, 2) }}
                        </strong>

                    </div>

                </div>

            @else

                <div class="refund-empty-inline">
                    <i class="bi bi-exclamation-circle"></i>
                    Order information is unavailable.
                </div>

            @endif

        </div>


        {{-- Warning --}}
        <div class="refund-edit-warning">

            <div class="refund-edit-warning-icon">
                <i class="bi bi-info-circle-fill"></i>
            </div>

            <div>
                <strong>Before saving</strong>

                <p>
                    Make sure the refund amount and reason are correct.
                    Processed refunds cannot be modified.
                </p>
            </div>

        </div>


        {{-- Actions --}}
        <div class="refund-form-actions">

            <a href="{{ route('admin.refunds.show', $refund) }}"
               class="refund-form-cancel">
                <i class="bi bi-x-lg"></i>
                Cancel
            </a>

            @if($refund->status !== 'processed')

                <button type="submit"
                        class="refund-form-submit">
                    <i class="bi bi-check2-circle"></i>
                    Update Refund
                </button>

            @else

                <button type="button"
                        class="refund-form-submit"
                        disabled>
                    <i class="bi bi-lock"></i>
                    Refund Locked
                </button>

            @endif

        </div>

    </div>

</form>


</div>

@endsection

@push('js')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const note = document.getElementById('note');
    const counter = document.getElementById('refundNoteCount');

    if (note && counter) {
        const updateCounter = () => {
            counter.textContent = note.value.length;
        };

        note.addEventListener('input', updateCounter);
        updateCounter();
    }

});
</script>

@endpush
