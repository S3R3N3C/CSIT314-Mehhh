<?php
include_once("../../Entity/UserAccount.php");

class searchUserAccountController
{
    public function searchUserAccount($search): array
    {
        $s = new UserAccount();
        $userAccounts = $s->searchUserAccount($search);
        return $userAccounts;
    }
}
?>