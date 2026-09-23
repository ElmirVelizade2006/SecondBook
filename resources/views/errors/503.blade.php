<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SecondBook — We'll Be Back Soon</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
          rel="stylesheet">

    <style>
        :root {
            --brown: #8b5e3c;
            --brown-dark: #68442d;
            --brown-light: #b98a65;
            --cream: #f8f4ef;
            --paper: #fffdf9;
            --ink: #211b17;
            --muted: #7e756e;
            --line: rgba(139, 94, 60, .14);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            overflow: hidden;
            font-family: "DM Sans", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(
                    circle at 15% 15%,
                    rgba(185, 138, 101, .18),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 85% 80%,
                    rgba(139, 94, 60, .13),
                    transparent 30%
                ),
                var(--cream);
        }

        /* =========================================
           BACKGROUND
        ========================================= */

        .background {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .glow {
            position: absolute;
            width: 550px;
            height: 550px;
            border-radius: 50%;
            filter: blur(90px);
            opacity: .35;
        }

        .glow-one {
            top: -300px;
            left: -180px;
            background: rgba(185, 138, 101, .25);
        }

        .glow-two {
            right: -300px;
            bottom: -300px;
            background: rgba(139, 94, 60, .20);
        }

        .grid {
            position: absolute;
            inset: 0;
            opacity: .28;
            background-image:
                linear-gradient(
                    rgba(139, 94, 60, .035) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(139, 94, 60, .035) 1px,
                    transparent 1px
                );
            background-size: 55px 55px;
        }

        /* =========================================
           FLOATING PAPER
        ========================================= */

        .paper {
            position: absolute;
            width: 130px;
            height: 175px;
            border: 1px solid rgba(139, 94, 60, .10);
            background: rgba(255, 253, 249, .38);
            box-shadow: 0 20px 50px rgba(74, 48, 31, .06);
            backdrop-filter: blur(4px);
            opacity: .55;
        }

        .paper::before,
        .paper::after {
            content: "";
            position: absolute;
            left: 18px;
            right: 18px;
            height: 1px;
            background: rgba(139, 94, 60, .12);
        }

        .paper::before {
            top: 45px;
        }

        .paper::after {
            top: 58px;
            box-shadow:
                0 13px 0 rgba(139, 94, 60, .08),
                0 26px 0 rgba(139, 94, 60, .08),
                0 39px 0 rgba(139, 94, 60, .08);
        }

        .paper-one {
            top: 14%;
            left: 5%;
            transform: rotate(-17deg);
            animation: floatOne 8s ease-in-out infinite;
        }

        .paper-two {
            right: 7%;
            top: 11%;
            transform: rotate(15deg);
            animation: floatTwo 10s ease-in-out infinite;
        }

        .paper-three {
            left: 9%;
            bottom: 7%;
            transform: rotate(13deg);
            animation: floatTwo 9s ease-in-out infinite reverse;
        }

        .paper-four {
            right: 10%;
            bottom: 5%;
            transform: rotate(-12deg);
            animation: floatOne 11s ease-in-out infinite reverse;
        }

        @keyframes floatOne {
            0%, 100% {
                translate: 0 0;
            }

            50% {
                translate: 0 -18px;
            }
        }

        @keyframes floatTwo {
            0%, 100% {
                translate: 0 0;
            }

            50% {
                translate: 0 20px;
            }
        }

        /* =========================================
           MAIN
        ========================================= */

        .page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            z-index: 5;
        }

        .container {
            width: 100%;
            max-width: 1180px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 90px;
        }

        /* =========================================
           LEFT CONTENT
        ========================================= */

        .content {
            animation: revealContent .9s ease forwards;
        }

        @keyframes revealContent {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 52px;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: var(--brown);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            box-shadow: 0 9px 25px rgba(139, 94, 60, .25);
        }

        .brand-name {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -.4px;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 20px;
            color: var(--brown);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.4px;
            text-transform: uppercase;
        }

        .eyebrow-line {
            width: 35px;
            height: 1px;
            background: var(--brown);
        }

        h1 {
            max-width: 650px;
            font-family: "Playfair Display", serif;
            font-size: clamp(54px, 6vw, 84px);
            line-height: .99;
            font-weight: 600;
            letter-spacing: -3px;
        }

        h1 span {
            color: var(--brown);
        }

        .description {
            max-width: 520px;
            margin-top: 28px;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.85;
        }

        /* =========================================
           STATUS
        ========================================= */

        .status {
            margin-top: 38px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--brown);
            box-shadow: 0 0 0 7px rgba(139, 94, 60, .09);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 7px rgba(139, 94, 60, .09);
            }

            50% {
                box-shadow: 0 0 0 13px rgba(139, 94, 60, .02);
            }
        }

        .status-text {
            color: #5f5751;
            font-size: 13px;
            font-weight: 600;
        }

        /* =========================================
           RIGHT BOOK
        ========================================= */

        .visual {
            min-height: 590px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: revealVisual 1s .15s ease both;
        }

        @keyframes revealVisual {
            from {
                opacity: 0;
                transform: scale(.94) translateY(20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .orb {
            position: absolute;
            width: 440px;
            height: 440px;
            border-radius: 50%;
            border: 1px solid rgba(139, 94, 60, .13);
        }

        .orb::before,
        .orb::after {
            content: "";
            position: absolute;
            inset: 28px;
            border-radius: inherit;
            border: 1px solid rgba(139, 94, 60, .08);
        }

        .orb::after {
            inset: 62px;
        }

        .book-scene {
            width: 320px;
            height: 430px;
            position: relative;
            perspective: 1200px;
            transform: rotate(-4deg);
        }

        .book {
            position: absolute;
            width: 260px;
            height: 355px;
            left: 30px;
            top: 38px;
            transform-style: preserve-3d;
            transform: rotateY(-17deg) rotateX(4deg);
            filter: drop-shadow(28px 35px 28px rgba(56, 37, 25, .20));
        }

        .book-cover {
            position: absolute;
            inset: 0;
            border-radius: 5px 14px 14px 5px;
            background:
                linear-gradient(
                    145deg,
                    #a7744e 0%,
                    #8b5e3c 45%,
                    #68442d 100%
                );
            border: 1px solid rgba(255,255,255,.18);
            box-shadow:
                inset 8px 0 0 rgba(54, 31, 18, .12),
                inset -3px 0 0 rgba(255,255,255,.08);
            overflow: hidden;
        }

        .book-cover::before {
            content: "";
            position: absolute;
            inset: 18px;
            border: 1px solid rgba(255, 239, 218, .28);
            border-radius: 3px;
        }

        .book-cover::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 28px;
            right: 28px;
            height: 1px;
            background: rgba(255, 239, 218, .24);
        }

        .cover-content {
            position: absolute;
            inset: 45px 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff4e6;
        }

        .cover-small {
            font-size: 9px;
            letter-spacing: 3px;
            text-transform: uppercase;
            opacity: .75;
            margin-bottom: 22px;
        }

        .cover-title {
            font-family: "Playfair Display", serif;
            font-size: 33px;
            line-height: 1.05;
            font-weight: 600;
        }

        .cover-rule {
            width: 45px;
            height: 1px;
            background: rgba(255, 239, 218, .5);
            margin: 24px 0;
        }

        .cover-bottom {
            font-size: 9px;
            letter-spacing: 2px;
            opacity: .7;
            text-transform: uppercase;
        }

        .pages {
            position: absolute;
            width: 252px;
            height: 345px;
            top: 44px;
            left: 39px;
            border-radius: 3px 13px 13px 3px;
            background: #f9f1e5;
            transform: translateZ(-18px);
            box-shadow:
                5px 3px 0 #e6d8c5,
                9px 6px 0 #d9c8b2;
        }

        .page-lines {
            position: absolute;
            inset: 25px 22px 25px 30px;
            opacity: .45;
            background:
                linear-gradient(
                    #cdbba5 1px,
                    transparent 1px
                );
            background-size: 100% 18px;
        }

        .bookmark {
            position: absolute;
            width: 20px;
            height: 90px;
            background: #9d4938;
            right: 32px;
            top: 180px;
            z-index: 10;
            box-shadow: 3px 4px 8px rgba(0,0,0,.13);
        }

        .bookmark::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 12px solid #8b5e3c;
        }

        /* =========================================
           FLOATING LABELS
        ========================================= */

        .floating-label {
            position: absolute;
            padding: 12px 16px;
            border-radius: 14px;
            background: rgba(255, 253, 249, .82);
            border: 1px solid rgba(139, 94, 60, .11);
            box-shadow: 0 14px 35px rgba(52, 34, 23, .08);
            backdrop-filter: blur(10px);
            color: #6e6259;
            font-size: 11px;
            font-weight: 600;
        }

        .label-one {
            top: 105px;
            right: 5px;
            animation: floatTwo 6s ease-in-out infinite;
        }

        .label-two {
            bottom: 110px;
            left: 0;
            animation: floatOne 7s ease-in-out infinite;
        }

        .label-three {
            top: 245px;
            left: -28px;
            animation: floatTwo 8s ease-in-out infinite reverse;
        }

        /* =========================================
           FOOTER
        ========================================= */

        .footer {
            position: fixed;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%);
            color: #9c9189;
            font-size: 11px;
            letter-spacing: .2px;
            z-index: 10;
            white-space: nowrap;
        }

        .footer span {
            color: var(--brown);
        }

        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 1000px) {
            body {
                overflow: auto;
            }

            .page {
                padding: 45px 25px 90px;
            }

            .container {
                grid-template-columns: 1fr;
                gap: 20px;
                max-width: 720px;
            }

            .content {
                text-align: center;
            }

            .brand {
                justify-content: center;
                margin-bottom: 35px;
            }

            .eyebrow {
                justify-content: center;
            }

            .description {
                margin-left: auto;
                margin-right: auto;
            }

            .status {
                justify-content: center;
            }

            .visual {
                min-height: 480px;
            }

            h1 {
                font-size: clamp(48px, 9vw, 70px);
            }

            .footer {
                bottom: 16px;
            }
        }

        @media (max-width: 520px) {
            .page {
                padding: 30px 18px 75px;
            }

            .brand {
                margin-bottom: 28px;
            }

            .brand-mark {
                width: 34px;
                height: 34px;
            }

            .brand-name {
                font-size: 17px;
            }

            h1 {
                font-size: 45px;
                letter-spacing: -2px;
            }

            .description {
                font-size: 14px;
                line-height: 1.75;
            }

            .visual {
                min-height: 390px;
            }

            .orb {
                width: 310px;
                height: 310px;
            }

            .book-scene {
                width: 260px;
                height: 350px;
                transform: scale(.78) rotate(-4deg);
            }

            .floating-label {
                display: none;
            }

            .footer {
                font-size: 10px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
            }
        }
    </style>
