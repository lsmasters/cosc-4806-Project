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

    public function create () {
      $_SESSION['subject'] = $_POST['subject'];
      $db = db_connect();
      $sql = "INSERT INTO movies (movieID,userID,rating,comment) VALUES (:userid, :subject)";  //chanbge the VALUES
      $stmt = $db -> prepare($sql);
      $stmt -> bindParam(':userid', $_SESSION['userID']);
      $stmt -> bindParam(':subject', $_SESSION['subject']);
      return $stmt -> execute();
    }



}
?>

