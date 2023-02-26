<?php
// using the built in preg_match() function that takes two strings args:
// 1. a pattern string with a regular expression
// 2. a subject string to check
// it will return 1 if it matches, 0 if it doesn't and false if there was an error

// example regex to test for the 10-digit North American telephone numbers
// /^[(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4}$/
// it allows spaces, hyphens, or periods as optional separators
// as well as optional parentehses around the first three numbers
// preg_match($pattern, "(999)-555-2222"); // Returns: 1
// preg_match($pattern, "555-2222"); // Returns: 0

$feedback = "";
$donation_amount = "";
$card_type = "";
$card_num = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $donation_amount = $_POST["amount"];
  $card_type = $_POST["credit"];
  $card_num = $_POST["card-num"];

  // before we test for regular expression matches, we'll want to make sure the length of an input isn't too long
  // to prevent damage on our website from bad actors bc regex checks can take a lot of computing power
  if (strlen($card_num) < 20) {
    if ($card_type === "mastercard") {
      if (preg_match("/5[1-5][0-9]{14}/", $card_num)) $feedback = "Thank you for your donation of $$donation_amount!";
      else $feedback = "* There was an error with your card. Please try again.";
    }
    else {
      if (preg_match("/4[0-9]{12}([0-9]{3})?([0-9]{3})?/", $card_num)) $feedback = "Thank you for your donation of $$donation_amount!";
      else $feedback = "* There was an error with your card. Please try again.";
    }
  }
  else {
    $feedback = "* There was an error with your card. Please try again.";
  }
}

// some test examples
/*
  Mastercard
  ----------
  Pattern: "/5[1-5][0-9]{14}/"
  Examples:
  5111111111111111
  5522111111111111
  
  Visa
  ----------
  Pattern: "/4[0-9]{12}([0-9]{3})?([0-9]{3})?/"
  Examples:
  4004571528446170
  4500040443327765
*/

?>

<form action="" method="POST">
  <h1>Make a Donation</h1>
  <label for="amount">Donation amount:</label>
  <input type="number" name="amount" value="<?= $donation_amount;?>" required>
  <br><br>
  <label for="credit">Credit card type:</label>
  <select name="credit" value="<?= $card_type;?>">
    <option value="mastercard">Mastercard</option>
    <option value="visa">Visa</option>
  </select>
  <br><br>
  <label for="card-num">Card number:</label>
  <input type="number" name="card-num" value="<?= $card_num;?>" required>
  <br><br>   
  <input type="submit" value="Submit">
</form>

<span class="feedback"><?= $feedback;?></span>