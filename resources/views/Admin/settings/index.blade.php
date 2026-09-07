@extends('layout.admin.master')

@section('title', 'Settings')

@section('content')
<div class="dashboard-section">

	<div class="dashboard-panel mb-4">
		<div class="panel-header mb-0">
			<div>
				<h5 class="mb-1">Profile Settings</h5>
				<p class="text-muted mb-0 small">Personalize your admin interface theme</p>
			</div>
		</div>
	</div>

	@if(session('success'))
		<div class="alert alert-success">{{ session('success') }}</div>
	@endif

	<div class="dashboard-panel">
		<div class="panel-header">
			<h5>Theme Mode</h5>
		</div>

		<p class="text-muted mb-3">Choose your preferred mode. Your choice is saved on this browser.</p>

		<div class="row g-3">
			<div class="col-12 col-md-6">
				<button type="button" class="btn btn-light border w-100 text-start p-3 theme-select-btn" data-theme-target="light">
					<div class="d-flex align-items-center justify-content-between">
						<div>
							<strong class="d-block">Light Mode</strong>
							<small class="text-muted">Classic bright interface</small>
						</div>
						<i class="bi bi-sun fs-5"></i>
					</div>
				</button>
			</div>

			<div class="col-12 col-md-6">
				<button type="button" class="btn btn-light border w-100 text-start p-3 theme-select-btn" data-theme-target="dark">
					<div class="d-flex align-items-center justify-content-between">
						<div>
							<strong class="d-block">Dark Mode</strong>
							<small class="text-muted">Low-light interface</small>
						</div>
						<i class="bi bi-moon-stars fs-5"></i>
					</div>
				</button>
			</div>
		</div>
	</div>

</div>
@endsection
