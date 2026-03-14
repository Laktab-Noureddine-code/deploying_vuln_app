<?php

/**
 * Profile View — Student Profile Card
 * VULNERABLE: IDOR — No ownership check
 * Expected variables: $student (array|null), $id (int)
 */
$pageTitle = $student ? $student['username'] . ' — Profile' : 'Not Found';
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="max-w-2xl mx-auto px-6 py-8 animate-fade-up">

    <?php if ($student): ?>

        <!-- Profile Card -->
        <div class="card-elevated rounded-2xl overflow-hidden">

            <!-- Profile Header -->
            <div class="bg-zap-500/8 px-8 pt-10 pb-14 text-center relative border-b border-white/5">
                <div class="relative">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-zap-500 text-3xl font-bold text-white shadow-lg shadow-zap-500/20 mb-4 ring-4 ring-zap-500/15">
                        <?php echo strtoupper(substr($student['username'], 0, 1)); ?>
                    </div>
                    <h1 class="text-2xl font-bold text-white"><?php echo $student['username']; ?></h1>
                    <span class="badge inline-flex mt-2.5 px-3 py-1 rounded-md text-xs font-medium">
                        <?php echo $student['student_major']; ?>
                    </span>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="px-8 py-6 -mt-4">
                <div class="card rounded-xl divide-y divide-white/[0.04]">
                    <div class="flex items-center justify-between px-5 py-4">
                        <span class="text-sm text-slate-500 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                            </svg>
                            Student ID
                        </span>
                        <span class="text-sm font-mono font-medium text-white">#<?php echo $student['id']; ?></span>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4">
                        <span class="text-sm text-slate-500 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Username
                        </span>
                        <span class="text-sm font-medium text-white"><?php echo $student['username']; ?></span>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4">
                        <span class="text-sm text-slate-500 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            Password
                        </span>
                        <span class="text-sm font-mono font-medium text-red-400"><?php echo $student['password']; ?></span>
                    </div>
                    <div class="flex items-center justify-between px-5 py-4">
                        <span class="text-sm text-slate-500 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                            </svg>
                            Major
                        </span>
                        <span class="text-sm font-medium text-white"><?php echo $student['student_major']; ?></span>
                    </div>
                </div>
            </div>

            <!-- IDOR Warning -->
            <div class="px-8 pb-4">
                <div class="flex items-start gap-2 p-3 rounded-lg bg-red-500/5 border border-red-500/10">
                    <svg class="w-4 h-4 text-red-400/70 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <p class="text-xs text-slate-500"><strong class="text-red-400/80">IDOR Vulnerability:</strong> This page has no access control — any authenticated user can view any profile by changing the ID parameter.</p>
                </div>
            </div>

            <!-- Back -->
            <div class="px-8 pb-8 pt-2">
                <a href="<?php echo BASE_URL; ?>/dashboard" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Back to Directory
                </a>
            </div>
        </div>

    <?php else: ?>

        <!-- Not Found -->
        <div class="card-elevated rounded-2xl p-12 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-500/8 border border-red-500/15 mb-4">
                <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
            </div>
            <h2 class="text-xl font-bold text-white mb-2">Student Not Found</h2>
            <p class="text-slate-500 text-sm mb-6">No student exists with ID #<?php echo $id; ?></p>
            <a href="<?php echo BASE_URL; ?>/dashboard"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-zap-500/10 border border-zap-500/20 text-zap-300 text-sm font-medium hover:bg-zap-500/15 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Back to Directory
            </a>
        </div>

    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>