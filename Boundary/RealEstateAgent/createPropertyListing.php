<?php

include_once("../../Controller/RealEstateAgent/createPropertyListingController.php");

$agent_id = $_SESSION['agent_id'];

$error_message = "";

$navbarItems = array(
    array("text" => "Contact Us", "link" => "#footer"),
    array("text" => "All Property Listing", "link" => "viewPropertyListings.php"),
    array("text" => "My Property Listing", "link" => "viewAgentPL.php?agent_id=" . $agent_id),
    array("text" => "Create", "link" => "createPropertyListing.php"),
    array("text" => "My Review", "link" => "viewAgentReview.php?agent_id=" . $agent_id),
);

function displaySuccess($message) {
    echo "<script>alert('$message'); window.location.href = 'viewAgentPL.php';</script>";
}

if (isset($_POST["createListing"])) {
    // Get the agent_id based on what acc they login as
    $agent_id = $_SESSION['agent_id'];

    // Get seller ID based on their name
    $seller_name = $_POST['user_fullname'];
    $createPropertyListingController = new CreatePropertyListingController();
    $seller_id = $createPropertyListingController->getSellerIdByName($seller_name);

    // Create property listing if seller_id is found
    if ($seller_id !== false) {
        $propertyListing = new PropertyListing();
        $propertyListing->setAgentId($agent_id);
        $propertyListing->setSellerId($seller_id);
        $propertyListing->setPrice($_POST["price"]);
        $propertyListing->setType($_POST["type"]);
        $propertyListing->setLocation($_POST["location"]);
        $propertyListing->setNoOfBedroom($_POST["noOfBedroom"]);
        $propertyListing->setNoOfToilet($_POST["noOfToilet"]);
        $propertyListing->setDescription($_POST["description"]);

        // Create property listing
        $result = $createPropertyListingController->createPropertyListing($propertyListing);

        // Display success message and redirect if successful
        if ($result === true) {
            displaySuccess("CREATED SUCCESSFULLY!");
        } else {
            $error_message = "Failed to create property listing."; // Display error message
        }
    } else {
        $error_message = "Seller not found."; // Display error message
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Property Listing</title>

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
            <h2>Create Property Listing</h2>

                <!-- Listing creation form -->
            <form method="post" class="user-input" onsubmit="return validateForm();" enctype="multipart/form-data">

                <label for="user">Owner's Name:</label>
                <input type="text" id="user_fullname" name="user_fullname" class="input-field">
                <span id="error_user_fullname" class="error"></span> <!-- Display error-->
                <br><br>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" class="input-field">
                <br>
                <span id="error_price" class="error"></span> <!-- Display error -->
                <br><br>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" class="input-field">
                <span id="error_location" class="error"></span> <!-- Display error -->
                <br><br>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="input-field">
                
                <label for="type">Property Type:</label>
                <select id="type" name="type">
                    <option value="HDB">HDB</option>
                    <option value="Condo">Condo</option>
                    <option value="Landed">Landed</option>
                </select>
                <br><br>
                <label for="noOfBedroom">Number of Bedrooms:</label>
                <select id="noOfBedroom" name="noOfBedroom">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
                <br>
                <br>       
                <label for="noOfToilet">Number of Toilets:</label>
                <select id="noOfToilet" name="noOfToilet">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
                <br><br>
                <input type="submit" class="submit-btn" name="createListing" value="Create">
                <a href="../RealEstateAgent/viewPropertyListings.php" class="backbutton">Cancel</a>
            </form>
        </div>
    </body>
</html>

<script>
    function validateForm() {
        var fullname = document.getElementById("user_fullname").value;
        var price = document.getElementById("price").value;
        var location = document.getElementById("location").value;

        var isValid = true;

        if (fullname === "") {
            displayError('user_fullname', "Please enter Owner's Name");
            isValid = false;
        }

        if (price === "") {
            displayError('price', 'Please enter Price');
            isValid = false;
        }

        if (location === "") {
            displayError('location', 'Please enter Location');
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

    document.getElementById("price").addEventListener("input", function() {
        document.getElementById("error_price").innerHTML = "";
    });

    document.getElementById("location").addEventListener("input", function() {
        document.getElementById("error_location").innerHTML = "";
    });
</script>
