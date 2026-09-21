<section id="categories" class="py-5 my-5" data-aos="fade-up">

    <div class="container">

        <div class="section-header align-center">

            <div class="title">
                <span>Find your next read faster</span>
            </div>

            <h2 class="section-title">
                Popular Categories
            </h2>

        </div>


        <div class="row category-cards">

            @foreach($categories->take(4) as $category)

                @php
                    $categoryImage = null;

                    if (!empty($category->image)) {
                        $categoryImage = filter_var(
                            $category->image,
                            FILTER_VALIDATE_URL
                        )
                            ? $category->image
                            : asset('storage/' . $category->image);
                    }
                @endphp


                <div class="col-lg-3 col-sm-6 mb-4">

                    <a
                        href="{{ route('frontend.books', ['search' => $category->name]) }}"
                        class="category-card"
                    >

                        @if($categoryImage)

                            <img
                                src="{{ $categoryImage }}"
                                alt="{{ $category->name }} books"
                                loading="lazy"
                            >

                        @else

                            <img
                                src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=900&q=90"
                                alt="{{ $category->name }} books"
                                loading="lazy"
                            >

                        @endif


                        <div class="category-overlay">

                            <i class="bi bi-book"></i>

                            <h4>
                                {{ $category->name }}
                            </h4>

                            <p>
                                Explore {{ $category->name }} books
                            </p>

                        </div>

                    </a>

                </div>

            @endforeach

        </div>

    </div>

</section>

