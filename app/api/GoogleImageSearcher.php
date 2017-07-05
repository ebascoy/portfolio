<?php

namespace App\Api;

use Google_Client;

class GoogleImageSearcher
{
    private $appName;
    private $google_cse_api_key;
    private $optParams;
    private $google_project_id;
    private $google_project_api_key;
    private $service;

    public function __construct($appName = "My Search")
    {
        $this->setVars($appName);
    }

    public function getSearchResults($searchTerm, $optParams = array())
    {
        $items = array();
        $optParams = array_merge($this->optParams, $optParams);
        $results = $this->service->cse->listCse($searchTerm, $optParams);
        foreach($results->getItems() as $k => $item) {
            $items[] = $item;
        }
        return $items;
    }

    public function prepJson($results)
    {
        $resultsArray = [];
        foreach($results as $result) {
            $resultArray['url'] = $result['link'];
            $resultArray['snippet'] = $result['htmlSnippet'];
            $resultArray['thumbnail'] = $result['thumbnailLink'];
            $resultArray['context'] = $result['contextLink'];
            $resultsArray[] = $resultArray;
        }
        return $resultsArray;
    }

    private function setVars($appName)
    {
        $this->google_cse_api_key = env('GOOGLE_CSE_API_KEY');
        $this->optParams = [
            "cx" => env('GOOGLE_CSE_ID'),
            "searchType" => "image",
            "num" => 10
        ];
        $this->google_project_id = env('GOOGLE_PROJECT_ID');
        $this->google_project_api_key = env('GOOGLE_PROJECT_API_KEY');
        $this->appName = $appName;
        $this->service = $this->createService();
    }

    private function createService()
    {
        $client = new Google_Client();
        $client->setApplicationName($this->appName);
        $client->setDeveloperKey($this->google_cse_api_key);
        return new \Google_Service_Customsearch($client);
    }
}