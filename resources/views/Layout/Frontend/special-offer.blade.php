<section id="special-offer" class="bookshelf pb-5 mb-5">

    <div class="section-header align-center">
        <div class="title">
            <span>Limited-time marketplace deals</span>
        </div>

        <h2 class="section-title">Special Offers</h2>
    </div>

    <div class="container">

        <div class="row">

            <div class="inner-content">

                <div class="product-list" data-aos="fade-up">

                    <div class="grid product-grid">

                        @forelse($specialOffers as $book)

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

                                // Visual previous price
                                $previousPrice = $book->price * 1.20;

                            @endphp


                            <div class="product-item">

                                <figure class="product-style">

                                    @if($bookImage)

                                        <img
                                            src="{{ $bookImage }}"
                                            alt="{{ $book->title }}"
                                            class="product-item"
                                            loading="lazy"
                                        >

                                    @else

                                        <div class="product-image-placeholder">
                                            <i class="bi bi-book"></i>
                                        </div>

                                    @endif


                                    <button
                                        type="button"
                                        class="add-to-cart"
                                        data-product-tile="add-to-cart"
                                    >
                                        Add to Cart
                                    </button>

                                </figure>


                                <figcaption>

                                    <h3>
                                        {{ $book->title }}
                                    </h3>

                                    <span>
                                        {{ $book->author->name ?? 'Unknown Author' }}
                                    </span>


                                    <div class="item-price">

                                        <span class="prev-price">
                                            $ {{ number_format($previousPrice, 2) }}
                                        </span>

                                        $ {{ number_format($book->price, 2) }}

                                    </div>

                                </figcaption>

                            </div>

                        @empty

                            <div class="col-12 text-center py-5">

                                <i class="bi bi-tags fs-1 text-muted"></i>

                                <h4 class="mt-3">
                                    No special offers available
                                </h4>

                                <p class="text-muted mb-0">
                                    Special offers will appear here once they are added.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

