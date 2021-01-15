<?php

    require_once 'PhpRbac/autoload.php';
    use PhpRbac\Rbac;
    $rbac = new Rbac(); 
    $role_id = $rbac->Roles->returnId('admin');
?>
        
        <footer class="w3-container w3-teal w3-center w3-margin-top">
            <p>Find me on social media.</p>
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-snapchat w3-hover-opacity"></i>
            <i class="fa fa-pinterest-p w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
            <?php if($_SESSION['logged']) : ?>
                <p><a href="/exam/logout.php">Logout</a></p>
            <?php else: ?>
                <p><a href="/exam/trylogin.php">Login</a></p>
                <p><a href="/exam/tryregister.php">Register</a></p>
            <?php endif ?>

            <?php if(isset($_SESSION['username']) && $rbac->Users->hasRole($role_id, $_SESSION['userid'])) :?>
                <p><a href="admin.php">Admin</a></p>
            <?php endif ?>
            
            <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
        </footer>
    </body>
</html>