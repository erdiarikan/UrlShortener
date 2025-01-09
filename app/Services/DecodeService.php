<?php

namespace App\Services;

use Cache;

class DecodeService
{
    private string $cachePrefix;

    public function __construct()
    {
        $this->cachePrefix = config('url_shortener.cache_prefix');
    }

    public function decode(string $shortUrl): ?string
    {
        $shortCode = ltrim(parse_url($shortUrl, PHP_URL_PATH), '/');

        return Cache::get($this->cachePrefix . $shortCode);
    }
}
