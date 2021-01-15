<?php 
ob_start();
    session_start();
require 'config.php';

require 'header.php';

    require_once 'PhpRbac/autoload.php';
    use PhpRbac\Rbac;
    $rbac = new Rbac(); 
    
    // Create a Permission
    $perm_id = $rbac->Permissions->add('admin', 'Administer Site');
    
    // Create a Role
    $role_id = $rbac->Roles->add('admin', 'Administrator');
    // Create Role/Permission Association
    // We don't need to query as we just set the variables above, butfor reuse in the
    // future, we query the IDs from the database
    $perm_id = $rbac->Permissions->returnId('admin');
    $role_id = $rbac->Roles->returnId('admin');
    // The following are equivalent statements
    // $rbac->Permissions->assign($role_id, $perm_id);
    $rbac->Roles->assign($role_id, $perm_id);
    // Assign Role to User (The UserID is provided by the application's User Management System)
    // for my system, my admin ID is 9, you will have to retrieve your ID
    $rbac->Users->assign($role_id, 25);
    
?>

<div id="all_blogs">
    <table width="300" border="0" cellpadding="0" cellspacing="1">
        <tr>
            <td>You have successfully created admin roles</td>
        </tr>
    </table>
</div>
<?php require 'footer.php'; ?>