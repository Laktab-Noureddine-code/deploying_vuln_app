<?php

/**
 * Search View — Student Search
 * VULNERABLE: Reflected XSS — $searchTerm echoed without encoding
 * Expected variables: $searchTerm (string), $results (mysqli_result|null)
 */
$pageTitle = 'Search Students';
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="max-w-4xl mx-auto px-6 py-8 animate-fade-up">

    <!-- Search Header -->
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-white mb-1.5">Search Students</h1>
        <p class="text-slate-500 text-sm">Find students by username or major</p>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="<?php echo BASE_URL; ?>/search" class="mb-8" id="search-form">
        <div class="card rounded-2xl p-2 flex items-center gap-2">
            <div class="pl-4 text-slate-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <input type="text" name="q" id="search-input" value="<?php echo $searchTerm; ?>"
                class="input-field flex-1 px-3 py-3 rounded-xl bg-transparent text-white placeholder-slate-600 focus:outline-none text-sm"
                placeholder="Search by name or major...">
            <button type="submit" id="search-btn"
                class="btn-zap px-6 py-3 rounded-xl text-white font-medium text-sm cursor-pointer">
                Search
            </button>
        </div>
    </form>

    <!-- VULNERABLE: Reflected XSS — echoing user input directly without encoding -->
    <?php if ($searchTerm !== ''): ?>
        <div class="card rounded-xl p-4 mb-6 flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <p class="text-sm text-slate-400">Results for: <span class="font-semibold text-white"><?php echo $searchTerm; ?></span></p>
        </div>
    <?php endif; ?>

    <!-- Results Table -->
    <?php if ($results !== null): ?>
        <div class="card rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left" id="results-table">
                    <thead>
                        <tr class="border-b border-white/5 text-[11px] uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-3.5 font-medium">ID</th>
                            <th class="px-6 py-3.5 font-medium">Username</th>
                            <th class="px-6 py-3.5 font-medium">Major</th>
                            <th class="px-6 py-3.5 font-medium text-right">Profile</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.03]">
                        <?php if ($results->num_rows > 0): ?>
                            <?php while ($row = $results->fetch_assoc()): ?>
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
                                <td colspan="4" class="px-6 py-12 text-center text-slate-600">No students match your search.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>