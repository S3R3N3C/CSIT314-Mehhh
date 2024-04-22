<!DOCTYPE html>
<html>

<head>
    <title>RealtyRealm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,300;0,400;0,800;1,100;1,400&display=swap" rel="stylesheet">
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .navbar {
            background-color: white; /* Change to white */
            color: #1e1d1d; /* Change text color */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: #1e1d1d; /* Change text color */
        }

        .navbar-nav {
            list-style: none;
            display: flex;
        }

        .navbar-nav li {
            margin-left: 20px;
        }

        .navbar-nav a {
            text-decoration: none;
            color: #1e1d1d; /* Change text color */
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .navbar-nav a:hover {
            color: #00802f; /* Change to your desired hover color */
        }

        /* Dropdown menu */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="navbar-brand">RealtyRealm</a>
        <ul class="navbar-nav">
            <li><a href="Boundary/RealEstateAgent/viewPropertyListings.php">BUY</a></li>
            <li><a href="#">SELL</a></li>
            <li><a href="#">MORTGAGE</a></li>
            <li>
                <a href="Boundary/User/userLogin.php">LOGIN</a>
            </li>
        </ul>
    </nav>

</body>
</html>
