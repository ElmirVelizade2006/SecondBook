@php
    $seller = $seller ?? new \App\Models\User();
    $isEdit = $seller->exists;
@endphp

<div class="row g-4">
    <div class="col-12 col-lg-8">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-semibold" for="name">Full name <span class="text-danger">*</span></label>
                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $seller->name ?? '') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold" for="email">Email <span class="text-danger">*</span></label>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $seller->email ?? '') }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label fw-semibold" for="phone">Phone</label>
                <input id="phone" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $seller->phone ?? '') }}">
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
            <div class="col-12">
                <label class="form-label fw-semibold" for="profile_photo">Avatar</label>
                <input id="profile_photo" type="file" name="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                @error('profile_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="seller-form-side-panel">
            <div class="seller-form-avatar-preview">
                @if($isEdit && $seller->profile_photo)
                    <img src="{{ asset('storage/' . $seller->profile_photo) }}" alt="{{ $seller->name }}">
                @else
                    <i class="bi bi-shop"></i>
                @endif
            </div>
            <span class="eyebrow">Seller account</span>
            <p class="seller-form-note">The seller role is assigned automatically and cannot be changed from this form.</p>
            <label class="form-label fw-semibold" for="status">Status</label>
            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                @foreach(['active' => 'Active', 'inactive' => 'Inactive', 'banned' => 'Banned'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $seller->status ?? 'active') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-2"></i>{{ $isEdit ? 'Save changes' : 'Create seller' }}</button>
    <a href="{{ $isEdit ? route('admin.sellers.show', $seller) : route('admin.sellers.index') }}" class="btn btn-light border">Cancel</a>
</div>
