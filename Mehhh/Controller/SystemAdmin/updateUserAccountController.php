<?php
include_once("../../Entity/UserAccount.php");

class updateUserAccountController
{

    public function updateUserAccount($user_id, $user_fullname, $username, $password, $user_profile)
    {
        $suc = new UserAccount();
        $results = $suc->updateUserAccount($user_id, $user_fullname, $username, $password, $user_profile);
        return $results;
    }
}
