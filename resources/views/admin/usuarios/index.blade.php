@extends('admin.layouts.app')

@section('title', 'Usuarios')

@section('page-title', 'Usuarios')

@section('content')

<style>

    .usuarios-header {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #e9ecef;
        border-radius: 18px;
        padding: 28px;
        margin-bottom: 24px;
    }

    .usuarios-header-icon {
        width: 54px;
        height: 54px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef4ff;
        color: #0d6efd;
        font-size: 25px;
    }

    .usuarios-title {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .usuarios-subtitle {
        color: #6b7280;
        margin: 0;
        font-size: 14px;
    }

    .btn-nuevo-usuario {
        border-radius: 11px;
        padding: 10px 17px;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(13, 110, 253, .15);
    }

    .stat-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 16px;
        padding: 20px;
        height: 100%;
        transition: all .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
    }

    .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .stat-icon.total {
        background: #eef4ff;
        color: #0d6efd;
    }

    .stat-icon.active {
        background: #eaf8ef;
        color: #198754;
    }

    .stat-icon.inactive {
        background: #f1f3f5;
        color: #6c757d;
    }

    .stat-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .stat-number {
        color: #1f2937;
        font-size: 24px;
        font-weight: 700;
    }

    .usuarios-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .035);
    }

    .usuarios-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #edf0f2;
    }

    .usuarios-card-title {
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .usuarios-card-description {
        color: #8a94a6;
        font-size: 13px;
        margin: 3px 0 0;
    }

    .search-box {
        position: relative;
        width: 260px;
    }

    .search-box i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #9aa4b2;
    }

    .search-box input {
        border: 1px solid #e2e6ea;
        border-radius: 10px;
        padding: 9px 12px 9px 37px;
        font-size: 13px;
        width: 100%;
    }

    .search-box input:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .08);
        outline: none;
    }

    .usuarios-table {
        margin: 0;
    }

    .usuarios-table thead th {
        background: #f8fafc;
        color: #7b8494;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 14px 22px;
        border-bottom: 1px solid #edf0f2;
        white-space: nowrap;
    }

    .usuarios-table tbody td {
        padding: 17px 22px;
        border-bottom: 1px solid #f0f2f4;
        vertical-align: middle;
        color: #374151;
        font-size: 14px;
    }

    .usuarios-table tbody tr:last-child td {
        border-bottom: none;
    }

    .usuarios-table tbody tr {
        transition: background .15s ease;
    }

    .usuarios-table tbody tr:hover {
        background: #fafcff;
    }

    .usuario-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .usuario-avatar {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef4ff;
        color: #0d6efd;
        font-weight: 700;
        font-size: 15px;
    }

    .usuario-name {
        font-weight: 650;
        color: #252b33;
        margin-bottom: 2px;
    }

    .usuario-id {
        font-size: 11px;
        color: #9aa4b2;
    }

    .usuario-email {
        color: #667085;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 8px;
        background: #f4f6f8;
        color: #495057;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-active {
        background: #eaf8ef;
        color: #198754;
    }

    .status-inactive {
        background: #f1f3f5;
        color: #6c757d;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 6px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        border: 1px solid #e2e6ea;
        background: #fff;
        color: #667085;
        transition: all .15s ease;
    }

    .action-btn:hover {
        background: #f8fafc;
        border-color: #cfd5dc;
        color: #0d6efd;
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        background: #f3f5f7;
        color: #8a94a6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 28px;
    }

    .empty-title {
        font-weight: 700;
        color: #343a40;
        margin-bottom: 5px;
    }

    .empty-text {
        color: #8a94a6;
        font-size: 14px;
        margin: 0;
    }

    @media (max-width: 768px) {

        .usuarios-header {
            padding: 20px;
        }

        .usuarios-header .btn-nuevo-usuario {
            width: 100%;
            margin-top: 15px;
        }

        .search-box {
            width: 100%;
            margin-top: 12px;
        }

        .usuarios-card-header {
            display: block !important;
        }

    }

</style>


@php

    $totalUsuarios = $usuarios->count();

    $usuariosActivos = $usuarios
        ->where('activo', true)
        ->count();

    $usuariosInactivos = $usuarios
        ->where('activo', false)
        ->count();

@endphp


{{-- ENCABEZADO --}}

<div class="usuarios-header">

    <div class="row align-items-center">

        <div class="col-lg">

            <div class="d-flex align-items-center gap-3">

                <div class="usuarios-header-icon">

                    <i class="bi bi-people"></i>

                </div>

                <div>

                    <h2 class="usuarios-title">
                        Gestión de usuarios
                    </h2>

                    <p class="usuarios-subtitle">
                        Administra las cuentas y permisos de acceso al sistema.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-auto">

            <a
                href="{{ route('admin.usuarios.create') }}"
                class="btn btn-primary btn-nuevo-usuario"
            >

                <i class="bi bi-person-plus me-1"></i>

                Nuevo usuario

            </a>

        </div>

    </div>

</div>


{{-- ESTADÍSTICAS --}}

