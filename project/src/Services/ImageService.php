<?php

class ImageService
{
    private string $uploadDir = __DIR__ . '/../../public/assets/uploads';
    private string $thumbDir = __DIR__ . '/../../public/assets/uploads/thumbnails';
    private int $maxWidth = 1200;
    private int $maxHeight = 1200;
    private int $thumbWidth = 300;
    private int $thumbHeight = 300;
    private array $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    public function __construct()
    {
        $this->ensureDirectoriesExist();
    }

    private function ensureDirectoriesExist(): void
    {
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
        if (!is_dir($this->thumbDir)) {
            mkdir($this->thumbDir, 0755, true);
        }
    }

    public function uploadImage(array $fileArray): array
    {
        $result = [
            'success' => false,
            'filename' => null,
            'thumbnail' => null,
            'error' => null
        ];

        if (!isset($fileArray['error']) || $fileArray['error'] !== UPLOAD_ERR_OK) {
            $result['error'] = 'File upload failed';
            return $result;
        }

        if (!isset($fileArray['tmp_name'])) {
            $result['error'] = 'Invalid file data';
            return $result;
        }

        $tmpFile = $fileArray['tmp_name'];
        $originalName = $fileArray['name'] ?? 'image';

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $tmpFile);
        finfo_close($finfo);

        if (!in_array($mimeType, $this->allowedMimeTypes)) {
            $result['error'] = 'Invalid image format. Allowed: JPEG, PNG, GIF, WebP';
            return $result;
        }

        try {
            $filename = $this->generateFilename($originalName);
            $filepath = $this->uploadDir . '/' . $filename;

            $image = $this->loadImage($tmpFile, $mimeType);
            if (!$image) {
                $result['error'] = 'Failed to load image';
                return $result;
            }

            $image = $this->resizeImage($image, $this->maxWidth, $this->maxHeight);

            if (!$this->saveImage($image, $filepath, $mimeType)) {
                $result['error'] = 'Failed to save image';
                return $result;
            }

            imagedestroy($image);

            $thumbnailName = $this->generateThumbnailName($filename);
            $thumbnailPath = $this->thumbDir . '/' . $thumbnailName;

            $thumbImage = $this->loadImage($filepath, $this->getMimeTypeFromPath($filepath));
            if ($thumbImage) {
                $thumbImage = $this->resizeImage($thumbImage, $this->thumbWidth, $this->thumbHeight, true);
                $this->saveImage($thumbImage, $thumbnailPath, $this->getMimeTypeFromPath($filepath));
                imagedestroy($thumbImage);
            }

            $result['success'] = true;
            $result['filename'] = $filename;
            $result['thumbnail'] = $thumbnailName;

        } catch (Exception $e) {
            $result['error'] = $e->getMessage();
        }

