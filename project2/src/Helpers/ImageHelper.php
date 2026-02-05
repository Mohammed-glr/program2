<?php


class ImageHelper
{
    public static function imageUrl(?string $filename, ?int $width = null, ?int $height = null, ?string $filter = null, int $quality = 85): string
    {
        if (!$filename) {
            return self::placeholderUrl($width, $height);
        }

        $url = '/project/public/image.php?file=' . urlencode($filename);

        if ($width && $height) {
            $url .= '&op=resize&w=' . (int)$width . '&h=' . (int)$height;
        } elseif ($width || $height) {
            $url .= '&op=resize';
            if ($width) {
                $url .= '&w=' . (int)$width;
            }
            if ($height) {
                $url .= '&h=' . (int)$height;
            }
        }

        if ($filter) {
            $url .= '&filter=' . urlencode($filter);
        }

        if ($quality !== 85) {
            $url .= '&q=' . (int)$quality;
        }

        return $url;
    }


    
    public static function img(?string $filename, string $alt = '', ?int $width = null, ?int $height = null, string $class = '', ?string $filter = null): string
    {
        $src = self::imageUrl($filename, $width, $height, $filter);
        $widthAttr = $width ? ' width="' . (int)$width . '"' : '';
        $heightAttr = $height ? ' height="' . (int)$height . '"' : '';
        $classAttr = $class ? ' class="' . htmlspecialchars($class) . '"' : '';

        return '<img src="' . htmlspecialchars($src) . '" alt="' . htmlspecialchars($alt) . '"' . $widthAttr . $heightAttr . $classAttr . '>';
    }

   
    public static function thumbnail(?string $filename, string $alt = '', int $width = 300, int $height = 300, string $class = ''): string
    {
        $src = self::thumbnailUrl($filename, $width, $height);
        $classAttr = $class ? ' class="' . htmlspecialchars($class) . '"' : '';

        return '<img src="' . htmlspecialchars($src) . '" alt="' . htmlspecialchars($alt) . '" width="' . (int)$width . '" height="' . (int)$height . '"' . $classAttr . '>';
    }


   
    public static function hasImage(?string $filename): bool
    {
        return !empty($filename) && is_string($filename) && strlen($filename) > 0;
    }
}
