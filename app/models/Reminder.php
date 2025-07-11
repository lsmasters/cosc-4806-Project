<?php

class Reminder {

    public function __construct() {      
    }

    public function get_all_reminders () {
      $db = db_connect();
      $statement = $db->prepare("select * from reminders;");
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function create () {
      $_SESSION['subject'] = $_POST['subject'];
      $db = db_connect();
      $sql = "INSERT INTO reminders (user_id,subject) VALUES (:userid, :subject)";
      $stmt = $db -> prepare($sql);
      $stmt -> bindParam(':userid', $_SESSION['userID']);
      $stmt -> bindParam(':subject', $_SESSION['subject']);
      return $stmt -> execute();
    }
    
  
    public function update () {
       $uid = $_SESSION['userID']; 
       $subject = $_SESSION['subject'];
       $id = $_SESSION['id'];

       $db = db_connect();
       $sql = "UPDATE reminders SET user_id = :userid, subject = :subject WHERE id = :id";     
        $stmt = $db -> prepare($sql);
        $stmt -> bindParam(':userid', $uid);
        $stmt -> bindParam(':subject', $subject);
        $stmt -> bindParam(':id', $id);
        return $stmt -> execute();
    }

    public function delete($id){
      $db = db_connect();
      $sql = "DELETE FROM reminders WHERE id = :id";
      $stmt = $db -> prepare($sql);
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      return $stmt -> execute();
    }
  
}

    