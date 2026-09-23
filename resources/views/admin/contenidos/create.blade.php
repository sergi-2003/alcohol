@extends('admin.layouts.app')

@section('title', 'Nuevo contenido')
@section('page-title', 'Nuevo contenido')

@section('content')

<style>
    .editor-shell {
        background: #f5f8fc;
        border-radius: 20px;
        padding: 22px;
    }

    .editor-header {
        background: linear-gradient(135deg, #0d6efd, #174ea6);
        color: #fff;
        border-radius: 18px;
        padding: 24px 28px;
        box-shadow: 0 10px 25px rgba(13, 110, 253, .15);
    }

    .editor-header .badge {
        background: rgba(255,255,255,.16);
        border: 1px solid rgba(255,255,255,.2);
    }

    .editor-card {
        border: 0;
        border-radius: 16px;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .06);
        overflow: hidden;
    }

    .editor-card .card-header {
        background: #fff;
        border-bottom: 1px solid #edf1f5;
        padding: 16px 20px;
    }

    .paragraph-help {
        background: #eef6ff;
        border: 1px solid #cfe5ff;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: .88rem;
    }

    #contenido {
        min-height: 330px;
        resize: vertical;
        line-height: 1.7;
    }

    .new-images-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .image-builder {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
    }

    .image-builder img {
        width: 100%;
        height: 165px;
        object-fit: cover;
        display: block;
        background: #f1f5f9;
    }

    .image-builder-body {
        padding: 12px;
    }

    .image-number {
        position: absolute;
        top: 9px;
        left: 9px;
        background: #212529;
        color: #fff;
        border-radius: 999px;
        padding: 3px 8px;
        font-size: .75rem;
        font-weight: 700;
    }

    .image-preview-wrap {
        position: relative;
    }

    .position-select {
        font-size: .88rem;
    }

    .empty-images {
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 28px;
        text-align: center;
        color: #64748b;
        background: #f8fafc;
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

    .position-label {
        font-size: .78rem;
        color: #64748b;
        margin-bottom: 4px;
    }

    .file-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .btn-remove-new {
        width: 100%;
        margin-top: 10px;
    }

    .preview-live {
        border: 1px solid #dce4ed;
        border-radius: 14px;
        background: #fff;
        padding: 20px;
    }

    .preview-live .preview-paragraph {
        margin-bottom: 14px;
        line-height: 1.75;
    }

    .preview-live .preview-image {
        display: block;
        width: min(100%, 520px);
        max-height: 330px;
        object-fit: contain;
        margin: 18px auto;
        border-radius: 12px;
    }

    @media (max-width: 992px) {
        .new-images-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .new-images-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="editor-shell">

    <div class="editor-header mb-4 d-flex justify-content-between align-items-center gap-3">
        <div>
            <span class="badge rounded-pill px-3 py-2 mb-2">
                <i class="bi bi-pencil-square"></i>
                Editor de contenido
            </span>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-journal-plus"></i>
                Crear contenido educativo
            </h2>

            <p class="mb-0 opacity-75">
                Escribe el contenido y decide exactamente después de qué párrafo aparece cada imagen.
            </p>
        </div>

        <a href="{{ route('admin.contenidos.index') }}" class="btn btn-light">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa los siguientes campos:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.contenidos.store') }}"
        method="POST"
        enctype="multipart/form-data"
        id="contenidoForm"
    >
        @csrf

        <div class="row g-4">

            {{-- ===================================================== --}}
            {{-- EDITOR --}}
            {{-- ===================================================== --}}

            <div class="col-lg-8">

                <div class="card editor-card">
                    <div class="card-header">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-file-text text-primary"></i>
                            Información educativa
                        </h5>
                    </div>

                    <div class="card-body p-4">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Título</label>

                            <input
                                type="text"
                                name="titulo"
                                class="form-control form-control-lg"
                                value="{{ old('titulo') }}"
                                placeholder="Ej. ¿Qué es el alcohol?"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Contenido educativo
                            </label>

                            <textarea
                                name="contenido"
                                id="contenido"
                                rows="14"
                                class="form-control"
                                placeholder="Escribe cada párrafo separado por una línea en blanco..."
                                required
                            >{{ old('contenido') }}</textarea>

                            <div class="paragraph-help mt-2">
                                <i class="bi bi-info-circle text-primary"></i>

                                <strong>Consejo:</strong>
                                separa cada párrafo con una línea en blanco.
                                Así Ponte Pilas podrá identificar dónde quieres colocar las imágenes.
                            </div>

                            <div class="mt-2 small text-muted">
                                <span id="contadorParrafos">0</span> párrafos detectados.
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ================================================= --}}
                {{-- IMÁGENES --}}
                {{-- ================================================= --}}

                <div class="card editor-card mt-4">
                    <div class="card-header">
                        <h5 class="fw-bold mb-1">
                            <i class="bi bi-images text-primary"></i>
                            Recursos visuales
                        </h5>

                        <small class="text-muted">
                            Cada imagen puede ubicarse después del párrafo que tú decidas.
                        </small>
                    </div>

                    <div class="card-body p-4">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Seleccionar imágenes
                            </label>

                            <div class="upload-box">
                                <div class="upload-box-icon">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                </div>

                                <div class="fw-semibold mb-1">
                                    Selecciona una o varias imágenes
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

                        {{-- Posición de cada imagen --}}
                        <div id="posicionesImagenes"></div>

                        <div
                            id="previewImagenes"
                            class="new-images-grid mt-2"
                        ></div>

                        <div id="sinImagenes" class="empty-images mt-3">
                            <i class="bi bi-images fs-2 d-block mb-2"></i>
                            Selecciona una o varias imágenes para verlas aquí.
                        </div>

                    </div>
                </div>

                {{-- ================================================= --}}
                {{-- VISTA PREVIA --}}
                {{-- ================================================= --}}

                <div class="card editor-card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-eye text-primary"></i>
                            Vista previa
                        </h5>

                        <span class="badge text-bg-light">
                            Así se organizará el contenido
                        </span>
                    </div>

                    <div class="card-body p-4">
                        <div id="vistaPreviaContenido" class="preview-live">
                            <div class="text-muted text-center py-4">
                                Escribe el contenido para ver la distribución.
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================================================= --}}
                {{-- VIDEO / IFRAME --}}
                {{-- ================================================= --}}

                <div class="card editor-card mt-4">
                    <div class="card-header">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-play-btn text-primary"></i>
                            Video e interacción
                        </h5>
                    </div>

                    <div class="card-body p-4">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                URL del video
                            </label>

                            <input
                                type="url"
                                name="video_url"
                                class="form-control"
                                value="{{ old('video_url') }}"
                                placeholder="https://www.youtube.com/watch?v=..."
                            >

                            <div class="form-text">
                                Puedes colocar la URL de un video de YouTube.
                            </div>
                        </div>

                        <div>
                            <label class="form-label fw-semibold">
                                Contenido interactivo / iframe
                            </label>

                            <textarea
                                name="iframe"
                                rows="5"
                                class="form-control"
                                placeholder="<iframe ...></iframe>"
                            >{{ old('iframe') }}</textarea>

                            <div class="form-text">
                                Código iframe proporcionado por la plataforma externa.
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- ===================================================== --}}
            {{-- CONFIGURACIÓN --}}
            {{-- ===================================================== --}}

            <div class="col-lg-4">

                <div class="card editor-card">
                    <div class="card-header">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-sliders text-primary"></i>
                            Configuración
                        </h5>
                    </div>

                    <div class="card-body p-4">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Tema</label>

                            <select
                                name="tema_id"
                                class="form-select"
                                required
                            >
                                <option value="">Seleccionar tema</option>

                                @foreach($temas as $tema)
                                    <option
                                        value="{{ $tema->id }}"
                                        {{ old('tema_id') == $tema->id ? 'selected' : '' }}
                                    >
                                        {{ $tema->orden }}. {{ $tema->titulo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Orden del contenido
                            </label>

                            <input
                                type="number"
                                name="orden"
                                class="form-control"
                                value="{{ old('orden', 1) }}"
                                min="0"
                            >
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Estado</label>

                            <div class="form-check form-switch mt-2">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="activo"
                                    id="activo"
                                    value="1"
                                    checked
                                >

                                <label class="form-check-label" for="activo">
                                    Publicar contenido
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="alert alert-info border-0 mt-4">
                    <div class="d-flex gap-2">
                        <i class="bi bi-lightbulb fs-5"></i>

                        <div>
                            <strong>¿Cómo funciona?</strong>

                            <p class="mb-0 mt-1 small">
                                Escribe los párrafos, sube las imágenes y selecciona
                                después de qué párrafo debe aparecer cada una.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card editor-card mt-4">
                    <div class="card-body p-3">
                        <div class="d-grid gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg"
                            >
                                <i class="bi bi-check-lg"></i>
                                Guardar contenido
                            </button>

                            <a
                                href="{{ route('admin.contenidos.index') }}"
                                class="btn btn-light"
                            >
                                Cancelar
                            </a>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const contenido = document.getElementById('contenido');
    const inputImagenes = document.getElementById('imagenes');
    const preview = document.getElementById('previewImagenes');
    const posiciones = document.getElementById('posicionesImagenes');
    const sinImagenes = document.getElementById('sinImagenes');
    const contador = document.getElementById('contadorParrafos');
    const vistaPrevia = document.getElementById('vistaPreviaContenido');

    const contadorNuevasImagenes =
        document.getElementById('contadorNuevasImagenes');

    const numeroNuevasImagenes =
        document.getElementById('numeroNuevasImagenes');

    const limpiarNuevasImagenes =
        document.getElementById('limpiarNuevasImagenes');


    /*
     * IMPORTANTE:
     * Cada archivo se guarda junto con su propia posición.
     *
     * Así, si eliminamos la imagen #3, las posiciones de #1, #2,
     * #4, #5, etc. NO se pierden ni se recalculan.
     */
    let imagenesSeleccionadas = [];


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


    function actualizarContador() {

        if (contador) {
            contador.textContent = obtenerParrafos().length;
        }

        if (imagenesSeleccionadas.length) {
            renderizarImagenes();
        }

        renderizarVistaPrevia();
    }


    /* =========================
       POSICIONES
    ========================= */

    function crearOpcionesPosicion(valorActual = 'final') {

        const parrafos = obtenerParrafos();

        let opciones = `
            <option value="inicio"
                ${valorActual === 'inicio' ? 'selected' : ''}>
                Al inicio
            </option>
        `;

        parrafos.forEach(function (parrafo, index) {

            const valor = String(index + 1);

            opciones += `
                <option value="${valor}"
                    ${String(valorActual) === valor ? 'selected' : ''}>
                    Después del párrafo ${index + 1}
                </option>
            `;
        });

        opciones += `
            <option value="final"
                ${valorActual === 'final' ? 'selected' : ''}>
                Al final
            </option>
        `;

        return opciones;
    }


    /* =========================
       CONTADOR
    ========================= */

    function actualizarContadorImagenes() {

        const cantidad = imagenesSeleccionadas.length;

        if (numeroNuevasImagenes) {
            numeroNuevasImagenes.textContent = cantidad;
        }

        if (contadorNuevasImagenes) {
            contadorNuevasImagenes.style.display =
                cantidad > 0 ? 'flex' : 'none';
        }
    }


    /* =========================
       RENDERIZAR IMÁGENES
    ========================= */

    function renderizarImagenes() {

        if (!preview || !posiciones) {
            return;
        }

        preview.innerHTML = '';
        posiciones.innerHTML = '';

        if (!imagenesSeleccionadas.length) {

            if (sinImagenes) {
                sinImagenes.style.display = 'block';
            }

            actualizarContadorImagenes();
            return;
        }

        if (sinImagenes) {
            sinImagenes.style.display = 'none';
        }


        imagenesSeleccionadas.forEach(function (item, index) {

            const archivo = item.file;

            if (!archivo || !archivo.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                const columna = document.createElement('div');

                columna.innerHTML = `
                    <div class="image-builder">

                        <div class="image-preview-wrap">

                            <span class="image-number">
                                #${index + 1}
                            </span>

                            <img
                                src="${event.target.result}"
                                alt="Imagen ${index + 1}"
                            >

                        </div>

                        <div class="image-builder-body">

                            <div
                                class="small fw-semibold file-name"
                                title="${escapeHtml(archivo.name)}"
                            >
                                ${escapeHtml(archivo.name)}
                            </div>

                            <div class="small text-muted mt-1">
                                ${(archivo.size / 1024 / 1024).toFixed(2)} MB
                            </div>

                            <div class="position-label mt-3">
                                Ubicación de la imagen
                            </div>

                            <select
                                class="form-select form-select-sm position-select"
                                data-image-id="${item.id}"
                            >
                                ${crearOpcionesPosicion(item.position)}
                            </select>

                            <button
                                type="button"
                                class="btn btn-outline-danger btn-sm btn-remove-new"
                                data-image-id="${item.id}"
                            >
                                <i class="bi bi-trash3 me-1"></i>
                                Quitar
                            </button>

                        </div>

                    </div>
                `;

                preview.appendChild(columna);


                /*
                 * El hidden se genera en el MISMO orden que los archivos.
                 * Cada posición pertenece al archivo que ocupa ese índice.
                 */
                const hidden = document.createElement('input');

                hidden.type = 'hidden';
                hidden.name = 'imagenes_posiciones[]';
                hidden.value = item.position;
                hidden.dataset.imageId = item.id;

                posiciones.appendChild(hidden);


                const select =
                    columna.querySelector('.position-select');

                if (select) {

                    select.addEventListener('change', function () {

                        const imagen =
                            imagenesSeleccionadas.find(function (registro) {
                                return registro.id === item.id;
                            });

                        if (!imagen) {
                            return;
                        }

                        /*
                         * Solo cambia la posición de ESTA imagen.
                         * No modifica ninguna otra.
                         */
                        imagen.position = this.value;

                        hidden.value = this.value;

                        renderizarVistaPrevia();
                    });
                }


                const botonQuitar =
                    columna.querySelector('.btn-remove-new');

                if (botonQuitar) {

                    botonQuitar.addEventListener('click', function () {

                        const id = this.dataset.imageId;

                        /*
                         * Eliminamos únicamente el registro seleccionado.
                         * Las demás imágenes conservan su posición.
                         */
                        imagenesSeleccionadas =
                            imagenesSeleccionadas.filter(function (registro) {
                                return registro.id !== id;
                            });

                        reconstruirInput();

                        renderizarImagenes();

                        renderizarVistaPrevia();
                    });
                }
            };

            reader.readAsDataURL(archivo);
        });


        actualizarContadorImagenes();

        renderizarVistaPrevia();
    }


    /* =========================
       RECONSTRUIR INPUT
    ========================= */

    function reconstruirInput() {

        if (!inputImagenes) {
            return;
        }

        const dataTransfer = new DataTransfer();

        imagenesSeleccionadas.forEach(function (item) {
            dataTransfer.items.add(item.file);
        });

        inputImagenes.files = dataTransfer.files;
    }


    /* =========================
       VISTA PREVIA
    ========================= */

    function renderizarVistaPrevia() {

        if (!vistaPrevia) {
            return;
        }

        const parrafos = obtenerParrafos();

        if (!parrafos.length) {

            vistaPrevia.innerHTML = `
                <div class="text-muted text-center py-4">
                    Escribe el contenido para ver la distribución.
                </div>
            `;

            return;
        }


        let html = '';


        function agregarImagenes(posicion) {

            imagenesSeleccionadas
                .filter(function (item) {
                    return String(item.position) === String(posicion);
                })
                .forEach(function (item) {

                    const url =
                        URL.createObjectURL(item.file);

                    html += `
                        <img
                            src="${url}"
                            class="preview-image"
                            alt="Imagen"
                        >
                    `;
                });
        }


        agregarImagenes('inicio');


        parrafos.forEach(function (parrafo, index) {

            html += `
                <div class="preview-paragraph">
                    ${escapeHtml(parrafo).replace(/\n/g, '<br>')}
                </div>
            `;

            agregarImagenes(String(index + 1));
        });


        agregarImagenes('final');


        vistaPrevia.innerHTML = html;
    }


    /* =========================
       ESCAPAR HTML
    ========================= */

    function escapeHtml(texto) {

        const div = document.createElement('div');

        div.textContent = texto;

        return div.innerHTML;
    }


    /* =========================
       SELECCIONAR IMÁGENES
    ========================= */

    if (inputImagenes) {

        inputImagenes.addEventListener('change', function () {

            /*
             * Creamos un ID único para cada imagen.
             *
             * Ejemplo:
             * imagen_17200001
             * imagen_17200002
             *
             * El ID NO cambia aunque se elimine otra imagen.
             */
            const nuevasImagenes =
                Array.from(this.files)
                    .filter(function (archivo) {
                        return archivo.type.startsWith('image/');
                    })
                    .map(function (archivo) {

                        return {
                            id:
                                'imagen_' +
                                Date.now() +
                                '_' +
                                Math.random()
                                    .toString(36)
                                    .substring(2, 9),

                            file: archivo,

                            /*
                             * Cada imagen comienza en "final".
                             * Si el usuario cambia su posición,
                             * solo se modifica esta imagen.
                             */
                            position: 'final'
                        };
                    });


            /*
             * Se agregan a las que ya existían.
             *
             * Esto permite seleccionar imágenes en varias tandas
             * sin perder las posiciones que ya configuraste.
             */
            imagenesSeleccionadas =
                imagenesSeleccionadas.concat(nuevasImagenes);


            reconstruirInput();

            renderizarImagenes();

            renderizarVistaPrevia();
        });
    }


    /* =========================
       LIMPIAR TODAS
    ========================= */

    if (limpiarNuevasImagenes) {

        limpiarNuevasImagenes.addEventListener('click', function () {

            imagenesSeleccionadas = [];

            if (inputImagenes) {
                inputImagenes.value = '';
            }

            renderizarImagenes();

            renderizarVistaPrevia();
        });
    }


    /* =========================
       INICIAR
    ========================= */

    actualizarContador();

});
</script>

@endsection
