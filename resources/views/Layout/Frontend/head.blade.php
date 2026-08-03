<!DOCTYPE html>
<html lang="en">

<head>
	<title>@yield('title', 'BookSaw - Home | SecondBook')</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="icon" type="image/png" href="{{ asset('admin/images/logo.png') }}">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/normalize.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/icomoon/icomoon.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/vendor.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/style.css') }}">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<style>
		.profile-dropdown {
			position: relative;
		}

		.profile-dropdown .dropdown-toggle {
			display: inline-flex;
			align-items: center;
			gap: 6px;
		}

		.profile-dropdown .dropdown-toggle::after {
			display: none;
		}

		.profile-dropdown .dropdown-menu {
			margin-top: 0.7rem;
			width: 290px;
			border: 1px solid #eee;
			border-radius: 14px;
			box-shadow: 0 14px 36px rgba(0, 0, 0, 0.12);
			padding: 10px;
			background: #fff;
			overflow: hidden;
			opacity: 0;
			transform: translateY(7px);
			transition: opacity 0.25s ease, transform 0.25s ease;
		}

		.profile-dropdown .dropdown-menu.show {
			opacity: 1;
			transform: translateY(0);
		}

		.profile-dropdown .dropdown-menu .dropdown-header {
			background: linear-gradient(135deg, #f8efe8 0%, #f4e4d2 100%);
			border-radius: 12px;
			padding: 10px 12px;
			margin-bottom: 8px;
		}

		.profile-dropdown .avatar-wrap {
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background: linear-gradient(135deg, #8B5E3C 0%, #C89A6B 100%);
			color: #fff;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-weight: 700;
			font-size: 0.95rem;
			box-shadow: 0 7px 16px rgba(139, 94, 60, 0.2);
		}

		.profile-dropdown .user-name {
			font-weight: 700;
			color: #2f241d;
			font-size: 0.95rem;
		}

		.profile-dropdown .user-meta {
			font-size: 0.78rem;
			color: #8d7866;
		}

		.profile-dropdown .dropdown-item {
			padding: 0.7rem 0.8rem;
			color: #3f332c;
			font-size: 0.92rem;
			border-radius: 10px;
			display: flex;
			align-items: center;
			gap: 9px;
			margin: 1px 0;
			height: 42px;
			transition: transform 0.25s ease, background-color 0.25s ease, color 0.25s ease;
		}

		.profile-dropdown .dropdown-item:hover,
		.profile-dropdown .dropdown-item:focus {
			background-color: #F7F2ED;
			color: #8B5E3C;
			transform: translateY(-1px);
		}

		.profile-dropdown .dropdown-item i {
			transition: transform 0.25s ease;
		}

		.profile-dropdown .dropdown-item:hover i,
		.profile-dropdown .dropdown-item:focus i {
			transform: translateX(2px) scale(1.05);
		}

		.profile-dropdown .dropdown-divider {
			margin: 6px 0;
			border-color: #f0e7de;
		}

		.profile-dropdown .logout-wrap {
			padding-top: 4px;
		}

		.profile-dropdown .logout-btn {
			width: 100%;
			border: 0;
			background: #FFF6F6;
			color: #DC3545;
			border-radius: 10px;
			padding: 0.7rem 0.9rem;
			font-weight: 600;
			height: 44px;
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
			transition: all 0.25s ease;
		}

		.profile-dropdown .logout-btn:hover {
			background: #DC3545;
			color: #fff;
			transform: scale(1.01);
		}

		.profile-dropdown .chevron-icon {
			transition: transform 0.25s ease;
			font-size: 0.82rem;
		}

		.profile-dropdown.show .chevron-icon {
			transform: rotate(180deg);
		}

		/* SweetAlert */
		.swal2-popup{
			width: 420px !important;
			border-radius: 16px !important;
			padding: 1.5rem !important;
		}

		.swal2-title{
			font-size: 1.6rem !important;
			font-weight: 700 !important;
		}

		.swal2-html-container{
			font-size: 1rem !important;
			line-height: 1.5 !important;
		}

		.logout-confirm-btn,
		.logout-cancel-btn{
			min-width: 140px !important;
			height: 44px !important;
			font-size: 16px !important;
			border-radius: 10px !important;
		}

		.swal2-icon{
			transform: scale(.85);
		}

		.swal2-actions{
			margin-top: 1.2rem !important;
			gap: 10px !important;
		}
		.logout-confirm-btn,
		.logout-cancel-btn{
			min-width: 170px !important;
			height: 52px !important;
			border: none !important;
			border-radius: 12px !important;
			font-size: 18px !important;
			font-weight: 600 !important;
			transition: .25s ease !important;
		}

		.logout-confirm-btn{
			background:#8b5e3c !important;
			color:#fff !important;
		}

		.logout-confirm-btn:hover{
			background:#744b2f !important;
			transform:translateY(-2px);
		}

		.logout-cancel-btn{
			background:#6c757d !important;
			color:#fff !important;
		}

		.logout-cancel-btn:hover{
			background:#5c636a !important;
			transform:translateY(-2px);
		}

        /* Dark Mode */

        :root[data-theme="dark"] .swal2-popup {
            background:#111827 !important;
        }

        :root[data-theme="dark"] .swal2-title {
            color:#ffffff !important;
        }

        :root[data-theme="dark"] .swal2-html-container {
            color:#cbd5e1 !important;
        }

		@media (max-width: 991px) {
			.profile-dropdown .dropdown-menu {
				right: 0;
				left: auto;
			}
		}
	</style>

	@stack('css')

</head>
