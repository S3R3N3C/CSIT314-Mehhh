<?php
include_once("../../Controller/SystemAdmin/activateUserProfileController.php");

if (isset($_GET['userprofile_id'])) {
    $userprofile_id = $_GET['userprofile_id'];

    // Set user profile status to "Active"
    $activateUserProfileController = new activateUserProfileController();
    $activateUserProfileController->activateUserProfile($userprofile_id);

    // Redirect to System admin page
    header("Location: userProfile.php");
    exit();
}
?>