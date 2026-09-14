@extends('layout.admin.master')

@section('title', 'Create Role')

@section('content')
<div class="dashboard-section roles-page">
    <div class="dashboard-panel mb-4">
        <div class="panel-header mb-0"><div><span class="eyebrow">Access control</span><h5 class="mb-1">Create role</h5><p class="text-muted mb-0 small">Define a role and assign its permissions.</p></div><a href="{{ route('admin.roles.index') }}" class="btn btn-light border"><i class="bi bi-arrow-left me-2"></i>Back to roles</a></div>
    </div>
    <div class="dashboard-panel role-form-panel">
        <form action="{{ route('admin.roles.store') }}" method="POST">@csrf @include('Admin.roles._form')</form>
    </div>
</div>
@endsection

@push('js')<script src="{{ asset('admin/js/roles.js') }}"></script>@endpush
