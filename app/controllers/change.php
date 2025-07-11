<?php

class Change extends Controller {

    public function index() {
      $_SESSION['id'] = $_POST['id'];
      $this->view('/changeItem/index');
      die;
    }
  
    public function update() {
        $_SESSION['subject'] = $_REQUEST['subject'];
        
        $reminder = $this->model('Reminder');
        $reminder->update();

        this->view('/reminders/index');
        //header('Location: /reminders');
        echo 'Reminder updated successfully!';
        die;  
    }  
}
