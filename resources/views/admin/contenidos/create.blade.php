@extends('admin.layouts.app')

@section('title', 'Nuevo contenido')

@section('page-title', 'Nuevo contenido')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold mb-1">

            <i class="bi bi-journal-plus"></i>

            Crear contenido educativo

        </h2>

        <p class="text-muted mb-0">

            Crea una nueva pieza educativa para MI DECISIÓN.

        </p>

    </div>


    <a
        href="{{ route('admin.contenidos.index') }}"
        class="btn btn-outline-secondary"
    >

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
>

    @csrf


    <div class="row g-4">


        {{-- ========================================================= --}}
        {{-- CONTENIDO PRINCIPAL --}}
        {{-- ========================================================= --}}

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">

                        <i class="bi bi-file-text"></i>

                        Información educativa

                    </h5>


                    {{-- TÍTULO --}}

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Título

                        </label>

                        <input
                            type="text"
                            name="titulo"
                            class="form-control form-control-lg"
                            value="{{ old('titulo') }}"
                            placeholder="Ej. ¿Qué es el alcohol?"
                            required
                        >

                    </div>


                    {{-- CONTENIDO --}}

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Contenido educativo

                        </label>

                        <textarea
                            name="contenido"
                            id="contenido"
                            rows="12"
                            class="form-control"
                            placeholder="Escribe aquí el contenido educativo..."
                        >{{ old('contenido') }}</textarea>

                        <div class="form-text">

                            Utiliza textos cortos, claros y fáciles de comprender.

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- MULTIMEDIA --}}
            {{-- ========================================================= --}}

            <div class="card border-0 shadow-sm mt-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">

                        <i class="bi bi-images"></i>

                        Recursos multimedia

                    </h5>


                    {{-- ================================================= --}}
                    {{-- IMÁGENES --}}
                    {{-- ================================================= --}}

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            <i class="bi bi-images"></i>

                            Imágenes

                        </label>


                        <input
                            type="file"
                            name="imagenes[]"
                            id="imagenes"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                            multiple
                        >


                        <div class="form-text mt-2">

                            Puedes seleccionar varias imágenes al mismo tiempo.

                            <br>

                            Formatos permitidos:
                            JPG, JPEG, PNG y WEBP.

                            Máximo 4 MB por imagen.

                        </div>

                    </div>


                    {{-- PREVISUALIZACIÓN --}}

                    <div
                        id="previewImagenes"
                        class="row g-3 mb-4"
                    >
                    </div>


                    <hr>


                    {{-- ================================================= --}}
                    {{-- VIDEO --}}
                    {{-- ================================================= --}}

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            <i class="bi bi-play-circle"></i>

                            Video

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


                    <hr>


                    {{-- ================================================= --}}
                    {{-- IFRAME --}}
                    {{-- ================================================= --}}

                    <div>

                        <label class="form-label fw-semibold">

                            <i class="bi bi-window"></i>

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


        {{-- ========================================================= --}}
        {{-- CONFIGURACIÓN --}}
        {{-- ========================================================= --}}

        <div class="col-lg-4">


            {{-- CONFIGURACIÓN --}}

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">

                        <i class="bi bi-gear"></i>

                        Configuración

                    </h5>


                    {{-- TEMA --}}

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Tema

                        </label>

                        <select
                            name="tema_id"
                            class="form-select"
                            required
                        >

                            <option value="">

                                Seleccionar tema

                            </option>


                            @foreach($temas as $tema)

                                <option
                                    value="{{ $tema->id }}"
                                    {{ old('tema_id') == $tema->id ? 'selected' : '' }}
                                >

                                    {{ $tema->orden }}.
                                    {{ $tema->titulo }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- ORDEN --}}

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


                    {{-- ESTADO --}}

                    <div>

                        <label class="form-label fw-semibold">

                            Estado

                        </label>


                        <div class="form-check form-switch mt-2">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="activo"
                                id="activo"
                                value="1"
                                checked
                            >

                            <label
                                class="form-check-label"
                                for="activo"
                            >

                                Publicar contenido

                            </label>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- AYUDA --}}
            {{-- ========================================================= --}}

            <div class="alert alert-info border-0 mt-4">

                <div class="d-flex gap-2">

                    <i class="bi bi-info-circle fs-5"></i>

                    <div>

                        <strong>Recomendación</strong>

                        <p class="mb-0 mt-1 small">

                            Mantén los contenidos breves,
                            visuales y fáciles de comprender.

                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- BOTONES --}}
            {{-- ========================================================= --}}

            <div class="card border-0 shadow-sm mt-4">

                <div class="card-body">

                    <div class="d-grid gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
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


{{-- ========================================================= --}}
{{-- PREVISUALIZACIÓN DE IMÁGENES --}}
{{-- ========================================================= --}}

<script>

document.getElementById('imagenes').addEventListener('change', function(event) {

    const preview = document.getElementById('previewImagenes');

    preview.innerHTML = '';

    const archivos = event.target.files;

    Array.from(archivos).forEach((archivo, index) => {

        if (!archivo.type.startsWith('image/')) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {

            const columna = document.createElement('div');

            columna.className = 'col-md-4 col-lg-3';

            columna.innerHTML = `
                <div class="card border shadow-sm h-100">

                    <img
                        src="${e.target.result}"
                        class="card-img-top"
                        style="
                            height: 140px;
                            object-fit: cover;
                        "
                    >

                    <div class="card-body p-2">

                        <small class="text-muted d-block text-truncate">

                            Imagen ${index + 1}

                        </small>

                        <small class="text-muted">

                            ${(archivo.size / 1024 / 1024).toFixed(2)} MB

                        </small>

                    </div>

                </div>
            `;

            preview.appendChild(columna);
        };

        reader.readAsDataURL(archivo);

    });

});

</script>

@endsection