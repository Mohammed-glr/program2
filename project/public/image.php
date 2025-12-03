<?php

$filename = isset($_GET['file']) ? basename($_GET['file']) : null;
$operation = isset($_GET['op']) ? $_GET['op'] : null;
$width = isset($_GET['w']) ? (int)$_GET['w'] : null;
$height = isset($_GET['h']) ? (int)$_GET['h'] : null;
$quality = isset($_GET['q']) ? min(100, max(1, (int)$_GET['q'])) : 85;
$filter = isset($_GET['filter']) ? $_GET['filter'] : null;

if (!$filename) {
    http_response_code(400);
    die('No image file specified');
}

if (preg_match('/\.\./', $filename) || preg_match('/[^a-zA-Z0-9_\-\.]/', $filename)) {
    http_response_code(400);
    die('Invalid filename');
}

$imagePath = __DIR__ . '/assets/uploads/' . $filename;

if (!file_exists($imagePath)) {
    http_response_code(404);
    die('Image not found');
}

$ext = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
$mimeType = match ($ext) {
    'jpg', 'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif',
    'webp' => 'image/webp',
    default => 'image/jpeg'
};

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

if ($operation === 'resize' && ($width || $height)) {
    $image = resizeImage($image, $width, $height);
} elseif ($operation === 'thumbnail' && $width && $height) {
    $image = createThumbnail($image, $width, $height);
} elseif ($operation === 'crop' && $width && $height) {
    $image = cropImage($image, $width, $height);
}

if ($filter) {
    applyFilter($image, $filter);
}

header('Content-Type: ' . $mimeType);
header('Cache-Control: max-age=31536000, public');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');

switch ($ext) {
    case 'jpg':
    case 'jpeg':
        imagejpeg($image, null, $quality);
        break;
    case 'png':
        imagepng($image, null, min(9, max(0, (int)($quality / 10))));
        break;
    case 'gif':
        imagegif($image);
        break;
    case 'webp':
        imagewebp($image, null, $quality);
        break;
}

imagedestroy($image);
exit;


function resizeImage($image, ?int $maxWidth, ?int $maxHeight) {
    $width = imagesx($image);
    $height = imagesy($image);

    if (!$maxWidth && !$maxHeight) {
        return $image;
    }

    $maxWidth = $maxWidth ?: 10000;
    $maxHeight = $maxHeight ?: 10000;

    if ($width <= $maxWidth && $height <= $maxHeight) {
        return $image;
    }

    $aspectRatio = $width / $height;

    if ($width > $height) {
        $newWidth = min($width, $maxWidth);
        $newHeight = (int)($newWidth / $aspectRatio);
    } else {
        $newHeight = min($height, $maxHeight);
        $newWidth = (int)($newHeight * $aspectRatio);
    }

    $resized = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    imagedestroy($image);

    return $resized;
}


function createThumbnail($image, int $width, int $height) {
    $origWidth = imagesx($image);
    $origHeight = imagesy($image);
    $aspectRatio = $origWidth / $origHeight;
    $targetAspect = $width / $height;

    if ($aspectRatio > $targetAspect) {
        $newHeight = $origHeight;
        $newWidth = (int)($newHeight * $targetAspect);
        $x = (int)(($origWidth - $newWidth) / 2);
        $y = 0;
    } else {
        $newWidth = $origWidth;
        $newHeight = (int)($newWidth / $targetAspect);
        $x = 0;
        $y = (int)(($origHeight - $newHeight) / 2);
    }

    $cropped = imagecreatetruecolor($width, $height);
    imagecopyresampled($cropped, $image, 0, 0, $x, $y, $width, $height, $newWidth, $newHeight);
    imagedestroy($image);

    return $cropped;
}


function cropImage($image, int $width, int $height) {
    $origWidth = imagesx($image);
    $origHeight = imagesy($image);

    $width = min($width, $origWidth);
    $height = min($height, $origHeight);

    $x = (int)(($origWidth - $width) / 2);
    $y = (int)(($origHeight - $height) / 2);

    $cropped = imagecreatetruecolor($width, $height);
    imagecopy($cropped, $image, 0, 0, $x, $y, $width, $height);
    imagedestroy($image);

    return $cropped;
}


function applyFilter(&$image, string $filter): void {
    switch ($filter) {
        case 'grayscale':
        case 'gray':
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            break;
        case 'sepia':
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            imagefilter($image, IMG_FILTER_COLORIZE, 39, 26, 8);
            break;
        case 'blur':
            imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
            break;
        case 'sharpen':
            $kernel = array(
                array(-1, -1, -1),
                array(-1, 16, -1),
                array(-1, -1, -1)
            );
            $divisor = 8;
            $offset = 0;
            imageconvolution($image, $kernel, $divisor, $offset);
            break;
        case 'negative':
            imagefilter($image, IMG_FILTER_NEGATE);
            break;
        case 'brightness':
            imagefilter($image, IMG_FILTER_BRIGHTNESS, 30);
            break;
        case 'contrast':
            imagefilter($image, IMG_FILTER_CONTRAST, -20);
            break;
        case 'edges':
            imagefilter($image, IMG_FILTER_EDGEDETECT);
            break;
    }
}
