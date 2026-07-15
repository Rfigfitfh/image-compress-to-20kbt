<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/tools-data.php';
site_header(ucfirst('features') . ' - PixelPress Pro', 'Important PixelPress Pro information, policies, and image compression resources.');
?>
<main class="section"><h1 class="page-title"><?= ucfirst('features') ?></h1><div class="panel"><p class="lead">PixelPress Pro provides premium online image compression tools with transparent policies, fast workflows, and SEO-friendly dedicated tool pages.</p><?php if ('features' === 'sitemap'): ?><ul><?php foreach (array_slice(all_tools(),0,120) as $tool): ?><li><a href="/tools/<?= htmlspecialchars($tool['slug']) ?>"><?= htmlspecialchars($tool['title']) ?></a></li><?php endforeach; ?></ul><?php else: ?><p class="muted">This page is ready for your custom business content. Update this PHP file manually to add company-specific details, policy language, pricing, or support instructions.</p><?php endif; ?></div></main>
<?php site_footer(); ?>
