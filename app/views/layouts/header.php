<?php

/**
 * Shared Header Layout — OWASP ZAP Testing App
 * Includes <head>, Tailwind config, and navbar
 *
 * Expected variables: $pageTitle (string)
 */
$pageTitle = isset($pageTitle) ? $pageTitle : 'Testing OWASP ZAP';
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> — Testing OWASP ZAP</title>
    <meta name="description" content="OWASP ZAP Vulnerability Testing Lab — Educational cybersecurity demo application.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif']
                    },
                    colors: {
                        zap: {
                            50: '#e6f0fa',
                            100: '#b3d1f0',
                            200: '#80b3e6',
                            300: '#4d94db',
                            400: '#2680d1',
                            500: '#00549E',
                            600: '#004a8c',
                            700: '#003d73',
                            800: '#00315b',
                            900: '#002442',
                        },
                        surface: {
                            900: '#0b1120',
                            800: '#111827',
                            700: '#1e293b',
                            600: '#273549',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }

        /* Subtle grid pattern on background */
        .bg-grid {
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Card styles */
        .card {
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .card-elevated {
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
        }

        /* Nav */
        .nav-bar {
            background: rgba(11, 17, 32, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        /* Input focus glow */
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(0, 84, 158, 0.3);
            border-color: #00549E;
        }

        /* Button */
        .btn-zap {
            background: #00549E;
            transition: all 0.2s ease;
        }

        .btn-zap:hover {
            background: #004a8c;
            box-shadow: 0 4px 16px rgba(0, 84, 158, 0.35);
            transform: translateY(-1px);
        }

        .btn-zap:active {
            transform: translateY(0);
        }

        /* Table row hover */
        .row-hover:hover {
            background: rgba(0, 84, 158, 0.06);
        }

        /* Badge */
        .badge {
            background: rgba(0, 84, 158, 0.12);
            color: #80b3e6;
            border: 1px solid rgba(0, 84, 158, 0.2);
        }

        /* Subtle fade-in */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeUp 0.4s ease-out;
        }
    </style>
</head>

<body class="bg-surface-900 bg-grid min-h-screen text-white antialiased">

    <?php if ($isLoggedIn): ?>
        <!-- Navbar -->
        <nav class="nav-bar sticky top-0 z-50">
            <div class="max-w-6xl mx-auto px-6 py-3.5 flex items-center justify-between">
                <!-- Brand -->
                <a href="<?php echo BASE_URL; ?>/dashboard" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-lg bg-surface-700 border border-white/10 flex items-center justify-center overflow-hidden group-hover:border-zap-500/40 transition-colors">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/31/OWASP_ZAP_logo.svg" alt="OWASP ZAP" class="w-7 h-7">
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-sm leading-tight">Testing OWASP ZAP</span>
                        <span class="text-[10px] text-slate-500 leading-tight">Vulnerability Lab</span>
                    </div>
                </a>

                <!-- Nav Right -->
                <div class="flex items-center gap-1">
                    <a href="<?php echo BASE_URL; ?>/dashboard"
                        class="text-sm text-slate-400 hover:text-white transition-colors px-3 py-2 rounded-lg hover:bg-white/5">
                        Dashboard
                    </a>
                    <a href="<?php echo BASE_URL; ?>/search"
                        class="text-sm text-slate-400 hover:text-white transition-colors px-3 py-2 rounded-lg hover:bg-white/5 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        Search
                    </a>

                    <div class="h-5 w-px bg-slate-700/60 mx-2"></div>

                    <!-- User -->
                    <div class="flex items-center gap-2.5 pl-1">
                        <div class="w-7 h-7 rounded-full bg-zap-500 flex items-center justify-center text-[11px] font-bold text-white">
                            <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                        </div>
                        <span class="text-sm text-slate-300 hidden sm:inline"><?php echo $_SESSION['username']; ?></span>
                    </div>

                    <a href="<?php echo BASE_URL; ?>/auth/logout"
                        class="text-sm text-slate-500 hover:text-red-400 transition-colors px-3 py-2 rounded-lg hover:bg-red-500/8 ml-1">
                        Logout
                    </a>
                </div>
            </div>
        </nav>
    <?php endif; ?>