<?php
    ob_start();
    $userError ="";
    $passError="";
    $loginError="";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST['username']))){
            $userError = "Please enter username!";
        }

        if(empty(trim($_POST['password']))){
            $passError = "Please enter a password!";
        }

        if(empty($userError) && empty($passError)){
            $total_failed_login = 3;
            $lockout_time = 15;
            $account_locked = false;
        
            require 'config.php';
            $select_sql = "SELECT id, password, salt, failed_login, last_login FROM members WHERE username=:username;";
            $statement = $db->prepare($select_sql);
            $statement->bindParam(':username',$_POST['username']);
            $statement->execute();
            $pass = $statement->fetch();
            $returnedpassword=$pass['password'];
            $returnedsalt=$pass['salt'];
            $salted_password=$returnedsalt.$_POST['password'];
            $checkpassword = hash("sha512", $salted_password);
        
            if(($pass['failed_login'] >= $total_failed_login)){
                $last_login = strtotime( $pass[ 'last_login' ] );
                $timeout = $last_login + ($lockout_time * 60);
                $timenow = time();
        
                if( $timenow < $timeout ) {
                    $account_locked = true;
                }
            }
            if($checkpassword==$returnedpassword && $_POST['password'] != '' && $account_locked == false)
            {
                session_start();
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['userid'] = $pass['id'];
                $_SESSION['logged'] = true;
                
                $statement = $db->prepare('UPDATE members SET failed_login = "0" WHERE username = (:username);');
                $statement->bindParam(':username',$_POST['username'] , PDO::PARAM_STR);
                $statement->execute();
                header("location:index.php");
            }
            else
            {
                $statement = $db->prepare('UPDATE members SET failed_login = (failed_login + 1) WHERE username = (:username);');
                $statement->bindParam(':username', $_POST['username']);
                $statement->execute();
        
                $loginError = "Incorrect Login";
            }
            
                $statement = $db->prepare( 'UPDATE members SET last_login = now() WHERE username = (:username);' );
                $statement->bindParam( ':username', $_POST['username'], PDO::PARAM_STR );
                $statement->execute();
                ob_end_flush();
        }
    }
        
    require 'header.php';
    require 'left.php';
    ?>



    <!-- Right Column -->
    <div class="w3-twothird">
        <div class="container">
        <h3>Login</h3>
        <span class="help-block"><?= $loginError ?></span>
            <form class="form" method="post" action="/exam/trylogin.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" id="username" name="username">
                    <span class="help-block"><?= $userError ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="help-block"><?= $passError ?></span>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" id="login" name="login">Login</button>
            </form>
        </div>
    </div>
    
  </div>

  <?php  require 'footer.php' ?>