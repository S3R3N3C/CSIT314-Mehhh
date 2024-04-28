<?php 

include_once("../../Controller/User/userLoginController.php"); // To be change

 ?>

 
<!DOCTYPE html>
<html>

<head>
    <title>Property Listing</title>
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
            <div class="container1">
                <a href="#"><img src="../../img/logo.jpg"  style="width: 200px; height: auto;" ></a> <!--default page-->
                <div class="topnav">
                    <!--<a href="../../index.php">LOG OUT</a>-->
                    <a href="../../index.php">BUTTON 1</a>
                    <a href="../../index.php">BUTTON 2</a>
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
                        <input type="text" class="searchTerm" name="search" placeholder="Search" style="height:100%; width:60%; margin-top: -5%;">
                        <button type="submit" class="searchButton" style="margin-top: -5%;">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <br>

        <h1> PROPERTY LISTING </h1>
    </div>
</body>


</html>