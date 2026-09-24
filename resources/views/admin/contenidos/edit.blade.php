@extends('admin.layouts.app')

@section('title', 'Editar contenido')
@section('page-title', 'Editar contenido')

@section('content')

<style>
    .content-editor {
        max-width: 1200px;
        margin: 0 auto;
    }

    .editor-title {
        background: #0d6efd;
        color: #fff;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 20px;
    }

    .editor-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .editor-card-header {
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        font-weight: 700;
    }

    .editor-card-body {
        padding: 20px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
    }

    .section-help {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: .88rem;
    }

    /*
    |--------------------------------------------------------------------------
    | IMAGEN PRINCIPAL
    |--------------------------------------------------------------------------
    */

    .main-image {
        width: 100%;
        max-height: 260px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        display: block;
    }

    /*
    |--------------------------------------------------------------------------
    | GALERÍA
    |--------------------------------------------------------------------------
    */

    .gallery-list,
    .new-images-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .gallery-item,
    .new-image {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        transition: .2s ease;
    }

    .gallery-item:hover,
    .new-image:hover {
        border-color: #b8d2f5;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .06);
    }

    .gallery-item.removing {
        opacity: .4;
        pointer-events: none;
    }

    .gallery-item img,
    .new-image img {
        width: 100%;
        height: 165px;
        object-fit: cover;
        display: block;
        background: #f1f5f9;
    }

    .gallery-body,
    .new-image-body {
        padding: 12px;
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD
    |--------------------------------------------------------------------------
    */

    .upload-box {
        border: 2px dashed #b8d2f5;
        border-radius: 12px;
        padding: 26px 18px;
        background: #f8fbff;
        text-align: center;
    }

    .upload-box-icon {
        width: 54px;
        height: 54px;
        margin: 0 auto 10px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e7f0ff;
        color: #0d6efd;
        font-size: 25px;
    }

    /*
    |--------------------------------------------------------------------------
    | NUEVAS IMÁGENES
    |--------------------------------------------------------------------------
    */

    .selected-images-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 18px;
        margin-bottom: 10px;
    }

    .new-image {
        margin-top: 0;
    }

    .new-image-body .file-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .position-select-wrap {
        margin-top: 10px;
    }

    .position-select-wrap label {
        font-size: .78rem;
        color: #64748b;
        margin-bottom: 4px;
        display: block;
    }

    .btn-remove-new,
    .gallery-delete {
        width: 100%;
        margin-top: 10px;
    }

    .empty-new-images {
        padding: 18px;
        border: 1px dashed #d7dee8;
        border-radius: 10px;
        background: #fafbfc;
        color: #64748b;
        text-align: center;
    }

    /*
    |--------------------------------------------------------------------------
    | ACCIONES
    |--------------------------------------------------------------------------
    */

    .sticky-actions {
        position: sticky;
        bottom: 15px;
        z-index: 10;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
    }

    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 992px) {

        .gallery-list,
        .new-images-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {

        .gallery-list,
        .new-images-grid {
            grid-template-columns: 1fr;
        }

        .editor-card-body {
            padding: 15px;
        }

        .editor-title {
            padding: 16px;
        }
    }
</style>


<div class="content-editor">

    {{-- =========================================================
         ENCABEZADO
    ========================================================== --}}

    <div class="editor-title">

        <div class="d-flex justify-content-between align-items-center gap-3">

            <div>

                <div class="small opacity-75 mb-1">
                    EDITOR DE CONTENIDO
                </div>

                <h3 class="mb-1">
                    {{ $contenido->titulo }}
                </h3>

                <div class="small opacity-75">
                    Modifica el texto, imágenes y configuración.
                </div>

            </div>

            <a
                href="{{ route('admin.contenidos.index') }}"
                class="btn btn-light"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Volver
            </a>

        </div>

    </div>


    {{-- =========================================================
         MENSAJES
    ========================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Revisa estos campos:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
         FORMULARIO PRINCIPAL
    ========================================================== --}}

    <form
        action="{{ route('admin.contenidos.update', $contenido) }}"
        method="POST"
        enctype="multipart/form-data"
        id="formEditarContenido"
    >

        @csrf

        @method('PUT')


        <div class="row g-4">


            {{-- =====================================================
                 COLUMNA PRINCIPAL
            ====================================================== --}}

            <div class="col-lg-8">


                {{-- =================================================
                     INFORMACIÓN
                ================================================== --}}

                <div class="editor-card">

                    <div class="editor-card-header">

                        <i class="bi bi-file-text text-primary me-2"></i>

                        Información educativa

                    </div>


                    <div class="editor-card-body">

                        {{-- TÍTULO --}}

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Título
                            </label>

                            <input
                                type="text"
                                name="titulo"
                                class="form-control"
                                value="{{ old('titulo', $contenido->titulo) }}"
                                required
                            >

                        </div>


                        {{-- CONTENIDO --}}

                        <div>

                            <label class="form-label fw-semibold">

                                Contenido educativo

                            </label>

                            <textarea
                                name="contenido"
                                id="contenido"
                                rows="18"
                                class="form-control"
                                placeholder="Escribe el contenido aquí..."
                                required
                            >{{ old('contenido', $contenido->contenido) }}</textarea>


                            <div class="section-help mt-2">

                                <i class="bi bi-info-circle text-primary me-1"></i>

                                Separa cada párrafo con una línea en blanco.

                                <strong>
                                    <span id="contadorParrafos">0</span>
                                    párrafos.
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     IMÁGENES
                ================================================== --}}

                <div class="editor-card">

                    <div class="editor-card-header d-flex justify-content-between align-items-center">

                        <span>

                            <i class="bi bi-images text-primary me-2"></i>

                            Imágenes

                        </span>


                        <span class="badge bg-primary">

                            <span id="numeroImagenes">
                                {{ $contenido->imagenes->count() }}
                            </span>

                            <span id="textoImagenes">

                                {{ $contenido->imagenes->count() == 1
                                    ? 'imagen'
                                    : 'imágenes'
                                }}

                            </span>

                        </span>

                    </div>


                    <div class="editor-card-body">


                        {{-- =================================================
                             IMAGEN PRINCIPAL
                        ================================================== --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Imagen principal

                            </label>


                            @if($contenido->imagen)

                                <img
                                    class="main-image mb-3"
                                    src="{{ route('media.contenido', [
                                        'filename' => basename($contenido->imagen)
                                    ]) }}"
                                    alt="{{ $contenido->titulo }}"
                                >

                            @endif


                            <input
                                type="file"
                                name="imagen"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >


                            <div class="form-text">

                                Opcional. Si seleccionas una imagen,
                                reemplazará la actual.

                            </div>

                        </div>


                        <hr>


                        {{-- =================================================
                             GALERÍA EXISTENTE
                        ================================================== --}}

                        <div class="mb-4">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div>

                                    <h6 class="mb-1 fw-bold">
                                        Imágenes actuales
                                    </h6>

                                    <small class="text-muted">

                                        Puedes cambiar su posición,
                                        reemplazarla o eliminarla.

                                    </small>

                                </div>

                            </div>


                            @if($contenido->imagenes->count() > 0)


                                <div
                                    class="gallery-list"
                                    id="galeriaImagenes"
                                >

                                    @foreach($contenido->imagenes as $imagen)

                                        @php

                                            $config = is_array($imagen->configuracion)
                                                ? $imagen->configuracion
                                                : [];

                                            $posicionGuardada = (string) (
                                                $config['posicion'] ?? 'final'
                                            );

                                            $textoContenido = trim(
                                                $contenido->contenido ?? ''
                                            );

                                            $parrafos = $textoContenido
                                                ? preg_split(
                                                    '/\n\s*\n/',
                                                    $textoContenido
                                                )
                                                : [];

                                            $cantidadParrafos = count(
                                                array_filter(
                                                    $parrafos,
                                                    fn($parrafo) =>
                                                        trim($parrafo) !== ''
                                                )
                                            );

                                        @endphp


                                        <div
                                            class="gallery-item"
                                            id="imagen-recurso-{{ $imagen->id }}"
                                        >


                                            {{-- IMAGEN --}}

                                            <img
                                                src="{{ route('media.recurso', [
                                                    'filename' => basename($imagen->ruta)
                                                ]) }}"
                                                alt="Imagen {{ $loop->iteration }}"
                                                id="preview-imagen-{{ $imagen->id }}"
                                            >


                                            <div class="gallery-body">


                                                {{-- ENCABEZADO --}}

                                                <div class="d-flex justify-content-between align-items-center mb-2">

                                                    <strong>

                                                        Imagen {{ $loop->iteration }}

                                                    </strong>


                                                    <span class="badge bg-light text-dark">

                                                        #{{ $imagen->orden }}

                                                    </span>

                                                </div>


                                                {{-- POSICIÓN --}}

                                                <div class="position-select-wrap">

                                                    <label>

                                                        <i class="bi bi-pin-angle me-1"></i>

                                                        Ubicación de la imagen

                                                    </label>


                                                    <select
                                                        name="imagenes_existentes_posiciones[{{ $imagen->id }}]"
                                                        class="form-select form-select-sm posicion-imagen-existente"
                                                        data-update-url="{{ route('admin.recursos.posicion', $imagen) }}"
                                                    >

                                                        {{-- INICIO --}}

                                                        <option
                                                            value="inicio"
                                                            {{ $posicionGuardada === 'inicio'
                                                                ? 'selected'
                                                                : ''
                                                            }}
                                                        >
                                                            Al inicio
                                                        </option>


                                                        {{-- PÁRRAFOS --}}

                                                        @for(
                                                            $numeroParrafo = 1;
                                                            $numeroParrafo <= $cantidadParrafos;
                                                            $numeroParrafo++
                                                        )

                                                            <option
                                                                value="{{ $numeroParrafo }}"
                                                                {{ $posicionGuardada === (string) $numeroParrafo
                                                                    ? 'selected'
                                                                    : ''
                                                                }}
                                                            >

                                                                Después del párrafo
                                                                {{ $numeroParrafo }}

                                                            </option>

                                                        @endfor


                                                        {{-- FINAL --}}

                                                        <option
                                                            value="final"
                                                            {{ $posicionGuardada === 'final'
                                                                ? 'selected'
                                                                : ''
                                                            }}
                                                        >

                                                            Al final

                                                        </option>

                                                    </select>

                                                </div>


                                                {{-- REEMPLAZAR IMAGEN --}}

                                                <div class="mt-3">

                                                    <label
                                                        for="reemplazar-imagen-{{ $imagen->id }}"
                                                        class="form-label small fw-semibold"
                                                    >

                                                        <i class="bi bi-arrow-repeat me-1"></i>

                                                        Cambiar imagen

                                                    </label>


                                                    <input
                                                        type="file"
                                                        name="imagenes_reemplazo[{{ $imagen->id }}]"
                                                        id="reemplazar-imagen-{{ $imagen->id }}"
                                                        class="form-control form-control-sm input-reemplazo-imagen"
                                                        data-preview="preview-imagen-{{ $imagen->id }}"
                                                        accept=".jpg,.jpeg,.png,.webp"
                                                    >


                                                    <div class="form-text">

                                                        La nueva imagen reemplazará
                                                        solamente esta imagen.

                                                    </div>

                                                </div>


                                                {{-- ELIMINAR --}}

                                                <button
                                                    type="button"
                                                    class="btn btn-outline-danger btn-sm gallery-delete btn-delete-image"
                                                    data-id="{{ $imagen->id }}"
                                                    data-url="{{ route(
                                                        'admin.recursos.destroy',
                                                        $imagen
                                                    ) }}"
                                                >

                                                    <i class="bi bi-trash3 me-1"></i>

                                                    Eliminar imagen

                                                </button>


                                            </div>

                                        </div>

                                    @endforeach

                                </div>


                            @else


                                <div class="text-center border rounded-3 p-4 bg-light">

                                    <i class="bi bi-images fs-2 text-muted"></i>

                                    <div class="fw-semibold mt-2">

                                        No hay imágenes adicionales

                                    </div>

                                    <small class="text-muted">

                                        Agrega imágenes usando el campo de abajo.

                                    </small>

                                </div>


                            @endif

                        </div>


                        <hr>


                        {{-- =================================================
                             AGREGAR NUEVAS IMÁGENES
                        ================================================== --}}

                        <div>

                            <div class="mb-3">

                                <h6 class="fw-bold mb-1">
                                    Agregar imágenes
                                </h6>

                                <small class="text-muted">

                                    Puedes agregar una o varias imágenes
                                    al mismo tiempo.

                                </small>

                            </div>


                            <div class="upload-box mt-3">

                                <div class="upload-box-icon">

                                    <i class="bi bi-cloud-arrow-up"></i>

                                </div>


                                <div class="fw-semibold mb-1">

                                    Selecciona varias imágenes

                                </div>


                                <div class="small text-muted mb-3">

                                    JPG, JPEG, PNG o WEBP
                                    · Máximo 4 MB por imagen

                                </div>


                                <input
                                    type="file"
                                    name="imagenes[]"
                                    id="imagenes"
                                    class="form-control"
                                    data-upload-url="{{ route('admin.recursos.store', $contenido) }}"
                                    accept=".jpg,.jpeg,.png,.webp"
                                    multiple
                                >

                            </div>


                            {{-- CONTADOR --}}

                            <div
                                id="contadorNuevasImagenes"
                                class="selected-images-title"
                                style="display:none;"
                            >

                                <strong>

                                    Imágenes seleccionadas
                                    (<span id="numeroNuevasImagenes">0</span>)

                                </strong>


                                <button
                                    type="button"
                                    class="btn btn-sm btn-light border"
                                    id="limpiarNuevasImagenes"
                                >

                                    <i class="bi bi-trash3 me-1"></i>

                                    Limpiar todas

                                </button>

                            </div>


                            {{-- POSICIONES --}}

                            <div id="posicionesImagenes"></div>


                            {{-- PREVISUALIZACIÓN --}}

                            <div
                                id="previewImagenes"
                                class="new-images-grid mt-2"
                            ></div>


                            {{-- VACÍO --}}

                            <div
                                id="sinNuevasImagenes"
                                class="empty-new-images mt-3"
                            >

                                <i class="bi bi-images fs-4 d-block mb-2"></i>

                                Selecciona una o varias imágenes
                                para verlas aquí.

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     VIDEO E IFRAME
                ================================================== --}}

                <div class="editor-card">

                    <div class="editor-card-header">

                        <i class="bi bi-play-circle text-primary me-2"></i>

                        Video y contenido interactivo

                    </div>


                    <div class="editor-card-body">


                        {{-- VIDEO --}}

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Video de YouTube

                            </label>


                            <input
                                type="url"
                                name="video_url"
                                class="form-control"
                                value="{{ old(
                                    'video_url',
                                    $contenido->video_url
                                ) }}"
                                placeholder="https://www.youtube.com/watch?v=..."
                            >

                        </div>


                        {{-- IFRAME --}}

                        <div>

                            <label class="form-label fw-semibold">

                                Iframe

                            </label>


                            <textarea
                                name="iframe"
                                rows="5"
                                class="form-control"
                                placeholder="<iframe ...></iframe>"
                            >{{ old(
                                'iframe',
                                $contenido->iframe
                            ) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 COLUMNA DERECHA
            ====================================================== --}}

            <div class="col-lg-4">


                {{-- CONFIGURACIÓN --}}

                <div class="editor-card">

                    <div class="editor-card-header">

                        <i class="bi bi-gear text-primary me-2"></i>

                        Configuración

                    </div>


                    <div class="editor-card-body">


                        {{-- TEMA --}}

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Tema
                            </label>


                            <select
                                name="tema_id"
                                class="form-select"
                                required
                            >

                                @foreach($temas as $tema)

                                    <option
                                        value="{{ $tema->id }}"
                                        {{
                                            old(
                                                'tema_id',
                                                $contenido->tema_id
                                            ) == $tema->id
                                                ? 'selected'
                                                : ''
                                        }}
                                    >

                                        {{ $tema->orden }}.
                                        {{ $tema->titulo }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- ORDEN --}}

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Orden de aparición

                            </label>


                            <input
                                type="number"
                                name="orden"
                                class="form-control"
                                value="{{ old(
                                    'orden',
                                    $contenido->orden
                                ) }}"
                                min="0"
                            >


                            <div class="form-text">

                                Define la posición dentro del tema.

                            </div>

                        </div>


                        {{-- ACTIVO --}}

                        <div class="border rounded-3 p-3 bg-light">

                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="activo"
                                    id="activo"
                                    value="1"
                                    {{ $contenido->activo ? 'checked' : '' }}
                                >


                                <label
                                    class="form-check-label fw-semibold"
                                    for="activo"
                                >

                                    Contenido publicado

                                </label>

                            </div>


                            <small class="text-muted">

                                Si está activo,
                                los participantes podrán verlo.

                            </small>

                        </div>

                    </div>

                </div>


                {{-- AYUDA --}}

                <div class="alert alert-primary">

                    <div class="fw-semibold mb-1">

                        <i class="bi bi-lightbulb me-1"></i>

                        ¿Cómo funciona?

                    </div>


                    <small>

                        1. Edita el contenido.<br>

                        2. Cambia la posición de las imágenes.<br>

                        3. Reemplaza las imágenes que necesites.<br>

                        4. Elimina las que ya no necesites.<br>

                        5. Agrega nuevas imágenes.<br>

                        6. Guarda los cambios.

                    </small>

                </div>


                {{-- BOTONES --}}

                <div class="sticky-actions">

                    <button
                        type="submit"
                        class="btn btn-primary w-100 mb-2"
                    >

                        <i class="bi bi-check2-circle me-1"></i>

                        Guardar cambios

                    </button>


                    <a
                        href="{{ route('admin.contenidos.index') }}"
                        class="btn btn-light border w-100"
                    >

                        Cancelar

                    </a>

                </div>

            </div>

        </div>

    </form>

