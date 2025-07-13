<?php

class Movie {

    public function __construct() {      
    }

    public function getMovieInformation($movie){
        $url = "http://www.omdbapi.com/?apikey=" . $_ENV['omdb_key'] . "&t=" . $movie;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        $movie=[array] $obj;
        return $movie;
    }


}
?>

