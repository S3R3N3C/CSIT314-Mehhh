<?php
include_once("../../Controller/SystemAdmin/searchUserProfileController.php");

$searchUserProfileController = new SearchUserProfileController();

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $userProfiles = $searchUserProfileController->searchUserProfile($search);
    } else {
        // If search field is empty, retrieve all user profiles
        $userProfiles = $userProfileController->getUserProfiles();
    }
} else {
    // If search field is not set, retrieve all user profiles
    $userProfiles = $userProfileController->getUserProfiles();
    
}

    // Redirect to System admin page
    header("Location: ./viewUserAccount.php");
    exit();
?>
