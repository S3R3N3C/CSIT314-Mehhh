<?php
include_once("../../Entity/UserAccount.php");

class suspendUserAccountController
{
    public function suspendUserAccount($user_id): bool
    {
        $userAccount = new UserAccount();
        $result = $userAccount->suspendUserAccount($user_id);
        
        if ($result) {
            // Return true if the suspension was successful
            return true;
        } else {
            // Return false if the suspension failed
            return false;
        }
    }
}
