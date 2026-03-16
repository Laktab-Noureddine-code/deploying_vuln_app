<?php

/**
 * Login View — Testing OWASP ZAP
 * Expected variables: $error (string)
 */
$pageTitle = 'Sign In';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="min-h-[calc(100vh-60px)] flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md animate-fade-up">

        <!-- Logo & Brand -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-surface-700 border border-white/8 mb-5 shadow-lg">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/31/OWASP_ZAP_logo.svg" alt="OWASP ZAP" class="w-14 h-14">
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Testing OWASP ZAP With Mr Zouani</h1>
            <p class="text-slate-500 mt-1.5 text-sm">Sign in to the vulnerability testing lab</p>
        </div>

        <!-- Login Card -->
        <div class="card-elevated rounded-2xl p-8">
            <?php if ($error): ?>
                <div class="mb-6 p-3 rounded-lg bg-red-500/8 border border-red-500/20 text-red-400 text-sm text-center flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo BASE_URL; ?>/auth" class="space-y-5">
                <div>
                    <label for="username" class="block text-sm font-medium text-slate-300 mb-1.5">Username</label>
                    <input type="text" id="username" name="username" required
                        class="input-field w-full px-4 py-3 rounded-xl bg-surface-800 border border-white/8 text-white placeholder-slate-600 focus:outline-none transition-all duration-200 text-sm"
                        placeholder="Enter your username">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5">Password</label>
                    <input type="password" id="password" name="password" required
                        class="input-field w-full px-4 py-3 rounded-xl bg-surface-800 border border-white/8 text-white placeholder-slate-600 focus:outline-none transition-all duration-200 text-sm"
                        placeholder="Enter your password">
                </div>

                <button type="submit" id="login-btn"
                    class="btn-zap w-full py-3 px-4 rounded-xl text-white font-semibold text-sm cursor-pointer">
                    Sign In
                </button>
            </form>

            
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>