        return $result;
    }

    public function generateImageFromUrl(string $url): array
    {
        $result = [
            'success' => false,
            'filename' => null,
            'error' => null
        ];

        try {
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $result['error'] = 'Invalid URL format';
                return $result;
            }

            $imageData = @file_get_contents($url);
            if ($imageData === false) {
                $result['error'] = 'Failed to download image from URL';
                return $result;
            }

            $tmpFile = tempnam(sys_get_temp_dir(), 'img');
            file_put_contents($tmpFile, $imageData);

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $tmpFile);
            finfo_close($finfo);

            if (!in_array($mimeType, $this->allowedMimeTypes)) {
                unlink($tmpFile);
                $result['error'] = 'Invalid image format from URL';
                return $result;
            }

            $originalName = basename(parse_url($url, PHP_URL_PATH)) ?: 'image_' . time();
            $filename = $this->generateFilename($originalName);
            $filepath = $this->uploadDir . '/' . $filename;

            $image = $this->loadImage($tmpFile, $mimeType);
            if (!$image) {
                unlink($tmpFile);
                $result['error'] = 'Failed to process downloaded image';
                return $result;
            }

            $image = $this->resizeImage($image, $this->maxWidth, $this->maxHeight);

            if (!$this->saveImage($image, $filepath, $mimeType)) {
                imagedestroy($image);
                unlink($tmpFile);
                $result['error'] = 'Failed to save processed image';
                return $result;
            }

            imagedestroy($image);
            unlink($tmpFile);

            $thumbnailName = $this->generateThumbnailName($filename);
            $thumbnailPath = $this->thumbDir . '/' . $thumbnailName;

            $thumbImage = $this->loadImage($filepath, $mimeType);
            if ($thumbImage) {
                $thumbImage = $this->resizeImage($thumbImage, $this->thumbWidth, $this->thumbHeight, true);
                $this->saveImage($thumbImage, $thumbnailPath, $mimeType);
                imagedestroy($thumbImage);
            }

            $result['success'] = true;
            $result['filename'] = $filename;

        } catch (Exception $e) {
            $result['error'] = $e->getMessage();
        }

        return $result;
    }

    public function addWatermark(string $imagePath, string $watermarkText): bool
    {
        try {
            if (!file_exists($imagePath)) {
                return false;
            }

            $mimeType = $this->getMimeTypeFromPath($imagePath);
            $image = $this->loadImage($imagePath, $mimeType);

            if (!$image) {
                return false;
            }

            $width = imagesx($image);
            $height = imagesy($image);
            $textColor = imagecolorallocatealpha($image, 255, 255, 255, 50);
            $fontSize = 5;

            $bbox = imagettfbbox($fontSize, 0, __DIR__ . '/../../resources/fonts/arial.ttf', $watermarkText);
            $textWidth = $bbox[2] - $bbox[0];
            $textHeight = $bbox[1] - $bbox[7];

            $x = $width - $textWidth - 10;
            $y = $height - $textHeight - 10;

            imagestring($image, $fontSize, $x, $y, $watermarkText, $textColor);

            $this->saveImage($image, $imagePath, $mimeType);
            imagedestroy($image);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    private function resizeImage($image, int $maxWidth, int $maxHeight, bool $crop = false)
    {
        $width = imagesx($image);
        $height = imagesy($image);

        if ($width <= $maxWidth && $height <= $maxHeight) {
            return $image;
        }

        if ($crop) {
            $aspectRatio = $maxWidth / $maxHeight;
            $currentAspect = $width / $height;

            if ($currentAspect > $aspectRatio) {
                $newWidth = (int)($height * $aspectRatio);
                $newHeight = $height;
                $x = (int)(($width - $newWidth) / 2);
                $y = 0;
            } else {
                $newWidth = $width;
                $newHeight = (int)($width / $aspectRatio);
                $x = 0;
                $y = (int)(($height - $newHeight) / 2);
            }

            $croppedImage = imagecreatetruecolor($maxWidth, $maxHeight);
            imagecopyresampled($croppedImage, $image, 0, 0, $x, $y, $maxWidth, $maxHeight, $newWidth, $newHeight);
            imagedestroy($image);
            return $croppedImage;
        } else {
            $aspectRatio = $width / $height;

            if ($width > $height) {
                $newWidth = min($width, $maxWidth);
                $newHeight = (int)($newWidth / $aspectRatio);
            } else {
                $newHeight = min($height, $maxHeight);
                $newWidth = (int)($newHeight * $aspectRatio);
            }

            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            return $resizedImage;
        }
    }


    private function loadImage(string $filepath, string $mimeType)
    {
        if (!file_exists($filepath)) {
            return null;
        }

        return match ($mimeType) {
            'image/jpeg' => imagecreatefromjpeg($filepath),
            'image/png' => imagecreatefrompng($filepath),
            'image/gif' => imagecreatefromgif($filepath),
            'image/webp' => imagecreatefromwebp($filepath),
            default => null
        };
    }

    private function saveImage($image, string $filepath, string $mimeType): bool
    {
        return match ($mimeType) {
            'image/jpeg' => imagejpeg($image, $filepath, 85),
            'image/png' => imagepng($image, $filepath, 8),
            'image/gif' => imagegif($image, $filepath),
            'image/webp' => imagewebp($image, $filepath, 85),
            default => false
        };
    }

    public function deleteImage(string $filename): bool
    {
        try {
            $filepath = $this->uploadDir . '/' . $filename;
            if (file_exists($filepath)) {
                unlink($filepath);
            }

            $thumbnailName = $this->generateThumbnailName($filename);
            $thumbnailPath = $this->thumbDir . '/' . $thumbnailName;
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getImageUrl(string $filename): string
    {
        return '/project/public/assets/uploads/' . $filename;
    }

 
    public function getThumbnailUrl(string $filename): string
    {
        $thumbnailName = $this->generateThumbnailName($filename);
        return '/project/public/assets/uploads/thumbnails/' . $thumbnailName;
    }
    private function generateFilename(string $originalName): string
    {
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $sanitized = preg_replace('/[^a-zA-Z0-9_-]/', '', pathinfo($originalName, PATHINFO_FILENAME));
        return ($sanitized ?: 'image') . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    }


    private function generateThumbnailName(string $filename): string
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $name = pathinfo($filename, PATHINFO_FILENAME);
        return $name . '_thumb.' . $ext;
    }

    private function getMimeTypeFromPath(string $filepath): string
    {
        $ext = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
        return match ($ext) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            default => 'image/jpeg'
        };
    }
}
