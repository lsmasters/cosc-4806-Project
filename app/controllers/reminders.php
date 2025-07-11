<?php

class Reminders extends Controller {

    public function index() {	
      $reminder = $this->model('Reminder');
      $list_of_reminders = $reminder->get_all_reminders();
	  $this->view('reminders/index',['reminders' => $list_of_reminders]); 
    }
   
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reminder = $this->model('Reminder'); 
            $_SESSION['subject'] = $_POST['subject'];
            $reminder->create();
            header('Location: /reminders');
            exit;
        } else {
            $this->view('reminders/create');
        }
    }

    
    public function deleteItem($id) {
      $reminder = $this->model('Reminder');
      $reminder->delete($id);

      header('Location: /reminders');
      exit;
    }  

      
 
}

?>
