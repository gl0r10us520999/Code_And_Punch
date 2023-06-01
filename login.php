<?php
require './functions.php';
//declare use session
session_start();
connectDB();

//handle login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get input from user
    $username = $_POST['username'];
    $password = $_POST['password'];

    //check input username and password
    if (!$username || !$password) {
        echo "Invalid username or password!";
        exit;
    }

    $regex1 = preg_match('/[\'"^£$%&*()}{@#~?><>,|=_+¬-]/', $username);
    $regex2 = preg_match('/[\'"^£$%&*()}{@#~?><>,|=_+¬-]/', $password);
    if (!$regex1 && !$regex2) {

        $query = "SELECT * FROM users WHERE username = ? and password = ?";

        // Prevent SQLi by using prepared statement
        $preparedStatement = $conn->prepare($query);
        $preparedStatement->bind_param('ss', $username, $password);
        $preparedStatement->execute();
        $result = $preparedStatement->get_result();

        if ($result->num_rows > 0) {
            // Get information form DB
            $row = $result->fetch_assoc();
            // save session's data
            if ($password == $row['password']) {
                $_SESSION["username"] = $username;
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['phone_number'] = $row['phone_number'];
                //Check role of user and redirect to home page
                if ($row["role"] == "student") {
                    header("Location: Student_Home.php");
                    exit;
                } elseif ($row["role"] == "teacher") {
                    header("Location: Teacher_Home.php");
                    exit;
                }
            } else {
                echo "Wrong password!";
                exit;
            }
        } else {
            echo "Username does not exist!";
            exit;
        }
    }
}
disconnectDB();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .h-custom-2 {
            height: calc(100% - 6.5rem);
        }
        .bg-image-vertical {
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
        }

        @media (min-width: 1025px) {
        .h-custom-2 {
        height: 100%;
        }
        }
    </style>
</head>

<body>
<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black">

                <div class="px-5 ms-xl-4">
                    <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                    <span class="h1 fw-bold mb-0">Login</span>
                </div>

                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                    <form style="width: 23rem;" action="" method="POST">
                        <!-- Add CSRF token -->
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                        <div class="form-outline mb-4">
                            <input type="text" id="form2Example28" class="form-control form-control-lg" name="username" required />
                            <label class="form-label" for="form2Example18">Username</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="form2Example28" class="form-control form-control-lg" name="password" required />
                            <label class="form-label" for="form2Example28">Password</label>
                        </div>

                        <div class="pt-1 mb-4">
                            <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                        </div>

                        <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                        <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p>
                    </form>

                </div>

            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fvov2.vov.vn%2Fgiao-duc-dao-tao%2Fdai-hoc-fpt-bao-dong-do-toan-truong-vi-ca-nhiem-covid-19-24481.vov2&psig=AOvVaw0PMd1-bjGrDufEWbwaaBoE&ust=1685701879549000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCKj3oP_uof8CFQAAAAAdAAAAABAE"
                     alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>
</section>
</body>

</html>
