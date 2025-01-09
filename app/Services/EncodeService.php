<?php

namespace App\Services;

use Cache;
use Str;

class EncodeService
{
    private string $cachePrefix;

    public function __construct()
    {
        $this->cachePrefix = config('url_shortener.cache_prefix');
    }

    public function encode(string $originalUrl): string
    {
        $cachedShortCode = Cache::get($this->cachePrefix . md5($originalUrl));
        if ($cachedShortCode) {
            return url($cachedShortCode);
        }

        $shortCode = $this->generateUniqueShortCode();

        Cache::put($this->cachePrefix . md5($originalUrl), $shortCode);
        Cache::put($this->cachePrefix . $shortCode, $originalUrl);

        return url($shortCode);
    }

    private function generateUniqueShortCode(): string
    {
        while (true) {
            $shortCode = Str::random(6);
            if (!Cache::has($this->cachePrefix . $shortCode)) {
                return $shortCode;
            }
        }
    }
}
