<?php

namespace App\Http\Controllers\Api\ShortUrl;

use App\Api\ShortUrlCreator;
use App\ShortUrl;

class ShortUrlController
{
    protected $shortUrlCreator;

    public function __construct(ShortUrlCreator $shortUrlCreator)
    {
        $this->shortUrlCreator = $shortUrlCreator;
    }

    public function index($short_url)
    {
        if($long_url = ShortUrl::find($short_url)) {
            return redirect()->away($long_url['long_url']);
        } else {
            return response()->json(["error" => "invalid url"]);
        }
    }

    public function create()
    {
        if ($long_url = request('url')) {
            $long_url = $this->shortUrlCreator->validateUrl($long_url);
            return response()->json($this->shortUrlCreator->makeShortUrl($long_url));
        } else {
            return response()->json(["error" => "must supply url parameter"]);
        }
    }
}