<?php
// Database connection file
include("../../config.php");

// Function to display success message and redirect
function displaySuccess($message) {
    echo "<script>alert('$message');";
    echo "window.location.href = 'viewUserProfile.php';</script>";
}

// Initialize variables to hold form field values and error messages
$id = $status = $profilename = "";
$profilenameError = "";

// Check if the form is submitted
if (isset($_POST['update'])) {
    $id = $_POST['userprofile_id'];
    $profilename = $_POST['profilename'];
    $status = $_POST['status'];


    //updating the table
    require_once('../../Controller/SystemAdmin/updateUserProfileController.php');
    $userCtl = new updateUserProfileController();
    $result = $userCtl->updateUserProfile($id, $profilename, $status);

    if ($result) {
        // Display success message
        displaySuccess("UPDATED SUCCESSFULLY!");
    }

} 
else {
    // If form is not submitted, check if there are URL parameters to pre-fill the form
    $id = isset($_GET['userprofile_id']) ? $_GET['userprofile_id'] : die('ERROR: Record ID not found.');
    $profilename = isset($_GET['profilename']) ? $_GET['profilename'] : '';
    $status = isset($_GET['status']) ? $_GET['status'] : '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>System Admin - Update User Profile</title>
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
                <a href="viewUserProfile.php"><img src="../../img/logo.jpg" style="width: 200px; height: auto;"></a> <!--default page-->
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
                    
                    <h2>Update User Profile</h2>

                    <br>
                    <div class="col-md-12">
                        <div class="panel panel-success panel-size-custom">
                    
                            </div>
                            <div class="panel-body">
                                <form action="updateUserProfile.php" method="post" id="updateUserProfile" onsubmit="return validateForm()">
                                    <div class="form group">
                                        <input type="hidden" class="form-control" id="userprofile_id" name="userprofile_id" value="<?php echo $id; ?>">
                                        <label for="profilename">User Profile:</label>
                                        <input type="text" class="form-control" id="profilename" name="profilename" value="<?php echo $profilename; ?>" oninput="hideError('profilename')">
                                        <span id="error_profilename" class="error"><?php echo $profilenameError; ?></span>
                                        <br><br>
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Active" <?php if ($status == 'Active') echo 'selected'; ?>>Active</option>
                                            <option value="Inactive" <?php if ($status == 'Inactive') echo 'selected'; ?>>Inactive</option>
                                        </select>
                                        <br><br>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="submit-btn" name="update">Update</button>
                                        <a href="viewUserProfile.php" class="backbutton">Cancel</a>
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
            // Display error messages if any
            var profilenameError = "<?php echo $profilenameError; ?>";

            if (profilenameError !== "") {
                displayError('profilename', profilenameError);
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
            var profilename = document.getElementById("profilename").value;

            if (profilename.trim() === "") {
                displayError('profilename', 'User profile field is empty!');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
