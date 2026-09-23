@extends('admin.layouts.app')

@section('title', 'Editar tema')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            <i class="bi bi-pencil-square"></i>
            Editar tema
        </h2>

        <p class="text-muted mb-0">
            Modifica la información del tema educativo.
        </p>
    </div>

    <a
        href="{{ route('admin.temas.index') }}"
        class="btn btn-outline-secondary"
    >
        <i class="bi bi-arrow-left"></i>
        Volver
    </a>

</div>

@if($errors->any())

    <div class="alert alert-danger">

        <strong>
            <i class="bi bi-exclamation-triangle"></i>
            Revisa los siguientes campos:
        </strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <form
            action="{{ route('admin.temas.update', $tema) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- TÍTULO --}}
                <div class="col-md-8">

                    <label class="form-label fw-semibold">
                        Título del tema
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        class="form-control"
                        value="{{ old('titulo', $tema->titulo) }}"
                        maxlength="200"
                        required
                    >

                </div>

                {{-- ORDEN --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Orden
                    </label>

                    <input
                        type="number"
                        name="orden"
                        class="form-control"
                        value="{{ old('orden', $tema->orden) }}"
                        min="0"
                    >

                </div>

                {{-- SLUG --}}
                <div class="col-md-8">

                    <label class="form-label fw-semibold">
                        Slug
                    </label>

                    <input
                        type="text"
                        name="slug"
                        class="form-control"
                        value="{{ old('slug', $tema->slug) }}"
                        maxlength="200"
                    >

                    <div class="form-text">
                        Identificador amigable del tema.
                        Ejemplo: alcohol-y-emociones
                    </div>

                </div>

                {{-- ICONO --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Icono
                    </label>

                    <input
                        type="text"
                        name="icono"
                        class="form-control"
                        value="{{ old('icono', $tema->icono) }}"
                        maxlength="100"
                        placeholder="bi bi-heart"
                    >

                    <div class="form-text">
                        Ejemplo: bi bi-heart
                    </div>

                </div>

                {{-- DESCRIPCIÓN --}}
                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Descripción corta
                    </label>

                    <textarea
                        name="descripcion_corta"
                        class="form-control"
                        rows="4"
                        placeholder="Escribe una breve descripción del tema..."
                    >{{ old('descripcion_corta', $tema->descripcion_corta) }}</textarea>

                </div>

                {{-- IMAGEN ACTUAL --}}
                @if($tema->imagen)

                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Imagen actual
                        </label>

                        <div class="mt-2">

                            <img
                                src="{{ asset('storage/' . $tema->imagen) }}"
                                alt="{{ $tema->titulo }}"
                                class="rounded border"
                                style="
                                    max-width: 280px;
                                    max-height: 180px;
                                    object-fit: cover;
                                "
                            >

                        </div>

                    </div>

                @endif

                {{-- NUEVA IMAGEN --}}
                <div class="col-md-8">

                    <label class="form-label fw-semibold">
                        Imagen del tema
                    </label>

                    <input
                        type="file"
                        name="imagen"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <div class="form-text">
                        Déjalo vacío si deseas conservar la imagen actual.
                        Máximo 2 MB.
                    </div>

                </div>

                {{-- ESTADO --}}
                <div class="col-md-4">

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
                            {{ old('activo', $tema->activo) ? 'checked' : '' }}
                        >

                        <label
                            class="form-check-label"
                            for="activo"
                        >
                            Tema activo
                        </label>

                    </div>

                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route('admin.temas.index') }}"
                    class="btn btn-light"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="bi bi-save"></i>
                    Guardar cambios

                </button>

            </div>

        </form>

    </div>

</div>

@endsection