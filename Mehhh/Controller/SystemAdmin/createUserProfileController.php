<?php
include_once("../../Entity/UserProfile.php");

class createUserProfileController
{
    public function createUserProfile($user_profile): bool
    {
        $userProfile = new UserProfile();
        $result = $userProfile->createUserProfile($user_profile);
        
        if ($result) {
            // Return true if the profile creation was successful
            return true;
        } else {
            // Return false if the profile creation failed
            return false;
        }
    }
    
}