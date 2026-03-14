<?php

/**
 * Dashboard View — Student Directory
 * Expected variables: $users (mysqli_result)
 */
$pageTitle = 'Dashboard';
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="max-w-6xl mx-auto px-6 py-8 animate-fade-up">

    <!-- Welcome Header -->
    <div class="card rounded-2xl p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-white">
                    Welcome back, <span class="text-zap-300"><?php echo $_SESSION['username']; ?></span>
                </h1>
                <p class="text-slate-500 mt-1 text-sm">Browse the complete student directory below.</p>
            </div>
            <a href="<?php echo BASE_URL; ?>/search"
                class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-zap-500/10 border border-zap-500/20 text-zap-300 text-sm font-medium hover:bg-zap-500/15 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                Search Students
            </a>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="card rounded-xl p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-zap-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-zap-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wider">Total Students</p>
                <p class="text-lg font-bold text-white"><?php echo $users ? $users->num_rows : 0; ?></p>
            </div>
        </div>
        <div class="card rounded-xl p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-amber-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wider">Vulnerabilities</p>
                <p class="text-lg font-bold text-white">3</p>
            </div>
        </div>
        <div class="card rounded-xl p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wider">OWASP Tests</p>
                <p class="text-lg font-bold text-white">Active</p>
            </div>
        </div>
    </div>

    <!-- Student Directory Table -->
    <div class="card rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
            <h2 class="text-base font-semibold text-white">Student Directory</h2>
            <span class="text-xs text-slate-500"><?php echo $users ? $users->num_rows : 0; ?> records</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="student-table">
                <thead>
                    <tr class="border-b border-white/5 text-[11px] uppercase tracking-wider text-slate-500">
                        <th class="px-6 py-3.5 font-medium">ID</th>
                        <th class="px-6 py-3.5 font-medium">Username</th>
                        <th class="px-6 py-3.5 font-medium">Major</th>
                        <th class="px-6 py-3.5 font-medium text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.03]">
                    <?php if ($users && $users->num_rows > 0): ?>
                        <?php while ($row = $users->fetch_assoc()): ?>
                            <tr class="row-hover transition-colors duration-150">
                                <td class="px-6 py-3.5 text-sm text-slate-500 font-mono">#<?php echo $row['id']; ?></td>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 rounded-full bg-zap-500/15 border border-zap-500/15 flex items-center justify-center text-[10px] font-bold text-zap-300">
                                            <?php echo strtoupper(substr($row['username'], 0, 1)); ?>
                                        </div>
                                        <span class="text-sm font-medium text-white"><?php echo $row['username']; ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-3.5">
                                    <span class="badge inline-flex px-2.5 py-1 rounded-md text-xs font-medium">
                                        <?php echo $row['student_major']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-3.5 text-right">
                                    <a href="<?php echo BASE_URL; ?>/profile/show/<?php echo $row['id']; ?>"
                                        class="inline-flex items-center gap-1 text-sm text-zap-400 hover:text-zap-300 transition-colors">
                                        View
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-600">No students found in the database.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>