<?php

class MovieRating extends Controller {

    public function index(){ 
      $this->view('movieRating/index');
    }

  public function getInfo(){
      $title = $_REQUEST['movieName'] ?? '';

      if (empty($title)) {
          echo "No movie name provided.";
          return;
      }

      $url = "http://www.omdbapi.com/?apikey=" . $_ENV['omdb_key'] . "&t=" . urlencode($title);
      $json = file_get_contents($url);
      $obj = json_decode($json);
      $_SESSION['movie'] = (array) $obj;

      // Send data to view movieRating/information
      $this->view('movieRating/information');
  }

   
} 
?>