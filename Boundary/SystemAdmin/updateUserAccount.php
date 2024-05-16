<?php
// Database connection file
include("../../config.php");

// Function to display success message and redirect
function displaySuccess($message) {
    echo "<script>alert('$message');";
    echo "window.location.href = 'viewUserAccount.php';</script>";
}

// Initialize variables to hold form field values and error messages
$user_id = $user_fullname = $username = $password = $user_profile = "";
$userFullnameError = $usernameError = $passwordError = "";

// Check if the form is submitted
if (isset($_POST['update'])) {
    $user_id= $_POST['user_id'];
    $user_fullname = $_POST['user_fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_status = $_POST['user_status'];
    $user_profile = $_POST['user_profile'];

    //updating the table
    require_once('../../Controller/SystemAdmin/updateUserAccountController.php');
    $updateUserAccountController = new updateUserAccountController();
    $result = $updateUserAccountController->updateUserAccount($user_id, $user_fullname, $username, $password, $user_status, $user_profile);

    if ($result) {
        // Display success message
        displaySuccess("UPDATED SUCCESSFULLY!");
    }
    
} else {
    // If form is not submitted, check if there are URL parameters to pre-fill the form
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die('ERROR: Record ID not found.');
    $username = isset($_GET['username']) ? $_GET['username'] : '';
    $password = isset($_GET['password']) ? $_GET['password'] : '';
    $user_status = isset($_GET['user_status']) ? $_GET['user_status'] : '';
    $user_fullname = isset($_GET['user_fullname']) ? $_GET['user_fullname'] : '';
    $user_profile = isset($_GET['user_profile']) ? $_GET['user_profile'] : '';
}
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

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .white-box {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topnav {
            display: flex;
            align-items: center;
        }

        .topnav a {
            padding: 14px 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .backbutton {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .backbutton:hover {
            background-color: #555;
        }

        .user-input {
            width: 50%;
            margin: 0 auto;
        }

        .input-field {
            width: calc(100% - 40px); /* Shortened width */
            padding: 8px; /* Reduced padding */
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px; /* Reduced font size */
        }

        .submit-btn {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #555;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body class="index-page sidebar-collapse">
    <div class="white-box">
        <section>
            <div class="container1">
                <a href="viewUserProfile.php"><img src="../../img/logo.jpg"  style="width: 200px; height: auto;" ></a> <!--default page-->
                <div class="topnav">
                    <a href="viewUserAccount.php">USER</a>
                    <a href="viewUserProfile.php">PROFILE</a>
                    <a href="../../index.php">LOG OUT</a>
                </div>
            </div>
        </section>
        <hr>
        <!-- End Navbar -->
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                    
                    <h2></h2>
                    <br>
                    <div class="col-md-12">

                        <div class="panel panel-success panel-size-custom">
                            <div class="panel-heading">
                                <h3>Update User</h3>
                            </div>
                            <div class="panel-body">
                                <form action="updateUserAccount.php" method="post" id="updateUserForm" onsubmit="return validateForm();">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
                                        <label for="username">Fullname:</label>
                                        <input type="text" class="form-control" id="user_fullname" name="user_fullname" value="<?php echo $user_fullname; ?>" oninput="hideError('user_fullname')">
                                        <br>
                                        <span id="error_user_fullname" class="error"></span> <!-- Error span for Fullname -->
                                        <br><br>
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" oninput="hideError('username')">
                                        <br>
                                        <span id="error_username" class="error"></span> <!-- Error span for Username -->
                                        <br><br>
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" oninput="hideError('password')">
                                        <br>
                                        <span id="error_password" class="error"></span> <!-- Error span for Password -->
                                        <br><br>
                                        <label for="user_status">Status:</label>
                                        <select name="user_status" id="user_status" class="form-control">
                                            <option value="Active" <?php if ($user_status == 'Active') echo 'selected'; ?>>Active</option>
                                            <option value="Inactive" <?php if ($user_status == 'Inactive') echo 'selected'; ?>>Inactive</option>
                                        </select>
                                        <br><br>
                                        <label for="user_profile">User profile:</label>
                                        <select name="user_profile" id="user_profile" class="form-control">
                                            <option value="1" <?php if ($user_profile == '1') echo 'selected'; ?>>System Admin</option>
                                            <option value="2" <?php if ($user_profile == '2') echo 'selected'; ?>>Real Estate Agent</option>
                                            <option value="3" <?php if ($user_profile == '3') echo 'selected'; ?>>Seller</option>
                                            <option value="4" <?php if ($user_profile == '4') echo 'selected'; ?>>Buyer</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="submit-btn" name="update">Update</button>
                                        <a href="viewUserAccount.php" class="backbutton">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript code to pre-fill form fields and display error messages
        window.onload = function() {
            document.getElementById("user_fullname").value = "<?php echo $user_fullname; ?>";
            document.getElementById("username").value = "<?php echo $username; ?>";
            document.getElementById("password").value = "<?php echo $password; ?>";

            // Display error messages if any
            var fullnameError = "<?php echo $userFullnameError; ?>";
            var usernameError = "<?php echo $usernameError; ?>";
            var passwordError = "<?php echo $passwordError; ?>";

            if (fullnameError !== "") {
                displayError('user_fullname', fullnameError);
            }
            if (usernameError !== "") {
                displayError('username', usernameError);
            }
            if (passwordError !== "") {
                displayError('password', passwordError);
            }
        };

        // Function to display error message
        function displayError(field, message) {
            var errorElement = document.getElementById("error_" + field);
            errorElement.innerHTML = message;
        }

        // Function to hide error message when typing
        function hideError(field) {
            document.getElementById("error_" + field).innerHTML = "";
        }

        // Function to validate form before submission
        function validateForm() {
            var fullname = document.getElementById("user_fullname").value;
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            var isValid = true;

            if (fullname.trim() === "") {
                displayError('user_fullname', 'Please enter Fullname');
                isValid = false;
            }

            if (username.trim() === "") {
                displayError('username', 'Please enter Username');
                isValid = false;
            }

            if (password.trim() === "") {
                displayError('password', 'Please enter Password');
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>

</html>
