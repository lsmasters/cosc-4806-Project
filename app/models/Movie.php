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

  public function create() {
      // Ensure selectedReview is provided and exists in the reviews array
      if (
          !isset($_POST['selectedReview']) ||
          !isset($_POST['reviews'][$_POST['selectedReview']])
      ) {
          throw new Exception("Invalid or missing review selection.");
      }

      // Safe to use now
      $selectedReviewId = $_POST['selectedReview'];
      $review = $_POST['reviews'][$selectedReviewId];

      $movieID = $review['movieID'] ?? null;
      $movieName = $review['movieName'] ?? null;
      $userId = $review['userID'] ?? null;
      $rating = $review['rating'] ?? null;
      $comment = $review['comment'] ?? null;

      // Optional: validate required fields
      if (!$movieID || !$userId || !$rating || !$comment || !$movieName) {
          throw new Exception("Missing required review data.");
      }

      // Insert into database
      $db = db_connect();
      $sql = "INSERT INTO movies (movieID, userID, rating, comment, movieName)
              VALUES (:movieID, :userID, :rating, :comment, :movieName)";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':movieID', $movieID);
      $stmt->bindParam(':userID', $userId);
      $stmt->bindParam(':rating', $rating);
      $stmt->bindParam(':comment', $comment);
      $stmt->bindParam(':movieName', $movieName);

      return $stmt->execute();
  }




}
?>

