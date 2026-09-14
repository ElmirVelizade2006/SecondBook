@extends('layout.admin.master')

@section('title', 'Seller Details')

@section('content')
<div class="dashboard-section sellers-page">
    @php($displayName = $seller->name ?: $seller->full_name ?: $seller->username)

    <div class="dashboard-panel seller-detail-hero mb-4">
        <div class="seller-detail-identity">
            @if($seller->profile_photo)<img src="{{ asset('storage/' . $seller->profile_photo) }}" alt="{{ $displayName }}" class="seller-detail-avatar">@else<div class="seller-detail-avatar seller-detail-avatar-fallback">{{ strtoupper(substr($displayName, 0, 1)) }}</div>@endif
            <div><span class="eyebrow">Seller profile</span><h2>{{ $displayName }}</h2><p>{{ $seller->email }} <span class="seller-detail-dot">&bull;</span> Seller #{{ $seller->id }} <span class="seller-detail-dot">&bull;</span> Joined {{ $seller->created_at?->format('d M Y') }}</p></div>
        </div>
        <div class="seller-detail-actions"><a href="{{ route('admin.sellers.edit', $seller) }}" class="btn btn-warning"><i class="bi bi-pencil me-2"></i>Edit</a><a href="{{ route('admin.sellers.index') }}" class="btn btn-light border"><i class="bi bi-arrow-left me-2"></i>Back</a></div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3"><div class="seller-detail-stat"><span>Total books</span><strong>{{ number_format($bookStats['total']) }}</strong><i class="bi bi-book"></i></div></div>
        <div class="col-12 col-sm-6 col-xl-3"><div class="seller-detail-stat stat-green"><span>Approved</span><strong>{{ number_format($bookStats['approved']) }}</strong><i class="bi bi-check-circle"></i></div></div>
        <div class="col-12 col-sm-6 col-xl-3"><div class="seller-detail-stat stat-orange"><span>Pending</span><strong>{{ number_format($bookStats['pending']) }}</strong><i class="bi bi-clock"></i></div></div>
        <div class="col-12 col-sm-6 col-xl-3"><div class="seller-detail-stat stat-red"><span>Rejected</span><strong>{{ number_format($bookStats['rejected']) }}</strong><i class="bi bi-x-circle"></i></div></div>
    </div>

    <div class="dashboard-panel seller-books-panel">
        <div class="panel-header"><div><span class="eyebrow">Inventory</span><h5>Seller books</h5><p>Books currently linked to this seller.</p></div><span class="seller-record-count"><i class="bi bi-database"></i>{{ $books->total() }} records</span></div>
        <div class="table-responsive">
            <table class="table seller-books-table align-middle">
                <thead><tr><th>Book</th><th>Price</th><th>Stock</th><th>Condition</th><th>Status</th><th>Added</th></tr></thead>
                <tbody>
                    @forelse($books as $book)
                        <tr><td><strong>{{ $book->title }}</strong><small>{{ $book->isbn ?: 'No ISBN' }}</small></td><td>${{ number_format((float) $book->price, 2) }}</td><td>{{ $book->stock }}</td><td><span class="condition-pill">{{ $book->condition ? str_replace('_', ' ', ucfirst($book->condition)) : '-' }}</span></td><td><span class="book-status book-status-{{ $book->status }}">{{ ucfirst($book->status) }}</span></td><td>{{ $book->created_at?->format('d M Y') }}</td></tr>
                    @empty
                        <tr><td colspan="6" class="seller-empty-state"><i class="bi bi-book"></i><strong>No books listed</strong><span>This seller has not added any books yet.</span></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($books->hasPages())<div class="sellers-pagination">{{ $books->links() }}</div>@endif
    </div>

    <div class="dashboard-panel seller-danger-panel mt-4"><div><span class="eyebrow danger-eyebrow">Danger zone</span><h5>Delete seller</h5><p>A seller with books must be reassigned before deletion.</p></div>@if($books->total() === 0)<form action="{{ route('admin.sellers.destroy', $seller) }}" method="POST" class="delete-seller-form" data-seller-name="{{ $displayName }}">@csrf @method('DELETE')<button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash me-2"></i>Delete seller</button></form>@else<span class="text-muted small">Reassign all books before deleting.</span>@endif</div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-seller-form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({ title: 'Delete seller?', text: 'This will permanently remove ' + (form.dataset.sellerName || 'this seller') + '.', icon: 'warning', showCancelButton: true, confirmButtonText: 'Delete seller', cancelButtonText: 'Cancel', confirmButtonColor: '#dc3545', reverseButtons: true }).then(function (result) { if (result.isConfirmed) form.submit(); });
            });
        });
    });
</script>
@endpush
@endsection
