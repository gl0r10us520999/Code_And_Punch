<?php
echo
function login($username, $password)
{
    $Username = 'admin';
    $Password = 'password';

    // Check if the provided username and password are valid
    if ($username === $Username && $password === $Password) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {
        // Redirect to the home page or a protected area
        header('Location: home.php');
        exit();
    } else {
        // Display error message
        echo "Invalid username or password.";
    }
}
?>
<form action="login.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Log in">
</form>
