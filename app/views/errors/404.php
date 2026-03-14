<?php

/**
 * 404 Error Page
 */
$pageTitle = '404 Not Found';
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="max-w-2xl mx-auto px-6 py-20 animate-fade-up">
    <div class="card-elevated rounded-2xl p-12 text-center">
        <div class="text-6xl font-bold text-slate-700 mb-4">404</div>
        <h1 class="text-xl font-bold text-white mb-2">Page Not Found</h1>
        <p class="text-slate-500 text-sm mb-8">The page you're looking for doesn't exist or has been moved.</p>
        <a href="<?php echo BASE_URL; ?>/dashboard"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl btn-zap text-white text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Go to Dashboard
        </a>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>