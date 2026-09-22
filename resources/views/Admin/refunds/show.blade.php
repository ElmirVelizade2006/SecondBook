@extends('layout.admin.master')

@section('title', 'Refund Details')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/refunds.css') }}">
@endpush

@section('content')

<div class="dashboard-section refunds-page">

    {{-- Hero --}}
    <div class="refund-form-hero mb-4">

        <div class="refund-form-hero-content">

            <a href="{{ route('admin.refunds.index') }}" class="refund-back-link">
                <i class="bi bi-arrow-left"></i>
                Back to Refunds
            </a>

            <div class="refund-hero-badge">
                <i class="bi bi-receipt"></i>
                Payments Recovery
            </div>

            <h1>Refund Details</h1>

            <p>
                Review refund information, order details and processing status.
            </p>

        </div>

        <div class="refund-hero-icon">
            <i class="bi bi-receipt-cutoff"></i>
        </div>

    </div>


    {{-- Main Grid --}}
    <div class="refund-show-grid">

        {{-- Left Column --}}
        <div class="refund-show-main">

            {{-- Refund Overview --}}
            <div class="dashboard-panel refund-details-panel mb-4">

                <div class="refund-details-header">

                    <div>
                        <span class="refund-section-kicker">
                            REFUND
                        </span>

                        <h5>
                            {{ $refund->refund_number }}
                        </h5>

                        <p>
                            Refund request overview
                        </p>
                    </div>

                    <div>
                        <span class="refund-status status-{{ $refund->status }}">
                            {{ ucfirst($refund->status) }}
                        </span>
                    </div>

                </div>


                <div class="refund-details-grid">

                    <div class="refund-detail-item">
                        <span class="refund-detail-label">
                            Refund Number
                        </span>

                        <strong>
                            {{ $refund->refund_number }}
                        </strong>
                    </div>


                    <div class="refund-detail-item">
                        <span class="refund-detail-label">
                            Amount
                        </span>

                        <strong class="refund-detail-amount">
                            ${{ number_format($refund->amount, 2) }}
                        </strong>
                    </div>


                    <div class="refund-detail-item">
                        <span class="refund-detail-label">
                            Status
                        </span>

                        <span class="refund-status status-{{ $refund->status }}">
                            {{ ucfirst($refund->status) }}
                        </span>
                    </div>


                    <div class="refund-detail-item">
                        <span class="refund-detail-label">
                            Requested At
                        </span>

                        <strong>
                            {{ $refund->requested_at?->format('M d, Y H:i') ?? '—' }}
                        </strong>
                    </div>


                    <div class="refund-detail-item">
                        <span class="refund-detail-label">
                            Processed At
                        </span>

                        <strong>
                            {{ $refund->processed_at?->format('M d, Y H:i') ?? '—' }}
                        </strong>
                    </div>


                    <div class="refund-detail-item">
                        <span class="refund-detail-label">
                            Processed By
                        </span>

                        <strong>
                            {{ $refund->processor?->name ?? '—' }}
                        </strong>
                    </div>

                </div>

            </div>


            {{-- Reason --}}
            <div class="dashboard-panel refund-content-panel mb-4">

                <div class="refund-content-heading">
                    <div class="refund-content-icon">
                        <i class="bi bi-chat-left-text"></i>
                    </div>

                    <div>
                        <h5>Refund Reason</h5>
                        <p>Reason provided for this refund request.</p>
                    </div>
                </div>

                <div class="refund-content-box">
                    {{ $refund->reason }}
                </div>

                @if($refund->note)

                    <div class="refund-note-block">

                        <div class="refund-note-title">
                            <i class="bi bi-sticky"></i>
                            Additional Note
                        </div>

                        <p>
                            {{ $refund->note }}
                        </p>

                    </div>

                @endif

            </div>


            {{-- Order Information --}}
            <div class="dashboard-panel refund-content-panel">

                <div class="refund-content-heading">

                    <div class="refund-content-icon">
                        <i class="bi bi-bag-check"></i>
                    </div>

                    <div>
                        <h5>Order Information</h5>
                        <p>Order connected to this refund.</p>
                    </div>

                </div>


                @if($refund->order)

                    <div class="refund-order-card">

                        <div class="refund-order-main">

                            <div class="refund-order-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div>
                                <span>Order Number</span>

                                <strong>
                                    #{{ $refund->order->order_number }}
                                </strong>
                            </div>

                        </div>


                        <div class="refund-order-meta">

                            <div>
                                <span>Order Total</span>

                                <strong>
                                    ${{ number_format($refund->order->total_price, 2) }}
                                </strong>
                            </div>

                            <div>
                                <span>Order Status</span>

                                <strong>
                                    {{ ucfirst(str_replace('_', ' ', $refund->order->order_status)) }}
                                </strong>
                            </div>

                            <div>
                                <span>Payment Status</span>

                                <strong>
                                    {{ ucfirst(str_replace('_', ' ', $refund->order->payment_status)) }}
                                </strong>
                            </div>

                        </div>

                    </div>

                @else

                    <div class="refund-empty-inline">
                        <i class="bi bi-exclamation-circle"></i>
                        Order information is unavailable.
                    </div>

                @endif

            </div>

        </div>


        {{-- Right Column --}}
        <div class="refund-show-sidebar">

            {{-- Customer --}}
            <div class="dashboard-panel refund-sidebar-panel mb-4">

                <div class="refund-sidebar-heading">
                    <div class="refund-sidebar-icon">
                        <i class="bi bi-person"></i>
                    </div>

                    <div>
                        <h5>Customer</h5>
                        <p>Refund requester</p>
                    </div>
                </div>


                @if($refund->user)

                    <div class="refund-customer-profile">

                        <div class="refund-customer-avatar">
                            {{ strtoupper(substr($refund->user->name ?? 'U', 0, 1)) }}
                        </div>

                        <div>
                            <strong>
                                {{ $refund->user->name }}
                            </strong>

                            <span>
                                {{ $refund->user->email }}
                            </span>
                        </div>

                    </div>


                    <div class="refund-customer-info">

                        <div>
                            <span>Username</span>
                            <strong>
                                {{ $refund->user->username ?? '—' }}
                            </strong>
                        </div>

                        <div>
                            <span>Phone</span>
                            <strong>
                                {{ $refund->user->phone ?? '—' }}
                            </strong>
                        </div>

                    </div>

                @else

                    <div class="refund-empty-inline">
                        Customer unavailable.
                    </div>

                @endif

            </div>


            {{-- Payment --}}
            <div class="dashboard-panel refund-sidebar-panel mb-4">

                <div class="refund-sidebar-heading">

                    <div class="refund-sidebar-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>

                    <div>
                        <h5>Payment</h5>
                        <p>Payment information</p>
                    </div>

                </div>


                @if($refund->payment)

                    <div class="refund-payment-info">

                        <div>
                            <span>Transaction ID</span>

                            <strong>
                                {{ $refund->payment->transaction_id ?? '—' }}
                            </strong>
                        </div>

                        <div>
                            <span>Payment Amount</span>

                            <strong>
                                ${{ number_format($refund->payment->amount, 2) }}
                            </strong>
                        </div>

                        <div>
                            <span>Method</span>

                            <strong>
                                {{ ucfirst(str_replace('_', ' ', $refund->payment->payment_method ?? '—')) }}
                            </strong>
                        </div>

                        <div>
                            <span>Status</span>

                            <strong>
                                {{ ucfirst(str_replace('_', ' ', $refund->payment->payment_status ?? '—')) }}
                            </strong>
                        </div>

                    </div>

                @else

                    <div class="refund-empty-inline">
                        <i class="bi bi-credit-card-2-front"></i>
                        No payment record linked to this refund.
                    </div>

                @endif

            </div>


            {{-- Actions --}}
            <div class="dashboard-panel refund-sidebar-panel">

                <div class="refund-sidebar-heading">

                    <div class="refund-sidebar-icon">
                        <i class="bi bi-lightning"></i>
                    </div>

                    <div>
                        <h5>Actions</h5>
                        <p>Manage this refund</p>
                    </div>

                </div>


                <div class="refund-show-actions">

                    @if($refund->status === 'pending')

                        <form method="POST"
                              action="{{ route('admin.refunds.status', $refund) }}">

                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="status" value="approved">

                            <button type="submit"
                                    class="refund-action-large refund-action-approve">
                                <i class="bi bi-check-circle"></i>
                                Approve Refund
                            </button>

                        </form>


                        <form method="POST"
                              action="{{ route('admin.refunds.status', $refund) }}">

                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="status" value="rejected">

                            <button type="submit"
                                    class="refund-action-large refund-action-reject">
                                <i class="bi bi-x-circle"></i>
                                Reject Refund
                            </button>

                        </form>

                    @elseif($refund->status === 'approved')

                        <form method="POST"
                              action="{{ route('admin.refunds.status', $refund) }}">

                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="status" value="processed">

                            <button type="submit"
                                    class="refund-action-large refund-action-process">
                                <i class="bi bi-arrow-repeat"></i>
                                Process Refund
                            </button>

                        </form>


                        <form method="POST"
                              action="{{ route('admin.refunds.status', $refund) }}">

                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="status" value="cancelled">

                            <button type="submit"
                                    class="refund-action-large refund-action-cancel">
                                <i class="bi bi-slash-circle"></i>
                                Cancel Refund
                            </button>

                        </form>

                    @elseif($refund->status === 'processed')

                        <div class="refund-processed-message">
                            <i class="bi bi-check-circle-fill"></i>

                            <div>
                                <strong>Refund Processed</strong>
                                <span>
                                    This refund has been successfully processed.
                                </span>
                            </div>
                        </div>

                    @elseif($refund->status === 'rejected')

                        <div class="refund-status-message refund-status-message-danger">
                            <i class="bi bi-x-circle-fill"></i>

                            <div>
                                <strong>Refund Rejected</strong>
                                <span>
                                    This refund request was rejected.
                                </span>
                            </div>
                        </div>

                    @elseif($refund->status === 'cancelled')

                        <div class="refund-status-message">
                            <i class="bi bi-slash-circle-fill"></i>

                            <div>
                                <strong>Refund Cancelled</strong>
                                <span>
                                    This refund request has been cancelled.
                                </span>
                            </div>
                        </div>

                    @endif


                    <a href="{{ route('admin.refunds.edit', $refund) }}"
                       class="refund-action-large refund-action-edit
                       {{ in_array($refund->status, ['processed']) ? 'disabled' : '' }}">
                        <i class="bi bi-pencil-square"></i>
                        Edit Refund
                    </a>


                    <a href="{{ route('admin.refunds.index') }}"
                       class="refund-action-large refund-action-back">
                        <i class="bi bi-arrow-left"></i>
                        Back to Refunds
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection