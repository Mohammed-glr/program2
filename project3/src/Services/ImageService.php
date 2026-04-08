<?php

declare(strict_types=1);

class ImageService
{
    private string $uploadDir = __DIR__ . '/../../public/assets/uploads';
    private array $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    public function __construct()
    {
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    public function uploadImage(array $file): array
    {
        if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'filename' => null, 'error' => 'Upload failed'];
        }

        $mimeType = mime_content_type($file['tmp_name']);
        if (!in_array($mimeType, $this->allowedTypes)) {
            return ['success' => false, 'filename' => null, 'error' => 'Invalid image type'];
        }

        $filename = $this->generateFilename($file['name']);
        $destination = $this->uploadDir . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return ['success' => true, 'filename' => $filename, 'error' => null];
        }

        return ['success' => false, 'filename' => null, 'error' => 'Failed to save'];
    }

    public function generateImageFromUrl(string $url): array
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return ['success' => false, 'filename' => null, 'error' => 'Invalid URL'];
        }

        $imageData = @file_get_contents($url);
        if (!$imageData) {
            return ['success' => false, 'filename' => null, 'error' => 'Download failed'];
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'img');
        file_put_contents($tempFile, $imageData);

        $mimeType = mime_content_type($tempFile);
        if (!in_array($mimeType, $this->allowedTypes)) {
            unlink($tempFile);
            return ['success' => false, 'filename' => null, 'error' => 'Invalid image type'];
        }

        $filename = $this->generateFilename(basename(parse_url($url, PHP_URL_PATH)) ?: 'image.jpg');
        $destination = $this->uploadDir . '/' . $filename;

        if (rename($tempFile, $destination)) {
            return ['success' => true, 'filename' => $filename, 'error' => null];
        }

        unlink($tempFile);
        return ['success' => false, 'filename' => null, 'error' => 'Failed to save'];
    }

    public function deleteImage(string $filename): bool
    {
        $filepath = $this->uploadDir . '/' . $filename;
        return file_exists($filepath) ? unlink($filepath) : false;
    }

    private function generateFilename(string $original): string
    {
        $ext = pathinfo($original, PATHINFO_EXTENSION) ?: 'jpg';
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '', pathinfo($original, PATHINFO_FILENAME)) ?: 'image';
        return $name . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    }
}
