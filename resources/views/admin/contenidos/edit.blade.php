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

    .main-image {
        width: 100%;
        max-height: 260px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

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
    }

    .btn-remove-new {
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

    .gallery-delete {
        width: 100%;
        margin-top: 10px;
    }

    .sticky-actions {
        position: sticky;
        bottom: 15px;
        z-index: 10;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,.08);
    }

    .gallery-item.removing {
        opacity: .4;
        pointer-events: none;
    }

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
    }
</style>

<div class="content-editor">

    {{-- ENCABEZADO --}}
    <div class="editor-title">
        <div class="d-flex justify-content-between align-items-center gap-3">
            <div>
                <div class="small opacity-75 mb-1">EDITOR DE CONTENIDO</div>
                <h3 class="mb-1">{{ $contenido->titulo }}</h3>
                <div class="small opacity-75">
                    Modifica el texto, imágenes y configuración.
                </div>
            </div>

            <a href="{{ route('admin.contenidos.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left me-1"></i>
                Volver
            </a>
        </div>
    </div>

    {{-- MENSAJES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa estos campos:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.contenidos.update', $contenido) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- COLUMNA PRINCIPAL --}}
            <div class="col-lg-8">

                {{-- INFORMACIÓN --}}
                <div class="editor-card">
                    <div class="editor-card-header">
                        <i class="bi bi-file-text text-primary me-2"></i>
                        Información educativa
                    </div>

                    <div class="editor-card-body">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Título</label>

                            <input
                                type="text"
                                name="titulo"
                                class="form-control"
                                value="{{ old('titulo', $contenido->titulo) }}"
                                required
                            >
                        </div>

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
                                    <span id="contadorParrafos">0</span> párrafos.
                                </strong>
                            </div>
                        </div>

                    </div>
                </div>


                {{-- IMÁGENES --}}
                <div class="editor-card">
                    <div class="editor-card-header d-flex justify-content-between align-items-center">
                        <span>
                            <i class="bi bi-images text-primary me-2"></i>
                            Imágenes
                        </span>

                        <span class="badge bg-primary" id="contadorImagenes">
                            <span id="numeroImagenes">{{ $contenido->imagenes->count() }}</span>
                            <span id="textoImagenes">
                                {{ $contenido->imagenes->count() == 1 ? 'imagen' : 'imágenes' }}
                            </span>
                        </span>
                    </div>

                    <div class="editor-card-body">

                        {{-- IMAGEN PRINCIPAL --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Imagen principal
                            </label>

                            @if($contenido->imagen)
                                <img
                                    class="main-image mb-3"
                                    src="{{ route('media.contenido', ['filename' => basename($contenido->imagen)]) }}"
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
                                Opcional. Si seleccionas una imagen, reemplazará la actual.
                            </div>
                        </div>

                        <hr>

                        {{-- GALERÍA EXISTENTE --}}
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-1 fw-bold">Imágenes actuales</h6>
                                    <small class="text-muted">
                                        Puedes eliminar una imagen sin eliminar el contenido.
                                    </small>
                                </div>
                            </div>

                            @if($contenido->imagenes->count() > 0)

                                <div class="gallery-list" id="galeriaImagenes">

                                    @foreach($contenido->imagenes as $imagen)

                                        @php
                                            $config = is_array($imagen->configuracion)
                                                ? $imagen->configuracion
                                                : [];

                                            $posicionGuardada = $config['posicion'] ?? 'final';
                                        @endphp

                                        <div
                                            class="gallery-item"
                                            id="imagen-recurso-{{ $imagen->id }}"
                                        >

                                            <img
                                                src="{{ route('media.recurso', ['filename' => basename($imagen->ruta)]) }}"
                                                alt="Imagen {{ $loop->iteration }}"
                                            >

                                            <div class="gallery-body">

                                                <div class="d-flex justify-content-between mb-2">
                                                    <strong>Imagen {{ $loop->iteration }}</strong>

                                                    <span class="badge bg-light text-dark">
                                                        #{{ $imagen->orden }}
                                                    </span>
                                                </div>

                                                <div class="small text-muted mb-2">
                                                    <i class="bi bi-pin-angle me-1"></i>
                                                    @if($posicionGuardada === 'inicio')
                                                        Al inicio
                                                    @elseif($posicionGuardada === 'final')
                                                        Al final
                                                    @else
                                                        Después del párrafo {{ $posicionGuardada }}
                                                    @endif
                                                </div>

                                               
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

                        {{-- NUEVAS IMÁGENES --}}
                        <div>
                            <div class="mb-3">
                                <h6 class="fw-bold mb-1">Agregar imágenes</h6>
                                <small class="text-muted">
                                    Puedes agregar una o varias imágenes al mismo tiempo.
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
                                    JPG, JPEG, PNG o WEBP · Máximo 4 MB por imagen
                                </div>

                                <input
                                    type="file"
                                    name="imagenes[]"
                                    id="imagenes"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                    multiple
                                >
                            </div>

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

                            {{-- POSICIONES DE LAS NUEVAS IMÁGENES --}}
                            <div id="posicionesImagenes"></div>

                            <div
                                id="previewImagenes"
                                class="new-images-grid mt-2"
                            ></div>

                            <div
                                id="sinNuevasImagenes"
                                class="empty-new-images mt-3"
                            >
                                <i class="bi bi-images fs-4 d-block mb-2"></i>
                                Selecciona una o varias imágenes para verlas aquí.
                            </div>
                        </div>

                    </div>
                </div>


                {{-- VIDEO E IFRAME --}}
                <div class="editor-card">
                    <div class="editor-card-header">
                        <i class="bi bi-play-circle text-primary me-2"></i>
                        Video y contenido interactivo
                    </div>

                    <div class="editor-card-body">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Video de YouTube
                            </label>

                            <input
                                type="url"
                                name="video_url"
                                class="form-control"
                                value="{{ old('video_url', $contenido->video_url) }}"
                                placeholder="https://www.youtube.com/watch?v=..."
                            >
                        </div>

                        <div>
                            <label class="form-label fw-semibold">
                                Iframe
                            </label>

                            <textarea
                                name="iframe"
                                rows="5"
                                class="form-control"
                                placeholder="<iframe ...></iframe>"
                            >{{ old('iframe', $contenido->iframe) }}</textarea>
                        </div>

                    </div>
                </div>

            </div>


            {{-- COLUMNA DERECHA --}}
            <div class="col-lg-4">

                <div class="editor-card">
                    <div class="editor-card-header">
                        <i class="bi bi-gear text-primary me-2"></i>
                        Configuración
                    </div>

                    <div class="editor-card-body">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tema</label>

                            <select name="tema_id" class="form-select" required>
                                @foreach($temas as $tema)
                                    <option
                                        value="{{ $tema->id }}"
                                        {{ old('tema_id', $contenido->tema_id) == $tema->id ? 'selected' : '' }}
                                    >
                                        {{ $tema->orden }}. {{ $tema->titulo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
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
                                Define la posición dentro del tema.
                            </div>
                        </div>

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

                                <label class="form-check-label fw-semibold" for="activo">
                                    Contenido publicado
                                </label>
                            </div>

                            <small class="text-muted">
                                Si está activo, los participantes podrán verlo.
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
                        1. Escribe el contenido.<br>
                        2. Agrega las imágenes.<br>
                        3. Selecciona dónde debe aparecer cada imagen.<br>
                        4. Guarda los cambios.
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


{{-- MODAL ELIMINAR IMAGEN --}}
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
                    <strong>El contenido no será eliminado.</strong>
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

    const contenido = document.getElementById('contenido');
    const inputImagenes = document.getElementById('imagenes');
    const preview = document.getElementById('previewImagenes');
    const posiciones = document.getElementById('posicionesImagenes');
    const sinNuevasImagenes = document.getElementById('sinNuevasImagenes');
    const contadorParrafos = document.getElementById('contadorParrafos');

    let archivosSeleccionados = [];
    let imagenSeleccionada = null;
    let botonSeleccionado = null;

    const modalElement = document.getElementById('modalEliminarImagen');
    const modal = modalElement
        ? new bootstrap.Modal(modalElement)
        : null;

    const botonConfirmar = document.getElementById(
        'confirmarEliminarImagen'
    );


    /* =========================
       PÁRRAFOS
    ========================= */

    function obtenerParrafos() {

        if (!contenido) {
            return [];
        }

        const texto = contenido.value
            .replace(/\r\n/g, '\n')
            .replace(/\r/g, '\n')
            .trim();

        if (!texto) {
            return [];
        }

        return texto
            .split(/\n[ \t]*\n+/)
            .map(texto => texto.trim())
            .filter(texto => texto.length > 0);
    }


    function actualizarContadorParrafos() {

        if (contadorParrafos) {
            contadorParrafos.textContent =
                obtenerParrafos().length;
        }
    }


    /* =========================
       OPCIONES DE POSICIÓN
    ========================= */

    function crearOpcionesPosicion() {

        const parrafos = obtenerParrafos();

        let opciones = `
            <option value="inicio">
                Al inicio
            </option>
        `;

        parrafos.forEach(function (parrafo, index) {

            opciones += `
                <option value="${index + 1}">
                    Después del párrafo ${index + 1}
                </option>
            `;
        });

        opciones += `
            <option value="final" selected>
                Al final
            </option>
        `;

        return opciones;
    }


    /* =========================
       NUEVAS IMÁGENES
    ========================= */

    const contadorNuevasImagenes =
        document.getElementById('contadorNuevasImagenes');

    const numeroNuevasImagenes =
        document.getElementById('numeroNuevasImagenes');

    const limpiarNuevasImagenes =
        document.getElementById('limpiarNuevasImagenes');


    function actualizarContadorNuevasImagenes() {

        const cantidad = archivosSeleccionados.length;

        if (numeroNuevasImagenes) {
            numeroNuevasImagenes.textContent = cantidad;
        }

        if (contadorNuevasImagenes) {
            contadorNuevasImagenes.style.display =
                cantidad > 0 ? 'flex' : 'none';
        }
    }


    function mostrarNuevasImagenes() {

        if (!preview || !posiciones) {
            return;
        }

        preview.innerHTML = '';
        posiciones.innerHTML = '';

        if (!archivosSeleccionados.length) {

            if (sinNuevasImagenes) {
                sinNuevasImagenes.style.display = 'block';
            }

            actualizarContadorNuevasImagenes();

            return;
        }

        if (sinNuevasImagenes) {
            sinNuevasImagenes.style.display = 'none';
        }

        archivosSeleccionados.forEach(function (archivo, index) {

            if (!archivo.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                const contenedor = document.createElement('div');

                contenedor.className = 'new-image';

                contenedor.innerHTML = `
                    <img
                        src="${event.target.result}"
                        alt="Imagen ${index + 1}"
                    >

                    <div class="new-image-body">

                        <div class="fw-semibold small mb-1">
                            Imagen ${index + 1}
                        </div>

                        <div
                            class="small text-muted file-name"
                            title="${archivo.name}"
                        >
                            ${archivo.name}
                        </div>

                        <div class="small text-muted mt-1">
                            ${(archivo.size / 1024 / 1024).toFixed(2)} MB
                        </div>

                        <div class="position-select-wrap">

                            <label>
                                Ubicación de la imagen
                            </label>

                            <select
                                class="form-select form-select-sm position-select"
                                data-index="${index}"
                            >
                                ${crearOpcionesPosicion()}
                            </select>

                        </div>

                        <button
                            type="button"
                            class="btn btn-outline-danger btn-sm btn-remove-new"
                            data-index="${index}"
                        >
                            <i class="bi bi-trash3 me-1"></i>
                            Quitar
                        </button>

                    </div>
                `;

                preview.appendChild(contenedor);


                const hidden = document.createElement('input');

                hidden.type = 'hidden';
                hidden.name = 'imagenes_posiciones[]';
                hidden.value = 'final';
                hidden.dataset.imageIndex = index;

                posiciones.appendChild(hidden);


                const select =
                    contenedor.querySelector('.position-select');

                if (select) {

                    select.addEventListener('change', function () {

                        hidden.value = this.value;

                    });
                }


                const botonQuitar =
                    contenedor.querySelector('.btn-remove-new');

                if (botonQuitar) {

                    botonQuitar.addEventListener('click', function () {

                        const indice =
                            Number(this.dataset.index);

                        archivosSeleccionados.splice(indice, 1);

                        reconstruirInputArchivos();

                        mostrarNuevasImagenes();
                    });
                }
            };

            reader.readAsDataURL(archivo);
        });

        actualizarContadorNuevasImagenes();
    }


    function reconstruirInputArchivos() {

        if (!inputImagenes) {
            return;
        }

        const dataTransfer = new DataTransfer();

        archivosSeleccionados.forEach(function (archivo) {
            dataTransfer.items.add(archivo);
        });

        inputImagenes.files = dataTransfer.files;
    }


    if (limpiarNuevasImagenes) {

        limpiarNuevasImagenes.addEventListener('click', function () {

            archivosSeleccionados = [];

            if (inputImagenes) {
                inputImagenes.value = '';
            }

            mostrarNuevasImagenes();

        });
    }


    /* =========================
       CAMBIAR CONTENIDO
    ========================= */

    if (contenido) {

        contenido.addEventListener('input', function () {

            actualizarContadorParrafos();

            if (archivosSeleccionados.length) {
                mostrarNuevasImagenes();
            }

        });
    }


    /* =========================
       SELECCIONAR IMÁGENES
    ========================= */

    if (inputImagenes) {

        inputImagenes.addEventListener('change', function () {

            archivosSeleccionados =
                Array.from(this.files).filter(function (archivo) {
                    return archivo.type.startsWith('image/');
                });

            mostrarNuevasImagenes();

        });
    }


    /* =========================
       ELIMINAR IMAGEN
    ========================= */

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


    if (botonConfirmar) {

        botonConfirmar.addEventListener('click', function () {

            if (!imagenSeleccionada) {
                return;
            }

            const url = imagenSeleccionada.url;
            const id = imagenSeleccionada.id;

            const tarjeta = document.getElementById(
                'imagen-recurso-' + id
            );


            botonConfirmar.disabled = true;

            botonConfirmar.innerHTML = `
                <span class="spinner-border spinner-border-sm me-1"></span>
                Eliminando...
            `;


            if (tarjeta) {
                tarjeta.classList.add('removing');
            }


            fetch(url, {

                method: 'DELETE',

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }

            })
            .then(function (response) {

                if (!response.ok) {
                    throw new Error(
                        'No se pudo eliminar la imagen.'
                    );
                }

                return response;
            })
            .then(function () {

                if (modal) {
                    modal.hide();
                }

                if (tarjeta) {
                    tarjeta.remove();
                }

                actualizarContadorGaleria();

                imagenSeleccionada = null;
                botonSeleccionado = null;

            })
            .catch(function (error) {

                console.error(error);

                if (tarjeta) {
                    tarjeta.classList.remove('removing');
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

        });
    }


    /* =========================
       CONTADOR GALERÍA
    ========================= */

    function actualizarContadorGaleria() {

        const galeria =
            document.getElementById('galeriaImagenes');

        const numero =
            document.getElementById('numeroImagenes');

        const texto =
            document.getElementById('textoImagenes');

        if (!galeria) {
            if (numero) numero.textContent = 0;
            if (texto) texto.textContent = 'imágenes';
            return;
        }

        const cantidad =
            galeria.querySelectorAll('.gallery-item').length;

        if (numero) {
            numero.textContent = cantidad;
        }

        if (texto) {
            texto.textContent =
                cantidad === 1
                    ? 'imagen'
                    : 'imágenes';
        }
    }


    /* =========================
       INICIAR
    ========================= */

    actualizarContadorParrafos();
    actualizarContadorGaleria();

});
</script>

@endsection
