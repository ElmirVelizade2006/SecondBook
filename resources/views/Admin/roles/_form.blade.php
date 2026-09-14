@php
    $isEdit = isset($role) && $role->exists;
    $selected = $selectedPermissions ?? [];
@endphp

<div class="row g-4">
    <div class="col-12 col-lg-4">
        <label class="form-label fw-semibold" for="role_name">Role name <span class="text-danger">*</span></label>
        <input id="role_name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name ?? '') }}" placeholder="e.g. content-manager" {{ $isEdit ? 'readonly' : 'required' }}>
        @if($isEdit)<small class="form-text text-muted">The internal role key cannot be changed.</small>@endif
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 col-lg-4">
        <label class="form-label fw-semibold" for="display_name">Display name <span class="text-danger">*</span></label>
        <input id="display_name" type="text" name="display_name" class="form-control @error('display_name') is-invalid @enderror" value="{{ old('display_name', $role->display_name ?? '') }}" placeholder="Content Manager" required>
        @error('display_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12 col-lg-4">
        <label class="form-label fw-semibold" for="description">Description</label>
        <input id="description" type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $role->description ?? '') }}" placeholder="What can this role manage?">
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="permissions-toolbar mt-4">
    <div><span class="eyebrow">Access matrix</span><h5>Permissions</h5><p>Choose the actions this role can perform.</p></div>
    <button type="button" class="btn btn-light border" data-select-all-permissions><i class="bi bi-check2-square me-2"></i>Select all</button>
</div>

<div class="permissions-grid">
    @foreach($permissions as $group => $groupPermissions)
        <section class="permission-group" data-permission-group>
            <div class="permission-group-header">
                <div><h6>{{ $group }}</h6><span>{{ $groupPermissions->count() }} permissions</span></div>
                <button type="button" class="permission-group-toggle" data-select-group>All</button>
            </div>
            <div class="permission-list">
                @foreach($groupPermissions as $permission)
                    <label class="permission-option">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" data-permission-checkbox @checked(in_array($permission->id, old('permissions', $selected), false))>
                        <span class="permission-check"><i class="bi bi-check"></i></span>
                        <span><strong>{{ $permission->display_name }}</strong><small>{{ $permission->name }}</small></span>
                    </label>
                @endforeach
            </div>
        </section>
    @endforeach
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-2"></i>{{ $isEdit ? 'Save role' : 'Create role' }}</button>
    <a href="{{ $isEdit ? route('admin.roles.show', $role) : route('admin.roles.index') }}" class="btn btn-light border">Cancel</a>
</div>
