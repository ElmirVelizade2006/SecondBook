@extends('Layout.Frontend.master')

@section('title', 'Return Policy | SecondBook')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/return-policy.css') }}">
@endpush

@section('content')

<main class="sb-return-page">

    {{-- =========================================================
         HERO
    ========================================================== --}}
    <section class="sb-return-hero">

        <div class="container">

            <div class="sb-return-hero-content">

                <div class="sb-return-eyebrow">
                    <span class="sb-return-eyebrow-icon">
                        <i class="bi bi-arrow-return-left"></i>
                    </span>
                    <span>SECOND BOOK POLICY</span>
                </div>

                <h1>
                    Returns made<br>
                    <span>simple.</span>
                </h1>

                <p>
                    We want you to feel confident every time you buy a
                    second-hand book. Here's everything you need to know
                    about returns and refunds.
                </p>

            </div>

        </div>

        <div class="sb-return-decoration sb-return-decoration-one"></div>
        <div class="sb-return-decoration sb-return-decoration-two"></div>

    </section>


    {{-- =========================================================
         RETURN OVERVIEW
    ========================================================== --}}
    <section class="sb-return-overview">

        <div class="container">

            <div class="sb-return-section-heading">

                <span class="sb-return-section-label">
                    RETURN OVERVIEW
                </span>

                <h2>
                    What happens when<br>
                    you need to return a book?
                </h2>

                <p>
                    If your order does not meet the condition described
                    on the listing, you can contact us and request a
                    return review.
                </p>

            </div>


            <div class="sb-return-steps">

                {{-- STEP 01 --}}
                <article class="sb-return-step">

                    <div class="sb-return-step-number">
                        01
                    </div>

                    <div class="sb-return-step-icon">
                        <i class="bi bi-chat-left-text"></i>
                    </div>

                    <div class="sb-return-step-content">

                        <h3>Contact us</h3>

                        <p>
                            Get in touch with our support team and tell us
                            what went wrong with your order.
                        </p>

                    </div>

                </article>


                {{-- STEP 02 --}}
                <article class="sb-return-step">

                    <div class="sb-return-step-number">
                        02
                    </div>

                    <div class="sb-return-step-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div class="sb-return-step-content">

                        <h3>We review the request</h3>

                        <p>
                            We review the order details and the reason for
                            the return to determine the appropriate next step.
                        </p>

                    </div>

                </article>


                {{-- STEP 03 --}}
                <article class="sb-return-step">

                    <div class="sb-return-step-number">
                        03
                    </div>

                    <div class="sb-return-step-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div class="sb-return-step-content">

                        <h3>Return the book</h3>

                        <p>
                            If the return is approved, you will receive
                            instructions for sending the book back.
                        </p>

                    </div>

                </article>


                {{-- STEP 04 --}}
                <article class="sb-return-step">

                    <div class="sb-return-step-number">
                        04
                    </div>

                    <div class="sb-return-step-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>

                    <div class="sb-return-step-content">

                        <h3>Refund is processed</h3>

                        <p>
                            Once the return is completed and approved,
                            the applicable refund will be processed.
                        </p>

                    </div>

                </article>

            </div>

        </div>

    </section>


    {{-- =========================================================
         ELIGIBILITY
    ========================================================== --}}
    <section class="sb-return-eligibility">

        <div class="container">

            <div class="sb-return-section-heading">

                <span class="sb-return-section-label">
                    RETURN ELIGIBILITY
                </span>

                <h2>
                    When can a book<br>
                    be returned?
                </h2>

            </div>


            <div class="sb-return-eligibility-grid">

                {{-- ELIGIBLE --}}
                <article class="sb-return-policy-card sb-return-policy-card-positive">

                    <div class="sb-return-policy-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <div class="sb-return-policy-content">

                        <h3>Eligible situations</h3>

                        <ul>
                            <li>
                                <i class="bi bi-check"></i>
                                <span>The book is significantly different from its listing.</span>
                            </li>

                            <li>
                                <i class="bi bi-check"></i>
                                <span>The received book has undisclosed damage.</span>
                            </li>

                            <li>
                                <i class="bi bi-check"></i>
                                <span>The wrong book was delivered.</span>
                            </li>

                            <li>
                                <i class="bi bi-check"></i>
                                <span>The order arrived with a serious issue.</span>
                            </li>
                        </ul>

                    </div>

                </article>


                {{-- NOT ELIGIBLE --}}
                <article class="sb-return-policy-card sb-return-policy-card-neutral">

                    <div class="sb-return-policy-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <div class="sb-return-policy-content">

                        <h3>Situations that may not qualify</h3>

                        <ul>
                            <li>
                                <i class="bi bi-dash"></i>
                                <span>You simply changed your mind after receiving the book.</span>
                            </li>

                            <li>
                                <i class="bi bi-dash"></i>
                                <span>Minor signs of normal second-hand use were already described.</span>
                            </li>

                            <li>
                                <i class="bi bi-dash"></i>
                                <span>The book matches the condition shown in the listing.</span>
                            </li>

                            <li>
                                <i class="bi bi-dash"></i>
                                <span>The return request does not meet the applicable return requirements.</span>
                            </li>
                        </ul>

                    </div>

                </article>

            </div>

        </div>

    </section>


    {{-- =========================================================
         IMPORTANT NOTES
    ========================================================== --}}
    <section class="sb-return-notes">

        <div class="container">

            <div class="sb-return-notes-box">

                <div class="sb-return-notes-icon">
                    <i class="bi bi-lightbulb"></i>
                </div>

                <div class="sb-return-notes-content">

                    <span class="sb-return-section-label">
                        GOOD TO KNOW
                    </span>

                    <h2>
                        A few things to keep in mind
                    </h2>

                    <ul class="sb-return-notes-list">

                        <li class="sb-return-note">
                            <i class="bi bi-check2"></i>
                            <span>
                                Keep your order information available when contacting support.
                            </span>
                        </li>

                        <li class="sb-return-note">
                            <i class="bi bi-check2"></i>
                            <span>
                                If the issue concerns the condition of the book,
                                photos may help us review your request.
                            </span>
                        </li>

                        <li class="sb-return-note">
                            <i class="bi bi-check2"></i>
                            <span>
                                Return instructions should be followed carefully
                                once a return request has been approved.
                            </span>
                        </li>

                        <li class="sb-return-note">
                            <i class="bi bi-check2"></i>
                            <span>
                                Refund timing can depend on the payment method
                                and the return review process.
                            </span>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         RETURN QUESTIONS
    ========================================================== --}}
    <section class="sb-return-faq">

        <div class="container">

            <div class="sb-return-section-heading">

                <span class="sb-return-section-label">
                    RETURN QUESTIONS
                </span>

                <h2>
                    Frequently asked<br>
                    return questions.
                </h2>

            </div>


            <div class="sb-return-faq-grid">

                <article class="sb-return-faq-card">

                    <div class="sb-return-faq-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>

                    <div>
                        <h3>How long does a refund take?</h3>

                        <p>
                            Refund processing time can vary depending on
                            the payment method and the status of the return.
                        </p>
                    </div>

                </article>


                <article class="sb-return-faq-card">

                    <div class="sb-return-faq-icon">
                        <i class="bi bi-camera"></i>
                    </div>

                    <div>
                        <h3>Should I provide photos?</h3>

                        <p>
                            If the issue is related to the book's condition,
                            photos can help our team understand the problem.
                        </p>
                    </div>

                </article>


                <article class="sb-return-faq-card">

                    <div class="sb-return-faq-icon">
                        <i class="bi bi-person-check"></i>
                    </div>

                    <div>
                        <h3>Who reviews my request?</h3>

                        <p>
                            Our support team reviews the order information
                            and the reason provided with the return request.
                        </p>
                    </div>

                </article>


                <article class="sb-return-faq-card">

                    <div class="sb-return-faq-icon">
                        <i class="bi bi-question-circle"></i>
                    </div>

                    <div>
                        <h3>Still have questions?</h3>

                        <p>
                            Visit our FAQ page or contact the SecondBook
                            support team for further assistance.
                        </p>
                    </div>

                </article>

            </div>

        </div>

    </section>


    {{-- =========================================================
         CONTACT CTA
    ========================================================== --}}
    <section class="sb-return-contact">

        <div class="container">

            <div class="sb-return-contact-box">

                <div class="sb-return-contact-icon">
                    <i class="bi bi-headset"></i>
                </div>

                <div class="sb-return-contact-content">

                    <span class="sb-return-section-label">
                        NEED HELP?
                    </span>

                    <h2>
                        Something not right with your order?
                    </h2>

                    <p>
                        Our support team is here to help you understand
                        your return options and next steps.
                    </p>

                </div>

                <div class="sb-return-contact-actions">

                    <a href="{{ route('frontend.contact') }}"
                       class="sb-return-contact-btn">
                        Contact Support
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <a href="{{ route('frontend.faq') }}"
                       class="sb-return-contact-link">
                        View FAQ
                    </a>

                </div>

                <div class="sb-return-contact-decoration"></div>

            </div>

        </div>

    </section>

</main>

@endsection

