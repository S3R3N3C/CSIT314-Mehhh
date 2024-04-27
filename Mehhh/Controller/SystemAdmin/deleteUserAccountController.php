<?php
include_once("../../Entity/UserAccount.php");

class deleteUserAccountController
{
    public function deleteUserAccount($user_id): bool
    {
        $dua = new UserAccount();
        $result = $dua->deleteUserAccount($user_id);
        
        // Return true if the deletion was successful, false otherwise
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}