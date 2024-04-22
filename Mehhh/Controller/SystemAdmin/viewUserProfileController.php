<?php
include_once("../../Entity/UserProfile.php");

class viewUserProfileController
{

    public function getUserProfiles()
    {
        $vuc = new UserProfile();
        $results = $vuc->getUserProfiles();
        return $results;
    }
}