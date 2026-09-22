@extends('layout.admin.master')

@section('title', 'Author Details')

@section('content')

<div class="dashboard-section authors-page">

    {{-- Header --}}
    <div class="dashboard-panel mb-4">

        <div class="panel-header mb-0">

            <div>
                <h5 class="mb-1">Author Details</h5>
                <p class="text-muted mb-0 small">
                    Review details for this author
                </p>
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('admin.authors.edit', $author->id) }}"
                   class="btn btn-warning">
                    <i class="bi bi-pencil me-2"></i>
                    Edit
                </a>

                <a href="{{ route('admin.authors.index') }}"
                   class="btn btn-light border">
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Authors
                </a>

            </div>

        </div>

    </div>


    {{-- Author Details --}}
    <div class="dashboard-panel">

        <div class="author-details-layout">

            {{-- Photo --}}
            <div class="author-details-photo-section">

                <div class="author-details-label">
                    Author Photo
                </div>

                @if(!empty($author->photo))

                    <div class="author-details-photo-wrapper">

                        <img
                            src="{{ str_starts_with($author->photo, 'http')
                                ? $author->photo
                                : asset('storage/' . ltrim($author->photo, '/')) }}"
                            alt="{{ $author->name }}"
                            class="author-details-photo">

                    </div>

                @else

                    <div class="author-details-no-photo">
                        <i class="bi bi-person"></i>
                        <span>No Photo</span>
                    </div>

                @endif

            </div>


            {{-- Information --}}
            <div class="author-details-info">

                <div class="author-info-card">

                    <div class="author-info-label">
                        ID
                    </div>

                    <div class="author-info-value">
                        #{{ $author->id }}
                    </div>

                </div>


                <div class="author-info-card">

                    <div class="author-info-label">
                        Name
                    </div>

                    <div class="author-info-value">
                        {{ $author->name }}
                    </div>

                </div>


                <div class="author-info-card">

                    <div class="author-info-label">
                        Status
                    </div>

                    <div class="author-info-value">

                        @if($author->status)

                            <span class="author-status active">
                                <span class="status-dot"></span>
                                Active
                            </span>

                        @else

                            <span class="author-status inactive">
                                <span class="status-dot"></span>
                                Inactive
                            </span>

                        @endif

                    </div>

                </div>


                <div class="author-info-card">

                    <div class="author-info-label">
                        Created At
                    </div>

                    <div class="author-info-value">
                        {{ $author->created_at?->format('d M Y H:i') ?? '-' }}
                    </div>

                </div>


                <div class="author-info-card">

                    <div class="author-info-label">
                        Updated At
                    </div>

                    <div class="author-info-value">
                        {{ $author->updated_at?->format('d M Y H:i') ?? '-' }}
                    </div>

                </div>

            </div>

        </div>


        {{-- Biography --}}
        <div class="author-bio-section">

            <div class="author-details-label">
                Biography
            </div>

            <div class="author-bio-card">
                {{ $author->bio ?: 'No biography available for this author.' }}
            </div>

        </div>

    </div>

</div>

@endsection

