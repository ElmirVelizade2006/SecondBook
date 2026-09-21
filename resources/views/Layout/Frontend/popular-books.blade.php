<section id="popular-books" class="bookshelf py-5 my-5">

    <div class="container">

        <div class="row">

            <div class="col-md-12">


                <div class="section-header align-center">

                    <div class="title">
                        <span>Top picks from our marketplace</span>
                    </div>

                    <h2 class="section-title">
                        Popular Books
                    </h2>

                </div>


                <ul class="tabs">

                    <li
                        data-tab-target="#all-genre"
                        class="active tab"
                    >
                        Best Selling
                    </li>

                    <li
                        data-tab-target="#business"
                        class="tab"
                    >
                        Trending Now
                    </li>

                    <li
                        data-tab-target="#technology"
                        class="tab"
                    >
                        New Arrivals
                    </li>

                    <li
                        data-tab-target="#romantic"
                        class="tab"
                    >
                        Editor Picks
                    </li>

                    <li
                        data-tab-target="#adventure"
                        class="tab"
                    >
                        Most Loved
                    </li>

                    <li
                        data-tab-target="#fictional"
                        class="tab"
                    >
                        Budget Deals
                    </li>

                </ul>


                <div class="tab-content">


                    {{-- =====================================================
                        BEST SELLING
                    ====================================================== --}}

                    <div
                        id="all-genre"
                        data-tab-content
                        class="active"
                    >

                        <div class="row">

                            @forelse($bestSellingBooks as $book)

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

                                                <img
                                                    src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=900&q=90"
                                                    alt="{{ $book->title }}"
                                                    class="product-item"
                                                    loading="lazy"
                                                >

                                            @endif


                                            <form
                                                action="{{ route('frontend.cart.add', $book) }}"
                                                method="POST"
                                                class="add-to-cart-form"
                                            >

                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="quantity"
                                                    value="1"
                                                >

                                                <button
                                                    type="submit"
                                                    class="add-to-cart"
                                                >
                                                    Add to Cart
                                                </button>

                                            </form>

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

                                <div class="col-12 text-center py-5">

                                    <i class="bi bi-book fs-1 text-muted"></i>

                                    <h4 class="mt-3">
                                        No best selling books available
                                    </h4>

                                </div>

                            @endforelse

                        </div>

                    </div>



                    {{-- =====================================================
                        TRENDING NOW
                    ====================================================== --}}

                    <div
                        id="business"
                        data-tab-content
                    >

                        <div class="row">

                            @forelse($trendingBooks as $book)

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

                                                <img
                                                    src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=900&q=90"
                                                    alt="{{ $book->title }}"
                                                    class="product-item"
                                                    loading="lazy"
                                                >

                                            @endif


                                            <form
                                                action="{{ route('frontend.cart.add', $book) }}"
                                                method="POST"
                                                class="add-to-cart-form"
                                            >

                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="quantity"
                                                    value="1"
                                                >

                                                <button
                                                    type="submit"
                                                    class="add-to-cart"
                                                >
                                                    Add to Cart
                                                </button>

                                            </form>

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

                                <div class="col-12 text-center py-5">

                                    <i class="bi bi-graph-up-arrow fs-1 text-muted"></i>

                                    <h4 class="mt-3">
                                        No trending books available
                                    </h4>

                                </div>

                            @endforelse

                        </div>

                    </div>



                    {{-- =====================================================
                        NEW ARRIVALS
                    ====================================================== --}}

                    <div
                        id="technology"
                        data-tab-content
                    >

                        <div class="row">

                            @forelse($newArrivals as $book)

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

                                                <img
                                                    src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=900&q=90"
                                                    alt="{{ $book->title }}"
                                                    class="product-item"
                                                    loading="lazy"
                                                >

                                            @endif


                                            <form
                                                action="{{ route('frontend.cart.add', $book) }}"
                                                method="POST"
                                                class="add-to-cart-form"
                                            >

                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="quantity"
                                                    value="1"
                                                >

                                                <button
                                                    type="submit"
                                                    class="add-to-cart"
                                                >
                                                    Add to Cart
                                                </button>

                                            </form>

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

                                <div class="col-12 text-center py-5">

                                    <i class="bi bi-stars fs-1 text-muted"></i>

                                    <h4 class="mt-3">
                                        No new arrivals available
                                    </h4>

                                </div>

                            @endforelse

                        </div>

                    </div>



                    {{-- =====================================================
                        EDITOR PICKS
                    ====================================================== --}}

                    <div
                        id="romantic"
                        data-tab-content
                    >

                        <div class="row">

                            @forelse($editorPicks as $book)

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

                                                <img
                                                    src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=900&q=90"
                                                    alt="{{ $book->title }}"
                                                    class="product-item"
                                                    loading="lazy"
                                                >

                                            @endif


                                            <form
                                                action="{{ route('frontend.cart.add', $book) }}"
                                                method="POST"
                                                class="add-to-cart-form"
                                            >

                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="quantity"
                                                    value="1"
                                                >

                                                <button
                                                    type="submit"
                                                    class="add-to-cart"
                                                >
                                                    Add to Cart
                                                </button>

                                            </form>

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

                                <div class="col-12 text-center py-5">

                                    <i class="bi bi-pencil-square fs-1 text-muted"></i>

                                    <h4 class="mt-3">
                                        No editor picks available
                                    </h4>

                                </div>

                            @endforelse

                        </div>

                    </div>



                    {{-- =====================================================
                        MOST LOVED
                    ====================================================== --}}

                    <div
                        id="adventure"
                        data-tab-content
                    >

                        <div class="row">

                            @forelse($mostLovedBooks as $book)

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

                                                <img
                                                    src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=900&q=90"
                                                    alt="{{ $book->title }}"
                                                    class="product-item"
                                                    loading="lazy"
                                                >

                                            @endif


                                            <form
                                                action="{{ route('frontend.cart.add', $book) }}"
                                                method="POST"
                                                class="add-to-cart-form"
                                            >

                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="quantity"
                                                    value="1"
                                                >

                                                <button
                                                    type="submit"
                                                    class="add-to-cart"
                                                >
                                                    Add to Cart
                                                </button>

                                            </form>

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

                                <div class="col-12 text-center py-5">

                                    <i class="bi bi-heart fs-1 text-muted"></i>

                                    <h4 class="mt-3">
                                        No loved books available
                                    </h4>

                                </div>

                            @endforelse

                        </div>

                    </div>



                    {{-- =====================================================
                        BUDGET DEALS
                    ====================================================== --}}

                    <div
                        id="fictional"
                        data-tab-content
                    >

                        <div class="row">

                            @forelse($budgetDeals as $book)

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

                                                <img
                                                    src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=900&q=90"
                                                    alt="{{ $book->title }}"
                                                    class="product-item"
                                                    loading="lazy"
                                                >

                                            @endif


                                            <form
                                                action="{{ route('frontend.cart.add', $book) }}"
                                                method="POST"
                                                class="add-to-cart-form"
                                            >

                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="quantity"
                                                    value="1"
                                                >

                                                <button
                                                    type="submit"
                                                    class="add-to-cart"
                                                >
                                                    Add to Cart
                                                </button>

                                            </form>

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

                                <div class="col-12 text-center py-5">

                                    <i class="bi bi-tags fs-1 text-muted"></i>

                                    <h4 class="mt-3">
                                        No budget deals available
                                    </h4>

                                </div>

                            @endforelse

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</section>

