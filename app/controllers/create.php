<?php

class Create extends Controller {

    public function index() {		
	    $this->view('create/index');
    }
  
    //check if username is already used and password is valid
    public function check() {
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];
      $password2 = $_REQUEST['password2'];

      $user = $this->model('User');
      $user->checknewuser($username, $password, $password2); 
    }
}
