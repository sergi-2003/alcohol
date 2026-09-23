@extends('admin.layouts.app')

@section('title', 'Crear usuario')

@section('page-title', 'Crear usuario')

@section('content')

<style>

    /* =========================================================
       ENCABEZADO
    ========================================================= */

    .create-header {
        margin-bottom: 28px;
    }

    .create-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #8a94a6;
        font-size: 13px;
        margin-bottom: 10px;
    }

    .create-breadcrumb a {
        color: #6c757d;
        text-decoration: none;
    }

    .create-breadcrumb a:hover {
        color: #0d6efd;
    }

    .create-breadcrumb i {
        font-size: 11px;
    }

    .create-title {
        font-size: 27px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .create-description {
        color: #7b8494;
        font-size: 14px;
        margin: 5px 0 0;
    }


    /* =========================================================
       CONTENEDOR PRINCIPAL
    ========================================================= */

    .create-wrapper {
        max-width: 1100px;
        margin: 0 auto;
    }

    .create-card {
        background: #ffffff;
        border: 1px solid #e7ebef;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(15, 23, 42, .045);
    }


    /* =========================================================
       CABECERA DE LA TARJETA
    ========================================================= */

    .create-card-header {
        padding: 24px 28px;
        border-bottom: 1px solid #edf0f3;
        background: #fbfcfe;
    }

    .section-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        background: #eef4ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #252b33;
        margin: 0;
    }

    .section-description {
        color: #8a94a6;
        font-size: 12px;
        margin: 3px 0 0;
    }


    /* =========================================================
       FORMULARIO
    ========================================================= */

    .create-card-body {
        padding: 30px;
    }

    .form-section {
        margin-bottom: 32px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 20px;
    }

    .form-section-title i {
        color: #0d6efd;
        font-size: 16px;
    }

    .form-label {
        font-size: 13px;
        font-weight: 650;
        color: #374151;
        margin-bottom: 7px;
    }

    .required {
        color: #dc3545;
    }

    .form-control,
    .form-select {
        min-height: 45px;
        border: 1px solid #dfe4ea;
        border-radius: 10px;
        font-size: 14px;
        color: #374151;
        transition: all .15s ease;
    }

    .form-control::placeholder {
        color: #a5adb8;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .08);
    }

    .field-help {
        display: block;
        margin-top: 6px;
        color: #98a1ae;
        font-size: 11px;
    }

    .field-icon {
        position: relative;
    }

    .field-icon > i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9aa4b2;
        z-index: 2;
    }

    .field-icon .form-control {
        padding-left: 40px;
    }


    /* =========================================================
       CONTRASEÑAS
    ========================================================= */

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-control {
        padding-right: 45px;
    }

    .password-toggle {
        position: absolute;
        right: 7px;
        top: 50%;
        transform: translateY(-50%);
        width: 34px;
        height: 34px;
        border: 0;
        background: transparent;
        color: #8a94a6;
        border-radius: 8px;
    }

    .password-toggle:hover {
        background: #f1f3f5;
        color: #495057;
    }


    /* =========================================================
       ESTADO
    ========================================================= */

    .status-box {
        border: 1px solid #e2e7ec;
        border-radius: 12px;
        padding: 14px 16px;
        background: #fbfcfd;
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 68px;
    }

    .status-info {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .status-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eaf8ef;
        color: #198754;
    }

    .status-title {
        font-size: 13px;
        font-weight: 650;
        color: #374151;
        margin-bottom: 2px;
    }

    .status-description {
        color: #8a94a6;
        font-size: 11px;
    }

    .form-switch .form-check-input {
        width: 42px;
        height: 22px;
        cursor: pointer;
    }


    /* =========================================================
       INFORMACIÓN DE SEGURIDAD
    ========================================================= */

    .security-box {
        border: 1px solid #e4eaf2;
        background: #f8fbff;
        border-radius: 13px;
        padding: 16px 18px;
        margin-top: 20px;
    }

    .security-box-title {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #3f5f85;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .security-box-text {
        color: #718096;
        font-size: 12px;
        line-height: 1.6;
        margin: 0;
    }


    /* =========================================================
       ERRORES
    ========================================================= */

    .validation-box {
        border: 1px solid #f1b8be;
        background: #fff7f7;
        border-radius: 13px;
        padding: 16px 18px;
        margin-bottom: 25px;
    }

    .validation-title {
        color: #b02a37;
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 7px;
    }

    .validation-box ul {
        margin: 0;
        padding-left: 24px;
        color: #842029;
        font-size: 12px;
    }


    /* =========================================================
       FOOTER
    ========================================================= */

    .create-footer {
        padding: 20px 30px;
        background: #fbfcfe;
        border-top: 1px solid #edf0f3;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .footer-note {
        color: #98a1ae;
        font-size: 11px;
        margin: 0;
    }

    .footer-actions {
        display: flex;
        gap: 9px;
    }

    .btn-cancel {
        border: 1px solid #dfe4ea;
        background: #fff;
        color: #667085;
        border-radius: 10px;
        padding: 10px 17px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background: #f8f9fa;
        color: #495057;
    }

    .btn-create {
        border-radius: 10px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 650;
        box-shadow: 0 5px 14px rgba(13, 110, 253, .14);
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .create-card-body {
            padding: 22px 18px;
        }

        .create-card-header {
            padding: 20px 18px;
        }

        .create-footer {
            padding: 18px;
            display: block;
        }

        .footer-note {
            margin-bottom: 14px;
        }

        .footer-actions {
            width: 100%;
        }

        .footer-actions .btn {
            flex: 1;
        }

        .create-title {
            font-size: 23px;
        }

    }

