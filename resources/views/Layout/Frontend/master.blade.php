@include('Layout.Frontend.head')

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">
    @hasSection('hideNavbar')
    @else
        @include('Layout.Frontend.header-wrap')
    @endif

    @yield('content')

    @hasSection('hideFooter')
    @else
        @include('Layout.Frontend.footer')
        @include('Layout.Frontend.footer-bottom')
    @endif

    @hasSection('hideScripts')
    @else
        @include('Layout.Frontend.scripts')

        @push('js')
            <script>
            document.addEventListener('DOMContentLoaded', function () {

                function confirmLogout(formId) {

                Swal.fire({
                    title: 'Logout?',
                    text: 'Are you sure you want to sign out of your account?',
                    icon: 'warning',

                    wwidth: 420,
                    padding: '1.5rem',

                    showCancelButton: true,

                    confirmButtonText: 'Logout',
                    cancelButtonText: 'Stay signed in',

                    buttonsStyling: false,

                    customClass: {
                        confirmButton: 'logout-confirm-btn',
                        cancelButton: 'logout-cancel-btn'
                    }

                }).then((result) => {

                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                    }

                });

                }

                const profileLogoutBtn = document.getElementById('profileLogoutBtn');

                if (profileLogoutBtn) {
                    profileLogoutBtn.addEventListener('click', function () {
                        confirmLogout('profileLogoutForm');
                    });
                }

            });
            </script>
        @endpush

    @endif
    @stack('js')
</body>

</html>
