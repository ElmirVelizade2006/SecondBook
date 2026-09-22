@extends('layout.admin.master')

@section('title', 'Seller Applications')

@push('css') <link rel="stylesheet" href="{{ asset('admin/css/seller-applications.css') }}">
@endpush

@section('content')

<div class="dashboard-section seller-applications-page">


{{-- =========================================================
     PAGE HEADER
========================================================== --}}
<div class="dashboard-panel mb-4">

    <div class="panel-header mb-0">

        <div>
            <h5 class="mb-1">Seller Applications</h5>

            <p class="text-muted mb-0 small">
                Review and manage users who want to become sellers.
            </p>
        </div>

    </div>

</div>


{{-- =========================================================
     STATISTICS
========================================================== --}}
<div class="row g-4 mb-4">

    {{-- Total --}}
    <div class="col-xl-3 col-md-6">

        <div class="seller-application-stat-card">

            <div class="seller-application-stat-icon total">
                <i class="bi bi-file-earmark-text"></i>
            </div>

            <div class="seller-application-stat-content">

                <span>Total Applications</span>

                <h3>{{ $totalCount }}</h3>

            </div>

        </div>

    </div>


    {{-- Pending --}}
    <div class="col-xl-3 col-md-6">

        <div class="seller-application-stat-card">

            <div class="seller-application-stat-icon pending">
                <i class="bi bi-hourglass-split"></i>
            </div>

            <div class="seller-application-stat-content">

                <span>Pending</span>

                <h3>{{ $pendingCount }}</h3>

            </div>

        </div>

    </div>


    {{-- Approved --}}
    <div class="col-xl-3 col-md-6">

        <div class="seller-application-stat-card">

            <div class="seller-application-stat-icon approved">
                <i class="bi bi-check-circle"></i>
            </div>

            <div class="seller-application-stat-content">

                <span>Approved</span>

                <h3>{{ $approvedCount }}</h3>

            </div>

        </div>

    </div>


    {{-- Rejected --}}
    <div class="col-xl-3 col-md-6">

        <div class="seller-application-stat-card">

            <div class="seller-application-stat-icon rejected">
                <i class="bi bi-x-circle"></i>
            </div>

            <div class="seller-application-stat-content">

                <span>Rejected</span>

                <h3>{{ $rejectedCount }}</h3>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     FILTERS
========================================================== --}}
<div class="dashboard-panel mb-4">

    <form
        method="GET"
        action="{{ route('admin.seller-applications.index') }}"
    >

        <div class="seller-application-filters">

            {{-- Search --}}
            <div class="seller-application-search">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search store, name or email..."
                >

            </div>


            {{-- Status --}}
            <select
                name="status"
                class="seller-application-status-filter"
            >
                <option value="">All Statuses</option>

                <option
                    value="pending"
                    {{ request('status') === 'pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="approved"
                    {{ request('status') === 'approved' ? 'selected' : '' }}
                >
                    Approved
                </option>

                <option
                    value="rejected"
                    {{ request('status') === 'rejected' ? 'selected' : '' }}
                >
                    Rejected
                </option>
            </select>


            {{-- Search Button --}}
            <button
                type="submit"
                class="seller-application-filter-btn"
            >
                <i class="bi bi-search me-1"></i>
                Search
            </button>


            {{-- Reset --}}
            @if(request()->hasAny(['search', 'status']))
                <a
                    href="{{ route('admin.seller-applications.index') }}"
                    class="seller-application-reset-btn"
                >
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
            @endif

        </div>

    </form>

</div>


{{-- =========================================================
     APPLICATIONS TABLE
========================================================== --}}
<div class="dashboard-panel">

    <div class="panel-header">

        <div>
            <h5 class="mb-1">Applications</h5>

            <p class="text-muted mb-0 small">
                Review submitted seller applications.
            </p>
        </div>

    </div>


    @if($applications->count())

        <div class="table-responsive seller-application-table-wrapper">

            <table class="table align-middle seller-application-table">

                <thead>
                    <tr>

                        <th>Applicant</th>

                        <th>Store</th>

                        <th>Contact</th>

                        <th>Status</th>

                        <th>Submitted</th>

                        <th class="text-end">Action</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach($applications as $application)

                        <tr>

                            {{-- Applicant --}}
                            <td>

                                <div class="seller-applicant">

                                    <div class="seller-applicant-avatar">

                                        @if($application->user->profile_photo)

                                            <img
                                                src="{{ asset('storage/' . $application->user->profile_photo) }}"
                                                alt="{{ $application->user->full_name }}"
                                            >

                                        @else

                                            <span>
                                                {{ strtoupper(substr($application->user->first_name ?? $application->user->name ?? 'U', 0, 1)) }}
                                            </span>

                                        @endif

                                    </div>

                                    <div class="seller-applicant-info">

                                        <strong>
                                            {{ $application->user->full_name ?: $application->user->name }}
                                        </strong>

                                        <span>
                                            {{ $application->user->email }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- Store --}}
                            <td>

                                <div class="seller-store-info">

                                    <i class="bi bi-shop"></i>

                                    <span>
                                        {{ $application->store_name }}
                                    </span>

                                </div>

                            </td>


                            {{-- Contact --}}
                            <td>

                                <div class="seller-contact-info">

                                    @if($application->phone)
                                        <span>
                                            <i class="bi bi-telephone me-1"></i>
                                            {{ $application->phone }}
                                        </span>
                                    @else
                                        <span class="text-muted">
                                            No phone
                                        </span>
                                    @endif

                                    @if($application->address)
                                        <span>
                                            <i class="bi bi-geo-alt me-1"></i>
                                            {{ \Illuminate\Support\Str::limit($application->address, 30) }}
                                        </span>
                                    @endif

                                </div>

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($application->status === 'pending')

                                    <span class="seller-application-badge pending">
                                        <i class="bi bi-clock me-1"></i>
                                        Pending
                                    </span>

                                @elseif($application->status === 'approved')

                                    <span class="seller-application-badge approved">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Approved
                                    </span>

                                @else

                                    <span class="seller-application-badge rejected">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Rejected
                                    </span>

                                @endif

                            </td>


                            {{-- Date --}}
                            <td>

                                <div class="seller-application-date">

                                    <strong>
                                        {{ $application->created_at->format('M d, Y') }}
                                    </strong>

                                    <span>
                                        {{ $application->created_at->format('H:i') }}
                                    </span>

                                </div>

                            </td>


                            {{-- Action --}}
                            <td class="text-end">

                                <a
                                    href="{{ route('admin.seller-applications.show', $application) }}"
                                    class="seller-application-view-btn"
                                >
                                    <i class="bi bi-eye"></i>
                                    View
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($applications->hasPages())

            <div class="seller-application-pagination">

                {{ $applications->links() }}

            </div>

        @endif

    @else

        {{-- Empty State --}}
        <div class="seller-application-empty">

            <div class="seller-application-empty-icon">
                <i class="bi bi-inbox"></i>
            </div>

            <h5>No Applications Found</h5>

            <p>
                There are no seller applications matching your current filters.
            </p>

            @if(request()->hasAny(['search', 'status']))

                <a
                    href="{{ route('admin.seller-applications.index') }}"
                    class="seller-application-reset-btn"
                >
                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                    Clear Filters
                </a>

            @endif

        </div>

    @endif

</div>


</div>

@endsection
