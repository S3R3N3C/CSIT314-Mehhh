<?php
include_once("../../Controller/SystemAdmin/viewUserProfileController.php");
include_once("../../Controller/SystemAdmin/suspendUserProfileController.php");
include_once("../../Controller/SystemAdmin/searchUserProfileController.php");
include_once("../../Controller/SystemAdmin/deleteUserProfileController.php");

$userProfileController = new viewUserProfileController();
$userProfiles = $userProfileController->getUserProfiles();

//$userAccountCtl = new suspendUserProfile($user_profile);
//$userProfiles = $userAccountCtl->suspendUserProfile($user_profile);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$searchUserProfileController = new searchUserProfileController();

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if (!empty($search)) {
        $userProfiles = $searchUserProfileController->searchUserProfile($search);
    } else {
        // If search field is empty, retrieve all user profiles
        $userProfiles = $userProfileController->getUserProfiles();
    }
} else {
    // If search field is not set, retrieve all user profiles
    $userProfiles = $userProfileController->getUserProfiles();
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>System Admin - Profile Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/ua_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,400;0,800;1,100;1,400&display=swap" rel="stylesheet">
</head>
<div class="white-box">
    <section>
        <div class="container1">
            <div class="logo">
                    <p>RealtyRealm </p>
            </div>
            <div class="topnav">
                <a href="index.php" onclick="logout()">LOG OUT</a>
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
                <div class="search">
                    <form method="POST">
                        <div class="search-bar">
                            <input type="text" class="searchTerm" name="search" placeholder="Search by Profile" style="height:100%; width:60%; margin-top: -5%;">
                            <button type="submit" class="searchButton" style="margin-top: -5%;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
        <div class="topnav" style="margin-top: 1%;">
            <a1 onclick="location.href='addUserProfile.php'" style="margin-left: 5%;">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add Profile
            </a1>
        </div>
    </div>
    <table id="profileTable" class="RRtable" style="width:100%">
        <tr>
            <th>User Profile</th>
            <th>Status</th>
            <th>Action</th>

        </tr>
        <?php foreach ($userProfiles as $userprofile) { ?>
            <tr>
                <td contenteditable="true" id="profileTable" class="RRtable"><?php echo is_array($userprofile) ? $userprofile['profilename'] : $userprofile; ?></td>
                <td contenteditable="true" id="profileTable" class="RRtable"><?php echo is_array($userprofile) ? $userprofile['status'] : $userprofile; ?></td>
                <td>
                    <a href="updateUserProfile.php?userprofile_id=<?php echo $userprofile['userprofile_id']; ?>&profilename=<?php echo $userprofile['profilename']; ?>">Update</a> |
                    <a href="suspendUserProfile.php?userprofile_id=<?php echo $userprofile['userprofile_id']; ?>" onClick="return confirm('Are you sure you want to suspend?')">Suspend</a> |
                    <a href="activateUserProfile.php?userprofile_id=<?php echo $userprofile['userprofile_id']; ?>" onClick="return confirm('Are you sure you want to activate?')">Activate</a>  |
                    <a href="deleteUserProfile.php?userprofile_id=<?php echo $userprofile['userprofile_id']; ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        updateToggleSwitchListeners();

        document.getElementById('search').addEventListener('input', function(e) {
            var searchVal = e.target.value.toLowerCase();
            var table = document.getElementById('profileTable');

            for (var i = 1, row; row = table.rows[i]; i++) {
                var profile = row.cells[0].innerText;

                if (profile.toLowerCase().includes(searchVal)) {
                    row.style.display = "";
                } else {
                    row.style.display = ('none');
                }
            }
        });
    });

    document.getElementById('search').addEventListener('input', function(e) {
        var searchVal = e.target.value.toLowerCase();
        var table = document.getElementById('profileTable');

        for (var i = 1, row; row = table.rows[i]; i++) {
            var profile = row.cells[0].innerText;

            if (profile.toLowerCase().includes(searchVal)) {
                row.style.display = "";
            } else {
                row.style.display = ('none');
            }
        }
    });



    function setRowEditable(row, editable) {
        for (var i = 0; i < row.cells.length; i++) {
            if (i !== row.cells.length - 1) {
                row.cells[i].contentEditable = editable ? "true" : "false";
            }
        }
    }

    function updateProfile() {
        var table = document.getElementById('profileTable');
        for (var i = 1, row; row = table.rows[i]; i++) {
            var profile = row.cells[0].innerText;
            console.log('Profile: ' + profile);
        }

        alert("You have successfully updated!");
    }

    function logout() {
        console.log("Logged out");
        window.location.href = 'index.php';
    }
</script>
</body>

</html>