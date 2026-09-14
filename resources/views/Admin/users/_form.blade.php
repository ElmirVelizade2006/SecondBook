@php
    $user = $user ?? new \App\Models\User();
    $isEdit = isset($user) && $user->exists;
@endphp

<div class="row g-4">
    <div class="col-12 col-lg-8">
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold" for="first_name">First name <span class="text-danger">*</span></label>
                <input id="first_name" type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $user->first_name ?? '') }}" required>
                @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold" for="last_name">Last name <span class="text-danger">*</span></label>
                <input id="last_name" type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $user->last_name ?? '') }}" required>
                @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold" for="username">Username <span class="text-danger">*</span></label>
                <input id="username" type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username ?? '') }}" required>
                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold" for="email">Email <span class="text-danger">*</span></label>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email ?? '') }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold" for="phone">Phone</label>
                <input id="phone" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone ?? '') }}">
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold" for="profile_photo">Avatar</label>
                <input id="profile_photo" type="file" name="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                @error('profile_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold" for="password">{{ $isEdit ? 'New password' : 'Password' }} @if(!$isEdit)<span class="text-danger">*</span>@endif</label>
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" {{ $isEdit ? '' : 'required' }} autocomplete="new-password">
                @if($isEdit)<small class="form-text text-muted">Leave blank to keep the current password.</small>@endif
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold" for="password_confirmation">Confirm password @if(!$isEdit)<span class="text-danger">*</span>@endif</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" {{ $isEdit ? '' : 'required' }} autocomplete="new-password">
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="user-form-side-panel">
            <div class="user-form-avatar-preview">
                @if($isEdit && $user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->full_name }}">
                @else
                    <i class="bi bi-person"></i>
                @endif
            </div>
            <span class="eyebrow">Account access</span>
            <label class="form-label fw-semibold" for="role">Role</label>
            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" @disabled($isEdit && auth()->id() === $user->id)>
                @foreach($roles as $roleOption)
                    @if($roleOption->name !== 'super-admin' || auth()->user()->hasRole('super-admin'))
                        <option value="{{ $roleOption->name }}" @selected(old('role', $user->roles->first()?->name ?? $user->role ?? 'user') === $roleOption->name)>{{ $roleOption->display_name }}</option>
                    @endif
                @endforeach
            </select>
            @if($isEdit && auth()->id() === $user->id)
                <input type="hidden" name="role" value="{{ $user->role }}">
                <small class="form-text text-muted">Your own role cannot be changed here.</small>
            @endif
            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror

            <label class="form-label fw-semibold mt-3" for="status">Status</label>
            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" @disabled($isEdit && auth()->id() === $user->id)>
                @foreach(['active' => 'Active', 'inactive' => 'Inactive', 'banned' => 'Banned'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $user->status ?? 'active') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @if($isEdit && auth()->id() === $user->id)
                <input type="hidden" name="status" value="{{ $user->status }}">
                <small class="form-text text-muted">Your own status cannot be changed here.</small>
            @endif
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-2"></i>{{ $isEdit ? 'Save changes' : 'Create user' }}</button>
    <a href="{{ $isEdit ? route('admin.users.show', $user) : route('admin.users.index') }}" class="btn btn-light border">Cancel</a>
</div>
