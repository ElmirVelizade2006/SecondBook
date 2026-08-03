@extends('layout.admin.master')

@section('title', 'Edit Book Request')

@section('content')
<div class="dashboard-section">

    <div class="dashboard-panel mb-4">
        <div class="panel-header mb-0">
            <div>
                <h5 class="mb-1">Edit Book Request</h5>
                <p class="text-muted mb-0 small">Update request information</p>
            </div>
            <a href="{{ route('admin.book.requests.index') }}" class="btn btn-light border">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Requests
            </a>
        </div>
    </div>

    <div class="dashboard-panel">
        <form action="{{ route('admin.book.requests.update', $bookRequest['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $bookRequest['title']) }}" placeholder="Enter request title">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Category</label>
                <select name="category" class="form-select @error('category') is-invalid @enderror">
                    <option value="general" @selected(old('category', $bookRequest['category'] ?? 'general') === 'general')>General</option>
                    <option value="self_development" @selected(old('category', $bookRequest['category'] ?? '') === 'self_development')>Self Development</option>
                    <option value="programming" @selected(old('category', $bookRequest['category'] ?? '') === 'programming')>Programming</option>
                    <option value="business" @selected(old('category', $bookRequest['category'] ?? '') === 'business')>Business</option>
                    <option value="fiction" @selected(old('category', $bookRequest['category'] ?? '') === 'fiction')>Fiction</option>
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Requester</label>
                <input type="text" name="requester" class="form-control @error('requester') is-invalid @enderror" value="{{ old('requester', $bookRequest['requester'] ?? '') }}" placeholder="Enter requester name">
                @error('requester')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Budget</label>
                <input type="number" step="0.01" name="budget" class="form-control @error('budget') is-invalid @enderror" value="{{ old('budget', $bookRequest['budget'] ?? '') }}" placeholder="0.00">
                @error('budget')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Note</label>
                <textarea name="note" rows="4" class="form-control @error('note') is-invalid @enderror" placeholder="Write request details...">{{ old('note', $bookRequest['note'] ?? '') }}</textarea>
                @error('note')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="pending" @selected(old('status', $bookRequest['status']) === 'pending')>Pending</option>
                    <option value="approved" @selected(old('status', $bookRequest['status']) === 'approved')>Approved</option>
                    <option value="rejected" @selected(old('status', $bookRequest['status']) === 'rejected')>Rejected</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>
                    Update Request
                </button>
                <a href="{{ route('admin.book.requests.index') }}" class="btn btn-light border">Cancel</a>
            </div>
        </form>
    </div>

</div>
@endsection
