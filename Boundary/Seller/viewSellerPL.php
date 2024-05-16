<?php
    include_once("../../Controller/Seller/viewSellerPLController.php");

    $seller_id = $_SESSION['seller_id'];
    $viewSellerPLController = new viewSellerPLController();
    $propertyListings = $viewSellerPLController->viewSellerPL($seller_id);

    $navbarItems = array(
    array("text" => "Contact Us", "link" => "#footer"),
    array("text" => "My Property", "link" => "viewSellerPL.php?seller_id=" . $seller_id),
    array("text" => "Agents", "link" => "viewAgents.php"),
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

?>
 
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>RealityRealms</title>

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu:wght@300;400;500;700&display=swap"
    rel="stylesheet">

  <!-- CSS links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../Buyer/CSS/styles.css">
  <script src="https://kit.fontawesome.com/e3ffb3fff0.js" crossorigin="anonymous"></script>

  <!-- Bootstrap scripts-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"></script>

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
            flex-wrap: wrap;
            justify-content:center; 
            margin-top: 50px;
            margin-bottom: 60px;
        }
        .property {
            width: 30%; /* Adjust width to fit two properties in one row */
            margin-left: 20px;
            padding: 10px;
            overflow: hidden;
            border: 5px solid #ccc;
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
            margin-top: 10;
        }

        @media (max-width: 768px) {
            .property-row {
            flex-direction: row; /* Stack properties vertically on smaller screens */
            }
            .property {
            width: 100%; /* Make each property take up the full width on smaller screens */
            margin: 20 20 20px; /* Adjust margin for spacing */
            }
        }

        .fa.fa-bookmark {
            font-size: 24px; 
            margin-left: 5px; 
        }
        .card-body{
            font-size: 24px; 
            margin-left: 10px; 
        }
    </style>
</head>


<body>
<section id="title">
   <!-- Navigation Bar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-yellow">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="/Mehhh/img/logo.jpg" width="100" height="100">
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
  <h3 style="text-align: center;">My Property</h3>
</section>


<section>
    <div class="property-row">
        <?php foreach ($propertyListings as $property): ?>
            <div class="property" data-property-type="<?php echo $property['type']; ?>">
                <img src="../../img/<?php echo $property['type']; ?>.jpg" alt="<?php echo $property['location']; ?>">
                <div class="property-details">
                    <div class="card-body">
                        <h2><?php echo $property['location']; ?></h2>
                        <p><b><?php echo $property['noOfViews']; ?></b>  <img src="../../img/view.png" style="margin-left:5px; width: 30px; height: 30px;">
                        <b><?php echo $property['noOfShort']; ?></b>  <i class="fa fa-bookmark"></i></p>
                        <?php if ($property['status'] === 'Sold'): ?>
                              <p><b><span style="color:red"><?php echo $property['status']; ?></span></b></p>
                          <?php else: ?>
                              <p><b><?php echo $property['status']; ?></b></p>
                          <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

</div>


  
</body>

<section id="cta">

    <div class="container-fluid">

      <h1>Contact us and find your realm.</h1>
      <button class="cta-btn btn btn-lg btn-secondary" type="button"><span><i class="fa-solid fa-phone"></i></span>
        Contact Us</button>

    </div>
  </section>


  <script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the search form, input field, reset button, and back button
    const searchForm = document.getElementById("searchForm");
    const searchInput = document.getElementById("searchInput");
    const backButton = document.getElementById("backToListing");

    // Add event listener for form submission
    searchForm.addEventListener("submit", function(event) {
        event.preventDefault();
        const searchQuery = searchInput.value.toLowerCase();
        search(searchQuery);
    });

    // Add event listener for back button click
    backButton.addEventListener("click", function() {
        searchInput.value = ""; // Clear the search input field
        search(""); // Reset the search
    });

    // Function to perform the search
    function search(query) {
        const propertyRows = document.querySelectorAll(".property-row");
        propertyRows.forEach(function(row) {
            const properties = row.querySelectorAll(".property");
            properties.forEach(function(property) {
                const propertyName = property.querySelector("h2").textContent.toLowerCase();
                const propertyType = property.dataset.propertyType.toLowerCase();
                if ((propertyName.includes(query) || propertyType.includes(query)) || query === "") {
                    // Show the property if its name or type matches the search query or if query is empty
                    property.style.display = "block";
                } else {
                    // Hide the property if its name or type does not match the search query
                    property.style.display = "none";
                }
            });
        });
    }
});
</script>


  
<footer id="footer">
    <i class="sm-logos fa-brands fa-facebook-f"></i>
    <i class="sm-logos fa-brands fa-instagram"></i>
    <i class="fa-brands fa-linkedin"></i>
    <p>© Reality Realm</p>

  </footer>

</html>