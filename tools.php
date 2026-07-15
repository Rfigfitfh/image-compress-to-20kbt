<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/tools-data.php';
$tools = all_tools();
site_header('All Image Compression Tools - PixelPress Pro', 'Browse more than 500 premium image compression tools with dedicated URLs for JPG, PNG, WebP and GIF optimization.');
?>
<main class="section"><h1 class="page-title">All <span class="gradient"><?= count($tools) ?>+</span> image tools</h1><p class="lead">Search dedicated image compressor pages by format, target KB, or use case.</p><input class="search" id="search" placeholder="Search tools, e.g. passport jpg 20kb" oninput="filterTools(this.value)"><div class="grid" id="tools">
<?php foreach ($tools as $tool): ?><a class="tool-card" data-tool="<?= htmlspecialchars(strtolower($tool['title'].' '.$tool['description'])) ?>" href="/tools/<?= htmlspecialchars($tool['slug']) ?>"><h3><?= htmlspecialchars($tool['title']) ?></h3><p class="muted"><?= htmlspecialchars($tool['description']) ?></p></a><?php endforeach; ?>
</div></main><script>function filterTools(q){q=q.toLowerCase();document.querySelectorAll('[data-tool]').forEach(c=>c.style.display=c.dataset.tool.includes(q)?'block':'none')}</script>
<?php site_footer(); ?>
