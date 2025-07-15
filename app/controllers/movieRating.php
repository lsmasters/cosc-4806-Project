<?php

class MovieRating extends Controller {

    public function index(){ 
      $this->view('movieRating/index');
    }

    public function getInfo(){
      $title = $_REQUEST['movieName'];
      $url = "http://www.omdbapi.com/?apikey=" . $_ENV['omdb_key'] . "&t=" . $title;
      $json = file_get_contents($url);
      $obj = json_decode($json);
      $movie=(array) $obj;
      echo "<pre>";
      print_r($movie);
      die;
    }
   
} 
?>