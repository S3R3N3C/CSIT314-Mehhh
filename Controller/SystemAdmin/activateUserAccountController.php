<?php
include_once("../../Entity/UserAccount.php");

class activateUserAccountController
{

    public function activateUserAccount($user_id):bool
    {
        $userAccount = new UserAccount();
        $result = $userAccount->activateUserAccount($user_id);
        
        if ($result) {
            // Return true if the activation was successful
            return true;
        } else {
            // Return false if the activation failed
            return false;
        }
    }
}
