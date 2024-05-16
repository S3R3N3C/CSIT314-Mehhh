<?php
// Include the necessary files and classes
error_reporting(E_ALL & ~E_NOTICE);
include_once("../../Controller/buyer/viewPropertyListingsController.php");
include_once("../../Controller/Buyer/viewAgentsController.php");
$buyer_id = $_SESSION['buyer_id'];
$navbarItems = array(
    array("text" => "About Us", "link" => "#footer"),
    array("text" => "Favourite List", "link" => "viewFavList.php?buyer_id=" . $buyer_id),
    array("text" => "Buy", "link" => "viewPropertyListings.php"),
    array("text" => "Agents", "link" => "viewAgents.php"),
    array("text" => "Mortgage Calculator", "link" => "mortgage.php"),
  );
  
// Check if property_id is set in the URL
if (isset($_GET['property_id'])) {
    // Retrieve property_id from the URL
    $property_id = $_GET['property_id'];

    // Create an instance of viewPropertyListingsController
    $viewPropertyListingsController = new viewPropertyListingsController();

    // Call the viewPropertyPage method and pass the property_id
    $propertyInfo = $viewPropertyListingsController->viewPropertyPage($property_id);

    // Check if propertyInfo is not empty
    if (!empty($propertyInfo)) {
        // Create an instance of viewAgentsController
        $viewAgentsController = new viewAgentsController();

        // Call the getAgentInfo method to retrieve agent information
        $agent_info = $viewAgentsController->getAgentInfo($propertyInfo['agent_id']);

        // Increment the noOfViews column in the database for the viewed property
        $viewPropertyListingsController->incrementPropertyViews($property_id);

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <title><?php echo $propertyInfo['location']; ?></title>
            <!-- Google Fonts -->
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

            <!-- Font Awesome -->
            <script src="https://kit.fontawesome.com/e3ffb3fff0.js" crossorigin="anonymous"></script>

            <!-- Custom CSS -->
            <link rel="stylesheet" href="../Buyer/CSS/styles.css">

            <!-- Add your CSS links and styles here -->
            <style>
                /* Add your custom styles here */
                .property-container {
                    background-color: #f8f9fa;
                    border: 1px solid #dee2e6;
                    border-radius: 10px;
                    padding: 20px;
                    margin-top: 20px;
                    overflow: hidden; /* Prevent content overflow */
                }

                .property {
                    background-color: #f8f9fa;
                    border: 1px solid #dee2e6;
                    border-radius: 10px;
                    padding: 20px;
                    margin-top: 20px;
                }

                .property img {
                    width: 100%;
                    height: 400px; /* Adjust height of property image */
                    object-fit: cover;
                }

                .property-details {
                    padding-top: 20px;
                }

                .property-details ul {
                    list-style-type: none;
                    padding-left: 0;
                }

                /* Custom styles for placing description beside image */
                .property-description {
                    padding-left: 20px; /* Adjust padding as needed */
                }
            </style>
        </head>
        <body>
        
        <section id="title">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-yellow">
                <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="/Mehhh/img/logo.jpg" width="100" height="100">
                    <a class="navbar-brand" href="#"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php foreach ($navbarItems as $item): ?>
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

        <button style="background-color: yellow" onclick="window.location.href='viewPropertyListings.php'"><b>Back</b></button>
        <!-- Add your HTML content here -->
        <div class="container">
            <div class="property-container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Set a fixed height for the image container -->
                        <div style="height: 350px; width: 450px; overflow: hidden;">
                            <img src="../../img/<?php echo $propertyInfo['type']; ?>.jpg" alt="<?php echo $propertyInfo['location']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md-6 property-description">
                        <div class="property-details">
                        <p><b>Agent name: </b><?php echo $agent_info['user_fullname']; ?></p>
                            <p><b>Contact: </b> <?php echo $agent_info['email']; ?></p>
                            <p>Location: <b><?php echo $propertyInfo['location']; ?></b></p>
                            <p>Price:  <b>$<?php echo $propertyInfo['price']; ?></b></p>
                            <p><b><?php echo $propertyInfo['noOfBedroom']; ?> <i class="fa-solid fa-bed"></i> <?php echo $propertyInfo['noOfToilet']; ?> <i class="fa-solid fa-bath"></i></b></p>
                            <p>Type: <b><?php echo $propertyInfo['type']; ?></b> </p>
                            <p>Description: <b><?php echo $propertyInfo['description']; ?></b> </p>
                            <button style="height: 60px; width: 250px;" class="bcard btn btn-dark" type="button">Contact</button>
                        </div>
                    </div>
                    <br>
                    <br>
                   <!-- <div class="agents-details">
                            <p><b>Agent name: </b><?php echo $agent_info['user_fullname']; ?></p>
                            <p><b>Contact: </b> <?php echo $agent_info['email']; ?></p>
                        </div> -->
                </div>
            </div>
        </div>



        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <!-- Add your JavaScript here -->

        </body>
        </html>
        <?php
    } else {
        // Handle the case where propertyInfo is empty (property not found)
        echo "Property not found.";
    }
} else {
    // Handle the case where property_id is not set
    echo "Property ID is not set!";
}
?>
