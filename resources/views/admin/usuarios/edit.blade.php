@extends('admin.layouts.app')

@section('title', 'Editar usuario')

@section('page-title', 'Editar usuario')

@section('content')

<style>

    /* =========================================================
       ENCABEZADO
    ========================================================= */

    .edit-header {
        margin-bottom: 28px;
    }

    .edit-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #8a94a6;
        font-size: 13px;
        margin-bottom: 10px;
    }

    .edit-breadcrumb a {
        color: #6c757d;
        text-decoration: none;
    }

    .edit-breadcrumb a:hover {
        color: #0d6efd;
    }

    .edit-breadcrumb i {
        font-size: 11px;
    }

    .edit-title {
        font-size: 27px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .edit-description {
        color: #7b8494;
        font-size: 14px;
        margin: 5px 0 0;
    }


    /* =========================================================
       CONTENEDOR
    ========================================================= */

    .edit-wrapper {
        max-width: 1100px;
        margin: 0 auto;
    }

    .edit-card {
        background: #ffffff;
        border: 1px solid #e7ebef;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(15, 23, 42, .045);
    }


    /* =========================================================
       PERFIL DEL USUARIO
    ========================================================= */

    .user-profile-header {
        padding: 25px 30px;
        background: #fbfcfe;
        border-bottom: 1px solid #edf0f3;
    }

    .user-big-avatar {
        width: 62px;
        height: 62px;
        min-width: 62px;
        border-radius: 16px;
        background: #eef4ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        font-weight: 700;
    }

    .profile-name {
        color: #252b33;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .profile-email {
        color: #7b8494;
        font-size: 13px;
    }

    .profile-id {
        color: #98a1ae;
        font-size: 11px;
        margin-top: 3px;
    }


    /* =========================================================
       ESTADO SUPERIOR
    ========================================================= */

    .current-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 650;
    }

    .current-status.active {
        background: #eaf8ef;
        color: #198754;
    }

    .current-status.inactive {
        background: #f1f3f5;
        color: #6c757d;
    }

    .current-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }


    /* =========================================================
       CUERPO
    ========================================================= */

    .edit-card-body {
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

    .field-icon .form-select {
        padding-left: 40px;
    }


    /* =========================================================
       CAMPOS BLOQUEADOS
    ========================================================= */

    .readonly-field {
        background: #f8f9fa !important;
        color: #6c757d !important;
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
        transition: all .2s ease;
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
       CONTRASEÑA
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
       ALERTA GOOGLE
    ========================================================= */

    .google-box {
        border: 1px solid #e4e7eb;
        background: #fafafa;
        border-radius: 12px;
        padding: 14px 16px;
        margin-top: 18px;
    }

    .google-box-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 700;
        color: #495057;
        margin-bottom: 4px;
    }

    .google-box-text {
        color: #8a94a6;
        font-size: 11px;
        margin: 0;
    }


    /* =========================================================
       FOOTER
    ========================================================= */

    .edit-footer {
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

    .btn-save {
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

        .edit-card-body {
            padding: 22px 18px;
        }

        .user-profile-header {
            padding: 20px 18px;
        }

        .edit-footer {
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

        .edit-title {
            font-size: 23px;
        }

        .current-status {
            margin-top: 15px;
        }

    }

</style>


<div class="edit-wrapper">


    {{-- =====================================================
         ENCABEZADO
    ====================================================== --}}

    <div class="edit-header">

        <div class="edit-breadcrumb">

            <a href="{{ route('admin') }}">
                Panel administrativo
            </a>

            <i class="bi bi-chevron-right"></i>

            <a href="{{ route('admin.usuarios.index') }}">
                Usuarios
            </a>

            <i class="bi bi-chevron-right"></i>

            <span>
                Editar usuario
            </span>

        </div>


        <h1 class="edit-title">
            Editar usuario
        </h1>

        <p class="edit-description">
            Actualiza la información, permisos o estado de esta cuenta.
        </p>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="validation-box">

            <div class="validation-title">

                <i class="bi bi-exclamation-triangle"></i>

                No se pudieron guardar los cambios

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
         TARJETA
    ====================================================== --}}

    <div class="edit-card">


        {{-- =================================================
             PERFIL ACTUAL
        ================================================== --}}

        <div class="user-profile-header">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div class="d-flex align-items-center gap-3">

                    <div class="user-big-avatar">

                        {{ strtoupper(substr($usuario->nombre, 0, 1)) }}

                    </div>


                    <div>

                        <div class="profile-name">

                            {{ $usuario->nombre }}

                        </div>

                        <div class="profile-email">

                            {{ $usuario->email }}

                        </div>

                        <div class="profile-id">

                            Usuario ID #{{ $usuario->id }}

                        </div>

                    </div>

                </div>


                @if($usuario->activo)

                    <div class="current-status active">

                        <span class="current-status-dot"></span>

                        Cuenta activa

                    </div>

                @else

                    <div class="current-status inactive">

                        <span class="current-status-dot"></span>

                        Cuenta inactiva

                    </div>

                @endif

            </div>

        </div>


        {{-- =================================================
             CUERPO
        ================================================== --}}

        <div class="edit-card-body">

            <form
                action="{{ route('admin.usuarios.update', $usuario) }}"
                method="POST"
                id="formEditarUsuario"
            >

                @csrf

                @method('PUT')


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
                                    value="{{ old('nombre', $usuario->nombre) }}"
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
                                    value="{{ old('email', $usuario->email) }}"
                                    maxlength="255"
                                    autocomplete="email"
                                    required
                                >

                            </div>

                            <small class="field-help">
                                Este correo se utilizará para iniciar sesión.
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
                                            {{ old('rol_id', $usuario->rol_id) == $rol->id ? 'selected' : '' }}
                                        >
                                            {{ $rol->nombre }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <small class="field-help">
                                El rol determina los permisos disponibles para esta cuenta.
                            </small>

                        </div>


                        {{-- ESTADO --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Estado de la cuenta
                            </label>

                            <div class="status-box">

                                <div class="status-info">

                                    <div
                                        class="status-icon"
                                        id="statusIcon"
                                    >

                                        @if($usuario->activo)

                                            <i class="bi bi-check-circle"></i>

                                        @else

                                            <i class="bi bi-dash-circle"></i>

                                        @endif

                                    </div>


                                    <div>

                                        <div
                                            class="status-title"
                                            id="statusTitle"
                                        >

                                            @if($usuario->activo)
                                                Usuario activo
                                            @else
                                                Usuario inactivo
                                            @endif

                                        </div>


                                        <div
                                            class="status-description"
                                            id="statusDescription"
                                        >

                                            @if($usuario->activo)
                                                Puede iniciar sesión en el sistema.
                                            @else
                                                No puede iniciar sesión en el sistema.
                                            @endif

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
                                        {{ old('activo', $usuario->activo) ? 'checked' : '' }}
                                    >

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     CONTRASEÑA
                ================================================== --}}

                <div class="form-section">

                    <div class="form-section-title">

                        <i class="bi bi-key"></i>

                        Seguridad

                    </div>


                    <div class="row g-4">


                        {{-- PASSWORD --}}

                        <div class="col-md-6">

                            <label
                                for="password"
                                class="form-label"
                            >
                                Nueva contraseña
                            </label>

                            <div class="password-wrapper">

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Dejar vacío para conservarla"
                                    minlength="8"
                                    autocomplete="new-password"
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
                                Solo completa este campo si deseas cambiar la contraseña.
                            </small>

                        </div>


                        {{-- CONFIRMAR PASSWORD --}}

                        <div class="col-md-6">

                            <label
                                for="password_confirmation"
                                class="form-label"
                            >
                                Confirmar nueva contraseña
                            </label>

                            <div class="password-wrapper">

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control"
                                    placeholder="Repite la nueva contraseña"
                                    minlength="8"
                                    autocomplete="new-password"
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
                                La contraseña actual se conservará si dejas estos campos vacíos.
                            </small>

                        </div>

                    </div>


                    {{-- SEGURIDAD --}}

                    <div class="security-box">

                        <div class="security-box-title">

                            <i class="bi bi-shield-check"></i>

                            Cambio de contraseña

                        </div>

                        <p class="security-box-text">

                            No es necesario introducir una contraseña para guardar
                            los demás cambios. Si introduces una nueva contraseña,
                            debe tener mínimo 8 caracteres y coincidir con la confirmación.

                        </p>

                    </div>


                    {{-- GOOGLE --}}

                    @if($usuario->google_id)

                        <div class="google-box">

                            <div class="google-box-title">

                                <i class="bi bi-google"></i>

                                Cuenta vinculada con Google

                            </div>

                            <p class="google-box-text">

                                Esta cuenta tiene una identificación de Google asociada.
                                El cambio de correo no modifica automáticamente dicha vinculación.

                            </p>

                        </div>

                    @endif

                </div>


            </form>

        </div>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="edit-footer">

            <p class="footer-note">

                <i class="bi bi-info-circle me-1"></i>

                Los cambios se aplicarán al guardar el formulario.

            </p>


            <div class="footer-actions">

                <a
                    href="{{ route('admin.usuarios.index') }}"
                    class="btn btn-cancel"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Cancelar

                </a>


                <button
                    type="submit"
                    form="formEditarUsuario"
                    class="btn btn-primary btn-save"
                    id="btnGuardarUsuario"
                >

                    <i class="bi bi-check-lg me-1"></i>

                    Guardar cambios

                </button>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /*
    |--------------------------------------------------------------------------
    | MOSTRAR / OCULTAR CONTRASEÑAS
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
    | VALIDACIÓN DE CONTRASEÑA
    |--------------------------------------------------------------------------
    */

    const password =
        document.getElementById('password');

    const confirmation =
        document.getElementById('password_confirmation');

    const passwordMatch =
        document.getElementById('passwordMatch');


    function validarPassword() {

        if (
            !password.value &&
            !confirmation.value
        ) {

            passwordMatch.textContent =
                'La contraseña actual se conservará si dejas estos campos vacíos.';

            passwordMatch.style.color =
                '#98a1ae';

            confirmation.classList.remove(
                'is-valid',
                'is-invalid'
            );

            return;

        }


        if (
            password.value &&
            password.value === confirmation.value
        ) {

            passwordMatch.textContent =
                'Las nuevas contraseñas coinciden.';

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
                'Las nuevas contraseñas no coinciden.';

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
    | ESTADO DE LA CUENTA
    |--------------------------------------------------------------------------
    */

    const activo =
        document.getElementById('activo');

    const statusTitle =
        document.getElementById('statusTitle');

    const statusDescription =
        document.getElementById('statusDescription');

    const statusIcon =
        document.getElementById('statusIcon');


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
                'No puede iniciar sesión en el sistema.';

            statusIcon.innerHTML =
                '<i class="bi bi-dash-circle"></i>';

        }

    });


    /*
    |--------------------------------------------------------------------------
    | VALIDAR FORMULARIO
    |--------------------------------------------------------------------------
    */

    const form =
        document.getElementById('formEditarUsuario');


    form.addEventListener('submit', function (event) {

        /*
        Si ambos campos están vacíos,
        se mantiene la contraseña actual.
        */

        if (
            !password.value &&
            !confirmation.value
        ) {

            return;

        }


        /*
        Si solamente se llenó uno,
        no permitimos enviar.
        */

        if (
            !password.value ||
            !confirmation.value
        ) {

            event.preventDefault();

            passwordMatch.textContent =
                'Debes completar ambos campos para cambiar la contraseña.';

            passwordMatch.style.color =
                '#dc3545';

            if (!password.value) {

                password.focus();

            } else {

                confirmation.focus();

            }

            return;

        }


        /*
        Las contraseñas deben coincidir.
        */

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
                'Las nuevas contraseñas no coinciden.';

            passwordMatch.style.color =
                '#dc3545';

        }

    });

});

</script>

@endsection