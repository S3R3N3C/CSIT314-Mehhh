<?php
include_once("../../Entity/userProfile.php");

class deleteUserProfileController
{
    public function deleteUserProfile($userprofile_id)
    {
        $dup = new userProfile();
        $results = $dup-> deleteUserProfile($userprofile_id);
    }
}