<?php

class User {

    public $username;
    public $password;
    public $auth = false;
    public $checked = false; //for new user
    public $usernameused = false;  //for new user
    public $pwmismatch = false;  //for new user
    public $passwordInvalid = false; //for new user
    
  public function __construct() {      
    }
  
    public function get_all_users() {
      $db = db_connect();
      $sql =
      $stmt = $db->prepare( "SELECT * FROM users;");
      $stmt->execute();
      $rows = $stmt->fetchall(PDO::FETCH_ASSOC);
      return $rows;
    }

   public function create_user($username,$password){
     $db = db_connect();
     $phashed = password_hash($password, PASSWORD_DEFAULT);
     $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
     $stmt = $db -> prepare($sql);
     $stmt -> bindParam(':username', $username);
     $stmt -> bindParam(':password', $phashed);

     return $stmt -> execute();
   }
    
  public function log($username, $success){
    $file = 'logins.log';
    $time = date("Y-m-d H:i:s");
    $entry = $time . " - " . $username . " - " . $success . "\n";
    //create file if it doesn't exist
    file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
  }
  
  
    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function authenticate($username, $password) {
       //check for timeout
       if (isset($_SESSION['timeout']) && time() < $_SESSION['timeout']){
           unset($_SESSION['failedAuth']);
           header('Location: /login');
       }
      /*
         * if username and password good then
         * $this->auth = true;
         */
    		$username = strtolower($username);
    		$db = db_connect();
        $statement = $db->prepare("select * from users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
		
    		if (password_verify($password, $rows['password'])) {
      			$_SESSION['auth'] = 1;
      			$_SESSION['username'] = ucwords($username);
                $_SESSION['userID'] = $rows['id'];
      			unset($_SESSION['failedAuth']);
                //log successful login
                $this->log($username, "SUCCESS");
                if ($username == 'admin'){
                    $_SESSION['admin'] = 1;
                    header('Location: /admin');
                    die;
                } else {
      			header('Location: /home');
      			die;
                }
    		} else {
      			 if(isset($_SESSION['failedAuth'])) {
      				    $_SESSION['failedAuth'] ++; //increment
                  if ($_SESSION['failedAuth'] >= 3){
                      $_SESSION['failedAuth'] = 0;
                      $_SESSION['timeout'] = time() + 120;  //1 minute timeout  
                  }
      			 } else {
        				  $_SESSION['failedAuth'] = 1;
      			 }
            //log unsussessful login
            $this->log($username, "FAILED");
            //redirect to login page
    			  header('Location: /login');
      		  die;
    		}
      }  
  
    public function checknewuser($username, $password, $password2){
        $user = new User();
        $user_list = $user->get_all_users();  //get all db records
       
        //1.   check db for username...if included return to create_user with username flag set
        foreach ($user_list as $item){
            if ($username == $item['username']){
              $_SESSION['usernameUsed'] = 1;
              header ("Location: /create");
              die;
            }
        }
        $_SESSION['usernameUsed'] = 0;  //username is unique...continue
      
        //2.  check password for entry error
        if ($password !== $password2) {  //check for password entry match
            $_SESSION['pwmismatch'] = 1;
            header ("Location: /create");
            exit;
        } else {
            $_SESSION['pwmismatch'] = 0;//password match...so proceed
        }
        // 3. check password validity...if error return to create_user with password flag set
        if (strlen($password) >= 8 &&
            preg_match('/[A-Z]/', $password) &&
            preg_match('/[a-z]/', $password) && 
            preg_match('/[0-9]/', $password) &&
            preg_match('/[!@#$%]/',$password)){
                $user->create_user($username,$password);  //add to 
                $user->log($username, "NEW USER");
                header ("Location: /login");
                $_SESSION['passwordInvalid'] = 0;
                die; 
        } else {   
              header ("Location: /create");
              $_SESSION['passwordInvalid'] = 1;
              exit;
        }

      
    }
}
