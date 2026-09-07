<style>
    .auth-page-bg {
        --auth-surface: rgba(255, 249, 241, 0.9);
        --auth-surface-2: rgba(248, 237, 219, 0.9);
        --auth-border: #d5b998;
        --auth-text: #4a2f1f;
        --auth-muted: #7a5b45;
        --auth-accent: #8a5a32;
        --auth-accent-2: #6f3f1e;
        --auth-focus: rgba(138, 90, 50, 0.25);
    }

    .frontend-main {
        padding: 0 !important;
    }

    .auth-page-bg {
        min-height: 100vh;
        width: 100%;
        background-image: url('{{ asset('arxaplan.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .auth-page-bg-login {
        position: relative;
        isolation: isolate;
        overflow: hidden;
        background-image: none;
    }

    .auth-page-bg-login::before {
        content: '';
        position: absolute;
        inset: -10px;
        z-index: -3;
        background-image: url('{{ asset('arxaplan.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(3px) saturate(90%) contrast(1.08);
        transform: scale(1.03);
    }

    .auth-page-bg-login::after {
        content: '';
        position: absolute;
        inset: 0;
        z-index: -2;
        background:
            radial-gradient(circle at 0% 0%, rgba(243, 205, 140, 0.22) 0%, rgba(243, 205, 140, 0.08) 28%, transparent 60%),
            radial-gradient(circle at center, transparent 50%, rgba(0, 0, 0, 0.26) 100%),
            linear-gradient(140deg, rgba(248, 245, 239, 0.15) 0%, rgba(0, 0, 0, 0.35) 100%);
        pointer-events: none;
    }

    .auth-page-bg-login .auth-wrapper::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: -1;
        background-image:
            radial-gradient(2px 2px at 10% 18%, rgba(255, 244, 226, 0.22), transparent 65%),
            radial-gradient(1.8px 1.8px at 30% 35%, rgba(255, 244, 226, 0.17), transparent 65%),
            radial-gradient(2px 2px at 70% 20%, rgba(255, 244, 226, 0.14), transparent 65%),
            radial-gradient(1.6px 1.6px at 85% 55%, rgba(255, 244, 226, 0.16), transparent 65%),
            radial-gradient(2px 2px at 55% 75%, rgba(255, 244, 226, 0.15), transparent 65%);
        animation: authDustFloat 16s ease-in-out infinite alternate;
        pointer-events: none;
    }

    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-grid {
        max-width: 460px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .auth-card {
        border-radius: 20px;
        border: 1px solid var(--auth-border);
        background: linear-gradient(180deg, var(--auth-surface) 0%, var(--auth-surface-2) 100%);
        backdrop-filter: blur(3px);
        padding: 1.15rem;
        box-shadow: 0 18px 35px rgba(39, 21, 8, 0.22);
    }

    .auth-card-login {
        background: rgba(255, 255, 255, 0.88);
        border: 1px solid rgba(255, 255, 255, 0.35);
        border-radius: 24px;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.18);
        animation: authCardFadeIn 0.9s ease-out both;
    }

    .auth-card h4 {
        margin-bottom: 0.3rem;
        font-weight: 800;
        color: var(--auth-text);
        font-size: 1.35rem;
    }

    .auth-hero {
        margin-bottom: 0.8rem;
    }

    .auth-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.28rem 0.56rem;
        border-radius: 999px;
        border: 1px solid #c9ab87;
        background: #fff5e5;
        color: #7a4b2b;
        font-size: 0.72rem;
        font-weight: 700;
        margin-bottom: 0.48rem;
    }

    .auth-muted {
        color: var(--auth-muted);
        font-size: 0.84rem;
        margin-bottom: 0.8rem;
    }

    .auth-card .form-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--auth-text);
    }

    .auth-card .form-control {
        border-radius: 12px;
        border-color: #c9ab87;
        background: #fffdf8;
        color: #4a2f1f;
        padding: 0.52rem 0.72rem;
        font-size: 0.9rem;
    }

    .auth-input-group .input-group-text {
        border-color: #c9ab87;
        background: #f7ead7;
        color: #7a4b2b;
        border-radius: 12px 0 0 12px;
        font-size: 0.86rem;
        padding: 0.45rem 0.6rem;
    }

    .auth-input-group .form-control {
        border-left: 0;
        border-radius: 0 12px 12px 0;
    }

    .auth-card .form-control::placeholder {
        color: #9b7c62;
    }

    .auth-card .form-control:focus {
        border-color: var(--auth-accent);
        box-shadow: 0 0 0 0.2rem var(--auth-focus);
    }

    .auth-card .btn-primary {
        border: none;
        border-radius: 12px;
        font-weight: 700;

        padding-top: 0.54rem;
        padding-bottom: 0.54rem;
        font-size: 0.92rem;
        background: linear-gradient(125deg, var(--auth-accent-2) 0%, var(--auth-accent) 55%, #b07947 100%);
        box-shadow: 0 10px 20px rgba(79, 45, 22, 0.35);
    }

    .auth-card .btn-primary:hover {
        filter: brightness(1.06);
    }

    .auth-note {
        border-radius: 12px;
        border: 1px dashed #d5b998;
        background: linear-gradient(120deg, #f5e5cb 0%, #f2dbc0 100%);
        color: #5f3b24;
        font-size: 0.78rem;
        padding: 0.52rem 0.65rem;
        margin-top: 0.7rem;
    }

    .auth-link {
        color: #7d4c2a;
        text-decoration: none;
        font-weight: 600;
    }

    .auth-link:hover {
        color: #5f3519;
        text-decoration: underline;
    }

    .auth-grid-login {
        max-width: 415px;
    }

    .auth-card-login-pro {
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.35);
        background: rgba(255, 255, 255, 0.88);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.18);
        padding-top: 17px;
        padding-bottom: 17px;
    }

    .auth-login-title {
        font-size: clamp(1.6rem, 2.8vw, 2rem);
        letter-spacing: 0.01em;
        margin-bottom: 0.35rem;
        line-height: 1.2;
    }

    .auth-login-subtitle {
        font-size: 0.88rem;
        margin-bottom: 1.05rem;
    }

    .auth-login-form .auth-field {
        margin-bottom: 0.92rem !important;
    }

    .auth-login-form .auth-input-group .form-control,
    .auth-login-form .auth-input-group .input-group-text {
        border-radius: 15px;
        min-height: 46px;
    }

    .auth-login-form .auth-input-group .input-group-text {
        border-right: 0;
        width: 44px;
        justify-content: center;
    }

    .auth-login-form .auth-input-group .form-control {
        border-left: 0;
        border-right: 0;
        padding-left: 0.15rem;
    }

    .auth-login-form .auth-input-group .auth-pass-toggle {
        border-left: 0;
        border-right: 1px solid #c9ab87;
        border-radius: 0 15px 15px 0;
        background: #f7ead7;
        color: #7a4b2b;
        width: 44px;
        justify-content: center;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .auth-login-form .auth-input-group .auth-pass-toggle:hover {
        background: #eed9bf;
        color: #6b4124;
    }

    .auth-login-form .auth-input-group:focus-within .input-group-text,
    .auth-login-form .auth-input-group:focus-within .auth-pass-toggle,
    .auth-login-form .auth-input-group:focus-within .form-control {
        border-color: #8B5E3C;
        box-shadow: 0 0 0 0.2rem rgba(139, 94, 60, 0.2);
    }

    .auth-login-row {
        margin-top: 0.2rem;
        margin-bottom: 1.05rem !important;
    }

    .auth-remember-check .form-check-input {
        width: 1.05rem;
        height: 1.05rem;
        border-radius: 0.35rem;
        border-color: #be9c79;
        box-shadow: none;
    }

    .auth-remember-check .form-check-input:checked {
        background-color: #8B5E3C;
        border-color: #8B5E3C;
    }

    .auth-remember-check .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(139, 94, 60, 0.2);
        border-color: #8B5E3C;
    }

    .auth-remember-check .form-check-label {
        color: #6d4a33;
        font-size: 0.84rem;
    }

    .auth-forgot-link {
        font-size: 0.84rem;
        color: #7a4b2b;
        transition: color 0.2s ease;
    }

    .auth-forgot-link:hover {
        color: #5d351c;
    }

    .auth-signin-btn {
        border: none;
        border-radius: 15px !important;
        padding: 0.68rem 1rem !important;
        font-weight: 700;
        letter-spacing: 0.01em;
        background: linear-gradient(135deg, #6f3f1e 0%, #8B5E3C 52%, #b17a48 100%) !important;
        box-shadow: 0 12px 24px rgba(73, 44, 22, 0.28);
        transition: transform 0.2s ease, box-shadow 0.25s ease, filter 0.25s ease;
    }

    .auth-signin-btn:hover {
        transform: translateY(-1px);
        filter: brightness(1.05);
        box-shadow: 0 16px 30px rgba(73, 44, 22, 0.34);
    }

    .auth-divider {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #9b7c62;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.08em;
    }

    .auth-divider::before,
    .auth-divider::after {
        content: '';
        flex: 1;
        border-top: 1px solid rgba(172, 134, 97, 0.35);
    }

    .auth-google-btn {
        border-radius: 14px;
        border: 1px solid #dcc4a8;
        background: linear-gradient(180deg, #fffdf9 0%, #f9efe1 100%);
        color: #5f3b24;
        font-weight: 600;
        padding: 0.62rem 0.9rem;
        box-shadow: 0 8px 18px rgba(67, 42, 24, 0.12);
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .auth-google-btn:hover {
        transform: translateY(-1px);
        background: linear-gradient(180deg, #fffaf3 0%, #f5e7d3 100%);
        box-shadow: 0 10px 20px rgba(67, 42, 24, 0.16);
        color: #4f301d;
    }

    .auth-register-copy {
        margin-top: 1rem !important;
        text-align: center;
        color: #7d624c !important;
    }

    .auth-register-link {
        margin-left: 0.2rem;
        font-weight: 700;
        color: #6f3f1e;
    }

    .auth-register-link:hover {
        color: #4f2d16;
    }

    .sb-login-brand {
        margin-bottom: 0.34rem;
    }

    .sb-login-logo {
        width: 145px;
        height: auto;
        filter: drop-shadow(0 5px 10px rgba(74, 47, 31, 0.16));
    }

    .sb-login-head {
        margin-bottom: 0.26rem;
    }

    .sb-login-title {
        margin: 0 0 0.1rem;
        font-size: 30px;
        line-height: 1.15;
        font-weight: 800;
        letter-spacing: 0.01em;
        color: #4a2f1f;
    }

    .sb-login-subtitle {
        margin: 0;
        font-size: 14px;
        color: #7b5b43;
    }

    .sb-login-form .sb-field {
        margin-bottom: 0.3rem !important;
    }

    .sb-login-form .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #5b3a24;
        margin-bottom: 0.16rem;
    }

    .sb-input-group {
        align-items: stretch;
        background: #fffdfa;
        border: 1px solid #d8c0a5;
        border-radius: 10px;
        overflow: hidden;
    }

    .sb-login-form .sb-input-group {
        width: 93%;
        margin-left: auto;
        margin-right: auto;
    }

    .sb-input-group .input-group-text,
    .sb-input-group .form-control,
    .sb-input-group .sb-pass-toggle {
        height: 46px;
        min-height: 46px;
        max-height: 46px;
        background: #fffdfa;
        border: 0 !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        box-shadow: none !important;
    }

    .sb-input-group .input-group-text {
        width: 42px;
        min-width: 42px;
        justify-content: center;
        align-items: center;
        display: inline-flex;
        padding: 0;
        margin: 0;
        color: #8B5E3C;
        border: 0;
        border-radius: 10px 0 0 10px;
        box-shadow: none;
        font-size: 15px;
        line-height: 46px;
    }

    .sb-input-group .input-group-text i {
        font-size: 15px;
        line-height: 1;
        color: #8B5E3C;
    }

    .sb-input-group .form-control {
        border: 0;
        border-radius: 0;
        color: #4a2f1f;
        font-size: 14px;
        padding: 0 0.72rem !important;
        line-height: 46px;
        box-shadow: none;
    }

    .sb-input-group .form-control:focus {
        box-shadow: none;
    }

    .sb-input-group .form-control::placeholder {
        color: #aa8769;
    }

    .sb-input-group .sb-pass-toggle {
        width: 42px;
        min-width: 42px;
        justify-content: center;
        align-items: center;
        display: inline-flex;
        padding: 0;
        margin: 0;
        color: #8B5E3C;
        background: #fffdfa;
        border: 0;
        border-radius: 0 10px 10px 0;
        transition: color 0.2s ease, background-color 0.2s ease;
        font-size: 15px;
        line-height: 46px;
        cursor: pointer;
    }

    .sb-input-group .sb-pass-toggle i {
        font-size: 15px;
        line-height: 1;
        color: #8B5E3C;
    }

    .sb-input-group .sb-pass-toggle:hover {
        background: #fffdfa;
        color: #6f3f1e;
    }

    .sb-input-group:focus-within {
        border-color: #8B5E3C;
        box-shadow: 0 0 0 0.2rem rgba(139, 94, 60, 0.18);
    }

    .sb-row {
        margin-top: 0.1rem;
        margin-bottom: 0.26rem !important;
    }

    .sb-login-form .sb-signin-btn {
        margin-top: 0.08rem;
        margin-bottom: 0.22rem;
    }

    .sb-remember-check .form-check-input {
        width: 0.95rem;
        height: 0.95rem;
        border-radius: 0.35rem;
        border-color: #c39e79;
        box-shadow: none;
    }

    .sb-remember-check .form-check-input:checked {
        background-color: #8B5E3C;
        border-color: #8B5E3C;
    }

    .sb-remember-check .form-check-input:focus {
        border-color: #8B5E3C;
        box-shadow: 0 0 0 0.2rem rgba(139, 94, 60, 0.2);
    }

    .sb-remember-check .form-check-label {
        font-size: 0.79rem;
        color: #6a4933;
    }

    .sb-forgot-link {
        font-size: 0.79rem;
        text-decoration: none;
        color: #7a4b2b;
        transition: color 0.2s ease;
    }

    .sb-forgot-link:hover {
        color: #5d351c;
        text-decoration: underline;
    }

    .sb-signin-btn {
        border: 0;
        border-radius: 12px;
        height: 48px;
        min-height: 48px;
        padding: 0.36rem 0.82rem;
        font-weight: 700;
        font-size: 15px;
        color: #fff;
        background: linear-gradient(135deg, #8B5E3C 0%, #A67C52 100%);
        box-shadow: 0 14px 26px rgba(74, 47, 31, 0.28);
        transition: transform 0.2s ease, box-shadow 0.24s ease, filter 0.24s ease;
    }

    .sb-signin-btn:hover {
        transform: translateY(-2px);
        filter: brightness(1.04);
        box-shadow: 0 18px 30px rgba(74, 47, 31, 0.34);
        color: #fff;
    }

    .sb-divider {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        color: #9f7d5f;
        font-size: 0.72rem;
        letter-spacing: 0.09em;
        font-weight: 700;
        margin: 0.24rem 0 !important;
    }

    .sb-divider::before,
    .sb-divider::after {
        content: '';
        flex: 1;
        border-top: 1px solid rgba(173, 135, 98, 0.4);
    }

    .sb-google-btn {
        border-radius: 12px;
        border: 1px solid #dcc3a6;
        background: linear-gradient(180deg, #fffdfa 0%, #f8efe2 100%);
        color: #573821;
        font-weight: 600;
        height: 48px;
        min-height: 48px;
        font-size: 15px;
        padding: 0.36rem 0.76rem;
        box-shadow: 0 10px 18px rgba(80, 51, 29, 0.12);
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        margin-top: 0.08rem;
        margin-bottom: 0.18rem;
    }

    .sb-google-btn:hover {
        transform: translateY(-1px);
        background: linear-gradient(180deg, #fffaf3 0%, #f4e6d4 100%);
        box-shadow: 0 12px 20px rgba(80, 51, 29, 0.16);
        color: #4f311d;
    }

    .sb-login-features {
        border: 1px solid rgba(194, 158, 122, 0.34);
        background: rgba(253, 247, 240, 0.82);
        border-radius: 14px;
        padding: 0.24rem 0.42rem;
        margin-top: 0.34rem !important;
        margin-bottom: 0.34rem !important;
    }

    .sb-login-features li {
        display: flex;
        align-items: center;
        gap: 0.48rem;
        color: #6a4933;
        font-size: 14px;
        margin-bottom: 0.06rem;
    }

    .sb-login-features li:last-child {
        margin-bottom: 0;
    }

    .sb-login-features i {
        color: #8B5E3C;
        font-size: 0.82rem;
    }

    .sb-register-copy {
        color: #7a5f49;
        font-size: 0.8rem;
        margin-top: 0.24rem;
        margin-bottom: 0.06rem;
    }

    .sb-register-link {
        color: #6f3f1e;
        font-weight: 700;
        text-decoration: none;
        margin-left: 0.25rem;
    }

    .sb-register-link:hover {
        color: #4f2d16;
        text-decoration: underline;
    }

    :root[data-theme='dark'] .auth-card {
        background: linear-gradient(180deg, rgba(43, 29, 19, 0.9) 0%, rgba(28, 19, 13, 0.92) 100%);
        border-color: #6b4a2f;
        box-shadow: none;
    }

    :root[data-theme='dark'] .auth-page-bg {
        background-image:
            linear-gradient(rgba(15, 23, 42, 0.38), rgba(15, 23, 42, 0.38)),
            url('{{ asset('arxaplan.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    :root[data-theme='dark'] .auth-page-bg-login::after {
        background:
            radial-gradient(circle at 0% 0%, rgba(173, 120, 60, 0.2) 0%, rgba(173, 120, 60, 0.09) 30%, transparent 60%),
            radial-gradient(circle at center, transparent 46%, rgba(0, 0, 0, 0.32) 100%),
            linear-gradient(140deg, rgba(248, 245, 239, 0.08) 0%, rgba(0, 0, 0, 0.5) 100%);
    }

    :root[data-theme='dark'] .auth-card h4 {
        color: #f4d9b8;
    }

    :root[data-theme='dark'] .auth-card-login {
        background: rgba(38, 27, 18, 0.78);
        border-color: rgba(201, 156, 111, 0.3);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
    }

    :root[data-theme='dark'] .auth-muted,
    :root[data-theme='dark'] .auth-card .form-label {
        color: #d2b79a;
    }

    :root[data-theme='dark'] .auth-card .form-control {
        background: rgba(23, 16, 11, 0.9);
        border-color: #7a5638;
        color: #f9e6d2;
    }

    :root[data-theme='dark'] .auth-hero-badge {
        background: rgba(81, 53, 31, 0.85);
        border-color: #9e7148;
        color: #f5d6b7;
    }

    :root[data-theme='dark'] .auth-input-group .input-group-text {
        background: rgba(66, 42, 25, 0.9);
        border-color: #7a5638;
        color: #f5d6b7;
    }

    :root[data-theme='dark'] .auth-card .form-control::placeholder {
        color: #be9f81;
    }

    :root[data-theme='dark'] .auth-note {
        background: rgba(70, 44, 25, 0.9);
        border-color: #9e7148;
        color: #f5d6b7;
    }

    :root[data-theme='dark'] .auth-card .btn-primary {
        background: linear-gradient(125deg, #8e5a32 0%, #a87543 55%, #c79057 100%);
        box-shadow: none;
    }

    :root[data-theme='dark'] .auth-link {
        color: #e6c29a;
    }

    :root[data-theme='dark'] .auth-login-form .auth-input-group .input-group-text,
    :root[data-theme='dark'] .auth-login-form .auth-input-group .auth-pass-toggle {
        background: rgba(66, 42, 25, 0.92);
        border-color: #7a5638;
        color: #f5d6b7;
    }

    :root[data-theme='dark'] .auth-login-form .auth-input-group:focus-within .input-group-text,
    :root[data-theme='dark'] .auth-login-form .auth-input-group:focus-within .auth-pass-toggle,
    :root[data-theme='dark'] .auth-login-form .auth-input-group:focus-within .form-control {
        border-color: #c79057;
        box-shadow: 0 0 0 0.2rem rgba(199, 144, 87, 0.2);
    }

    :root[data-theme='dark'] .auth-remember-check .form-check-label,
    :root[data-theme='dark'] .auth-forgot-link,
    :root[data-theme='dark'] .auth-register-copy,
    :root[data-theme='dark'] .auth-register-link {
        color: #e8c9a7 !important;
    }

    :root[data-theme='dark'] .auth-remember-check .form-check-input {
        border-color: #a77749;
        background-color: rgba(28, 19, 13, 0.9);
    }

    :root[data-theme='dark'] .auth-signin-btn {
        background: linear-gradient(135deg, #7e4b27 0%, #a16d40 52%, #c79057 100%) !important;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.3);
    }

    :root[data-theme='dark'] .auth-divider {
        color: #d0ac87;
    }

    :root[data-theme='dark'] .auth-divider::before,
    :root[data-theme='dark'] .auth-divider::after {
        border-top-color: rgba(167, 119, 73, 0.35);
    }

    :root[data-theme='dark'] .auth-google-btn {
        background: linear-gradient(180deg, rgba(58, 37, 22, 0.95) 0%, rgba(44, 28, 17, 0.95) 100%);
        border-color: #8c603b;
        color: #f0d2b3;
    }

    :root[data-theme='dark'] .sb-login-title,
    :root[data-theme='dark'] .sb-login-subtitle,
    :root[data-theme='dark'] .sb-login-form .form-label,
    :root[data-theme='dark'] .sb-remember-check .form-check-label,
    :root[data-theme='dark'] .sb-forgot-link,
    :root[data-theme='dark'] .sb-register-copy,
    :root[data-theme='dark'] .sb-register-link {
        color: #eed0b2;
    }

    :root[data-theme='dark'] .sb-input-group {
        background: rgba(39, 25, 16, 0.92);
        border-color: #8c603b;
    }

    .sb-input-group {
    height: 42px;
    }

    .sb-input-group .input-group-text,
    .sb-input-group .form-control,
    .sb-input-group .sb-pass-toggle {
        height: 42px !important;
        min-height: 42px !important;
        max-height: 42px !important;
    }

    .sb-input-group .form-control {
        padding: 0 12px !important;
        line-height: normal !important;
        font-size: 14px;
    }

    .sb-input-group .input-group-text,
    .sb-input-group .sb-pass-toggle {
        width: 40px;
        min-width: 40px;
    }

    .sb-input-group i{
        font-size:14px;
    }

    :root[data-theme='dark'] .sb-input-group:focus-within {
        border-color: #c08a57;
        box-shadow: 0 0 0 0.2rem rgba(192, 138, 87, 0.22);
    }

    :root[data-theme='dark'] .sb-input-group .form-control::placeholder {
        color: #caa887;
    }

    :root[data-theme='dark'] .sb-divider {
        color: #d6b28d;
    }

    :root[data-theme='dark'] .sb-divider::before,
    :root[data-theme='dark'] .sb-divider::after {
        border-top-color: rgba(167, 119, 73, 0.4);
    }

    :root[data-theme='dark'] .sb-google-btn {
        background: linear-gradient(180deg, rgba(58, 37, 22, 0.95) 0%, rgba(44, 28, 17, 0.95) 100%);
        border-color: #8c603b;
        color: #f0d2b3;
    }

    :root[data-theme='dark'] .sb-login-features {
        background: rgba(54, 35, 22, 0.8);
        border-color: rgba(167, 119, 73, 0.42);
    }

    :root[data-theme='dark'] .sb-login-features li,
    :root[data-theme='dark'] .sb-login-features i {
        color: #efcead;
    }

    @media (max-width: 991.98px) {
        .auth-grid {
            max-width: 100%;
        }

        .auth-grid-login {
            max-width: 415px;
        }
    }

    @media (max-width: 991.98px) {
        .auth-page-bg {
            background-attachment: scroll;
        }

        .auth-page-bg-login::before {
            filter: blur(2px) saturate(90%) contrast(1.06);
        }
    }

    @media (max-width: 575.98px) {
        .sb-login-form .sb-input-group {
            width: 100%;
        }
    }

    @keyframes authCardFadeIn {
        from {
            opacity: 0;
            transform: translateY(16px) scale(0.985);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes authDustFloat {
        from {
            transform: translateY(0) translateX(0);
            opacity: 0.55;
        }
        to {
            transform: translateY(-10px) translateX(8px);
            opacity: 0.75;
        }
    }
</style>
