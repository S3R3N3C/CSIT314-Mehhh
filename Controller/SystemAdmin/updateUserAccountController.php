<?php
include_once("../../Entity/UserAccount.php");

class updateUserAccountController
{
    public function updateUserAccount($user_id, $user_fullname, $username, $password, $user_status, $user_profile): bool
    {
        $userAccount = new UserAccount();
        $result = $userAccount->updateUserAccount($user_id, $user_fullname, $username, $password, $user_status, $user_profile);
        
        if ($result) {
            // Return true if the update was successful
            return true;
        } else {
            // Return false if the update failed
            return false;
        }
    }
}
