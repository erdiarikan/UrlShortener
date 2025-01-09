URL Shortener
=============

A simple URL shortening service built with Laravel, Sail, and Docker.

Features
------------

- `/api/encode`: Encodes a given URL into a shortened URL.
- `/api/decode`: Decodes a shortened URL back to its original URL.
- URLs are stored in memory using Laravel's Cache. The cache is stored in redis.

Requirements
------------

*   Docker
*   Composer

Installation
------------

1.  Clone the repository:

        git clone https://github.com/erdiarikan/UrlShortener.git && cd UrlShortener

2.  Copy the .env.example file to .env:

        cp .env.example .env

3. Install composer dependencies:

        composer install

4. Start Docker and run Laravel Sail:

        ./vendor/bin/sail up -d
 
4. Generate a new application key:

        ./vendor/bin/sail artisan key:generate
 
5. Install dependencies:

        ./vendor/bin/sail composer install

Usage
-----

### Encoding a URL

Send a `POST` request to `/api/encode` with the following payload:

    {
        "url": "https://example.com"
    }

Response:

    {
        "short_url": "http://localhost/abc123"
    }

### Decoding a Short URL

Send a `POST` request to `/api/decode` with the following payload:

    {
        "short_url": "http://localhost/abc123"
    }

Response:

    {
        "original_url": "https://example.com"
    }

Testing
-------

Run the test suite using Pest:

    ./vendor/bin/sail test

This will run the tests defined in `tests/Feature/UrlShortenerTest.php`.

Development
-----------

*   Start the development server:

        ./vendor/bin/sail up -d

*   Access the application at [http://localhost](http://localhost).

API Endpoints
-------------

*   `POST /api/encode`: Encodes a given URL into a short URL.
*   `POST /api/decode`: Decodes a short URL into its original URL.

Code Quality
------------

Ensure that the code adheres to PSR-12 standards using `phpcs`:

    ./vendor/bin/sail phpcs

To automatically fix issues:

    ./vendor/bin/sail phpcbf

Contributing
------------

Feel free to submit pull requests or issues for improvements.
