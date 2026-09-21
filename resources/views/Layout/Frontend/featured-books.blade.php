<section id="featured-books" class="py-5 my-5">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="section-header align-center">

                    <div class="title">
                        <span>Some quality items</span>
                    </div>

                    <h2 class="section-title">
                        Featured Books
                    </h2>

                </div>


                <div class="product-list" data-aos="fade-up">

                    <div class="row">

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


                            <div class="col-md-3">

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
                                            $ {{ number_format($book->price, 2) }}
                                        </div>

                                    </figcaption>

                                </div>

                            </div>

                        @empty

                            <div class="col-12">

                                <div class="text-center py-5">

                                    <i class="bi bi-book fs-1 text-muted"></i>

                                    <h4 class="mt-3">
                                        No featured books available
                                    </h4>

                                    <p class="text-muted mb-0">
                                        Featured books will appear here once they are added.
                                    </p>

                                </div>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>


        <div class="row">

            <div class="col-md-12">

                <div class="btn-wrap align-right">

                    <a
                        href="{{ route('frontend.books') }}"
                        class="btn-accent-arrow"
                    >
                        View all products
                        <i class="icon icon-ns-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

