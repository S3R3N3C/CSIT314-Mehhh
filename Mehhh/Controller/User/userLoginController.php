<?php
include_once("../../Entity/UserAccount.php");

class UserLoginController
{
    public function loginUser($userName, $password)
    {
        $validationErrors = $this->validateCredentials($userName, $password);
        
        if (!empty($validationErrors)) {
            return $validationErrors; // Return validation errors if any
        }

        $userAccount = new UserAccount();
        $loginResult = $userAccount->loginAccount($userName, $password);
        
        return $loginResult;
    }

    private function validateCredentials($userName, $password)
    {
        $validationErrors = [];

        if (empty($userName)) {
            $validationErrors['username'] = "Please fill in Username";
        }

        if (empty($password)) {
            $validationErrors['password'] = "Please fill in Password";
        }

        return $validationErrors;
    }
}
?>
