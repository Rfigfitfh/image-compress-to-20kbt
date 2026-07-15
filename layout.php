<?php
function site_header(string $title, string $description = ''): void
{
    $canonical = 'https://' . ($_SERVER['HTTP_HOST'] ?? 'example.com') . strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
    require_once __DIR__ . '/tools-data.php';
    $count = count(all_tools());
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($title) ?></title>
<meta name="description" content="<?= htmlspecialchars($description ?: 'Premium online image compression tools for JPG, PNG, WebP and GIF with dedicated 500+ SEO optimized pages.') ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
<meta property="og:title" content="<?= htmlspecialchars($title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($description) ?>">
<meta name="robots" content="index,follow,max-image-preview:large">
<link rel="stylesheet" href="/assets/style.css">
<script type="application/ld+json">{"@context":"https://schema.org","@type":"WebApplication","name":"PixelPress Pro","applicationCategory":"MultimediaApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"featureList":"<?= $count ?> image compression tools with JPG, PNG, WebP and GIF targets"}</script>
</head>
<body>
<header class="site-header">
  <a class="brand" href="/"><span>PixelPress</span> Pro</a>
  <nav><a href="/tools.php">Tools</a><a href="/features.php">Features</a><a href="/about.php">About</a><a class="nav-cta" href="/tools.php">Start compressing</a></nav>
</header>
<?php }
function site_footer(): void { ?>
<footer class="site-footer">
  <div><h3>PixelPress Pro</h3><p>Premium browser-friendly image compression for creators, agencies, students and businesses.</p></div>
  <div><h4>Tools</h4><a href="/tools.php">All compressors</a><a href="/tools/compress-passport-photo-jpg-to-20kb">Passport JPG 20KB</a><a href="/tools/compress-signature-png-to-10kb">Signature PNG 10KB</a></div>
  <div><h4>Company</h4><a href="/about.php">About</a><a href="/features.php">Features</a><a href="/contact.php">Contact</a></div>
  <div><h4>Legal</h4><a href="/privacy.php">Privacy Policy</a><a href="/terms.php">Terms of Use</a><a href="/cookies.php">Cookie Policy</a><a href="/sitemap.php">Sitemap</a></div>
</footer>
</body></html>
<?php }
