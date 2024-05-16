<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start(); // Start the session
$buyer_id = $_SESSION['buyer_id'];

// Calculate mortgage payment
function calcMortgage($loanAmount, $interestRate, $loanTerm) {
    $monthlyInterestRate = $interestRate / 12;
    $loanTermMonths = $loanTerm * 12;
    $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$loanTermMonths));

    return $monthlyPayment;
}

// Function to display the mortgage calculation result
function displayResult($loanAmount, $interestRate, $loanTerm, $monthlyPayment) {
    echo "<h3>Result:</h3>";
    echo "<p><b>Loan Amount: $". number_format($loanAmount, 2) . "</b></p>";
    echo "<p><b>Interest Rate: " . ($interestRate * 100) . "%</b></p>";
    echo "<p><b>Loan Term: " . ($loanTerm) . " years</b></p>";
    echo "<p><b>Monthly Payment: $" . number_format($monthlyPayment, 2) . "</b></p>";
}

$navbarItems = array(
    array("text" => "About Us", "link" => "#footer"),
    array("text" => "Favourite List", "link" => "viewFavList.php?buyer_id=" . $buyer_id),
    array("text" => "Buy", "link" => "viewPropertyListings.php"),
    array("text" => "Agents", "link" => "viewAgents.php"),
    array("text" => "Mortgage Calculator", "link" => "mortgage.php"),
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortgage Calculator</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- CSS links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../Buyer/CSS/styles.css">
    <script src="https://kit.fontawesome.com/e3ffb3fff0.js" crossorigin="anonymous"></script>

    <!-- Bootstrap scripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <style>
        /* Basic CSS for form */
        
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <section id="title">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-yellow">
            <div class="container-fluid">
                <a class="navbar-brand" href="../Buyer/viewPropertyListings.php"><img src="/Mehhh/img/logo.jpg" width="100" height="100">
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
                                <a class="nav-icon" href="../../index.php"><i class="fa-solid fa fa-sign-out"></i></a>
                            </li>
                        </ul>
                    </div>
            </div>
        </nav>
    </section>

    <h2>Mortgage Calculator</h2>

    <form method="post">
        <label for="loan_amount">Loan Amount ($):</label>
        <input type="number" id="loan_amount" name="loan_amount" required>

        <label for="interest_rate">Interest Rate (%):</label>
        <input type="number" id="interest_rate" name="interest_rate" required step="0.01">

        <label for="loan_term">Loan Term (years):</label>
        <input type="number" id="loan_term" name="loan_term" required>

        <input type="submit" value="Calculate">
        <a href="../Buyer/viewPropertyListings.php" class="backbutton">Back</a>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Form data
            $loanAmount = $_POST['loan_amount'];
            $interestRate = $_POST['interest_rate'] / 100; // Convert percentage to decimal
            $loanTerm = $_POST['loan_term'];

            $monthlyPayment = calcMortgage($loanAmount, $interestRate, $loanTerm);
            displayResult($loanAmount, $interestRate, $loanTerm, $monthlyPayment);
        }
        ?>
    </form>

</body>

</html>
