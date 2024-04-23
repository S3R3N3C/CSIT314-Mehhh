<?php
include_once("../../Entity/UserAccount.php");

class searchUserAccountController
{
    public function searchUserAccount($search)
    {
        // Retrieve the search query from the URL parameters
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

        // Perform the search using the UserAccount entity
        $userAccount = new UserAccount();
        $results = $userAccount->searchUserAccount($searchQuery);

        // Return the search results
        return $results;
    }
}
?>