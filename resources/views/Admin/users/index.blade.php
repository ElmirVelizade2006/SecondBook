@extends('layout.admin.master')

@section('title', 'Users')

@section('content')
<div class="dashboard-section users-page">
	<div class="users-hero mb-4">
		<div class="users-hero-content">
			<span class="hero-badge"><i class="bi bi-shield-check"></i> SecondBook Community</span>
			<h1>People behind every page.</h1>
			<p>Keep your reader community organised, verified and ready to grow.</p>
		</div>
		<div class="users-hero-mark"><i class="bi bi-people-fill"></i></div>
	</div>

	<div class="row g-4 mb-4">
		<div class="col-12 col-sm-6 col-xl-3">
			<div class="user-stat-card stat-blue">
				<div><span>Total users</span><strong>{{ number_format($stats['total']) }}</strong></div>
				<i class="bi bi-people"></i>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-xl-3">
			<div class="user-stat-card stat-green">
				<div><span>Active users</span><strong>{{ number_format($stats['active']) }}</strong></div>
				<i class="bi bi-person-check"></i>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-xl-3">
			<div class="user-stat-card stat-orange">
				<div><span>Inactive / banned</span><strong>{{ number_format($stats['inactive']) }}</strong></div>
				<i class="bi bi-person-slash"></i>
			</div>
		</div>
		<div class="col-12 col-sm-6 col-xl-3">
			<div class="user-stat-card stat-purple">
				<div><span>Admin users</span><strong>{{ number_format($stats['admins']) }}</strong></div>
				<i class="bi bi-shield-lock"></i>
			</div>
		</div>
	</div>

	<div class="dashboard-panel users-panel">
		<div class="panel-header users-panel-header">
			<div>
				<span class="eyebrow">Community directory</span>
				<h5>All users</h5>
				<p>Search and review every account in your marketplace.</p>
			</div>
			<a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="bi bi-person-plus me-2"></i>Add user</a>
		</div>

		<form method="GET" action="{{ route('admin.users.index') }}" class="user-filters">
			<div class="search-field">
				<i class="bi bi-search"></i>
				<input type="search" name="search" value="{{ $search }}" placeholder="Search name, email, username or phone..." aria-label="Search users">
			</div>
			<select name="role" class="form-select role-filter" aria-label="Filter by role">
				<option value="">All roles</option>
				@foreach($roles as $roleOption)
					<option value="{{ $roleOption->name }}" @selected($role === $roleOption->name)>{{ $roleOption->display_name }}</option>
				@endforeach
			</select>
			<select name="status" class="form-select status-filter" aria-label="Filter by status">
				<option value="">All statuses</option>
				<option value="active" @selected($status === 'active')>Active</option>
				<option value="inactive" @selected($status === 'inactive')>Inactive</option>
				<option value="banned" @selected($status === 'banned')>Banned</option>
			</select>
			<button type="submit" class="btn btn-primary filter-button"><i class="bi bi-funnel me-2"></i>Filter</button>
			@if($search || $role || $status)
				<a href="{{ route('admin.users.index') }}" class="clear-filter">Clear</a>
			@endif
		</form>

		<div class="table-responsive users-table-wrap">
			<table class="table users-table align-middle">
				<colgroup>
					<col class="users-col-user">
					<col class="users-col-email">
					<col class="users-col-phone">
					<col class="users-col-role">
					<col class="users-col-status">
					<col class="users-col-registered">
					<col class="users-col-actions">
				</colgroup>
				<thead>
					<tr><th>User</th><th class="d-none d-md-table-cell">Email</th><th class="d-none d-lg-table-cell">Phone</th><th>Role</th><th>Status</th><th class="d-none d-xl-table-cell">Registered</th><th class="text-end">Actions</th></tr>
				</thead>
				<tbody>
					@forelse($users as $user)
						@php($displayName = $user->full_name ?: ($user->name ?: $user->username))
						<tr>
							<td>
								<div class="member-cell">
									@if($user->profile_photo)
										<img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $displayName }}" class="member-avatar member-avatar-image">
									@else
										<div class="member-avatar">{{ strtoupper(substr($displayName, 0, 1)) }}</div>
									@endif
									<div><strong>{{ $displayName }}</strong><small>{{ '@' . $user->username }}</small></div>
								</div>
							</td>
							<td class="d-none d-md-table-cell"><span class="user-email">{{ $user->email }}</span><small class="verification-note"><i class="bi bi-{{ $user->email_verified_at ? 'check-circle' : 'clock' }}"></i> {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}</small></td>
							<td class="d-none d-lg-table-cell"><span class="user-phone">{{ $user->phone ?: '-' }}</span></td>
							<td><span class="role-pill {{ $user->role === 'admin' ? 'role-admin' : 'role-member' }}"><i class="bi {{ $user->role === 'admin' ? 'bi-stars' : 'bi-person' }}"></i>{{ ucfirst($user->role) }}</span></td>
							<td><span class="status-pill status-{{ $user->status }}"><i class="bi bi-circle-fill"></i>{{ ucfirst($user->status) }}</span></td>
							<td class="d-none d-xl-table-cell"><span class="joined-date">{{ $user->created_at?->format('d M Y') }}</span></td>
							<td>
								<div class="user-actions">
									<a href="{{ route('admin.users.show', $user) }}" class="btn btn-light btn-sm border user-action-btn" title="View"><i class="bi bi-eye"></i></a>
									<a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm user-action-btn" title="Edit"><i class="bi bi-pencil"></i></a>
									@if(auth()->id() !== $user->id)
										<form action="{{ route('admin.users.status', $user) }}" method="POST">
											@csrf
											@method('PATCH')
											<input type="hidden" name="status" value="{{ $user->status === 'active' ? 'inactive' : 'active' }}">
											<button type="submit" class="btn btn-light btn-sm border user-action-btn" title="{{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}"><i class="bi bi-{{ $user->status === 'active' ? 'pause' : 'play' }}-circle"></i></button>
										</form>
										@if($user->status !== 'banned')
											<form action="{{ route('admin.users.status', $user) }}" method="POST">
												@csrf
												@method('PATCH')
												<input type="hidden" name="status" value="banned">
												<button type="submit" class="btn btn-light btn-sm border text-danger user-action-btn" title="Ban"><i class="bi bi-slash-circle"></i></button>
											</form>
										@endif
										<form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="delete-user-form" data-user-name="{{ $displayName }}">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger btn-sm user-action-btn" title="Delete"><i class="bi bi-trash"></i></button>
										</form>
									@endif
								</div>
							</td>
						</tr>
					@empty
						<tr><td colspan="7" class="empty-state"><i class="bi bi-person-x"></i><strong>No users found</strong><span>Try another search or clear the filters.</span></td></tr>
					@endforelse
				</tbody>
			</table>
		</div>

		@if($users->hasPages())
			<div class="users-pagination">{{ $users->links() }}</div>
		@endif
	</div>
</div>

@push('js')
<script>
	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('.delete-user-form').forEach(function (form) {
			form.addEventListener('submit', function (event) {
				event.preventDefault();
				var userName = form.dataset.userName || 'this user';

				Swal.fire({
					title: 'Delete user?',
					text: 'This will permanently remove ' + userName + '.',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Delete user',
					cancelButtonText: 'Cancel',
					confirmButtonColor: '#dc3545',
					reverseButtons: true
				}).then(function (result) {
					if (result.isConfirmed) {
						form.submit();
					}
				});
			});
		});
	});
</script>
@endpush

@endsection
