<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Panel Administrativo') | MI DECISIÓN
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            color: #263238;
            font-family:
                Inter,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e7ebf0;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            height: 75px;
            display: flex;
            align-items: center;
            padding: 0 22px;
            border-bottom: 1px solid #edf0f4;
        }

        .sidebar-brand img {
            max-width: 145px;
            max-height: 48px;
            object-fit: contain;
        }

        .sidebar-brand-text {
            margin-left: 10px;
        }

        .sidebar-brand-text strong {
            display: block;
            font-size: 15px;
            color: #243b53;
            line-height: 1.1;
        }

        .sidebar-brand-text span {
            display: block;
            font-size: 10px;
            color: #8795a1;
            margin-top: 3px;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        /* =====================================================
           MENU
        ===================================================== */

        .sidebar-menu {
            padding: 20px 13px;
            flex: 1;
            overflow-y: auto;
        }

        .menu-title {
            padding: 0 12px;
            margin: 0 0 9px;
            font-size: 10px;
            font-weight: 700;
            color: #9aa5b1;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 11px 13px;
            margin-bottom: 4px;
            border-radius: 9px;
            text-decoration: none;
            color: #52606d;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .menu-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .menu-link:hover {
            background: #f2f6fa;
            color: #087df0;
        }

        .menu-link.active {
            background: #eaf4ff;
            color: #087df0;
        }

        /* =====================================================
           SIDEBAR FOOTER
        ===================================================== */

        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid #edf0f4;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 10px;
            background: #f8fafc;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #eaf4ff;
            color: #087df0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .admin-user-info {
            min-width: 0;
        }

        .admin-user-info strong {
            display: block;
            font-size: 12px;
            color: #243b53;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .admin-user-info span {
            display: block;
            font-size: 10px;
            color: #8795a1;
            margin-top: 2px;
        }

        .logout-button {
            width: 100%;
            border: 0;
            background: transparent;
            color: #7b8794;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 11px;
            border-radius: 8px;
            font-size: 12px;
            cursor: pointer;
            transition: .2s ease;
        }

        .logout-button:hover {
            background: #fff4f4;
            color: #c53030;
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .admin-main {
            width: calc(100% - 260px);
            margin-left: 260px;
            min-height: 100vh;
        }

        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            height: 75px;
            background: #ffffff;
            border-bottom: 1px solid #e7ebf0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .topbar-title h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #243b53;
        }

        .topbar-title p {
            margin: 4px 0 0;
            font-size: 12px;
            color: #8795a1;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .system-status {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border-radius: 20px;
            background: #f1faf5;
            color: #27764b;
            font-size: 11px;
            font-weight: 600;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #39a96b;
        }

        /* =====================================================
           CONTENT
        ===================================================== */

        .admin-content {
            padding: 30px;
        }

        /* =====================================================
           MOBILE
        ===================================================== */

        .mobile-menu-button {
            display: none;
            border: 0;
            background: transparent;
            font-size: 23px;
            color: #243b53;
        }

        @media (max-width: 900px) {

            .sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                width: 100%;
                margin-left: 0;
            }

            .mobile-menu-button {
                display: block;
            }

            .topbar {
                padding: 0 18px;
            }

            .admin-content {
                padding: 20px;
            }

            .system-status {
                display: none;
            }
        }

    </style>

    @stack('styles')

</head>

<body>

