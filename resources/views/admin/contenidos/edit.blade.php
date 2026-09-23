@extends('admin.layouts.app')

@section('title', 'Editar contenido')

@section('page-title', 'Editar contenido')

@section('content')

<style>

/* ============================================================
   CONTENEDOR GENERAL
============================================================ */

.editor-wrapper {
    max-width: 1400px;
    margin: 0 auto;
}


/* ============================================================
   ENCABEZADO
============================================================ */

.editor-header {
    background: linear-gradient(
        135deg,
        #0d6efd 0%,
        #084298 100%
    );
    border-radius: 22px;
    padding: 28px 32px;
    color: white;
    margin-bottom: 24px;
    box-shadow: 0 10px 30px rgba(13, 110, 253, .15);
}

.editor-header h2 {
    font-weight: 700;
    margin-bottom: 6px;
}

.editor-header p {
    margin: 0;
    opacity: .85;
}


/* ============================================================
   TARJETAS
============================================================ */

.editor-card {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 18px;
    box-shadow: 0 5px 20px rgba(25, 45, 70, .06);
    overflow: hidden;
}

.editor-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid #edf0f4;
    background: #fbfcfe;
}

.editor-card-header h5 {
    margin: 0;
    font-weight: 700;
}

.editor-card-body {
    padding: 24px;
}


/* ============================================================
   CAMPOS
============================================================ */

.form-label {
    color: #26384a;
}

.form-control,
.form-select {
    border-radius: 11px;
    border-color: #dce3eb;
    padding: 11px 13px;
}

.form-control:focus,
.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 .2rem rgba(13,110,253,.10);
}


/* ============================================================
   IMAGEN PRINCIPAL
============================================================ */

.main-image-box {
    position: relative;
    background: #f4f7fa;
    border-radius: 16px;
    padding: 10px;
    border: 1px solid #e4e9ef;
}

.main-image-box img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    border-radius: 12px;
}


/* ============================================================
   GALERÍA
============================================================ */

.gallery-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

.gallery-count {
    background: #eaf2ff;
    color: #0d6efd;
    border-radius: 30px;
    padding: 7px 13px;
    font-size: 13px;
    font-weight: 700;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}

.gallery-item {
    position: relative;
    background: white;
    border: 1px solid #e4e9ef;
    border-radius: 16px;
    overflow: hidden;
    transition: all .2s ease;
}

.gallery-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(20,40,70,.10);
}

.gallery-image {
    position: relative;
    height: 180px;
    background: #f3f5f8;
}

.gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.gallery-number {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(0,0,0,.65);
    color: white;
    padding: 5px 9px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
}

.gallery-body {
    padding: 12px;
}

.gallery-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.gallery-info small {
    color: #718096;
}

.btn-delete-image {
    border-radius: 9px;
}

.gallery-item.removing {
    opacity: .35;
    transform: scale(.97);
    pointer-events: none;
}


/* ============================================================
   AGREGAR IMÁGENES
============================================================ */

.upload-zone {
    border: 2px dashed #cdd7e3;
    border-radius: 16px;
    padding: 28px;
    text-align: center;
    background: #f9fbfd;
    transition: .2s ease;
}

.upload-zone:hover {
    border-color: #86b7fe;
    background: #f4f8ff;
}

.upload-zone-icon {
    width: 58px;
    height: 58px;
    border-radius: 16px;
    background: #eaf2ff;
    color: #0d6efd;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    font-size: 25px;
}


/* ============================================================
   PREVISUALIZACIÓN
============================================================ */

.preview-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-top: 18px;
}

.preview-card {
    border: 1px solid #e1e7ee;
    border-radius: 13px;
    overflow: hidden;
    background: white;
}

.preview-card img {
    width: 100%;
    height: 130px;
    object-fit: cover;
}

.preview-card-info {
    padding: 9px 11px;
}


/* ============================================================
   SIDEBAR
============================================================ */

