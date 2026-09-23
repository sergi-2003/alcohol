<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Registro | MI DECISIÓN</title>


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =====================================================
           VARIABLES
        ===================================================== */

        :root {

            --blue: #087df0;

            --blue-dark: #0568d0;

            --blue-light: #eef7ff;

            --gold: #e5a900;

            --text: #172b4d;

            --text-light: #718096;

            --border: #e1e8ef;

        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            font-family:
                Inter,
                "Segoe UI",
                Arial,
                Helvetica,
                sans-serif;

            min-height: 100vh;

            background: #ffffff;

            color: var(--text);

        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .navbar {

            position: fixed;

            top: 0;
            left: 0;

            width: 100%;

            height: 78px;

            background: #ffffff;

            border-bottom:
                1px solid #edf1f5;

            box-shadow:
                0 3px 18px
                rgba(23,43,77,.05);

            display: flex;

            align-items: center;

            z-index: 1000;

        }


        .nav-container {

            width: 100%;

            max-width: 1200px;

            margin: auto;

            padding:
                0 25px;

            display: flex;

            align-items: center;

            justify-content: space-between;

        }


        /* =====================================================
           LOGO
        ===================================================== */

        .nav-brand {

            display: flex;

            align-items: center;

            text-decoration: none;

        }


        .nav-brand img {

            width: 155px;

            height: 58px;

            object-fit: contain;

        }


        /* =====================================================
           MENU
        ===================================================== */

        .nav-menu {

            list-style: none;

            display: flex;

            align-items: center;

            gap: 5px;

        }


        .nav-menu a {

            display: flex;

            align-items: center;

            gap: 7px;

            text-decoration: none;

            color: #52667a;

            font-size: 14px;

            font-weight: 600;

            padding:
                10px 13px;

            border-radius: 9px;

            transition:
                all .2s ease;

        }


        .nav-menu a i {

            font-size: 15px;

        }


        .nav-menu a:hover {

            color: var(--blue);

            background: #f5f9fd;

        }


        /* =====================================================
           BOTÓN LOGIN
        ===================================================== */

        .nav-login {

            color: #ffffff !important;

            background: var(--blue);

            padding:
                10px 18px !important;

            border-radius:
                9px !important;

        }


        .nav-login:hover {

            color: #ffffff !important;

            background:
                var(--blue-dark) !important;

        }


        /* =====================================================
           BOTÓN REGISTRO ACTIVO
        ===================================================== */

        .nav-register {

            color:
                var(--blue) !important;

            background:
                var(--blue-light);

            border:
                1px solid #dceeff;

        }


        /* =====================================================
           PAGE
        ===================================================== */

        .page {

            min-height: 100vh;

            padding-top: 78px;

            display: flex;

            justify-content: center;

            align-items: center;

            background: #ffffff;

        }


        /* =====================================================
           CONTENIDO
        ===================================================== */

        .content {

            width: 100%;

            max-width: 650px;

            padding:
                45px 20px;

        }


        /* =====================================================
           HEADER
        ===================================================== */

        .header {

            text-align: center;

            margin-bottom: 28px;

        }


        .header-mark {

            width: 52px;

            height: 52px;

            margin:
                0 auto 17px;

            border-radius: 14px;

            background:
                var(--blue-light);

            border:
                1px solid #dceeff;

            display: flex;

            align-items: center;

            justify-content: center;

            color:
                var(--blue);

        }


        .header-mark i {

            font-size: 22px;

        }


        .header h1 {

            font-size: 30px;

            font-weight: 800;

            color: var(--text);

            margin-bottom: 8px;

        }


        .header p {

            color: var(--text-light);

            font-size: 14px;

            line-height: 1.6;

            max-width: 500px;

            margin: auto;

        }


        .header p strong {

            color: var(--blue);

        }


        .gold-line {

            width: 38px;

            height: 3px;

            border-radius: 20px;

            background: var(--gold);

            margin:
                13px auto 0;

        }


        /* =====================================================
           CARD
        ===================================================== */

        .register-card {

            background: #ffffff;

            border:
                1px solid var(--border);

            border-radius: 18px;

            padding: 30px;

            box-shadow:
                0 12px 35px
                rgba(23,43,77,.07);

        }


        /* =====================================================
           FORM GRID
        ===================================================== */

        .form-grid {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap:
                18px;

        }


        .form-group {

            margin-bottom: 2px;

        }


        .full {

            grid-column:
                1 / -1;

        }

        .avatar-section {
    margin-top: 30px;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.section-title > i {
    font-size: 26px;
    color: #0878d1;
}

.section-title h3 {
    margin: 0;
    font-size: 20px;
    color: #12304a;
}

.section-title p {
    margin: 4px 0 0;
    color: #718096;
    font-size: 14px;
}

.avatars-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

.avatar-card {
    position: relative;
    cursor: pointer;
    border: 2px solid #e5edf5;
    border-radius: 18px;
    padding: 12px;
    background: #fff;
    text-align: center;
    transition: all 0.25s ease;
}

.avatar-card input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.avatar-card:hover {
    border-color: #0878d1;
    transform: translateY(-4px);
    box-shadow: 0 8px 22px rgba(8, 120, 209, 0.12);
}

.avatar-image {
    width: 100%;
    height: 190px;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    overflow: hidden;
    border-radius: 14px;
    background: linear-gradient(180deg, #f3f9ff 0%, #ffffff 100%);
}

.avatar-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.avatar-card span {
    display: block;
    margin-top: 10px;
    font-weight: 700;
    color: #263b4d;
}

.selected-check {
    position: absolute;
    top: 10px;
    right: 10px;

    width: 30px;
    height: 30px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;
    background: #0878d1;
    color: white;

    opacity: 0;
    transform: scale(0.6);
    transition: all 0.2s ease;
}

/* Avatar seleccionado */

.avatar-card:has(input:checked) {
    border-color: #0878d1;
    background: #f4faff;
    box-shadow: 0 8px 25px rgba(8, 120, 209, 0.18);
}

.avatar-card:has(input:checked) .selected-check {
    opacity: 1;
    transform: scale(1);
}

.avatar-card:has(input:checked) span {
    color: #0878d1;
}

.avatar-selector {
    margin-top: 30px;

    padding: 22px;

    border: 1px solid #e2ebf3;

    border-radius: 18px;

    background: #f9fcff;
}

.avatar-selector-title {
    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 18px;
}

.avatar-selector-title > i {
    font-size: 28px;

    color: #0878d1;
}

.avatar-selector-title h3 {
    margin: 0;

    color: #12304a;

    font-size: 20px;
}

.avatar-selector-title p {
    margin: 4px 0 0;

    color: #718096;

    font-size: 14px;
}

.no-avatar {
    display: flex;

    align-items: center;

    gap: 12px;

    padding: 15px;

    border-radius: 12px;

    background: white;

    border: 1px dashed #ccd9e5;

    color: #718096;

    margin-bottom: 15px;
}

.no-avatar i {
    font-size: 25px;

    color: #9aaabd;
}

.avatar-selected {
    display: flex;

    align-items: center;

    gap: 15px;

    background: white;

    border: 2px solid #0878d1;

    border-radius: 14px;

    padding: 10px 15px;

    margin-bottom: 15px;
}

.avatar-selected img {
    width: 65px;

    height: 65px;

    object-fit: contain;
}

.avatar-selected div {
    display: flex;

    flex-direction: column;

    gap: 4px;
}

.avatar-selected strong {
    color: #0878d1;

    font-size: 17px;
}

.avatar-selected span {
    color: #718096;

    font-size: 13px;
}

.btn-avatar {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 12px 20px;

    background: #0878d1;

    color: white;

    text-decoration: none;

    border-radius: 10px;

    font-weight: 700;

    transition: .2s ease;
}

.btn-avatar:hover {
    background: #0567b5;

    transform: translateY(-2px);
}

/* Responsive */

@media (max-width: 900px) {

    .avatars-grid {
        grid-template-columns: repeat(3, 1fr);
    }

}

@media (max-width: 650px) {

    .avatars-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .avatar-image {
        height: 170px;
    }

}

@media (max-width: 420px) {

    .avatars-grid {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .avatar-image {
        height: 145px;
    }

}

        /* =====================================================
           LABEL
        ===================================================== */

        .form-group label {

            display: block;

            margin-bottom: 7px;

            color: #334e68;

            font-size: 13px;

            font-weight: 700;

        }


        .optional {

            color:
                #9aa8b7;

            font-weight:
                400;

        }


        /* =====================================================
           INPUT
        ===================================================== */

        .input-wrapper {

            position: relative;

        }


        .input-wrapper i {

            position: absolute;

            left: 14px;

            top: 50%;

            transform:
                translateY(-50%);

            color:
                #8a9bad;

            font-size: 16px;

            pointer-events:
                none;

            transition:
                .2s ease;

        }


        .input-wrapper input,
        .input-wrapper select {

            width: 100%;

            height: 50px;

            border:
                1px solid #dce3ea;

            border-radius: 10px;

            padding:
                0 14px 0 43px;

            outline: none;

            background: #ffffff;

            color: #243b53;

            font-size: 14px;

            transition:
                all .2s ease;

        }


        .input-wrapper select {

            cursor: pointer;

        }


        .input-wrapper input:hover,
        .input-wrapper select:hover {

            border-color:
                #b9c9d8;

        }


        .input-wrapper input:focus,
        .input-wrapper select:focus {

            border-color:
                var(--blue);

            box-shadow:
                0 0 0 3px
                rgba(8,125,240,.08);

        }


        .input-wrapper input:focus ~ i,
        .input-wrapper select:focus ~ i {

            color:
                var(--blue);

        }


        .input-wrapper input::placeholder {

            color:
                #a0acb8;

        }


        /* =====================================================
           AVATAR
        ===================================================== */

        .avatar-section {

            margin-top:
                22px;

            padding-top:
                22px;

            border-top:
                1px solid #edf1f5;

        }


        .section-title {

            font-size:
                14px;

            font-weight:
                700;

            color:
                #334e68;

            margin-bottom:
                12px;

        }


        .section-title span {

            color:
                #9aa8b7;

            font-size:
                12px;

            font-weight:
                400;

        }


        .avatars {

            display:
                grid;

            grid-template-columns:
                repeat(6, 1fr);

            gap:
                10px;

        }


        .avatar-option {

            position:
                relative;

        }


        .avatar-option input {

            position:
                absolute;

            opacity:
                0;

            pointer-events:
                none;

        }


        .avatar-option label {

            height:
                62px;

            border:
                1px solid #e1e8ef;

            border-radius:
                12px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            cursor:
                pointer;

            color:
                #60758a;

            background:
                #ffffff;

            transition:
                .2s ease;

            font-size:
                13px;

        }


        .avatar-option label i {

            font-size:
                23px;

        }


        .avatar-option label:hover {

            border-color:
                #b8d8f5;

            background:
                #f7fbff;

        }


        .avatar-option input:checked + label {

            border:
                2px solid var(--blue);

            background:
                var(--blue-light);

            color:
                var(--blue);

        }


        /* =====================================================
           ANÓNIMO
        ===================================================== */

        .anonymous-box {

            margin-top:
                22px;

            padding:
                15px;

            border:
                1px solid #e6edf3;

            border-radius:
                12px;

            background:
                #fafcfe;

        }


        .anonymous-label {

            display:
                flex;

            align-items:
                flex-start;

            gap:
                11px;

            cursor:
                pointer;

        }


        .anonymous-label input {

            width:
                17px;

            height:
                17px;

            margin-top:
                2px;

            accent-color:
                var(--blue);

            flex-shrink:
                0;

        }


        .anonymous-text strong {

            display:
                block;

            color:
                #334e68;

            font-size:
                13px;

            margin-bottom:
                3px;

        }


        .anonymous-text span {

            display:
                block;

            color:
                #7b8794;

            font-size:
                11px;

            line-height:
                1.5;

        }


        /* =====================================================
           CONSENTIMIENTO
        ===================================================== */

        .consent {

            margin-top:
                17px;

        }


        .consent-label {

            display:
                flex;

            align-items:
                flex-start;

            gap:
                9px;

            cursor:
                pointer;

        }


        .consent-label input {

            width:
                16px;

            height:
                16px;

            margin-top:
                2px;

            accent-color:
                var(--blue);

            flex-shrink:
                0;

        }


        .consent-label span {

            color:
                #718096;

            font-size:
                11px;

            line-height:
                1.5;

        }


        .consent-label a {

            color:
                var(--blue);

            text-decoration:
                none;

        }


        .consent-label a:hover {

            text-decoration:
                underline;

        }


        /* =====================================================
           BOTÓN
        ===================================================== */

        .btn-register {

            width:
                100%;

            height:
                51px;

            border:
                none;

            border-radius:
                10px;

            margin-top:
                22px;

            background:
                var(--blue);

            color:
                #ffffff;

            font-size:
                14px;

            font-weight:
                700;

            cursor:
                pointer;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                9px;

            transition:
                all .2s ease;

        }


        .btn-register i {

            font-size:
                16px;

        }


        .btn-register:hover {

            background:
                var(--blue-dark);

            transform:
                translateY(-1px);

            box-shadow:
                0 8px 18px
                rgba(8,125,240,.18);

        }


        .btn-register:active {

            transform:
                translateY(0);

        }


        /* =====================================================
           LOGIN LINK
        ===================================================== */

        .login-link {

            text-align:
                center;

            margin-top:
                19px;

            font-size:
                12px;

            color:
                #7b8794;

        }


        .login-link a {

            color:
                var(--blue);

            text-decoration:
                none;

            font-weight:
                700;

        }


        .login-link a:hover {

            text-decoration:
                underline;

        }


        /* =====================================================
           ERROR
        ===================================================== */

        .error-box {

            display:
                flex;

            align-items:
                flex-start;

            gap:
                10px;

            padding:
                12px 14px;

            margin-bottom:
                20px;

            border-radius:
                10px;

            background:
                #fff5f5;

            border:
                1px solid #ffd4d4;

            color:
                #b42318;

            font-size:
                13px;

            line-height:
                1.5;

        }


        .error-box i {

            font-size:
                16px;

            flex-shrink:
                0;

        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {

            text-align:
                center;

            margin-top:
                25px;

            color:
                #9aa8b7;

            font-size:
                11px;

            line-height:
                1.7;

        }


        .footer-brand {

            color:
                #334e68;

            font-weight:
                800;

            font-size:
                12px;

        }


        .footer-accent {

            color:
                var(--gold);

            font-weight:
                700;

        }


        .footer-links {

            margin-top:
                7px;

            display:
                flex;

            justify-content:
                center;

            gap:
                15px;

        }


        .footer-links a {

            color:
                #8a98a8;

            text-decoration:
                none;

        }


        .footer-links a:hover {

            color:
                var(--blue);

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 700px) {

            .nav-menu a span {

                display:
                    none;

            }


            .nav-menu a {

                padding:
                    10px;

            }


            .nav-menu .nav-login span,
            .nav-menu .nav-register span {

                display:
                    inline;

            }


            .content {

                padding:
                    35px 15px;

            }


            .form-grid {

                grid-template-columns:
                    1fr;

            }


            .full {

                grid-column:
                    auto;

            }


            .avatars {

                grid-template-columns:
                    repeat(3, 1fr);

            }

        }


        @media (max-width: 500px) {

            .navbar {

                height:
                    68px;

            }


            .nav-container {

                padding:
                    0 15px;

            }


            .nav-brand img {

                width:
                    130px;

                    height:
                    52px;

            }


            .nav-menu li:not(:last-child) {

                display:
                    none;

            }


            .page {

                padding-top:
                    68px;

                align-items:
                    flex-start;

            }


            .content {

                padding:
                    30px 12px;

            }


            .header h1 {

                font-size:
                    27px;

            }


            .register-card {

                padding:
                    24px 20px;

                border-radius:
                    15px;

            }


            .avatars {

                grid-template-columns:
                    repeat(3, 1fr);

            }

        }


        @media (max-width: 360px) {

            .register-card {

                padding:
                    22px 17px;

            }


            .avatar-option label {

                height:
                    55px;

            }

        }


        /* =====================================================
           MODAL DE AVATARES
        ===================================================== */

        .avatar-modal {
            position: fixed;
            inset: 0;
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 25px;
            background: rgba(23, 43, 77, .58);
            backdrop-filter: blur(5px);
        }

        .avatar-modal.active {
            display: flex;
        }

        .avatar-modal-content {
            width: min(1050px, 100%);
            max-height: 90vh;
            overflow-y: auto;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 25px 70px rgba(23, 43, 77, .25);
            padding: 28px;
            animation: avatarModalIn .2s ease;
        }

        @keyframes avatarModalIn {
            from {
                opacity: 0;
                transform: translateY(12px) scale(.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .avatar-modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .avatar-modal-header h2 {
            margin: 0 0 6px;
            color: #172b4d;
            font-size: 26px;
            font-weight: 800;
        }

        .avatar-modal-header p {
            margin: 0;
            color: #718096;
            font-size: 14px;
        }

        .modal-close {
            width: 42px;
            height: 42px;
            border: 1px solid #e1e8ef;
            border-radius: 12px;
            background: #f7f9fc;
            color: #52667a;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s ease;
            flex-shrink: 0;
        }

        .modal-close:hover {
            background: #eef7ff;
            color: #087df0;
            border-color: #cfe7ff;
        }

        .avatar-modal-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 16px;
        }

        .avatar-modal-grid .avatar-option {
            position: relative;
            width: 100%;
            padding: 0;
            border: 2px solid #e1e8ef;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            color: #172b4d;
            cursor: pointer;
            text-align: center;
            transition: .2s ease;
            font-family: inherit;
        }

        .avatar-modal-grid .avatar-option:hover {
            border-color: #9dccf7;
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(8, 125, 240, .12);
        }

        .avatar-modal-grid .avatar-option.selected {
            border-color: #087df0;
            background: #f4faff;
            box-shadow: 0 8px 25px rgba(8, 125, 240, .18);
        }

        .avatar-option-image {
            width: 100%;
            height: 190px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            overflow: hidden;
            background: linear-gradient(180deg, #f3f9ff 0%, #ffffff 100%);
        }

        .avatar-option-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .avatar-modal-grid .avatar-option > span {
            display: block;
            padding: 11px 8px 13px;
            font-size: 14px;
            font-weight: 800;
            color: #263b4d;
        }

        .avatar-modal-grid .avatar-option.selected > span {
            color: #087df0;
        }

        .avatar-check {
            position: absolute;
            top: 9px;
            right: 9px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #087df0;
            color: #ffffff;
            opacity: 0;
            transform: scale(.7);
            transition: .2s ease;
        }

        .avatar-modal-grid .avatar-option.selected .avatar-check {
            opacity: 1;
            transform: scale(1);
        }

        .avatar-preview {
            margin-bottom: 15px;
        }

        .avatar-placeholder {
            min-height: 82px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 15px;
            border: 1px dashed #ccd9e5;
            border-radius: 12px;
            background: #ffffff;
            color: #718096;
        }

        .avatar-placeholder i {
            font-size: 34px;
            color: #9aaabd;
        }

        .avatar-selected-preview {
            min-height: 82px;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 8px 15px;
            border: 2px solid #087df0;
            border-radius: 14px;
            background: #ffffff;
        }

        .avatar-selected-preview img {
            width: 68px;
            height: 68px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .avatar-selected-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .avatar-selected-info strong {
            color: #087df0;
            font-size: 17px;
        }

        .avatar-selected-info span {
            color: #718096;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .avatar-modal-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        @media (max-width: 650px) {
            .avatar-modal {
                padding: 12px;
            }

            .avatar-modal-content {
                max-height: 94vh;
                padding: 20px;
                border-radius: 18px;
            }

            .avatar-modal-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 10px;
            }

            .avatar-option-image {
                height: 145px;
            }

            .avatar-modal-header h2 {
                font-size: 22px;
            }
        }

        @media (max-width: 430px) {
            .avatar-modal-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .avatar-option-image {
                height: 155px;
            }
        }

    
        /* =====================================================
           GOOGLE - REGISTRO
        ===================================================== */

        .register-message {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            margin-bottom: 20px;
            border-radius: 12px;
            font-size: 14px;
            line-height: 1.5;
        }

        .register-message i {
            font-size: 18px;
            flex-shrink: 0;
        }

        .error-message {
            background: #fff5f5;
            border: 1px solid #ffd6d6;
            color: #a33a3a;
        }

        .google-message {
            background: #f5f9ff;
            border: 1px solid #dceaff;
            color: #31506f;
        }

        .google-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0 16px;
            color: #9aa8b7;
            font-size: 12px;
        }

        .google-divider::before,
        .google-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e8edf2;
        }

        .google-divider span {
            white-space: nowrap;
        }

        .btn-google-register {
            width: 100%;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid #dce3ea;
            border-radius: 10px;
            background: #ffffff;
            color: #243b53;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .btn-google-register i {
            font-size: 17px;
        }

        .btn-google-register:hover {
            background: #f8fafc;
            border-color: #b9c9d8;
            color: #172b4d;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(23,43,77,.08);
        }

        .btn-google-register:active {
            transform: translateY(0);
        }

        .google-info {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #f8fafc;
            border: 1px solid #e8edf2;
            color: #718096;
            font-size: 12px;
            line-height: 1.5;
        }

        .google-info i {
            color: #087df0;
            font-size: 15px;
            flex-shrink: 0;
        }

        .input-wrapper input[readonly] {
            background: #f5f7fa;
            color: #52667a;
            cursor: not-allowed;
        }

        .input-wrapper input[readonly]:focus {
            border-color: #dce3ea;
            box-shadow: none;
        }

    </style>

</head>


<body>


    <!-- =====================================================
         NAVBAR
    ====================================================== -->

    <nav class="navbar">

        <div class="nav-container">


            <!-- LOGO -->

            <a
                href="{{ route('home') }}"
                class="nav-brand"
            >

                <img
                    src="{{ asset('build/img/logo.WebP') }}"
                    alt="MI DECISIÓN"
                >

            </a>


            <!-- MENU -->

            <ul class="nav-menu">


                <li>

                    <a href="{{ route('home') }}">

                        <i class="bi bi-house"></i>

                        <span>
                            Inicio
                        </span>

                    </a>

                </li>


                <li>

                    <a href="#">

                        <i class="bi bi-info-circle"></i>

                        <span>
                            Sobre el proyecto
                        </span>

                    </a>

                </li>


                <li>

                    <a href="#">

                        <i class="bi bi-book"></i>

                        <span>
                            Recursos
                        </span>

                    </a>

                </li>


                <li>

                    <a
                        href="{{ route('login') }}"
                        class="nav-login"
                    >

                        <i class="bi bi-box-arrow-in-right"></i>

                        <span>
                            Iniciar sesión
                        </span>

                    </a>

                </li>


                <li>

                    <a
                        href="{{ route('registro') }}"
                        class="nav-register"
                    >

                        <i class="bi bi-person-plus"></i>

                        <span>
                            Registrarse
                        </span>

                    </a>

                </li>


            </ul>


        </div>

    </nav>



    <!-- =====================================================
         PAGE
    ====================================================== -->

    <main class="page">


        <div class="content">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <header class="header">


                <div class="header-mark">

                    <i class="bi bi-person-plus"></i>

                </div>


                <h1>
                    Crear registro
                </h1>


                <p>

                    Completa tus datos para participar
                    en las actividades de

                    <strong>
                        MI DECISIÓN
                    </strong>.

                </p>


                <div class="gold-line"></div>


            </header>



            <!-- =================================================
                 CARD
            ================================================== -->

            <section class="register-card">


                <!-- ERRORES -->

                @if ($errors->any())

                    <div class="error-box">

                        <i class="bi bi-exclamation-circle"></i>

                        <div>

                            @foreach ($errors->all() as $error)

                                <div>
                                    {{ $error }}
                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif



                <!-- =================================================
                     FORMULARIO
                ================================================== -->

                @if ($errors->any())
                    <div class="register-message error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        <div>{{ $errors->first() }}</div>
                    </div>
                @endif

                @if (session('google_register_success'))
                    <div class="register-message google-message">
                        <i class="bi bi-google"></i>
                        <div>{{ session('google_register_success') }}</div>
                    </div>
                @endif

                @if (session('google_register'))
                    <div class="register-message google-message">
                        <i class="bi bi-google"></i>
                        <div>
                            <strong>Registro con Google</strong>
                            <br>
                            Tu nombre y correo fueron cargados desde Google.
                            Completa los demás datos y selecciona tu avatar para finalizar.
                        </div>
                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('registro.submit') }}"
                >

                    @csrf


                    <div class="form-grid">


                        <!-- NOMBRE -->

                        <div class="form-group full">

                            <label for="nombre_completo">

                                Nombre completo

                            </label>


                            <div class="input-wrapper">

                                <input
                                    type="text"
                                    id="nombre_completo"
                                    name="nombre_completo"
                                    value="{{ old('nombre_completo', session('google_register.nombre')) }}"
                                    placeholder="Escribe tu nombre completo"
                                    maxlength="150"
                                    autocomplete="name"
                                    required
                                >

                                <i class="bi bi-person"></i>

                            </div>

                        </div>



                        <!-- TIPO DOCUMENTO -->

                        <div class="form-group">

                            <label for="tipo_documento">

                                Tipo de documento

                            </label>


                            <div class="input-wrapper">

                                <select
                                    id="tipo_documento"
                                    name="tipo_documento"
                                >

                                    <option value="">
                                        Selecciona
                                    </option>

                                    <option
                                        value="TI"
                                        {{ old('tipo_documento') == 'TI' ? 'selected' : '' }}
                                    >
                                        Tarjeta de identidad
                                    </option>

                                    <option
                                        value="CC"
                                        {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}
                                    >
                                        Cédula de ciudadanía
                                    </option>

                                    <option
                                        value="CE"
                                        {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}
                                    >
                                        Cédula de extranjería
                                    </option>

                                </select>

                                <i class="bi bi-card-text"></i>

                            </div>

                        </div>



                        <!-- DOCUMENTO -->

                        <div class="form-group">

                            <label for="numero_documento">

                                Número de documento

                                <span class="optional">
                                    (opcional)
                                </span>

                            </label>


                            <div class="input-wrapper">

                                <input
                                    type="text"
                                    id="numero_documento"
                                    name="numero_documento"
                                    value="{{ old('numero_documento') }}"
                                    placeholder="Número"
                                    maxlength="30"
                                >

                                <i class="bi bi-credit-card"></i>

                            </div>

                        </div>



                        <!-- EDAD -->

                        <div class="form-group">

                            <label for="edad">

                                Edad

                            </label>


                            <div class="input-wrapper">

                                <input
                                    type="number"
                                    id="edad"
                                    name="edad"
                                    value="{{ old('edad') }}"
                                    min="1"
                                    max="120"
                                    placeholder="Edad"
                                    required
                                >

                                <i class="bi bi-calendar3"></i>

                            </div>

                        </div>



                        <!-- INSTITUCIÓN -->

                        <div class="form-group">

                            <label for="institucion">

                                Institución educativa

                                <span class="optional">
                                    (opcional)
                                </span>

                            </label>


                            <div class="input-wrapper">

                                <input
                                    type="text"
                                    id="institucion"
                                    name="institucion"
                                    value="{{ old('institucion') }}"
                                    placeholder="Nombre de la institución"
                                    maxlength="150"
                                >

                                <i class="bi bi-building"></i>

                            </div>

                        </div>



                        <!-- GRADO -->

                        <div class="form-group">

                            <label for="grado">

                                Grado

                                <span class="optional">
                                    (opcional)
                                </span>

                            </label>


                            <div class="input-wrapper">

                                <select
                                    id="grado"
                                    name="grado"
                                >

                                    <option value="">
                                        Selecciona
                                    </option>

                                    @for ($i = 1; $i <= 11; $i++)

                                        <option
                                            value="{{ $i }}"
                                            {{ old('grado') == $i ? 'selected' : '' }}
                                        >
                                            {{ $i }}°
                                        </option>

                                    @endfor

                                </select>

                                <i class="bi bi-mortarboard"></i>

                            </div>

                        </div>



                        <!-- CORREO -->

                        <div class="form-group">

                            <label for="correo">

                                Correo electrónico

                                <span class="optional">
                                    (opcional)
                                </span>

                            </label>


                            <div class="input-wrapper">

                                <input
                                    type="email"
                                    id="correo"
                                    name="correo"
                                    value="{{ old('correo', session('google_register.correo')) }}"
                                    placeholder="correo@ejemplo.com"
                                    maxlength="150"
                                    autocomplete="email"
                                    @if(session('google_register')) readonly @endif
                                >

                                <i class="bi bi-envelope"></i>

                            </div>

                        </div>



                        <!-- TELEFONO -->

                        <div class="form-group">

                            <label for="telefono">

                                Teléfono

                                <span class="optional">
                                    (opcional)
                                </span>

                            </label>


                            <div class="input-wrapper">

                                <input
                                    type="tel"
                                    id="telefono"
                                    name="telefono"
                                    value="{{ old('telefono') }}"
                                    placeholder="Número de teléfono"
                                    maxlength="30"
                                    autocomplete="tel"
                                >

                                <i class="bi bi-telephone"></i>

                            </div>

                        </div>


                    </div>



          <!-- =================================================
     AVATAR
================================================= -->

<div class="avatar-selector">

    <div class="avatar-selector-header">

        <i class="bi bi-person-bounding-box"></i>

        <div>
            <h3>Tu avatar</h3>

            <p>
                Elige el personaje que te acompañará durante tu experiencia.
            </p>
        </div>

    </div>


    <!-- PREVISUALIZACIÓN -->

    <div id="avatar-preview" class="avatar-preview">

        <div class="avatar-placeholder">

            <i class="bi bi-person-circle"></i>

            <span>
                Todavía no has elegido un avatar
            </span>

        </div>

    </div>


    <!-- ID DEL AVATAR QUE SE ENVIARÁ AL CONTROLADOR -->

    <input
        type="hidden"
        name="avatar_id"
        id="avatar_id"
        value="{{ old('avatar_id') }}"
    >


    <!-- BOTÓN ÚNICO -->

    <button
        type="button"
        class="btn-avatar"
        onclick="abrirModalAvatares()"
    >

        <i class="bi bi-images"></i>

        <span id="avatar-button-text">
            Elige tu avatar
        </span>

    </button>

</div>


<!-- =================================================
     MODAL
================================================= -->

<div id="avatarModal" class="avatar-modal">

    <div class="avatar-modal-content">


        <!-- CABECERA -->

        <div class="avatar-modal-header">

            <div>

                <h2>
                    Elige tu avatar
                </h2>

                <p>
                    Selecciona el personaje que te acompañará.
                </p>

            </div>


            <button
                type="button"
                class="modal-close"
                onclick="cerrarModalAvatares()"
            >

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        <!-- AVATARES -->

        <div class="avatar-modal-grid">

            @foreach($avatares as $avatar)

                <button
                    type="button"
                    class="avatar-option"
                    data-id="{{ $avatar->id }}"
                    data-name="{{ $avatar->nombre }}"
                    data-image="{{ asset('build/img/' . $avatar->imagen) }}"
                    onclick="seleccionarAvatar(this)"
                >

                    <div class="avatar-option-image">

                        <img
                            src="{{ asset('build/img/' . $avatar->imagen) }}"
                            alt="{{ $avatar->nombre }}"
                        >

                    </div>


                    <span>
                        {{ $avatar->nombre }}
                    </span>


                    <div class="avatar-check">

                        <i class="bi bi-check-lg"></i>

                    </div>

                </button>

            @endforeach

        </div>

    </div>

</div>




                    <!-- =================================================
                         ANÓNIMO
                    ================================================== -->

                    <div class="anonymous-box">


                        <label class="anonymous-label">


                            <input
                                type="checkbox"
                                id="es_anonimo"
                                name="es_anonimo"
                                value="1"
                                {{ old('es_anonimo') ? 'checked' : '' }}
                            >


                            <span class="anonymous-text">

                                <strong>
                                    Participar de forma anónima
                                </strong>

                                <span>
                                    Puedes participar sin proporcionar
                                    información que permita identificarte.
                                </span>

                            </span>


                        </label>


                    </div>



                    <!-- =================================================
                         CONSENTIMIENTO
                    ================================================== -->

                    <div class="consent">


                        <label class="consent-label">


                            <input
                                type="checkbox"
                                name="acepta_datos"
                                value="1"
                                {{ old('acepta_datos') ? 'checked' : '' }}
                                required
                            >


                            <span>

                                Acepto el tratamiento de los datos
                                proporcionados para las finalidades
                                relacionadas con la plataforma
                                <a href="#">
                                    MI DECISIÓN
                                </a>.

                            </span>


                        </label>


                    </div>



                    <!-- =================================================
                         BOTÓN
                    ================================================== -->

                    <button
                        type="submit"
                        class="btn-register"
                    >

                        <i class="bi bi-person-check"></i>

                        Crear registro

                    </button>


                </form>



                <!-- =================================================
                     REGISTRO CON GOOGLE
                ================================================== -->

                <div class="google-divider">
                    <span>o regístrate con</span>
                </div>

                <a
                    href="{{ route('google.register') }}"
                    class="btn-google-register"
                >
                    <i class="bi bi-google"></i>
                    <span>Continuar con Google</span>
                </a>

                @if (session('google_register'))
                    <div class="google-info">
                        <i class="bi bi-info-circle"></i>
                        <span>
                            Estás realizando el registro con Google.
                            Tu correo se utilizará para completar este registro.
                        </span>
                    </div>
                @endif


                <!-- LOGIN -->

                <div class="login-link">

                    ¿Ya tienes una cuenta?

                    <a href="{{ route('login') }}">
                        Iniciar sesión
                    </a>

                </div>


            </section>



            <!-- =================================================
                 FOOTER
            ================================================== -->

            <footer class="footer">


                <div class="footer-brand">

                    MI DECISIÓN

                </div>


                Aprende · Decide · Avanza


                <br>


                <span class="footer-accent">

                    PONTE PILAS

                </span>

                · Una generación más consciente


                <div class="footer-links">

                    <a href="#">
                        Privacidad
                    </a>

                    <a href="#">
                        Términos
                    </a>

                    <a href="#">
                        Ayuda
                    </a>

                </div>


            </footer>


        </div>


    </main>


<script>
/*
    |--------------------------------------------------------------------------
    | ABRIR MODAL
    |--------------------------------------------------------------------------
    */

    function abrirModalAvatares() {

        const modal = document.getElementById('avatarModal');

        modal.classList.add('active');

        document.body.style.overflow = 'hidden';
    }


    /*
    |--------------------------------------------------------------------------
    | CERRAR MODAL
    |--------------------------------------------------------------------------
    */

    function cerrarModalAvatares() {

        const modal = document.getElementById('avatarModal');

        modal.classList.remove('active');

        document.body.style.overflow = '';
    }


    /*
    |--------------------------------------------------------------------------
    | SELECCIONAR AVATAR
    |--------------------------------------------------------------------------
    */

    function seleccionarAvatar(elemento) {

        const id = elemento.dataset.id;

        const nombre = elemento.dataset.name;

        const imagen = elemento.dataset.image;


        /*
        | Guardar ID en el formulario
        */

        document.getElementById('avatar_id').value = id;


        /*
        | Quitar selección anterior
        */

        document
            .querySelectorAll('.avatar-option')
            .forEach(function(option) {

                option.classList.remove('selected');

            });


        /*
        | Marcar avatar seleccionado
        */

        elemento.classList.add('selected');


        /*
        | Mostrar avatar seleccionado
        */

        const preview =
            document.getElementById('avatar-preview');


        preview.innerHTML = `

            <div class="avatar-selected-preview">

                <img
                    src="${imagen}"
                    alt="${nombre}"
                >

                <div class="avatar-selected-info">

                    <strong>
                        ${nombre}
                    </strong>

                    <span>
                        Avatar seleccionado
                    </span>

                </div>

            </div>

        `;


        /*
        | Cambiar texto del botón
        */

        document.getElementById(
            'avatar-button-text'
        ).textContent = 'Cambiar avatar';


        /*
        | Cerrar modal
        */

        cerrarModalAvatares();
    }


    /*
    |--------------------------------------------------------------------------
    | CERRAR HACIENDO CLICK FUERA
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('avatarModal')
        .addEventListener('click', function(event) {

            if (event.target === this) {

                cerrarModalAvatares();

            }

        });


    /*
    |--------------------------------------------------------------------------
    | CERRAR CON ESC
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            cerrarModalAvatares();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | RECUPERAR AVATAR DESPUÉS DE ERROR
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function() {

        const avatarId =
            document.getElementById('avatar_id').value;

        if (!avatarId) {
            return;
        }


        const avatar =
            document.querySelector(
                '.avatar-option[data-id="' + avatarId + '"]'
            );


        if (avatar) {

            seleccionarAvatar(avatar);

        }

    });
</script>
</body>

</html>