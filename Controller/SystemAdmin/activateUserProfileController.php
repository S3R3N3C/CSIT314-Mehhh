<?php
include_once("../../Entity/UserProfile.php");

class activateUserProfileController
{

    public function activateUserProfile($userprofile_id): bool
    {
        $userProfile = new UserProfile();
        $result = $userProfile->activateUserProfile($userprofile_id);
        
        if ($result) {
            // Return true if the profile activation was successful
            return true;
        } else {
            // Return false if the profile activation failed
            return false;
        }
    }
    
}
