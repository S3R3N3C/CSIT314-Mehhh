<?php
include_once("../../Controller/SystemAdmin/createUserProfileController.php");

$e1 = "";

if (isset($_POST["createUserProfile"])) {
    $createUserProfileController = new createUserProfileController();
    $result = $createUserProfileController->createUserProfile($_POST["user_profile"]);

    if ($result === true) {
        displaySuccess(); // Call the displaySuccess() if creation was successful
    } else {
        // If there are errors
		$error_message = "Failed to create user profile. Please try again.";
        displayError($error_message);
    }
}

function displayError($error_message)
{
    // Display error message
    echo "<div class='error'>" . $error_message . "</div>";
}

function displaySuccess()
{
    // Display an alert box after successfully creating a user profile
    echo "<script>alert('CREATED SUCCESSFULLY!');</script>";
    // Redirect to viewUserProfile.php
    echo "<script>window.location.href = 'viewUserProfile.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>System Admin - Create User Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/ua_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,400;0,800;1,100;1,400&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
<body>
    <div class="white-box">
        <section>
            <div class="container1">
                <a href="viewUserProfile.php"><img src="../../img/logo.jpg" style="width: 200px; height: auto;"></a> <!--default page-->
                <div class="topnav">
                    <a href="viewUserProfile.php">USER</a>
                    <a href="viewUserProfile.php">PROFILE</a>
                    <a href="../../index.php">LOG OUT</a>
                </div>
            </div>
        </section>
        <hr>
        <div class="form-box">
            <h2>Create User Profile</h2>
            <?php if (!empty($e1)) echo "<div class='error'>" . $e1 . "</div>"; ?>
            <form method="post" id="addUserProfile" name="addUserProfile" class="user-input" onsubmit="return validateForm();">
                <input type="text" name="user_profile" id="user_profile" class="input-field" placeholder="User Profile">
                <span id="error_user_profile"></span> <!-- Display error msg -->
                <br><br>
                <input type="submit" name="createUserProfile" class="submit-btn" value="Create">
				<a href="viewUserProfile.php" class="backbutton">Cancel</a>
            </form>
        </div>
    </div>
</body>

<script>
    function validateForm() {
        var userProfile = document.getElementById("user_profile").value;

        var isValid = true;

        if (userProfile === "") {
            displayError('user_profile', 'Please enter User Profile');
            isValid = false;
        }

        return isValid;
    }

    function displayError(field, message) {
        var errorElement = document.getElementById("error_" + field);
        errorElement.innerHTML = message;
    }

    // Hide error messages when the user starts typing
    document.getElementById("user_profile").addEventListener("input", function() {
        document.getElementById("error_user_profile").innerHTML = "";
    });
</script>

</html>
