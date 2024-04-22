<?php
include_once("../../Controller/SystemAdmin/deleteUserProfileController.php");

if (isset($_GET['userprofile_id'])) {
    $userprofile_id = $_GET['userprofile_id'];

    $deleteUserProfileController = new deleteUserProfileController();
    $deleteUserProfileController->deleteUserProfile($userprofile_id);

    // Redirect to System admin page
    header("Location: ./userProfile.php");
    exit();
}
?>
