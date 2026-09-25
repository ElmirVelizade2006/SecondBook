@extends('layout.admin.master')

@section('title', 'Notifications')

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/css/notifications.css') }}">
@endpush

@section('content')

<div class="dashboard-section notifications-page">

    {{-- Page Header --}}
    <div class="notifications-page-header">

        <div class="notifications-heading">

            <div class="notifications-heading-icon">
                <i class="bi bi-bell"></i>
            </div>

            <div>
                <h1>Notifications</h1>
                <p>
                    Manage user notifications and keep your customers informed.
                </p>
            </div>

        </div>

        <div class="notifications-header-actions">

            <button
                type="button"
                class="btn notification-mark-all-btn"
                id="markAllReadBtn"
                {{ $unreadNotifications === 0 ? 'disabled' : '' }}
            >
                <i class="bi bi-check2-all"></i>
                Mark all as read
            </button>

            <button
                type="button"
                class="btn notification-send-btn"
                data-bs-toggle="modal"
                data-bs-target="#sendNotificationModal"
            >
                <i class="bi bi-send"></i>
                Send notification
            </button>

        </div>

    </div>


    {{-- Statistics --}}
    <div class="notification-stats-grid">

        <div class="notification-stat-card">

            <div class="notification-stat-icon total">
                <i class="bi bi-bell"></i>
            </div>

            <div class="notification-stat-content">
                <span>Total notifications</span>
                <strong>{{ number_format($totalNotifications) }}</strong>
                <small>All user notifications</small>
            </div>

        </div>


        <div class="notification-stat-card">

            <div class="notification-stat-icon unread">
                <i class="bi bi-envelope"></i>
            </div>

            <div class="notification-stat-content">
                <span>Unread</span>
                <strong>{{ number_format($unreadNotifications) }}</strong>
                <small>Waiting to be read</small>
            </div>

        </div>


        <div class="notification-stat-card">

            <div class="notification-stat-icon read">
                <i class="bi bi-envelope-open"></i>
            </div>

            <div class="notification-stat-content">
                <span>Read</span>
                <strong>{{ number_format($readNotifications) }}</strong>
                <small>Already viewed</small>
            </div>

        </div>


        <div class="notification-stat-card">

            <div class="notification-stat-icon users">
                <i class="bi bi-people"></i>
            </div>

            <div class="notification-stat-content">
                <span>Users notified</span>
                <strong>{{ number_format($usersNotified) }}</strong>
                <small>Unique active recipients</small>
            </div>

        </div>

    </div>


    {{-- Notifications Panel --}}
    <div class="dashboard-panel notifications-panel">

        {{-- Panel Header --}}
        <div class="notifications-panel-header">

            <div>
                <h2>Notification history</h2>

                <p>
                    View and manage notifications sent to users.
                </p>
            </div>


            <div class="notification-filter-tabs">

                <a
                    href="{{ route('admin.notifications.index', ['filter' => 'all']) }}"
                    class="notification-filter-tab {{ $filter === 'all' ? 'active' : '' }}"
                >
                    All
                    <span>{{ $totalNotifications }}</span>
                </a>

                <a
                    href="{{ route('admin.notifications.index', ['filter' => 'unread']) }}"
                    class="notification-filter-tab {{ $filter === 'unread' ? 'active' : '' }}"
                >
                    Unread
                    <span>{{ $unreadNotifications }}</span>
                </a>

                <a
                    href="{{ route('admin.notifications.index', ['filter' => 'read']) }}"
                    class="notification-filter-tab {{ $filter === 'read' ? 'active' : '' }}"
                >
                    Read
                    <span>{{ $readNotifications }}</span>
                </a>

            </div>

        </div>


        {{-- Notification List --}}
        <div class="notification-list">

            @forelse($notifications as $notification)

                <div
                    class="notification-item {{ is_null($notification->read_at) ? 'is-unread' : 'is-read' }}"
                    data-notification-id="{{ $notification->id }}"
                >

                    {{-- Notification Icon --}}
                    <div class="notification-item-icon">

                        @php
                            $icon = match($notification->type) {
                                'general' => 'bi-bell',
                                'promotion' => 'bi-megaphone',
                                'order' => 'bi-bag-check',
                                'payment' => 'bi-credit-card',
                                'review' => 'bi-star',
                                'seller' => 'bi-shop',
                                'system' => 'bi-gear',
                                'warning' => 'bi-exclamation-triangle',
                                'success' => 'bi-check-circle',
                                default => 'bi-bell',
                            };
                        @endphp

                        <i class="bi {{ $icon }}"></i>

                    </div>


                    {{-- Notification Content --}}
                    <div class="notification-item-content">

                        <div class="notification-item-top">

                            <div class="notification-item-title-wrap">

                                @if(is_null($notification->read_at))
                                    <span class="notification-unread-dot"></span>
                                @endif

                                <h3>
                                    {{ $notification->title }}
                                </h3>

                            </div>


                            <span
                                class="notification-type notification-type--{{ strtolower($notification->type) }}"
                            >
                                {{ ucfirst($notification->type) }}
                            </span>

                        </div>


                        <p class="notification-message">
                            {{ $notification->message }}
                        </p>


                        <div class="notification-meta">

                            <span>
                                <i class="bi bi-person"></i>

                                {{ $notification->user?->name ?? 'Deleted user' }}

                                @if($notification->user?->email)
                                    <span class="notification-user-email">
                                        {{ $notification->user->email }}
                                    </span>
                                @endif
                            </span>


                            <span>
                                <i class="bi bi-clock"></i>
                                {{ $notification->created_at->diffForHumans() }}
                            </span>


                            <span>
                                <i class="bi bi-calendar3"></i>
                                {{ $notification->created_at->format('d M Y, H:i') }}
                            </span>

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="notification-item-actions">

                        @if(is_null($notification->read_at))

                            <button
                                type="button"
                                class="notification-action-btn mark-read-btn"
                                data-id="{{ $notification->id }}"
                                title="Mark as read"
                            >
                                <i class="bi bi-envelope-open"></i>
                            </button>

                        @else

                            <button
                                type="button"
                                class="notification-action-btn mark-unread-btn"
                                data-id="{{ $notification->id }}"
                                title="Mark as unread"
                            >
                                <i class="bi bi-envelope"></i>
                            </button>

                        @endif


                        <button
                            type="button"
                            class="notification-action-btn delete-notification-btn"
                            data-id="{{ $notification->id }}"
                            data-url="{{ route('admin.notifications.destroy', $notification) }}"
                            title="Delete"
                        >
                            <i class="bi bi-trash3"></i>
                        </button>

                    </div>

                </div>

            @empty

                <div class="notifications-empty">

                    <div class="notifications-empty-icon">
                        <i class="bi bi-bell-slash"></i>
                    </div>

                    <h3>No notifications found</h3>

                    <p>
                        There are no notifications matching the selected filter.
                    </p>

                    @if($filter !== 'all')

                        <a
                            href="{{ route('admin.notifications.index') }}"
                            class="btn notification-empty-btn"
                        >
                            View all notifications
                        </a>

                    @endif

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($notifications->hasPages())

            <div class="notifications-pagination">
                {{ $notifications->links() }}
            </div>

        @endif

    </div>

