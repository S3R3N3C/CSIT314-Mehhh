<?php
include_once("../../Entity/UserAccount.php");

class viewUserAccountController
{
    public function viewUserAccount()
    {
        $gua = new UserAccount();
        $results = $gua->getUserAccount();
        return $results;
    }
}