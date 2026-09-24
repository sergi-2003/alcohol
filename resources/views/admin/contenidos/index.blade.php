@extends('admin.layouts.app')

@section('title', 'Contenidos')

@section('content')

<style>
    .content-page {
        --primary: #0d6efd;
        --primary-dark: #084298;
        --text-dark: #172033;
        --text-muted: #6c757d;
        --border: #e9edf3;
        --soft-bg: #f7f9fc;
    }

    /* HEADER */
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .content-header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .content-header-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: white;
        font-size: 23px;
        box-shadow: 0 8px 20px rgba(13, 110, 253, .18);
    }

    .content-header h2 {
        color: var(--text-dark);
        font-size: 25px;
        margin: 0;
        font-weight: 700;
    }

    .content-header p {
        margin: 3px 0 0;
        color: var(--text-muted);
        font-size: 14px;
    }

    .btn-new-content {
        border: 0;
        border-radius: 11px;
        padding: 11px 18px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 6px 16px rgba(13, 110, 253, .16);
        transition: .2s ease;
    }

    .btn-new-content:hover {
        transform: translateY(-1px);
        box-shadow: 0 9px 20px rgba(13, 110, 253, .22);
    }

    /* SUMMARY */
    .summary-card {
        border: 1px solid var(--border);
        border-radius: 16px;
        background: white;
        padding: 18px 20px;
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .summary-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .summary-icon {
        width: 43px;
        height: 43px;
        border-radius: 12px;
        background: #eef5ff;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .summary-number {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1;
    }

    .summary-label {
        font-size: 13px;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .summary-description {
        font-size: 13px;
        color: var(--text-muted);
    }

    /* TABLE CARD */
    .content-table-card {
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        background: white;
        box-shadow: 0 5px 20px rgba(20, 30, 50, .04);
    }

    .table-top {
        padding: 18px 22px;
        border-bottom: 1px solid var(--border);
        background: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-top-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .table-top-subtitle {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .table-container {
        overflow-x: auto;
    }

    .content-table {
        margin: 0;
        min-width: 850px;
    }

    .content-table thead th {
        background: #f8fafc;
        color: #687386;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 700;
        border-bottom: 1px solid var(--border);
        padding: 14px 18px;
        white-space: nowrap;
    }

    .content-table tbody td {
        padding: 16px 18px;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: middle;
    }

    .content-table tbody tr {
        transition: background .15s ease;
    }

    .content-table tbody tr:hover {
        background: #fbfcff;
    }

    .content-table tbody tr:last-child td {
        border-bottom: 0;
    }

    /* ORDER */
    .order-badge {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #f1f4f8;
        color: #4f5d73;
        font-size: 13px;
        font-weight: 700;
    }

    /* TITLE */
    .content-title {
        color: var(--text-dark);
        font-weight: 650;
        font-size: 14px;
        margin-bottom: 3px;
    }

    .content-id {
        color: #9aa3af;
        font-size: 11px;
    }

    /* THEME */
    .theme-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eef5ff;
        color: #0b5ed7;
        border-radius: 8px;
        padding: 6px 9px;
        font-size: 12px;
        font-weight: 600;
    }

    .theme-badge i {
        font-size: 11px;
    }

    /* RESOURCES */
    .resource-list {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .resource-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f5f7fa;
        border: 1px solid #edf0f4;
        font-size: 14px;
    }

    .resource-icon.text {
        color: #0d6efd;
    }

    .resource-icon.image {
        color: #198754;
    }

    .resource-icon.video {
        color: #dc3545;
    }

    .resource-icon.iframe {
        color: #0dcaf0;
    }

    .resource-count {
        font-size: 11px;
        color: #7a8494;
        margin-left: 2px;
    }

    .no-resource {
        color: #adb5bd;
        font-size: 12px;
    }

    /* STATUS */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 20px;
        padding: 6px 10px;
        font-size: 11px;
        font-weight: 700;
    }

    .status-badge::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-active {
        background: #eaf8f0;
        color: #198754;
    }

    .status-active::before {
        background: #198754;
    }

    .status-inactive {
        background: #f1f3f5;
        color: #6c757d;
    }

    .status-inactive::before {
        background: #6c757d;
    }

    /* ACTIONS */
    .actions-wrapper {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #f8f9fb;
        padding: 4px;
        border-radius: 10px;
        border: 1px solid #edf0f3;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 7px;
        border: 0;
        background: transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: .15s ease;
    }

    .action-edit {
        color: #0d6efd;
    }

    .action-edit:hover {
        background: #e8f1ff;
    }

    .action-toggle {
        color: #6c757d;
    }

    .action-toggle:hover {
        background: #e9ecef;
    }

    .action-delete {
        color: #dc3545;
    }

    .action-delete:hover {
        background: #ffe8eb;
    }

    /* EMPTY */
    .empty-state {
        text-align: center;
        padding: 65px 25px;
    }

    .empty-icon {
        width: 78px;
        height: 78px;
        border-radius: 22px;
        background: #eef5ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        margin: 0 auto 18px;
    }

    .empty-state h5 {
        color: var(--text-dark);
        font-weight: 700;
        margin-bottom: 7px;
    }

    .empty-state p {
        color: var(--text-muted);
        max-width: 420px;
        margin: 0 auto 20px;
        font-size: 14px;
    }

    /* ALERT */
    .content-alert {
        border: 0;
        border-radius: 12px;
        padding: 13px 16px;
        box-shadow: 0 4px 12px rgba(25, 135, 84, .08);
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {

        .content-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-new-content {
            width: 100%;
            justify-content: center;
        }

        .summary-card {
            align-items: flex-start;
            flex-direction: column;
        }

        .summary-description {
            display: none;
        }

        .content-header h2 {
            font-size: 21px;
        }

        .content-header-icon {
            width: 45px;
            height: 45px;
        }
    }
</style>


<div class="content-page">

    {{-- HEADER --}}
    <div class="content-header">

        <div class="content-header-left">

            <div class="content-header-icon">
                <i class="bi bi-journal-text"></i>
            </div>

            <div>
                <h2>Contenidos educativos</h2>

                <p>
                    Administra el material educativo de MI DECISIÓN.
                </p>
            </div>

        </div>


        @if(auth()->user()->rol?->tienePermiso('contenidos.crear'))

            <a
                href="{{ route('admin.contenidos.create') }}"
                class="btn btn-primary btn-new-content"
            >
                <i class="bi bi-plus-lg"></i>
                Nuevo contenido
            </a>

        @endif

    </div>


    {{-- MENSAJE --}}
    @if(session('success'))

        <div class="alert alert-success content-alert mb-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- RESUMEN --}}
    <div class="summary-card">

        <div class="summary-left">

            <div class="summary-icon">
                <i class="bi bi-collection"></i>
            </div>

            <div>

                <div class="summary-number">
                    {{ $contenidos->count() }}
                </div>

                <div class="summary-label">
                    {{ $contenidos->count() == 1 ? 'Contenido registrado' : 'Contenidos registrados' }}
                </div>

            </div>

        </div>

        <div class="summary-description">
            Material disponible para la experiencia educativa.
        </div>

    </div>


    {{-- CONTENIDOS --}}
    <div class="content-table-card">

        @if($contenidos->count())

            <div class="table-top">

                <div>

                    <div class="table-top-title">
                        Biblioteca educativa
                    </div>

                    <div class="table-top-subtitle">
                        Contenidos organizados por tema y orden de presentación.
                    </div>

                </div>

            </div>


            <div class="table-container">

                <table class="table content-table align-middle">

                    <thead>

                        <tr>

                            <th width="80">
                                Orden
                            </th>

                            <th>
                                Contenido
                            </th>

                            <th>
                                Tema
                            </th>

                            <th>
                                Recursos
                            </th>

                            <th>
                                Estado
                            </th>

                            <th class="text-end">
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @foreach($contenidos as $contenido)

                        <tr>

                            {{-- ORDEN --}}
                            <td>

                                <span class="order-badge">
                                    {{ $contenido->orden }}
                                </span>

                            </td>


                            {{-- TITULO --}}
                            <td>

                                <div class="content-title">
                                    {{ $contenido->titulo }}
                                </div>

                                <div class="content-id">
                                    ID #{{ $contenido->id }}
                                </div>

                            </td>


                            {{-- TEMA --}}
                            <td>

                                @if($contenido->tema)

                                    <span class="theme-badge">

                                        <i class="bi bi-folder2-open"></i>

                                        {{ $contenido->tema->titulo ?? $contenido->tema->nombre }}

                                    </span>

                                @else

                                    <span class="text-muted small">
                                        Sin tema
                                    </span>

                                @endif

                            </td>


                            {{-- RECURSOS --}}
                            <td>

                                <div class="resource-list">

                                    @if($contenido->contenido)

                                        <span
                                            class="resource-icon text"
                                            title="Texto"
                                        >
                                            <i class="bi bi-file-text"></i>
                                        </span>

                                    @endif


                                    @if($contenido->imagen)

                                        <span
                                            class="resource-icon image"
                                            title="Imagen principal"
                                        >
                                            <i class="bi bi-image"></i>
                                        </span>

                                    @endif


                                    @if(method_exists($contenido, 'imagenes') && $contenido->imagenes->count())

                                        <span
                                            class="resource-icon image"
                                            title="Galería de imágenes"
                                        >
                                            <i class="bi bi-images"></i>
                                        </span>

                                        <span class="resource-count">
                                            {{ $contenido->imagenes->count() }}
                                            {{ $contenido->imagenes->count() == 1 ? 'imagen' : 'imágenes' }}
                                        </span>

                                    @endif


                                    @if($contenido->video_url)

                                        <span
                                            class="resource-icon video"
                                            title="Video"
                                        >
                                            <i class="bi bi-play-circle"></i>
                                        </span>

                                    @endif


                                    @if($contenido->iframe)

                                        <span
                                            class="resource-icon iframe"
                                            title="Contenido incrustado"
                                        >
                                            <i class="bi bi-window"></i>
                                        </span>

                                    @endif


                                    @if(
                                        !$contenido->contenido &&
                                        !$contenido->imagen &&
                                        !$contenido->video_url &&
                                        !$contenido->iframe &&
                                        (!method_exists($contenido, 'imagenes') || !$contenido->imagenes->count())
                                    )

                                        <span class="no-resource">
                                            Sin recursos
                                        </span>

                                    @endif

                                </div>

                            </td>


                            {{-- ESTADO --}}
                            <td>

                                @if($contenido->activo)

                                    <span class="status-badge status-active">
                                        Activo
                                    </span>

                                @else

                                    <span class="status-badge status-inactive">
                                        Inactivo
                                    </span>

                                @endif

                            </td>


                            {{-- ACCIONES --}}
                            <td class="text-end">

                                <div class="actions-wrapper">

                                    @if(auth()->user()->rol?->tienePermiso('contenidos.editar'))

                                        {{-- EDITAR --}}
                                        <a
                                            href="{{ route('admin.contenidos.edit', $contenido) }}"
                                            class="action-btn action-edit"
                                            title="Editar contenido"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- ACTIVAR / DESACTIVAR --}}
                                        <form
                                            action="{{ route('admin.contenidos.toggle', $contenido) }}"
                                            method="POST"
                                            class="d-inline m-0"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="action-btn action-toggle"
                                                title="{{ $contenido->activo ? 'Desactivar' : 'Activar' }}"
                                            >
                                                <i class="bi bi-power"></i>
                                            </button>

                                        </form>

                                    @endif


                                    @if(auth()->user()->rol?->tienePermiso('contenidos.eliminar'))

                                        {{-- ELIMINAR --}}
                                        <form
                                            action="{{ route('admin.contenidos.destroy', $contenido) }}"
                                            method="POST"
                                            class="d-inline m-0"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar este contenido?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn action-delete"
                                                title="Eliminar contenido"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>


        @else

            {{-- ESTADO VACÍO --}}
            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-journal-plus"></i>
                </div>

                <h5>
                    Aún no hay contenidos
                </h5>

                <p>
                    Crea el primer contenido educativo para comenzar
                    a construir la experiencia de MI DECISIÓN.
                </p>


                @if(auth()->user()->rol?->tienePermiso('contenidos.crear'))

                    <a
                        href="{{ route('admin.contenidos.create') }}"
                        class="btn btn-primary btn-new-content"
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