<?php
include_once("../../Controller/RealEstateAgent/viewPropertyListingsController.php");


$agent_id = $_SESSION['agent_id'];
$viewPropertyListingsController = new viewPropertyListingsController();
$propertyListings = $viewPropertyListingsController->viewPropertyListings();

$navbarItems = array(
  array("text" => "Contact Us", "link" => "#footer"),
  array("text" => "All Property Listing", "link" => "viewPropertyListings.php"),
  array("text" => "My Property Listing", "link" => "viewAgentPL.php?agent_id=" . $agent_id),
  array("text" => "Create", "link" => "createPropertyListing.php"),
  array("text" => "My Review", "link" => "viewAgentReview.php?agent_id=" . $agent_id),
);

// logout function
function logout() {
  $_SESSION = array();
  session_destroy();
}

// if logout icon is clicked
if (isset($_POST['logout'])) {
    logout();

    // Redirect to the index page
    header("Location: ../../index.php");
    exit;
}

if (isset($_POST['search'])) {
  $search = $_POST['search'];
  if (!empty($search)) {
      // If the search field is not empty, perform the search
      include_once("../../Controller/RealEstateAgent/searchPropertyListingController.php");
      $searchPropertyListingController = new searchPropertyListingController();
      $propertyListings = $searchPropertyListingController->searchPropertyListing($search);
  } else {
      // If the search field is empty, retrieve all propertyListing
      $propertyListings = $viewPropertyListingsController->viewPropertyListings();
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>RealityRealms</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- CSS links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../Buyer/CSS/styles.css">
  <script src="https://kit.fontawesome.com/e3ffb3fff0.js" crossorigin="anonymous"></script>

  <!-- Bootstrap scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  <style>
      /* Basic CSS for property listing */
      #search-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10vh;
      }

      .search-form {
        background-color: #f0f0f0;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        display: flex;
        align-items: center;
      }

      #searchInput {
        border: none;
        outline: none;
        padding: 8px;
        width: 250px;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
      }

      button {
        background-color: #808080;
        color: #000;
        border: none;
        padding: 8px 15px;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        cursor: pointer;
      }

      button:hover {
        background-color: #0056b3;
      }

      .property-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 50px;
        margin-bottom: 60px;
      }

      .property {
        width: 30%;
        margin-left: 20px;
        padding: 10px;
        overflow: hidden;
        border: 2px solid #ccc;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        box-sizing: border-box;
      }

      .property img {
        width: 100%;
        height: 400px;
        object-fit: cover;
      }

      .property-details {
        overflow: hidden;
      }

      .property-details h2 {
        margin-top: 10px;
      }

      @media (max-width: 768px) {
        .property-row {
          flex-direction: column;
        }

        .property {
          width: 90%;
          margin: 20px 0;
        }
      }
    </style>
</head>

<body>
<section id="title">
   <!-- Navigation Bar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-yellow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="/Mehhh/img/logo.jpg" width="100" height="100"></a>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <form method="post">
                            <button type="submit" name="logout" class="nav-icon" style="background-color:transparent"><i class="fa-solid fa fa-sign-out"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>

<section>
  <h3 style="text-align: center;">All Property</h3>
</section>

<section id="search-container">
    <form id="searchForm" action="" method="post" class="search-form">
        <input type="text" id="searchInput" name="search" placeholder="Search for properties...">
        <button type="submit"><i class="fas fa-search"></i></button>
        <button type="reset" id="backToListing" onclick="window.location.href='viewPropertyListings.php'">Back</button>
    </form>
</section>

<section>
    <div class="property-row">
        <?php foreach ($propertyListings as $property): ?>
            <div class="property" data-property-type="<?php echo $property['type']; ?>">
                <img src="../../img/<?php echo $property['type']; ?>.jpg" alt="<?php echo $property['location']; ?>">
                <div class="property-details">
                    <div class="card-body">
                        <h2><?php echo $property['location']; ?></h2>
                        <p><b><?php echo $property['noOfBedroom']; ?> <i class="fa-solid fa-bed"></i> <?php echo $property['noOfToilet']; ?> <i class="fa-solid fa-bath"></i></b></p>
                        <p><b><i class="fa fa-usd"></i><?php echo $property['price']; ?></b></p>
                        <p><b><?php echo $property['type']; ?></b></p>
                        <?php if ($property['status'] === 'Sold'): ?>
                            <p><b><span style="color:red"><?php echo $property['status']; ?></span></b></p>
                        <?php else: ?>
                            <p><b><?php echo $property['status']; ?></b></p>
                        <?php endif; ?>
                    </div>
                    <button style="background-color: yellow" onclick="window.location.href='viewPropertyPage.php?property_id=<?php echo $property['property_id']; ?>'"><b>View Property</b></button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="cta">
    <div class="container-fluid">
      <h1>Contact us and find your realm.</h1>
      <button class="cta-btn btn btn-lg btn-secondary" type="button"><span><i class="fa-solid fa-phone"></i></span> Contact Us</button>
    </div>
</section>

<footer id="footer">
    <i class="sm-logos fa-brands fa-facebook-f"></i>
    <i class="sm-logos fa-brands fa-instagram"></i>
    <i class="fa-brands fa-linkedin"></i>
    <p>© Reality Realm</p>
</footer>

</body>
</html>
