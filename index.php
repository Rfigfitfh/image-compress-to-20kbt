<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/tools-data.php';
$tools = all_tools();
site_header('PixelPress Pro - Premium Image Compressor SaaS with 500+ Tools', 'Compress images online with a premium SaaS interface, dedicated SEO pages, smart target sizes, and more than 500 JPG, PNG, WebP and GIF tools.');
?>
<main>
<section class="hero">
  <div><div class="eyebrow">Premium image optimization suite</div><h1>Compress every image to the <span class="gradient">perfect KB target</span>.</h1><p class="lead">A high-quality PHP SaaS website for image compression with <?= count($tools) ?> dedicated tool pages, advanced SEO foundations, shared header/footer, and a conversion-focused premium design.</p><p><a class="btn" href="/tools.php">Explore <?= count($tools) ?> tools</a></p><div class="stats"><div class="stat"><strong><?= count($tools) ?>+</strong><span class="muted">SEO tool URLs</span></div><div class="stat"><strong>25MB</strong><span class="muted">Upload limit</span></div><div class="stat"><strong>4</strong><span class="muted">Image formats</span></div></div></div>
  <div class="hero-card"><span class="badge">Live compressor</span><h2>Upload. Optimize. Download.</h2><p class="muted">Smart iterative compression balances quality, dimensions and file weight for JPG, PNG, WebP and GIF output.</p><div class="grid"><div class="stat"><strong>SEO</strong><span class="muted">schema, meta, sitemap</span></div><div class="stat"><strong>Premium</strong><span class="muted">glass UI and CTAs</span></div></div></div>
</section>
<section class="section"><h2>Popular compression tools</h2><div class="grid">
<?php foreach (array_slice($tools, 0, 12) as $tool): ?><a class="tool-card" href="/tools/<?= htmlspecialchars($tool['slug']) ?>"><h3><?= htmlspecialchars($tool['title']) ?></h3><p class="muted"><?= htmlspecialchars($tool['description']) ?></p></a><?php endforeach; ?>
</div></section>
<section class="section panel"><h2>Built for Google ranking and user trust</h2><div class="grid"><p>Dedicated keyword-rich titles and canonical URLs for every tool page.</p><p>Structured data, sitemap generation, clean internal linking, and fast reusable PHP templates.</p><p>Manual expansion is simple: edit presets, formats, or targets in one data file.</p></div></section>
</main>
<?php site_footer(); ?>
