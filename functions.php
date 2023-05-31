<?php
    global $conn;
    //Connect to DB
    function connectDB() {
        global $conn;
        if(!$conn){
            $conn = mysqli_connect("localhost", "root", "", "CodeAndPunch");
            mysqli_set_charset($conn, 'utf8');
            if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
            }
        }
    }
    //Disconnect DB
    function disconnectDB() {
        global $conn;
        if ($conn) {
            mysqli_close($conn);
        }
    }
    //Edit student informations
    function Edit_Student($id, $username, $password, $name, $email, $phone_number) {
        global $conn;
        connectDB();

        //Prevent SQLi
        $id = intval($id);
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phone_number = mysqli_real_escape_string($conn, $phone_number);

        $edit_student = "UPDATE users SET username = $username, password = $password, name = $name, email = $email, phone_number = $phone_number WHERE id = $id";

        $query = mysqli_query($conn, $edit_student);

        disconnectDB();
        return $query;
    }
    //Delete student
    function Delete_Student($id) {
        global $conn;
        connectDB();
        //prevent SQLi
        $id = intval($id);

        $delete_student = "DELETE FROM users WHERE id = $id";

        $query = mysqli_query($conn, $delete_student);

        disconnectDB();
        return $query;
    }
    // Add student
    function Add_Student($username, $password, $name, $email, $phone_number) {
        global $conn;
        connectDB();
        
        //Prevent SQLi
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phone_number = mysqli_real_escape_string($conn, $phone_number);

        //Check if username alreeady exist
        $query_check = mysqli_query($conn, "SELECT username FROM users WHERE username = $username");
        if ($query_check && mysqli_num_rows($query_check) == 0) {
            $add_student = "INSERT INTO users (username, password, role, name, email, phone_number) VALUES ($username, $password, student, $name, $email, $phone_number)";
            mysqli_query($conn, $add_student);
        }else{
            $query = false;
        }
        disconnectDB();
        return $query;
    }
       
    
?>
