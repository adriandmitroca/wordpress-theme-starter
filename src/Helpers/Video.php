<?php

namespace Rcore\Helpers;

class Video
{
    public static function fetchThumbnail($url)
    {
        if (Str::contains($url, 'vimeo')) {
            return self::fetchVimeoThumbnail($url);
        }

        if (Str::contains($url, ['youtube', 'youtu.be'])) {
            return self::fetchYouTubeThumbnail($url);
        }
    }

    public static function fetchVimeoThumbnail($url)
    {
        $id = self::parseVimeoId($url);

        if ( ! $id) {
            return null;
        }

        $res = unserialize(file_get_contents('https://vimeo.com/api/v2/video/' . $id . '.php'));

        return $res[0]['thumbnail_large'] ?: null;
    }

    public static function fetchYouTubeThumbnail($url)
    {
        $id = self::parseYouTubeId($url);

        if ( ! $id) {
            return null;
        }

        return 'https://img.youtube.com/vi/' . $id . '/maxresdefault.jpg';
    }

    private static function parseVimeoId($url)
    {
        $pattern = '#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*#';

        preg_match($pattern, $url, $matches);

        return $matches[1] ?? null;
    }

    private static function parseYouTubeId($url)
    {
        $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&amp;v=))([\w-]{11})(?:.+)?$#x';

        preg_match($pattern, $url, $matches);

        return $matches[1] ?? null;
    }
}