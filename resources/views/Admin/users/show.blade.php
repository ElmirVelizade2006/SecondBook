@extends('layout.admin.master')

@section('title', 'User Details')

@section('content')
<div class="dashboard-section users-page">
    @php($displayName = $user->full_name ?: ($user->name ?: $user->username))

    <div class="dashboard-panel user-detail-hero mb-4">
        <div class="user-detail-identity">
            @if($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $displayName }}" class="detail-avatar">
            @else
                <div class="detail-avatar detail-avatar-fallback">{{ strtoupper(substr($displayName, 0, 1)) }}</div>
            @endif
            <div>
                <span class="eyebrow">User profile</span>
                <h2>{{ $displayName }}</h2>
                <p>{{ '@' . $user->username }} <span class="detail-dot">&bull;</span> Joined {{ $user->created_at?->format('d M Y') }}</p>
            </div>
        </div>
        <div class="user-detail-actions">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning"><i class="bi bi-pencil me-2"></i>Edit</a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-light border"><i class="bi bi-arrow-left me-2"></i>Back</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="dashboard-panel user-detail-panel h-100">
                <div class="panel-header"><div><span class="eyebrow">Account overview</span><h5>Profile information</h5></div><span class="status-pill status-{{ $user->status }}"><i class="bi bi-circle-fill"></i>{{ ucfirst($user->status) }}</span></div>
                <div class="detail-grid">
                    <div><small>Full name</small><strong>{{ $displayName }}</strong></div>
                    <div><small>Email</small><strong>{{ $user->email }}</strong><span class="detail-subtext"><i class="bi bi-{{ $user->email_verified_at ? 'check-circle' : 'clock' }}"></i> {{ $user->email_verified_at ? 'Verified' : 'Not verified' }}</span></div>
                    <div><small>Phone</small><strong>{{ $user->phone ?: '-' }}</strong></div>
                    <div><small>Role</small><span class="role-pill {{ $user->role === 'admin' ? 'role-admin' : 'role-member' }}"><i class="bi {{ $user->role === 'admin' ? 'bi-stars' : 'bi-person' }}"></i>{{ ucfirst($user->role) }}</span></div>
                    <div><small>Registration date</small><strong>{{ $user->created_at?->format('d M Y H:i') }}</strong></div>
                    <div><small>Last login</small><strong>{{ $user->last_login_at?->format('d M Y H:i') ?: 'No login recorded' }}</strong></div>
                    <div class="detail-wide"><small>Address</small><strong>{{ collect([$user->address, $user->city, $user->country])->filter()->join(', ') ?: '-' }}</strong></div>
                    <div class="detail-wide"><small>Bio</small><strong class="detail-description">{{ $user->bio ?: '-' }}</strong></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="dashboard-panel user-metrics-panel h-100">
                <div class="panel-header"><div><span class="eyebrow">Marketplace activity</span><h5>Purchase summary</h5></div></div>
                <div class="user-metric"><span>Orders placed</span><strong>{{ number_format($user->orders_count ?? 0) }}</strong><i class="bi bi-bag-check"></i></div>
                <div class="user-metric"><span>Total spending</span><strong>${{ number_format((float) ($user->orders_sum_total_price ?? 0), 2) }}</strong><i class="bi bi-wallet2"></i></div>
                <small class="text-muted">Based on the existing orders linked to this account.</small>
            </div>
        </div>
    </div>

    <div class="dashboard-panel user-danger-panel mt-4">
        <div><span class="eyebrow danger-eyebrow">Danger zone</span><h5>Delete account</h5><p>This permanently removes the user and their profile photo.</p></div>
        @if(auth()->id() !== $user->id)
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="delete-user-form" data-user-name="{{ $displayName }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash me-2"></i>Delete user</button>
            </form>
        @else
            <span class="text-muted small">Your own account is protected.</span>
        @endif
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-user-form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Delete user?',
                    text: 'This will permanently remove ' + (form.dataset.userName || 'this user') + '.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete user',
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
