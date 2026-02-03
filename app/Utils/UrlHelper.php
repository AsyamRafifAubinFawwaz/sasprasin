<?php

namespace App\Utils;

class UrlHelper
{
    /**
     * Get the URL for an uploaded image, handling environment differences.
     *
     * @param string|null $path
     * @return string|null
     */
    public static function getImageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $path = ltrim($path, '/');
        $documentRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
        $isPublicRoot = $documentRoot && (str_ends_with($documentRoot, 'public') || str_ends_with($documentRoot, 'public\\'));

        if ($isPublicRoot) {
            return asset($path);
        }

        return asset('public/' . $path);
    }
}
