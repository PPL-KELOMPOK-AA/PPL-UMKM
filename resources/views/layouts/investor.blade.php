<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Investor') - MitraUMKM</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #102037;
            --navy-light: #243f65;
            --blue: #5d80b3;
            --blue-soft: #eaf1fb;
            --page-bg: #f5f6f8;
            --text-dark: #26354a;
            --text-muted: #8590a0;
            --border: #e9edf2;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--page-bg);
            color: var(--text-dark);
            font-family: 'Inter', sans-serif;
            font-size: 14px;

        }

        a {
            text-decoration: none;
        }

        /* SIDEBAR */
        .dashboard-sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding: 28px 18px;
            background: var(--navy);
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0 10px;
            margin-bottom: 42px;
            color: white;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dce8fa;
            color: var(--navy);
            border-radius: 13px;
            font-size: 22px;
        }

        .brand-name {
            font-family: 'Manrope', sans-serif;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -0.7px;
        }

        .brand-caption {
            margin-top: 1px;
            color: #b8c8df;
            font-size: 11px;
        }

        .sidebar-label {
            padding: 0 12px;
            margin-bottom: 12px;
            margin-top: auto;
            color: #92a6c3;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 14px;
            color: #c4d0e0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            transition: 0.2s ease;
        }

        .sidebar-link i {
            font-size: 17px;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .sidebar-link.active {
            background: #e5edfa;
            color: var(--navy);
            font-weight: 700;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 28px;
        }

        .sidebar-help {
            padding: 16px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.13);
            border-radius: 13px;
        }

        .sidebar-help i {
            color: #d6e5fb;
            font-size: 20px;
        }

        .sidebar-help p {
            margin: 8px 0 0;
            color: #c0cee0;
            font-size: 11px;
            line-height: 1.6;
        }

        .sidebar-help strong {
            color: white;
            font-size: 12px;
        }

        .logout-button {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 12px 14px;
            background: transparent;
            color: #e3eaf3;
            border: 0;
            border-radius: 10px;
            text-align: left;
            font: inherit;
            cursor: pointer;
        }

        .logout-button:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        /* MAIN AREA */
        .dashboard-main {
            min-height: 100vh;
            margin-left: 250px;
        }

        .dashboard-navbar {
            height: 76px;
            padding: 0 34px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
        }

        .navbar-title {
            margin: 0;
            font-family: 'Manrope', sans-serif;
            font-size: 16px;
            font-weight: 600;
        }

        .navbar-subtitle {
            margin: 4px 0 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .user-avatar {
            width: 39px;
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--blue-soft);
            color: var(--navy);
            font-size: 17px;
        }

        .user-name {
            max-width: 180px;
            overflow: hidden;
            color: var(--text-dark);
            font-size: 12px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-role {
            margin-top: 3px;
            color: var(--text-muted);
            font-size: 11px;
        }

        .dashboard-content {
            width: 100%;
            max-width: 1600px;
            padding: 30px 34px 40px;
            margin: 0 auto;
        }

        /* PAGE ELEMENTS */
        .page-heading {
            margin-bottom: 23px;
        }

        .page-heading h1 {
            font-family: 'Inter', sans-serif;
            font-size: 23px;
            font-weight: 600;
            letter-spacing: normal;
        }

        .page-heading p {
            margin: 7px 0 0;
            color: var(--text-muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .dashboard-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 3px 12px rgba(29, 47, 75, 0.025);
        }

        .profile-alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 22px 24px;
            margin-bottom: 24px;
            background: #eaf1fb;
            border: 1px solid #dce7f7;
            border-radius: 16px;
        }

        .profile-alert-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .alert-icon {
            width: 45px;
            height: 45px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: white;
            color: var(--blue);
            font-size: 21px;
        }

        .profile-alert h3 {
            margin: 0 0 5px;
            color: var(--navy);
            font-size: 14px;
            font-weight: 600;
        }

        .profile-alert p {
            margin: 0;
            color: #657790;
            font-size: 12px;
            line-height: 1.6;
        }

        .btn-dashboard {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-shrink: 0;
            padding: 11px 16px;
            border: 0;
            border-radius: 9px;
            background: var(--navy);
            color: white;
            font-size: 12px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .btn-dashboard:hover {
            background: var(--navy-light);
            color: white;
        }

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
        }

        .section-heading h2 {
            margin: 0;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 15px;
            font-weight: 600;
        }

        .section-heading p {
            margin: 5px 0 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        .stat-card {
            height: 100%;
            min-height: 150px;
            padding: 21px;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .stat-label {
            color: #778398;
            font-size: 12px;
            font-weight: 600;
        }

        .stat-icon {
            width: 39px;
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--blue-soft);
            color: var(--blue);
            font-size: 18px;
        }

        .stat-value {
            margin-top: 17px;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 29px;
            font-weight: 600;
            letter-spacing: -1px;
        }

        .stat-description {
            margin-top: 4px;
            color: var(--text-muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .table-card {
            overflow: hidden;
        }

        .table-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 21px 23px;
            border-bottom: 1px solid var(--border);
        }

        .table-card-header h2 {
            margin: 0;
            color: var(--navy);
            font-family: 'Manrope', sans-serif;
            font-size: 15px;
            font-weight: 600;
        }

        .table-card-header p {
            margin: 5px 0 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        .table-responsive {
            width: 100%;
        }

        .dashboard-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
            white-space: nowrap;
        }

        .dashboard-table thead th {
            padding: 14px 22px;
            background: #fafbfd;
            color: #8490a1;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .dashboard-table tbody td {
            padding: 17px 22px;
            color: #536176;
            border-bottom: 1px solid #f0f2f5;
            font-size: 12px;
            vertical-align: middle;
        }

        .dashboard-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .project-name {
            color: var(--navy);
            font-size: 12px;
            font-weight: 700;
        }

        .project-category {
            margin-top: 4px;
            color: var(--text-muted);
            font-size: 11px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #e8f6ed;
            color: #328253;
            font-size: 10px;
            font-weight: 700;
        }

        .status-badge.pending {
            background: #fff3dc;
            color: #a8751b;
        }

        .empty-state {
            padding: 45px 20px;
            text-align: center;
            white-space: normal;
        }

        .empty-state i {
            color: #a8b7ca;
            font-size: 30px;
        }

        .empty-state h3 {
            margin: 12px 0 6px;
            color: var(--navy);
            font-size: 14px;
            font-weight: 600;
        }

        .empty-state p {
            max-width: 350px;
            margin: 0 auto;
            color: var(--text-muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .mobile-menu-button {
            display: none;
            padding: 7px 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: white;
            color: var(--navy);
            font-size: 20px;
        }

        .sidebar-overlay {
            display: none;
        }

        /* TABLET */
        @media (max-width: 1100px) {
            .dashboard-content {
                padding: 26px 22px 35px;
            }

            .dashboard-navbar {
                padding: 0 22px;
            }

            .dashboard-sidebar {
                width: 225px;
            }

            .dashboard-main {
                margin-left: 225px;
            }

            .stat-card {
                padding: 17px;
            }
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .dashboard-sidebar {
                width: 260px;
                transform: translateX(-100%);
                transition: transform 0.25s ease;
            }

            .dashboard-sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 999;
                background: rgba(12, 25, 44, 0.45);
            }

            .dashboard-main {
                margin-left: 0;
            }

            .dashboard-navbar {
                height: 68px;
                padding: 0 16px;
            }

            .mobile-menu-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .navbar-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .navbar-subtitle,
            .user-details {
                display: none;
            }

            .dashboard-content {
                padding: 24px 16px 30px;
            }

            .page-heading h1 {
                font-size: 22px;
                font-weight: 200px;
            }

            .profile-alert {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px;
            }

            .profile-alert .btn-dashboard {
                width: 100%;
            }

            .stat-card {
                min-height: 135px;
            }

            .table-card-header {
                padding: 18px;
            }
        }

        @media (max-width: 420px) {
            .dashboard-content {
                padding-right: 12px;
                padding-left: 12px;
            }

            .navbar-title {
                font-size: 14px;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
            }

            .stat-value {
                font-size: 25px;
            }
        }

/* TOMBOL FORM PROFIL */
.profile-form-actions {
    display: flex;
    justify-content: flex-end;
    flex-wrap: wrap;
    gap: 10px;
}

.profile-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 10px 17px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.2;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease;
}

.profile-btn-primary {
    background: var(--navy);
    color: #fff;
}

.profile-btn-primary:hover {
    background: var(--navy-light);
    color: #fff;
}

.profile-btn-secondary {
    background: #fff;
    border-color: #dce2e9;
    color: #536176;
}

.profile-btn-secondary:hover {
    background: #f5f6f8;
    border-color: #c8d0db;
    color: var(--navy);
}

.profile-btn:focus-visible {
    outline: 3px solid #b8ccef;
    outline-offset: 2px;
}

@media (max-width: 480px) {
    .profile-form-actions {
        flex-direction: column-reverse;
    }

    .profile-form-actions .profile-btn {
        width: 100%;
    }
}

    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- SIDEBAR --}}
    <aside class="dashboard-sidebar" id="dashboardSidebar">

        <div class="sidebar-label">Menu utama</div>

        <nav class="sidebar-menu">
            <a href="{{ route('investor.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('investor.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('investor.profil') }}"
            class="sidebar-link {{ request()->routeIs('investor.profil') ? 'active' : '' }}">
                <i class="bi bi-person"></i>
                <span>Profil Saya</span>
            </a>

            <a href="#inovasi"
               class="sidebar-link {{ request()->routeIs('investor.inovasi') ? 'active' : '' }}">
                <i class="bi bi-lightbulb"></i>
                <span>Daftar Inovasi</span>
            </a>

            <a href="#penawaran"
               class="sidebar-link {{ request()->routeIs('investor.penawaran') ? 'active' : '' }}">
                <i class="bi bi-send"></i>
                <span>Penawaran Saya</span>
            </a>

            <a href="#investasi"
               class="sidebar-link {{ request()->routeIs('investor.investasi') ? 'active' : '' }}">
                <i class="bi bi-graph-up-arrow"></i>
                <span>Pantau Investasi</span>
            </a>
        </nav>

        <div class="sidebar-bottom">

            <form action="{{ route('investor.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>




    
    <main class="dashboard-main">
        <header class="dashboard-navbar">
            <div class="navbar-left">
                <button type="button" class="mobile-menu-button"
                        id="mobileMenuButton" aria-label="Buka menu">
                    <i class="bi bi-list"></i>
                </button>

                <div>
                    <h1 class="navbar-title">@yield('navbar-title', 'Dashboard')</h1>
                    <p class="navbar-subtitle">Selamat datang di MitraUMKM</p>
                </div>
            </div>

            <div class="navbar-user">
                <div class="user-avatar">
                    <i class="bi bi-person"></i>
                </div>

                <div class="user-details">
                    <div class="user-name">
                        {{ session('auth_username', 'Investor') }}
                    </div>
                    <div class="user-role">Investor</div>
                </div>
            </div>
        </header>

        <section class="dashboard-content">
            @yield('content')
        </section>
    </main>

    <script>
        const sidebar = document.getElementById('dashboardSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const menuButton = document.getElementById('mobileMenuButton');

        function closeSidebar() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        }

        menuButton.addEventListener('click', function () {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', closeSidebar);

        document.querySelectorAll('.sidebar-link').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    closeSidebar();
                }
            });
        });
    </script>
</body>
</html>
