<section id="featured-books" class="featured-books-section">

    <div class="container">

        {{-- Section Header --}}
        <div class="featured-books-header">

            <div class="featured-books-heading">

                <span class="featured-books-eyebrow">
                    Some quality items
                </span>

                <h2 class="featured-books-title">
                    Featured Books
                </h2>

                <div class="featured-books-divider"></div>

                <p class="featured-books-description">
                    Handpicked books selected from the SecondBook marketplace
                    for readers looking for something worth discovering.
                </p>

            </div>

            <a
                href="{{ route('frontend.books') }}"
                class="featured-books-view-all"
            >
                <span>View All Books</span>
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>


        {{-- Product List --}}
        <div class="featured-books-list" data-aos="fade-up">

            <div class="featured-books-grid">

                @forelse($featuredBooks as $book)

                    @php

                        $bookImage = null;

                        if (!empty($book->cover)) {

                            $bookImage = filter_var(
                                $book->cover,
                                FILTER_VALIDATE_URL
                            )
                                ? $book->cover
                                : asset('storage/' . $book->cover);

                        }

                    @endphp


                    <article class="featured-book-card">

                        {{-- Book Cover --}}
                        <div class="featured-book-image-wrap">

                            @if($bookImage)

                                <a
                                    href="#"
                                    class="featured-book-image"
                                >
                                    <img
                                        src="{{ $bookImage }}"
                                        alt="{{ $book->title }}"
                                        loading="lazy"
                                    >
                                </a>

                            @else

                                <div class="featured-book-image featured-book-placeholder">
                                    <i class="bi bi-book"></i>
                                </div>

                            @endif


                            {{-- Cart Button --}}
                            <button
                                type="button"
                                class="add-to-cart featured-book-cart-btn"
                                data-product-tile="add-to-cart"
                            >
                                <i class="bi bi-cart3"></i>
                                <span>Add to Cart</span>
                            </button>

                        </div>


                        {{-- Book Information --}}
                        <div class="featured-book-info">

                            <span class="featured-book-label">
                                Featured
                            </span>

                            <h3 class="featured-book-title">
                                {{ $book->title }}
                            </h3>

                            <p class="featured-book-author">
                                {{ $book->author->name ?? 'Unknown Author' }}
                            </p>

                            <div class="featured-book-bottom">

                                <span class="featured-book-price">
                                    ${{ number_format($book->price, 2) }}
                                </span>

                                <span class="featured-book-arrow">
                                    <i class="bi bi-arrow-up-right"></i>
                                </span>

                            </div>

                        </div>

                    </article>

                @empty

                    <div class="featured-books-empty">

                        <div class="featured-books-empty-icon">
                            <i class="bi bi-book"></i>
                        </div>

                        <h3>
                            No Featured Books Available
                        </h3>

                        <p>
                            Featured books will appear here once they are added.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</section>