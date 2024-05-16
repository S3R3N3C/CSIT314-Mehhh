<?php
include_once("../../Entity/userProfile.php");

class viewUserProfileController
{

    public function viewUserProfiles(): array
    {
        $vuc = new userProfile();
        $userProfiles = $vuc->viewUserProfiles();
        return $userProfiles;
    }
}