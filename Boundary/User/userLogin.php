<?php
include_once("../../Controller/User/userLoginController.php");

$username = "";
$password = "";
$user_profile = "";
$e1 = "";

if (isset($_POST["login"])) {
    $userLoginController = new UserLoginController();
    $loginResult = $userLoginController->loginUser($_POST["username"], $_POST["password"], $_POST["user_profile"]);

    if (is_array($loginResult)) {
        // If there are validation errors
        $e1 = implode(", ", $loginResult);
    } else {
        // If login was successful or failed
        if ($loginResult == true) {
            switch ($_POST["user_profile"]) {
                case '1':
                    header('location: ../../Boundary/SystemAdmin/viewUserAccount.php');
                    break;
                case '2':
                    header('location: ../../Boundary/RealEstateAgent/viewPropertyListings.php');
                    break;
                case '3':
                    header('location: ../../Boundary/Seller/viewSellerPL.php');
                    break;
                case '4':
                    header('location: ../../Boundary/Buyer/viewPropertyListings.php');
                    break;
                default:
                    // Handle unexpected user profiles
                    break;
            }
            exit; // Ensure script execution stops after redirect
        } else {
            $e1 = "Login Failed. Please try again.";
        }
    }

}
?>


<style>
    *
    {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }
    
    
    .form-box
    {
        width: 380px;
        height: 480px;
        position: relative;
        margin: 3% auto;
        background: #fff;
        padding: 5px;
        overflow: hidden;
    }
    
    .login-title
    {
        margin: 35px auto;
        text-align: center;
        font-size: 24px;
        color: #333;
    }
    
    .user-input
    {
        top: 170px;
        position: absolute;
        width: 280px;
        transition: .5s;
        left: 50px;
    }
    
    .input-field
    {
        width: 100%;
        padding: 15px 0 5px;
        margin: 5px 0;
        border-left: 0;
        border-top: 0;
        border-right: 0;
        border-bottom: 1px solid #777;
        outline: none;
        background: transparent;
    }
    
    .submit-btn
    {
        width: 85%;
        padding: 10px 30px;
        cursor: pointer;
        display: block;
        margin: auto;
        background: linear-gradient(to right, #008080, #DCAE96);
        border: 0;
        outline: none;
        border-radius: 30px;
    }
    
    span.error
    {
        color: red;
        font-size: 14px;
    }
    
</style>

<html>

<body>
    <div>
        <a href="../../index.php"><img src="../../img/logo.jpg" style="width: 200px; height: auto;"></a>
        <div class="form-box">
            <h2 class="login-title">Login</h2>
            <form class="user-input" method="POST" onsubmit="return validateForm()">
                <label for="user_profile">Role:</label>
                <select name="user_profile" id="user_profile">
                    <option value="0">------ SELECT -----</option>
                    <option value="1">System Admin</option>
                    <option value="2">Real Estate Agent</option>
                    <option value="3">Seller</option>
                    <option value="4">Buyer</option>
                </select>
                <br><br>
                <span class="error" id="error_profile"></span>
                <br>
                <input type="text" name="username" id="username" class="input-field" placeholder="Username" value="<?php echo $username ?>" oninput="hideError('error_username')">
                <span class="error" id="error_username"></span>
                <input type="password" name="password" id="password" class="input-field" placeholder="Password" value="<?php echo $password ?>" oninput="hideError('error_password')">
                <span class="error" id="error_password"></span>
                <br><br>
                <span class="error"><?php echo $e1 ?></span>
                <br><br>
                <input type="submit" name="login" class="submit-btn" value="Login">
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var user_profile = document.getElementById("user_profile").value;
            var isValid = true;

            if (username.trim() === "") {
                displayError('error_username', 'Please fill in Username');
                isValid = false;
            }

            if (password.trim() === "") {
                displayError('error_password', 'Please fill in Password');
                isValid = false;
            }

            if (user_profile === "0") { // Check if user profile is not selected
                displayError('error_profile', 'Please select a Role');
                isValid = false;
            }

            return isValid;
        }


        function displayError(elementId, message) {
            var errorElement = document.getElementById(elementId);
            errorElement.innerHTML = message;
        }

        function hideError(elementId) {
            var errorElement = document.getElementById(elementId);
            errorElement.innerHTML = '';
        }
    </script>
</body>

</html>
