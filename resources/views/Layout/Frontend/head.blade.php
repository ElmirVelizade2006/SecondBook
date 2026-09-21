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

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('admin/images/logo.png') }}"
    >

    {{-- =========================================================
       BOOTSTRAP
    ========================================================= --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
        crossorigin="anonymous"
    >

    {{-- =========================================================
       BOOTSTRAP ICONS
    ========================================================= --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

    {{-- =========================================================
       FRONTEND CSS
    ========================================================= --}}
    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('frontend/css/normalize.css') }}"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('frontend/icomoon/icomoon.css') }}"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('frontend/css/vendor.css') }}"
    >

    <link
        rel="stylesheet"
        type="text/css"
        href="{{ asset('frontend/style.css') }}"
    >

    {{-- =========================================================
       SWEETALERT2
    ========================================================= --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"
    >

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>

        /* =========================================================
           PROFILE DROPDOWN
        ========================================================= */

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
            width: 290px;
            margin-top: 0.7rem;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 14px 36px rgba(0, 0, 0, 0.12);
            overflow: hidden;
            opacity: 0;
            transform: translateY(7px);
            transition:
                opacity 0.25s ease,
                transform 0.25s ease;
        }

        .profile-dropdown .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
        }


        /* =========================================================
           PROFILE DROPDOWN HEADER
        ========================================================= */

        .profile-dropdown .dropdown-menu .dropdown-header {
            margin-bottom: 8px;
            padding: 10px 12px;
            border-radius: 12px;
            background: linear-gradient(
                135deg,
                #f8efe8 0%,
                #f4e4d2 100%
            );
        }


        /* =========================================================
           AVATAR
        ========================================================= */

        .profile-dropdown .avatar-wrap {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(
                135deg,
                #8b5e3c 0%,
                #c89a6b 100%
            );
            color: #fff;
            font-size: 0.95rem;
            font-weight: 700;
            box-shadow: 0 7px 16px rgba(139, 94, 60, 0.2);
        }


        /* =========================================================
           USER INFO
        ========================================================= */

        .profile-dropdown .user-name {
            color: #2f241d;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .profile-dropdown .user-meta {
            color: #8d7866;
            font-size: 0.78rem;
        }


        /* =========================================================
           DROPDOWN ITEMS
        ========================================================= */

        .profile-dropdown .dropdown-item {
            height: 42px;
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 1px 0;
            padding: 0.7rem 0.8rem;
            border-radius: 10px;
            color: #3f332c;
            font-size: 0.92rem;
            transition:
                transform 0.25s ease,
                background-color 0.25s ease,
                color 0.25s ease;
        }

        .profile-dropdown .dropdown-item:hover,
        .profile-dropdown .dropdown-item:focus {
            background-color: #f7f2ed;
            color: #8b5e3c;
            transform: translateY(-1px);
        }

        .profile-dropdown .dropdown-item i {
            transition: transform 0.25s ease;
        }

        .profile-dropdown .dropdown-item:hover i,
        .profile-dropdown .dropdown-item:focus i {
            transform: translateX(2px) scale(1.05);
        }


        /* =========================================================
           DIVIDER
        ========================================================= */

        .profile-dropdown .dropdown-divider {
            margin: 6px 0;
            border-color: #f0e7de;
        }


        /* =========================================================
           LOGOUT BUTTON
        ========================================================= */

        .profile-dropdown .logout-wrap {
            padding-top: 4px;
        }

        .profile-dropdown .logout-btn {
            width: 100%;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.7rem 0.9rem;
            border: 0;
            border-radius: 10px;
            background: #fff6f6;
            color: #dc3545;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .profile-dropdown .logout-btn:hover {
            background: #dc3545;
            color: #fff;
            transform: scale(1.01);
        }


        /* =========================================================
           CHEVRON
        ========================================================= */

        .profile-dropdown .chevron-icon {
            font-size: 0.82rem;
            transition: transform 0.25s ease;
        }

        .profile-dropdown.show .chevron-icon {
            transform: rotate(180deg);
        }


        /* =========================================================
           NOTIFICATION DROPDOWN
        ========================================================= */

        .notification-dropdown {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .notification-trigger {
            position: relative;
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #4a3a2f;
            text-decoration: none;
            border-radius: 50%;
            transition:
                color 0.25s ease,
                background-color 0.25s ease,
                transform 0.25s ease;
        }

        .notification-trigger:hover {
            color: #8b5e3c;
            background: #f7f2ed;
            transform: translateY(-1px);
        }

        .notification-trigger::after {
            display: none;
        }

        .notification-trigger i {
            font-size: 18px;
            line-height: 1;
        }


        /* =========================================================
           NOTIFICATION BADGE
        ========================================================= */

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -3px;
            min-width: 17px;
            height: 17px;
            padding: 0 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: #8b5e3c;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            line-height: 1;
            border: 2px solid #fff;
            z-index: 2;
        }


        /* =========================================================
           NOTIFICATION MENU
        ========================================================= */

        .notification-menu {
            width: 370px;
            margin-top: 10px !important;
            padding: 0;
            border: 1px solid #eee4dc;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 18px 45px rgba(53, 39, 29, 0.14);
            overflow: hidden;
        }


        /* =========================================================
           NOTIFICATION HEADER
        ========================================================= */

        .notification-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 16px 17px;
            border-bottom: 1px solid #eee7e1;
        }

        .notification-header h6 {
            margin: 0;
            color: #302923;
            font-size: 14px;
            font-weight: 700;
        }

        .notification-header span {
            display: block;
            margin-top: 3px;
            color: #97887d;
            font-size: 10px;
        }

        .mark-all-btn {
            border: 0;
            padding: 0;
            background: transparent;
            color: #8b5e3c;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .mark-all-btn:hover {
            color: #68442c;
        }


        /* =========================================================
           NOTIFICATION LIST
        ========================================================= */

        .notification-list {
            max-height: 360px;
            overflow-y: auto;
        }

        .notification-list::-webkit-scrollbar {
            width: 5px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .notification-list::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: #d8c9bc;
        }


        /* =========================================================
           NOTIFICATION ITEM
        ========================================================= */

        .notification-item-form {
            margin: 0;
        }

        .notification-item {
            position: relative;
            width: 100%;
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 14px 16px;
            border: 0;
            border-bottom: 1px solid #f1ebe6;
            background: #fff;
            text-align: left;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .notification-item:hover {
            background: #faf6f2;
        }

        .notification-item.unread {
            background: #fcf8f4;
        }


        /* =========================================================
           NOTIFICATION ICON
        ========================================================= */

        .notification-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #f3e7dc;
            color: #8b5e3c;
        }

        .notification-icon i {
            font-size: 15px;
        }


        /* =========================================================
           NOTIFICATION CONTENT
        ========================================================= */

        .notification-content {
            min-width: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .notification-content strong {
            margin-bottom: 3px;
            color: #302923;
            font-size: 11px;
            font-weight: 700;
        }

        .notification-content span {
            color: #76685e;
            font-size: 10px;
            line-height: 1.5;
        }

        .notification-content small {
            margin-top: 5px;
            color: #aa9c92;
            font-size: 9px;
        }


        /* =========================================================
           UNREAD DOT
        ========================================================= */

        .notification-dot {
            width: 7px;
            height: 7px;
            flex: 0 0 7px;
            margin-top: 6px;
            border-radius: 50%;
            background: #8b5e3c;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .notification-empty {
            min-height: 180px;
            padding: 25px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .notification-empty i {
            margin-bottom: 10px;
            color: #bda996;
            font-size: 27px;
        }

        .notification-empty strong {
            color: #4a3a2f;
            font-size: 12px;
        }

        .notification-empty span {
            margin-top: 4px;
            color: #97887d;
            font-size: 10px;
        }


        /* =========================================================
           NOTIFICATION FOOTER
        ========================================================= */

        .notification-footer {
            padding: 12px 16px;
            border-top: 1px solid #eee7e1;
            text-align: center;
        }

        .notification-footer a {
            color: #8b5e3c;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .notification-footer a:hover {
            color: #68442c;
        }

        .notification-footer i {
            margin-left: 3px;
        }


        /* =========================================================
           SWEETALERT - LOGOUT MODAL
        ========================================================= */

        .swal2-popup {
            width: 390px !important;
            padding: 28px !important;
            border-radius: 18px !important;
            font-family: "Plus Jakarta Sans", sans-serif !important;
            box-shadow: 0 20px 60px rgba(53, 39, 29, 0.18) !important;
        }

        .swal2-title {
            margin: 5px 0 8px !important;
            color: #302923 !important;
            font-size: 21px !important;
            font-weight: 700 !important;
        }

        .swal2-html-container {
            margin: 0 !important;
            color: #8c8178 !important;
            font-size: 12px !important;
            line-height: 1.7 !important;
        }


        /* =========================================================
           SWEETALERT ICON
        ========================================================= */

        .swal2-icon {
            width: 52px !important;
            height: 52px !important;
            margin: 5px auto 12px !important;
            transform: none !important;
            border-width: 3px !important;
        }

        .swal2-icon.swal2-warning {
            border-color: #d8b79c !important;
            color: #8b5e3c !important;
        }


        /* =========================================================
           SWEETALERT ACTIONS
        ========================================================= */

        .swal2-actions {
            display: flex !important;
            justify-content: center !important;
            gap: 10px !important;
            margin: 22px 0 0 !important;
        }


        /* =========================================================
           LOGOUT MODAL BUTTONS
        ========================================================= */

        .logout-confirm-btn,
        .logout-cancel-btn {
            min-width: 125px !important;
            height: 40px !important;
            padding: 0 18px !important;
            border: none !important;
            border-radius: 9px !important;
            font-family: "Plus Jakarta Sans", sans-serif !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            line-height: 1 !important;
            transition:
                background 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease !important;
        }


        /* =========================================================
           LOGOUT CONFIRM BUTTON
        ========================================================= */

        .logout-confirm-btn {
            background: #8b5e3c !important;
            color: #fff !important;
        }

        .logout-confirm-btn:hover {
            background: #744b2f !important;
            color: #fff !important;
            transform: translateY(-1px);
        }


        /* =========================================================
           CANCEL BUTTON
        ========================================================= */

        .logout-cancel-btn {
            background: #f4eee9 !important;
            color: #72543d !important;
        }

        .logout-cancel-btn:hover {
            background: #e9ddd3 !important;
            color: #72543d !important;
            transform: translateY(-1px);
        }


        /* =========================================================
           BUTTON FOCUS
        ========================================================= */

        .logout-confirm-btn:focus,
        .logout-confirm-btn:active,
        .logout-cancel-btn:focus,
        .logout-cancel-btn:active {
            outline: none !important;
            box-shadow: none !important;
        }


        /* =========================================================
           DARK MODE
        ========================================================= */

        :root[data-theme="dark"] .notification-trigger {
            color: #e5d9ce;
        }

        :root[data-theme="dark"] .notification-trigger:hover {
            color: #c89a6b;
            background: #211b18;
        }

        :root[data-theme="dark"] .notification-badge {
            border-color: #111827;
        }

        :root[data-theme="dark"] .notification-menu {
            background: #111827;
            border-color: #334155;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.35);
        }

        :root[data-theme="dark"] .notification-header {
            border-color: #334155;
        }

        :root[data-theme="dark"] .notification-header h6 {
            color: #f8fafc;
        }

        :root[data-theme="dark"] .notification-header span {
            color: #94a3b8;
        }

        :root[data-theme="dark"] .notification-item {
            background: #111827;
            border-color: #263244;
        }

        :root[data-theme="dark"] .notification-item:hover,
        :root[data-theme="dark"] .notification-item.unread {
            background: #172033;
        }

        :root[data-theme="dark"] .notification-icon {
            background: #2b211b;
            color: #c89a6b;
        }

        :root[data-theme="dark"] .notification-content strong {
            color: #f1f5f9;
        }

        :root[data-theme="dark"] .notification-content span {
            color: #cbd5e1;
        }

        :root[data-theme="dark"] .notification-content small {
            color: #94a3b8;
        }

        :root[data-theme="dark"] .notification-footer {
            border-color: #334155;
        }

        :root[data-theme="dark"] .notification-empty strong {
            color: #f1f5f9;
        }

        :root[data-theme="dark"] .notification-empty span {
            color: #94a3b8;
        }

        :root[data-theme="dark"] .notification-empty i {
            color: #64748b;
        }

        :root[data-theme="dark"] .notification-list::-webkit-scrollbar-thumb {
            background: #475569;
        }


        /* =========================================================
           PROFILE DARK MODE
        ========================================================= */

        :root[data-theme="dark"] .profile-dropdown .dropdown-menu {
            background: #111827;
            border-color: #334155;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.35);
        }

        :root[data-theme="dark"] .profile-dropdown .dropdown-menu .dropdown-header {
            background: linear-gradient(
                135deg,
                #211b18 0%,
                #2b211b 100%
            );
        }

        :root[data-theme="dark"] .profile-dropdown .user-name {
            color: #f8fafc;
        }

        :root[data-theme="dark"] .profile-dropdown .user-meta {
            color: #94a3b8;
        }

        :root[data-theme="dark"] .profile-dropdown .dropdown-item {
            color: #e2e8f0;
        }

        :root[data-theme="dark"] .profile-dropdown .dropdown-item:hover,
        :root[data-theme="dark"] .profile-dropdown .dropdown-item:focus {
            background-color: #172033;
            color: #c89a6b;
        }

        :root[data-theme="dark"] .profile-dropdown .dropdown-divider {
            border-color: #334155;
        }

        :root[data-theme="dark"] .profile-dropdown .logout-btn {
            background: #2a171b;
            color: #f87171;
        }

        :root[data-theme="dark"] .profile-dropdown .logout-btn:hover {
            background: #dc3545;
            color: #fff;
        }


        /* =========================================================
           SWEETALERT DARK MODE
        ========================================================= */

        :root[data-theme="dark"] .swal2-popup {
            background: #111827 !important;
        }

        :root[data-theme="dark"] .swal2-title {
            color: #ffffff !important;
        }

        :root[data-theme="dark"] .swal2-html-container {
            color: #cbd5e1 !important;
        }

        :root[data-theme="dark"] .swal2-icon.swal2-warning {
            border-color: #a87958 !important;
            color: #c89a6b !important;
        }


        /* =========================================================
           RESPONSIVE - TABLET
        ========================================================= */

        @media (max-width: 991px) {

            .profile-dropdown .dropdown-menu {
                right: 0;
                left: auto;
            }

            .notification-menu {
                right: 0 !important;
                left: auto !important;
            }

        }


        /* =========================================================
           RESPONSIVE - MOBILE
        ========================================================= */

        @media (max-width: 480px) {

            .notification-menu {
                position: fixed !important;
                top: 65px !important;
                right: 10px !important;
                left: 10px !important;
                width: auto !important;
                margin-top: 0 !important;
            }

            .notification-header {
                padding: 14px;
            }

            .notification-item {
                padding: 13px 14px;
            }

            .swal2-popup {
                width: calc(100% - 30px) !important;
                padding: 24px 20px !important;
                border-radius: 16px !important;
            }

            .swal2-title {
                font-size: 19px !important;
            }

            .swal2-html-container {
                font-size: 11px !important;
            }

            .swal2-actions {
                width: 100% !important;
                flex-direction: column-reverse !important;
                gap: 8px !important;
            }

            .logout-confirm-btn,
            .logout-cancel-btn {
                width: 100% !important;
                min-width: 0 !important;
                height: 40px !important;
            }

        }

    </style>


    @stack('css')

</head>