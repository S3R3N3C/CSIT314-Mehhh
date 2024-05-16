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
  <link rel="stylesheet" href="css/styles.css">
  <script src="https://kit.fontawesome.com/e3ffb3fff0.js" crossorigin="anonymous"></script>

  <!-- Bootstrap scripts-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"></script>
</head>

<body>
  <!-- Title -->
  <section id="title">
    <div class="container-fluid">
      <!-- Nav Bar -->
      <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <a class="navbar-brand" href="#"><img src="/Mehhh/img/logo.jpg" width="100" height="100"
              class="d-inline-block align-top" alt=""></a>
          <ul class="navbar-nav mr-auto">
            <!-- Include PHP code for dynamic navigation items -->
            <?php
            // Start the session
            session_start();

            // Check if the user is logged in and has a profile set
            if (isset($_SESSION['login']) && $_SESSION['login'] === true && isset($_SESSION['user_profile'])) {
                // Retrieve the user's profile from the session
                $userProfile = $_SESSION['user_profile'];
                
                // Output the appropriate navigation items based on the user's profile
                switch ($userProfile) {
                  case 1: // System Admin
                    // Navigation items for User Profile 1
                    $navbarItems = array(
                      array("text" => "About Us", "link" => "#footer"),
                      array("text" => "User", "link" => "Boundary/SystemAdmin/viewUserAccount.php"),
                      array("text" => "Profile", "link" => "Boundary/SystemAdmin/viewUserProfile.php"),
                      array("text" => "Logout", "link" => "#")
                  );
                    break;
                case 2: // Agent
                    // Navigation items for User Profile 2
                    $navbarItems = array(
                        array("text" => "About Us", "link" => "#footer"),
                        array("text" => "User", "link" => "Boundary/SystemAdmin/viewUserAccount.php"),
                        array("text" => "Create", "link" => "Boundary/RealEstateAgent/createListing.php"),
                        array("text" => "Logout", "link" => "#")
                    );
                    break;
                case 3: // Seller
                    // Navigation items for User Profile 3
                    $navbarItems = array(
                      array("text" => "About Us", "link" => "#footer"),
                      array("text" => "Sell", "link" => "Agents.php"),
                      array("text" => "Agents", "link" => "Agents.php"),
                      array("text" => "Logout", "link" => "../../index.php")
                    );
                    break;
                case 4: // Buyer
                    // Navigation items for User Profile 4
                    $navbarItems = array(
                      array("text" => "About Us", "link" => "#footer"),
                      array("text" => "Buy", "link" => "viewPropertyListings.php"),
                      array("text" => "Agents", "link" => "#agents"),
                      array("text" => "Mortgage Calculator", "link" => "mortgage.php"),
                      array("text" => "Logout", "link" => "../../index.php")
                  );


                default:
                    // Default navigation items for unknown profiles
                    ?>
                      <li class="navbar-item">
                        <a class="nav-link" href="#footer">About Us</a>
                      </li>
                    <?php
                    break;
                }
            } else {
                // If the user is not logged in or no profile is set, display default navigation items
                ?>
                <li class="navbar-item">
                    <a class="nav-link" href="#footer">About Us</a>
                </li>
                <?php
            }
            ?>
          </ul>
        </div>
        <div>
          <ul class="navbar-nav mr-auto">
            <li class="navbar-item">
              <a class="nav-icon" href="Boundary/User/userLogin.php"><i class="fa-solid fa-bell"></i></a>
            </li>
            <li class="navbar-item">
              <a class="nav-icon" href="Boundary/User/userLogin.php"><i class="fa-solid fa-user"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </section>
  <section id="pricing">

    <h2>Featured Properties</h2>
    <p>Our best selections of houses for sale.</p>

    <div class="row">

      <div class="pricing-cards col-lg-4 col-md-6">
        <div class="card">
          <div class="card-header">
          <img src="/Mehhh/img/condo.jpg"  width="300" height="300"
              class="d-inline-block align-top" alt="">
          </div>
          <div class="card-body">
            <h2>$5000 / mo</h2>
            <p>2 <i class="fa-solid fa-bed"></i> 1 <i class="fa-solid fa-bath"></i></p>
            <p>Lentor</p>
            <p>HDB</p>
            <button class="bcard btn btn-dark" type="button">Buy</button>
          </div>
        </div>
      </div>

      <div class="pricing-cards col-lg-4 col-md-6">
        <div class="card">
          <div class="card-header">
          <img src="/Mehhh/img/condo2.jpg"  width="300" height="300"
              class="d-inline-block align-top" alt="">
          </div>
          <div class="card-body">
            <h2>$4900 / mo</h2>
            <p>4 <i class="fa-solid fa-bed"></i> 2 <i class="fa-solid fa-bath"></i></p>
            <p>Marina Barrage</p>
            <p>Studio Apartment</p>
            <button class="bcard btn btn-dark" type="button">Buy</button>
          </div>
        </div>
      </div>

      <div class="pricing-cards col-lg-4">
        <div class="card">
          <div class="card-header">
          <img src="/Mehhh/img/condo3.jpg"  width="300" height="300"
              class="d-inline-block align-top" alt="">
          </div>
          <div class="card-body">
            <h2>$9000 / mo</h2>
            <p>3 <i class="fa-solid fa-bed"></i> 2 <i class="fa-solid fa-bath"></i></p>
            <p>Punggol</p>
            <p>Condominium</p>
            <button class="bcard btn btn-dark" type="button">Buy</button>
          </div>
        </div>
      </div>

    </div>

    <div class="text-center">
      <a href="Boundary/User/userLogin.php" class="btn btn-primary">View All Properties</a>
    </div>

  </section>

  <!-- Features -->

  <section id="features">

    <div class="row">

      <div class="feature-sections col-lg-4">
        <i class="icons fa-solid fa-circle-check fa-4x"></i>
        <h2>Competitive rates</h2>
        <p>We offer the best rates in the market!</p>
      </div>

      <div class="feature-sections col-lg-4">
        <i class="icons fa-solid fa-bullseye fa-4x"></i>
        <h2>Elite Clientele</h2>
        <p>Superior networking.</p>
      </div>

      <div class="feature-sections col-lg-4">
        <i class="icons fa-solid fa-user-tie fa-4x"></i>
        <h2>Professional Agents</h2>
        <p>Find your dream or your money back.</p>
      </div>

    </div>

  </section>

  <!-- Call to Action -->

  <section id="cta">

    <div class="container-fluid">

      <h1>Contact us and find your realm.</h1>
      <button class="cta-btn btn btn-lg btn-secondary" type="button"><span><i class="fa-solid fa-phone"></i></span>
        Contact Us</button>

    </div>
  </section>


  <!-- Footer -->

  <footer id="footer">
    <i class="sm-logos fa-brands fa-facebook-f"></i>
    <i class="sm-logos fa-brands fa-instagram"></i>
    <i class="fa-brands fa-linkedin"></i>
    <p>© Reality Realm</p>

  </footer>


</body>
</html>

</body>

</html>
