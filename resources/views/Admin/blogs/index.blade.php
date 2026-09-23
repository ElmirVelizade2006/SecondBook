@extends('layout.admin.master')

@section('title', 'Blogs')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/blogs.css') }}">
@endpush

@section('content')

<div class="dashboard-section blogs-page">

    {{-- Header --}}
    <div class="dashboard-panel blogs-header-panel">

        <div class="blogs-header-content">
            <div>
                <h5>Blogs</h5>
                <p>Manage your blog posts and publications</p>
            </div>

            <a href="{{ route('admin.blogs.create') }}"
               class="blogs-add-btn">
                <i class="bi bi-plus-lg"></i>
                <span>Add Blog</span>
            </a>
        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="blogs-alert">
            <i class="bi bi-check-circle-fill"></i>

            <span>{{ session('success') }}</span>

            <button type="button"
                    class="blogs-alert-close"
                    onclick="this.parentElement.remove()">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif


    {{-- Filters --}}
    <div class="dashboard-panel blogs-filter-panel">

        <form method="GET"
              action="{{ route('admin.blogs.index') }}">

            <div class="blogs-filter-row">

                <div class="blogs-search">
                    <label for="blog-search">
                        Search
                    </label>

                    <div class="blogs-search-group">

                        <i class="bi bi-search"></i>

                        <input type="text"
                               id="blog-search"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search blog posts...">

                    </div>
                </div>


                <div class="blogs-status-filter">

                    <label for="blog-status">
                        Status
                    </label>

                    <select id="blog-status"
                            name="status">

                        <option value="">
                            All Statuses
                        </option>

                        <option value="published"
                            {{ request('status') === 'published' ? 'selected' : '' }}>
                            Published
                        </option>

                        <option value="draft"
                            {{ request('status') === 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                    </select>

                </div>


                <div class="blogs-filter-actions">

                    <button type="submit"
                            class="blogs-search-btn">
                        <i class="bi bi-search"></i>
                        Search
                    </button>

                    @if(request()->filled('search') || request()->filled('status'))

                        <a href="{{ route('admin.blogs.index') }}"
                           class="blogs-reset-btn"
                           title="Reset filters">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>


    {{-- Table --}}
    <div class="dashboard-panel blogs-table-panel">

        <div class="blogs-table-wrapper">

            <table class="blogs-table">

                <thead>
                    <tr>
                        <th class="blog-col-id">#</th>
                        <th class="blog-col-image">Image</th>
                        <th>Blog</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th class="blog-col-actions">Actions</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($blogs as $blog)

                    <tr>

                        {{-- ID --}}
                        <td class="blog-id">
                            {{ $blog->id }}
                        </td>


                        {{-- Image --}}
                        <td>

                            @if($blog->image)

                                <img src="{{ asset('storage/' . $blog->image) }}"
                                     alt="{{ $blog->title }}"
                                     class="blog-image">

                            @else

                                <div class="blog-image-placeholder">
                                    <i class="bi bi-image"></i>
                                </div>

                            @endif

                        </td>


                        {{-- Blog --}}
                        <td>

                            <div class="blog-info">

                                <div class="blog-name">
                                    {{ $blog->title }}
                                </div>

                                @if($blog->excerpt)

                                    <div class="blog-excerpt">
                                        {{ Str::limit($blog->excerpt, 75) }}
                                    </div>

                                @endif

                            </div>

                        </td>


                        {{-- Author --}}
                        <td>

                            <span class="blog-author">
                                {{ $blog->author?->name ?? 'Admin' }}
                            </span>

                        </td>


                        {{-- Status --}}
                        <td>

                            @if($blog->status === 'published')

                                <span class="blog-status blog-status-published">
                                    <span></span>
                                    Published
                                </span>

                            @else

                                <span class="blog-status blog-status-draft">
                                    <span></span>
                                    Draft
                                </span>

                            @endif

                        </td>


                        {{-- Published --}}
                        <td>

                            @if($blog->published_at)

                                <div class="blog-date">
                                    {{ $blog->published_at->format('d M Y') }}
                                </div>

                            @else

                                <span class="blog-no-date">
                                    —
                                </span>

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td>

                            <div class="blog-actions">

                                <a href="{{ route('admin.blogs.edit', $blog) }}"
                                   class="blog-edit-btn"
                                   title="Edit Blog">
                                    <i class="bi bi-pencil"></i>
                                </a>


                                <form action="{{ route('admin.blogs.destroy', $blog) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this blog post?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="blog-delete-btn"
                                            title="Delete Blog">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7">

                            <div class="blogs-empty">

                                <div class="blogs-empty-icon">
                                    <i class="bi bi-journal-text"></i>
                                </div>

                                <h6>No Blog Posts Found</h6>

                                <p>
                                    There are no blog posts matching your search.
                                </p>

                                <a href="{{ route('admin.blogs.create') }}"
                                   class="blogs-add-btn">
                                    <i class="bi bi-plus-lg"></i>
                                    Add Blog
                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($blogs->hasPages())

            <div class="blogs-pagination">
                {{ $blogs->links() }}
            </div>

        @endif

    </div>

</div>

@endsection