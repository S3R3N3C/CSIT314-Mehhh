<?php
include_once("../../Controller/SystemAdmin/viewUserAccountController.php");

$userAccountController = new viewUserAccountController();
$userAccounts = $userAccountController->viewUserAccount();

error_reporting(E_ALL);
ini_set('display_errors', 1);


// logout function
function logout() {
  $_SESSION = array();
  session_destroy();
  // Redirect to the index page
  header("Location: ../../index.php");
  exit;
}


// Function to get profile name based on profile ID
function getProfileName($profileId) {
    $profiles = [
        1 => 'System Admin',
        2 => 'Real Estate Agent',
        3 => 'Seller',
        4 => 'Buyer'
    ];

    // Return the profile name if found, otherwise return 'Unknown'
    return isset($profiles[$profileId]) ? $profiles[$profileId] : 'Unknown';
}


// Function to display success message
function displaySuccess($message) {
    echo "<script>alert('$message');</script>";
}

// Check for success messages and display corresponding alerts
if (isset($_GET['suspend_success'])) {
    displaySuccess('SUSPENDED SUCCESSFULLY!');
}

if (isset($_GET['activate_success'])) {
    displaySuccess('ACTIVATED SUCCESSFULLY!');
}


// Search
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    if (!empty($search)) {
        // If the search field is not empty, perform the search
        include_once("../../Controller/SystemAdmin/searchUserAccountController.php");
        $searchUserAccountController = new SearchUserAccountController();
        $userAccounts = $searchUserAccountController->searchUserAccount($search);
    } else {
        // If the search field is empty, retrieve all user accounts
        $userAccounts = $userAccountController->viewUserAccount();
    }
}

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
                <a href="viewUserAccount.php"><img src="../../img/logo.jpg"  style="width: 200px; height: auto;" ></a>
                <div class="topnav">
                    <a href="../../index.php" onclick="logout()">LOG OUT</a>
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
                <a1 onclick="location.href='createUserAccount.php';" style="margin-left: 5%;">
                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Create User
                </a1>
            </div>
        </div>
        <table id="profileTable" class="RRtable" style="width:100%">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userAccounts as $user) { ?>
                    <tr>
                        <td><?php echo $user['user_fullname']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['password']; ?></td>
                        <td><?php echo getProfileName($user['user_profile']); ?></td> <!-- Display profile name -->
                        <td><?php echo $user['user_status']; ?></td>
                        <td>
                            <a href="updateUserAccount.php?user_id=<?php echo $user['user_id']; ?>&user_fullname=<?php echo $user['user_fullname']; ?>&username=<?php echo $user['username']; ?>&password=<?php echo $user['password']; ?>&user_profile=<?php echo $user['user_profile']; ?>">Update</a> |
                            <a href="suspendUserAccount.php?user_id=<?php echo $user['user_id']; ?>&suspend_success=true" onClick="return confirm('Are you sure you want to suspend?')">Suspend</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        <br>
    </div>

</body>

</html>
