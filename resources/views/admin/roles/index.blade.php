@extends('admin.layouts.app')

@section('title', 'Roles y permisos')

@section('page-title', 'Roles y permisos')

@section('content')

<style>

    /* =========================================================
       ENCABEZADO
    ========================================================= */

    .roles-wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }

    .roles-header {
        margin-bottom: 25px;
    }

    .roles-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #8a94a6;
        font-size: 13px;
        margin-bottom: 10px;
    }

    .roles-breadcrumb a {
        color: #6c757d;
        text-decoration: none;
    }

    .roles-breadcrumb a:hover {
        color: #0d6efd;
    }

    .roles-breadcrumb i {
        font-size: 11px;
    }

    .roles-title {
        font-size: 27px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .roles-description {
        color: #7b8494;
        font-size: 14px;
        margin: 5px 0 0;
    }


    /* =========================================================
       ALERTA
    ========================================================= */

    .success-alert {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .04);
    }


    /* =========================================================
       SELECTOR DE ROL
    ========================================================= */

    .role-selector-card {
        background: #ffffff;
        border: 1px solid #e7ebef;
        border-radius: 18px;
        padding: 22px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .035);
    }

    .role-selector-label {
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 8px;
    }

    .role-select {
        min-height: 46px;
        border: 1px solid #dfe4ea;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .role-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .08);
    }

    .role-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .role-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: #eef4ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .role-info-title {
        font-size: 15px;
        font-weight: 700;
        color: #252b33;
    }

    .role-info-text {
        color: #8a94a6;
        font-size: 12px;
        margin-top: 2px;
    }


    /* =========================================================
       TARJETA DE PERMISOS
    ========================================================= */

    .permissions-card {
        background: #ffffff;
        border: 1px solid #e7ebef;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .035);
    }

    .permissions-header {
        padding: 22px 24px;
        border-bottom: 1px solid #edf0f3;
        background: #fbfcfe;
    }

    .permissions-title {
        font-size: 16px;
        font-weight: 700;
        color: #252b33;
        margin: 0;
    }

    .permissions-description {
        color: #8a94a6;
        font-size: 12px;
        margin: 3px 0 0;
    }


    /* =========================================================
       GRUPOS
    ========================================================= */

    .permission-group {
        border-bottom: 1px solid #edf0f3;
    }

    .permission-group:last-child {
        border-bottom: 0;
    }

    .permission-group-header {
        padding: 18px 24px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .permission-group-name {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        text-transform: capitalize;
    }

    .permission-group-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #f1f5f9;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .permission-count {
        color: #98a1ae;
        font-size: 11px;
        font-weight: 600;
    }


    /* =========================================================
       PERMISOS
    ========================================================= */

    .permissions-list {
        padding: 0 24px 20px;
    }

    .permission-item {
        border: 1px solid #edf0f3;
        border-radius: 11px;
        padding: 13px 15px;
        margin-bottom: 8px;
        transition: all .15s ease;
    }

    .permission-item:last-child {
        margin-bottom: 0;
    }

    .permission-item:hover {
        background: #fafcff;
        border-color: #dce5ef;
    }

    .permission-item.active {
        background: #f8fbff;
        border-color: #cfe0f8;
    }

    .permission-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .permission-checkbox {
        width: 19px;
        height: 19px;
        cursor: pointer;
        flex-shrink: 0;
    }

    .permission-checkbox:focus {
        box-shadow: none;
    }

    .permission-text {
        cursor: pointer;
        flex: 1;
    }

    .permission-name {
        color: #374151;
        font-size: 13px;
        font-weight: 650;
        margin-bottom: 2px;
    }

    .permission-slug {
        color: #9aa4b2;
        font-size: 10px;
        font-family: monospace;
    }

    .permission-description {
        color: #8a94a6;
        font-size: 11px;
        margin-top: 2px;
    }


    /* =========================================================
       BOTÓN GUARDAR
    ========================================================= */

    .permissions-footer {
        padding: 20px 24px;
        border-top: 1px solid #edf0f3;
        background: #fbfcfe;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .selected-info {
        color: #8a94a6;
        font-size: 12px;
    }

    .selected-info strong {
        color: #495057;
    }

    .btn-save-permissions {
        border-radius: 10px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 650;
        box-shadow: 0 5px 14px rgba(13, 110, 253, .14);
    }


    /* =========================================================
       ESTADO VACÍO
    ========================================================= */

    .empty-permissions {
        padding: 60px 20px;
        text-align: center;
        color: #8a94a6;
    }

    .empty-permissions i {
        font-size: 35px;
        margin-bottom: 12px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .roles-title {
            font-size: 23px;
        }

        .role-selector-card {
            padding: 18px;
        }

        .permissions-header {
            padding: 18px;
        }

        .permission-group-header {
            padding: 16px 18px;
        }

        .permissions-list {
            padding: 0 18px 18px;
        }

        .permissions-footer {
            padding: 18px;
            display: block;
        }

        .selected-info {
            margin-bottom: 12px;
        }

        .btn-save-permissions {
            width: 100%;
        }

    }

