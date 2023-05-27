<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Home</title>
</head>

<body>
    <h1>Welcome, <?php session_start(); echo $_SESSION['username']; ?></h1>
    
    <!-- Logout link -->
    <a href="logout.php">Logout</a>
</body>

</html>
