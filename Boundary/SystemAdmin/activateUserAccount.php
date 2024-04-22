<?php
include_once("../../Controller/SystemAdmin/activateUserAccountController.php");

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Set user status to "Active"
    $userAccountCtl = new activateUserAccountController();
    $userAccountCtl->activateUserAccount($user_id);

    // Redirect to System admin page
    header("Location: userAccount.php");
    exit();
}
?>