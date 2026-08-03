@extends('layout.admin.master')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard-section">

{{-- =========================================
    HERO SECTION
========================================= --}}

<div class="hero-section mb-4">

    <div class="hero-content">

        <span class="hero-badge">
            <i class="bi bi-stars"></i>
            SecondBook Admin
        </span>

        <h2>Welcome Back, Admin 👋</h2>

        <p>
            Manage your books, users and categories from one place.
        </p>

            <div class="hero-buttons">

                <a href="{{ route('admin.books.index') }}" class="btn btn-light">
                    <i class="bi bi-book me-2"></i>
                    View Books
                </a>

                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add Book
                </a>

            </div>

        </div>

        <div class="hero-icon">

            <i class="bi bi-book-half"></i>

        </div>

    </div>
</div>

{{-- =========================================
    STATISTICS CARDS
========================================= --}}

<div class="row g-4 mx-2 ">

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-card blue">

            <div class="d-flex justify-content-between align-items-center">

                <h6 class="mb-0">
                    Total Books
                </h6>

                <div class="card-icon blue">
                    <i class="bi bi-book"></i>
                </div>

            </div>

            <h2 class="mt-4 mb-1">{{ $totalBooks }}</h2>

            <p class="text-success mb-0">
                <i class="bi bi-arrow-up"></i>
                0% This Month
            </p>

            <div class="dashboard-card-footer">

                <a href="#">
                    View Details
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>

        </div>

    </div>

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-card">

            <div class="d-flex justify-content-between align-items-center">

                <h6 class="mb-0">
                    Total Users
                </h6>

                <div class="card-icon green">
                    <i class="bi bi-people"></i>
                </div>

            </div>

            <h2 class="mt-4 mb-1">{{ $totalUsers }}</h2>

            <p class="text-success mb-0">
                <i class="bi bi-arrow-up"></i>
                0% This Month
            </p>

            <div class="dashboard-card-footer">

                <a href="#">
                    View Details
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>

        </div>

    </div>

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-card">

            <div class="d-flex justify-content-between align-items-center">

                <h6 class="mb-0">
                    Categories
                </h6>

                <div class="card-icon orange">
                    <i class="bi bi-grid"></i>
                </div>

            </div>

            <h2 class="mt-4 mb-1">{{ $totalCategories }}</h2>

            <p class="text-success mb-0">
                <i class="bi bi-arrow-up"></i>
                0% This Month
            </p>

            <div class="dashboard-card-footer">

                <a href="#">
                    View Details
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>

        </div>

    </div>

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="dashboard-card">

            <div class="d-flex justify-content-between align-items-center">

                <h6 class="mb-0">
                    Authors
                </h6>

                <div class="card-icon red">
                    <i class="bi bi-pencil-square"></i>
                </div>

            </div>

            <h2 class="mt-4 mb-1">{{ $totalAuthors }}</h2>

            <p class="text-success mb-0">
                <i class="bi bi-arrow-up"></i>
                0% This Month
            </p>

            <div class="dashboard-card-footer">

                <a href="#">
                    View Details
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>

        </div>

    </div>
</div>

{{-- =========================================
    CHART & ACTIVITY
========================================= --}}

<div class="row g-4 mx-2 mt-2 mt-md-4">

    <!-- Left Side -->
    <div class="col-12 col-lg-8">

        <div class="dashboard-panel">

            <div class="panel-header">

                <h5>Monthly Overview</h5>

                <button class="btn btn-light btn-sm">
                    This Month
                </button>

            </div>

            <div class="chart-placeholder">

                <i class="bi bi-bar-chart-line"></i>

                <h6>Chart.js Coming Soon</h6>

                <p>
                    Monthly sales and books statistics will appear here.
                </p>

            </div>

        </div>

    </div>

    <!-- Right Side -->
    <div class="col-12 col-lg-4">

        <div class="dashboard-panel">

            <div class="panel-header">

                <h5>Recent Activity</h5>

            </div>

            <div class="activity-list">

                @if($recentBooks->isNotEmpty())
                    <div class="activity-item">

                        <div class="activity-icon bg-primary">
                            <i class="bi bi-book"></i>
                        </div>

                        <div>
                            <strong>New Book Added</strong>
                            <p>{{ $recentBooks->first()->title }}</p>
                        </div>

                    </div>
                @endif

                @if($recentUsers->isNotEmpty())
                    <div class="activity-item">

                        <div class="activity-icon bg-success">
                            <i class="bi bi-person"></i>
                        </div>

                        <div>
                            <strong>New User</strong>
                            <p>{{ $recentUsers->first()->name }} registered</p>
                        </div>

                    </div>
                @endif

                @if($recentCategories->isNotEmpty())
                    <div class="activity-item">

                        <div class="activity-icon bg-warning">
                            <i class="bi bi-grid"></i>
                        </div>

                        <div>
                            <strong>Category Created</strong>
                            <p>{{ $recentCategories->first()->name }}</p>
                        </div>

                    </div>
                @endif

            </div>

        </div>

    </div>

</div>

{{-- =========================================
    RECENT BOOKS
========================================= --}}

<div class="dashboard-panel mx-2 mt-2 mt-md-4">

    <div class="panel-header">

        <h5>Recent Books</h5>

        <a href="#" class="btn btn-primary btn-sm">

            View All

        </a>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>

                <tr>

                    <th>Book</th>
                    <th class="d-none d-md-table-cell">Category</th>
                    <th class="d-none d-lg-table-cell">Seller</th>
                    <th>Price</th>
                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>Atomic Habits</td>

                    <td class="d-none d-md-table-cell">Self Development</td>

                    <td class="d-none d-lg-table-cell">Elmir</td>

                    <td>$15</td>

                    <td>

                        <span class="badge bg-success">

                            Approved

                        </span>

                    </td>

                </tr>

                <tr>

                    <td>Clean Code</td>

                    <td class="d-none d-md-table-cell">Programming</td>

                    <td class="d-none d-lg-table-cell">Ali</td>

                    <td>$20</td>

                    <td>

                        <span class="badge bg-warning">

                            Pending

                        </span>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

{{-- =========================================
    TABLE & QUICK ACTIONS
========================================= --}}

<div class="row g-4 mx-2 mt-2 mt-md-4">

    <div class="col-12 col-lg-8">

        <div class="card shadow-sm h-100">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>
                            <th class="d-none d-sm-table-cell">#</th>
                            <th>Book</th>
                            <th class="d-none d-md-table-cell">Category</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td class="d-none d-sm-table-cell">1</td>
                            <td>Example Book</td>
                            <td class="d-none d-md-table-cell">Novel</td>
                            <td>$25</td>
                            <td>
                                <span class="badge bg-success">Approved</span>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="col-12 col-lg-4">

        <div class="card shadow-sm h-100">

            <div class="card-header bg-white fw-semibold">
                Quick Actions
            </div>

            <div class="card-body d-grid gap-3">

                <a href="#" class="btn btn-primary">
                    Add Book
                </a>

                <a href="#" class="btn btn-success">
                    Add Category
                </a>

                <a href="#" class="btn btn-warning">
                    Add Author
                </a>

                <a href="#" class="btn btn-dark">
                    View Users
                </a>

            </div>

        </div>

    </div>

</div>

</div>

@endsection