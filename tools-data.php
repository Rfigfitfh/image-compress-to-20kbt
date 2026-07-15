<?php
$FORMATS = ['jpg' => 'JPG', 'jpeg' => 'JPEG', 'png' => 'PNG', 'webp' => 'WebP', 'gif' => 'GIF'];
$TARGETS = [5, 10, 15, 20, 25, 30, 40, 50, 75, 100, 150, 200, 250, 300, 500, 750, 1024, 2048, 5120, 10240];
$PRESETS = [
    'profile-photo' => ['Profile Photo', 'compress portraits for social profiles, resumes, and member portals'],
    'passport-photo' => ['Passport Photo', 'meet strict upload-size limits for government and visa forms'],
    'signature' => ['Signature', 'prepare clear scanned signatures for online applications'],
    'document-scan' => ['Document Scan', 'reduce ID cards, invoices, certificates, and scanned pages'],
    'product-photo' => ['Product Photo', 'speed up ecommerce galleries without losing selling detail'],
    'blog-image' => ['Blog Image', 'optimize editorial images for faster Core Web Vitals'],
    'hero-banner' => ['Hero Banner', 'create lightweight landing-page visuals'],
    'thumbnail' => ['Thumbnail', 'make compact previews for grids and dashboards'],
    'logo' => ['Logo', 'compress brand assets while keeping crisp edges'],
    'wallpaper' => ['Wallpaper', 'shrink high-resolution wallpapers for sharing'],
    'certificate' => ['Certificate', 'optimize certificates for portals and email attachments'],
    'meme' => ['Meme', 'compress viral images for fast sharing'],
    'real-estate' => ['Real Estate Photo', 'publish property photos quickly'],
    'restaurant-menu' => ['Restaurant Menu', 'make menu images easier to load'],
    'medical-report' => ['Medical Report', 'prepare report images for patient portals'],
    'school-form' => ['School Form', 'reduce admission and scholarship form images'],
    'job-application' => ['Job Application Photo', 'fit recruitment portal upload rules'],
    'marketplace' => ['Marketplace Listing', 'optimize listing photos for buyers'],
    'instagram' => ['Instagram Image', 'compress social images for mobile sharing'],
    'facebook' => ['Facebook Image', 'prepare posts, covers, and story assets'],
    'twitter-x' => ['X / Twitter Image', 'reduce images for fast timeline delivery'],
    'linkedin' => ['LinkedIn Image', 'optimize professional media assets'],
    'youtube' => ['YouTube Thumbnail', 'make thumbnails small and sharp'],
    'whatsapp' => ['WhatsApp Image', 'compress pictures before sending'],
    'telegram' => ['Telegram Image', 'reduce images for channels and chats'],
    'email' => ['Email Attachment', 'make image attachments inbox friendly'],
    'website' => ['Website Image', 'improve page speed and SEO'],
];

function tool_slug(string $preset, string $format, int $target): string
{
    return "compress-$preset-$format-to-{$target}kb";
}

function all_tools(): array
{
    global $FORMATS, $TARGETS, $PRESETS;
    $tools = [];
    foreach ($PRESETS as $presetSlug => $preset) {
        foreach ($FORMATS as $format => $label) {
            foreach ($TARGETS as $target) {
                $slug = tool_slug($presetSlug, $format, $target);
                $tools[$slug] = [
                    'slug' => $slug,
                    'preset' => $presetSlug,
                    'presetName' => $preset[0],
                    'format' => $format,
                    'formatLabel' => $label,
                    'targetKb' => $target,
                    'title' => "Compress {$preset[0]} {$label} to {$target}KB Online",
                    'description' => "Use this premium image compressor to {$preset[1]} and target a {$target}KB file size in {$label} format.",
                ];
            }
        }
    }
    return $tools;
}

function find_tool(string $slug): ?array
{
    $tools = all_tools();
    return $tools[$slug] ?? null;
}
