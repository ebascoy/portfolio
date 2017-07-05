<?php

namespace App\Http\Controllers\Api\ImageSearch;

use App\Http\Controllers\Controller;
use App\Api\GoogleImageSearcher;

class ImageSearchController extends Controller
{
    public function index()
    {
        if ($search_term = request('term')) {
            $optParams = request('offset') ? ["start" => request('offset')] : [];
            $imageSearch = new GoogleImageSearcher();
            $results = $imageSearch->getSearchResults($search_term, $optParams);
            $json = $imageSearch->prepJson($results);
        } else {
            $json = ["error" => "Search term parameter required"];
        }
            return response()->json($json);
    }

    public function recentSearches ()
    {

    }
}
