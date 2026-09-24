@extends('layout.admin.master')

@section('title', 'Edit Role')

@section('content')

<div class="dashboard-section roles-page role-edit-page">


<div class="dashboard-panel role-edit-header-panel">
    <div class="role-edit-header">

        <div class="role-edit-heading">
            <span class="eyebrow">
                <i class="bi bi-shield-lock"></i>
                Access control
            </span>

            <h5>Edit role</h5>

            <p>
                Update {{ $role->display_name }} access permissions.
            </p>
        </div>

        <div class="role-edit-header-action">
            <a
                href="{{ route('admin.roles.show', $role) }}"
                class="btn role-back-btn"
            >
                <i class="bi bi-arrow-left"></i>
                <span>Back to role</span>
            </a>
        </div>

    </div>
</div>

<div class="dashboard-panel role-form-panel">

    <form
        action="{{ route('admin.roles.update', $role) }}"
        method="POST"
        class="role-edit-form"
    >
        @csrf
        @method('PUT')

        @include('Admin.roles._form')
    </form>

</div>


</div>

@endsection

@push('js') <script src="{{ asset('admin/js/roles.js') }}"></script>
@endpush
