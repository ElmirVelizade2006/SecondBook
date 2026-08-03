	<footer id="footer">
		<div class="container">
			<!-- Fixed: keep the footer on a stable Bootstrap grid without the extra justify-content-between spacing that can distort column alignment. -->
			<div class="row g-4 align-items-start">
				<div class="col-12 col-sm-6 col-lg-3">
					<div class="footer-item footer-brand-item h-100">
						<div class="company-brand d-flex flex-column gap-3 align-items-start">
							<!-- Fixed: keep the logo inside its own column and prevent it from affecting neighboring columns. -->
							<a href="{{ route('frontend.home') }}" class="d-inline-flex align-items-center footer-brand-link">
								<img src="{{ asset('main-logo.png') }}" alt="SecondBook logo" class="footer-logo" style="max-width: 100%; width: auto; height: auto; max-height: 70px; object-fit: contain;">
							</a>
							<p class="mb-0 text-break">SecondBook is an online marketplace where readers can buy, sell and discover quality second-hand books at affordable prices.</p>
							<div class="footer-socials d-flex flex-wrap gap-2">
								<a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
								<a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
								<a href="#" aria-label="X"><i class="bi bi-twitter-x"></i></a>
								<a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
							</div>
							<p class="mb-0 small">© 2026 SecondBook. All Rights Reserved.</p>
						</div>
					</div>
				</div>

				<div class="col-12 col-sm-6 col-lg-2">
					<div class="footer-menu h-100">
						<h5 class="mb-3">Quick Links</h5>
						<ul class="menu-list list-unstyled mb-0 d-flex flex-column gap-2">
							<li class="menu-item"><a href="{{ route('frontend.home') }}">Home</a></li>
							<li class="menu-item"><a href="#books">Books</a></li>
							<li class="menu-item"><a href="#categories">Categories</a></li>
							<li class="menu-item"><a href="#authors">Authors</a></li>
							<li class="menu-item"><a href="#about">About Us</a></li>
							<li class="menu-item"><a href="#contact">Contact</a></li>
						</ul>
					</div>
				</div>

				<div class="col-12 col-sm-6 col-lg-2">
					<div class="footer-menu h-100">
						<h5 class="mb-3">Customer Account</h5>
						<ul class="menu-list list-unstyled mb-0 d-flex flex-column gap-2">
							<li class="menu-item"><a href="{{ route('frontend.auth.login') }}">Login</a></li>
							<li class="menu-item"><a href="{{ route('frontend.auth.register') }}">Register</a></li>
							<li class="menu-item"><a href="#wishlist">Wishlist</a></li>
							<li class="menu-item"><a href="#cart">Shopping Cart</a></li>
							<li class="menu-item"><a href="#">My Orders</a></li>
							<li class="menu-item"><a href="#">Order Tracking</a></li>
						</ul>
					</div>
				</div>

				<div class="col-12 col-sm-6 col-lg-2">
					<div class="footer-menu h-100">
						<h5 class="mb-3">Customer Support</h5>
						<ul class="menu-list list-unstyled mb-0 d-flex flex-column gap-2">
							<li class="menu-item"><a href="#">Help Center</a></li>
							<li class="menu-item"><a href="#">FAQ</a></li>
							<li class="menu-item"><a href="#">Shipping Information</a></li>
							<li class="menu-item"><a href="#">Return Policy</a></li>
							<li class="menu-item"><a href="#">Privacy Policy</a></li>
							<li class="menu-item"><a href="{{ route('frontend.auth.terms') }}">Terms &amp; Conditions</a></li>
						</ul>
					</div>
				</div>

				<div class="col-12 col-sm-6 col-lg-2">
					<div class="footer-menu footer-contact h-100">
						<h5 class="mb-3">Contact</h5>
						<ul class="menu-list list-unstyled mb-0 d-flex flex-column gap-2">
							<li class="menu-item"><span><i class="bi bi-envelope"></i> support@secondbook.com</span></li>
							<li class="menu-item"><span><i class="bi bi-telephone"></i> +1 (800) 234-5621</span></li>
							<li class="menu-item"><span><i class="bi bi-geo-alt"></i> 145 Paper Street, Booktown, NY</span></li>
							<li class="menu-item"><span><i class="bi bi-clock"></i> Mon - Sat: 09:00 - 18:00</span></li>
						</ul>
					</div>
				</div>

			</div>
			<!-- / row -->

		</div>
	</footer>