</style>


<div class="roles-wrapper">


    {{-- =====================================================
         ENCABEZADO
    ====================================================== --}}

    <div class="roles-header">

        <div class="roles-breadcrumb">

            <a href="{{ route('admin') }}">
                Panel administrativo
            </a>

            <i class="bi bi-chevron-right"></i>

            <span>
                Roles y permisos
            </span>

        </div>


        <h1 class="roles-title">
            Roles y permisos
        </h1>

        <p class="roles-description">
            Administra los permisos disponibles para cada tipo de usuario.
        </p>

    </div>


    {{-- =====================================================
         MENSAJE
    ====================================================== --}}

    @if(session('success'))

        <div class="alert alert-success success-alert mb-4">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- =====================================================
         SELECTOR DE ROL
    ====================================================== --}}

    <div class="role-selector-card">

        <div class="row align-items-end g-3">

            <div class="col-lg-7">

                <div class="role-info">

                    <div class="role-icon">

                        <i class="bi bi-shield-lock"></i>

                    </div>

                    <div>

                        <div class="role-info-title">
                            Selecciona un rol
                        </div>

                        <div class="role-info-text">
                            Los permisos que marques pertenecerán al rol seleccionado.
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-5">

                <label
                    for="rolSelector"
                    class="role-selector-label"
                >
                    Rol
                </label>

                <select
                    id="rolSelector"
                    class="form-select role-select"
                >

                    @foreach($roles as $rol)

                        <option
                            value="{{ $rol->id }}"
                        >
                            {{ $rol->nombre }}
                        </option>

                    @endforeach

                </select>

            </div>

        </div>

    </div>


    {{-- =====================================================
         PERMISOS
    ====================================================== --}}

    <div class="permissions-card">

        <div class="permissions-header">

            <h5 class="permissions-title">
                Permisos del rol
            </h5>

            <p class="permissions-description">
                Selecciona las funciones que podrán utilizar los usuarios con este rol.
            </p>

        </div>


        @if($roles->count())


            @foreach($roles as $rol)

                <div
                    class="role-permissions-panel"
                    data-role="{{ $rol->id }}"
                    style="{{ $loop->first ? '' : 'display:none;' }}"
                >

                    @php

                        $grupos = $permisos->groupBy(function ($permiso) {

                            return explode(
                                '.',
                                $permiso->slug
                            )[0] ?? 'otros';

                        });

                    @endphp


                    @foreach($grupos as $grupo => $permisosGrupo)

                        <div class="permission-group">


                            {{-- CABECERA DEL GRUPO --}}

                            <div class="permission-group-header">

                                <div class="permission-group-name">

                                    <div class="permission-group-icon">

                                        @if($grupo === 'usuarios')

                                            <i class="bi bi-people"></i>

                                        @elseif($grupo === 'contenidos')

                                            <i class="bi bi-file-earmark-text"></i>

                                        @elseif($grupo === 'quizzes')

                                            <i class="bi bi-question-circle"></i>

                                        @elseif($grupo === 'reportes')

                                            <i class="bi bi-bar-chart"></i>

                                        @elseif($grupo === 'certificados')

                                            <i class="bi bi-award"></i>

                                        @else

                                            <i class="bi bi-shield"></i>

                                        @endif

                                    </div>

                                    {{ $grupo }}

                                </div>


                                <span class="permission-count">

                                    {{ $permisosGrupo->count() }}
                                    permisos

                                </span>

                            </div>


                            {{-- LISTADO --}}

                            <div class="permissions-list">

                                @foreach($permisosGrupo as $permiso)

                                    @php

                                        $tienePermiso =
                                            $rol->permisos
                                                ->contains(
                                                    'id',
                                                    $permiso->id
                                                );

                                    @endphp


                                    <div
                                        class="permission-item {{ $tienePermiso ? 'active' : '' }}"
                                    >

                                        <div class="permission-content">


                                            <input
                                                type="checkbox"
                                                class="form-check-input permission-checkbox"
                                                name="permisos[]"
                                                value="{{ $permiso->id }}"
                                                id="permiso_{{ $rol->id }}_{{ $permiso->id }}"
                                                data-permission
                                                {{ $tienePermiso ? 'checked' : '' }}
                                            >


                                            <label
                                                for="permiso_{{ $rol->id }}_{{ $permiso->id }}"
                                                class="permission-text"
                                            >

                                                <div class="permission-name">

                                                    {{ $permiso->nombre }}

                                                </div>


                                                <div class="permission-slug">

                                                    {{ $permiso->slug }}

                                                </div>


                                                @if($permiso->descripcion)

                                                    <div class="permission-description">

                                                        {{ $permiso->descripcion }}

                                                    </div>

                                                @endif

                                            </label>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endforeach


                    {{-- FORMULARIO DE GUARDADO --}}

                    <form
                        action="{{ route('admin.roles.permisos.update', $rol) }}"
                        method="POST"
                        class="permission-form"
                    >

                        @csrf

                        @method('PUT')


                        {{-- Los checkbox se copian aquí mediante JS --}}

                        <div class="permission-hidden-fields"></div>

                    </form>

                </div>

            @endforeach


        @else

            <div class="empty-permissions">

                <i class="bi bi-shield-x d-block"></i>

                No hay roles configurados.

            </div>

        @endif


        {{-- =================================================
             FOOTER
        ================================================== --}}

        @if($roles->count())

            <div class="permissions-footer">

                <div class="selected-info">

                    <i class="bi bi-check2-square me-1"></i>

                    Permisos seleccionados:

                    <strong id="selectedCount">
                        0
                    </strong>

                </div>


                <button
                    type="button"
                    class="btn btn-primary btn-save-permissions"
                    id="savePermissions"
                >

                    <i class="bi bi-check-lg me-1"></i>

                    Guardar permisos

                </button>

            </div>

        @endif

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const selector =
        document.getElementById('rolSelector');

    const panels =
        document.querySelectorAll('.role-permissions-panel');

    const saveButton =
        document.getElementById('savePermissions');

    const selectedCount =
        document.getElementById('selectedCount');


    /*
    |--------------------------------------------------------------------------
    | MOSTRAR PANEL DEL ROL
    |--------------------------------------------------------------------------
    */

    function mostrarRol(rolId) {

        panels.forEach(function (panel) {

            if (
                panel.dataset.role ===
                rolId
            ) {

                panel.style.display = '';

            } else {

                panel.style.display = 'none';

            }

        });

        actualizarContador();

    }


    /*
    |--------------------------------------------------------------------------
    | CONTADOR
    |--------------------------------------------------------------------------
    */

    function actualizarContador() {

        const panelActivo =
            document.querySelector(
                '.role-permissions-panel[style=""]'
            ) ||
            document.querySelector(
                '.role-permissions-panel:not([style*="display: none"])'
            );


        if (!panelActivo) {

            selectedCount.textContent = '0';

            return;

        }


        const seleccionados =
            panelActivo.querySelectorAll(
                '[data-permission]:checked'
            );


        selectedCount.textContent =
            seleccionados.length;

    }


    /*
    |--------------------------------------------------------------------------
    | CAMBIO DE ROL
    |--------------------------------------------------------------------------
    */

    selector.addEventListener(
        'change',
        function () {

            mostrarRol(this.value);

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CAMBIO DE CHECKBOX
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll(
        '[data-permission]'
    ).forEach(function (checkbox) {

        checkbox.addEventListener(
            'change',
            function () {

                const item =
                    this.closest(
                        '.permission-item'
                    );


                if (this.checked) {

                    item.classList.add(
                        'active'
                    );

                } else {

                    item.classList.remove(
                        'active'
                    );

                }


                actualizarContador();

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | GUARDAR
    |--------------------------------------------------------------------------
    */

    saveButton.addEventListener(
        'click',
        function () {

            const rolId =
                selector.value;


            const panel =
                document.querySelector(
                    '.role-permissions-panel[data-role="' +
                    rolId +
                    '"]'
                );


            const form =
                panel.querySelector(
                    '.permission-form'
                );


            const hiddenFields =
                form.querySelector(
                    '.permission-hidden-fields'
                );


            hiddenFields.innerHTML = '';


            const seleccionados =
                panel.querySelectorAll(
                    '[data-permission]:checked'
                );


            seleccionados.forEach(
                function (checkbox) {

                    const input =
                        document.createElement(
                            'input'
                        );

                    input.type = 'hidden';

                    input.name =
                        'permisos[]';

                    input.value =
                        checkbox.value;

                    hiddenFields.appendChild(
                        input
                    );

                }
            );


            form.submit();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | INICIALIZAR
    |--------------------------------------------------------------------------
    */

    mostrarRol(selector.value);

});

</script>

@endsection