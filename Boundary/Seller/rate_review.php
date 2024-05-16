<?php
include_once("../../Controller/Seller/rateAgentController.php");
include_once("../../Controller/Seller/reviewAgentController.php");

$agent_id = isset($_GET['agent_id']) ? $_GET['agent_id'] : null;
$seller_id = $_SESSION['user_id']; // FK users table user_id

$rateAgentController = new rateAgentController();
$reviewAgentController = new reviewAgentController();

$agentInfo = $rateAgentController->getAgentInfo($agent_id);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form submission
    $agent_id = isset($_POST["agent_id"]) ? $_POST["agent_id"] : null;
    $rating = isset($_POST["rating"]) ? $_POST["rating"] : 0;
    $review = isset($_POST["review"]) ? $_POST["review"] : null;
    $writtenBy = $seller_id; // logged-in user is the one submitting the rating

    // Save the rating
    $ratingResult = $rateAgentController->rateAgent($agent_id, $rating, $writtenBy);
    
    // Save the review
    $reviewResult = $reviewAgentController->reviewAgent($agent_id, $review, $writtenBy);

    // Check if both rating and review were successfully saved
    if ($ratingResult && $reviewResult) {
        echo "<script>alert('Rating and review submitted successfully!');window.location.href = 'viewAgents.php';</script>";
    } else {
        echo "<script>alert('Failed to submit rating and review.');</script>";
    }
}

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
    <title>Rate & Review Agent</title>
    <!-- Add your CSS stylesheets here -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- CSS links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../Buyer/CSS/styles.css">
    <script src="https://kit.fontawesome.com/e3ffb3fff0.js" crossorigin="anonymous"></script>
    <!-- Bootstrap scripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <style>
        .container {
            margin-top: 10px;
        }

        .agent-info {
            margin-top: 10px;
        }

        .form-container {
            margin-top: 10px;
            width: 50%;
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }

        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }

        .rate:not(:checked) > label:before {
            content: '★ ';
        }

        .rate > input:checked ~ label {
            color: #ffc700;    
        }

        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }

        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }

        label {
            font-size: 16px;
            color: #333;
            cursor: pointer;
            font-weight:bold;
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
<div class="container">
        <!-- Display agent details -->
        <div class="row justify-content-end">
            <div class="col-md-8">
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
    </div>

    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-8">
                <h1>Rate & Review</h1>
                <div class="form-container">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validateForm()">
                        <input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>">
                        <div class="rate">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="text">1 star</label>

                        </div>
                        <br>
                        <br>
                        <label for="review">Review:</label>
                        <br>
                        <textarea name="review" id="review" rows="4" cols="50"></textarea>
                        <br>
                        <input type="submit" value="Submit">
                        <a href="viewAgents.php"><button type="button">Cancel</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var rating = document.querySelector('input[name="rating"]:checked');
            var review = document.getElementById('review').value.trim();

            if (!rating && review === '') {
                alert("Please provide a rating or write a review.");
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
</body>
</html>


