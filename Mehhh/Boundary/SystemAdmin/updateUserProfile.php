<?php

if (isset($_POST['userprofile_id']) && isset($_POST['profilename'])) {
    $id = $_POST['userprofile_id'];
    $profilename = $_POST['profilename'];

    // checking empty fields
    if (empty($profilename)) {
        if (empty($profilename)) {
            echo "<font color='red'>user profile field is empty!</font><br/>";
        }
    } else {
        //updating the table
        require_once('../../Controller/SystemAdmin/updateUserProfileController.php');
        $userCtl = new updateUserProfileController();
        $result = $userCtl->updateUserProfile($id, $profilename);

        if ($result) {
            //redirecting to the display page. In our case, it is viewUserProfile.php
            header("Location: viewUserProfile.php");
        }
    }
}

//getting id from url
$id = isset($_GET['userprofile_id']) ? $_GET['userprofile_id'] : die('ERROR: Record ID not found.');
?>



<head>
<title>User Admin - Update User Profile </title>
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
                <a href="viewUserProfile.php"><img src="../../img/logo.jpg"  style="width: 200px; height: auto;" ></a> <!--default page-->
                <div class="topnav">
                    <a href="index.php">LOG OUT</a>
                    <a href="viewUserProfile.php">PROFILE</a>
                    <a href="viewUserAccount.php">USER</a>
                </div>
            </div>
        </section>
        <hr>
        <!-- End Navbar -->
        
            <br>
            <div class="main">
                <div class="section section-basic">
                    <div class="container">
                        <h2>Update User Profile</h2>
                        <!-- <a href='userProfile.php' class='btn btn-warning btn-round button2'>Back</a>-->
                        <br>
                        <div class="col-md-12">
                            <div class="panel panel-success panel-size-custom">
                                <div class="panel-heading">
                                    <h3></h3>
                                </div>
                                <div class="panel-body">
                                    <form action="updateUserProfile.php" method="post" id="updateUserProfile">
                                        <div class="form group">
                                            <input type="hidden" class="form-control" id="userprofile_id" name="userprofile_id" value=<?php echo $_GET['userprofile_id']; ?>>
                                            <label for="profilename">User Profile:</label>
                                            <input type="text" class="form-control" id="profilename" name="profilename" value="<?php echo $_GET['profilename']; ?>">
                                        </div>
                                        <br>
                                        <input type="submit" class="btn btn-success btn-round" id="submit" value="Update">
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      
    </div>
</body>



</html>