</div>


{{-- =========================================================
     MODAL ELIMINAR IMAGEN
========================================================== --}}

<div
    class="modal fade"
    id="modalEliminarImagen"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-body text-center p-4">


                <div class="text-danger fs-1 mb-2">

                    <i class="bi bi-trash3"></i>

                </div>


                <h5 class="fw-bold">

                    Eliminar imagen

                </h5>


                <p class="text-muted">

                    ¿Estás seguro de que deseas eliminar esta imagen?

                    <br>

                    <strong>
                        El contenido no será eliminado.
                    </strong>

                </p>


                <div class="d-flex gap-2 justify-content-center">

                    <button
                        type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal"
                    >

                        Cancelar

                    </button>


                    <button
                        type="button"
                        class="btn btn-danger"
                        id="confirmarEliminarImagen"
                    >

                        <i class="bi bi-trash3 me-1"></i>

                        Sí, eliminar

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const CSRF = '{{ csrf_token() }}';
    const MAX_MB = 4;

    /* ------------------------------------------------------------------
     | ELEMENTOS
     ------------------------------------------------------------------ */
    const contenido           = document.getElementById('contenido');
    const inputImagenes       = document.getElementById('imagenes');
    const preview             = document.getElementById('previewImagenes');
    const sinNuevasImagenes   = document.getElementById('sinNuevasImagenes');
    const contadorParrafos    = document.getElementById('contadorParrafos');
    const contadorNuevas      = document.getElementById('contadorNuevasImagenes');
    const numeroNuevas        = document.getElementById('numeroNuevasImagenes');
    const limpiarNuevas       = document.getElementById('limpiarNuevasImagenes');
    const formEditar          = document.getElementById('formEditarContenido');
    const urlSubirRecurso     = inputImagenes ? inputImagenes.dataset.uploadUrl : null;

    let archivosSeleccionados = [];


    /* ------------------------------------------------------------------
     | PETICIÓN AJAX GENÉRICA
     |
     | Siempre se envía como POST y se usa "_method" para simular
     | PATCH / DELETE. Así funciona aunque el servidor bloquee esos verbos.
     ------------------------------------------------------------------ */
    async function peticion(url, metodo, datos) {

        if (!url) {
            throw new Error('No se encontró la URL de la acción.');
        }

        let cuerpo;

        if (datos instanceof FormData) {
            cuerpo = datos;
        } else {
            cuerpo = new FormData();
            Object.entries(datos || {}).forEach(function ([k, v]) {
                cuerpo.append(k, v);
            });
        }

        if (metodo !== 'POST') {
            cuerpo.append('_method', metodo);
        }

        const response = await fetch(url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: cuerpo
        });

        const texto = await response.text();
        let data = {};

        try {
            data = texto ? JSON.parse(texto) : {};
        } catch (e) {
            console.error('Respuesta no JSON del servidor:', texto);
        }

        if (!response.ok || data.success !== true) {
            throw new Error(data.message || ('Error HTTP ' + response.status));
        }

        return data;
    }

    function escapar(texto) {
        const div = document.createElement('div');
        div.textContent = texto == null ? '' : texto;
        return div.innerHTML.replace(/"/g, '&quot;');
    }

    function flashBorde(elemento, ms) {
        elemento.classList.add('border-success');
        setTimeout(function () {
            elemento.classList.remove('border-success');
        }, ms || 1000);
    }


    /* ------------------------------------------------------------------
     | PÁRRAFOS
     ------------------------------------------------------------------ */
    function obtenerParrafos() {

        if (!contenido) return [];

        const texto = contenido.value
            .replace(/\r\n/g, '\n')
            .replace(/\r/g, '\n')
            .trim();

        if (!texto) return [];

        return texto
            .split(/\n[ \t]*\n+/)
            .map(function (t) { return t.trim(); })
            .filter(function (t) { return t.length > 0; });
    }

    function actualizarContadorParrafos() {
        if (contadorParrafos) {
            contadorParrafos.textContent = obtenerParrafos().length;
        }
    }

    function crearOpcionesPosicion() {

        let opciones = '<option value="inicio">Al inicio</option>';

        obtenerParrafos().forEach(function (p, i) {
            opciones += '<option value="' + (i + 1) + '">Después del párrafo ' + (i + 1) + '</option>';
        });

        opciones += '<option value="final">Al final</option>';

        return opciones;
    }

    if (contenido) {
        contenido.addEventListener('input', actualizarContadorParrafos);
    }


    /* ------------------------------------------------------------------
     | CONTADOR DE LA GALERÍA
     ------------------------------------------------------------------ */
    function actualizarContadorGaleria() {

        const galeria = document.getElementById('galeriaImagenes');
        const numero  = document.getElementById('numeroImagenes');
        const texto   = document.getElementById('textoImagenes');

        const cantidad = galeria
            ? galeria.querySelectorAll('.gallery-item').length
            : 0;

        if (numero) numero.textContent = cantidad;
        if (texto)  texto.textContent  = cantidad === 1 ? 'imagen' : 'imágenes';
    }


    /* ------------------------------------------------------------------
     | CAMBIAR POSICIÓN EN TIEMPO REAL
     ------------------------------------------------------------------ */
    async function guardarPosicion(select) {

        select.disabled = true;

        try {
            await peticion(
                select.dataset.updateUrl,
                'PATCH',
                { posicion: select.value }
            );

            flashBorde(select);

        } catch (error) {
            console.error(error);
            alert('No se pudo actualizar la posición.\n\n' + error.message);

        } finally {
            select.disabled = false;
        }
    }

    function conectarPosicion(select) {

        if (select.dataset.conectado === '1') return;
        select.dataset.conectado = '1';

        select.addEventListener('change', function () {
            guardarPosicion(this);
        });
    }

    document.querySelectorAll('.posicion-imagen-existente')
        .forEach(conectarPosicion);


    /* ------------------------------------------------------------------
     | REEMPLAZAR IMAGEN EN TIEMPO REAL
     ------------------------------------------------------------------ */
    async function reemplazarImagen(input) {

        const archivo = input.files[0];

        if (!archivo) return;

        if (!archivo.type.startsWith('image/')) {
            alert('El archivo seleccionado no es una imagen.');
            input.value = '';
            return;
        }

        if (archivo.size > MAX_MB * 1024 * 1024) {
            alert('La imagen no puede superar los ' + MAX_MB + ' MB.');
            input.value = '';
            return;
        }

        const formData = new FormData();
        formData.append('imagen', archivo);

        input.disabled = true;

        try {
            const data = await peticion(input.dataset.updateUrl, 'POST', formData);

            const img = document.getElementById(input.dataset.preview);

            if (img) {
                // ?t= evita que el navegador muestre la imagen anterior en caché
                img.src = data.recurso.url + '?t=' + Date.now();
            }

            flashBorde(input, 1200);

        } catch (error) {
            console.error(error);
            alert('No se pudo reemplazar la imagen.\n\n' + error.message);

        } finally {
            input.disabled = false;
            input.value = '';
        }
    }

    function conectarReemplazo(input) {

        if (input.dataset.conectado === '1') return;
        input.dataset.conectado = '1';

        input.addEventListener('change', function () {
            reemplazarImagen(this);
        });
    }

    document.querySelectorAll('.input-reemplazo-imagen')
        .forEach(conectarReemplazo);


    /* ------------------------------------------------------------------
     | ELIMINAR IMAGEN EN TIEMPO REAL
     |
     | Delegación de eventos: funciona con las tarjetas que vienen del
     | servidor y con las que se crean después con JavaScript.
     ------------------------------------------------------------------ */
    async function eliminarImagen(boton) {

        const url = boton.dataset.url;
        const id  = boton.dataset.id;

        if (!url || !id) {
            alert('No se pudo identificar la imagen que deseas eliminar.');
            return;
        }

        if (!confirm('¿Estás seguro de que deseas eliminar esta imagen?\n\nEsta acción no se puede deshacer.')) {
            return;
        }

        const tarjeta       = document.getElementById('imagen-recurso-' + id);
        const textoOriginal = boton.innerHTML;

        boton.disabled = true;
        boton.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Eliminando...';

        if (tarjeta) tarjeta.classList.add('removing');

        try {
            await peticion(url, 'DELETE');

            if (tarjeta) tarjeta.remove();

            actualizarContadorGaleria();

        } catch (error) {
            console.error('ERROR AL ELIMINAR IMAGEN:', error);

            if (tarjeta) tarjeta.classList.remove('removing');

            boton.disabled = false;
            boton.innerHTML = textoOriginal;

            alert('No se pudo eliminar la imagen.\n\n' + error.message);
        }
    }

    document.addEventListener('click', function (event) {

        const boton = event.target.closest('.btn-delete-image');

        if (!boton) return;

        event.preventDefault();
        event.stopPropagation();

        eliminarImagen(boton);
    });


    /* ------------------------------------------------------------------
     | SUBIR NUEVAS IMÁGENES EN TIEMPO REAL
     ------------------------------------------------------------------ */
    function actualizarContadorNuevas() {

        const cantidad = archivosSeleccionados.length;

        if (numeroNuevas) numeroNuevas.textContent = cantidad;

        if (contadorNuevas) {
            contadorNuevas.style.display = cantidad > 0 ? 'flex' : 'none';
        }
    }

    function mostrarNuevasImagenes() {

        if (!preview) return;

        preview.innerHTML = '';

        if (!archivosSeleccionados.length) {
            if (sinNuevasImagenes) sinNuevasImagenes.style.display = 'block';
            actualizarContadorNuevas();
            return;
        }

        if (sinNuevasImagenes) sinNuevasImagenes.style.display = 'none';

        archivosSeleccionados.forEach(function (archivo, index) {

            const tarjeta = document.createElement('div');

            tarjeta.className = 'new-image';
            tarjeta.dataset.index = index;
            tarjeta.innerHTML =
                '<div class="p-3 text-center">' +
                    '<div class="spinner-border spinner-border-sm text-primary"></div>' +
                    '<div class="small text-muted mt-2">Subiendo ' + escapar(archivo.name) + '...</div>' +
                '</div>';

            preview.appendChild(tarjeta);
        });

        actualizarContadorNuevas();
    }

    function agregarImagenGuardada(recurso) {

        const galeria = document.getElementById('galeriaImagenes');

        // Si no había galería (no existían imágenes), se recarga la página
        if (!galeria) {
            location.reload();
            return;
        }

        const posicion = (recurso.configuracion && recurso.configuracion.posicion)
            ? recurso.configuracion.posicion
            : 'final';

        const card = document.createElement('div');

        card.className = 'gallery-item';
        card.id = 'imagen-recurso-' + recurso.id;

        card.innerHTML =
            '<img src="' + escapar(recurso.url) + '" alt="' + escapar(recurso.titulo || 'Imagen') + '" id="preview-imagen-' + recurso.id + '">' +

            '<div class="gallery-body">' +

                '<div class="d-flex justify-content-between align-items-center mb-2">' +
                    '<strong>Imagen</strong>' +
                    '<span class="badge bg-light text-dark">#' + recurso.orden + '</span>' +
                '</div>' +

                '<div class="position-select-wrap">' +
                    '<label><i class="bi bi-pin-angle me-1"></i> Ubicación de la imagen</label>' +
                    '<select class="form-select form-select-sm posicion-imagen-existente" data-update-url="' + escapar(recurso.position_url) + '">' +
                        crearOpcionesPosicion() +
                    '</select>' +
                '</div>' +

                '<div class="mt-3">' +
                    '<label class="form-label small fw-semibold"><i class="bi bi-arrow-repeat me-1"></i> Cambiar imagen</label>' +
                    '<input type="file" class="form-control form-control-sm input-reemplazo-imagen"' +
                        ' data-update-url="' + escapar(recurso.replace_url) + '"' +
                        ' data-preview="preview-imagen-' + recurso.id + '"' +
                        ' accept=".jpg,.jpeg,.png,.webp">' +
                '</div>' +

                '<button type="button" class="btn btn-outline-danger btn-sm gallery-delete btn-delete-image"' +
                    ' data-id="' + recurso.id + '" data-url="' + escapar(recurso.delete_url) + '">' +
                    '<i class="bi bi-trash3 me-1"></i> Eliminar imagen' +
                '</button>' +

            '</div>';

        galeria.appendChild(card);

        const select = card.querySelector('.posicion-imagen-existente');

        if (select) {
            select.value = posicion;
            conectarPosicion(select);
        }

        const reemplazo = card.querySelector('.input-reemplazo-imagen');

        if (reemplazo) {
            conectarReemplazo(reemplazo);
        }

        // La eliminación NO necesita conectarse: usa delegación de eventos.

        actualizarContadorGaleria();
    }

    async function subirImagen(archivo) {

        const formData = new FormData();

        formData.append('imagen', archivo);
        formData.append('posicion', 'final');

        const data = await peticion(urlSubirRecurso, 'POST', formData);

        return data.recurso;
    }

    if (inputImagenes) {

        inputImagenes.addEventListener('change', async function () {

            const archivos = Array.from(this.files);

            if (!archivos.length) return;

            archivosSeleccionados = archivos.filter(function (archivo) {

                if (!archivo.type.startsWith('image/')) return false;

                if (archivo.size > MAX_MB * 1024 * 1024) {
                    alert('La imagen "' + archivo.name + '" supera el máximo de ' + MAX_MB + ' MB.');
                    return false;
                }

                return true;
            });

            mostrarNuevasImagenes();

            for (const archivo of archivosSeleccionados) {

                try {
                    const recurso = await subirImagen(archivo);
                    agregarImagenGuardada(recurso);

                } catch (error) {
                    console.error(error);
                    alert('No se pudo guardar "' + archivo.name + '": ' + error.message);
                }
            }

            archivosSeleccionados = [];
            this.value = '';

            mostrarNuevasImagenes();
        });
    }

    if (limpiarNuevas) {
        limpiarNuevas.addEventListener('click', function () {

            archivosSeleccionados = [];

            if (inputImagenes) inputImagenes.value = '';

            mostrarNuevasImagenes();
        });
    }

    // Las imágenes nuevas ya se guardaron por AJAX: no se reenvían al guardar.
    if (formEditar) {
        formEditar.addEventListener('submit', function () {

            if (inputImagenes) inputImagenes.value = '';

            archivosSeleccionados = [];
        });
    }


    /* ------------------------------------------------------------------
     | INICIAR
     ------------------------------------------------------------------ */
    actualizarContadorParrafos();
    actualizarContadorGaleria();

});
</script>
@endsection