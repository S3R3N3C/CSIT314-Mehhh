<?php
include_once("../../Entity/UserAccount.php");

class createUserAccountController
{
    public function createUserAccount($user_fullname, $username, $password, $user_profile):bool
    {
        // Validation
        $e1 = $this->validateFullname($user_fullname);
        $e2 = $this->validateUserName($username);
        $e3 = $this->validatePassword($password);
        $e4 = $this->validateUserProfile($user_profile);

        // Check if there are any validation errors
        if (empty($e1) && empty($e2) && empty($e3) && empty($e4)) {
            $aua = new UserAccount();
            $results = $aua->createUserAccount($user_fullname, $username, $password, $user_profile);
            return $results;
        } else {
            // If there are validation errors, return false
            return false;
        }
    }

    private function validateFullname($user_fullname)
    {
        if (empty($user_fullname)) {
            return "Please enter Fullname";
        }
        return "";
    }

    private function validateUserName($username)
    {
        if (empty($username)) {
            return "Please enter Username";
        }
        return "";
    }

    private function validatePassword($password)
    {
        if (empty($password)) {
            return "Please enter Password";
        }
        return "";
    }

    private function validateUserProfile($user_profile)
    {
        if (empty($user_profile)) {
            return "Please select User Profile";
        }
        return "";
    }
}
?>
