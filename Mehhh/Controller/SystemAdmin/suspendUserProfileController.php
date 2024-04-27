<?php
include_once("../../Entity/UserProfile.php");

class suspendUserProfileController
{
 
    public function suspendUserProfile($userprofile_id): bool
    {
        $userProfile = new UserProfile();
        $result = $userProfile->suspendUserProfile($userprofile_id);
        
        if ($result) {
            // Return true if the profile suspension was successful
            return true;
        } else {
            // Return false if the profile suspension failed
            return false;
        }
    }
    
}