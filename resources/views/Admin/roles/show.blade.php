@extends('layout.admin.master')

@section('title', $role->display_name)

@section('content')
<div class="dashboard-section roles-page">
    <div class="dashboard-panel role-detail-hero mb-4"><div><span class="eyebrow">Role profile</span><div class="role-detail-title"><div class="role-detail-icon"><i class="bi {{ $role->name === 'super-admin' ? 'bi-stars' : 'bi-person-badge' }}"></i></div><div><h2>{{ $role->display_name }}</h2><p>{{ $role->description ?: 'No description provided.' }}</p></div></div></div><div class="role-detail-actions">@can('roles.edit')<a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-warning"><i class="bi bi-pencil me-2"></i>Edit</a>@endcan<a href="{{ route('admin.roles.index') }}" class="btn btn-light border"><i class="bi bi-arrow-left me-2"></i>Back</a></div></div>

    <div class="row g-4 mb-4"><div class="col-12 col-sm-6"><div class="role-detail-stat"><span>Users with this role</span><strong>{{ number_format($role->users->count()) }}</strong><i class="bi bi-people"></i></div></div><div class="col-12 col-sm-6"><div class="role-detail-stat stat-green"><span>Assigned permissions</span><strong>{{ number_format($role->permissions->count()) }}</strong><i class="bi bi-key"></i></div></div></div>

    <div class="row g-4"><div class="col-12 col-xl-8"><div class="dashboard-panel permission-summary-panel"><div class="panel-header"><div><span class="eyebrow">Access matrix</span><h5>Assigned permissions</h5></div>@if($role->is_system)<span class="system-badge large">System role</span>@endif</div><div class="permission-summary-grid">@forelse($role->permissions->groupBy('group_name') as $group => $permissions)<section><h6>{{ $group }}</h6><div class="permission-badges">@foreach($permissions as $permission)<span class="permission-badge"><i class="bi bi-check2"></i>{{ $permission->display_name }}</span>@endforeach</div></section>@empty<div class="role-empty-state"><i class="bi bi-key"></i><strong>No permissions assigned</strong></div>@endforelse</div></div></div><div class="col-12 col-xl-4"><div class="dashboard-panel role-users-panel"><div class="panel-header"><div><span class="eyebrow">People</span><h5>Assigned users</h5></div></div>@forelse($role->users as $user)<div class="role-user-row"><div class="role-user-avatar">{{ strtoupper(substr($user->full_name ?: $user->username, 0, 1)) }}</div><div><strong>{{ $user->full_name ?: $user->username }}</strong><small>{{ $user->email }}</small></div></div>@empty<p class="text-muted small">No users assigned to this role.</p>@endforelse</div></div></div>
</div>
@endsection
