<?php

it('encodes a URL into a short URL', function () {
    $response = $this->postJson('/api/encode', ['url' => 'https://example.com']);
    $response->assertStatus(200)
        ->assertJsonStructure(['short_url']);
});

it('decodes a short URL into its original URL', function () {
    // Encode first
    $encodeResponse = $this->postJson('/api/encode', ['url' => 'https://example.com']);
    $shortUrl = $encodeResponse->json('short_url');

    // Decode
    $decodeResponse = $this->postJson('/api/decode', ['short_url' => $shortUrl]);
    $decodeResponse->assertStatus(200)
        ->assertJson(['original_url' => 'https://example.com']);
});

it('returns 404 for a non-existent short URL', function () {
    $response = $this->postJson('/api/decode', ['short_url' => url('/nonexistent')]);
    $response->assertStatus(404)
        ->assertJson(['error' => 'Short URL not found']);
});
