<?php
function getLatestNewsArticles() {
    $apiKey = getenv('newsdata'); // ✅ use getenv() instead of $_ENV[]

    if (!$apiKey) {
        error_log("❌ API key not found in environment.");
        return [];
    }

    $url = "http://api.mediastack.com/v1/news?access_key=$apiKey&keywords=web+data+management&languages=en";

    $json = @file_get_contents($url);
    if ($json === false) {
        error_log("❌ Failed to fetch data from Mediastack.");
        return [];
    }

    $data = json_decode($json, true);
    
    return isset($data['data']) ? array_slice($data['data'], 0, 3) : [];
}
