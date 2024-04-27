<?php
include_once("../../Controller/SystemAdmin/createUserAccountController.php");

$username = "";
$password = "";
$error_message = "";

if (isset($_POST["createUser"])) {
    $cac = new createUserAccountController();
    $result = $cac->createUserAccount($_POST["user_fullname"], $_POST["username"], $_POST["password"], $_POST["user_profile"]);
    if ($result === true) {
        displaySuccess();
    } else {
        $error_message = "Failed to create user account. Please try again.";
        displayError($$error_message);
    }
}

function displayError($errors)
{
    foreach ($errors as $error) {
        // Splitting the error message into error type and error message
        list($field, $message) = explode(':', $error);

        // Finding the corresponding error field and displaying the error message
        echo "<script>displayError('$field', '$message');</script>";
    }
}

function displaySuccess()
{
    // Click ok redirect to viewUserAccount.php
    echo "<script>alert('CREATED SUCCESSFULLY!'); window.location.href = 'viewUserAccount.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>System Admin - Create User Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/ua_style.css">
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
<body>
    <div class="white-box">
        <section>
            <div class="container1">
                <a href="viewUserAccount.php"><img src="../../img/logo.jpg" style="width: 200px; height: auto;"></a> <!--default page-->
                <div class="topnav">
                    <a href="viewUserAccount.php">USER</a>
                    <a href="viewUserProfile.php">PROFILE</a>
                    <a href="../../index.php">LOG OUT</a>
                </div>
            </div>
        </section>
        <hr>
        <h2>Create User</h2>
        
        <?php if (!empty($error_message)) echo "<div class='error'>" . $error_message . "</div>"; ?>
        <form method="post" class="user-input" onsubmit="return validateForm();">
            <label for="user_profile">User Profile:</label>
            <select name="user_profile" id="user_profile" class="input-field">
                <option value="1">System Admin</option>
                <option value="2">Real Estate Agent</option>
                <option value="3">Seller</option>
                <option value="4">Buyer</option>
            </select>
            <br><br>
            <input type="text" name="user_fullname" id="user_fullname" class="input-field" placeholder="Full Name">
            <span id="error_user_fullname" class="error"></span> <!-- Display error for Fullname -->
            <br><br>
            <input type="text" name="username" id="username" class="input-field" placeholder="Username">
            <span id="error_username" class="error"></span> <!-- Display error for Username -->
            <br><br>
            <input type="text" name="password" id="password" class="input-field" placeholder="Password">
            <span id="error_password" class="error"></span> <!-- Display error for Password -->
            <br><br>
            <input type="submit" name="createUser" class="submit-btn" value="Create">
            <a href="viewUserAccount.php" class="backbutton">Cancel</a>
        </form>
    </div>
</body>
</html>

<script>
    function validateForm() {
        var fullname = document.getElementById("user_fullname").value;
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        var isValid = true;

        if (fullname === "") {
            displayError('user_fullname', 'Please enter Fullname');
            isValid = false;
        }

        if (username === "") {
            displayError('username', 'Please enter Username');
            isValid = false;
        }

        if (password === "") {
            displayError('password', 'Please enter Password');
            isValid = false;
        }

        return isValid;
    }

    function displayError(field, message) {
        var errorElement = document.getElementById("error_" + field);
        errorElement.innerHTML = message;
    }

    // Hide error messages when the user starts typing
    document.getElementById("user_fullname").addEventListener("input", function() {
        document.getElementById("error_user_fullname").innerHTML = "";
    });

    document.getElementById("username").addEventListener("input", function() {
        document.getElementById("error_username").innerHTML = "";
    });

    document.getElementById("password").addEventListener("input", function() {
        document.getElementById("error_password").innerHTML = "";
    });
</script>
