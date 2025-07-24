<?php

class Movie {

    public function __construct() {      
    }

    public function getMovieInformation($movie){
        $url = "http://www.omdbapi.com/?apikey=" . $_ENV['omdb_key'] . "&t=" . $movie;
        $json = file_get_contents($url);
        $obj = json_decode($json);
        $movie=[$obj];
        return $movie;
    }

    public function get_all_movies () {
      $db = db_connect();
      $statement = $db->prepare("select * from movies;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function create($review) {   
        $movieName = $review['movieName'] ?? null;
        $userId = $_SESSION['userID'] ?? null;
        $rating = $review['rating'] ?? null;
        $comment = $review['comment'] ?? null;

        // Optional: Validate fields


      

        // Insert into database
        $db = db_connect();
        $sql = "INSERT INTO movies (userID, rating, comment, movieName)
                VALUES (:userID, :rating, :comment, :movieName)";
        $stmt = $db->prepare($sql);
    
        $stmt->bindParam(':userID', $userId);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':movieName', $movieName);

        return $stmt->execute();
    }




}
?>

