<?php
// A common type of custom form validation involves comparing user input against information in the database.
// In this PHP file we will practice validating against backend data using arrays to stand in for dbs.

// An example of this can be when a user wants to create an account, we will need to check that the submitted
// username is not already being used by somebody elese in the database.
// Below is an example of this in PHP
/*
    $users = ["coolBro123" => "password123!", "coderKid" => "pa55w0rd*", "dogWalker" => "ais1eofdog$"];
    
    function isUsernameAvailable ($username){
        global $users;
        if (isset($users[$username])){
            echo "That username is already taken.";
        } else {
            echo "${username} is available.";
        }
    }
    
    isUsernameAvailable("coolBro123");
    // Prints: That username is already taken. 
    
    isUsernameAvailable("aisleOfPHP");
    // Prints: aisleOfPHP is available.
*/

$users = ["coolBro123" => "password123!", "coderKid" => "pa55w0rd*", "dogWalker" => "ais1eofdog$"];  
$feedback = "";
$message = "You're logged in!";
$validation_error = "* Incorrect username or password.";
$username = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check that the input username already exists in the PHP associative array
    // check that the input password is equal to the value stored in the PHP associative array for the specific key
    if (isset($users[$username]) && $users[$username] === $password) {
        $feedback = $message;
    }
    else {
        $feedback = $validation_error;
    }
}

?>
  
<h3>Welcome back!</h3>
<form method="post" action="">
    Username:<input type="text" name="username" value="<?php echo $username;?>" required>
    <br>
    Password:<input type="text" name="password" value="" required>
    <br>
    <input type="submit" value="Log in">
</form>
<span class="feedback"><?= $feedback;?></span>