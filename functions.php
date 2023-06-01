<?php
    global $conn;
    //Connect to DB
    function connectDB() {
        global $conn;
        $conn = mysqli_connect("localhost", "root", "", "CodeAndPunch");
    
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        return $conn;
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
    // function Add_Student($username, $password, $name, $email, $phone_number) {
    //     global $conn;
    //     connectDB();
        
    //     //Prevent SQLi
    //     $username = mysqli_real_escape_string($conn, $username);
    //     $password = mysqli_real_escape_string($conn, $password);
    //     $name = mysqli_real_escape_string($conn, $name);
    //     $email = mysqli_real_escape_string($conn, $email);
    //     $phone_number = mysqli_real_escape_string($conn, $phone_number);

    //     //Check if username alreeady exist
    //     $query_check = mysqli_query($conn, "SELECT id FROM users WHERE username = $username");
    //     if ($query_check && mysqli_num_rows($query_check) == 0) {
    //         $add_student = "INSERT INTO users (username, password, role, name, email, phone_number) VALUES ($username, $password, student, $name, $email, $phone_number)";
    //         mysqli_query($conn, $add_student);
    //     }else{
    //         $query = false;
    //     }
    //     disconnectDB();
    //     return $query;
    // }
    function Add_Student($username, $password, $name, $email, $phone_number) {
        global $conn;
        connectDB();
    
        // Prevent SQLi
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phone_number = mysqli_real_escape_string($conn, $phone_number);
    
        // Check if username already exists
        $username_query = "SELECT id FROM users WHERE username = '$username'";
        $query_check = mysqli_query($conn, $username_query);
        if ($query_check && mysqli_num_rows($query_check) == 0) {
            $add_student = "INSERT INTO users (username, password, role, name, email, phone_number) VALUES ('$username', '$password', 'student', '$name', '$email', '$phone_number')";
            mysqli_query($conn, $add_student);
            $query = true;
        } else {
            $query = false;
        }
        disconnectDB();
        return $query;
    }
    
    //Get data of all student
    function get_students_infor(){
    global $conn;
    
    connectDB();
    
    $get_infor = "SELECT * FROM users WHERE role = 'student'";
    
    $query = mysqli_query($conn, $get_infor);

    $result = array();
    
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    return $result;
    }
    //Get data of 1 student
    function get_1_student_infor($id){
    global $conn;
    connectDB();
    
    $id = intval($id);
    
    $get_infor = "SELECT * FROM users WHERE id = $id";
    
    $query = mysqli_query($conn, $get_infor);
    
    $result = array();
    
        if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    return $result;
    }    
?>