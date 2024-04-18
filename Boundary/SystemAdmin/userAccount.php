<?php
include_once("../../Controller/SystemAdmin/viewUserAccountController.php");
include_once("../../Controller/SystemAdmin/addUserAccountController.php");
include_once("../../Controller/SystemAdmin/updateUserAccountController.php");
include_once("../../Controller/SystemAdmin/suspendUserAccountController.php");
include_once("../../Controller/SystemAdmin/searchUserAccountController.php");


$userAccountController = new viewUserAccountController();
$userAccount = $userAccountController->viewUserAccount();

//$userAccountCtl = new suspendUserProfile($user_profile);
//$userProfiles = $userAccountCtl->suspendUserProfile($user_profile);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$searchUserAccountController = new searchUserAccountController();

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $userAccount = $searchCtl->searchAccount($search);
    } else {
        // If search field is empty, retrieve all accounts
        $userAccount = $userAccountController->viewUserAccount();
    }
} else {
    // If search field is not set, retrieve all accounts
    $userAccount = $userAccountController->viewUserAccount();
}

?>



<!DOCTYPE html>
<html>

<head>
    <title>User Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/ua_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,400;0,800;1,100;1,400&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        th,
        td {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #777;
        }

    </style>

</head>

<body>
    <div class="white-box">
        <section>
            <div class="container1">
                <div class="logo">
                    <p>RealtyRealm</p>
                </div>
                <div class="topnav">
                    <a href="index.php">LOG OUT</a>
                    <a href="userProfile.php">PROFILE</a>
                    <a href="userAccount.php">USER</a>
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
                    <table class="table table-condensed table-striped CMtable" id="profileTable" style="font-size: 11.5px; width:100%;">
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
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
                    </table>

                </tr>
            </thead>

        </table>
        <br>
    </div>
</body>

<script>
    var user = document.querySelectorAll(".editable");
    var table = document.getElementById('userTable');

    function logout() {
        console.log("Logged out");
        window.location.href = 'index.php';
    }
</script>


</html>