<?php
include_once("../../Controller/SystemAdmin/suspendUserAccountController.php");

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Set user status to "Inactive"
    $suspendUserAccountController = new suspendUserAccountController();
    $suspendUserAccountController->suspendUserAccount($user_id);

    // Redirect to System admin page
    header("Location: viewUserAccount.php?suspend_success=true");
    exit();
}
?>