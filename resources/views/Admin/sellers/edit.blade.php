@extends('layout.admin.master')

@section('title', 'Edit Seller')

@section('content')
<div class="dashboard-section sellers-page">
    <div class="dashboard-panel mb-4">
        <div class="panel-header mb-0">
            <div>
                <span class="eyebrow">Seller management</span>
                <h5 class="mb-1">Edit seller</h5>
                <p class="text-muted mb-0 small">Update {{ $seller->name ?: $seller->username }}'s account.</p>
            </div>
            <a href="{{ route('admin.sellers.show', $seller) }}" class="btn btn-light border"><i class="bi bi-arrow-left me-2"></i>Back to profile</a>
        </div>
    </div>

    <div class="dashboard-panel seller-form-panel">
        <form action="{{ route('admin.sellers.update', $seller) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('Admin.sellers._form')
        </form>
    </div>
</div>
@endsection
