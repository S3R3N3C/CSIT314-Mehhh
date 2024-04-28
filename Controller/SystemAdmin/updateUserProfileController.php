<?php
include_once("../../Entity/UserProfile.php");


class updateUserProfileController
{

    public function updateUserProfile($userprofile_id, $profilename): bool
    {
        $userProfile = new UserProfile();
        $result = $userProfile->updateUserProfile($userprofile_id, $profilename);
        
        if ($result) {
            // Return true if the profile update was successful
            return true;
        } else {
            // Return false if the profile update failed
            return false;
        }
    }
}
?>
