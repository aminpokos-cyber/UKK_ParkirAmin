
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Aplikasi Parkir')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f1f5f9;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /* NAVBAR */
        .navbar {
            background: white !important;
            height: 70px;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .navbar-brand {
            color: #1e3a8a !important;
            font-weight: bold;
            font-size: 21px;
        }

        .navbar-brand i {
            color: #2563eb;
            margin-right: 8px;
        }

        /* SIDEBAR */
        .sidebar {
            background: linear-gradient(180deg, #172554, #1e40af);
            min-height: calc(100vh - 70px);
            padding: 25px 15px;
        }

        .sidebar-title {
            color: #94a3b8;
            font-size: 12px;
            font-weight: bold;
            margin: 10px 12px 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            font-weight: 500;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar .nav-link i {
            font-size: 18px;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .sidebar .nav-link.active {
            background: #2563eb;
            color: white;
        }

        /* CONTENT */
        .main-content {
            padding: 30px;
            min-height: calc(100vh - 70px);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .user-name {
            color: #334155;
            font-weight: 600;
        }

        .logout-btn {
            border-radius: 8px;
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .sidebar {
                min-height: auto;
            }

            .main-content {
                padding: 18px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 16px;
            }

            .user-name {
                display: none;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-3">
    <div class="container-fluid">

        <button class="btn btn-outline-primary d-lg-none me-2"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuSidebar">
            
        </button>

        <span class="navbar-brand">
            Aplikasi Parkir
        </span>

        <div class="d-flex align-items-center gap-3">

            <span class="user-name">
                {{ auth()->user()->nama_lengkap }}
                <small class="text-muted">
                    ({{ ucfirst(auth()->user()->role) }})
                </small>
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm logout-btn">
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>

<!-- CONTAINER -->
<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-lg-2 sidebar collapse d-lg-block"
             id="menuSidebar">

            <div class="sidebar-title">
                Menu Utama
            </div>

            @if(auth()->user()->role == 'admin')

                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.user.index') }}"
                   class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    Data User
                </a>

                <a href="{{ route('admin.tarif.index') }}"
                   class="nav-link {{ request()->routeIs('admin.tarif.*') ? 'active' : '' }}">
                    Tarif Parkir
                </a>

                <a href="{{ route('admin.area.index') }}"
                   class="nav-link {{ request()->routeIs('admin.area.*') ? 'active' : '' }}">
                    Area Parkir
                </a>

                <a href="{{ route('admin.kendaraan.index') }}"
                   class="nav-link {{ request()->routeIs('admin.kendaraan.*') ? 'active' : '' }}">
                    Kendaraan
                </a>

                <a href="{{ route('admin.log.index') }}"
                   class="nav-link {{ request()->routeIs('admin.log.*') ? 'active' : '' }}">
                    Log Aktivitas
                </a>

            @elseif(auth()->user()->role == 'petugas')

                <a href="{{ route('petugas.dashboard') }}"
                   class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('petugas.transaksi.index') }}"
                   class="nav-link {{ request()->routeIs('petugas.transaksi.*') ? 'active' : '' }}">
                    Transaksi
                </a>

            @elseif(auth()->user()->role == 'owner')

                <a href="{{ route('owner.dashboard') }}"
                   class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('owner.rekap.index') }}"
                   class="nav-link {{ request()->routeIs('owner.rekap.*') ? 'active' : '' }}">
                    Rekap Transaksi
                </a>

            @endif

            <div class="text-white-50 small mt-5 px-2">
                Sistem Parkir
            </div>

        </div>

        <!-- HALAMAN UTAMA -->
        <div class="col-lg-10 main-content">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </div>

    </div>
</div>

<!-- JAVASCRIPT BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
