@extends('layout.admin.master')

@section('title', 'Publishers')

@section('content')

<div class="dashboard-section">

	<div class="dashboard-panel mb-4">

		<div class="panel-header mb-0">

			<div>
				<h5 class="mb-1">Publishers</h5>
				<p class="text-muted mb-0 small">
					Manage all publishers listed on SecondBook
				</p>
			</div>

			<a href="{{ route('admin.publishers.create') }}" class="btn btn-primary">
				<i class="bi bi-plus-circle me-2"></i>
				Add Publisher
			</a>

		</div>

	</div>

	<div class="dashboard-panel mb-4">

		<form method="GET" action="{{ route('admin.publishers.index') }}" class="row g-3 align-items-end">

			<div class="col-12 col-md-8 col-lg-8">
				<label class="form-label small text-muted fw-semibold">Search</label>
				<div class="input-group">
					<span class="input-group-text bg-white border-end-0">
						<i class="bi bi-search text-muted"></i>
					</span>
					<input
						type="text"
						name="search"
						value="{{ request('search') }}"
						class="form-control border-start-0"
						placeholder="Publisher name...">
					<button type="submit" class="btn btn-primary">
						Search
					</button>
				</div>
			</div>

			<div class="col-12 col-md-4 col-lg-4 d-flex gap-2">
				<button type="submit" class="btn btn-primary flex-grow-1 flex-lg-grow-0 px-4">
					<i class="bi bi-funnel me-1"></i>
					Filter
				</button>
				<a href="{{ route('admin.publishers.index') }}" class="btn btn-light border">
					Reset
				</a>
			</div>

		</form>

	</div>

	@if(session('success'))
		<div class="alert alert-success mb-4">
			{{ session('success') }}
		</div>
	@endif

	@if(session('error'))
		<div class="alert alert-danger mb-4">
			{{ session('error') }}
		</div>
	@endif

	<div class="dashboard-panel">

		<div class="panel-header">
			<h5>Publisher List</h5>
			<span class="badge bg-primary">{{ $publishers->total() }} publishers</span>
		</div>

		<div class="table-responsive">

			<table class="table table-hover align-middle">

				<thead>
					<tr>
						<th>ID</th>
						<th>Logo</th>
						<th>Name</th>
						<th class="d-none d-lg-table-cell">Country</th>
						<th class="d-none d-xl-table-cell">Website</th>
						<th class="d-none d-xxl-table-cell">Description</th>
						<th>Status</th>
						<th class="d-none d-lg-table-cell">Created At</th>
						<th class="d-none d-lg-table-cell">Updated At</th>
						<th class="text-end">Action</th>
					</tr>
				</thead>

				<tbody>

					@forelse($publishers as $publisher)
						<tr>

							<td>{{ $publisher->id }}</td>

							<td>
								@if(!empty($publisher->logo))
									<img
										src="{{ asset('storage/' . $publisher->logo) }}"
										alt="{{ $publisher->name }}"
										class="publisher-logo-thumb rounded border">
								@else
									<div class="book-cover-thumb">
										<i class="bi bi-building"></i>
									</div>
								@endif
							</td>

							<td>
								<strong class="d-block">{{ $publisher->name }}</strong>
								<small class="text-muted d-lg-none">{{ $publisher->country ?: '-' }}</small>
							</td>

							<td class="d-none d-lg-table-cell">{{ $publisher->country ?: '-' }}</td>
							<td class="d-none d-xl-table-cell">
								@if(!empty($publisher->website))
									<a href="{{ $publisher->website }}" target="_blank" rel="noopener" class="text-decoration-none">
										{{ $publisher->website }}
									</a>
								@else
									-
								@endif
							</td>
							<td class="d-none d-xxl-table-cell">{{ \Illuminate\Support\Str::limit($publisher->description, 80) ?: '-' }}</td>

							<td>
								@if($publisher->status ?? false)
									<span class="badge bg-success">Active</span>
								@else
									<span class="badge bg-secondary">Inactive</span>
								@endif
							</td>

							<td class="d-none d-lg-table-cell">{{ $publisher->created_at?->format('d M Y H:i') }}</td>
							<td class="d-none d-lg-table-cell">{{ $publisher->updated_at?->format('d M Y H:i') }}</td>

							<td>
								<div class="d-flex justify-content-end gap-2">
									<a href="{{ route('admin.publishers.show', $publisher->id) }}" class="btn btn-light btn-sm border" title="View">
										<i class="bi bi-eye"></i>
									</a>

									<form action="{{ route('admin.publishers.status', $publisher->id) }}" method="POST">
										@csrf
										@method('PATCH')
										<button
											type="submit"
											class="btn btn-sm {{ ($publisher->status ?? false) ? 'btn-warning text-dark' : 'btn-success' }}"
											title="{{ ($publisher->status ?? false) ? 'Deactivate' : 'Activate' }}">
											<i class="bi {{ ($publisher->status ?? false) ? 'bi-pause-circle' : 'bi-check-circle' }}"></i>
										</button>
									</form>

									<a href="{{ route('admin.publishers.edit', $publisher->id) }}" class="btn btn-warning btn-sm" title="Edit">
										<i class="bi bi-pencil"></i>
									</a>

									<form action="{{ route('admin.publishers.destroy', $publisher->id) }}" method="POST" onsubmit="return confirm('Delete this publisher?')">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger btn-sm" title="Delete">
											<i class="bi bi-trash"></i>
										</button>
									</form>
								</div>
							</td>

						</tr>
					@empty
						<tr>
							<td colspan="10" class="text-center py-5">
								<div class="chart-placeholder" style="height:auto;padding:30px 0;">
									<i class="bi bi-building"></i>
									<h6>No publishers found</h6>
									<p>Add your first publisher to get started.</p>
									<a href="{{ route('admin.publishers.create') }}" class="btn btn-primary mt-3">
										<i class="bi bi-plus-circle me-2"></i>
										Add Publisher
									</a>
								</div>
							</td>
						</tr>
					@endforelse

				</tbody>

			</table>

		</div>

		@if($publishers->hasPages())
			<div class="pt-3">
				{{ $publishers->links() }}
			</div>
		@endif

	</div>

</div>

@endsection

@push('css')
<style>
	.book-cover-thumb{
		width:44px;
		height:56px;
		flex-shrink:0;
		display:flex;
		align-items:center;
		justify-content:center;
		border-radius:10px;
		background:linear-gradient(135deg,#eff6ff,#e0e7ff);
		color:#2563eb;
		font-size:18px;
	}

	.input-group-text{
		border-radius:14px 0 0 14px;
	}

	.input-group .form-control{
		border-radius:0;
		padding:12px 14px;
	}

	.input-group .btn{
		border-radius:0 14px 14px 0;
	}

	.dashboard-panel .btn-sm{
		width:36px;
		height:36px;
		padding:0;
		display:inline-flex;
		align-items:center;
		justify-content:center;
		border-radius:10px;
	}

	.publisher-logo-thumb{
		width:44px;
		height:56px;
		object-fit:cover;
		display:block;
	}
</style>
@endpush
