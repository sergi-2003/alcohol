@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<style>

    /* =====================================================
       BIENVENIDA
    ===================================================== */

    .welcome-card {
        background: #ffffff;
        border: 1px solid #e8edf2;
        border-radius: 14px;
        padding: 25px;
        margin-bottom: 25px;
    }

    .welcome-card h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        color: #243b53;
    }

    .welcome-card p {
        margin: 7px 0 0;
        font-size: 13px;
        color: #7b8794;
    }

    /* =====================================================
       ESTADÍSTICAS
    ===================================================== */

    .stat-card {
        background: #ffffff;
        border: 1px solid #e8edf2;
        border-radius: 14px;
        padding: 21px;
        height: 100%;
        transition: all .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(36,59,83,.07);
    }

    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 17px;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        border-radius: 10px;
        background: #eaf4ff;
        color: #087df0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .stat-label {
        font-size: 12px;
        color: #8795a1;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .stat-value {
        font-size: 27px;
        font-weight: 700;
        color: #243b53;
        line-height: 1;
    }

    /* =====================================================
       SECCIONES
    ===================================================== */

    .section-card {
        background: #ffffff;
        border: 1px solid #e8edf2;
        border-radius: 14px;
        overflow: hidden;
    }

    .section-header {
        padding: 18px 20px;
        border-bottom: 1px solid #edf0f4;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .section-header h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #243b53;
    }

    .section-header span {
        font-size: 11px;
        color: #9aa5b1;
    }

    /* =====================================================
       ACCIONES RÁPIDAS
    ===================================================== */

    .quick-action {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 15px 20px;
        border-bottom: 1px solid #f0f2f5;
        text-decoration: none;
        transition: background .2s ease;
    }

    .quick-action:last-child {
        border-bottom: 0;
    }

    .quick-action:hover {
        background: #f8fafc;
    }

    .quick-action-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: #f1f6fb;
        color: #087df0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .quick-action-text strong {
        display: block;
        color: #34495e;
        font-size: 12px;
    }

    .quick-action-text span {
        display: block;
        color: #9aa5b1;
        font-size: 10px;
        margin-top: 2px;
    }

    .quick-action-arrow {
        margin-left: auto;
        color: #bcc5cf;
    }

    /* =====================================================
       ACTIVIDAD
    ===================================================== */

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 16px 20px;
        border-bottom: 1px solid #f0f2f5;
    }

    .activity-item:last-child {
        border-bottom: 0;
    }

    .activity-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: #f1f6fb;
        color: #087df0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .activity-text strong {
        display: block;
        font-size: 12px;
        color: #34495e;
    }

    .activity-text span {
        display: block;
        font-size: 10px;
        color: #9aa5b1;
        margin-top: 3px;
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 768px) {

        .welcome-card {
            padding: 20px;
        }

        .welcome-card h2 {
            font-size: 19px;
        }

    }

</style>


<!-- =====================================================
     BIENVENIDA
====================================================== -->

<div class="welcome-card">

    <h2>
        Bienvenido, {{ Auth::user()->nombre }}
    </h2>

    <p>
        Desde este panel puedes administrar los contenidos,
        participantes y herramientas de MI DECISIÓN.
    </p>

</div>


<!-- =====================================================
     ESTADÍSTICAS
====================================================== -->

<div class="row g-4 mb-4">

    <!-- PARTICIPANTES -->

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-header">

                <div>

                    <div class="stat-label">
                        Participantes
                    </div>

                    <div class="stat-value">
                        0
                    </div>

                </div>

                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>

            </div>

        </div>

    </div>


    <!-- USUARIOS -->

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-header">

                <div>

                    <div class="stat-label">
                        Usuarios
                    </div>

                    <div class="stat-value">
                        0
                    </div>

                </div>

                <div class="stat-icon">
                    <i class="bi bi-person-badge"></i>
                </div>

            </div>

        </div>

    </div>


    <!-- CONTENIDOS -->

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-header">

                <div>

                    <div class="stat-label">
                        Contenidos
                    </div>

                    <div class="stat-value">
                        0
                    </div>

                </div>

                <div class="stat-icon">
                    <i class="bi bi-journal-text"></i>
                </div>

            </div>

        </div>

    </div>


    <!-- QUIZZES -->

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-header">

                <div>

                    <div class="stat-label">
                        Quizzes
                    </div>

                    <div class="stat-value">
                        0
                    </div>

                </div>

                <div class="stat-icon">
                    <i class="bi bi-question-circle"></i>
                </div>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     INFORMACIÓN
====================================================== -->

<div class="row g-4">

    <!-- ACTIVIDAD RECIENTE -->

    <div class="col-12 col-xl-7">

        <div class="section-card">

            <div class="section-header">

                <h3>
                    Actividad reciente
                </h3>

                <span>
                    Últimos movimientos
                </span>

            </div>


            <div class="activity-item">

                <div class="activity-icon">

                    <i class="bi bi-person-plus"></i>

                </div>

                <div class="activity-text">

                    <strong>
                        No hay actividad registrada todavía
                    </strong>

                    <span>
                        Aquí aparecerán los movimientos del sistema.
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- ACCIONES RÁPIDAS -->

    <div class="col-12 col-xl-5">

        <div class="section-card">

            <div class="section-header">

                <h3>
                    Acciones rápidas
                </h3>

            </div>


            <a
                href="#"
                class="quick-action"
            >

                <div class="quick-action-icon">

                    <i class="bi bi-person-plus"></i>

                </div>

                <div class="quick-action-text">

                    <strong>
                        Crear usuario
                    </strong>

                    <span>
                        Agregar un usuario administrativo
                    </span>

                </div>

                <i class="bi bi-chevron-right quick-action-arrow"></i>

            </a>


            <a
                href="#"
                class="quick-action"
            >

                <div class="quick-action-icon">

                    <i class="bi bi-journal-plus"></i>

                </div>

                <div class="quick-action-text">

                    <strong>
                        Crear contenido
                    </strong>

                    <span>
                        Agregar contenido educativo
                    </span>

                </div>

                <i class="bi bi-chevron-right quick-action-arrow"></i>

            </a>


            <a
                href="#"
                class="quick-action"
            >

                <div class="quick-action-icon">

                    <i class="bi bi-question-circle"></i>

                </div>

                <div class="quick-action-text">

                    <strong>
                        Crear quiz
                    </strong>

                    <span>
                        Crear una evaluación
                    </span>

                </div>

                <i class="bi bi-chevron-right quick-action-arrow"></i>

            </a>


            <a
                href="#"
                class="quick-action"
            >

                <div class="quick-action-icon">

                    <i class="bi bi-bar-chart"></i>

                </div>

                <div class="quick-action-text">

                    <strong>
                        Ver reportes
                    </strong>

                    <span>
                        Consultar estadísticas
                    </span>

                </div>

                <i class="bi bi-chevron-right quick-action-arrow"></i>

            </a>

        </div>

    </div>

</div>

@endsection