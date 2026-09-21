@extends('Layout.Frontend.master')

@section('title', 'Notifications | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/notifications.css') }}">
@endpush

@section('content')

<main class="sb-notifications-page">

    <div class="container">

        {{-- =========================
             PAGE HEADER
        ========================== --}}
        <section class="notifications-hero">

            <div class="notifications-hero-content">

                <span class="notifications-kicker">
                    <i class="bi bi-bell"></i>
                    Account updates
                </span>

                <h1>Notifications</h1>

                <p>
                    Keep track of your latest updates, book requests,
                    orders and account activity.
                </p>

            </div>

            @if($unreadCount > 0)

                <div class="notifications-summary">

                    <span class="summary-number">
                        {{ $unreadCount }}
                    </span>

                    <span class="summary-text">
                        unread
                        {{ $unreadCount === 1 ? 'notification' : 'notifications' }}
                    </span>

                </div>

            @else

                <div class="notifications-summary notifications-summary-clean">

                    <span class="summary-check">
                        <i class="bi bi-check2"></i>
                    </span>

                    <span class="summary-text">
                        All caught up
                    </span>

                </div>

            @endif

        </section>


        {{-- =========================
             TOOLBAR
        ========================== --}}
        <div class="notifications-toolbar">

            <div class="toolbar-left">

                <span class="toolbar-title">
                    Your notifications
                </span>

                <span class="toolbar-count">
                    {{ $notifications->total() }}
                </span>

            </div>

            @if($unreadCount > 0)

                <form
                    action="{{ route('frontend.notifications.read-all') }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="mark-all-btn"
                    >
                        <i class="bi bi-check2-all"></i>
                        <span>Mark all as read</span>
                    </button>

                </form>

            @endif

        </div>


        {{-- =========================
             NOTIFICATIONS
        ========================== --}}
        <section class="notifications-list">

            @forelse($notifications as $notification)

                <article
                    class="notification-card {{ is_null($notification->read_at) ? 'is-unread' : 'is-read' }}"
                >

                    {{-- Unread indicator --}}
                    @if(is_null($notification->read_at))
                        <span class="unread-indicator"></span>
                    @endif


                    {{-- Icon --}}
                    <div class="notification-icon-wrap">

                        <div class="notification-icon">

                            @if($notification->type === 'book_request')

                                <i class="bi bi-book"></i>

                            @elseif($notification->type === 'order')

                                <i class="bi bi-bag-check"></i>

                            @elseif($notification->type === 'payment')

                                <i class="bi bi-credit-card"></i>

                            @else

                                <i class="bi bi-bell"></i>

                            @endif

                        </div>

                    </div>


                    {{-- Content --}}
                    <div class="notification-main">

                        <div class="notification-top">

                            <div class="notification-title-area">

                                <h2>
                                    {{ $notification->title }}
                                </h2>

                                @if(is_null($notification->read_at))

                                    <span class="new-badge">
                                        New
                                    </span>

                                @endif

                            </div>

                            <time class="notification-date">
                                <i class="bi bi-clock"></i>
                                {{ $notification->created_at->diffForHumans() }}
                            </time>

                        </div>


                        <p class="notification-message">
                            {{ $notification->message }}
                        </p>


                        <div class="notification-bottom">

                            <span class="notification-type">
                                @if($notification->type === 'book_request')
                                    Book Request
                                @elseif($notification->type === 'order')
                                    Order
                                @elseif($notification->type === 'payment')
                                    Payment
                                @else
                                    General
                                @endif
                            </span>


                            @if(is_null($notification->read_at))

                                <form
                                    action="{{ route('frontend.notifications.read', $notification) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="mark-read-btn"
                                    >
                                        Mark as read
                                        <i class="bi bi-arrow-right"></i>
                                    </button>

                                </form>

                            @else

                                <span class="read-status">
                                    <i class="bi bi-check2"></i>
                                    Read
                                </span>

                            @endif

                        </div>

                    </div>

                </article>

            @empty

                {{-- =========================
                     EMPTY STATE
                ========================== --}}
                <div class="notifications-empty">

                    <div class="empty-icon">

                        <i class="bi bi-bell-slash"></i>

                    </div>

                    <span class="empty-kicker">
                        You're all caught up
                    </span>

                    <h2>
                        No notifications yet
                    </h2>

                    <p>
                        When something important happens on your account,
                        you'll see it here.
                    </p>

                    <a
                        href="{{ route('frontend.home') }}"
                        class="empty-action"
                    >
                        Continue browsing
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            @endforelse

        </section>


        {{-- =========================
             PAGINATION
        ========================== --}}
        @if($notifications->hasPages())

            <div class="notifications-pagination">
                {{ $notifications->links() }}
            </div>

        @endif

    </div>

</main>

@endsection