<?php
include_once("../../Entity/userAccount.php");

class viewUserAccountController
{
    public function viewUserAccount(): array
    {
        $vua = new userAccount();
        $userAccounts = $vua->viewUserAccount();
        return $userAccounts;
    }
}