<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    form {
      width: 300px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #550808;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    form {
      width: 300px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    input[type="submit"] {
      width: 100%;
      padding: 8px;
      background-color: #4CAF50;
      border: none;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      border-radius: 4px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <h1>Login</h1>

  <form method="post" action="login.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
  </form>
  <p style="text-align: center;">Don't have an account? <a href="register.html">Sign up</a> here.</p>
</body>

</html>