</div>


{{-- Send Notification Modal --}}
<div
    class="modal fade"
    id="sendNotificationModal"
    tabindex="-1"
    aria-labelledby="sendNotificationModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content notification-modal">

            {{-- Modal Header --}}
            <div class="modal-header">

                <div class="notification-modal-title">

                    <div class="notification-modal-icon">
                        <i class="bi bi-send"></i>
                    </div>

                    <div>

                        <h5 id="sendNotificationModalLabel">
                            Send notification
                        </h5>

                        <p>
                            Send a message directly to your users.
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- Form --}}
            <form
                action="{{ route('admin.notifications.send') }}"
                method="POST"
                id="sendNotificationForm"
            >

                @csrf

                <div class="modal-body">

                    {{-- Recipient --}}
                    <div class="notification-recipient-selector">

                        <label class="notification-form-label">
                            Recipient
                        </label>


                        <div class="recipient-options">

                            <label class="recipient-option active">

                                <input
                                    type="radio"
                                    name="recipient"
                                    value="user"
                                    checked
                                >

                                <span class="recipient-option-icon">
                                    <i class="bi bi-person"></i>
                                </span>

                                <span>
                                    <strong>Specific user</strong>
                                    <small>Send to one active user</small>
                                </span>

                            </label>


                            <label class="recipient-option">

                                <input
                                    type="radio"
                                    name="recipient"
                                    value="all"
                                >

                                <span class="recipient-option-icon">
                                    <i class="bi bi-people"></i>
                                </span>

                                <span>
                                    <strong>All active users</strong>
                                    <small>Send to every active user</small>
                                </span>

                            </label>

                        </div>

                    </div>


                    {{-- User --}}
                    <div
                        class="notification-user-select-wrap"
                        id="notificationUserSelectWrap"
                    >

                        <label
                            for="notificationUser"
                            class="notification-form-label"
                        >
                            Select user
                        </label>

                        <select
                            name="user_id"
                            id="notificationUser"
                            class="form-select notification-form-control"
                            required
                        >

                            <option value="">
                                Select an active user
                            </option>

                            @foreach($users as $user)

                                <option value="{{ $user->id }}">
                                    {{ $user->name }} — {{ $user->email }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Type + Title --}}
                    <div class="notification-form-row">

                        <div class="notification-form-group">

                            <label
                                for="notificationType"
                                class="notification-form-label"
                            >
                                Type
                            </label>

                            <select
                                name="type"
                                id="notificationType"
                                class="form-select notification-form-control"
                                required
                            >

                                <option value="general">
                                    General
                                </option>

                                <option value="promotion">
                                    Promotion
                                </option>

                                <option value="order">
                                    Order
                                </option>

                                <option value="payment">
                                    Payment
                                </option>

                                <option value="review">
                                    Review
                                </option>

                                <option value="seller">
                                    Seller
                                </option>

                                <option value="system">
                                    System
                                </option>

                                <option value="success">
                                    Success
                                </option>

                                <option value="warning">
                                    Warning
                                </option>

                            </select>

                        </div>


                        <div class="notification-form-group">

                            <label
                                for="notificationTitle"
                                class="notification-form-label"
                            >
                                Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                id="notificationTitle"
                                class="form-control notification-form-control"
                                placeholder="Enter notification title"
                                maxlength="255"
                                required
                            >

                        </div>

                    </div>


                    {{-- Message --}}
                    <div class="notification-form-group">

                        <label
                            for="notificationMessage"
                            class="notification-form-label"
                        >
                            Message
                        </label>

                        <textarea
                            name="message"
                            id="notificationMessage"
                            class="form-control notification-form-control notification-message-input"
                            rows="5"
                            placeholder="Write your notification message..."
                            required
                        ></textarea>

                    </div>


                    {{-- Info --}}
                    <div class="notification-send-note">

                        <i class="bi bi-info-circle"></i>

                        <span>
                            Notifications will appear immediately in the
                            recipient's notification center.
                        </span>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn notification-modal-cancel"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn notification-modal-submit"
                        id="sendNotificationSubmit"
                    >
                        <i class="bi bi-send"></i>
                        Send notification
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection


