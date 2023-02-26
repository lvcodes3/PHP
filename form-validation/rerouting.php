<?php
// We can use the PHP header() function to perform redirects.
// We call the header() function on a string that begins with "Location: ", followed by the URL we want to redirect the user to.
// After invoking the header() function, we'll want to use the language construct 'exit' to terminate the current script.
// In order to work properly, the header() function needs to be run before anything is output by the script (including HTML).
// So we must include it in our PHP script before our file outputs any HTML.

$validation_error = "";
$username = "";
$users = ["coolBro123" => "password123!", "coderKid" => "pa55w0rd*", "dogWalker" => "ais1eofdog$"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password  = $_POST["password"];

    if (isset($users[$username]) && $users[$username] === $password) {
        header("Location: success.html");
        exit;
    } 
    else {
        $validation_error = "* Incorrect username or password.";
    }
}

?>
  
<h3>Welcome back!</h3>
<form method="post" action="">
    Username:<input type="text" name="username" value="<?php echo $username;?>" required>
    <br>
    Password:<input type="text" name="password" value="" required>
    <br>
    <span class="error"><?= $validation_error;?></span>
    <br>
    <input type="submit" value="Log in">
</form>
  
  