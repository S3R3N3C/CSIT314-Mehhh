<?php
include_once("../../Entity/UserAccount.php");

class suspendUserAccountController
{

    public function suspendUserAccount($user_id)
    {
        $suc = new UserAccount();
        $results = $suc->suspendUserAccount($user_id);
        return $results;
        
    }
}