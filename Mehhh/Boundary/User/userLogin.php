<?php
include_once("../../Controller/User/userLoginController.php");

$username = "";
$password = "";
$e1 = "";

if (isset($_POST["login"])) {
    validateUserName($e1);
    validatePassword($e2);
    if (empty($e1) && empty($e2)) {
        loginAccount($_POST["username"], $_POST["password"]);
    }
}

function validateUserName(&$e1)
{
    global $username;
    $username = trim($_POST["username"]);
    if (empty($username)) {
        $e1 = "Please fill in Username";
    }

}

function validatePassword(&$e2)
{
    global $password;
    $password = trim($_POST["password"]);
    if (empty($password)) {
        $e2 = "Please fill in password";
    }
}

function loginAccount($username, $password)
{
    global $e1;
    $cLGC = new userLoginController();
    $results = $cLGC->loginAccount($username, $password);
    if ($results == true) {
        echo "Login Successful";
    } else {
        echo "Login Failed";
        $e1 = "Please try again";
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
    
    span
    {
        color: #777;
        font-size: 14px;
        position: absolute;
    }
    
</style>

<html>

<body>
    <div class="backgroundImage">
        <div class="form-box">
            <h2 class="login-title">Login</h2>
            <form class="user-input" method="POST">
                <label for="user_profile">User Profile:</label>
                <select name="user_profile" id="user_profile">
                    <option value="System Admin">System Admin</option>
                    <option value="Real Estate Agent">Real Estate Agent</option>
                    <option value="Seller">Seller</option>
                    <option value="Buyer">Buyer</option>
                </select>
                <br><br>
                <input type="text" name="username" class="input-field" placeholder="Username"  value="<?php echo $username ?>" required>
                <input type="password" name="password" class="input-field" placeholder="Password" value="<?php echo $password ?>" required><br><br>
                <input type="submit" name="login" class="submit-btn" value="Login">
                <div id="alert-message"><?php echo $e1 ?></div>
            </form>
        </div>
    </div>
</body>

</html>