.config-item {
    margin-bottom: 22px;
}

.config-item:last-child {
    margin-bottom: 0;
}

.status-box {
    background: #f6f8fb;
    border-radius: 12px;
    padding: 14px;
}

.info-panel {
    background: #eef6ff;
    border: 1px solid #d5e8ff;
    border-radius: 15px;
    padding: 16px;
    color: #31506f;
}


/* ============================================================
   BOTONES
============================================================ */

.btn {
    border-radius: 10px;
}

.btn-save {
    padding: 12px;
    font-weight: 600;
}


/* ============================================================
   MODAL ELIMINACIÓN
============================================================ */

.delete-modal-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: #fff0f1;
    color: #dc3545;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    font-size: 30px;
}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 992px) {

    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .preview-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}

@media (max-width: 576px) {

    .editor-header {
        padding: 22px;
    }

    .editor-card-body {
        padding: 18px;
    }

    .gallery-grid {
        grid-template-columns: 1fr;
    }

    .preview-grid {
        grid-template-columns: 1fr;
    }

}

</style>


<div class="editor-wrapper">


    {{-- ============================================================
         ENCABEZADO
    ============================================================= --}}

    <div class="editor-header">

        <div class="d-flex justify-content-between align-items-center gap-3">

            <div>

                <div class="mb-2">

                    <span class="badge bg-light text-primary">

                        <i class="bi bi-pencil-square me-1"></i>

                        Editor de contenido

                    </span>

                </div>

                <h2>

                    {{ $contenido->titulo }}

                </h2>

                <p>

                    Modifica la información y los recursos educativos
                    de este contenido.

                </p>

            </div>


            <div class="d-none d-md-block">

                <a
                    href="{{ route('admin.contenidos.index') }}"
                    class="btn btn-light"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Volver

                </a>

            </div>

        </div>

    </div>


    {{-- ============================================================
         MENSAJES
    ============================================================= --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm"
        >

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm">

            <div class="fw-bold mb-2">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                Revisa los siguientes campos:

            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ============================================================
         FORMULARIO PRINCIPAL
    ============================================================= --}}

    <form
        action="{{ route('admin.contenidos.update', $contenido) }}"
        method="POST"
        enctype="multipart/form-data"
        id="formEditarContenido"
    >

        @csrf

        @method('PUT')


        <div class="row g-4">


            {{-- ====================================================
                 COLUMNA IZQUIERDA
            ===================================================== --}}

            <div class="col-lg-8">


                {{-- ==================================================
                     INFORMACIÓN EDUCATIVA
                =================================================== --}}

                <div class="editor-card mb-4">

                    <div class="editor-card-header">

                        <h5>

                            <i class="bi bi-file-earmark-text text-primary me-2"></i>

                            Información educativa

                        </h5>

                    </div>


                    <div class="editor-card-body">


                        {{-- TÍTULO --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Título

                            </label>

                            <input
                                type="text"
                                name="titulo"
                                class="form-control form-control-lg"
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
                                rows="14"
                                class="form-control"
                                placeholder="Escribe aquí el contenido educativo..."
                            >{{ old('contenido', $contenido->contenido) }}</textarea>

                        </div>

                    </div>

                </div>


                {{-- ==================================================
                     MULTIMEDIA
                =================================================== --}}

                <div class="editor-card">

                    <div class="editor-card-header">

                        <div class="d-flex justify-content-between align-items-center">

                            <h5>

                                <i class="bi bi-collection-play text-primary me-2"></i>

                                Recursos multimedia

                            </h5>

                        </div>

                    </div>


                    <div class="editor-card-body">


                        {{-- ==================================================
                             IMAGEN PRINCIPAL
                        =================================================== --}}

                        @if($contenido->imagen)

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    <i class="bi bi-image me-1"></i>

                                    Imagen principal

                                </label>


                                <div class="main-image-box">

                                    <img
                                        src="{{ route('media.contenido', [
                                            'filename' => basename($contenido->imagen)
                                        ]) }}"
                                        alt="{{ $contenido->titulo }}"
                                    >

                                </div>


                                <div class="mt-3">

                                    <label class="form-label small text-muted">

                                        Reemplazar imagen principal

                                    </label>

                                    <input
                                        type="file"
                                        name="imagen"
                                        class="form-control"
                                        accept=".jpg,.jpeg,.png,.webp"
                                    >

                                    <div class="form-text">

                                        JPG, JPEG, PNG o WEBP.
                                        Máximo 2 MB.

                                    </div>

                                </div>

                            </div>

                        @else

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    <i class="bi bi-image me-1"></i>

                                    Imagen principal

                                </label>

                                <input
                                    type="file"
                                    name="imagen"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                            </div>

                        @endif


                        <hr class="my-4">


                        {{-- ==================================================
                             GALERÍA EXISTENTE
                        =================================================== --}}

                        <div class="gallery-header">

                            <div>

                                <h5 class="fw-bold mb-1">

                                    Galería de imágenes

                                </h5>

                                <small class="text-muted">

                                    Imágenes adicionales de este contenido.

                                </small>

                            </div>


                            <span
                                class="gallery-count"
                                id="contadorImagenes"
                                @if($contenido->imagenes->count() == 0)
                                    style="display:none;"
                                @endif
                            >

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


                        @if($contenido->imagenes->count() > 0)

                            <div
                                class="gallery-grid"
                                id="galeriaImagenes"
                            >

                                @foreach($contenido->imagenes as $imagen)

                                    <div
                                        class="gallery-item"
                                        id="imagen-recurso-{{ $imagen->id }}"
                                    >


                                        <div class="gallery-image">

                                            <img
                                                src="{{ route('media.recurso', [
                                                    'filename' => basename($imagen->ruta)
                                                ]) }}"
                                                alt="Imagen {{ $loop->iteration }}"
                                            >


                                            <div class="gallery-number">

                                                #{{ $loop->iteration }}

                                            </div>

                                        </div>


                                        <div class="gallery-body">


                                            <div class="gallery-info">

                                                <small>

                                                    Imagen {{ $loop->iteration }}

                                                </small>

                                                <span class="badge bg-light text-dark">

                                                    Orden {{ $imagen->orden }}

                                                </span>

                                            </div>


                                            {{-- IMPORTANTE:
                                                 NO ES UN FORM.
                                                 ES SOLO UN BUTTON.
                                            --}}

                                            

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div
                                class="text-center py-5 border rounded-4 bg-light"
                                id="sinImagenes"
                            >

                                <i
                                    class="bi bi-images text-muted"
                                    style="font-size: 42px;"
                                ></i>

                                <h6 class="fw-bold mt-3">

                                    No hay imágenes adicionales

                                </h6>

                                <p class="text-muted mb-0">

                                    Las imágenes que agregues aparecerán
                                    aquí.

                                </p>

                            </div>

                        @endif


                        <hr class="my-4">


                        {{-- ==================================================
                             AGREGAR NUEVAS IMÁGENES
                        =================================================== --}}

                        <div>

                            <div class="mb-3">

                                <h5 class="fw-bold mb-1">

                                    Agregar imágenes

                                </h5>

                                <small class="text-muted">

                                    Puedes seleccionar varias imágenes
                                    simultáneamente.

                                </small>

                            </div>


                            <div class="upload-zone">

                                <div class="upload-zone-icon">

                                    <i class="bi bi-cloud-arrow-up"></i>

                                </div>


                                <h6 class="fw-bold">

                                    Selecciona las imágenes

                                </h6>


                                <p class="text-muted small mb-3">

                                    JPG, JPEG, PNG o WEBP · Máximo 4 MB por imagen

                                </p>


                                <input
                                    type="file"
                                    name="imagenes[]"
                                    id="imagenes"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                    multiple
                                >

                            </div>


                            {{-- PREVIEW --}}

                            <div
                                id="previewImagenes"
                                class="preview-grid"
                            ></div>

                        </div>


                        <hr class="my-4">


                        {{-- ==================================================
                             VIDEO
                        =================================================== --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                <i class="bi bi-play-circle me-1"></i>

                                Video

                            </label>

                            <input
                                type="url"
                                name="video_url"
                                class="form-control"
                                value="{{ old('video_url', $contenido->video_url) }}"
                                placeholder="https://www.youtube.com/watch?v=..."
                            >

                            <div class="form-text">

                                Coloca la URL del video de YouTube.

                            </div>

                        </div>


                        {{-- ==================================================
                             IFRAME
                        =================================================== --}}

                        <div>

                            <label class="form-label fw-semibold">

                                <i class="bi bi-window-stack me-1"></i>

                                Contenido interactivo / iframe

                            </label>

                            <textarea
                                name="iframe"
                                rows="6"
                                class="form-control"
                                placeholder="<iframe ...></iframe>"
                            >{{ old('iframe', $contenido->iframe) }}</textarea>

                            <div class="form-text">

                                Código iframe proporcionado por la plataforma
                                externa.

                            </div>

                        </div>


                    </div>

                </div>

            </div>


            {{-- ====================================================
                 COLUMNA DERECHA
            ===================================================== --}}

            <div class="col-lg-4">


                {{-- ==================================================
                     CONFIGURACIÓN
                =================================================== --}}

                <div class="editor-card mb-4">

                    <div class="editor-card-header">

                        <h5>

                            <i class="bi bi-sliders text-primary me-2"></i>

                            Configuración

                        </h5>

                    </div>


                    <div class="editor-card-body">


                        {{-- TEMA --}}

                        <div class="config-item">

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
                                        {{ old('tema_id', $contenido->tema_id) == $tema->id ? 'selected' : '' }}
                                    >

                                        {{ $tema->orden }}.
                                        {{ $tema->titulo }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- ORDEN --}}

                        <div class="config-item">

                            <label class="form-label fw-semibold">

                                Orden de aparición

                            </label>

                            <input
                                type="number"
                                name="orden"
                                class="form-control"
                                value="{{ old('orden', $contenido->orden) }}"
                                min="0"
                            >

                            <div class="form-text">

                                Define la posición del contenido dentro
                                del tema.

                            </div>

                        </div>


                        {{-- ESTADO --}}

                        <div class="config-item">

                            <label class="form-label fw-semibold">

                                Estado

                            </label>

                            <div class="status-box">

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

                                <small class="text-muted d-block mt-2">

                                    Si está activo, los participantes
                                    podrán visualizarlo.

                                </small>

                            </div>

                        </div>


                    </div>

                </div>


                {{-- ==================================================
                     INFORMACIÓN
                =================================================== --}}

                <div class="info-panel mb-4">

                    <div class="d-flex gap-3">

                        <i class="bi bi-shield-check fs-4"></i>

                        <div>

                            <strong>

                                Gestión segura de imágenes

                            </strong>

                            <p class="small mb-0 mt-1">

                                Eliminar una imagen de la galería
                                no modifica el resto del contenido.

                            </p>

                        </div>

                    </div>

                </div>


                {{-- ==================================================
                     ACCIONES
                =================================================== --}}

                <div class="editor-card">

                    <div class="editor-card-body">

                        <button
                            type="submit"
                            class="btn btn-primary btn-save w-100 mb-2"
                        >

                            <i class="bi bi-check2-circle me-1"></i>

                            Guardar cambios

                        </button>


                        <a
                            href="{{ route('admin.contenidos.index') }}"
                            class="btn btn-light w-100"
                        >

                            Cancelar

                        </a>

                    </div>

                </div>


            </div>


        </div>


    </form>

</div>


{{-- ================================================================
     MODAL CONFIRMACIÓN
================================================================ --}}

<div
    class="modal fade"
    id="modalEliminarImagen"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-body text-center p-4 p-md-5">


                <div class="delete-modal-icon">

                    <i class="bi bi-trash3"></i>

                </div>


                <h4 class="fw-bold mb-2">

                    Eliminar imagen

                </h4>


                <p class="text-muted mb-4">

                    ¿Estás seguro de que deseas eliminar esta imagen?

                    <br>

                    <strong>

                        Esta acción no eliminará el contenido.

                    </strong>

                </p>


                <div class="d-flex gap-2 justify-content-center">

                    <button
                        type="button"
                        class="btn btn-light px-4"
                        data-bs-dismiss="modal"
                    >

                        Cancelar

                    </button>


                    <button
                        type="button"
                        class="btn btn-danger px-4"
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


{{-- ================================================================
     JAVASCRIPT
================================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* ============================================================
       VARIABLES
    ============================================================ */

    let imagenSeleccionada = null;

    let botonSeleccionado = null;


    const modalElement =
        document.getElementById('modalEliminarImagen');


    const modal =
        modalElement
            ? new bootstrap.Modal(modalElement)
            : null;


    const botonConfirmar =
        document.getElementById(
            'confirmarEliminarImagen'
        );


    /* ============================================================
       BOTONES ELIMINAR
    ============================================================ */

    document
        .querySelectorAll('.btn-delete-image')
        .forEach(function (boton) {


            boton.addEventListener('click', function () {


                imagenSeleccionada = {
                    id: this.dataset.id,
                    url: this.dataset.url
                };


                botonSeleccionado = this;


                if (modal) {

                    modal.show();

                }

            });

        });


    /* ============================================================
       CONFIRMAR ELIMINACIÓN
    ============================================================ */

    if (botonConfirmar) {

        botonConfirmar.addEventListener(
            'click',
            function () {


                if (
                    !imagenSeleccionada ||
                    !botonSeleccionado
                ) {

                    return;

                }


                const url =
                    imagenSeleccionada.url;


                const id =
                    imagenSeleccionada.id;


                const tarjeta =
                    document.getElementById(
                        'imagen-recurso-' + id
                    );


                /* ================================================
                   DESHABILITAR BOTÓN
                ================================================= */

                botonConfirmar.disabled = true;


                botonConfirmar.innerHTML = `

                    <span
                        class="spinner-border spinner-border-sm me-1"
                    ></span>

                    Eliminando...

                `;


                if (tarjeta) {

                    tarjeta.classList.add(
                        'removing'
                    );

                }


                /* ================================================
                   PETICIÓN AJAX
                ================================================= */

                fetch(url, {

                    method: 'DELETE',

                    headers: {

                        'X-CSRF-TOKEN':
                            '{{ csrf_token() }}',

                        'Accept':
                            'application/json',

                        'X-Requested-With':
                            'XMLHttpRequest'

                    }

                })


                .then(function (response) {


                    if (!response.ok) {

                        throw new Error(
                            'El servidor no pudo eliminar la imagen.'
                        );

                    }


                    return response.json();

                })


                .then(function (data) {


                    if (!data.success) {

                        throw new Error(
                            data.message ||
                            'No se pudo eliminar la imagen.'
                        );

                    }


                    /* ============================================
                       CERRAR MODAL
                    ============================================ */

                    if (modal) {

                        modal.hide();

                    }


                    /* ============================================
                       ELIMINAR TARJETA
                    ============================================ */

                    if (tarjeta) {

                        tarjeta.remove();

                    }


                    /* ============================================
                       ACTUALIZAR CONTADOR
                    ============================================ */

                    actualizarContador();


                    /* ============================================
                       LIMPIAR VARIABLES
                    ============================================ */

                    imagenSeleccionada = null;

                    botonSeleccionado = null;


                })


                .catch(function (error) {


                    console.error(error);


                    if (tarjeta) {

                        tarjeta.classList.remove(
                            'removing'
                        );

                    }


                    alert(
                        error.message ||
                        'Ocurrió un error al eliminar la imagen.'
                    );

                })


                .finally(function () {


                    botonConfirmar.disabled = false;


                    botonConfirmar.innerHTML = `

                        <i class="bi bi-trash3 me-1"></i>

                        Sí, eliminar

                    `;

                });

            }

        );

    }


    /* ============================================================
       ACTUALIZAR CONTADOR
    ============================================================ */

    function actualizarContador() {


        const galeria =
            document.getElementById(
                'galeriaImagenes'
            );


        const contador =
            document.getElementById(
                'contadorImagenes'
            );


        const numero =
            document.getElementById(
                'numeroImagenes'
            );


        const texto =
            document.getElementById(
                'textoImagenes'
            );


        const sinImagenes =
            document.getElementById(
                'sinImagenes'
            );


        let cantidad = 0;


        if (galeria) {

            cantidad =
                galeria.querySelectorAll(
                    '.gallery-item'
                ).length;

        }


        /* ============================================
           ACTUALIZAR NÚMERO
        ============================================ */

        if (numero) {

            numero.textContent =
                cantidad;

        }


        /* ============================================
           ACTUALIZAR TEXTO
        ============================================ */

        if (texto) {

            texto.textContent =
                cantidad === 1
                    ? 'imagen'
                    : 'imágenes';

        }


        /* ============================================
           MOSTRAR / OCULTAR CONTADOR
        ============================================ */

        if (contador) {

            contador.style.display =
                cantidad > 0
                    ? 'inline-block'
                    : 'none';

        }


        /* ============================================
           SI NO QUEDAN IMÁGENES
        ============================================ */

        if (cantidad === 0) {


            if (!document.getElementById('sinImagenes')) {


                const contenedor =
                    document.querySelector(
                        '.gallery-header'
                    );


                if (contenedor) {

                    contenedor.insertAdjacentHTML(
                        'afterend',
                        `

                        <div
                            class="text-center py-5 border rounded-4 bg-light"
                            id="sinImagenes"
                        >

                            <i
                                class="bi bi-images text-muted"
                                style="font-size:42px;"
                            ></i>

                            <h6 class="fw-bold mt-3">

                                No hay imágenes adicionales

                            </h6>

                            <p class="text-muted mb-0">

                                Las imágenes que agregues
                                aparecerán aquí.

                            </p>

                        </div>

                        `
                    );

                }

            }

        }

    }


    /* ============================================================
       PREVISUALIZACIÓN DE NUEVAS IMÁGENES
    ============================================================ */

    const inputImagenes =
        document.getElementById('imagenes');


    const preview =
        document.getElementById(
            'previewImagenes'
        );


    if (
        inputImagenes &&
        preview
    ) {


        inputImagenes.addEventListener(
            'change',
            function () {


                preview.innerHTML = '';


                const archivos =
                    Array.from(this.files);


                archivos.forEach(
                    function (
                        archivo,
                        index
                    ) {


                        if (
                            !archivo.type.startsWith(
                                'image/'
                            )
                        ) {

                            return;

                        }


                        const reader =
                            new FileReader();


                        reader.onload =
                            function (event) {


                                const card =
                                    document.createElement(
                                        'div'
                                    );


                                card.className =
                                    'preview-card';


                                card.innerHTML = `

                                    <img
                                        src="${event.target.result}"
                                        alt="Vista previa"
                                    >

                                    <div class="preview-card-info">

                                        <strong
                                            class="small d-block"
                                        >

                                            Imagen nueva
                                            ${index + 1}

                                        </strong>

                                        <small
                                            class="text-muted text-truncate d-block"
                                        >

                                            ${archivo.name}

                                        </small>

                                    </div>

                                `;


                                preview.appendChild(
                                    card
                                );

                            };


                        reader.readAsDataURL(
                            archivo
                        );

                    }

                );

            }

        );

    }


});

</script>

@endsection