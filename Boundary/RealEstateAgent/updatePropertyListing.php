<?php
// Database connection file
include("../../config.php");
require_once('../../Controller/RealEstateAgent/updatePropertyListingController.php');

$updatePropertyListingController = new updatePropertyListingController();
$agent_id = $_SESSION['agent_id'];
$navbarItems = array(
    array("text" => "Contact Us", "link" => "#footer"),
    array("text" => "All Property Listing", "link" => "viewPropertyListings.php"),
    array("text" => "My Property Listing", "link" => "viewAgentPL.php?agent_id=" . $agent_id),
    array("text" => "Create", "link" => "createPropertyListing.php"),
    array("text" => "My Review", "link" => "viewAgentReview.php?agent_id=" . $agent_id),
);

// Function to display success message and redirect
function displaySuccess($message) {
    echo "<script>alert('$message'); window.location.href = 'viewAgentPL.php';</script>";
}

$property_id = $seller_id = '';
$user_fullname = $price = $type = $location = $description = "";
$noOfBedroom = $noOfToilet = $status = "";


// Check if the form is submitted
if (isset($_POST['update'])) {
    $property_id = $_POST['property_id'];
    $seller_id = $_POST['seller_id'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $noOfBedroom = $_POST['noOfBedroom'];
    $noOfToilet = $_POST['noOfToilet'];
    $status = $_POST['status'];
    $description = $_POST['description'];


    // Create a new propertyListing object and set its properties
    $propertyListing = new propertyListing();
    $propertyListing->setPropertyId($property_id);
    $propertyListing->setSellerId($seller_id);
    $propertyListing->setPrice($price);
    $propertyListing->setType($type);
    $propertyListing->setLocation($location);
    $propertyListing->setNoOfBedroom($noOfBedroom);
    $propertyListing->setNoOfToilet($noOfToilet);
    $propertyListing->setStatus($status);
    $propertyListing->setDescription($description);

    $result = $updatePropertyListingController->updatePropertyListing($propertyListing);

    if ($result) {
        // Display success message
        displaySuccess("UPDATED SUCCESSFULLY!");
    } else {
        echo "<script>alert('Failed to update property listing.');</script>";
    }
    
} 


else {
    // PREFILLED THE FORM W CURRENT DATA
    $property_id = isset($_GET['property_id']) ? $_GET['property_id'] : die('ERROR: Property ID not found.');
    $seller_id = isset($_GET['seller_id']) ? $_GET['seller_id'] : '';
    $user_fullname = $updatePropertyListingController->getSellerNameByID($seller_id);
    $price = isset($_GET['price']) ? $_GET['price'] : '';
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $location = isset($_GET['location']) ? $_GET['location'] : '';
    $description = isset($_GET['description']) ? $_GET['description'] : '';
    $noOfBedroom = isset($_GET['noOfBedroom']) ? $_GET['noOfBedroom'] : '';
    $noOfToilet = isset($_GET['noOfToilet']) ? $_GET['noOfToilet'] : '';
    $status = isset($_GET['status']) ? $_GET['status'] : '';
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Property Listing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Buyer/CSS/styles.css">
    <script src="https://kit.fontawesome.com/e3ffb3fff0.js" crossorigin="anonymous"></script>
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
                width: calc(100% - 40px);
                padding: 8px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
                font-size: 14px;
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

            label
            {
                font-weight: bold;

            }

        </style>
</head>
<body>
    <section id="title">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-yellow">
            <div class="container-fluid">
                <a class="navbar-brand" href="viewAgents.php"><img src="/Mehhh/img/logo.jpg" width="100" height="100"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php foreach ($navbarItems as $item) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $item['link']; ?>"><?php echo $item['text']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="navbar-nav mr-auto">
            <li class="navbar-item">
                <a class="nav-icon" href="../../index.php"><i class="fa-solid fa fa-sign-out"></i></a>
            </li>
            </ul>
                </div>
            </div>
        </nav>
    </section>
    <div class="white-box">
        <!-- Header section -->
        <h2>Update Property Listing</h2>
        <!-- Listing update form -->
        <form method="post" action="updatePropertyListing.php?" onsubmit="return validateForm();">
            <!-- Include input fields for updating property listing details -->
            <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
            <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">

            <label for="user_fullname">Owner's Name:</label>
            <input type="text" id="user_fullname" name="user_fullname" class="input-field" value="<?php echo $user_fullname; ?>" oninput="hideError('user_fullname')">
            <br>
            <span class="error" id="error_user_fullname"></span> <!-- Display error-->
            <br><br>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" class="input-field" value="<?php echo $price; ?>" oninput="hideError('price')">
            <br>
            <span class="error" id="error_price"></span> <!-- Display error -->
            <br><br>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" class="input-field" value="<?php echo $location; ?>" oninput="hideError('location')">
            <br>
            <span class="error" id="error_location"></span> <!-- Display error -->
            <br><br>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" class="input-field" value="<?php echo $description; ?>">

            <label for="type">Property Type:</label>
            <select id="type" name="type">
                <option value="HDB" <?php if ($type == 'HDB') echo 'selected'; ?>>HDB</option>
                <option value="Condo" <?php if ($type == 'Condo') echo 'selected'; ?>>Condo</option>
                <option value="Landed" <?php if ($type == 'Landed') echo 'selected'; ?>>Landed</option>
            </select>
            <br><br>

            <label for="status">Property status:</label>
            <select id="status" name="status">
                <option value="Sold" <?php if ($status == 'Sold') echo 'selected'; ?>>Sold</option>
                <option value="Unsold" <?php if ($status == 'Unsold') echo 'selected'; ?>>Unsold</option>
            </select>
            <br><br>

            <label for="noOfBedroom">Number of Bedrooms:</label>
            <select id="noOfBedroom" name="noOfBedroom">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php if ($noOfBedroom == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
            <br><br>

            <label for="noOfToilet">Number of Toilets:</label>
            <select id="noOfToilet" name="noOfToilet">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php if ($noOfToilet == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
            <br><br>

            <button type="submit" name="update" class="submit-btn">Update</button>
            <a href="../RealEstateAgent/viewAgentPL.php" class="backbutton">Cancel</a>
        </form>
    </div>

    <script>
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
            var price = document.getElementById("price").value;
            var location = document.getElementById("location").value;

            var isValid = true;

            if (fullname.trim() === "") {
                displayError('user_fullname', 'Please enter Owner\'s Name');
                isValid = false;
            }

            if (price.trim() === "") {
                displayError('price', 'Please enter Price');
                isValid = false;
            }

            if (location.trim() === "") {
                displayError('location', 'Please enter Location');
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>
