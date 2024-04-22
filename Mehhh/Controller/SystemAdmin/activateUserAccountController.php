<?php
include_once("../../Entity/UserAccount.php");

class activateUserAccountController
{

    public function activateUserAccount($user_id)
    {
        $suc = new UserAccount();
        $suc->activateUserAccount($user_id);
    }
}
