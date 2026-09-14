@extends('layout.admin.master')

@section('title', 'Edit User')

@section('content')
<div class="dashboard-section users-page">
    <div class="dashboard-panel mb-4">
        <div class="panel-header mb-0">
            <div>
                <span class="eyebrow">Community directory</span>
                <h5 class="mb-1">Edit user</h5>
                <p class="text-muted mb-0 small">Update {{ $user->full_name ?: $user->username }}'s account.</p>
            </div>
            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-light border"><i class="bi bi-arrow-left me-2"></i>Back to profile</a>
        </div>
    </div>

    <div class="dashboard-panel user-form-panel">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('Admin.users._form')
        </form>
    </div>
</div>
@endsection