@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');


    /*
    |--------------------------------------------------------------------------
    | SweetAlert Helpers
    |--------------------------------------------------------------------------
    */

    function showSuccess(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message,
            timer: 1600,
            showConfirmButton: false
        });
    }

    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Recipient Selector
    |--------------------------------------------------------------------------
    */

    const recipientOptions = document.querySelectorAll(
        '.recipient-option'
    );

    const userSelectWrap = document.getElementById(
        'notificationUserSelectWrap'
    );

    const notificationUser = document.getElementById(
        'notificationUser'
    );

    recipientOptions.forEach(function (option) {

        const radio = option.querySelector(
            'input[type="radio"]'
        );

        if (!radio) {
            return;
        }

        option.addEventListener('click', function () {

            radio.checked = true;

            recipientOptions.forEach(function (item) {
                item.classList.remove('active');
            });

            option.classList.add('active');

            /*
            |--------------------------------------------------------------------------
            | Specific User
            |--------------------------------------------------------------------------
            */

            if (radio.value === 'user') {

                userSelectWrap.style.display = '';

                notificationUser.required = true;
            }


            /*
            |--------------------------------------------------------------------------
            | All Active Users
            |--------------------------------------------------------------------------
            */

            if (radio.value === 'all') {

                userSelectWrap.style.display = 'none';

                notificationUser.required = false;

                notificationUser.value = '';
            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Mark As Read
    |--------------------------------------------------------------------------
    */

    function attachMarkRead(button) {

        if (!button) {
            return;
        }

        button.addEventListener('click', async function () {

            const id = this.dataset.id;

            const item = document.querySelector(
                '.notification-item[data-notification-id="' +
                id +
                '"]'
            );

            const url =
                "{{ url('/admin/notifications') }}/" +
                id +
                "/read";

            button.disabled = true;

            try {

                const response = await fetch(url, {
                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(
                        data.message ||
                        'Unable to mark notification as read.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Update Item
                |--------------------------------------------------------------------------
                */

                if (item) {

                    item.classList.remove('is-unread');
                    item.classList.add('is-read');


                    const unreadDot = item.querySelector(
                        '.notification-unread-dot'
                    );

                    if (unreadDot) {
                        unreadDot.remove();
                    }


                    const actions = item.querySelector(
                        '.notification-item-actions'
                    );

                    if (actions) {

                        const deleteButton =
                            actions.querySelector(
                                '.delete-notification-btn'
                            );

                        const deleteUrl =
                            deleteButton?.dataset.url || '';

                        actions.innerHTML = `
                            <button
                                type="button"
                                class="notification-action-btn mark-unread-btn"
                                data-id="${id}"
                                title="Mark as unread"
                            >
                                <i class="bi bi-envelope"></i>
                            </button>

                            <button
                                type="button"
                                class="notification-action-btn delete-notification-btn"
                                data-id="${id}"
                                data-url="${deleteUrl}"
                                title="Delete"
                            >
                                <i class="bi bi-trash3"></i>
                            </button>
                        `;

                        attachMarkUnread(
                            actions.querySelector('.mark-unread-btn')
                        );

                        attachDelete(
                            actions.querySelector(
                                '.delete-notification-btn'
                            )
                        );
                    }

                }


                updateUnreadCounters(-1);

                showSuccess(data.message);

            } catch (error) {

                button.disabled = false;

                showError(error.message);
            }

        });
    }


    /*
    |--------------------------------------------------------------------------
    | Mark As Unread
    |--------------------------------------------------------------------------
    */

    function attachMarkUnread(button) {

        if (!button) {
            return;
        }

        button.addEventListener('click', async function () {

            const id = this.dataset.id;

            const item = document.querySelector(
                '.notification-item[data-notification-id="' +
                id +
                '"]'
            );

            const url =
                "{{ url('/admin/notifications') }}/" +
                id +
                "/unread";

            button.disabled = true;

            try {

                const response = await fetch(url, {
                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(
                        data.message ||
                        'Unable to mark notification as unread.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Update Item
                |--------------------------------------------------------------------------
                */

                if (item) {

                    item.classList.remove('is-read');
                    item.classList.add('is-unread');


                    const titleWrap = item.querySelector(
                        '.notification-item-title-wrap'
                    );

                    if (
                        titleWrap &&
                        !titleWrap.querySelector(
                            '.notification-unread-dot'
                        )
                    ) {

                        const dot = document.createElement('span');

                        dot.className =
                            'notification-unread-dot';

                        titleWrap.prepend(dot);
                    }


                    const actions = item.querySelector(
                        '.notification-item-actions'
                    );

                    if (actions) {

                        const deleteButton =
                            actions.querySelector(
                                '.delete-notification-btn'
                            );

                        const deleteUrl =
                            deleteButton?.dataset.url || '';

                        actions.innerHTML = `
                            <button
                                type="button"
                                class="notification-action-btn mark-read-btn"
                                data-id="${id}"
                                title="Mark as read"
                            >
                                <i class="bi bi-envelope-open"></i>
                            </button>

                            <button
                                type="button"
                                class="notification-action-btn delete-notification-btn"
                                data-id="${id}"
                                data-url="${deleteUrl}"
                                title="Delete"
                            >
                                <i class="bi bi-trash3"></i>
                            </button>
                        `;

                        attachMarkRead(
                            actions.querySelector('.mark-read-btn')
                        );

                        attachDelete(
                            actions.querySelector(
                                '.delete-notification-btn'
                            )
                        );
                    }

                }


                updateUnreadCounters(1);

                showSuccess(data.message);

            } catch (error) {

                button.disabled = false;

                showError(error.message);
            }

        });
    }


    /*
    |--------------------------------------------------------------------------
    | Mark All As Read
    |--------------------------------------------------------------------------
    */

    const markAllReadBtn = document.getElementById(
        'markAllReadBtn'
    );

    if (markAllReadBtn) {

        markAllReadBtn.addEventListener(
            'click',
            async function () {

                const button = this;

                const result = await Swal.fire({
                    icon: 'question',
                    title: 'Mark all as read?',
                    text: 'All unread notifications will be marked as read.',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, mark all',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                });

                if (!result.isConfirmed) {
                    return;
                }

                button.disabled = true;

                try {

                    const response = await fetch(
                        "{{ route('admin.notifications.read-all') }}",
                        {
                            method: 'POST',

                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        }
                    );

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(
                            data.message ||
                            'Unable to mark all notifications as read.'
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Update All Items
                    |--------------------------------------------------------------------------
                    */

                    document
                        .querySelectorAll(
                            '.notification-item.is-unread'
                        )
                        .forEach(function (item) {

                            item.classList.remove('is-unread');
                            item.classList.add('is-read');


                            const unreadDot = item.querySelector(
                                '.notification-unread-dot'
                            );

                            if (unreadDot) {
                                unreadDot.remove();
                            }


                            const actions = item.querySelector(
                                '.notification-item-actions'
                            );

                            if (actions) {

                                const deleteButton =
                                    actions.querySelector(
                                        '.delete-notification-btn'
                                    );

                                const deleteUrl =
                                    deleteButton?.dataset.url || '';

                                const id =
                                    deleteButton?.dataset.id ||
                                    item.dataset.notificationId;

                                actions.innerHTML = `
                                    <button
                                        type="button"
                                        class="notification-action-btn mark-unread-btn"
                                        data-id="${id}"
                                        title="Mark as unread"
                                    >
                                        <i class="bi bi-envelope"></i>
                                    </button>

                                    <button
                                        type="button"
                                        class="notification-action-btn delete-notification-btn"
                                        data-id="${id}"
                                        data-url="${deleteUrl}"
                                        title="Delete"
                                    >
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                `;

                                attachMarkUnread(
                                    actions.querySelector(
                                        '.mark-unread-btn'
                                    )
                                );

                                attachDelete(
                                    actions.querySelector(
                                        '.delete-notification-btn'
                                    )
                                );
                            }

                        });


                    /*
                    |--------------------------------------------------------------------------
                    | Update Unread Counters
                    |--------------------------------------------------------------------------
                    */

                    document
                        .querySelectorAll('[data-unread-count]')
                        .forEach(function (element) {
                            element.textContent = '0';
                        });

                    document
                        .querySelectorAll('[data-unread-tab-count]')
                        .forEach(function (element) {
                            element.textContent = '0';
                        });


                    showSuccess(data.message);

                } catch (error) {

                    button.disabled = false;

                    showError(error.message);
                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Delete Notification
    |--------------------------------------------------------------------------
    */

    function attachDelete(button) {

        if (!button) {
            return;
        }

        button.addEventListener('click', function () {

            const id = this.dataset.id;
            const url = this.dataset.url;

            if (!url) {
                showError('Delete URL is missing.');
                return;
            }

            Swal.fire({
                icon: 'warning',
                title: 'Delete notification?',
                text: 'This notification will be permanently deleted.',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then(async function (result) {

                if (!result.isConfirmed) {
                    return;
                }

                button.disabled = true;

                try {

                    const response = await fetch(url, {
                        method: 'DELETE',

                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(
                            data.message ||
                            'Unable to delete notification.'
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Remove Item
                    |--------------------------------------------------------------------------
                    */

                    const item = document.querySelector(
                        '.notification-item[data-notification-id="' +
                        id +
                        '"]'
                    );

                    if (item) {
                        item.remove();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Update Unread Count
                    |--------------------------------------------------------------------------
                    */

                    if (
                        typeof data.unread_count !==
                        'undefined'
                    ) {

                        document
                            .querySelectorAll(
                                '[data-unread-count]'
                            )
                            .forEach(function (element) {

                                element.textContent =
                                    data.unread_count;
                            });

                        document
                            .querySelectorAll(
                                '[data-unread-tab-count]'
                            )
                            .forEach(function (element) {

                                element.textContent =
                                    data.unread_count;
                            });
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Empty State
                    |--------------------------------------------------------------------------
                    */

                    const notificationList =
                        document.querySelector(
                            '.notification-list'
                        );

                    if (
                        notificationList &&
                        !notificationList.querySelector(
                            '.notification-item'
                        )
                    ) {

                        notificationList.innerHTML = `
                            <div class="notifications-empty">
                                <div class="notifications-empty-icon">
                                    <i class="bi bi-bell-slash"></i>
                                </div>

                                <h3>No notifications found</h3>

                                <p>
                                    There are no notifications matching
                                    the selected filter.
                                </p>
                            </div>
                        `;
                    }


                    showSuccess(data.message);

                } catch (error) {

                    button.disabled = false;

                    showError(error.message);
                }

            });

        });
    }


    /*
    |--------------------------------------------------------------------------
    | Update Unread Counters
    |--------------------------------------------------------------------------
    */

    function updateUnreadCounters(change) {

        document
            .querySelectorAll('[data-unread-count]')
            .forEach(function (element) {

                const current =
                    parseInt(element.textContent.replace(/,/g, '')) || 0;

                element.textContent =
                    Math.max(0, current + change);
            });

        document
            .querySelectorAll('[data-unread-tab-count]')
            .forEach(function (element) {

                const current =
                    parseInt(element.textContent.replace(/,/g, '')) || 0;

                element.textContent =
                    Math.max(0, current + change);
            });

    }


    /*
    |--------------------------------------------------------------------------
    | Initialize Existing Buttons
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.mark-read-btn')
        .forEach(attachMarkRead);

    document
        .querySelectorAll('.mark-unread-btn')
        .forEach(attachMarkUnread);

    document
        .querySelectorAll('.delete-notification-btn')
        .forEach(attachDelete);


    /*
    |--------------------------------------------------------------------------
    | Initial Recipient State
    |--------------------------------------------------------------------------
    */

    const selectedRecipient =
        document.querySelector(
            'input[name="recipient"]:checked'
        );

    if (
        selectedRecipient &&
        selectedRecipient.value === 'all'
    ) {

        userSelectWrap.style.display = 'none';

        notificationUser.required = false;

    } else {

        userSelectWrap.style.display = '';

        notificationUser.required = true;
    }

});
</script>
@endpush