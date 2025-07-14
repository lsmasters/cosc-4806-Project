<?php

class MovieRating extends Controller {

    public function index(){ 
      /*
      $url = "http://www.omdbapi.com/?apikey=" . $_ENV['omdb_key'] . "&t=Barbie";
      $json = file_get_contents($url);
      $obj = json_decode($json);
      $movie=(array) $obj;
      echo "<pre>";
      print_r($movie);
      die;
    */
      $this->view('movieRating/index');
      die;
    }

    public function router() {
      $action = $_GET['action'];
      $movieName = $_GET['movieName'];

      switch ($action) {
        case 'getMovieInformation':
          $this->getMovieInformation($movieName);
          break;
        case 'getOurRatings':
          $this->getOurRatings($movieName);
          break;
        case 'getYourRating':
          $this->getYourRating($movieName);
          break;
        case 'exit':
          $this->exitApp();
          break;
        default:
          echo "Unknown action.";
      }
    }

    public function getMovieInformation($movieName) {
      echo "Fetching info for: " . htmlspecialchars($movieName);
      die;
      
      $movie = $this->model('Movie');
      $movie->getMovieInformation($movieName);
      echo "<pre>";
      print_r ($movie);
      
    }

    public function getOurRatings($movieName) {
      echo "Showing our ratings for: " . htmlspecialchars($movieName);
    }

    public function getYourRating($movieName) {
      echo "Getting your rating for: " . htmlspecialchars($movieName);
    }

    public function exitApp() {
      echo "Thanks for visiting!";
    }
   
} 
?>