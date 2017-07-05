<?php

namespace App\Http\Controllers\Api\ImageSearch;

use App\Http\Controllers\Controller;
use App\Api\GoogleImageSearcher;
use App\SearchTerm;

class ImageSearchController extends Controller
{
    public function index()
    {
        if ($search_term = request('term')) {
            $optParams = request('offset') ? ["start" => request('offset')] : [];
            $imageSearch = new GoogleImageSearcher();
            $results = $imageSearch->getSearchResults($search_term, $optParams);
            $json = $imageSearch->prepJson($results);
            $searchModel = new SearchTerm();
            $searchModel->search_term = $search_term;
            $searchModel->save();
        } else {
            $json = ["error" => "Search term parameter required"];
        }
            return response()->json($json);
    }

    public function recentSearches ()
    {
        $searches = SearchTerm::orderBy('created_at', 'desc')->take(10)->get();
        if (count($searches)) {
            foreach ($searches as $search) {
                $result[] = [
                    "term" => $search['search_term'],
                    "when" => $search['created_at']
                ];
            }
        } else {
            $result = ["message", "no recent searches found"];
        }
        return response()->json($result);
    }
}
