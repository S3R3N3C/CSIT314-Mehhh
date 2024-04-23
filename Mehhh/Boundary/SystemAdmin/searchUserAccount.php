<?php
include_once("../../Controller/SystemAdmin/searchUserAccountController.php");

$searchUserAccountController = new SearchUserAccountController();

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $userAccount = $searchUserAccountController->searchUserAccount($search);
    } else {
        // If search field is empty, retrieve all accounts
        $userAccount = $userAccountController->getUserAccount();
    }
} else {
    // If search field is not set, retrieve all accounts
    $userAccount = $userAccountController->getUserAccount();
}
?>

