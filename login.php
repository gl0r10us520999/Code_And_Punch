<?php
    // back end with php

    session_start();

    function validate($data) {
      $newData = stripslashes(trim(htmlspecialchars($data, ENT_QUOTES, "UTF-8")));
      return $newData;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // connect database
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'code_and_punch';

        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

        if (mysqli_connect_error()) {
            exit('Cannot connect to database. Error: ' . mysqli_connect_error());
        }

        // take information from login form
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);

        // check if the user is valid or not
        $query = 'SELECT users.id, users.password FROM users JOIN user_role ON users.id = user_role.id WHERE users.username = ?';
        if ($statement = $con->prepare($query)) {

            $statement->bind_param('s', $username);
            $statement->execute();
            $statement->store_result();

            if ($statement->num_rows > 0) {
                $statement->bind_result($id, $hashed_password);
                $statement->fetch();

                // check password with hash and plain text
                if (password_verify($password, $hashed_password)) {
                  
                  // check user role
                  $query = 'SELECT role FROM user_role WHERE id = ?';
                    if ($statement = $con->prepare($query)) {
                        $statement->bind_param('i', $id);
                        $statement->execute();
                        $statement->bind_result($userRole);
                        $statement->fetch();
                        $statement->close();

                        //take the data from user to redirect to another page
                        $_SESSION['username'] = $username;
                        $_SESSION['id'] = $id;
                        $_SESSION['userRole'] = $userRole;
                        $userRole = $_SESSION['userRole'];
                    }
                  if ($userRole === 'student') {                      
                      header('Location: studentHome.php');
                      exit;
                  } else if ($userRole === 'teacher') {
                      header('Location: teacherHome.php');
                      exit;
                  }
              }              
            } else {
                echo 'User not found.';                
            }

            $statement->close();

        } else {         
          echo 'Something went wrong.';
        }

        $con->close();
    }
  ?>