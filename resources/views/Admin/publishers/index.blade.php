@extends('layout.admin.master')

@section('title', 'Publishers')

@section('content')

<div class="dashboard-section publishers-page">

    {{-- Page Header --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Publishers</h5>

                <p class="text-muted mb-0 small">
                    Manage all publishers listed on SecondBook
                </p>
            </div>

            <a href="{{ route('admin.publishers.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Add Publisher
            </a>

        </div>

    </div>


    {{-- Search & Filter --}}
    <div class="dashboard-panel mb-4">

        <form
            method="GET"
            action="{{ route('admin.publishers.index') }}"
            class="row g-3 align-items-end"
        >

            <div class="col-12 col-md-8 col-lg-8">

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
                        placeholder="Publisher name..."
                    >

                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>

                </div>

            </div>


            <div class="col-12 col-md-4 col-lg-4 d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-primary flex-grow-1 flex-lg-grow-0 px-4"
                >
                    <i class="bi bi-funnel me-1"></i>
                    Filter
                </button>

                <a
                    href="{{ route('admin.publishers.index') }}"
                    class="btn btn-light border"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>

    @endif


    {{-- Publisher List --}}
    <div class="dashboard-panel">

        <div class="panel-header">

            <h5>Publisher List</h5>

            <span class="badge bg-primary">
                {{ $publishers->total() }} publishers
            </span>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Logo</th>

                        <th>Name</th>

                        <th class="d-none d-lg-table-cell">
                            Country
                        </th>

                        <th class="d-none d-xl-table-cell">
                            Website
                        </th>

                        <th class="d-none d-xxl-table-cell">
                            Description
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="d-none d-lg-table-cell">
                            Created At
                        </th>

                        <th class="d-none d-lg-table-cell">
                            Updated At
                        </th>

                        <th class="text-end">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($publishers as $publisher)

                        <tr>

                            {{-- ID --}}
                            <td>
                                {{ $publisher->id }}
                            </td>


                            {{-- Logo --}}
                            <td>

                                @if(!empty($publisher->logo))

                                    @php

                                        $logoUrl = filter_var(
                                            $publisher->logo,
                                            FILTER_VALIDATE_URL
                                        )
                                            ? $publisher->logo
                                            : asset(
                                                'storage/' .
                                                ltrim($publisher->logo, '/')
                                            );

                                    @endphp

                                    <div class="publisher-logo-wrapper">

                                        <img
                                            src="{{ $logoUrl }}"
                                            alt="{{ $publisher->name }}"
                                            class="publisher-logo-thumb"
                                            loading="lazy"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                        >

                                        <div
                                            class="publisher-logo-placeholder"
                                            style="display: none;"
                                        >
                                            <i class="bi bi-building"></i>
                                        </div>

                                    </div>

                                @else

                                    <div class="publisher-logo-wrapper">

                                        <div class="publisher-logo-placeholder">
                                            <i class="bi bi-building"></i>
                                        </div>

                                    </div>

                                @endif

                            </td>


                            {{-- Name --}}
                            <td>

                                <strong class="d-block">
                                    {{ $publisher->name }}
                                </strong>

                                <small class="text-muted d-lg-none">
                                    {{ $publisher->country ?: '-' }}
                                </small>

                            </td>


                            {{-- Country --}}
                            <td class="d-none d-lg-table-cell">

                                {{ $publisher->country ?: '-' }}

                            </td>


                            {{-- Website --}}
                            <td class="d-none d-xl-table-cell">

                                @if(!empty($publisher->website))

                                    <a
                                        href="{{ $publisher->website }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-decoration-none"
                                    >
                                        {{ $publisher->website }}
                                    </a>

                                @else

                                    -

                                @endif

                            </td>


                            {{-- Description --}}
                            <td class="d-none d-xxl-table-cell">

                                {{ \Illuminate\Support\Str::limit(
                                    $publisher->description,
                                    80
                                ) ?: '-' }}

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($publisher->status ?? false)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- Created At --}}
                            <td class="d-none d-lg-table-cell">

                                {{ $publisher->created_at?->format('d M Y H:i') }}

                            </td>


                            {{-- Updated At --}}
                            <td class="d-none d-lg-table-cell">

                                {{ $publisher->updated_at?->format('d M Y H:i') }}

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex justify-content-end gap-2">


                                    {{-- View --}}
                                    <a
                                        href="{{ route('admin.publishers.show', $publisher->id) }}"
                                        class="btn btn-light btn-sm border"
                                        title="View"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    {{-- Status --}}
                                    <form
                                        action="{{ route('admin.publishers.status', $publisher->id) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-sm {{ ($publisher->status ?? false) ? 'btn-warning text-dark' : 'btn-success' }}"
                                            title="{{ ($publisher->status ?? false) ? 'Deactivate' : 'Activate' }}"
                                        >

                                            <i
                                                class="bi {{ ($publisher->status ?? false)
                                                    ? 'bi-pause-circle'
                                                    : 'bi-check-circle' }}"
                                            ></i>

                                        </button>

                                    </form>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('admin.publishers.edit', $publisher->id) }}"
                                        class="btn btn-warning btn-sm"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.publishers.destroy', $publisher->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete this publisher?')"
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
                                colspan="10"
                                class="text-center py-5"
                            >

                                <div class="chart-placeholder publishers-empty-state">

                                    <i class="bi bi-building"></i>

                                    <h6>
                                        No publishers found
                                    </h6>

                                    <p>
                                        Add your first publisher to get started.
                                    </p>

                                    <a
                                        href="{{ route('admin.publishers.create') }}"
                                        class="btn btn-primary mt-3"
                                    >
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Add Publisher
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($publishers->hasPages())

            <div class="pt-3">

                {{ $publishers->links() }}

            </div>

        @endif

    </div>

</div>

@endsection