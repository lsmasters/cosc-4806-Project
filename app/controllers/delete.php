<?php

class Delete extends Controller {

    public function index($id) {		
      $reminder = $this->model('Reminder');
      $this->view('reminders/index'); 
      $reminder->delete($id);
      $this->view('reminders'); 
      die;  
    }

  
}
