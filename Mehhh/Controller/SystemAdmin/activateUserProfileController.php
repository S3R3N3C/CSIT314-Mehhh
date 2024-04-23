<?php
include_once("../../Entity/UserProfile.php");

class activateUserProfileController
{

    public function activateUserProfile($userprofile_id)
    {
        $suc = new UserProfile();
        $suc->activateUserProfile($userprofile_id);
    }
}
