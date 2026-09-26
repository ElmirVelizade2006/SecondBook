<footer id="footer" class="site-footer">
    <div class="container">

        <div class="footer-main">

            {{-- Brand --}}
            <div class="footer-column footer-brand">
                <a href="{{ route('frontend.home') }}" class="footer-logo-link">
                    <img
                        src="{{ asset('main-logo.png') }}"
                        alt="SecondBook"
                        class="footer-logo"
                    >
                </a>

                <p class="footer-description">
                    SecondBook is an online marketplace where readers can buy,
                    sell and discover quality second-hand books at affordable prices.
                </p>

                <div class="footer-socials">
                    <a href="#" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="#" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="#" aria-label="X">
                        <i class="bi bi-twitter-x"></i>
                    </a>

                    <a href="#" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>

                <p class="footer-copyright">
                    © 2026 SecondBook. All Rights Reserved.
                </p>
            </div>


            {{-- Quick Links --}}
            <div class="footer-column">
                <h5 class="footer-title">Quick Links</h5>

                <ul class="footer-links">
                    <li>
                        <a href="{{ route('frontend.home') }}">Home</a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.books') }}">Books</a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.categories') }}">Categories</a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.authors') }}">Authors</a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.about') }}">About Us</a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.contact') }}">Contact</a>
                    </li>
                </ul>
            </div>


            {{-- Customer Account --}}
            <div class="footer-column">
                <h5 class="footer-title">Customer Account</h5>

                <ul class="footer-links">

                    @guest
                        <li>
                            <a href="{{ route('frontend.auth.login') }}">
                                Login
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('frontend.auth.register') }}">
                                Register
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li>
                            <a href="{{ route('my.profile') }}">
                                My Account
                            </a>
                        </li>
                    @endauth

                    <li>
                        <a href="{{ route('frontend.wishlist') }}">
                            Wishlist
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.cart') }}">
                            Shopping Cart
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.orders') }}">
                            My Orders
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.orders') }}">
                            Order Tracking
                        </a>
                    </li>

                </ul>
            </div>


            {{-- Customer Support --}}
            <div class="footer-column">
                <h5 class="footer-title">Customer Support</h5>

                <ul class="footer-links">
                    <li>
                        <a href="{{ route('frontend.help-center') }}">
                            Help Center
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.faq') }}">
                            FAQ
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.shipping-information') }}">
                            Shipping Information
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.return-policy') }}">
                            Return Policy
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.privacy-policy') }}">
                            Privacy Policy
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('frontend.auth.terms') }}">
                            Terms &amp; Conditions
                        </a>
                    </li>
                </ul>
            </div>


            {{-- Contact --}}
            <div class="footer-column footer-contact">
                <h5 class="footer-title">Contact</h5>

                <ul class="footer-contact-list">

                    <li>
                        <i class="bi bi-envelope"></i>
                        <span>support@secondbook.com</span>
                    </li>

                    <li>
                        <i class="bi bi-telephone"></i>
                        <span>+994 50 123 45 67</span>
                    </li>

                    <li>
                        <i class="bi bi-geo-alt"></i>
                        <span>M.S.Ordubadi, Nakhchivan, Azerbaijan</span>
                    </li>

                    <li>
                        <i class="bi bi-clock"></i>
                        <span>Mon - Fri: 09:00 - 18:00</span>
                    </li>

                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <span>SecondBook Marketplace</span>

            <span class="footer-bottom-separator"></span>

            <span>Books worth reading. Prices worth loving.</span>
        </div>

    </div>
</footer>