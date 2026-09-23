@extends('admin.layouts.app')

@section('title', 'Nuevo tema')
@section('page-title', 'Nuevo tema')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            <i class="bi bi-collection"></i>
            Crear tema
        </h2>

        <p class="text-muted mb-0">
            Crea una nueva categoría para organizar los contenidos educativos.
        </p>
    </div>

    <a href="{{ route('admin.temas.index') }}" class="btn btn-outline-secondary">
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

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <form
            action="{{ route('admin.temas.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="row g-4">

                {{-- Nombre --}}

                <div class="col-md-8">

                    <label class="form-label fw-semibold">
                        Nombre del tema
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        value="{{ old('nombre') }}"
                        placeholder="Ej. Presión social"
                        required
                    >

                    <div class="form-text">
                        Es el nombre que verá el participante.
                    </div>

                </div>


                {{-- Orden --}}

                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Orden
                    </label>

                    <input
                        type="number"
                        name="orden"
                        class="form-control"
                        value="{{ old('orden', 1) }}"
                        min="1"
                    >

                    <div class="form-text">
                        Define la posición del tema.
                    </div>

                </div>


                {{-- Descripción --}}

                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        rows="4"
                        class="form-control"
                        maxlength="500"
                        placeholder="Escribe una breve descripción del tema..."
                    >{{ old('descripcion') }}</textarea>

                    <div class="form-text">
                        Máximo 500 caracteres.
                    </div>

                </div>


                {{-- Imagen --}}

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
                        Formatos permitidos: JPG, JPEG, PNG y WEBP.
                        Máximo 2 MB.
                    </div>

                </div>


                {{-- Estado --}}

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
                            checked
                        >

                        <label class="form-check-label" for="activo">
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
                    <i class="bi bi-check-lg"></i>
                    Guardar tema
                </button>

            </div>

        </form>

    </div>

</div>

@endsection