<?php
include_once("../../Entity/userProfile.php");

class deleteUserProfileController
{
    public function deleteUserProfile($userprofile_id): bool
    {
        $userProfile = new UserProfile();
        $result = $userProfile->deleteUserProfile($userprofile_id);
        
        if ($result) {
            // Return true if the profile deletion was successful
            return true;
        } else {
            // Return false if the profile deletion failed
            return false;
        }
    }
    
}