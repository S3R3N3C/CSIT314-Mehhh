<?php
include_once("../../Entity/UserAccount.php");

class viewUserAccountController
{
    public function viewUserAccount(): array
    {
        $vua = new UserAccount();
        $results = $vua->viewUserAccount();
        return $results;
    }
}