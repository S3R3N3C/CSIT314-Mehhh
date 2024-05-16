<?php
include_once("../../Entity/UserAccount.php");

class UserLoginController
{
    public function loginUser($userName, $password, $user_profile): bool
    {
        $validationErrors = $this->validateCredentials($userName, $password, $user_profile);
        
        if (!empty($validationErrors)) {
            return false; // Return false to indicate unsuccessful login
        }
    
        $userAccount = new UserAccount();
        $loginResult = $userAccount->loginUser($userName, $password, $user_profile);
        
        return $loginResult;
    }
    

    private function validateCredentials($userName, $password, $user_profile)
    {
        $validationErrors = [];

        if (empty($userName)) {
            $validationErrors['username'] = "Please fill in Username";
        }

        if (empty($password)) {
            $validationErrors['password'] = "Please fill in Password";
        }

        if (!in_array($user_profile, ['1', '2', '3', '4'])) {
            $validationErrors['user_profile'] = "Please select a valid role";
        }

        return $validationErrors;
    }
}
?>
