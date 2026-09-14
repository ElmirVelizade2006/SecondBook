@extends('layout.admin.master')

@section('title', 'Edit Shipping')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/shipping.css') }}">
@endpush

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Shipping
            </h2>

            <p class="text-muted mb-0">
                Update shipping method information.
            </p>

        </div>

        <a href="{{ route('admin.shipping.index') }}"
           class="btn btn-light">

            <i class="bi bi-arrow-left me-2"></i>
            Back

        </a>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form action="{{ route('admin.shipping.update', $shipping->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Shipping Method Name
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $shipping->name) }}">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Price
                        </label>

                        <input type="number"
                               name="price"
                               step="0.01"
                               min="0"
                               class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price', $shipping->price) }}">

                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Delivery Time
                        </label>

                        <input type="text"
                               name="delivery_time"
                               class="form-control @error('delivery_time') is-invalid @enderror"
                               value="{{ old('delivery_time', $shipping->delivery_time) }}">

                        @error('delivery_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="1"
                                {{ old('status', $shipping->status) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status', $shipping->status) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Description
                        </label>

                        <textarea name="description"
                                  rows="5"
                                  class="form-control">{{ old('description', $shipping->description) }}</textarea>

                    </div>


                    <div class="col-12">

                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('admin.shipping.index') }}"
                               class="btn btn-light">

                                Cancel

                            </a>

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-check-lg me-2"></i>
                                Update Shipping

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection