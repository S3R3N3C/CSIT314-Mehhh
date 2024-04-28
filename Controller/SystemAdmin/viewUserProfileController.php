<?php
include_once("../../Entity/UserProfile.php");

class viewUserProfileController
{

    public function viewUserProfiles():array
    {
        $vuc = new UserProfile();
        $results = $vuc->viewUserProfiles();
        return $results;
    }
}