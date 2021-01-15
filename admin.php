<?php
 ob_start();
 session_start();
 require 'config.php';
 require 'header.php';
 require_once 'PhpRbac/autoload.php';
 use PhpRbac\Rbac;
 $rbac = new Rbac(); 
 $role_id = $rbac->Roles->returnId('admin');

?>
    <?php  require 'left.php' ?>

    <!-- Right Column -->
    <div class="w3-twothird">
        <div class="container">
            <h3>Admin</h3>
            <?php if(isset($_SESSION['username'])) :?>
                <?php if($rbac->Users->hasRole($role_id, $_SESSION['userid'])) :?>
                    <p>Welcome admin!</p>
                <?php else :?>
                    <p>You are not a admin</p>
                <?php endif ?>
            <?php else :?>
                <?php header('location:index.php')?>
            <?php endif ?>
        </div>
    </div>
    
  </div>

  <?php  require 'footer.php' ?>
