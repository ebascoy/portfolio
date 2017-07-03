<?php

namespace App\Api;

use App\ShortUrl;

class ShortUrlCreator
{
    public function validateUrl($long_url)
    {
        $long_url = filter_var($long_url, FILTER_SANITIZE_URL);
        $long_url = $this->add_scheme_if_missing($long_url);
        return filter_var($long_url, FILTER_VALIDATE_URL);
    }
    public function makeShortUrl($long_url)
    {
        $short_url = null;
        $short_url_result = ShortUrl::where('long_url', $long_url)->get();
        foreach ($short_url_result as $result) {
            $short_url = $result->id;
        }
        if ($long_url && $short_url) {
            return [
                "original_url"  => $long_url,
                "short_url"     => env('APP_URL') . "/short/$short_url"
            ];
        } elseif ($long_url) {
            $newShort = new ShortUrl;
            $newShort->long_url = $long_url;
            $newShort->save();
            $short_url_result = ShortUrl::where('long_url', $long_url)->get();
//        return $short_url_result;
            foreach ($short_url_result as $result) {
                $short_url = $result->id;
            }
            return [
                "original_url"  => $long_url,
                "short_url"     => env('APP_URL') . "/short/$short_url"
            ];
        } else {
            return [
                "error" => "URL supplied is invalid"
            ];
        }
    }
    private function add_scheme_if_missing($url)
    {
        if ( $parts = parse_url($url) ) {
            if ( !isset($parts["scheme"]) )
            {
                return "http://$url";
            } else {
                return $url;
            }
        }
    }
}