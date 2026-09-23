@extends('admin.layouts.app')

@section('title', 'Contenidos')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            <i class="bi bi-book"></i>
            Contenidos educativos
        </h2>

        <p class="text-muted mb-0">
            Administra el material educativo de MI DECISIÓN.
        </p>
    </div>

    @if(auth()->user()->rol?->tienePermiso('contenidos.crear'))

        <a href="{{ route('admin.contenidos.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Nuevo contenido

        </a>

    @endif

</div>


@if(session('success'))

    <div class="alert alert-success">
        <i class="bi bi-check-circle"></i>
        {{ session('success') }}
    </div>

@endif


<div class="card border-0 shadow-sm">

    <div class="card-body">

        @if($contenidos->count())

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>
                            <th>Orden</th>
                            <th>Título</th>
                            <th>Tema</th>
                            <th>Recursos</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                    @foreach($contenidos as $contenido)

                        <tr>

                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $contenido->orden }}
                                </span>
                            </td>

                            <td>

                                <strong>
                                    {{ $contenido->titulo }}
                                </strong>

                            </td>

                            <td>

                                @if($contenido->tema)

                                    <span class="badge bg-primary">
                                        {{ $contenido->tema->nombre }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        Sin tema
                                    </span>

                                @endif

                            </td>

                            <td>

                                @if($contenido->contenido)
                                    <i class="bi bi-file-text text-primary"
                                       title="Texto"></i>
                                @endif

                                @if($contenido->imagen)
                                    <i class="bi bi-image text-success"
                                       title="Imagen"></i>
                                @endif

                                @if($contenido->video_url)
                                    <i class="bi bi-play-circle text-danger"
                                       title="Video"></i>
                                @endif

                                @if($contenido->iframe)
                                    <i class="bi bi-window text-info"
                                       title="Iframe"></i>
                                @endif

                            </td>

                            <td>

                                @if($contenido->activo)

                                    <span class="badge bg-success">
                                        Activo
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                            <td class="text-end">

                                @if(auth()->user()->rol?->tienePermiso('contenidos.editar'))

                                    <a
                                        href="{{ route('admin.contenidos.edit', $contenido) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Editar"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.contenidos.toggle', $contenido) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-secondary"
                                            title="{{ $contenido->activo ? 'Desactivar' : 'Activar' }}"
                                        >
                                            <i class="bi bi-power"></i>
                                        </button>

                                    </form>

                                @endif


                                @if(auth()->user()->rol?->tienePermiso('contenidos.eliminar'))

                                    <form
                                        action="{{ route('admin.contenidos.destroy', $contenido) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este contenido?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Eliminar"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="text-center py-5">

                <i class="bi bi-book fs-1 text-muted"></i>

                <h5 class="mt-3">
                    No hay contenidos
                </h5>

                <p class="text-muted">
                    Comienza creando el primer contenido educativo.
                </p>

                @if(auth()->user()->rol?->tienePermiso('contenidos.crear'))

                    <a
                        href="{{ route('admin.contenidos.create') }}"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-plus-lg"></i>
                        Crear contenido
                    </a>

                @endif

            </div>

        @endif

    </div>

</div>

@endsection