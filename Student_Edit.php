<?php 
    require './functions.php';
    $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
    if ($id) {
        $data = get_1_student_infor($id);
    }

    if (!$data) {
        header("Location: Student_List.php");
    exit();
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data['id'] = isset($_POST['id']) ? $_POST['id'] : '';
        $data['username'] = isset($_POST['username']) ? $_POST['username'] : '';
        $data['password'] = isset($_POST['password']) ? $_POST['password'] : '';
        $data['name'] = isset($_POST['name']) ? $_POST['name'] : '';
        $data['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $data['phone_number'] = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';

        $result = Edit_Student($data['id'], $data['username'], $data['password'], $data['name'], $data['email'], $data['phone_number']);
        if ($result) {
            // Student updated successfully
            echo "Student information updated successfully!";
            header("Location: Student_List.php");
        } else {
            // Failed to update student information
            echo "Failed to update student information.";
            header("Location: Student_List.php");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            background-color: #4285F4;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #1967D2;
        }

        .error-message {
            color: #FF0000;
            margin-top: 10px;
        }

        .success-message {
            color: #00CC00;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Edit Student</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
        
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>" required>
        
        <input type="submit" value="Update Student">
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Display success or error message
            if ($result) {
                echo '<p class="success-message">Student information updated successfully!</p>';
            } else {
                echo '<p class="error-message">Failed to update student information.</p>';
            }
        }
        ?>
    </form>
</body>
</html>
