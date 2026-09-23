<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Elige tu avatar | Ponte Pilas</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #f7fbff 0%,
                    #ffffff 100%
                );

            color: #17324d;
        }

        /*
        |--------------------------------------------------------------------------
        | NAVBAR
        |--------------------------------------------------------------------------
        */

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;

            height: 74px;

            background: #ffffff;

            display: flex;
            align-items: center;

            padding: 0 6%;

            box-shadow:
                0 3px 15px rgba(0, 0, 0, 0.08);

            z-index: 1000;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 12px;

            text-decoration: none;

            color: #0878d1;

            font-size: 21px;
            font-weight: 800;
        }

        .navbar-logo img {
            width: 42px;
            height: 42px;

            object-fit: contain;
        }


        /*
        |--------------------------------------------------------------------------
        | CONTENEDOR
        |--------------------------------------------------------------------------
        */

        .container {
            width: 92%;
            max-width: 1150px;

            margin: 0 auto;

            padding-top: 120px;
            padding-bottom: 60px;
        }


        /*
        |--------------------------------------------------------------------------
        | ENCABEZADO
        |--------------------------------------------------------------------------
        */

        .header {
            text-align: center;

            margin-bottom: 35px;
        }

        .header-icon {
            width: 70px;
            height: 70px;

            margin: 0 auto 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #e8f5ff;

            color: #0878d1;

            font-size: 32px;
        }

        .header h1 {
            font-size: 34px;

            color: #12304a;

            margin-bottom: 10px;
        }

        .header p {
            color: #6d7f8f;

            font-size: 16px;
        }


        /*
        |--------------------------------------------------------------------------
        | AVATARES
        |--------------------------------------------------------------------------
        */

        .avatars-grid {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 22px;
        }


        .avatar-card {
            position: relative;

            background: white;

            border: 2px solid #e2ebf3;

            border-radius: 22px;

            padding: 15px;

            cursor: pointer;

            text-align: center;

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;

            overflow: hidden;
        }

        .avatar-card:hover {
            transform: translateY(-6px);

            border-color: #0878d1;

            box-shadow:
                0 12px 30px
                rgba(8, 120, 209, .15);
        }


        /*
        |--------------------------------------------------------------------------
        | RADIO OCULTO
        |--------------------------------------------------------------------------
        */

        .avatar-card input {
            position: absolute;

            opacity: 0;

            pointer-events: none;
        }


        /*
        |--------------------------------------------------------------------------
        | IMAGEN
        |--------------------------------------------------------------------------
        */

        .avatar-image {
            width: 100%;
            height: 250px;

            display: flex;

            align-items: flex-end;

            justify-content: center;

            border-radius: 16px;

            background:
                linear-gradient(
                    180deg,
                    #eef8ff 0%,
                    #ffffff 100%
                );

            overflow: hidden;
        }

        .avatar-image img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            transition:
                transform .3s ease;
        }

        .avatar-card:hover
        .avatar-image img {
            transform: scale(1.05);
        }


        /*
        |--------------------------------------------------------------------------
        | NOMBRE
        |--------------------------------------------------------------------------
        */

        .avatar-name {
            display: block;

            margin-top: 13px;

            font-size: 18px;

            font-weight: 700;

            color: #253f54;
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK
        |--------------------------------------------------------------------------
        */

        .check {
            position: absolute;

            top: 14px;
            right: 14px;

            width: 36px;
            height: 36px;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #0878d1;

            color: white;

            font-size: 20px;

            opacity: 0;

            transform: scale(.5);

            transition:
                opacity .2s ease,
                transform .2s ease;
        }


        /*
        |--------------------------------------------------------------------------
        | AVATAR SELECCIONADO
        |--------------------------------------------------------------------------
        */

        .avatar-card:has(input:checked) {
            border-color: #0878d1;

            background: #f3faff;

            box-shadow:
                0 12px 35px
                rgba(8, 120, 209, .20);
        }

        .avatar-card:has(input:checked)
        .check {
            opacity: 1;

            transform: scale(1);
        }

        .avatar-card:has(input:checked)
        .avatar-name {
            color: #0878d1;
        }


        /*
        |--------------------------------------------------------------------------
        | BOTONES
        |--------------------------------------------------------------------------
        */

        .actions {
            display: flex;

            justify-content: center;

            gap: 15px;

            margin-top: 35px;
        }

        .btn {
            border: none;

            padding: 14px 25px;

            border-radius: 12px;

            font-size: 16px;

            font-weight: 700;

            cursor: pointer;

            text-decoration: none;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            transition: .2s ease;
        }

        .btn-back {
            background: #edf2f7;

            color: #425466;
        }

        .btn-back:hover {
            background: #e2e8f0;
        }

        .btn-primary {
            background: #0878d1;

            color: white;

            box-shadow:
                0 6px 18px
                rgba(8, 120, 209, .22);
        }

        .btn-primary:hover {
            background: #0567b5;

            transform: translateY(-2px);
        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 900px) {

            .avatars-grid {
                grid-template-columns:
                    repeat(3, 1fr);
            }

        }


        @media (max-width: 650px) {

            .avatars-grid {
                grid-template-columns:
                    repeat(2, 1fr);

                gap: 12px;
            }

            .avatar-image {
                height: 190px;
            }

            .header h1 {
                font-size: 28px;
            }

        }


        @media (max-width: 420px) {

            .container {
                width: 94%;
            }

            .avatar-image {
                height: 160px;
            }

            .avatar-name {
                font-size: 15px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

        }

    </style>
</head>


<body>

    <!-- NAVBAR -->

    <nav class="navbar">

        <a href="{{ route('registro') }}"
            class="navbar-logo">

            <img
                src="{{ asset('build/img/logo.png') }}"
                alt="Ponte Pilas">

            <span>PONTE PILAS</span>

        </a>

    </nav>


    <!-- CONTENIDO -->

    <main class="container">

        <div class="header">

            <div class="header-icon">

                <i class="bi bi-person-bounding-box"></i>

            </div>

            <h1>Elige tu avatar</h1>

            <p>
                Selecciona el personaje que te acompañará
                en tu experiencia de Ponte Pilas.
            </p>

        </div>


        <!-- FORMULARIO -->

        <form
            action="{{ route('avatar.guardar') }}"
            method="POST">

            @csrf


            <div class="avatars-grid">

                @foreach($avatares as $avatar)

                    <label class="avatar-card">

                        <input
                            type="radio"
                            name="avatar_id"
                            value="{{ $avatar->id }}"
                            {{ $avatarSeleccionado == $avatar->id ? 'checked' : '' }}
                        >

                        <div class="avatar-image">

                            <img
                                src="{{ asset('build/img/avatares/' . $avatar->imagen) }}"
                                alt="{{ $avatar->nombre }}"
                            >

                        </div>

                        <span class="avatar-name">
                            {{ $avatar->nombre }}
                        </span>

                        <div class="check">

                            <i class="bi bi-check-lg"></i>

                        </div>

                    </label>

                @endforeach

            </div>


            @error('avatar_id')

                <div style="
                    text-align:center;
                    color:#dc3545;
                    margin-top:20px;
                    font-weight:600;
                ">

                    <i class="bi bi-exclamation-circle"></i>

                    {{ $message }}

                </div>

            @enderror


            <!-- BOTONES -->

            <div class="actions">

                <a
                    href="{{ route('registro') }}"
                    class="btn btn-back">

                    <i class="bi bi-arrow-left"></i>

                    Volver

                </a>


                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-check-circle"></i>

                    Seleccionar avatar

                </button>

            </div>

        </form>

    </main>

</body>

</html>