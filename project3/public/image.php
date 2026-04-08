<?php

declare(strict_types=1);

$filename = $_GET['file'] ?? null;
$width = isset($_GET['w']) ? (int)$_GET['w'] : null;
$height = isset($_GET['h']) ? (int)$_GET['h'] : null;

if (!$filename || preg_match('/[^a-zA-Z0-9_\-\.]/', $filename)) {
    http_response_code(400);
    die('Invalid filename');
}

$imagePath = __DIR__ . '/assets/uploads/' . basename($filename);

if (!file_exists($imagePath)) {
    http_response_code(404);
    die('Image not found');
}

$ext = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

$image = match ($ext) {
    'jpg', 'jpeg' => imagecreatefromjpeg($imagePath),
    'png' => imagecreatefrompng($imagePath),
    'gif' => imagecreatefromgif($imagePath),
    'webp' => imagecreatefromwebp($imagePath),
    default => null
};

if (!$image) {
    http_response_code(500);
    die('Failed to load image');
}

if ($width || $height) {
    $origWidth = imagesx($image);
    $origHeight = imagesy($image);
    $ratio = $origWidth / $origHeight;

    if (!$width) $width = (int)($height * $ratio);
    if (!$height) $height = (int)($width / $ratio);

    if ($origWidth > $width || $origHeight > $height) {
        $newWidth = min($width, $origWidth);
        $newHeight = (int)($newWidth / $ratio);
        
        if ($newHeight > $height) {
            $newHeight = $height;
            $newWidth = (int)($newHeight * $ratio);
        }

        $resized = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
        imagedestroy($image);
        $image = $resized;
    }
}

header('Content-Type: image/' . ($ext === 'jpg' ? 'jpeg' : $ext));
header('Cache-Control: max-age=31536000, public');

match ($ext) {
    'jpg', 'jpeg' => imagejpeg($image, null, 85),
    'png' => imagepng($image, null, 8),
    'gif' => imagegif($image),
    'webp' => imagewebp($image, null, 85),
    default => null
};

imagedestroy($image);