</style>


<div class="create-wrapper">


    {{-- =====================================================
         ENCABEZADO
    ====================================================== --}}

    <div class="create-header">

        <div class="create-breadcrumb">

            <a href="{{ route('admin') }}">
                Panel administrativo
            </a>

            <i class="bi bi-chevron-right"></i>

            <a href="{{ route('admin.usuarios.index') }}">
                Usuarios
            </a>

            <i class="bi bi-chevron-right"></i>

            <span>
                Nuevo usuario
            </span>

        </div>


        <h1 class="create-title">
            Crear usuario
        </h1>

        <p class="create-description">
            Registra una nueva cuenta para administrar la plataforma.
        </p>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="validation-box">

            <div class="validation-title">

                <i class="bi bi-exclamation-triangle"></i>

                No se pudo completar el registro

            </div>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         TARJETA PRINCIPAL
    ====================================================== --}}

    <div class="create-card">


        {{-- CABECERA --}}

        <div class="create-card-header">

            <div class="d-flex align-items-center gap-3">

                <div class="section-icon">

                    <i class="bi bi-person-plus"></i>

                </div>

                <div>

                    <h5 class="section-title">
                        Información de la cuenta
                    </h5>

                    <p class="section-description">
                        Completa los datos necesarios para crear el usuario.
                    </p>

                </div>

            </div>

        </div>


        {{-- CUERPO --}}

        <div class="create-card-body">

            <form
                action="{{ route('admin.usuarios.store') }}"
                method="POST"
                id="formCrearUsuario"
            >

                @csrf


                {{-- =================================================
                     INFORMACIÓN PERSONAL
                ================================================== --}}

                <div class="form-section">

                    <div class="form-section-title">

                        <i class="bi bi-person"></i>

                        Información personal

                    </div>


                    <div class="row g-4">


                        {{-- NOMBRE --}}

                        <div class="col-md-6">

                            <label
                                for="nombre"
                                class="form-label"
                            >
                                Nombre completo
                                <span class="required">*</span>
                            </label>

                            <div class="field-icon">

                                <i class="bi bi-person"></i>

                                <input
                                    type="text"
                                    name="nombre"
                                    id="nombre"
                                    class="form-control"
                                    value="{{ old('nombre') }}"
                                    placeholder="Ej. Juan Pérez"
                                    maxlength="150"
                                    autocomplete="name"
                                    required
                                >

                            </div>

                            <small class="field-help">
                                Nombre que aparecerá dentro del panel administrativo.
                            </small>

                        </div>


                        {{-- CORREO --}}

                        <div class="col-md-6">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Correo electrónico
                                <span class="required">*</span>
                            </label>

                            <div class="field-icon">

                                <i class="bi bi-envelope"></i>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    placeholder="usuario@ejemplo.com"
                                    maxlength="255"
                                    autocomplete="email"
                                    required
                                >

                            </div>

                            <small class="field-help">
                                Se utilizará para iniciar sesión en el sistema.
                            </small>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ACCESO Y PERMISOS
                ================================================== --}}

                <div class="form-section">

                    <div class="form-section-title">

                        <i class="bi bi-shield-lock"></i>

                        Acceso y permisos

                    </div>


                    <div class="row g-4">


                        {{-- ROL --}}

                        <div class="col-md-6">

                            <label
                                for="rol_id"
                                class="form-label"
                            >
                                Rol del usuario
                                <span class="required">*</span>
                            </label>

                            <div class="field-icon">

                                <i class="bi bi-shield-check"></i>

                                <select
                                    name="rol_id"
                                    id="rol_id"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Selecciona un rol
                                    </option>

                                    @foreach($roles as $rol)

                                        <option
                                            value="{{ $rol->id }}"
                                            {{ old('rol_id') == $rol->id ? 'selected' : '' }}
                                        >
                                            {{ $rol->nombre }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <small class="field-help">
                                El rol determina las funciones que podrá administrar.
                            </small>

                        </div>


                        {{-- ESTADO --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Estado de la cuenta
                            </label>

                            <div class="status-box">

                                <div class="status-info">

                                    <div class="status-icon">

                                        <i class="bi bi-check-circle"></i>

                                    </div>

                                    <div>

                                        <div class="status-title">
                                            Usuario activo
                                        </div>

                                        <div class="status-description">
                                            Puede iniciar sesión en el sistema.
                                        </div>

                                    </div>

                                </div>


                                <div class="form-check form-switch mb-0">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        name="activo"
                                        value="1"
                                        id="activo"
                                        {{ old('activo', true) ? 'checked' : '' }}
                                    >

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     SEGURIDAD
                ================================================== --}}

                <div class="form-section">

                    <div class="form-section-title">

                        <i class="bi bi-key"></i>

                        Seguridad de la cuenta

                    </div>


                    <div class="row g-4">


                        {{-- PASSWORD --}}

                        <div class="col-md-6">

                            <label
                                for="password"
                                class="form-label"
                            >
                                Contraseña
                                <span class="required">*</span>
                            </label>

                            <div class="password-wrapper">

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Mínimo 8 caracteres"
                                    minlength="8"
                                    autocomplete="new-password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    data-target="password"
                                    aria-label="Mostrar contraseña"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>

                            </div>

                            <small class="field-help">
                                Utiliza una contraseña segura de mínimo 8 caracteres.
                            </small>

                        </div>


                        {{-- CONFIRMAR PASSWORD --}}

                        <div class="col-md-6">

                            <label
                                for="password_confirmation"
                                class="form-label"
                            >
                                Confirmar contraseña
                                <span class="required">*</span>
                            </label>

                            <div class="password-wrapper">

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control"
                                    placeholder="Repite la contraseña"
                                    minlength="8"
                                    autocomplete="new-password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    data-target="password_confirmation"
                                    aria-label="Mostrar contraseña"
                                >

                                    <i class="bi bi-eye"></i>

                                </button>

                            </div>

                            <small
                                class="field-help"
                                id="passwordMatch"
                            >
                                Confirma exactamente la misma contraseña.
                            </small>

                        </div>

                    </div>


                    {{-- AVISO DE SEGURIDAD --}}

                    <div class="security-box">

                        <div class="security-box-title">

                            <i class="bi bi-shield-check"></i>

                            Seguridad de la cuenta

                        </div>

                        <p class="security-box-text">

                            La contraseña se almacenará de forma segura y no será
                            visible para otros usuarios del sistema.

                        </p>

                    </div>

                </div>


            </form>

        </div>


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <div class="create-footer">

            <p class="footer-note">

                <i class="bi bi-info-circle me-1"></i>

                Los campos marcados con
                <span class="required">*</span>
                son obligatorios.

            </p>


            <div class="footer-actions">

                <a
                    href="{{ route('admin.usuarios.index') }}"
                    class="btn btn-cancel"
                >

                    <i class="bi bi-x-lg me-1"></i>

                    Cancelar

                </a>


                <button
                    type="submit"
                    form="formCrearUsuario"
                    class="btn btn-primary btn-create"
                    id="btnCrearUsuario"
                >

                    <i class="bi bi-person-plus me-1"></i>

                    Crear usuario

                </button>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | MOSTRAR / OCULTAR CONTRASEÑA
    |--------------------------------------------------------------------------
    */

    const passwordButtons =
        document.querySelectorAll('.password-toggle');

    passwordButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const targetId =
                this.getAttribute('data-target');

            const input =
                document.getElementById(targetId);

            const icon =
                this.querySelector('i');

            if (input.type === 'password') {

                input.type = 'text';

                icon.classList.remove('bi-eye');

                icon.classList.add('bi-eye-slash');

                this.setAttribute(
                    'aria-label',
                    'Ocultar contraseña'
                );

            } else {

                input.type = 'password';

                icon.classList.remove('bi-eye-slash');

                icon.classList.add('bi-eye');

                this.setAttribute(
                    'aria-label',
                    'Mostrar contraseña'
                );

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | VALIDAR CONTRASEÑAS
    |--------------------------------------------------------------------------
    */

    const password =
        document.getElementById('password');

    const confirmation =
        document.getElementById('password_confirmation');

    const passwordMatch =
        document.getElementById('passwordMatch');


    function validarPassword() {

        if (!confirmation.value) {

            passwordMatch.textContent =
                'Confirma exactamente la misma contraseña.';

            passwordMatch.style.color =
                '#98a1ae';

            confirmation.classList.remove(
                'is-valid',
                'is-invalid'
            );

            return;

        }


        if (password.value === confirmation.value) {

            passwordMatch.textContent =
                'Las contraseñas coinciden.';

            passwordMatch.style.color =
                '#198754';

            confirmation.classList.remove(
                'is-invalid'
            );

            confirmation.classList.add(
                'is-valid'
            );

        } else {

            passwordMatch.textContent =
                'Las contraseñas no coinciden.';

            passwordMatch.style.color =
                '#dc3545';

            confirmation.classList.remove(
                'is-valid'
            );

            confirmation.classList.add(
                'is-invalid'
            );

        }

    }


    password.addEventListener(
        'input',
        validarPassword
    );

    confirmation.addEventListener(
        'input',
        validarPassword
    );


    /*
    |--------------------------------------------------------------------------
    | EVITAR ENVÍO SI LAS CONTRASEÑAS NO COINCIDEN
    |--------------------------------------------------------------------------
    */

    const form =
        document.getElementById('formCrearUsuario');

    form.addEventListener('submit', function (event) {

        if (
            password.value !==
            confirmation.value
        ) {

            event.preventDefault();

            confirmation.focus();

            confirmation.classList.add(
                'is-invalid'
            );

            passwordMatch.textContent =
                'Las contraseñas no coinciden.';

            passwordMatch.style.color =
                '#dc3545';

        }

    });


    /*
    |--------------------------------------------------------------------------
    | CAMBIO VISUAL DEL ESTADO
    |--------------------------------------------------------------------------
    */

    const activo =
        document.getElementById('activo');

    const statusTitle =
        document.querySelector('.status-title');

    const statusDescription =
        document.querySelector('.status-description');

    const statusIcon =
        document.querySelector('.status-icon');


    activo.addEventListener('change', function () {

        if (this.checked) {

            statusTitle.textContent =
                'Usuario activo';

            statusDescription.textContent =
                'Puede iniciar sesión en el sistema.';

            statusIcon.innerHTML =
                '<i class="bi bi-check-circle"></i>';

        } else {

            statusTitle.textContent =
                'Usuario inactivo';

            statusDescription.textContent =
                'No podrá iniciar sesión en el sistema.';

            statusIcon.innerHTML =
                '<i class="bi bi-dash-circle"></i>';

        }

    });

});

</script>

@endsection