<?php

include_once("../../config.php");
session_start();

class UserProfile
{
    private $conn;

    public function __construct()
    {
        $this->conn = new DB;
    }

    // Method 1: Get all user profiles
    public function getUserProfiles():array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $query = "SELECT userprofile_id, profilename, status FROM profiles ORDER BY profilename ASC";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die('Error executing query: ' . mysqli_error($conn));
        }
        $userProfiles = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $userProfiles[] = $row;
        }
        mysqli_close($conn);
        return $userProfiles;
    }

    // 2: Add user profile
    public function addUserProfile($profilename):bool
    {
        if (!isset($profilename)) {
            return false;
        }
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $checkuser = mysqli_query($conn, "SELECT userprofile_id FROM profiles WHERE profilename='$profilename'") or die(mysqli_error($conn));
        if ($checkuser) {
            $result = mysqli_num_rows($checkuser);
            if ($result == 0) {
                $addUserProfile = mysqli_query($conn, "INSERT INTO profiles (profilename) VALUES ('$profilename')") or die(mysqli_error($conn));
                header('Location: userProfile.php');
                return true;
            } else {
                return false;
            }
        } else {
            die(mysqli_error($conn));
        }
    }

    // 4. Activate user profile    
    public function activateUserProfile($userprofile_id): void
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $sql = "UPDATE profiles SET status = 'Active' WHERE userprofile_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userprofile_id);
        $stmt->execute();
        $stmt->close();
    }

    // 4. Suspend user profile
    public function suspendUserProfile($userprofile_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $sql = "UPDATE profiles SET status = 'Inactive' WHERE userprofile_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userprofile_id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    // 5. Update user profile
    public function updateUserProfile($userprofile_id, $profilename) :bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("UPDATE profiles SET profilename = ? WHERE userprofile_id = ?");
        $stmt->bind_param("si", $profilename, $userprofile_id);        
        $stmt->execute(); 
        return $stmt->affected_rows;
    }

    // 6. Search user profile
    public function searchProfile($search): array
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $search = mysqli_real_escape_string($conn, $search);
        $query = "SELECT * FROM profiles WHERE profilename LIKE '%$search%'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        $userProfiles = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($conn);
        return $userProfiles;
    }

    // 7. Delete user profile
    function deleteUserProfile($userprofile_id): bool
    {
        $conn = mysqli_connect(HOST, USER, PASS, DB);
        $stmt = $conn->prepare("DELETE FROM profiles WHERE userprofile_id = ?");
        $stmt->bind_param("i", $userprofile_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

}
