<?php

require 'vendor/autoload.php';

$lastdate = file_get_contents('LastDate.txt');

$client = new \GuzzleHttp\Client();

// MOVIES DETAILS
$res = $client->request('GET', 'https://yts.ag/api/v2/list_movies.json', ["verify" => false]);
$tab = $res->getBody();
$moviesTab = json_decode($tab, true);
$movies = $moviesTab['data']['movies'];


foreach ($movies as $movie) {
    var_dump($movies);
    $torrents = $movie['torrents'];
    foreach ($torrents as $torrent) {
        $dateTorrent = $torrent['date_uploaded_unix'];
        if ($dateTorrent > $lastdate) {
            var_dump($torrents);
        }
    }
}

file_put_contents('LastDate.txt', time());
