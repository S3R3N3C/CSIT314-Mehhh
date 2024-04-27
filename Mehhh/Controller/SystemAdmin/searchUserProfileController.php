<?php
include_once("../../Entity/UserProfile.php");

class searchUserProfileController
{

    public function searchUserProfile($search): array
    {
        $s = new UserProfile();
        $results = $s->searchProfile($search);
        return $results;
    }
}