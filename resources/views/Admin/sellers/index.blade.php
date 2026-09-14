@extends('layout.admin.master')

@section('title', 'Sellers')

@section('content')
<div class="dashboard-section sellers-page">
    <div class="sellers-hero mb-4">
        <div class="sellers-hero-content">
            <span class="hero-badge"><i class="bi bi-shop-window"></i> Seller management</span>
            <h1>Sellers</h1>
            <p>Manage the people powering SecondBook's marketplace.</p>
        </div>
        <div class="sellers-hero-mark"><i class="bi bi-shop"></i></div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3"><div class="seller-stat-card stat-blue"><div><span>Total sellers</span><strong>{{ number_format($stats['total']) }}</strong></div><i class="bi bi-shop"></i></div></div>
        <div class="col-12 col-sm-6 col-xl-3"><div class="seller-stat-card stat-green"><div><span>Active sellers</span><strong>{{ number_format($stats['active']) }}</strong></div><i class="bi bi-person-check"></i></div></div>
        <div class="col-12 col-sm-6 col-xl-3"><div class="seller-stat-card stat-orange"><div><span>Inactive sellers</span><strong>{{ number_format($stats['inactive']) }}</strong></div><i class="bi bi-pause-circle"></i></div></div>
        <div class="col-12 col-sm-6 col-xl-3"><div class="seller-stat-card stat-red"><div><span>Banned sellers</span><strong>{{ number_format($stats['banned']) }}</strong></div><i class="bi bi-slash-circle"></i></div></div>
    </div>

    <div class="dashboard-panel sellers-panel">
        <div class="panel-header sellers-panel-header">
            <div><span class="eyebrow">Marketplace directory</span><h5>All sellers</h5><p>Review seller accounts and their listed inventory.</p></div>
            <a href="{{ route('admin.sellers.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Add seller</a>
        </div>

        <form method="GET" action="{{ route('admin.sellers.index') }}" class="seller-filters">
            <div class="seller-search-field"><i class="bi bi-search"></i><input type="search" name="search" value="{{ $search }}" placeholder="Search sellers..." aria-label="Search sellers"></div>
            <select name="status" class="form-select seller-status-filter" aria-label="Filter by status">
                <option value="">All status</option>
                <option value="active" @selected($status === 'active')>Active</option>
                <option value="inactive" @selected($status === 'inactive')>Inactive</option>
                <option value="banned" @selected($status === 'banned')>Banned</option>
            </select>
            <select name="sort" class="form-select seller-sort-filter" aria-label="Sort sellers">
                <option value="newest" @selected($sort === 'newest')>Newest</option>
                <option value="oldest" @selected($sort === 'oldest')>Oldest</option>
                <option value="name_asc" @selected($sort === 'name_asc')>Name A-Z</option>
                <option value="name_desc" @selected($sort === 'name_desc')>Name Z-A</option>
            </select>
            <button type="submit" class="btn btn-primary seller-filter-button"><i class="bi bi-funnel me-2"></i>Filter</button>
            @if($search || $status || $sort !== 'newest')<a href="{{ route('admin.sellers.index') }}" class="seller-clear-filter">Reset</a>@endif
        </form>

        <div class="table-responsive sellers-table-wrap">
            <table class="table sellers-table align-middle">
                <thead><tr><th>Seller</th><th class="d-none d-md-table-cell">Email</th><th class="d-none d-lg-table-cell">Phone</th><th>Status</th><th>Books</th><th class="d-none d-xl-table-cell">Joined</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @forelse($sellers as $seller)
                        @php($displayName = $seller->name ?: $seller->full_name ?: $seller->username)
                        <tr>
                            <td><div class="seller-member-cell">
                                @if($seller->profile_photo)<img src="{{ asset('storage/' . $seller->profile_photo) }}" alt="{{ $displayName }}" class="seller-avatar seller-avatar-image">@else<div class="seller-avatar">{{ strtoupper(substr($displayName, 0, 1)) }}</div>@endif
                                <div><strong>{{ $displayName }}</strong><small>Seller #{{ $seller->id }}</small></div>
                            </div></td>
                            <td class="d-none d-md-table-cell"><span class="seller-email">{{ $seller->email }}</span></td>
                            <td class="d-none d-lg-table-cell"><span class="seller-phone">{{ $seller->phone ?: '-' }}</span></td>
                            <td><span class="seller-status-pill seller-status-{{ $seller->status }}"><i class="bi bi-circle-fill"></i>{{ ucfirst($seller->status) }}</span></td>
                            <td><span class="book-count"><i class="bi bi-book"></i>{{ number_format($seller->books_count) }}</span></td>
                            <td class="d-none d-xl-table-cell"><span class="seller-joined">{{ $seller->created_at?->format('d M Y') }}</span></td>
                            <td><div class="seller-actions">
                                <a href="{{ route('admin.sellers.show', $seller) }}" class="btn btn-light btn-sm border" title="View"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('admin.sellers.edit', $seller) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                @if(auth()->id() !== $seller->id)
                                    <form action="{{ route('admin.sellers.status', $seller) }}" method="POST">@csrf @method('PATCH')<input type="hidden" name="status" value="{{ $seller->status === 'active' ? 'inactive' : 'active' }}"><button type="submit" class="btn btn-light btn-sm border" title="{{ $seller->status === 'active' ? 'Deactivate' : 'Activate' }}"><i class="bi bi-{{ $seller->status === 'active' ? 'pause' : 'play' }}-circle"></i></button></form>
                                    @if($seller->status !== 'banned')<form action="{{ route('admin.sellers.status', $seller) }}" method="POST">@csrf @method('PATCH')<input type="hidden" name="status" value="banned"><button type="submit" class="btn btn-light btn-sm border text-danger" title="Ban"><i class="bi bi-slash-circle"></i></button></form>@endif
                                    @if($seller->books_count === 0)<form action="{{ route('admin.sellers.destroy', $seller) }}" method="POST" class="delete-seller-form" data-seller-name="{{ $displayName }}">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button></form>@else<button type="button" class="btn btn-light btn-sm border text-muted" title="Reassign books before deleting" disabled><i class="bi bi-trash"></i></button>@endif
                                @endif
                            </div></td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="seller-empty-state"><i class="bi bi-shop"></i><strong>No sellers found</strong><span>Try another search or add your first seller.</span><a href="{{ route('admin.sellers.create') }}" class="btn btn-primary mt-3"><i class="bi bi-plus-circle me-2"></i>Add seller</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($sellers->hasPages())<div class="sellers-pagination">{{ $sellers->links() }}</div>@endif
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-seller-form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Delete seller?',
                    text: 'This will permanently remove ' + (form.dataset.sellerName || 'this seller') + '.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete seller',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#dc3545',
                    reverseButtons: true
                }).then(function (result) { if (result.isConfirmed) form.submit(); });
            });
        });
    });
</script>
@endpush
@endsection
