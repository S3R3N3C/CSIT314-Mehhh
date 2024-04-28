<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mortgage Calculator</title>
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
</style>
</head>
<body>

<h2>Mortgage Calculator</h2>

<form method="post">
  <label for="loan_amount">Loan Amount ($):</label>
  <input type="number" id="loan_amount" name="loan_amount" required>

  <label for="interest_rate">Interest Rate (%):</label>
  <input type="number" id="interest_rate" name="interest_rate" required step="0.01">

  <label for="loan_term">Loan Term (years):</label>
  <input type="number" id="loan_term" name="loan_term" required>

  <input type="submit" value="Calculate">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $loanAmount = $_POST['loan_amount'];
  $interestRate = $_POST['interest_rate'] / 100; // Convert percentage to decimal
  $loanTerm = $_POST['loan_term'] * 12; // Convert years to months

  // Calculate monthly interest rate
  $monthlyInterestRate = $interestRate / 12;

  // Calculate monthly mortgage payment
  $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$loanTerm));

  // Display result
  echo "<h3>Result:</h3>";
  echo "<p>Loan Amount: $" . number_format($loanAmount, 2) . "</p>";
  echo "<p>Interest Rate: " . ($interestRate * 100) . "%</p>";
  echo "<p>Loan Term: " . ($_POST['loan_term']) . " years</p>";
  echo "<p>Monthly Payment: $" . number_format($monthlyPayment, 2) . "</p>";
}
?>

</body>
</html>