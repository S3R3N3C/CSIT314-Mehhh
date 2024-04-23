<?php
include_once("../../Controller/SystemAdmin/viewUserAccountController.php");

$userAccountController = new viewUserAccountController();
$userAccount = $userAccountController->viewUserAccount();


error_reporting(E_ALL);
ini_set('display_errors', 1);



include_once("../../Controller/SystemAdmin/searchUserAccountController.php");

$searchUserAccountController = new SearchUserAccountController();

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $userAccount = $searchUserAccountController->searchUserAccount($search);
    } else {
        // If search field is empty, retrieve all accounts
        $userAccount = $userAccountController->viewUserAccount();
    }
} else {
    // If search field is not set, retrieve all accounts
    $userAccount = $userAccountController->viewUserAccount();
}

include_once("../../Controller/SystemAdmin/addUserAccountController.php");
include_once("../../Controller/SystemAdmin/updateUserAccountController.php");
include_once("../../Controller/SystemAdmin/suspendUserAccountController.php");
?>



<!DOCTYPE html>
<html>

<head>
    <title>System Admin - Account Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/ua_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,400;0,800;1,100;1,400&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: #1e1d1d; /* Change text color */
        }
    </style>
    
</head>

<body>
    <div class="white-box">
        <section>
            <div class="navbar">
                <!-- <a href="index.php" class="navbar-brand">RealtyRealm</a> -->
                <a href="viewUserAccount.php"><img src="../../img/logo.jpg"  style="width: 200px; height: auto;" ></a> <!--default page-->
                <div class="topnav">
                    <a href="../../index.php">LOG OUT</a>
                    <a href="viewUserProfile.php">PROFILE</a>
                    <a href="viewUserAccount.php">USER</a>
                </div>
            </div>
        </section>
        <hr>
        <br>
        <br>
        <div class="container1" style="margin-top: -3%; margin-bottom: 3%; ">
            <div class="search">
                <form method="POST">
                    <div class="search-bar">
                        <input type="text" class="searchTerm" name="search" placeholder="Search by Username" style="height:100%; width:60%; margin-top: -5%;">
                        <button type="submit" class="searchButton" style="margin-top: -5%;">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="topnav" style="margin-top: 1%;">
                <a1 onclick="location.href='addUserAccount.php';" style="margin-left: 5%;">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add User
                </a1>

            </div>
        </div>
        <table id="userTable">
            <thead>
                <tr>
                    <table class="RRtable" id="profileTable" style="width:100%">
                        <tr>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>Profile</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        foreach ($userAccount as $userAccount) {
                            echo "<tr>";
                            echo "<td>" . $userAccount['user_fullname'] . "</td>";
                            echo "<td>" . $userAccount['username'] . "</td>";
                            echo "<td>" . $userAccount['password'] . "</td>";
                            echo "<td>" . $userAccount['user_profile'] . "</td>";
                            echo "<td>" . $userAccount['user_status'] . "</td>";
                            echo "<td><a href=\"updateUserAccount.php?user_id={$userAccount['user_id']}&user_fullname={$userAccount['user_fullname']}&username={$userAccount['username']}&password={$userAccount['password']}&user_profile={$userAccount['user_profile']}\">Update</a> |
                                <a href=\"suspendUserAccount.php?user_id={$userAccount['user_id']}\" onClick=\"return confirm('Are you sure you want to suspend?')\">Suspend</a> | 
                                <a href=\"activateUserAccount.php?user_id={$userAccount['user_id']}\" onClick=\"return confirm('Are you sure you want to activate?')\">Activate</a> |
                                <a href=\"deleteUserAccount.php?user_id={$userAccount['user_id']}\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                            echo "</tr>";
                        }
                        ?>
                                
                        <tfoot>
                            <tr>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Password</th>
                                <th>Profile</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

                </tr>

            </thead>
        </table>
        <br>
    </div>
</body>


</html>