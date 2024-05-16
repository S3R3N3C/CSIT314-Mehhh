<?php
include_once("../../Controller/Buyer/viewUnsoldPLController.php");
include_once("../../Controller/Buyer/addFavListController.php");

$buyer_id = $_SESSION['buyer_id'];
$viewUnsoldPLController = new viewUnsoldPLController();
$propertyListings = $viewUnsoldPLController->viewUnsoldPL();
$addFavListController = new addFavListController();

$result = "";

function displaySuccess($message) {
  echo "<script>alert('$message'); </script>";
}

function displayError($message) {
  echo "<script>alert('$message'); </script>";
}

if (isset($_GET['property_id'])) {
  $property_id = $_GET['property_id'];
  $result = $addFavListController->addFavList($buyer_id, $property_id);

  // Increment the noOfShort column in the database for the viewed property
  $viewUnsoldPLController->incrementNoOfShort($property_id);

  if ($result == true) {
    displaySuccess("Property successfully added to favorite list!");
  }
  else{
    displayError("Property already in favorite list!");
  }
}

// Update $propertyListing array to include whether each property is in the favorite list
foreach ($propertyListings as &$property) {
    $property['in_favorite'] = $addFavListController->checkFavExist($buyer_id, $property['property_id']);
}

$navbarItems = array(
  array("text" => "About Us", "link" => "#footer"),
  array("text" => "Favourite List", "link" => "viewFavList.php?buyer_id=" . $buyer_id),
  array("text" => "Buy", "link" => "viewPropertyListings.php"),
  array("text" => "Agents", "link" => "viewAgents.php"),
  array("text" => "Mortgage Calculator", "link" => "mortgage.php"),
);

if (isset($_POST['search'])) {
  $search = $_POST['search'];
  if (!empty($search)) {
      // If the search field is not empty, perform the search
      include_once("../../Controller/Buyer/searchUnsoldPLController.php");
      $searchUnsoldPLController = new searchUnsoldPLController();
      $propertyListings = $searchUnsoldPLController->searchUnsoldPL($search);
  } else {
      // If the search field is empty, retrieve all propertyListings
      $propertyListings = $viewPropertyListingsController->viewPropertyListings();
  }
  foreach ($propertyListings as &$property) {
    $property['in_favorite'] = $addFavListController->checkFavExist($buyer_id, $property['property_id']);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>RealityRealms</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- CSS links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../Buyer/CSS/styles.css">
  <script src="https://kit.fontawesome.com/e3ffb3fff0.js" crossorigin="anonymous"></script>

  <!-- Bootstrap scripts-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  <style>
    /* Basic CSS for property listing */
    #search-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 10vh; /* Set the height of the container to full viewport height */
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
    /* Font Awesome icons */
    .fas {
      font-size: 16px;
    }
    .property-row {
      display: flex;
      flex-wrap: wrap; /* Allow properties to wrap to the next row */
      justify-content:center; /* Center properties horizontally */
      margin-top: 50px;
      margin-bottom: 60px;
    }
    .property {
      width: 30%; /* Adjust width to fit two properties in one row */
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
      height: 400px; /* Adjust height of property image */
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
        flex-direction:row; /* Stack properties vertically on smaller screens */
      }
      .property {
        width: 10%; /* Make each property take up the full width on smaller screens */
        margin: 20 20 20px; /* Adjust margin for spacing */
      }
    }
    /* Heart icon color variations */
    .fa-heart-black {
      color: black;
    }
    .fa-heart-blue {
      color: blue;
    }

    .button-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px; /* Add some bottom margin for spacing */
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

<section>
  <h3 style="text-align: center;">Unsold Property</h3>
</section>

<section>
  <section id="search-container">
        <form id="searchForm" action="" method="post" class="search-form">
            <input type="text" id="searchInput" name="search" placeholder="Search for properties...">
            <button type="submit"><i class="fas fa-search"></i></button>
            <button type="reset" id="backToListing" onclick="window.location.href='viewUnsoldPL.php'">Back</button>
        </form>
    </section>
    <br>
    <section>
      <div class="button-container">
          <button style="background-color: yellow" onclick="window.location.href='viewSoldPL.php'"><b>SOLD</b></button>
          <button style="background-color: yellow" onclick="window.location.href='viewUnsoldPL.php'"><b>UNSOLD</b></button>
      </div>
    </section>

    <section>
        <div class="property-row">
            <?php foreach ($propertyListings as $property): ?>
                <div class="property" data-property-type="<?php echo $property['type']; ?>">
                    <img src="../../img/<?php echo $property['type']; ?>.jpg" alt="<?php echo $property['location']; ?>">
                    <br><br>
                    <a href="?buyer_id=<?php echo $buyer_id; ?>&property_id=<?php echo $property['property_id']; ?>">
                        <?php if ($property['in_favorite']): ?>
                            <i class="fas fa-heart fa-heart-blue"></i>
                        <?php else: ?>
                            <i class="far fa-heart fa-heart-black"></i>
                        <?php endif; ?>
                    </a>
                    <div class="property-details">
                      <div class="card-body">
                          <h2><?php echo $property['location']; ?></h2>
                          <p><b><?php echo $property['noOfBedroom']; ?> <i class="fa-solid fa-bed"></i> <?php echo $property['noOfToilet']; ?> <i class="fa-solid fa-bath"></i></b></p>
                          <p><b>$<?php echo $property['price']; ?></b></p>
                          <p><b><?php echo $property['type']; ?></b></p>
                          <?php if ($property['status'] === 'Sold'): ?>
                              <p><b><span style="color:red"><?php echo $property['status']; ?></span></b></p>
                          <?php else: ?>
                              <p><b><?php echo $property['status']; ?></b></p>
                          <?php endif; ?>
                      </div>
                    </div>
                    <button style="background-color: yellow" 
                    onclick="window.location.href='viewPropertyPage.php?property_id=<?php echo $property['property_id']; ?>'"><b>View Property</b></button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
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