<div class="admin-wrapper">

    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <aside
        class="sidebar"
        id="adminSidebar"
    >

        <!-- LOGO -->

        <div class="sidebar-brand">

            <img
                src="{{ asset('build/img/logo.WebP') }}"
                alt="MI DECISIÓN"
            >

            <div class="sidebar-brand-text">

            </div>

        </div>


        <!-- =================================================
             MENÚ
        ================================================== -->

        <nav class="sidebar-menu">

            <!-- PRINCIPAL -->

            <div class="menu-title">
                Principal
            </div>

            <a
                href="{{ route('admin') }}"
                class="menu-link {{ request()->routeIs('admin') ? 'active' : '' }}"
            >
                <i class="bi bi-grid-1x2"></i>
                Dashboard
            </a>


            <!-- =================================================
                 GESTIÓN
            ================================================== -->

            <div class="menu-title mt-4">
                Gestión
            </div>


            {{-- ================================================
                 USUARIOS
            ================================================= --}}

            @if(
                auth()->user()->rol &&
                auth()->user()->rol->tienePermiso('usuarios.ver')
            )

                <a
                    href="{{ route('admin.usuarios.index') }}"
                    class="menu-link {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-people"></i>
                    Usuarios
                </a>

            @endif


            {{-- ================================================
                 ROLES Y PERMISOS
                 Por ahora solamente Administrador
            ================================================= --}}

            @if(auth()->user()->rol_id === 1)

                <a
                    href="{{ route('admin.roles.index') }}"
                    class="menu-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-shield-lock"></i>
                    Roles y permisos
                </a>

            @endif


            {{-- ================================================
                 PARTICIPANTES
                 Se habilitará cuando creemos participantes.ver
            ================================================= --}}

            {{--

            @if(
                auth()->user()->rol &&
                auth()->user()->rol->tienePermiso('participantes.ver')
            )

                <a
                    href="#"
                    class="menu-link"
                >
                    <i class="bi bi-person-vcard"></i>
                    Participantes
                </a>

            @endif

            --}}


            {{-- ================================================
                 CONTENIDOS
            ================================================= --}}

            @if(
                auth()->user()->rol &&
                auth()->user()->rol->tienePermiso('contenidos.ver')
            )

                <a
                    href="{{ route('admin.contenidos.index') }}"
                    class="menu-link {{ request()->routeIs('admin.contenidos.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-journal-text"></i>
                    Contenidos
                </a>

                <a
                    href="{{ route('admin.temas.index') }}"
                    class="menu-link {{ request()->routeIs('admin.temas.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-collection"></i>
                    Temas
                </a>

            @endif


            {{-- ================================================
                 ACTIVIDADES
                 Se habilitará cuando creemos actividades.ver
            ================================================= --}}

            {{--

            @if(
                auth()->user()->rol &&
                auth()->user()->rol->tienePermiso('actividades.ver')
            )

                <a
                    href="#"
                    class="menu-link"
                >
                    <i class="bi bi-lightbulb"></i>
                    Actividades
                </a>

            @endif

            --}}


            {{-- ================================================
                 QUIZZES
            ================================================= --}}

            @if(
                auth()->user()->rol &&
                auth()->user()->rol->tienePermiso('quizzes.ver')
            )

                <a
                    href="#"
                    class="menu-link"
                >
                    <i class="bi bi-question-circle"></i>
                    Quizzes
                </a>

            @endif


            <!-- =================================================
                 INFORMACIÓN
            ================================================== -->

            <div class="menu-title mt-4">
                Información
            </div>


            {{-- ================================================
                 REPORTES
            ================================================= --}}

            @if(
                auth()->user()->rol &&
                auth()->user()->rol->tienePermiso('reportes.ver')
            )

                <a
                    href="#"
                    class="menu-link"
                >
                    <i class="bi bi-bar-chart"></i>
                    Reportes
                </a>

            @endif


            {{-- ================================================
                 CERTIFICADOS
            ================================================= --}}

            @if(
                auth()->user()->rol &&
                auth()->user()->rol->tienePermiso('certificados.ver')
            )

                <a
                    href="#"
                    class="menu-link"
                >
                    <i class="bi bi-award"></i>
                    Certificados
                </a>

            @endif


            <!-- =================================================
                 SISTEMA
            ================================================== -->

            @if(auth()->user()->rol_id === 1)

                <div class="menu-title mt-4">
                    Sistema
                </div>

                <a
                    href="#"
                    class="menu-link"
                >
                    <i class="bi bi-gear"></i>
                    Configuración
                </a>

            @endif

        </nav>


        <!-- =====================================================
             SIDEBAR FOOTER
        ====================================================== -->

        <div class="sidebar-footer">

            @auth

                <div class="admin-user">

                    <div class="admin-avatar">
                        <i class="bi bi-person"></i>
                    </div>

                    <div class="admin-user-info">

                        <strong>
                            {{ Auth::user()->nombre }}
                        </strong>

                        <span>

                            @if(Auth::user()->rol)
                                {{ Auth::user()->rol->nombre }}
                            @else
                                Sin rol
                            @endif

                        </span>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout-button"
                    >

                        <i class="bi bi-box-arrow-left"></i>

                        Cerrar sesión

                    </button>

                </form>

            @endauth

        </div>

    </aside>


    <!-- =====================================================
         MAIN
    ====================================================== -->

    <main class="admin-main">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="d-flex align-items-center gap-3">

                <button
                    type="button"
                    class="mobile-menu-button"
                    onclick="toggleSidebar()"
                >
                    <i class="bi bi-list"></i>
                </button>


                <div class="topbar-title">

                    <h1>
                        @yield('page-title', 'Dashboard')
                    </h1>

                    <p>
                        Administración de MI DECISIÓN
                    </p>

                </div>

            </div>


            <div class="topbar-right">

                <div class="system-status">

                    <span class="status-dot"></span>

                    Sistema activo

                </div>

            </div>

        </header>


        <!-- CONTENIDO -->

        <section class="admin-content">

            @if(session('success'))

                <div class="alert alert-success border-0 shadow-sm">

                    <i class="bi bi-check-circle me-2"></i>

                    {{ session('success') }}

                </div>

            @endif


            @if(session('error'))

                <div class="alert alert-danger border-0 shadow-sm">

                    <i class="bi bi-exclamation-circle me-2"></i>

                    {{ session('error') }}

                </div>

            @endif


            @yield('content')

        </section>

    </main>

</div>


<!-- =====================================================
     JAVASCRIPT
====================================================== -->

<script>

    function toggleSidebar()
    {
        const sidebar =
            document.getElementById('adminSidebar');

        sidebar.classList.toggle('open');
    }

</script>


@stack('scripts')

</body>

</html>