<?php
include_once("../../Entity/UserAccount.php");

class deleteUserAccountController
{
    public function deleteUserAccount($user_id)
    {
        $dua = new UserAccount();
        $results = $dua-> deleteUserAccount($user_id);
    }
}