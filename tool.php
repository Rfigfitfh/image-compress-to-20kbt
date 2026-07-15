<?php
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/tools-data.php';
require_once __DIR__ . '/compressor.php';
$slug = $_GET['slug'] ?? '';
$tool = find_tool($slug);
if (!$tool) { http_response_code(404); site_header('Tool not found - PixelPress Pro'); echo '<main class="section"><h1>Tool not found</h1><p class="lead">Browse all available tools.</p><a class="btn" href="/tools.php">All tools</a></main>'; site_footer(); exit; }
$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') { $result = compress_uploaded_image($_FILES['image'] ?? [], $tool['format'], (int)($_POST['targetKb'] ?? $tool['targetKb'])); }
site_header($tool['title'] . ' - Free Premium Tool', $tool['description']);
?>
<main class="section"><p class="eyebrow">Dedicated compressor</p><h1 class="page-title"><?= htmlspecialchars($tool['title']) ?></h1><p class="lead"><?= htmlspecialchars($tool['description']) ?> Upload your file, keep quality high, and download an optimized result instantly.</p><section class="compressor"><form class="upload-box" method="post" enctype="multipart/form-data"><label>Choose image</label><input type="file" name="image" accept="image/jpeg,image/png,image/webp,image/gif" required><label>Target size in KB</label><input type="number" name="targetKb" value="<?= (int)$tool['targetKb'] ?>" min="1" max="10240"><button class="btn" type="submit">Compress to <?= (int)$tool['targetKb'] ?>KB</button></form><div class="panel"><h2>Result</h2><?php if ($result): ?><?php if ($result['ok']): ?><p class="badge">Compression complete</p><p>Original: <?= human_bytes($result['original']) ?> · New: <?= human_bytes($result['size']) ?></p><?php if (!empty($result['note'])): ?><p class="muted"><?= htmlspecialchars($result['note']) ?></p><?php endif; ?><a class="btn" href="/<?= htmlspecialchars($result['url']) ?>" download>Download optimized image</a><?php else: ?><p><?= htmlspecialchars($result['error']) ?></p><?php endif; ?><?php else: ?><p class="muted">Your optimized download link appears here after compression.</p><?php endif; ?></div></section><section class="section"><h2>How to use this tool</h2><div class="grid"><div class="tool-card"><h3>1. Upload</h3><p class="muted">Select a JPG, PNG, WebP or GIF image up to 25MB.</p></div><div class="tool-card"><h3>2. Optimize</h3><p class="muted">The PHP engine tests quality levels and dimensions to reach your KB target.</p></div><div class="tool-card"><h3>3. Download</h3><p class="muted">Save the compressed image for forms, websites, social media or email.</p></div></div></section></main>
<?php site_footer(); ?>
