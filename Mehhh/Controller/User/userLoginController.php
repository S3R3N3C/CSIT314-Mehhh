<?php
include_once("../../Entity/UserAccount.php");

class UserLoginController
{
    public function loginUser($userName, $password): bool
    {
        $validationErrors = $this->validateCredentials($userName, $password);
        
        if (!empty($validationErrors)) {
            return false; // Return false to indicate unsuccessful login
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
