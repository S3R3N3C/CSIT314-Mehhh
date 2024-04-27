<?php
include_once("../../Controller/SystemAdmin/suspendUserProfileController.php");

if (isset($_GET['userprofile_id'])) {
    $userprofile_id = $_GET['userprofile_id'];

    // Set user status to "Inactive"
    $suspendUserProfileController = new suspendUserProfileController();
    $suspendUserProfileController->suspendUserProfile($userprofile_id);

    // Redirect to System admin page
    header("Location: viewUserProfile.php?suspend_success=true");
    exit();
}
?>