<?php
include_once("../../Controller/SystemAdmin/activateUserAccountController.php");

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Set user status to "Active"
    $activateUserAccountController = new activateUserAccountController();
    $activateUserAccountController->activateUserAccount($user_id);

    // Redirect to System admin page with success message
    header("Location: viewUserAccount.php?activate_success=true");
    exit();
}
?>