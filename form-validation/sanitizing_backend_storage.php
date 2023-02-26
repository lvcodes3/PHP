<?php
// In addition to sanitizing data that is displayed to the user, we must also sanitize all data before storing it in our databases.
// Attempting to store unsanitized inputs into a database can allow a bad actor to corrupt or gain acccess to sensitive info.
// We will also want to sanitize the formatting (making sure the data stored in our db follows consistent formatting).
// (If we are going to be displaying or using the data, we will want to make sure it always looks the same)

// To sanitize data formatting, we can use the built-in preg_replace() function.
// It takes in a regular expression, some replacement text, and a subject string.
// First it searches through the subject string for instances that match the regular expression.
// Then it outputs a copy of the subject string that has matched instances replaced by the replacement string
/*
    $one = "codeacademy";
    $two = "CodeAcademy";
    $three = "code academy";
    $four = "Code Academy";
    
    $pattern = "/[cC]ode\s*[aA]cademy/";
    $codecademy = "Codecademy";
    
    echo preg_replace($pattern, $codecademy, $one);
    // Prints: Codecademy
    
    echo preg_replace($pattern, $codecademy, $two);
    // Prints: Codecademy
    
    echo preg_replace($pattern, $codecademy, $three);
    // Prints: Codecademy
    
    echo preg_replace($pattern, $codecademy, $four);
    // Prints: Codecademy
*/


$contacts = ["Susan" => "5551236666", "Alex" => "7779991717", "Lily" => "8181117777"];  
$message = "";
$validation_error = "* Please enter a 10-digit North American phone number.";
$name = "";
$number = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $number  = $_POST["number"];

    if (strlen($number) < 30) {
        $formatted_number = preg_replace("/[^0-9]/", "", $number);
        if (strlen($formatted_number) === 10) {
            $contacts[$name] = $formatted_number;
            $message = "Thanks $name, we'll be in touch.";
        }
        else {
            $message = $validation_error;
        }

    }
    else {
        $message = $validation_error;
    }
}

?>

<html>
	<body>
        <h3>Contact Form:</h3>
        <form method="post" action="">
            Name:
            <br>
            <input type="text" name="name" value="<?= $name;?>" required>
            <br><br>
            Phone Number:
            <br>
            <input type="text" name="number" value="<?= $number;?>" required>
            <br><br> 
            <input type="submit" value="Submit">
        </form>
        <div id="form-output">
            <p id="response"><?= $message?></p>
        </div>
	</body>
</html>
    