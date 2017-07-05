<?php

namespace App\Http\Controllers\Api\ImageSearch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\GoogleImageSearcher;

class ImageSearchController extends Controller
{
    public function index()
    {
        $search_term = request('term');
        $imageSearch = new GoogleImageSearcher();
        $results = $imageSearch->getSearchResults($search_term);
        $json = $imageSearch->prepJson($results);
        return response()->json($json);
    }
}
