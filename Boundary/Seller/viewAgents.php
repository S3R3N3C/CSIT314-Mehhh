<?php

include_once("../../Controller/Seller/viewAgentsController.php");

$seller_id = $_SESSION['seller_id'];
$viewAgentsController = new viewAgentsController();
$agent = $viewAgentsController->viewAgents();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$navbarItems = array(
  array("text" => "Contact Us", "link" => "#footer"),
  array("text" => "My Property", "link" => "viewSellerPL.php?seller_id=" . $seller_id),
  array("text" => "Agents", "link" => "viewAgents.php"),
);


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>List of Agents</title>
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
    .agent-list {
      margin: 20px;
    }
    .agent {
      border: 3px solid #ccc;
      padding: 10px;
      margin-bottom: 10px;
      background-color: #f9f9f9;
    }
    .agent img {
      max-width: 170px;
      float: left;
      margin-right: 10px;
    }
    .agent-info {
      overflow: hidden;
    }
    .rate-review {
      margin-top: 10px;
    }
  </style>
</head>

<body>
    <section id="title">
   <!-- Navigation Bar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-yellow">
        <div class="container-fluid">
        <a class="navbar-brand" href="/index.php"><img src="/Mehhh/img/logo.jpg" width="100" height="100">
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

  <div class="agent-list">
  <?php foreach ($agent as $agent_info): ?>
    <div class="agent">
      <img src="/Mehhh/img/agent.jpg" alt="<  ?php echo $agent_info['agent_name']; ?>"> 
      <div class="agent-info">
        <h3><?php echo $agent_info['agent_name']; ?></h3> 
        <p><b>Description:</b> About <?php echo $agent_info['agent_name']; ?></p>
        <p><b>Joined years:</b> <?php echo $agent_info['yearJoined']; ?></p>
        <p><b>Contact:</b> <a href="mailto:<?php echo $agent_info['email']; ?>"><?php echo $agent_info['email']; ?></a></p>
        <div class="rate-review">
          <button style="background-color: yellow" 
          onclick="window.location.href='viewAgentReview.php?agent_id=<?php echo $agent_info['agent_id']; ?>'"><b>View Reviews</b></button>
          <button style="background-color:yellow" 
          onclick="window.location.href='rate_review.php?agent_id=<?php echo $agent_info['agent_id']; ?>'"><b>Rate Agent</b></button>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>


</body>

<!-- Footer -->
<footer id="footer">
      <i class="sm-logos fa-brands fa-facebook-f"></i>
      <i class="sm-logos fa-brands fa-instagram"></i>
      <i class="fa-brands fa-linkedin"></i>
      <p>© Reality Realm</p>
</footer>
</html>
