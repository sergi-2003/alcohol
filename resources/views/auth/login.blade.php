<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Iniciar sesión | MI DECISIÓN</title>

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f8fb;
            color: #243b53;
            min-height: 100vh;
        }

        /* =================================================
           NAVBAR
        ================================================== */

        .navbar {
            width: 100%;
            height: 72px;
            background: #ffffff;
            border-bottom: 1px solid #e8edf2;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 6%;

            position: fixed;
            top: 0;
            left: 0;

            z-index: 1000;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
            object-fit: contain;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .navbar-menu a {
            text-decoration: none;
            color: #486581;
            font-size: 14px;
            font-weight: 600;

            transition: .2s ease;
        }

        .navbar-menu a:hover {
            color: #1d72b8;
        }

        /* =================================================
           CONTENEDOR PRINCIPAL
        ================================================== */

        .page-container {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 110px 20px 50px;
        }

        /* =================================================
           TARJETA LOGIN
        ================================================== */

        .login-card {
            width: 100%;
            max-width: 440px;

            background: #ffffff;

            border-radius: 18px;

            padding: 38px;

            border: 1px solid #e5ebf0;

            box-shadow:
                0 15px 40px rgba(23, 43, 77, .08);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-icon {
            width: 65px;
            height: 65px;

            margin: 0 auto 18px;

            border-radius: 50%;

            background: #eaf4fb;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #1d72b8;

            font-size: 28px;
        }

        .login-header h1 {
            font-size: 27px;
            margin-bottom: 8px;
            color: #172b4d;
        }

        .login-header p {
            color: #7b8794;
            font-size: 14px;
            line-height: 1.5;
        }

        /* =================================================
           ERRORES
        ================================================== */

        .error-box {
            display: flex;
            align-items: center;
            gap: 10px;

            background: #fff4f4;

            border: 1px solid #f5c2c2;

            color: #b42318;

            padding: 12px 14px;

            border-radius: 9px;

            margin-bottom: 20px;

            font-size: 13px;

            line-height: 1.4;
        }

        .error-box i {
            font-size: 17px;
        }

        /* =================================================
           FORMULARIO
        ================================================== */

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            font-size: 13px;

            font-weight: 700;

            color: #334e68;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;

            left: 14px;
            top: 50%;

            transform: translateY(-50%);

            color: #829ab1;

            font-size: 17px;

            pointer-events: none;
        }

        .form-control {
            width: 100%;

            min-height: 50px;

            border: 1px solid #d9e2ec;

            border-radius: 10px;

            background: #ffffff;

            color: #243b53;

            padding: 0 15px 0 43px;

            font-size: 14px;

            outline: none;

            transition: .2s ease;
        }

        .form-control:focus {
            border-color: #1d72b8;

            box-shadow: 0 0 0 3px rgba(29, 114, 184, .10);
        }

        /* =================================================
           OPCIONES
        ================================================== */

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 24px;

            gap: 15px;
        }

        .remember {
            display: flex;
            align-items: center;

            gap: 8px;

            font-size: 13px;

            color: #627d98;
        }

        .remember input {
            width: 15px;
            height: 15px;

            accent-color: #1d72b8;
        }

        .forgot-password {
            text-decoration: none;

            color: #1d72b8;

            font-size: 13px;

            font-weight: 600;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* =================================================
           BOTÓN LOGIN
        ================================================== */

        .btn-login {
            width: 100%;

            min-height: 50px;

            border: none;

            border-radius: 10px;

            background: #1d72b8;

            color: #ffffff;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            transition: .2s ease;
        }

        .btn-login:hover {
            background: #155d91;

            transform: translateY(-1px);

            box-shadow:
                0 7px 16px rgba(29, 114, 184, .20);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            font-size: 17px;
        }

        /* =================================================
           GOOGLE
        ================================================== */

        .google-divider {
            display: flex;

            align-items: center;

            gap: 12px;

            margin: 22px 0 16px;

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

        .btn-google {
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

        .btn-google i {
            font-size: 17px;
        }

        .btn-google:hover {
            background: #f8fafc;

            border-color: #b9c9d8;

            color: #172b4d;

            transform: translateY(-1px);

            box-shadow:
                0 6px 15px rgba(23, 43, 77, .08);
        }

        .btn-google:active {
            transform: translateY(0);
        }

        /* =================================================
           SEGURIDAD
        ================================================== */

        .security-box {
            margin-top: 25px;

            padding: 14px;

            background: #f7fafc;

            border: 1px solid #e6edf3;

            border-radius: 10px;

            display: flex;

            align-items: flex-start;

            gap: 10px;

            color: #627d98;

            font-size: 12px;

            line-height: 1.5;
        }

        .security-box i {
            color: #1d72b8;

            font-size: 17px;

            margin-top: 1px;
        }

        /* =================================================
           FOOTER
        ================================================== */

        .footer {
            text-align: center;

            margin-top: 25px;

            color: #9aa8b7;

            font-size: 11px;

            line-height: 1.5;
        }

        /* =================================================
           RESPONSIVE
        ================================================== */

        @media (max-width: 700px) {

            .navbar {
                padding: 0 20px;
            }

            .navbar-menu {
                display: none;
            }

            .login-card {
                padding: 28px 22px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }

    </style>
</head>

<body>


<!-- =====================================================
     NAVBAR
====================================================== -->

<nav class="navbar">

    <a
        href="{{ route('home') }}"
        class="navbar-brand"
    >

        <img
            src="{{ asset('build/img/logo.WebP') }}"
            alt="MI DECISIÓN"
        >

    </a>


    <div class="navbar-menu">

        <a href="{{ route('home') }}">
            Inicio
        </a>

        <a href="{{ route('registro') }}">
            Participar
        </a>

         <a href="{{ route('registro') }}">
            Registrate
        </a>

        <a href="{{ route('login') }}">
            Iniciar sesión
        </a>

    </div>

</nav>


<!-- =====================================================
     CONTENIDO
====================================================== -->

<main class="page-container">


    <div class="login-card">


        <!-- =================================================
             ENCABEZADO
        ================================================== -->

        <div class="login-header">

            <div class="login-icon">

                <i class="bi bi-person-lock"></i>

            </div>

            <h1>
                Iniciar sesión
            </h1>

            <p>
                Ingresa a tu cuenta para administrar
                la plataforma MI DECISIÓN.
            </p>

        </div>


        <!-- =================================================
             ERRORES
        ================================================== -->

        @if ($errors->any())

            <div class="error-box">

                <i class="bi bi-exclamation-circle"></i>

                <span>
                    {{ $errors->first() }}
                </span>

            </div>

        @endif


        <!-- =================================================
             FORMULARIO LOGIN
        ================================================== -->

        <form
            method="POST"
            action="{{ route('login.submit') }}"
        >

            @csrf


            <!-- =================================================
                 EMAIL
            ================================================== -->

            <div class="form-group">

                <label for="email">
                    Correo electrónico
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-envelope"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@pontepillas.com"
                        autocomplete="email"
                        maxlength="255"
                        required
                        autofocus
                        class="form-control"
                    >

                </div>

            </div>


            <!-- =================================================
                 CONTRASEÑA
            ================================================== -->

            <div class="form-group">

                <label for="password">
                    Contraseña
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-lock"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Ingresa tu contraseña"
                        autocomplete="current-password"
                        required
                        class="form-control"
                    >

                </div>

            </div>


            <!-- =================================================
                 RECORDAR / RECUPERAR
            ================================================== -->

            <div class="form-options">

                <label class="remember">

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    <span>
                        Recordarme
                    </span>

                </label>


                <a
                    href="#"
                    class="forgot-password"
                >
                    ¿Olvidaste tu contraseña?
                </a>

            </div>


            <!-- =================================================
                 BOTÓN LOGIN
            ================================================== -->

            <button
                type="submit"
                class="btn-login"
            >

                <i class="bi bi-box-arrow-in-right"></i>

                <span>
                    Iniciar sesión
                </span>

            </button>


        </form>


        <!-- =================================================
             LOGIN CON GOOGLE
        ================================================== -->

        <div class="google-divider">

            <span>
                o continúa con
            </span>

        </div>


        <a
            href="{{ route('google.login') }}"
            class="btn-google"
        >

            <i class="bi bi-google"></i>

            <span>
                Continuar con Google
            </span>

        </a>


        <!-- =================================================
             SEGURIDAD
        ================================================== -->

        <div class="security-box">

            <i class="bi bi-shield-lock"></i>

            <span>
                Tu información de acceso se mantiene
                protegida mediante mecanismos de seguridad
                de la plataforma.
            </span>

        </div>


        <!-- =================================================
             FOOTER
        ================================================== -->

        <div class="footer">

            MI DECISIÓN © {{ date('Y') }}

            <br>

            Plataforma educativa y de prevención.

        </div>


    </div>

</main>


</body>
</html>