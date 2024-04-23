<?php
include_once("../../Entity/UserProfile.php");

class addUserProfileController
{
    public function addUserProfile($user_profile)
    {
        $aua = new UserProfile();
        $results = $aua-> addUserProfile($user_profile);
        return $results;
    }
}