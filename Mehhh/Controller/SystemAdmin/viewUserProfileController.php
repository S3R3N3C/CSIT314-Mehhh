<?php
include_once("../../Entity/UserProfile.php");

class viewUserProfileController
{

    public function viewUserProfiles()
    {
        $vuc = new UserProfile();
        $results = $vuc->getUserProfiles();
        return $results;
    }
}