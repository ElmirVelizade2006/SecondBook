(function ($) {

    "use strict";

    $(document).ready(function () {

        /* =========================================================
           TABS
        ========================================================= */

        const tabs = document.querySelectorAll('[data-tab-target]');
        const tabContents = document.querySelectorAll('[data-tab-content]');

        tabs.forEach(tab => {

            tab.addEventListener('click', function () {

                const targetSelector = tab.dataset.tabTarget;
                const target = document.querySelector(targetSelector);

                if (!target) {
                    return;
                }

                tabContents.forEach(tabContent => {
                    tabContent.classList.remove('active');
                });

                tabs.forEach(item => {
                    item.classList.remove('active');
                });

                tab.classList.add('active');
                target.classList.add('active');
            });

        });


        /* =========================================================
           RESPONSIVE NAVIGATION
        ========================================================= */

        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.menu-list');

        function closeMenu() {

            if (!hamburger || !navMenu) {
                return;
            }

            hamburger.classList.remove('active');
            navMenu.classList.remove('responsive');
        }

        function mobileMenu() {

            if (!hamburger || !navMenu) {
                return;
            }

            hamburger.classList.toggle('active');
            navMenu.classList.toggle('responsive');
        }

        if (hamburger && navMenu) {
            hamburger.addEventListener('click', mobileMenu);
        }

        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {

            link.addEventListener('click', closeMenu);

        });


        /* =========================================================
           SCROLL NAVIGATION
        ========================================================= */

        function initScrollNav() {

            const scroll = $(window).scrollTop();

            if (scroll >= 200) {
                $('#header').addClass('fixed-top');
            } else {
                $('#header').removeClass('fixed-top');
            }
        }

        initScrollNav();

        $(window).on('scroll', function () {
            initScrollNav();
        });


        /* =========================================================
           CHOCOLAT
        ========================================================= */

        if (
            typeof Chocolat !== 'undefined' &&
            document.querySelectorAll('.image-link').length
        ) {

            Chocolat(
                document.querySelectorAll('.image-link'),
                {
                    imageSize: 'contain',
                    loop: true
                }
            );

        }


        /* =========================================================
           SEARCH
        ========================================================= */

        $('#header-wrap').on(
            'click',
            '.search-toggle',
            function (e) {

                e.preventDefault();
                e.stopPropagation();

                const $wrap = $('#header-wrap');
                const $toggle = $(this);
                const isOpen = $wrap.hasClass('show');

                if (isOpen) {

                    $wrap.removeClass('show');
                    $toggle.removeClass('active');

                    return;
                }

                $wrap.addClass('show');
                $toggle.addClass('active');

                $wrap.find('.search-input').trigger('focus');

            }
        );


        $(document).on('click touchstart', function (e) {

            const $target = $(e.target);

            if (
                $target.closest('.search-bar').length ||
                $target.closest('.search-toggle').length ||
                $target.closest('.search-box').length
            ) {
                return;
            }

            $('.search-toggle').removeClass('active');
            $('#header-wrap').removeClass('show');

        });


        $(document).on('keydown', function (e) {

            if (e.key === 'Escape') {

                $('.search-toggle').removeClass('active');
                $('#header-wrap').removeClass('show');

            }

        });


        /* =========================================================
           MAIN SLIDER
        ========================================================= */

        if (
            $.fn.slick &&
            $('.main-slider').length
        ) {

            $('.main-slider').slick({

                autoplay: false,
                autoplaySpeed: 4000,
                fade: true,
                dots: true,
                prevArrow: $('.prev'),
                nextArrow: $('.next')

            });

        }


        /* =========================================================
           PRODUCT GRID
        ========================================================= */

        if (
            $.fn.slick &&
            $('.product-grid').length
        ) {

            $('.product-grid').slick({

                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 2000,
                dots: true,
                arrows: false,

                responsive: [

                    {
                        breakpoint: 1400,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },

                    {
                        breakpoint: 999,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },

                    {
                        breakpoint: 660,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }

                ]

            });

        }


        /* =========================================================
           AOS
        ========================================================= */

        if (typeof AOS !== 'undefined') {

            AOS.init({
                duration: 1200,
                once: true
            });

        }


        /* =========================================================
           STELLARNAV
        ========================================================= */

        if (
            $.fn.stellarNav &&
            $('.stellarnav').length
        ) {

            $('.stellarnav').stellarNav({

                theme: 'plain',
                closingDelay: 250

            });

        }

    });

})(jQuery);