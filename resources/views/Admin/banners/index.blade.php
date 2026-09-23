@extends('layout.admin.master')

@section('title', 'Banners')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/banners.css') }}">
@endpush

@section('content')

<div class="dashboard-section banners-page">

    {{-- Header --}}
    <div class="dashboard-panel mb-4">
        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Banners</h5>
                <p class="text-muted mb-0 small">
                    Manage your website banners
                </p>
            </div>

            <a href="{{ route('admin.banners.create') }}"
               class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Add Banner
            </a>

        </div>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Filters --}}
    <div class="dashboard-panel mb-4">

        <form action="{{ route('admin.banners.index') }}"
              method="GET"
              class="banner-filters">

            <div class="banner-search-group">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Search banner..."
                >

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                    Search
                </button>
            </div>


            <div class="banner-status-filter">

                <select name="status" class="form-select">
                    <option value="">All Statuses</option>

                    <option value="active"
                        {{ request('status') === 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ request('status') === 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>

            </div>


            @if(request('search') || request('status'))
                <a href="{{ route('admin.banners.index') }}"
                   class="btn btn-light banner-reset-btn">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
            @endif

        </form>

    </div>


    {{-- Banners Table --}}
    <div class="dashboard-panel">

        <div class="table-responsive">

            <table class="table banners-table align-middle mb-0">

                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th width="120">Image</th>
                        <th>Title</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Dates</th>
                        <th width="130" class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($banners as $banner)

                        <tr>

                            {{-- ID --}}
                            <td>
                                {{ $banners->firstItem() + $loop->index }}
                            </td>


                            {{-- Image --}}
                            <td>

                                <div class="banner-image-wrapper">

                                    <img
                                        src="{{ asset('storage/' . $banner->image) }}"
                                        alt="{{ $banner->title }}"
                                        class="banner-image"
                                    >

                                </div>

                            </td>


                            {{-- Title --}}
                            <td>

                                <div class="banner-title">
                                    {{ $banner->title }}
                                </div>

                                @if($banner->subtitle)
                                    <div class="banner-subtitle">
                                        {{ $banner->subtitle }}
                                    </div>
                                @endif

                            </td>


                            {{-- Position --}}
                            <td>
                                <span class="position-badge">
                                    {{ $banner->position }}
                                </span>
                            </td>


                            {{-- Status --}}
                            <td>

                                @if($banner->status === 'active')

                                    <span class="status-badge status-active">
                                        <span class="status-dot"></span>
                                        Active
                                    </span>

                                @else

                                    <span class="status-badge status-inactive">
                                        <span class="status-dot"></span>
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- Dates --}}
                            <td>

                                @if($banner->start_date || $banner->end_date)

                                    <div class="banner-dates">

                                        @if($banner->start_date)
                                            <div>
                                                <i class="bi bi-calendar-event"></i>
                                                {{ $banner->start_date->format('d M Y') }}
                                            </div>
                                        @endif

                                        @if($banner->end_date)
                                            <div>
                                                <i class="bi bi-calendar-check"></i>
                                                {{ $banner->end_date->format('d M Y') }}
                                            </div>
                                        @endif

                                    </div>

                                @else

                                    <span class="text-muted">
                                        No date limit
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="banner-actions">

                                    <a
                                        href="{{ route('admin.banners.edit', $banner) }}"
                                        class="action-btn action-edit"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    <form
                                        action="{{ route('admin.banners.destroy', $banner) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this banner?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn action-delete"
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

                            <td colspan="7">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-image"></i>
                                    </div>

                                    <h6>No banners found</h6>

                                    <p>
                                        Create your first banner to display it on your website.
                                    </p>

                                    <a
                                        href="{{ route('admin.banners.create') }}"
                                        class="btn btn-primary"
                                    >
                                        <i class="bi bi-plus-lg"></i>
                                        Add Banner
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($banners->hasPages())

            <div class="banners-pagination">
                {{ $banners->links() }}
            </div>

        @endif

    </div>

</div>

@endsection