<div class="row g-3 mb-4">

    <div class="col-md-4">

        <div class="stat-card">

            <div class="d-flex align-items-center gap-3">

                <div class="stat-icon total">

                    <i class="bi bi-people"></i>

                </div>

                <div>

                    <div class="stat-label">
                        Total de usuarios
                    </div>

                    <div class="stat-number">
                        {{ $totalUsuarios }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="stat-card">

            <div class="d-flex align-items-center gap-3">

                <div class="stat-icon active">

                    <i class="bi bi-person-check"></i>

                </div>

                <div>

                    <div class="stat-label">
                        Usuarios activos
                    </div>

                    <div class="stat-number">
                        {{ $usuariosActivos }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="stat-card">

            <div class="d-flex align-items-center gap-3">

                <div class="stat-icon inactive">

                    <i class="bi bi-person-dash"></i>

                </div>

                <div>

                    <div class="stat-label">
                        Usuarios inactivos
                    </div>

                    <div class="stat-number">
                        {{ $usuariosInactivos }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- MENSAJE DE ÉXITO --}}

@if(session('success'))

    <div class="alert alert-success border-0 shadow-sm">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

    </div>

@endif


{{-- TABLA --}}

<div class="usuarios-card">

    <div class="usuarios-card-header">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h5 class="usuarios-card-title">
                    Usuarios registrados
                </h5>

                <p class="usuarios-card-description">
                    Consulta y administra las cuentas del sistema.
                </p>

            </div>


            <div class="search-box">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="buscarUsuario"
                    placeholder="Buscar usuario..."
                >

            </div>

        </div>

    </div>


    <div class="table-responsive">

        <table
            class="table usuarios-table"
            id="tablaUsuarios"
        >

            <thead>

                <tr>

                    <th>
                        Usuario
                    </th>

                    <th>
                        Correo
                    </th>

                    <th>
                        Rol
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

                @forelse($usuarios as $usuario)

                    <tr>

                        {{-- USUARIO --}}

                        <td>

                            <div class="usuario-info">

                                <div class="usuario-avatar">

                                    {{ strtoupper(substr($usuario->nombre, 0, 1)) }}

                                </div>

                                <div>

                                    <div class="usuario-name">

                                        {{ $usuario->nombre }}

                                    </div>

                                    <div class="usuario-id">

                                        ID #{{ $usuario->id }}

                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- CORREO --}}

                        <td>

                            <span class="usuario-email">

                                {{ $usuario->email }}

                            </span>

                        </td>


                        {{-- ROL --}}

                        <td>

                            @if($usuario->rol)

                                <span class="role-badge">

                                    <i class="bi bi-shield-check"></i>

                                    {{ $usuario->rol->nombre }}

                                </span>

                            @else

                                <span class="text-muted">

                                    Sin rol

                                </span>

                            @endif

                        </td>


                        {{-- ESTADO --}}

                        <td>

                            @if($usuario->activo)

                                <span class="status-badge status-active">

                                    <span class="status-dot"></span>

                                    Activo

                                </span>

                            @else

                                <span class="status-badge status-inactive">

                                    <span class="status-dot"></span>

                                    Inactivo

                                </span>

                            @endif

                        </td>


                        {{-- ACCIONES --}}

                        <td>

                            <div class="action-buttons">

                                <a
                                    href="{{ route('admin.usuarios.edit', $usuario) }}"
                                    class="action-btn"
                                    title="Editar usuario"
                                >

                                    <i class="bi bi-pencil"></i>

                                </a>


                                <form
                                    action="{{ route('admin.usuarios.toggle', $usuario) }}"
                                    method="POST"
                                    class="d-inline"
                                >

                                    @csrf

                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="action-btn"
                                        title="{{ $usuario->activo ? 'Desactivar usuario' : 'Activar usuario' }}"
                                    >

                                        @if($usuario->activo)

                                            <i class="bi bi-person-dash"></i>

                                        @else

                                            <i class="bi bi-person-check"></i>

                                        @endif

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">

                            <div class="empty-state">

                                <div class="empty-icon">

                                    <i class="bi bi-people"></i>

                                </div>

                                <div class="empty-title">

                                    No hay usuarios registrados

                                </div>

                                <p class="empty-text">

                                    Comienza creando la primera cuenta administrativa.

                                </p>

                                <a
                                    href="{{ route('admin.usuarios.create') }}"
                                    class="btn btn-primary mt-3"
                                >

                                    <i class="bi bi-person-plus me-1"></i>

                                    Crear usuario

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- BUSCADOR --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const buscador =
            document.getElementById('buscarUsuario');

        const filas =
            document.querySelectorAll('#tablaUsuarios tbody tr');

        buscador.addEventListener('keyup', function () {

            const texto =
                this.value.toLowerCase().trim();

            filas.forEach(function (fila) {

                const contenido =
                    fila.textContent.toLowerCase();

                fila.style.display =
                    contenido.includes(texto)
                        ? ''
                        : 'none';

            });

        });

    });

</script>

@endsection