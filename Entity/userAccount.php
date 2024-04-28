<?php

include_once(__DIR__ . "/../config.php");

session_start();

class UserAccount
{
    private $conn;

    public function __construct()
    {
        $db = new DB;
    }

    // Default page when user login successfully
    public function loginAccount($username, $password, $user_profile): bool
    {
        
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("SELECT user_id, user_profile, username, user_fullname FROM users WHERE username = ? AND password = ? AND user_profile = ?");
        $stmt->bind_param("sss", $username, $password, $user_profile);
        $stmt->execute();
        $stmt->bind_result($user_id, $username, $user_fullname, $user_profile);
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->fetch();
            $user = array(
                "user_id" => $user_id,
                "user_profile" => $user_profile,
                "username" => $username,
                "user_fullname" => $user_fullname,
            );

            $_SESSION['login'] = true;
            $_SESSION['user_profile'] = $user['user_profile'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_fullname'] = $user['user_fullname'];

             //System Admin
            if ($_SESSION['user_profile'] == 1) {
                header('location: ../../Boundary/SystemAdmin/viewUserAccount.php'); // default page: userProfile
            } 

            // Real Estate Agent
            elseif ($_SESSION['user_profile'] == 2) {
                header('location: ../../Boundary/RealEstateAgent/viewPropertyListings.php'); // " ": propertyListing
            } 
            
            // Seller
            elseif ($_SESSION['user_profile'] == 3) {
                header('location: ../../Boundary/Seller/viewUserProfile.php'); // " ":
            } 
            
            // Buyer
            elseif ($_SESSION['user_profile'] == 4) {
                header('location: ../../Boundary/Buyer/viewPropertyListings.php'); // " ":
            }
            return true;
        } 
        
        else {
            return false;
        }
               
    }
    
    // Method 1: View all user accounts
    public function viewUserAccount(): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB); // connection
        $query = "SELECT * FROM users ORDER BY username ASC"; // SQL query statement
        $result = mysqli_query($conn, $query);
        $userAccounts = array();
        if ($result) {
            while ($res = mysqli_fetch_array($result)) {
                $userAccount = array();
                $userAccount['user_id'] = $res['user_id'];
                $userAccount['user_fullname'] = $res['user_fullname'];
                $userAccount['username'] = $res['username'];
                $userAccount['password'] = $res['password'];
                $userAccount['user_status'] = $res['user_status'];
                $userAccount['user_profile'] = $res['user_profile'];
                $userAccounts[] = $userAccount;
            }
        }
        return $userAccounts;
    }

    // 2. Create user account
    public function createUserAccount($user_fullname, $username, $password, $user_profile): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $checkuser = mysqli_query($conn, "SELECT user_id FROM users WHERE username='$username'");
        $result = mysqli_num_rows($checkuser);
        if ($result == 0) {
            $addUser = mysqli_query($conn, "INSERT INTO users (user_fullname, username, password, user_profile) 
                                    VALUES ('$user_fullname','$username','$password','$user_profile')") or die(mysqli_error($conn));
            //header('Location: createUserAccount.php');
            return true;
        } 
        else {
            return false;
        }
    }

    // 3. Update the user account details
    public function updateUserAccount($user_id, $user_fullname, $username, $password, $user_profile): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);

        $userExists = $this->checkUserExists($user_id);

        if ($userExists) {
            $stmt = $conn->prepare("UPDATE users SET user_fullname = ?, username = ?  ,password = ?, user_profile = ? WHERE user_id = ?");
            $stmt->bind_param("ssssi",$user_fullname,  $username, $password, $user_profile, $user_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false; // User ID does not exist
        }
    }

    // 4. Check if user exists
    private function checkUserExists($user_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // 5. Suspend user account
    public function suspendUserAccount($user_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("UPDATE `users` SET `user_status` = 'Inactive' WHERE `user_id` = ?");
        $stmt->bind_param("i", $user_id);
        $result = $stmt->execute();
        $stmt->close();
        
        // Check if the operation was successful
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // 6. Activate user account
    public function activateUserAccount($user_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("UPDATE `users` SET `user_status` = 'Active' WHERE `user_id` = ?");
        $stmt->bind_param("i", $user_id);
        $result = $stmt->execute();
        $stmt->close();
        
        // Check if the operation was successful
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // 7. Search user account
    function searchUserAccount($search): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $search = mysqli_real_escape_string($conn, $search);
        $query = "SELECT * FROM users WHERE username LIKE '%$search%'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        $userAccounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($conn);
        return $userAccounts;
    }

    // 8. Delete user account
    function deleteUserAccount($user_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserDetail($user_id): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);

        $query = "SELECT * FROM users WHERE user_id LIKE '%$user_id%'";
        $result = mysqli_query($conn, $query);
        $userAccounts = array();
        if ($result) {
            while ($res = mysqli_fetch_array($result)) {
                $userAccount = array();
                $userAccount['user_id'] = $res['user_id'];
                $userAccount['user_fullname'] = $res['user_fullname'];
                $userAccounts[] = $userAccount;
            }
        }
        return $userAccounts;
    }


    public function logout()
    {
        $_SESSION['login'] = false;
        session_destroy();
    }
}
