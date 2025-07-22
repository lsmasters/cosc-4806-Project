<?php

class MovieRating extends Controller {

    public function index(){ 
      $this->view('movieRating/index');
    }

    public function getOurReviews(){ 
      //$this->view('movieRating/?????');
    }

    public function generateReview() { 
        $title = $_POST['movieTitle'] ?? '';
        $score = $_POST['score'] ?? '';

        //echo "Movie Title: " . $title . "<br>";
        //echo "Score: " . $score . "<br>";
        //die

        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=" . $_ENV['gemini'];
        $data = array(
            "contents" => array(
                array
                    ("role" => "user",
                    "parts" => array(
                        array(
                            "text" => "Write a movie review  as a movie critic for the movie " . $title . " with a score of " . $score . " out of 10."
                        )
                    )
                )
            )
        );
        $json_data = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ARRAY('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        if(curl_errno($ch)){
            echo 'Error:' . curl_error($ch);
        }
        
        $obj = json_decode($response, true);
        $_SESSION['review'] = (array) $obj;
        echo "<pre>"; 
        print_r($_SESSION['review']);
        echo "</pre>";
        die;
        
            //$this->view('movieRating/?????');
    }

    public function makeReview(){
      $title = $_REQUEST['movieName'] ?? '';
        
      $this->view('movieRating/makeReview');
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