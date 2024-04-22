<?php
include_once("../../Entity/UserAccount.php");

class userLoginController
{
    public function loginAccount($userName, $password)
    {
        $c = new UserAccount();
        $results = $c->loginAccount($userName, $password);
        return $results;
    }
}