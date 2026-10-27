<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard UMKM') - MitraUMKM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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
            font-family: 'Inter', sans-serif;
            background: var(--page-bg);
            color: var(--text-dark);
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
            gap: 12px;
            padding: 12px;
            color: #c2cede;
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .sidebar-link i {
            font-size: 17px;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .sidebar-link.active {
            background: var(--navy-light);
            color: white;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 28px;
        }

        .sidebar-logout {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: transparent;
            border: none;
            border-radius: 8px;
            color: #c2cede;
            font-family: inherit;
            font-size: 13px;
            text-align: left;
            cursor: pointer;
        }

        .sidebar-logout:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .sidebar-logout i {
            font-size: 17px;
        }

        /* MAIN CONTENT */
        .dashboard-main {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* NAVBAR */
        .dashboard-navbar {
            height: 76px;
            padding: 0 34px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: white;
            border-bottom: 1px solid var(--border);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .navbar-title {
            margin: 0;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 400;
            color: var(--text-dark);
        }

        .navbar-subtitle {
            margin: 4px 0 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--blue-soft);
            color: var(--navy-light);
            font-size: 16px;
        }

        .user-name {
            margin: 0 0 3px;
            color: var(--text-dark);
            font-size: 13px;
            font-weight: 600;
        }

        .user-role {
            color: var(--text-muted);
            font-size: 11px;
        }

        .mobile-menu-button {
            display: none;
            border: none;
            background: transparent;
            color: var(--navy);
            font-size: 23px;
        }

        /* PAGE */
        .dashboard-content {
            padding: 32px 34px;
        }

        .page-heading {
            margin-bottom: 26px;
        }

        .page-heading h1 {
            margin: 0 0 8px;
            color: var(--text-dark);
            font-size: 23px;
            font-weight: 600;
        }

        .page-heading p {
            margin: 0;
            color: var(--text-muted);
            font-size: 13px;
            line-height: 1.7;
        }

        /* PROFILE ALERT */
        .profile-alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 22px 24px;
            margin-bottom: 30px;
            background: var(--blue-soft);
            border: 1px solid #dce7f7;
            border-radius: 12px;
        }

        .profile-alert-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .alert-icon {
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 10px;
            color: var(--blue);
            font-size: 22px;
        }

        .profile-alert h3 {
            margin: 0 0 6px;
            color: var(--navy);
            font-size: 14px;
            font-weight: 600;
        }

        .profile-alert p {
            margin: 0;
            color: #64758b;
            font-size: 12px;
            line-height: 1.7;
        }

        .btn-dashboard {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            background: var(--navy);
            border: 1px solid var(--navy);
            border-radius: 7px;
            color: white;
            font-family: inherit;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-dashboard:hover {
            background: var(--navy-light);
            border-color: var(--navy-light);
            color: white;
        }

        .btn-dashboard-outline {
            background: white;
            color: var(--navy);
        }

        .btn-dashboard-outline:hover {
            background: var(--blue-soft);
            color: var(--navy);
            border-color: #dce7f7;
        }

        /* SECTION HEADING */
        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .section-heading h2 {
            margin: 0 0 6px;
            color: var(--text-dark);
            font-size: 16px;
            font-weight: 600;
        }

        .section-heading p {
            margin: 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        /* CARDS */
        .dashboard-card {
            height: 100%;
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .stat-card {
            padding: 22px;
        }

        .stat-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 20px;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 500;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--blue-soft);
            color: var(--blue);
            font-size: 19px;
        }

        .stat-value {
            margin: 0 0 8px;
            color: var(--navy);
            font-size: 27px;
            font-weight: 600;
        }

        .stat-description {
            margin: 0;
            color: var(--text-muted);
            font-size: 11px;
            line-height: 1.6;
        }

        /* TABLE */
        .table-card {
            overflow: hidden;
            margin-top: 28px;
        }

        .table-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 22px 24px;
            border-bottom: 1px solid var(--border);
        }

        .table-card-header h2 {
            margin: 0 0 6px;
            color: var(--text-dark);
            font-size: 15px;
            font-weight: 600;
        }

        .table-card-header p {
            margin: 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
        }

        .dashboard-table thead th {
            padding: 15px 24px;
            background: #fafbfc;
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            border-bottom: 1px solid var(--border);
        }

        .dashboard-table tbody td {
            padding: 17px 24px;
            color: var(--text-dark);
            font-size: 12px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .dashboard-table tbody tr:last-child td {
            border-bottom: none;
        }

        .empty-state {
            padding: 42px 20px !important;
            text-align: center;
            color: var(--text-muted) !important;
        }

        .empty-state i {
            display: block;
            margin-bottom: 12px;
            color: #aeb9c8;
            font-size: 30px;
        }

        .empty-state p {
            margin: 0;
            line-height: 1.7;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: var(--blue-soft);
            color: var(--navy-light);
            font-size: 10px;
            font-weight: 600;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .dashboard-content {
                padding: 28px 24px;
            }

            .dashboard-navbar {
                padding: 0 24px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-sidebar {
                transform: translateX(-100%);
                transition: transform 0.25s ease;
            }

            .dashboard-sidebar.show {
                transform: translateX(0);
            }

            .dashboard-main {
                margin-left: 0;
            }

            .dashboard-navbar {
                height: 70px;
                padding: 0 18px;
            }

            .mobile-menu-button {
                display: block;
            }

            .dashboard-content {
                padding: 24px 18px;
            }

            .page-heading h1 {
                font-size: 22px;
            }

            .profile-alert {
                align-items: flex-start;
                flex-direction: column;
                padding: 20px;
            }

            .profile-alert-content {
                align-items: flex-start;
            }

            .profile-alert .btn-dashboard {
                width: 100%;
            }

            .navbar-subtitle {
                display: none;
            }

            .user-name {
                max-width: 120px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .table-card-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .navbar-user {
                gap: 8px;
            }

            .user-avatar {
                width: 34px;
                height: 34px;
            }

            .user-name {
                max-width: 85px;
                font-size: 12px;
            }

            .page-heading h1 {
                font-size: 20px;
            }

            .stat-card {
                padding: 18px;
            }

            .table-card-header {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="dashboard-sidebar" id="dashboardSidebar">

        <div class="sidebar-label">Menu utama</div>

        <nav class="sidebar-menu">
            <a href="{{ route('umkm.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('umkm.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

            <a href="#profil"
               class="sidebar-link">
                <i class="bi bi-person"></i>
                <span>Profil Usaha</span>
            </a>

            <a href="#inovasi"
               class="sidebar-link">
                <i class="bi bi-lightbulb"></i>
                <span>Inovasi Saya</span>
            </a>

            <a href="#riwayat"
               class="sidebar-link">
                <i class="bi bi-clock-history"></i>
                <span>Riwayat Inovasi</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <form action="{{ route('umkm.logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

    </aside>

    <div class="dashboard-main">

        <header class="dashboard-navbar">

            <div class="navbar-left">
                <button type="button"
                        class="mobile-menu-button"
                        id="mobileMenuButton"
                        aria-label="Buka menu">
                    <i class="bi bi-list"></i>
                </button>

                <div>
                    <h2 class="navbar-title">@yield('navbar-title', 'Dashboard')</h2>
                    <p class="navbar-subtitle">Selamat datang di MitraUMKM</p>
                </div>
            </div>

            <div class="navbar-user">
                <div class="user-avatar">
                    <i class="bi bi-person"></i>
                </div>

                <div>
                    <p class="user-name">
                        {{ session('auth_username', 'UMKM') }}
                    </p>
                    <div class="user-role">UMKM</div>
                </div>
            </div>

        </header>



        
        <main class="dashboard-content">
            @yield('content')
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const dashboardSidebar = document.getElementById('dashboardSidebar');

        mobileMenuButton.addEventListener('click', function () {
            dashboardSidebar.classList.toggle('show');
        });

        document.addEventListener('click', function (event) {
            if (
                window.innerWidth <= 768 &&
                !dashboardSidebar.contains(event.target) &&
                !mobileMenuButton.contains(event.target)
            ) {
                dashboardSidebar.classList.remove('show');
            }
        });
    </script>

</body>
</html>
