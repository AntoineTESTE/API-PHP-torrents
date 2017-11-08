<?php

require 'vendor/autoload.php';


$id = $_GET["id"];
$client = new \GuzzleHttp\Client();


// MOVIES DETAILS
$res = $client->request('GET', 'https://yts.ag/api/v2/movie_details.json?movie_id='.$id, ["verify" => false]);
$tab = $res->getBody();
$movieDetails = json_decode($tab, true);
//var_dump($movieDetails);


// SUGGESTS
$resSuggests = $client->request('GET', 'https://yts.ag/api/v2/movie_suggestions.json?movie_id='.$id, ["verify" => false]);
$suggests = $resSuggests->getBody();
$suggestsTab = json_decode($suggests, true);
//var_dump($suggest);


/* REVIEWS (marche pas)
$resReviews = $client->request('GET', 'https://yts.ag/api/v2/movie_reviews.json?movie_id='.$id, ["verify" => false]);
$reviews = $resReviews->getBody();
$reviewsTab = json_decode($reviews, true);
//var_dump($suggest);
*/

$imdbCode = $movieDetails['data']['movie']['imdb_code'];
$poster = $movieDetails['data']['movie']['medium_cover_image'];
$torrents = $movieDetails['data']['movie']['torrents'];
$ytTrailerId = $movieDetails['data']['movie']['yt_trailer_code'];
$suggest = $suggestsTab['data']['movies'];
var_dump($reviewsTab);

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<!-- POSTER -->
<img src="<?= $poster ?>">  

<!-- IMDB LINK -->
<a href="http://www.imdb.com/title/<?= $imdbCode ?>/">
<p> lien IMDB </p>

    
<?php
// MAGNET
foreach ($torrents as $torrent) {
    $hash = urlencode($torrent['hash']);
?>
<a href="magnet:?xt=urn:btih:"<?= $hash ?>"&tr=http://track.one:1234/announce&tr=udp://track.two:80">
<p> lien torrent </p></a>
<?php
}
?>

<!-- IFRAME YT -->
    <div>
        <iframe id="player" type="text/html" width="640" height="360" src="http://www.youtube.com/embed/<?= $ytTrailerId ?>"
        frameborder="0"></iframe>
    </div>
    <div>
    <h3>SUJECCTIOONNN</h3>  
<?php
// SUGGESTS
foreach ($suggest as $movie) {
    $suggestposter = $movie['medium_cover_image'];
    ?>

    <a href="movieDetails.php?id=<?= $movie["id"] ?>">
    <img src="<?= $suggestposter ?>"> </a>
</div>
<?php
}
?>




    <div>
         <button onclick="location.href='http://localhost/Torrents/index.php'"> HOME </button>
    </div>
        
 
</body>
</html>
