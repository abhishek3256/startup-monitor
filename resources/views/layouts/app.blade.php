<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startup Monitor - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #fff;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(4px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            border-radius: 15px;
        }

        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(4px);
            border-bottom: 1px solid var(--glass-border);
        }

        .nav-link {
            color: #fff !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateY(-2px);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .card {
            background: var(--glass-bg);
            backdrop-filter: blur(4px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            border-radius: 15px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(4px);
            border: 1px solid var(--glass-border);
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            transform: translateY(-2px);
        }

        .table {
            color: #fff;
        }

        .table thead th {
            background: var(--glass-bg);
            border-bottom: 1px solid var(--glass-border);
        }

        .table td {
            border-bottom: 1px solid var(--glass-border);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-rocket me-2"></i>Startup Monitor
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-chart-line me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('startups.index') }}">
                            <i class="fas fa-building me-1"></i>Startups
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('investors.index') }}">
                            <i class="fas fa-hand-holding-usd me-1"></i>Investors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('milestones.index') }}">
                            <i class="fas fa-flag me-1"></i>Milestones
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html> 