</head>

<body>

<div class="background">
    <div class="glow glow-one"></div>
    <div class="glow glow-two"></div>
    <div class="grid"></div>

    <div class="paper paper-one"></div>
    <div class="paper paper-two"></div>
    <div class="paper paper-three"></div>
    <div class="paper paper-four"></div>
</div>

<main class="page">

    <div class="container">

        <!-- LEFT -->
        <section class="content">

            <div class="brand">
                <div class="brand-mark">
                    📖
                </div>

                <div class="brand-name">
                    SecondBook
                </div>
            </div>

            <div class="eyebrow">
                <span class="eyebrow-line"></span>
                Temporarily offline
            </div>

            <h1>
                A new chapter<br>
                is <span>loading.</span>
            </h1>

            <p class="description">
                We're taking a little time to improve SecondBook behind
                the scenes. Our marketplace will be back shortly with
                a smoother and better experience.
            </p>

            <div class="status">
                <span class="status-dot"></span>

                <span class="status-text">
                    We're working on it
                </span>
            </div>

        </section>

        <!-- RIGHT -->
        <section class="visual">

            <div class="orb"></div>

            <div class="floating-label label-one">
                Improving your experience
            </div>

            <div class="floating-label label-two">
                <span>✦</span>&nbsp; Almost there
            </div>

            <div class="floating-label label-three">
                SecondBook
            </div>

            <div class="book-scene">

                <div class="book">

                    <div class="pages">
                        <div class="page-lines"></div>
                    </div>

                    <div class="book-cover">

                        <div class="cover-content">

                            <div class="cover-small">
                                SecondBook
                            </div>

                            <div class="cover-title">
                                A New<br>
                                Chapter
                            </div>

                            <div class="cover-rule"></div>

                            <div class="cover-bottom">
                                Coming Soon
                            </div>

                        </div>

                    </div>

                    <div class="bookmark"></div>

                </div>

            </div>

        </section>

    </div>

</main>

<div class="footer">
    © {{ date('Y') }} <span>SecondBook</span> · Thank you for your patience.
</div>

</body>
</html>