<?php
include_once("../../Controller/SystemAdmin/deleteUserAccountController.php");

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $deleteUserAccountController = new deleteUserAccountController();
    $deleteUserAccountController->deleteUserAccount($user_id);

    // Redirect to System admin page
    header("Location: viewUserAccount.php?delete_success=true");
    exit();
}
?>
