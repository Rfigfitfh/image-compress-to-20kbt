<?php
function human_bytes(int $bytes): string
{
    if ($bytes >= 1048576) {
        return round($bytes / 1048576, 2) . ' MB';
    }
    return round($bytes / 1024, 2) . ' KB';
}

function compress_uploaded_image(array $file, string $format, int $targetKb): array
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'error' => 'Please upload a valid image file.'];
    }
    if (($file['size'] ?? 0) > 25 * 1024 * 1024) {
        return ['ok' => false, 'error' => 'Maximum upload size is 25MB.'];
    }

    $tmp = $file['tmp_name'];
    $info = @getimagesize($tmp);
    if (!$info) {
        return ['ok' => false, 'error' => 'The uploaded file is not a supported image.'];
    }

    $mime = $info['mime'];
    $source = null;
    if ($mime === 'image/jpeg') {
        $source = imagecreatefromjpeg($tmp);
    } elseif ($mime === 'image/png') {
        $source = imagecreatefrompng($tmp);
    } elseif ($mime === 'image/webp' && function_exists('imagecreatefromwebp')) {
        $source = imagecreatefromwebp($tmp);
    } elseif ($mime === 'image/gif') {
        $source = imagecreatefromgif($tmp);
    }

    if (!$source) {
        return ['ok' => false, 'error' => 'This server needs GD support for JPG, PNG, WebP, or GIF images.'];
    }

    $uploadDir = __DIR__ . '/uploads';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $targetBytes = max(1, $targetKb) * 1024;
    $width = imagesx($source);
    $height = imagesy($source);
    $bestPath = null;
    $bestSize = PHP_INT_MAX;
    $ext = in_array($format, ['jpg', 'jpeg'], true) ? 'jpg' : $format;

    for ($scale = 1.0; $scale >= 0.25; $scale -= 0.08) {
        $newW = max(64, (int) round($width * $scale));
        $newH = max(64, (int) round($height * $scale));
        $canvas = imagecreatetruecolor($newW, $newH);
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);
        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $newW, $newH, $width, $height);

        for ($quality = 92; $quality >= 20; $quality -= 6) {
            $name = 'compressed-' . bin2hex(random_bytes(8)) . '.' . $ext;
            $path = $uploadDir . '/' . $name;
            if (in_array($format, ['jpg', 'jpeg'], true)) {
                imagejpeg($canvas, $path, $quality);
            } elseif ($format === 'png') {
                imagepng($canvas, $path, min(9, max(0, (int) round((100 - $quality) / 10))));
            } elseif ($format === 'webp' && function_exists('imagewebp')) {
                imagewebp($canvas, $path, $quality);
            } else {
                imagegif($canvas, $path);
            }
            $size = filesize($path);
            if ($size < $bestSize) {
                if ($bestPath && file_exists($bestPath)) {
                    unlink($bestPath);
                }
                $bestPath = $path;
                $bestSize = $size;
            } else {
                unlink($path);
            }
            if ($size <= $targetBytes) {
                imagedestroy($canvas);
                imagedestroy($source);
                return ['ok' => true, 'url' => 'uploads/' . basename($bestPath), 'size' => $bestSize, 'original' => (int) $file['size']];
            }
        }
        imagedestroy($canvas);
    }

    imagedestroy($source);
    return ['ok' => true, 'url' => 'uploads/' . basename($bestPath), 'size' => $bestSize, 'original' => (int) $file['size'], 'note' => 'Best possible result created; extremely complex images may remain above the selected target.'];
}
