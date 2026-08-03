@extends('layout.admin.master')

@section('title', isset($selectedCondition) ? 'Edit Condition' : 'Add Condition')

@section('content')
<div class="dashboard-section">
    <div class="dashboard-panel mb-4">
        <div class="panel-header mb-0">
            <div>
                <h5 class="mb-1">{{ isset($selectedCondition) ? 'Edit Condition' : 'Add Condition' }}</h5>
                <p class="text-muted mb-0 small">
                    {{ isset($selectedCondition) ? 'Update the condition details below.' : 'Create a new condition for books.' }}
                </p>
            </div>
            <a href="{{ route('admin.book.conditions.index') }}" class="btn btn-light border">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Conditions
            </a>
        </div>
    </div>

    <div class="dashboard-panel">
        <form action="{{ isset($selectedCondition) ? route('admin.book.conditions.update', ['condition' => $selectedCondition['id']]) : route('admin.book.conditions.store') }}" method="POST">
            @csrf
            @if(isset($selectedCondition))
                @method('PUT')
            @endif

            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Condition Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $selectedCondition['name'] ?? '') }}" placeholder="Enter condition name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" rows="4" class="form-control" placeholder="Describe this condition...">{{ old('description', $selectedCondition['description'] ?? '') }}</textarea>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ old('status', $selectedCondition['status'] ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $selectedCondition['status'] ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ isset($selectedCondition) ? 'Update Condition' : 'Save Condition' }}
                        </button>
                        <a href="{{ route('admin.book.conditions.index') }}" class="btn btn-light border">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
