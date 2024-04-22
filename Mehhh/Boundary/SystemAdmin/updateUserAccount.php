<?php
// Database connection file
include("../../config.php");

if (isset($_POST['update'])) {
    $id = $_POST['user_id'];
    $user_fullname = $_POST['user_fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_profile = $_POST['user_profile'];

    if (empty($username) || empty($password)) {
        if (empty($username)) {
            echo "<font color='red'>Username field is empty!</font><br/>";
        }
        if (empty($password)) {
            echo "<font color='red'>Password field is empty!</font><br/>";
        }
    } else {
        //updating the table
        require_once('../../Controller/SystemAdmin/updateUserAccountController.php');
        $updateUserAccountController = new updateUserAccountController();
        $result = $updateUserAccountController->updateUserAccount($id, $user_fullname,$username, $password, $user_profile);

        if ($result) {
            //redirecting to the display page. In our case, it is userAccount.php
            header("Location: userAccount.php");
        }
    }
}
?>

<?php
//getting id from url
$id = isset($_GET['user_id']) ? $_GET['user_id'] : die('ERROR: Record ID not found.');
//selecting data associated with this particular id
$username = isset($_GET['username']) ? $_GET['username'] : die('ERROR: Record username not found.');
$password = isset($_GET['password']) ? $_GET['password'] : die('ERROR: Record password not found.');
$user_fullname = isset($_GET['user_fullname']) ? $_GET['user_fullname'] : die('ERROR: Record user_fullname not found.');
$user_profile = isset($_GET['user_profile']) ? $_GET['user_profile'] : die('ERROR: Record user_profile not found.');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>System Admin - Update User Account </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/ua_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,400;0,800;1,100;1,400&display=swap" rel="stylesheet">

</head>

<body class="index-page sidebar-collapse">
    <div class="white-box">
        <section>
            <div class="container1">
                <a href="userAccount.php"><img src="../../img/logo.jpg"  style="width: 200px; height: auto;" ></a> <!--default page-->
                <div class="topnav">
                    <a href="index.php">LOG OUT</a>
                    <a href="userProfile.php">PROFILE</a>
                    <a href="userAccount.php">USER</a>
                </div>
            </div>
        </section>
        <hr>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                    <h2>User Account Details</h2>
                    <hr color="orange">
                    <a href='userAccount.php' class='btn btn-warning btn-round'>Back</a>
                    <br>
                    <div class="col-md-12">


                        <div class="panel panel-success panel-size-custom">
                            <div class="panel-heading">
                                <h3>Update User</h3>
                            </div>
                            <div class="panel-body">
                                <form action="updateUserAccount.php" method="post">
                                    <div class="form group">
                                        <input type="hidden" class="form-control" id="user_id" name="user_id" value=<?php echo $_GET['user_id']; ?>>
                                        <label for="username">Fullname:</label>
                                        <input type="text" class="form-control" id="user_fullname" name="user_fullname" value="<?php echo $user_fullname; ?>">
                                        <br><br>
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                                        <br><br>
                                        <label for="password">Password: </label>
                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
                                        <br><br>
                                        <label for="user_profile">User profile:</label>
                                        <select name="user_profile" id="user_profile">
                                            <option value="System Admin">System Admin</option>
                                            <option value="Real Estate Agent">Real Estate Agent</option>
                                            <option value="Seller">Seller</option>
                                            <option value="Buyer">Buyer</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form group">
                                        <button type="submit" class="btn btn-success btn-round" id="submit" name="update">
                                            <i class="now-ui-icons ui-1_check"></i> Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>