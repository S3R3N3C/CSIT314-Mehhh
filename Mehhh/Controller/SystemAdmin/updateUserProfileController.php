<?php
include_once("../../Entity/UserProfile.php");


class updateUserProfileController
{

    public function updateUserProfile($userprofile_id, $profilename)
    {
        $suc = new UserProfile();
        $results = $suc->updateUserProfile($userprofile_id, $profilename);
        return $results;
    }
}
?>
