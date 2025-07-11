<?php
require_once 'app/views/templates/headerPublic.php';
//notice for unique usernames
if (isset($_SESSION['usernameUsed']) &&
$_SESSION['usernameUsed']){
  echo '<p style="color:red">USERNAME ALREADY EXISTS! <br>  PLEASE TRY AGAIN!  </p>';
}

//notice for password entry mismatch
if(isset($_SESSION['pwmismatch']) && $_SESSION['pwmismatch'] == 1){
      echo '<p style="color:red">PASSWORD MISMATCH! <br> PLEASE TRY AGAIN!  </p>'; 
}
if(isset($_SESSION['passwordInvalid']) &&
     $_SESSION['passwordInvalid']){
    echo '<p style="color:red">PASSWORD DOES NOT MEET REQUIREMENTS!  <br> PLEASE TRY AGAIN!  </p>';
}
  
?>
 

<main role="main" class="container">
<h1>Create User</h1>
<br>

<div class="row">
    <div class="col-sm-auto">
    <form action="/create/check" method="post" >
    <fieldset>
      <br>
      <div class="form-group">
        <label for="username">Username</label>
        <input required type="text" class="form-control" name="username" autofocus>
      </div>
      <br>
      <div class="form-group">
        <label for="password">Password      </label>
        <input required type="password" class="form-control" name="password">
      </div>
      <br>
      <div class="form-group">
        <label for="password">Password Again</label>
        <input required type="password" class="form-control" name="password2">
      </div>
            <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </fieldset>
    </form> 
    <h2>  Username Requiremnts</h2>
    <p>    Usernames must be UNIQUE.</p>    
    <h2>  Password Requiremnts</h2>
    <p>    1. Minimum lenght:  8 characters</p>  
    <p>    2. Contains uppercase letter(s)</p>
    <p>    3. Contains lowercase letter(s)</p>
    <p>    4. Contains number(s)</p>
    <p>    5. Contains special character(s)(!@#$%)</p>  
  </div>
</div>
    <?php require_once 'app/views/templates/footer.php' ?>
