<?php
include_once("../../Entity/UserAccount.php");

class searchUserAccountController
{

    public function searchUserAccount($search)
    {
        $s = new UserAccount();
        $results = $s->searchUserAccount($search);
        return $results;
    }
}