<?php
include_once("../../Entity/UserProfile.php");

class suspendUserProfileController
{
 
    public function suspendUserProfile($userprofile_id)
    {
        $suc = new UserProfile();
        $results = $suc->suspendUserProfile($userprofile_id);
        return $results;
    }
}