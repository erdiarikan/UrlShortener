<?php

namespace App\Http\Controllers;

use App\Http\Requests\DecodeRequest;
use App\Http\Requests\EncodeRequest;
use App\Services\DecodeService;
use App\Services\EncodeService;

class UrlController extends Controller
{
    public function __construct(
        private readonly EncodeService $encodeService,
        private readonly DecodeService $decodeService
    ) {
    }

    public function encode(EncodeRequest $request)
    {
        $shortUrl = $this->encodeService->encode($request->url);

        return response()->json(['short_url' => $shortUrl]);
    }

    public function decode(DecodeRequest $request)
    {
        $originalUrl = $this->decodeService->decode($request->short_url);

        if (!$originalUrl) {
            return response()->json(['error' => 'Short URL not found'], 404);
        }

        return response()->json(['original_url' => $originalUrl]);
    }
}
