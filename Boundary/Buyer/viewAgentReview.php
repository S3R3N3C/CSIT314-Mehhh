<?php

include_once("../../Controller/Buyer/viewAgentReviewController.php");
include_once("../../Controller/Buyer/viewAgentRatingController.php");

$agent_id = $_GET['agent_id'];
$buyer_id = $_SESSION['buyer_id'];


$viewAgentReviewController = new viewAgentReviewController();
$reviews = $viewAgentReviewController->viewAgentReview($agent_id);

$viewAgentRatingController = new viewAgentRatingController();
$ratings = $viewAgentRatingController->viewAgentRating($agent_id);

$agentInfo = $viewAgentReviewController->getAgentInfo($agent_id);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$navbarItems = array(
    array("text" => "About Us", "link" => "#footer"),
    array("text" => "Favourite List", "link" => "viewFavList.php?buyer_id=" . $buyer_id),
    array("text" => "Buy", "link" => "viewPropertyListings.php"),
    array("text" => "Agents", "link" => "viewAgents.php"),
    array("text" => "Mortgage Calculator", "link" => "mortgage.php")
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $agentInfo['user_fullname']; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- CSS links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../Buyer/CSS/styles.css">
    <script src="https://kit.fontawesome.com/e3ffb3fff0.js" crossorigin="anonymous"></script>

    <!-- Bootstrap scripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


    
    <style>
        .agent-list {
            margin-left: 120px;
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

        .review-list {
            margin-top: 20px;
        }

        .review {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        .rating {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        .review-rating-btn {
            background-color: #FF5733;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .review-rating-btn:hover {
            background-color: #E84512;
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

    <br>
    <button style="background-color: yellow" onclick="window.location.href='viewAgents.php'"><i class="fa-solid fa fa-arrow-left"></i></button>
    <div class="container agent-list">
        <div class="row justify-content-end"> <!-- Shift content towards the right -->
            <div class="col-md-8"> <!-- Width of the content -->
                <div class="agent">
                    <img src="../../img/agent.jpg" alt="<?php echo $agentInfo['user_fullname']; ?>">
                    <div class="agent-info">
                        <h3><?php echo $agentInfo['user_fullname']; ?></h3>
                        <p><b>Description:</b> About <?php echo $agentInfo['user_fullname']; ?></p>
                        <p><b>Joined years:</b> <?php echo $agentInfo['yearJoined']; ?></p>
                        <p><b>Contact:</b> <a href="mailto:<?php echo $agentInfo['email']; ?>"><?php echo $agentInfo['email']; ?></a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-8">
                <div class="review-list">
                    <h3>Rating & Reviews</h3>
                </div>
            </div>
        </div>

        <div class="row justify-content-end"> <!-- Shift content towards the right -->
            <div class="col-md-8"> <!-- Width of the content -->
                <div class="review-list">
                    <?php for ($i = 0; $i < count($reviews); $i++) : ?>
                        <div class="review">
                            <?php
                            // Fetch user fullname based on the writtenBy ID 
                            $userName = $viewAgentReviewController->getUserFullName($reviews[$i]['writtenBy']);
                            ?>
                            <p><img src="../../img/user.png" style="width:30px; height30px;"><b><?php echo $userName; ?></b></p>
                            <p><b>Rating: </b>
                                <?php if (isset($ratings[$i]['rating']) && $ratings[$i]['rating'] == 0) : ?>
                                    <?php for ($j = 1; $j <= 5; $j++) : ?>
                                        <i class="far fa-star"></i>
                                    <?php endfor; ?>
                                    No rating yet
                                <?php elseif (isset($ratings[$i]['rating'])) : ?>
                                    <?php for ($j = 1; $j <= 5; $j++) : ?>
                                        <?php if ($j <= $ratings[$i]['rating']) : ?>
                                            <i class="fas fa-star"></i>
                                        <?php else : ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                <?php else : ?>
                                    <?php for ($j = 1; $j <= 5; $j++) : ?>
                                        <i class="far fa-star"></i>
                                    <?php endfor; ?>
                                    No rating yet
                                <?php endif; ?>
                            </p>
                            <p><b>Review: </b> <?php echo $reviews[$i]['review']; ?></p>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Footer -->
    <footer id="footer">
        <i class="sm-logos fa-brands fa-facebook-f"></i>
        <i class="sm-logos fa-brands fa-instagram"></i>
        <i class="fa-brands fa-linkedin"></i>
        <p>© Reality Realm</p>
    </footer>
</body>

</html>
