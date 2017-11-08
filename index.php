<?php

require 'vendor/autoload.php';

$genre = (!empty($_GET['genre']) ? $_GET['genre'] : null);


$client = new \GuzzleHttp\Client();

$res = $client->request('GET', 'https://yts.ag/api/v2/list_movies.json?&genre='.$genre, ["verify" => false]);
$tab = $res->getBody();
$moviesTab = json_decode($tab, true);
$movies = $moviesTab['data']['movies'];
//var_dump($movies);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<body>
    
<?php

foreach ($movies as $movie) {
    $poster = $movie['medium_cover_image'];
    ?>
   <a href="movieDetails.php?id=<?= $movie["id"] ?>">
   <img src="<?= $poster ?>"></a>
<?php
}

    

?>


<form method="get" action="http://localhost/Torrents/index.php">
    <p>
        <select name="genre">
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="Animation">Animation</option>
        <option value="Biography">Biography</option>
        <option value="Comedy">Comedy</option>
        <option value="Crime">Crime</option>
        <option value="Drama">Drama</option>
        <option value="Family">Family</option>
        <option value="Fantasy">Fantasy</option>
        <option value="History">History</option>
        <option value="Horror">Horror</option>
        <option value="Music">Music</option>
        <option value="Musical">Musical</option>
        <option value="Mystery">Mystery</option>
        <option value="Romance">Romance</option>
        <option value="Sport">Sport</option>
        <option value="Thriller">Thriller</option>
        <option value="War">War</option>
        <option value="Western">Western</option>
        <option value="Sci-Fi">Sci-Fi</option>
        </select>
     <input type="submit" value="Go" title="valider pour aller à la page sélectionnée" />
    </p>
</form>

<?php

?>

</body>
</html>
