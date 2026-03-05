<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="VIP2CARS - Gestión de vehículos y contactos automotrices">
    <title>@yield('title', 'VIP2CARS') | Sistema de Gestión</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --vip-primary: #c8000a;
            --vip-dark:    #0a0a0a;
            --vip-accent:  #e8a000;
            --vip-surface: #1a1a1a;
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background: #f5f5f5;
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        .navbar-vip {
            background: var(--vip-dark);
            border-bottom: 3px solid var(--vip-primary);
            padding: .75rem 1.5rem;
        }

        .navbar-brand-vip {
            font-weight: 700;
            font-size: 1.45rem;
            letter-spacing: 1px;
            color: #fff !important;
        }

        .navbar-brand-vip span {
            color: var(--vip-primary);
        }

        .navbar-tagline {
            font-size: .75rem;
            color: #aaa;
            letter-spacing: .5px;
        }

        .nav-link-vip {
            color: #ddd !important;
            font-size: .9rem;
            font-weight: 500;
            transition: color .2s;
        }

        .nav-link-vip:hover, .nav-link-vip.active {
            color: var(--vip-primary) !important;
        }

        /* ── HERO STRIP ── */
        .page-header {
            background: linear-gradient(135deg, var(--vip-dark) 0%, #2a0000 100%);
            color: #fff;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-bottom: 3px solid var(--vip-primary);
        }

        .page-header h1 {
            font-weight: 700;
            font-size: 1.6rem;
            margin: 0;
        }

        .page-header p {
            color: #aaa;
            font-size: .9rem;
            margin: .25rem 0 0;
        }

        /* ── CARDS ── */
        .card-vip {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,.08);
        }

        /* ── BUTTONS ── */
        .btn-vip-primary {
            background: var(--vip-primary);
            border-color: var(--vip-primary);
            color: #fff;
            font-weight: 600;
            transition: filter .2s, transform .1s;
        }

        .btn-vip-primary:hover {
            filter: brightness(1.15);
            color: #fff;
            transform: translateY(-1px);
        }

        /* ── TABLE ── */
        .table-vip thead {
            background: var(--vip-dark);
            color: #fff;
        }

        .table-vip thead th {
            font-weight: 600;
            font-size: .85rem;
            letter-spacing: .3px;
            border: none;
        }

        .table-vip tbody tr {
            transition: background .15s;
        }

        .table-vip tbody tr:hover {
            background: #fff3f3;
        }

        /* ── BADGES ── */
        .badge-placa {
            background: var(--vip-dark);
            color: #fff;
            font-size: .8rem;
            font-weight: 600;
            letter-spacing: 1px;
            padding: .35rem .65rem;
            border-radius: 6px;
        }

        /* ── ALERTS ── */
        .alert-vip-success {
            background: #d4edda;
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .alert-vip-danger {
            background: #f8d7da;
            border-left: 4px solid var(--vip-primary);
            color: #721c24;
        }

        /* ── FORM LABELS ── */
        label.form-label { font-weight: 500; font-size: .9rem; }

        /* ── FOOTER ── */
        footer {
            background: var(--vip-dark);
            color: #666;
            font-size: .8rem;
            padding: 1.2rem 0;
            margin-top: 3rem;
            border-top: 3px solid var(--vip-primary);
        }
    </style>
</head>
<body>

<!-- ── NAVBAR ── -->
<nav class="navbar navbar-expand-lg navbar-vip">
    <div class="container-xl">
        <a class="navbar-brand-vip d-flex flex-column" href="{{ route('vehicles.index') }}">
            <span>VIP<span>2</span>CARS</span>
            <small class="navbar-tagline">Rubro Automotriz</small>
        </a>

        <button class="navbar-toggler border-secondary" type="button"
                data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            {{-- Menú de navegación eliminado por requerimiento ----}}
        </div>
    </div>
</nav>

<!-- ── FLASH MESSAGES ── -->
<div class="container-xl mt-3">
    @if(session('success'))
        <div class="alert alert-vip-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-vip-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

<!-- ── CONTENT ── -->
@yield('content')

<!-- ── FOOTER ── -->
<footer class="text-center">
    <div class="container">
        &copy; {{ date('Y') }} VIP2CARS &mdash; Sistema de Gestión Automotriz
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
