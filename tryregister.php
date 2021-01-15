<?php

  ob_start(); // session management
  require 'config.php';

  $userError ="";
  $passError="";
  $pass2Error="";
  $emailError="";
  $loginError="";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST['username']))){
      $userError = "Please enter username!";
    }

    if(empty(trim($_POST['password']))){
      $passError = "Please enter a password!";
    }

    if(empty(trim($_POST['password2']))){
      $pass2Error = "Please enter a password!";
    }
    
    if(empty(trim($_POST['email']))){
      $emailError = "Please enter a email!";
    }

    if(empty($userError) && empty($passError) && empty($pass2Error) && empty($emailError)){
      $myusername=$_POST['username'];
      $mypassword=$_POST['password'];
      $mypassword2=$_POST['password2'];
      $myemail=$_POST['email'];
    
      $username_check = 'SELECT id FROM members WHERE username=:username';
      $email_check = 'SELECT id FROM members WHERE email=:email';
    
      $username_good = false;
      $email_good = false;
      $password_good = false;
      
      $statement = $db->prepare($username_check);
      $statement->bindParam(':username',$myusername);
      $statement->execute();
    
      if($statement->rowCount() > 0){
        $userError = "Username taken.";
      } else {
        $username_good = true;
      }
    
      $statement = $db->prepare($email_check);
      $statement->bindParam(':email',$myemail);
      $statement->execute();
    
    
      if($statement->rowCount() > 0){
        $emailError = "Email taken.";
      } else {
        $email_good = true;
      }
    
      if($mypassword == $mypassword2){
        $password_good = true;
      } else {
        $passError = "Passwords do not match";
      }
    
      if($username_good && $email_good && $password_good){
        // salting adds uniqueness to each entry
        $salt=uniqid() ;
        $salted_password=$salt.$mypassword;
        $encrypted_password = hash("sha512", $salted_password);
      
        $insert_sql="insert into members (username,password,salt,email) values (:myusername,:encrypted_password,:salt, :email)";
        $statement = $db->prepare($insert_sql);
        $statement->bindParam(':myusername',$myusername);
        $statement->bindParam(':encrypted_password',$encrypted_password);
        $statement->bindParam(':salt',$salt);
        $statement->bindParam(':email',$myemail);
        $statement->execute() or die(print_r($statement->errorInfo(), true));
        $pass = $statement->fetch();
    
        header('location:index.php');
      }
      ob_end_flush();
    }
  }
  require 'header.php';
  require 'left.php';
?>


    <!-- Right Column -->
    <div class="w3-twothird">
      <div class="container">
      <h3>Register</h3>
      <span class="help-block"><?= $loginError ?></span>
        <form class="form" method="post" action="/exam/tryregister.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" id="username" name="username">
                <span class="help-block"><?= $userError ?></span>
            </div>
            <div class="form-group">
                <label for="username">Email</label>
                <input class="form-control" id="email" name="email" type="email">
                <span class="help-block"><?= $emailError ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="help-block"><?= $passError ?></span>
            </div>
            <div class="form-group">
                <label for="password2">Confirm Password</label>
                <input type="password" class="form-control" id="password2" name="password2">
                <span class="help-block"><?= $pass2Error ?></span>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
  <?php  require 'footer.php' ?>